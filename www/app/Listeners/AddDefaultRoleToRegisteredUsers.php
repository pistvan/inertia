<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Spatie\Permission\Models\Role;

class AddDefaultRoleToRegisteredUsers
{
    /**
     * The default role name, which will be assigned to the registered users.
     */
    protected const DEFAULT_ROLE_NAME = 'user';

    public function handle(Registered $event): void
    {
        $user = $event->user;

        if (!$user instanceof User) {
            $user = User::find($user->getAuthIdentifier());
        }

        $role = Role::findByName(self::DEFAULT_ROLE_NAME);

        $user->roles()->attach($role);
    }
}
