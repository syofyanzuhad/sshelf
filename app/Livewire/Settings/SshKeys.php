<?php

namespace App\Livewire\Settings;

use App\Models\SshKey;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('SSH Keys')]
class SshKeys extends Component
{
    use WithPagination;

    public $editing = null;

    public $name = '';

    public $public_key = '';

    // Credential fields kept as properties but not synced from/to web DB to preserve E2EE
    public $private_key = '';
    public $passphrase = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'public_key' => 'nullable|string',
    ];

    public function create()
    {
        $this->authorize('create', SshKey::class);
        $this->reset(['editing', 'name', 'public_key', 'private_key', 'passphrase']);
        $this->dispatch('open-modal', 'ssh-key-modal');
    }

    public function edit(SshKey $sshKey)
    {
        $this->authorize('update', $sshKey);
        $this->editing = $sshKey;
        $this->name = $sshKey->name;
        $this->public_key = $sshKey->public_key;
        $this->private_key = '';
        $this->passphrase = '';
        $this->dispatch('open-modal', 'ssh-key-modal');
    }

    public function save()
    {
        $this->validate();

        $data = [
            'user_id' => Auth::id(),
            'name' => $this->name,
            'public_key' => $this->public_key,
        ];

        if ($this->editing) {
            $this->authorize('update', $this->editing);
            $this->editing->update($data);
        } else {
            $this->authorize('create', SshKey::class);
            SshKey::create($data);
        }

        $this->dispatch('close-modal', 'ssh-key-modal');
        $this->reset(['editing', 'name', 'public_key', 'private_key', 'passphrase']);
    }

    public function delete(SshKey $sshKey)
    {
        $this->authorize('delete', $sshKey);
        $sshKey->delete();
    }

    public function render()
    {
        $sshKeys = SshKey::query()
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.settings.ssh-keys', [
            'sshKeys' => $sshKeys,
        ])->layout('layouts.app');
    }
}
