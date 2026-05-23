<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\QuickCommandResource;
use App\Models\QuickCommand;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class QuickCommandController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $commands = QuickCommand::query()
            ->when(! auth()->user()->isAdmin(), fn ($q) => $q->where('user_id', auth()->id()))
            ->orderBy('name')
            ->get();

        return QuickCommandResource::collection($commands);
    }

    public function store(Request $request)
    {
        $this->authorize('create', QuickCommand::class);

        $validated = $request->validate([
            'server_id' => 'nullable|exists:servers,id',
            'name' => 'required|string|max:255',
            'command' => 'required|string',
        ]);

        if (isset($validated['server_id'])) {
            $server = auth()->user()->servers()->find($validated['server_id']);
            if (! $server) {
                return response()->json(['message' => 'Invalid Server'], 422);
            }
        }

        $command = auth()->user()->quickCommands()->create($validated);

        return new QuickCommandResource($command);
    }

    public function show(QuickCommand $quickCommand)
    {
        $this->authorize('view', $quickCommand);

        return new QuickCommandResource($quickCommand);
    }

    public function update(Request $request, QuickCommand $quickCommand)
    {
        $this->authorize('update', $quickCommand);

        $validated = $request->validate([
            'server_id' => 'nullable|exists:servers,id',
            'name' => 'sometimes|required|string|max:255',
            'command' => 'sometimes|required|string',
        ]);

        if (isset($validated['server_id'])) {
            $server = auth()->user()->servers()->find($validated['server_id']);
            if (! $server) {
                return response()->json(['message' => 'Invalid Server'], 422);
            }
        }

        $quickCommand->update($validated);

        return new QuickCommandResource($quickCommand);
    }

    public function destroy(QuickCommand $quickCommand)
    {
        $this->authorize('delete', $quickCommand);

        $quickCommand->delete();

        return response()->noContent();
    }
}
