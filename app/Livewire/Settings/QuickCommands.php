<?php

namespace App\Livewire\Settings;

use App\Models\QuickCommand;
use App\Models\Server;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class QuickCommands extends Component
{
    use WithPagination;

    public $editing = null;
    public $name = '';
    public $command = '';
    public $server_id = null;

    protected $rules = [
        'name' => 'required|string|max:255',
        'command' => 'required|string',
        'server_id' => 'nullable|exists:servers,id',
    ];

    public function create()
    {
        $this->reset(['editing', 'name', 'command', 'server_id']);
        $this->dispatch('open-modal', 'quick-command-modal');
    }

    public function edit(QuickCommand $quickCommand)
    {
        $this->authorize('update', $quickCommand);
        $this->editing = $quickCommand;
        $this->name = $quickCommand->name;
        $this->command = $quickCommand->command;
        $this->server_id = $quickCommand->server_id;
        $this->dispatch('open-modal', 'quick-command-modal');
    }

    public function save()
    {
        $this->validate();

        $data = [
            'user_id' => Auth::id(),
            'name' => $this->name,
            'command' => $this->command,
            'server_id' => $this->server_id ?: null,
        ];

        if ($this->editing) {
            $this->editing->update($data);
        } else {
            QuickCommand::create($data);
        }

        $this->dispatch('close-modal', 'quick-command-modal');
        $this->reset(['editing', 'name', 'command', 'server_id']);
    }

    public function delete(QuickCommand $quickCommand)
    {
        $this->authorize('delete', $quickCommand);
        $quickCommand->delete();
    }

    public function render()
    {
        $quickCommands = QuickCommand::where('user_id', Auth::id())
            ->with('server')
            ->orderBy('name')
            ->paginate(10);

        $servers = Server::where('user_id', Auth::id())->orderBy('name')->get();

        return view('livewire.settings.quick-commands', [
            'quickCommands' => $quickCommands,
            'servers' => $servers,
        ]);
    }
}
