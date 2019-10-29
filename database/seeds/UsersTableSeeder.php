<?php

use App\Models\Companies\Department;
use App\Models\Companies\Position;
use App\Models\Companies\Role;
use App\Models\Generics\Address;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();

        $user->email = "abeje.doni@gmail.com";
        $user->phone_number = "0926388050";
        $user->password = bcrypt('doniabeje');
        $user->sex = "Male";

        $user->department_id = Department::first()->id;
        $user->position_id = Position::first()->id;
        $user->role_id = Role::first()->id;

        $user->personal_name = "Doni";
        $user->father_name = "Abeje";
        $user->grand_father_name = "Abiy";

        $address = Address::create();
        $user->address_id = $address->id;
        $user->save();

    }
}
