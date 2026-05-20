<?php

namespace App\Livewire\Settings;

use App\Models\SshKey;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use phpseclib3\Crypt\EC;
use phpseclib3\Crypt\RSA;

class SshKeys extends Component
{
    use WithPagination;

    public $editing = null;
    public $name = '';
    public $public_key = '';
    public $private_key = '';
    public $passphrase = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'public_key' => 'nullable|string',
        'private_key' => 'required|string',
        'passphrase' => 'nullable|string',
    ];

    public function create()
    {
        $this->reset(['editing', 'name', 'public_key', 'private_key', 'passphrase']);
        $this->dispatch('open-modal', 'ssh-key-modal');
    }

    public function edit(SshKey $sshKey)
    {
        $this->authorize('update', $sshKey);
        $this->editing = $sshKey;
        $this->name = $sshKey->name;
        $this->public_key = $sshKey->public_key;
        $this->private_key = $sshKey->private_key;
        $this->passphrase = $sshKey->passphrase;
        $this->dispatch('open-modal', 'ssh-key-modal');
    }

    public function generateKeyPair()
    {
        // Default to Ed25519 as it's modern and secure
        $private = EC::createKey('Ed25519');
        $public = $private->getPublicKey();

        $this->private_key = $private->toString('OpenSSH');
        $this->public_key = $public->toString('OpenSSH');
        
        if (empty($this->name)) {
            $this->name = 'Generated Key ' . now()->format('Y-m-d H:i');
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'user_id' => Auth::id(),
            'name' => $this->name,
            'public_key' => $this->public_key,
            'private_key' => $this->private_key,
            'passphrase' => $this->passphrase ?: null,
        ];

        if ($this->editing) {
            $this->editing->update($data);
        } else {
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
        $sshKeys = SshKey::where('user_id', Auth::id())
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.settings.ssh-keys', [
            'sshKeys' => $sshKeys,
        ])->layout('layouts.app');
    }
}
