<?php

namespace App\Livewire\Servers;

use App\Models\Server;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class ServerImport extends Component
{
    use WithFileUploads;

    public $file;

    public string $sshConfig = '';

    public string $tab = 'file';

    public function importFile()
    {
        $this->validate([
            'file' => 'required|file|max:1024',
        ]);

        $extension = $this->file->getClientOriginalExtension();
        $path = $this->file->getRealPath();

        if ($extension === 'json') {
            $this->processJson(file_get_contents($path));
        } elseif ($extension === 'csv') {
            $this->processCsv($path);
        } else {
            session()->flash('error', 'Unsupported file format. Please use JSON or CSV.');
        }
    }

    public function importSshConfig()
    {
        $this->validate([
            'sshConfig' => 'required|string',
        ]);

        $servers = $this->parseSshConfig($this->sshConfig);
        $this->createServers($servers);

        $this->finishImport(count($servers));
    }

    private function processJson(string $content)
    {
        $data = json_decode($content, true);
        if (! is_array($data)) {
            session()->flash('error', 'Invalid JSON format.');

            return;
        }

        $this->createServers($data);
        $this->finishImport(count($data));
    }

    private function processCsv(string $path)
    {
        $servers = [];
        if (($handle = fopen($path, 'r')) !== false) {
            $header = fgetcsv($handle); // Assuming first row is header
            while (($row = fgetcsv($handle)) !== false) {
                $servers[] = [
                    'name' => $row[0] ?? 'Imported',
                    'host' => $row[1] ?? '',
                    'port' => $row[2] ?? 22,
                    'username' => $row[3] ?? '',
                    'auth_type' => $row[4] ?? 'password',
                    'password' => $row[5] ?? null,
                    'private_key' => $row[6] ?? null,
                    'group' => $row[7] ?? null,
                ];
            }
            fclose($handle);
        }

        $this->createServers($servers);
        $this->finishImport(count($servers));
    }

    private function parseSshConfig(string $config)
    {
        $servers = [];
        $current = null;

        foreach (explode("\n", $config) as $line) {
            $line = trim($line);
            if (empty($line) || str_starts_with($line, '#')) {
                continue;
            }

            $parts = preg_split('/\s+/', $line, 2);
            if (count($parts) < 2) {
                continue;
            }

            $key = strtolower($parts[0]);
            $value = trim($parts[1], '"\' ');

            if ($key === 'host') {
                if ($current && ! empty($current['host'])) {
                    $servers[] = $current;
                }
                $current = ['name' => $value, 'port' => 22, 'auth_type' => 'password', 'group' => 'SSH Config'];
            } elseif ($current) {
                if ($key === 'hostname') {
                    $current['host'] = $value;
                } elseif ($key === 'user') {
                    $current['username'] = $value;
                } elseif ($key === 'port') {
                    $current['port'] = (int) $value;
                } elseif ($key === 'identityfile') {
                    $current['auth_type'] = 'key';
                    $current['notes'] = ($current['notes'] ?? '')." IdentityFile: $value\n";
                }
            }
        }
        if ($current && ! empty($current['host'])) {
            $servers[] = $current;
        }

        return $servers;
    }

    private function createServers(array $data)
    {
        foreach ($data as $item) {
            Server::create([
                'user_id' => Auth::id(),
                'name' => $item['name'] ?? 'Imported Server',
                'host' => $item['host'] ?? '',
                'port' => $item['port'] ?? 22,
                'username' => $item['username'] ?? '',
                'auth_type' => $item['auth_type'] ?? 'password',
                'password' => $item['password'] ?? null,
                'private_key' => $item['private_key'] ?? null,
                'passphrase' => $item['passphrase'] ?? null,
                'group' => $item['group'] ?? null,
                'notes' => $item['notes'] ?? null,
            ]);
        }
    }

    private function finishImport(int $count)
    {
        $this->dispatch('server-saved');
        $this->dispatch('close-modal', 'server-import-modal');
        $this->reset(['file', 'sshConfig']);
        session()->flash('message', "Successfully imported {$count} servers.");
    }

    public function render()
    {
        return view('livewire.servers.server-import');
    }
}
