<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Database\Factories\QuickCommandFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuickCommand extends Model
{
    /** @use HasFactory<QuickCommandFactory> */
    use BelongsToTenant, HasFactory;

    protected $fillable = [
        'user_id',
        'server_id',
        'name',
        'command',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function server(): BelongsTo
    {
        return $this->belongsTo(Server::class);
    }
}
