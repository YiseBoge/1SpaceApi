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

        $department->name = 'Addis Ababa City construction Bureau';
        $department->description = 'Addis Ababa City construction Bureau';
        $department->company_id = Company::first()->id;

        $department->save();
    }
}
