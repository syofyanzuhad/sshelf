<?php

namespace App\Policies;

use App\Models\QuickCommand;
use App\Models\User;

class QuickCommandPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, QuickCommand $quickCommand): bool
    {
        return $user->id === $quickCommand->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, QuickCommand $quickCommand): bool
    {
        return $user->id === $quickCommand->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, QuickCommand $quickCommand): bool
    {
        return $user->id === $quickCommand->user_id;
    }
}
