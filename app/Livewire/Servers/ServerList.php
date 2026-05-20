<?php

namespace App\Livewire\Servers;

use App\Models\Server;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ServerList extends Component
{
    use WithPagination;

    public string $search = '';
    public string $selectedGroup = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedGroup' => ['except' => ''],
    ];

    #[On('server-saved')]
    public function refresh()
    {
        $this->resetPage();
    }

    public function delete(Server $server)
    {
        $this->authorize('delete', $server);
        $server->delete();
    }

    public function duplicate(Server $server)
    {
        $this->authorize('view', $server);

        $newServer = $server->replicate();
        $newServer->name = $server->name.' (Copy)';
        $newServer->save();

        $this->dispatch('server-saved');
    }

    public function export()
    {
        $servers = Server::where('user_id', Auth::id())->get();

        $data = $servers->map(function ($server) {
            return [
                'name' => $server->name,
                'host' => $server->host,
                'port' => $server->port,
                'username' => $server->username,
                'auth_type' => $server->auth_type,
                'password' => $server->password,
                'private_key' => $server->private_key,
                'passphrase' => $server->passphrase,
                'group' => $server->group,
                'notes' => $server->notes,
            ];
        });

        $json = json_encode($data, JSON_PRETTY_PRINT);
        $filename = 'sshelf-servers-'.now()->format('Y-m-d-His').'.json';

        return response()->streamDownload(function () use ($json) {
            echo $json;
        }, $filename, ['Content-Type' => 'application/json']);
    }

    public function exportCsv()
    {
        $servers = Server::where('user_id', Auth::id())->get();

        $filename = 'sshelf-servers-'.now()->format('Y-m-d-His').'.csv';

        return response()->streamDownload(function () use ($servers) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Name', 'Host', 'Port', 'Username', 'Auth Type', 'Password', 'Private Key', 'Group']);

            foreach ($servers as $server) {
                fputcsv($handle, [
                    $server->name,
                    $server->host,
                    $server->port,
                    $server->username,
                    $server->auth_type,
                    $server->password,
                    $server->private_key,
                    $server->group,
                ]);
            }
            fclose($handle);
        }, $filename, ['Content-Type' => 'text/csv']);
    }

    public function render()
    {
        $groups = Server::where('user_id', Auth::id())
            ->whereNotNull('group')
            ->where('group', '!=', '')
            ->distinct()
            ->orderBy('group')
            ->pluck('group');

        $hasUngrouped = Server::where('user_id', Auth::id())
            ->where(function ($q) {
                $q->whereNull('group')->orWhere('group', '');
            })->exists();

        $servers = Server::where('user_id', Auth::id())
            ->when($this->selectedGroup, function ($query) {
                if ($this->selectedGroup === 'ungrouped_hidden_key') {
                    $query->where(function ($q) {
                        $q->whereNull('group')->orWhere('group', '');
                    });
                } else {
                    $query->where('group', $this->selectedGroup);
                }
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('host', 'like', '%'.$this->search.'%')
                        ->orWhere('group', 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy('group')
            ->orderBy('name')
            ->paginate(15);

        return view('livewire.servers.server-list', [
            'servers' => $servers,
            'groups' => $groups,
            'hasUngrouped' => $hasUngrouped,
        ]);
    }
}
