<?php

use App\Models\Companies\Company;
use Illuminate\Database\Seeder;
use App\Models\Companies\Department;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department = new Department();

        $department->name = 'HR';
        $department->description = 'Human Resource';
        $department->company_id = Company::first()->id;

        $department->save();
    }
}
