<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can manage other users.
     */
    public function manage(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create a user.
     */
    public function create(User $user): bool
    {
        if (config('sshelf.mode') === 'saas') {
            return $user->isAdmin() && ! $user->reachedLimit('members');
        }

        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete a user.
     */
    public function delete(User $user, User $model): bool
    {
        // Prevent deleting yourself
        if ($user->id === $model->id) {
            return false;
        }

        if (config('sshelf.mode') === 'saas') {
            return $user->isAdmin() && $model->parent_id === $user->id;
        }

        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        if (config('sshelf.mode') === 'saas') {
            return $user->isAdmin() && $model->parent_id === $user->id;
        }

        return $user->isAdmin();
    }
}
