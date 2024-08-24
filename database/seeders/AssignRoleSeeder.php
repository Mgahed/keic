<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laratrust\Models\Permission;
use Laratrust\Models\Role;

class AssignRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::create([
            'name' => 'super-admin',
            'display_name' => 'Super Admin',
            'description' => 'Super Admin Role',
        ]);
        $user = User::where('nid', '29805180200352')->first();
        if ($user) {
            $user->addRole($superAdminRole);
        }
        $adminRole = Role::create([
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'Admin Role',
        ]);
        $memberRole = Role::create([
            'name' => 'member',
            'display_name' => 'Member',
            'description' => 'Member Role',
        ]);

        $permission = [
            [
                'name' => 'lookup-create',
                'display_name' => 'Lookup Create',
                'description' => 'Lookup Create'
            ],
            [
                'name' => 'lookup-edit',
                'display_name' => 'Lookup Edit',
                'description' => 'Lookup Edit'
            ],
            [
                'name' => 'lookup-delete',
                'display_name' => 'Lookup Delete',
                'description' => 'Lookup Delete'
            ],
            [
                'name' => 'memberShip-create',
                'display_name' => 'MemberShip Create',
                'description' => 'MemberShip Create'
            ],
            [
                'name' => 'memberShip-edit',
                'display_name' => 'MemberShip Edit',
                'description' => 'MemberShip Edit'
            ],
            [
                'name' => 'memberShip-delete',
                'display_name' => 'MemberShip Delete',
                'description' => 'MemberShip Delete'
            ],
            [
                'name' => 'memberShipType-create',
                'display_name' => 'MemberShipType Create',
                'description' => 'MemberShipType Create'
            ],
            [
                'name' => 'memberShipType-edit',
                'display_name' => 'MemberShipType Edit',
                'description' => 'MemberShipType Edit'
            ],
            [
                'name' => 'memberShipType-delete',
                'display_name' => 'MemberShipType Delete',
                'description' => 'MemberShipType Delete'
            ],
            [
                'name' => 'academicStage-create',
                'display_name' => 'AcademicStage Create',
                'description' => 'AcademicStage Create'
            ],
            [
                'name' => 'academicStage-edit',
                'display_name' => 'AcademicStage Edit',
                'description' => 'AcademicStage Edit'
            ],
            [
                'name' => 'academicStage-delete',
                'display_name' => 'AcademicStage Delete',
                'description' => 'AcademicStage Delete'
            ],
            [
                'name' => 'user-create',
                'display_name' => 'User Create',
                'description' => 'User Create'
            ],
            [
                'name' => 'user-edit',
                'display_name' => 'User Edit',
                'description' => 'User Edit'
            ],
            [
                'name' => 'user-delete',
                'display_name' => 'User Delete',
                'description' => 'User Delete'
            ],
            [
                'name' => 'user-assign-role',
                'display_name' => 'User Assign Role',
                'description' => 'User Assign Role'
            ],
            [
                'name' => 'user-assign-permission',
                'display_name' => 'User Assign Permission',
                'description' => 'User Assign Permission'
            ],
            [
                'name' => 'check-user-active',
                'display_name' => 'Check User Active',
                'description' => 'Check if user active or not and check if he is a member or not'
            ]
        ];

        foreach ($permission as $value) {
            Permission::create($value);
        }

        // assign all permissions to super admin
        $superAdminRole->syncPermissions(Permission::all());
    }
}
