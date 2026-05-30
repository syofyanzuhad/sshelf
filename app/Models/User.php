<?php

namespace App\Models;

use App\Enums\UserRole;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'parent_id',
        'plan',
        'vault_check',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
            'plan' => \App\Enums\Plan::class,
        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function members(): HasMany
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    /**
     * Get the effective owner of the resources.
     */
    public function owner(): User
    {
        if (config('sshelf.mode') === 'saas' && $this->parent_id) {
            return $this->parent;
        }

        return $this;
    }

    public function isMember(): bool
    {
        return config('sshelf.mode') === 'saas' && $this->parent_id !== null;
    }

    public function isAdmin(): bool
    {
        if (config('sshelf.mode') === 'saas') {
            return $this->parent_id === null;
        }

        return $this->role === UserRole::Admin;
    }

    public function reachedLimit(string $feature): bool
    {
        if (config('sshelf.mode') !== 'saas') {
            return false;
        }

        $owner = $this->owner();
        $limit = $owner->plan->limits()[$feature] ?? -1;

        if ($limit === -1) {
            return false;
        }

        $count = match($feature) {
            'servers' => $owner->servers()->count(),
            'ssh_keys' => $owner->sshKeys()->count(),
            'members' => $owner->members()->count(),
            default => 0,
        };

        return $count >= $limit;
    }

    public function servers(): HasMany
    {
        return $this->hasMany(Server::class, 'user_id', 'id');
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }

    public function quickCommands(): HasMany
    {
        return $this->hasMany(QuickCommand::class);
    }

    public function sshKeys(): HasMany
    {
        return $this->hasMany(SshKey::class);
    }
}
