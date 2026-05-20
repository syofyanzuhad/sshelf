<?php

namespace App\Livewire\Settings;

use App\Enums\UserRole;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public function mount()
    {
        $this->authorize('manage', User::class);
    }

    public function changeRole(User $user, string $role)
    {
        $this->authorize('update', $user);

        try {
            $newRole = UserRole::from($role);
            $user->update(['role' => $newRole]);
            session()->flash('message', "User {$user->email} updated to {$newRole->label()}.");
        } catch (\ValueError $e) {
            session()->flash('error', 'Invalid role selected.');
        }
    }

    public function delete(User $user)
    {
        $this->authorize('delete', $user);

        $email = $user->email;
        $user->delete();

        session()->flash('message', "User {$email} deleted successfully.");
    }

    public function render()
    {
        $users = User::orderBy('name')
            ->paginate(15);

        return view('livewire.settings.users', [
            'users' => $users,
            'roles' => UserRole::cases(),
        ])->layout('layouts.app');
    }
}
