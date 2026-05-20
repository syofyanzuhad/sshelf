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
     * Determine whether the user can delete a user.
     */
    public function delete(User $user, User $model): bool
    {
        // Prevent deleting yourself
        return $user->isAdmin() && $user->id !== $model->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $user->isAdmin();
    }
}
