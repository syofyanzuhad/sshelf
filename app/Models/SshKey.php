<?php

namespace App\Models;

use App\Casts\EncryptedNullable;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SshKey extends Model
{
    use BelongsToTenant;

    protected $fillable = [
        'user_id',
        'name',
        'public_key',
        'private_key',
        'passphrase',
    ];

    protected $casts = [
        'private_key' => EncryptedNullable::class,
        'passphrase' => EncryptedNullable::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function servers(): HasMany
    {
        return $this->hasMany(Server::class);
    }
}
