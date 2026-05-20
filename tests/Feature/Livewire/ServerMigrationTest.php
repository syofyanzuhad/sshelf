<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Servers\ServerImport;
use App\Livewire\Servers\ServerList;
use App\Models\Server;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class ServerMigrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_export_servers()
    {
        $user = User::factory()->create();
        Server::factory()->count(3)->create(['user_id' => $user->id]);

        Livewire::actingAs($user)
            ->test(ServerList::class)
            ->call('export')
            ->assertStatus(200)
            ->assertFileDownloaded();
    }

    public function test_can_import_servers_from_json()
    {
        $user = User::factory()->create();

        $data = [
            [
                'name' => 'Imported JSON',
                'host' => '1.2.3.4',
                'port' => 22,
                'username' => 'root',
                'auth_type' => 'password',
                'password' => 'secret',
            ],
        ];

        Storage::fake('tmp-for-tests');
        $file = UploadedFile::fake()->createWithContent('servers.json', json_encode($data));

        Livewire::actingAs($user)
            ->test(ServerImport::class)
            ->set('file', $file)
            ->call('importFile')
            ->assertDispatched('server-saved');

        $this->assertDatabaseHas('servers', ['name' => 'Imported JSON', 'host' => '1.2.3.4']);
    }

    public function test_can_import_servers_from_csv()
    {
        $user = User::factory()->create();

        $csvContent = "Name,Host,Port,Username,Auth Type,Password,Private Key,Group\n";
        $csvContent .= 'Imported CSV,5.6.7.8,22,admin,password,pass123,,Prod';

        Storage::fake('tmp-for-tests');
        $file = UploadedFile::fake()->createWithContent('servers.csv', $csvContent);

        Livewire::actingAs($user)
            ->test(ServerImport::class)
            ->set('file', $file)
            ->call('importFile')
            ->assertDispatched('server-saved');

        $this->assertDatabaseHas('servers', ['name' => 'Imported CSV', 'host' => '5.6.7.8']);
    }

    public function test_can_import_servers_from_ssh_config()
    {
        $user = User::factory()->create();

        $config = "Host my-prod\n  HostName 10.0.0.1\n  User ubuntu\n  Port 2222\n";
        $config .= "Host my-dev\n  HostName 10.0.0.2\n  User debian\n";

        Livewire::actingAs($user)
            ->test(ServerImport::class)
            ->set('sshConfig', $config)
            ->call('importSshConfig')
            ->assertDispatched('server-saved');

        $this->assertDatabaseHas('servers', ['name' => 'my-prod', 'host' => '10.0.0.1', 'port' => 2222, 'username' => 'ubuntu']);
        $this->assertDatabaseHas('servers', ['name' => 'my-dev', 'host' => '10.0.0.2', 'username' => 'debian']);
    }
}
