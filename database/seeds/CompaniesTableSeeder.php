<?php

use Illuminate\Database\Seeder;
use App\Models\Companies\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = new Company();
        $company->name = 'AACCB';
        $company->category = 'Government';
        $company->description = 'Addis Ababa City Construction Bureau';
        $company->save();
    }
}
