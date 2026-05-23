<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\SshKeyResource;
use App\Models\SshKey;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class SshKeyController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $keys = SshKey::query()
            ->when(! auth()->user()->isAdmin(), fn ($q) => $q->where('user_id', auth()->id()))
            ->orderBy('name')
            ->get();

        return SshKeyResource::collection($keys);
    }

    public function store(Request $request)
    {
        $this->authorize('create', SshKey::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'public_key' => 'required|string',
            'private_key' => 'required|string',
            'passphrase' => 'nullable|string',
        ]);

        $key = auth()->user()->sshKeys()->create($validated);

        return new SshKeyResource($key);
    }

    public function show(SshKey $sshKey)
    {
        $this->authorize('view', $sshKey);

        return new SshKeyResource($sshKey);
    }

    public function update(Request $request, SshKey $sshKey)
    {
        $this->authorize('update', $sshKey);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'public_key' => 'sometimes|required|string',
            'private_key' => 'sometimes|required|string',
            'passphrase' => 'nullable|string',
        ]);

        $sshKey->update($validated);

        return new SshKeyResource($sshKey);
    }

    public function destroy(SshKey $sshKey)
    {
        $this->authorize('delete', $sshKey);

        $sshKey->delete();

        return response()->noContent();
    }
}
