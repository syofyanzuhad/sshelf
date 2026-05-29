<?php

namespace App\Livewire\Settings;

use App\Enums\UserRole;
use App\Models\Invitation;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('User Management')]
class Users extends Component
{
    use WithPagination;

    public ?string $invitationLink = null;

    public function mount()
    {
        $this->authorize('manage', User::class);
    }

    public function generateInvitationLink()
    {
        $this->authorize('manage', User::class);

        $invitation = Invitation::create([
            'user_id' => auth()->id(),
            'role' => UserRole::Viewer->value,
            'expires_at' => now()->addDays(7),
        ]);

        $this->invitationLink = route('register', ['invitation' => $invitation->token]);
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
        $query = User::orderBy('name');

        if (config('sshelf.mode') === 'saas') {
            $query->where('parent_id', auth()->id());
        }

        $users = $query->paginate(15);

        return view('livewire.settings.users', [
            'users' => $users,
            'roles' => UserRole::cases(),
        ])->layout('layouts.app');
    }
}
