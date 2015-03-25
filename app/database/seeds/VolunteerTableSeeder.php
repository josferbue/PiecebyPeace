<?php

class VolunteerTableSeeder extends Seeder {

    public function run()
    {
       // $user_id = User::first()->id;
        DB::table('volunteer')->delete();


        $volunteers = array(
            array(
                'name'      => 'volunteer1',
                'email'      => 'volunteer1@example.org',
                'banned'   => 0,
                'surname'   => 'surname1',
                'address'   => 'address1',
                'city'   => 'Sevilla',
                'zipCode'   => '49999',
                'country'   => 'España',
                'biography' => 'biography1',


            ),
            array(
                'name'      => 'volunteer2',
                'email'      => 'volunteer2@example.org',
                'banned'   => 0,
                'surname'   => 'surname2',
                'address'   => 'address2',
                'city'   => 'Madrid',
                'zipCode'   => '47856',
                'country'   => 'España',
                'biography' => 'biography2',

            ),
            array(
                'name'      => 'volunteer3',
                'email'      => 'volunteer3@example.org',
                'banned'   => 0,
                'surname'   => 'surname3',
                'address'   => 'address3',
                'city'   => 'Valencia',
                'zipCode'   => '47889',
                'country'   => 'España',
                'biography' => 'biography1',

            ),
        );

        DB::table('volunteer')->insert( $volunteers );
    }

}
