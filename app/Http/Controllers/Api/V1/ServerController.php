<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\ServerResource;
use App\Models\Server;
use App\Services\SshService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function store(Request $request)
    {
        $this->authorize('create', Server::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'host' => 'required|string|max:255',
            'port' => 'required|integer|min:1|max:65535',
            'username' => 'required|string|max:255',
            'auth_type' => ['required', Rule::in(['password', 'key'])],
            'password' => 'required_if:auth_type,password|nullable|string',
            'ssh_key_id' => 'required_if:auth_type,key|nullable|exists:ssh_keys,id',
            'private_key' => 'nullable|string',
            'passphrase' => 'nullable|string',
            'group' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        if (isset($validated['ssh_key_id'])) {
            $sshKey = auth()->user()->sshKeys()->find($validated['ssh_key_id']);
            if (! $sshKey) {
                return response()->json(['message' => 'Invalid SSH Key'], 422);
            }
        }

        $server = auth()->user()->servers()->create($validated);

        return new ServerResource($server);
    }

    public function show(Server $server)
    {
        $this->authorize('view', $server);

        return new ServerResource($server);
    }

    public function update(Request $request, Server $server)
    {
        $this->authorize('update', $server);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'host' => 'sometimes|required|string|max:255',
            'port' => 'sometimes|required|integer|min:1|max:65535',
            'username' => 'sometimes|required|string|max:255',
            'auth_type' => ['sometimes', 'required', Rule::in(['password', 'key'])],
            'password' => 'nullable|string',
            'ssh_key_id' => 'nullable|exists:ssh_keys,id',
            'private_key' => 'nullable|string',
            'passphrase' => 'nullable|string',
            'group' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        if (isset($validated['ssh_key_id'])) {
            $sshKey = auth()->user()->sshKeys()->find($validated['ssh_key_id']);
            if (! $sshKey) {
                return response()->json(['message' => 'Invalid SSH Key'], 422);
            }
        }

        $server->update($validated);

        return new ServerResource($server);
    }

    public function destroy(Server $server)
    {
        $this->authorize('delete', $server);

        $server->delete();

        return response()->noContent();
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
