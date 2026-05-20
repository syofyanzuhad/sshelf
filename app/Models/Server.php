<?php

namespace App\Models;

use App\Casts\EncryptedNullable;
use Database\Factories\ServerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Server extends Model
{
    /** @use HasFactory<ServerFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ssh_key_id',
        'name',
        'host',
        'port',
        'username',
        'auth_type',
        'password',
        'private_key',
        'passphrase',
        'group',
        'notes',
        'status',
        'last_checked_at',
        'cpu_usage',
        'memory_usage',
        'disk_usage',
    ];

    protected $casts = [
        'password' => EncryptedNullable::class,
        'private_key' => EncryptedNullable::class,
        'passphrase' => EncryptedNullable::class,
        'port' => 'integer',
        'last_checked_at' => 'datetime',
        'cpu_usage' => 'float',
        'memory_usage' => 'float',
        'disk_usage' => 'float',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sshKey(): BelongsTo
    {
        return $this->belongsTo(SshKey::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function quickCommands(): HasMany
    {
        return $this->hasMany(QuickCommand::class);
    }

    public function connectionLogs(): HasMany
    {
        return $this->hasMany(ConnectionLog::class);
    }
}
