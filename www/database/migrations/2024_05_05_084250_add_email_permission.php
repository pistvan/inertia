<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Create `email` permission and assign it to `admin` and `user` roles.
     */
    public function up(): void
    {
        $emailPermission = Permission::create(['name' => 'send-email']);
        $emailWithAttachmentsPermission = Permission::create(['name' => 'send-email-with-attachments']);

        Role::findByName('admin')->givePermissionTo($emailPermission, $emailWithAttachmentsPermission);
        Role::findByName('user')->givePermissionTo($emailPermission);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We don't have to explicitly remove the permissions from the roles,
        // because of the `DELETE CASCADE` constraint in the `role_has_permissions` table.
        Permission::findByName('send-email')->delete();
        Permission::findByName('send-email-with-attachments')->delete();
    }
};
