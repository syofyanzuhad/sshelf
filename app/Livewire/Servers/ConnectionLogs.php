<?php

namespace App\Livewire\Servers;

use App\Models\ConnectionLog;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Connection Logs')]
class ConnectionLogs extends Component
{
    use WithPagination;

    public function render()
    {
        $logs = ConnectionLog::query()
            ->with('server')

            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('livewire.servers.connection-logs', [
            'logs' => $logs,
        ])->layout('layouts.app');
    }
}
