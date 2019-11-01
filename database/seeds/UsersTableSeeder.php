<?php

use App\User;
use App\Models\Companies\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Generics\Address;
use App\Models\Companies\Position;
use App\Models\Companies\Department;
use App\Models\Accounts\FamilyStatus;

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
        $user->password = Hash::make('doniabeje');
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

        FamilyStatus::create([
            'user_id' => $user->id,
        ]);

    }
}
