<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Database\Factories\ConnectionLogFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class ConnectionLog extends Model
{
    /** @use HasFactory<ConnectionLogFactory> */
    use BelongsToTenant, HasFactory;

    protected $fillable = [
        'server_id',
        'user_id',
        'ip_address',
        'user_agent',
        'connected_at',
        'disconnected_at',
        'status',
        'error',
    ];

    protected $casts = [
        'connected_at' => 'datetime',
        'disconnected_at' => 'datetime',
    ];

    public function server(): BelongsTo
    {
        return $this->belongsTo(Server::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isActive(): bool
    {
        if ($this->status !== 'connected' || $this->disconnected_at) {
            return false;
        }

        return Cache::has("server.{$this->server_id}.worker_pid");
    }
}
