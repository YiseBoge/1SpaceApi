<?php

use Illuminate\Database\Seeder;
use App\Models\Companies\Company;
use App\Models\Companies\Position;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $position = new Position();

        $position->name = 'Bureau Head';
        $position->description = 'Head of Addis Ababa City construction Bureau';
        $position->company_id = Company::first()->id;
        $position->quantity_needed = 10;

        $position->save();

    }
}
