<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class SetupRolesAndPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:roles-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up roles and permissions for the complaint management system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Setting up roles and permissions...');

        // Create permissions
        $permissions = [
            'view complaints',
            'create complaints',
            'edit complaints',
            'delete complaints',
            'manage users',
            'view dashboard',
            'manage settings'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
            $this->info("Created permission: {$permission}");
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $userRole = Role::firstOrCreate(['name' => 'User']);
        $managerRole = Role::firstOrCreate(['name' => 'Manager']);

        $this->info('Created roles: Admin, User, Manager');

        // Assign permissions to roles
        $adminRole->givePermissionTo($permissions); // Admin gets all permissions
        $userRole->givePermissionTo(['view complaints', 'create complaints', 'view dashboard']);
        $managerRole->givePermissionTo(['view complaints', 'create complaints', 'edit complaints', 'view dashboard']);

        $this->info('Assigned permissions to roles');

        // Assign default role to existing users without roles
        $usersWithoutRoles = User::whereDoesntHave('roles')->get();
        foreach ($usersWithoutRoles as $user) {
            $user->assignRole($userRole);
            $this->info("Assigned User role to: {$user->name}");
        }

        $this->info('Roles and permissions setup completed!');
    }
}