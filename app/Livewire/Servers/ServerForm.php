<?php

namespace App\Livewire\Servers;

use App\Models\Server;
use App\Models\SshKey;
use App\Services\SshService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ServerForm extends Component
{
    public ?Server $server = null;

    public bool $showModal = false;

    public string $name = '';

    public string $host = '';

    public int $port = 22;

    public string $username = '';

    public string $auth_type = 'password';

    public ?int $ssh_key_id = null;

    // Fields kept for property existence but not used for E2EE compliance on web
    public string $password = '';
    public string $private_key = '';
    public string $passphrase = '';

    public string $group = '';

    public string $notes = '';

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'host' => 'required|string|max:255',
            'port' => 'required|integer|min:1|max:65535',
            'username' => 'required|string|max:255',
            'auth_type' => 'required|in:password,key',
            'ssh_key_id' => 'nullable|exists:ssh_keys,id',
            'group' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ];
    }

    #[On('create-server')]
    public function create()
    {
        $this->authorize('create', Server::class);
        $this->reset(['server', 'name', 'host', 'port', 'username', 'auth_type', 'ssh_key_id', 'password', 'private_key', 'passphrase', 'group', 'notes']);
        $this->port = 22;
        $this->auth_type = 'password';
        $this->dispatch('open-modal', 'server-form-modal');
    }

    #[On('edit-server')]
    public function edit(Server $server)
    {
        $this->authorize('update', $server);
        $this->server = $server;
        $this->name = $server->name;
        $this->host = $server->host;
        $this->port = $server->port;
        $this->username = $server->username;
        $this->auth_type = $server->auth_type;
        $this->ssh_key_id = $server->ssh_key_id;
        // DO NOT load credentials on web
        $this->password = '';
        $this->private_key = '';
        $this->passphrase = '';
        $this->group = $server->group ?? '';
        $this->notes = $server->notes ?? '';
        $this->dispatch('open-modal', 'server-form-modal');
    }

    public function save()
    {
        $this->validate();

        $data = [
            'user_id' => Auth::id(),
            'name' => $this->name,
            'host' => $this->host,
            'port' => $this->port,
            'username' => $this->username,
            'auth_type' => $this->auth_type,
            'ssh_key_id' => $this->ssh_key_id ?: null,
            'group' => $this->group,
            'notes' => $this->notes,
        ];

        if ($this->server) {
            $this->authorize('update', $this->server);
            $this->server->update($data);
        } else {
            $this->authorize('create', Server::class);
            Server::create($data);
        }

        $this->dispatch('close-modal', 'server-form-modal');
        $this->dispatch('server-saved');
    }

    public function testConnection(SshService $sshService)
    {
        session()->flash('error', 'Use Sshelf Desktop to manage encrypted credentials and test connections.');
    }

    public function render()
    {
        $groups = Server::query()
            ->whereNotNull('group')
            ->distinct()
            ->orderBy('group')
            ->pluck('group');

        $sshKeys = SshKey::query()
            ->orderBy('name')
            ->get();

        return view('livewire.servers.server-form', [
            'groups' => $groups,
            'sshKeys' => $sshKeys,
        ]);
    }
}
