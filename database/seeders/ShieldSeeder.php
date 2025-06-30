<?php

namespace Database\Seeders;

use BezhanSalleh\FilamentShield\Support\Utils;
use Illuminate\Database\Seeder;

class ShieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = [
            ['name' => 'admin', 'guard_name' => 'web', 'permissions' => []],
            ['name' => 'company_owner', 'guard_name' => 'web', 'permissions' => []],
            ['name' => 'company_driver', 'guard_name' => 'web', 'permissions' => []],
            ['name' => 'company_manager', 'guard_name' => 'web', 'permissions' => []],
            ['name' => 'solo_driver', 'guard_name' => 'web', 'permissions' => []],
            ['name' => 'customer', 'guard_name' => 'web', 'permissions' => []],
        ];
        $directPermissions = [];

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');

        $this->command->call('shield:generate', [
            '--all' => true,
            '--option' => 'permissions',
        ]);
    }

    protected static function makeRolesWithPermissions(array $rolePlusPermissions): void
    {
        if (count($rolePlusPermissions)) {
            // if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions,true))) {

            foreach ($rolePlusPermissions as $rolePlusPermission) {

                $role = Utils::getRoleModel()::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {

                    $permissionModels = collect();

                    collect($rolePlusPermission['permissions'])
                        ->each(function ($permission) use ($permissionModels) {
                            $permissionModels->push(Utils::getPermissionModel()::firstOrCreate([
                                'name' => $permission,
                                'guard_name' => 'web',
                            ]));
                        });
                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(array $permissions): void
    {
        if (count($permissions)) {

            foreach ($permissions as $permission) {

                if (Utils::getPermissionModel()::whereName($permission)->doesntExist()) {
                    Utils::getPermissionModel()::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
