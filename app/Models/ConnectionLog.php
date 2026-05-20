<?php

namespace App\Models;

use Database\Factories\ConnectionLogFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConnectionLog extends Model
{
    /** @use HasFactory<ConnectionLogFactory> */
    use HasFactory;

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
}
