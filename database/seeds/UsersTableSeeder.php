<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('brands')->delete();
        DB::table('users')->truncate();
        $faker = Faker\Factory::create();

        //create myself
        User::create(array('name' => 'Brent Garner','first' => 'Brent','last' => 'Garner','email' => 'bgarner@gmail.com','group_id' => 1,'email_verified_at' => now(),'password' => bcrypt('ketchup9'),'point_balance' => $faker->numberBetween(0,2500),'social_accounts' => '','level' => $faker->numberBetween(1,9),'address1' => $faker->streetAddress,'address2' => '','city' => $faker->city,'province' => $faker->stateAbbr,'postal_code' => $faker->postcode,'phone1' => $faker->phoneNumber,'phone2' => $faker->phoneNumber));
        //create megha
        User::create(array('name' => 'Megha Jyoti','first' => 'Megha','last' => 'Jyoti','email' => 'jyoti5337@gmail.com','group_id' => 1,'email_verified_at' => now(),'password' => bcrypt('ketchup9'),'point_balance' => $faker->numberBetween(0,2500),'social_accounts' => '','level' => $faker->numberBetween(1,9),'address1' => $faker->streetAddress,'address2' => '','city' => $faker->city,'province' => $faker->stateAbbr,'postal_code' => $faker->postcode,'phone1' => $faker->phoneNumber,'phone2' => $faker->phoneNumber));

        //create sam admin
        User::create(array('name' => 'Sam Hudson','first' => 'Sam','last' => 'Hudson','email' => 'sam.hudson@culturebrand.com','group_id' => 1,'email_verified_at' => now(),'password' => bcrypt('ketchup9'),'point_balance' => $faker->numberBetween(0,2500),'social_accounts' => '','level' => $faker->numberBetween(1,9),'address1' => $faker->streetAddress,'address2' => '','city' => $faker->city,'province' => $faker->stateAbbr,'postal_code' => $faker->postcode,'phone1' => $faker->phoneNumber,'phone2' => $faker->phoneNumber));

        //create sam client
        User::create(array('name' => 'Sam Hudson','first' => 'Sam','last' => 'Hudson','email' => 'sam.hudson@morrisonhomes.ca','group_id' => 2,'email_verified_at' => now(),'password' => bcrypt('ketchup9'),'point_balance' => $faker->numberBetween(0,2500),'social_accounts' => '','level' => $faker->numberBetween(1,9),'address1' => $faker->streetAddress,'address2' => '','city' => $faker->city,'province' => $faker->stateAbbr,'postal_code' => $faker->postcode,'phone1' => $faker->phoneNumber,'phone2' => $faker->phoneNumber));

        //create sam user
        User::create(array('name' => 'Sam Hudson','first' => 'Sam','last' => 'Hudson','email' => 'sam.hudson@gmail.com','group_id' => 3,'email_verified_at' => now(),'password' => bcrypt('ketchup9'),'point_balance' => $faker->numberBetween(0,2500),'social_accounts' => '','level' => $faker->numberBetween(1,9),'address1' => $faker->streetAddress,'address2' => '','city' => $faker->city,'province' => $faker->stateAbbr,'postal_code' => $faker->postcode,'phone1' => $faker->phoneNumber,'phone2' => $faker->phoneNumber));

        User::create(array('name' => 'Jane Believer','first' => 'Jane','last' => 'Believer','email' => 'janebeliever@gmx.com','group_id' => 3,'email_verified_at' => now(),'password' => bcrypt('ketchup9'),'point_balance' => $faker->numberBetween(0,2500),'social_accounts' => '','level' => $faker->numberBetween(1,9),'address1' => $faker->streetAddress,'address2' => '','city' => $faker->city,'province' => $faker->stateAbbr,'postal_code' => $faker->postcode,'phone1' => $faker->phoneNumber,'phone2' => $faker->phoneNumber));

        User::create(array('name' => 'Jesse Read','first' => 'Jesse','last' => 'Read','email' => 'jesse@nerder.com','group_id' => 1,'email_verified_at' => now(),'password' => bcrypt('ketchup9'),'point_balance' => $faker->numberBetween(0,2500),'social_accounts' => '','level' => $faker->numberBetween(1,9),'address1' => $faker->streetAddress,'address2' => '','city' => $faker->city,'province' => $faker->stateAbbr,'postal_code' => $faker->postcode,'phone1' => $faker->phoneNumber,'phone2' => $faker->phoneNumber));



        for($i = 0; $i < 500; $i++) {
            $first = $faker->firstName;
            $last = $faker->lastName;

			$user = User::create(
                array(
                    'name' => $first . " " . $last,
                    'first' => $first,
                    'last' => $last,
                    'email' => $first . "." . $last . "@gmail.com",
                    'group_id' => $faker->numberBetween(1,3),
                    'email_verified_at' => now(),
                    'password' => bcrypt('ketchup9'),
                    'point_balance' => $faker->numberBetween(0,2500),
                    'social_accounts' => '',
                    'image' => 'v1553798722/whyollclfwvrj90o5zyx.jpg',
                    'banner' => 'v1556246965/4000-1.jpg',
                    'level' => $faker->numberBetween(1,9),
                    'address1' => $faker->streetAddress,
                    'address2' => '',
                    'city' => $faker->city,
                    'province' => $faker->stateAbbr,
                    'postal_code' => $faker->postcode,
                    'phone1' => $faker->phoneNumber,
                    'phone2' => $faker->phoneNumber
                )
            );
            $user->save();
		}
    }
}
