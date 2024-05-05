<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SavePermissionsToSession
{
    /**
     * Save the user's permissions to the session after they log in.
     */
    public function handle(Authenticated $event): void
    {
        $user = $event->user;

        if (!$user instanceof User) {
            $user = User::find($user->getAuthIdentifier());
        }

        $permissionNames = $user->getAllPermissions()->pluck('name')->toArray();

        $permissions = array_fill_keys($permissionNames, true);

        session([
            'permissions' => $permissions,
        ]);
    }
}
