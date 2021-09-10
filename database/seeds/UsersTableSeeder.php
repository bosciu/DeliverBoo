<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;
use App\Address;

class UsersTableSeeder extends Seeder
{
    protected function generateVat(){
        
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i=0; $i < 26 ; $i++ ) { 
            $newAddress = new Address();
            $newAddress->address = $faker->streetAddress();
            $newAddress->city = $faker->city();
            $newAddress->zip_code = $faker->randomNumber(5,true);
            $newAddress->province = $faker->stateAbbr();
            $newAddress->country = $faker->country();
            $newAddress->save();
            
            $newOwner = new User(); 
            $newOwner->address_id = $newAddress->id;
            $newOwner->name = $faker->firstName();
            $newOwner->surname = $faker->lastName();
            $newOwner->phone = $faker->e164PhoneNumber();
            $newOwner->email = $faker->email();
            $newOwner->password = $faker->password();
            $newOwner->vat_number = 'IT'.$faker->randomNumber(9, true);
            $newOwner->company_name = $faker->company();
            $newOwner->save();
        }
    }
}
