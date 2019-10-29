<?php

use App\Models\Companies\Role;
use Illuminate\Database\Seeder;
use App\Models\Companies\Company;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();

        $role->name = 'Sys ADMIN';
        $role->description = 'System Administrator';
        $role->company_id = Company::first()->id;

        $role->can_add_user = true;
        $role->can_edit_user = true;
        $role->can_delete_user = true;

        $role->can_add_professional_role = true;
        $role->can_edit_professional_role = true;
        $role->can_delete_professional_role = true;

        $role->can_add_position = true;
        $role->can_edit_position = true;
        $role->can_delete_position = true;

        $role->can_add_department = true;
        $role->can_edit_department = true;
        $role->can_delete_department = true;

        $role->save();

    }
}
