<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\ServerResource;
use App\Models\Server;
use App\Services\SshService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $servers = Server::query()
            ->when(! auth()->user()->isAdmin(), fn ($q) => $q->where('user_id', auth()->id()))
            ->orderBy('name')
            ->get();

        return ServerResource::collection($servers);
    }

    public function show(Server $server)
    {
        $this->authorize('view', $server);

        return new ServerResource($server);
    }

    public function execute(Request $request, Server $server, SshService $sshService)
    {
        $this->authorize('view', $server);

        $request->validate([
            'command' => 'required|string',
        ]);

        $result = $sshService->executeCommand($server, $request->command);

        if (! $result['success']) {
            return response()->json([
                'message' => 'Command execution failed',
                'error' => $result['message'],
            ], 500);
        }

        return response()->json([
            'output' => $result['output'],
            'exit_code' => $result['exit_code'] ?? 0,
        ]);
    }
}
