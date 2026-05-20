<?php

namespace App\Livewire\Servers;

use App\Models\Server;
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
            'password' => 'required_if:auth_type,password',
            'private_key' => 'required_if:auth_type,key',
            'passphrase' => 'nullable|string',
            'group' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ];
    }

    #[On('create-server')]
    public function create()
    {
        $this->reset(['server', 'name', 'host', 'port', 'username', 'auth_type', 'password', 'private_key', 'passphrase', 'group', 'notes']);
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
        $this->password = $server->password ?? '';
        $this->private_key = $server->private_key ?? '';
        $this->passphrase = $server->passphrase ?? '';
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
            'password' => $this->auth_type === 'password' ? $this->password : null,
            'private_key' => $this->auth_type === 'key' ? $this->private_key : null,
            'passphrase' => $this->auth_type === 'key' ? $this->passphrase : null,
            'group' => $this->group,
            'notes' => $this->notes,
        ];

        if ($this->server) {
            $this->server->update($data);
        } else {
            Server::create($data);
        }

        $this->dispatch('close-modal', 'server-form-modal');
        $this->dispatch('server-saved');
    }

    public function testConnection(SshService $sshService)
    {
        $this->validate();

        $tempServer = new Server([
            'host' => $this->host,
            'port' => $this->port,
            'username' => $this->username,
            'auth_type' => $this->auth_type,
            'password' => $this->password,
            'private_key' => $this->private_key,
            'passphrase' => $this->passphrase,
        ]);

        $result = $sshService->testConnection($tempServer);

        if ($result['success']) {
            session()->flash('message', 'Success: '.$result['message']);
        } else {
            session()->flash('error', 'Error: '.$result['message']);
        }
    }

    public function render()
    {
        $groups = Server::where('user_id', Auth::id())
            ->whereNotNull('group')
            ->distinct()
            ->orderBy('group')
            ->pluck('group');

        return view('livewire.servers.server-form', [
            'groups' => $groups,
        ]);
    }
}
