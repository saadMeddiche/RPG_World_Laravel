<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class RolesAndPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Potato';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Create Permissions Of Server
        $Manage_Servers = Permission::create(['name' => 'Manage-Servers', 'guard_name' => 'web']);
        $Show_Servers = Permission::create(['name' => 'Show-Servers', 'guard_name' => 'web']);
        $Show_Server = Permission::create(['name' => 'Show-Server', 'guard_name' => 'web']);
        $Add_Server = Permission::create(['name' => 'Add-Server', 'guard_name' => 'web']);
        $Update_Server = Permission::create(['name' => 'Update-Server', 'guard_name' => 'web']);
        $Delete_Server = Permission::create(['name' => 'Delete-Server', 'guard_name' => 'web']);

        //Create Permissions Of Game
        $Manage_Games = Permission::create(['name' => 'Manage-Games', 'guard_name' => 'web']);
        $Show_Games = Permission::create(['name' => 'Show-Games', 'guard_name' => 'web']);
        $Show_Game = Permission::create(['name' => 'Show-Game', 'guard_name' => 'web']);
        $Add_Game = Permission::create(['name' => 'Add-Game', 'guard_name' => 'web']);
        $Update_Game = Permission::create(['name' => 'Update-Game', 'guard_name' => 'web']);
        $Delete_Game = Permission::create(['name' => 'Delete-Game', 'guard_name' => 'web']);

        //Create Permissions Of Role
        $Show_Roles = Permission::create(['name' => 'Show-Roles', 'guard_name' => 'web']);
        $Show_Role = Permission::create(['name' => 'Show-Role', 'guard_name' => 'web']);
        $Add_Role = Permission::create(['name' => 'Add-Role', 'guard_name' => 'web']);
        $Update_Role = Permission::create(['name' => 'Update-Role', 'guard_name' => 'web']);
        $Delete_Role = Permission::create(['name' => 'Delete-Role', 'guard_name' => 'web']);
        $ShowPermissionsOfaRole = Permission::create(['name' => 'ShowPermissionsOfaRole', 'guard_name' => 'web']);
        $ShowRolesOfaPermissions = Permission::create(['name' => 'ShowRolesOfaPermissions', 'guard_name' => 'web']);
        $assignPermissions = Permission::create(['name' => 'assignPermissions', 'guard_name' => 'web']);
        $assignRole = Permission::create(['name' => 'assignRole', 'guard_name' => 'web']);
        $RemovePermissions = Permission::create(['name' => 'RemovePermissions', 'guard_name' => 'web']);
        $RemoveRole = Permission::create(['name' => 'RemoveRole', 'guard_name' => 'web']);

        //Access To All
        $accessToAll = Permission::create(['name' => '*', 'guard_name' => 'web']);

        //Dashboard Permission (Visibility)
        $accessDashboard = Permission::create(['name' => 'accessDashboard', 'guard_name' => 'web']);

        //=================Create Roles=================
        //========Staff
        $Lead_Admin_Role = Role::create(['name' => 'Lead_Admin', 'guard_name' => 'web']);
        $Senior_Admin_Role = Role::create(['name' => 'Senior_Admin', 'guard_name' => 'web']);
        $Admin_Role = Role::create(['name' => 'Admin_Role', 'guard_name' => 'web']);
        //========Memebers
        $Member_Role = Role::create(['name' => 'Member', 'guard_name' => 'web']);
        $Muted_Role = Role::create(['name' => 'Muted', 'guard_name' => 'web']);


        //Assign Permissions to roles
        $Lead_Admin_Role->givePermissionTo($accessToAll);
        $Senior_Admin_Role->givePermissionTo([$Manage_Games, $Manage_Servers, $accessDashboard]);
        $Admin_Role->givePermissionTo([$Manage_Servers, $accessDashboard]);
        $Member_Role->givePermissionTo([$Show_Servers, $Show_Server, $Show_Games, $Show_Game, $Add_Server]);

        // Create Users
        $users = [
            ['name' => 'Lead Admin', 'email' => 'LeadAdmin@gmail.com', 'password' => Hash::make('Password$2004')],
            ['name' => 'Senior Admin', 'email' => 'SeniorAdmin@gmail.com', 'password' => Hash::make('Password$2004')],
            ['name' => 'Admin', 'email' => 'Admin@gmail.com', 'password' => Hash::make('Password$2004')],
            ['name' => 'Aziz', 'email' => 'Aziz@gmail.com', 'password' => Hash::make('Password$2004')],
            ['name' => 'Hassan', 'email' => 'Hassan@gmail.com', 'password' => Hash::make('Password$2004')],
        ];

        for ($i = 0; $i < count($users); $i++) {
            User::create($users[$i]);
        }

        //Get Users
        $Lead_Admin = User::where('name', 'Lead Admin')->first();
        $Senior_Admin = User::where('name', 'Senior Admin')->first();
        $Admin = User::where('name', 'Admin')->first();
        $Aziz = User::where('name', 'Aziz')->first();
        $Hassan = User::where('name', 'Hassan')->first();

        //Asign Role to Users
        $Lead_Admin->assignRole($Lead_Admin_Role);
        $Senior_Admin->assignRole($Senior_Admin_Role);
        $Admin->assignRole($Admin_Role);

        $Lead_Admin->assignRole($Member_Role);
        $Senior_Admin->assignRole($Member_Role);
        $Admin->assignRole($Member_Role);

        $Aziz->assignRole($Member_Role);
        $Hassan->assignRole($Member_Role);

        //Return Mess
        $this->info('Permissions Created Successfuly');
        $this->info('Roles Created Successfuly');
        $this->info('Permissions Affected Successfuly');
        $this->info('Done');
    }
}
