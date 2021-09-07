<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class SuperAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newUser = new User();
        $newUser->name = "Admin";
        $newUser->surname = "super";
        $newUser->phone = "3330000";
        $newUser->email = "admin@admin.it";
        $newUser->password = Hash::make('12345678');
        $newUser->vat_number = "IT00000";
        $newUser->company_name = "PlutoIT";
        $newUser->address_id = 1;
        $newUser->save();
    }
}
