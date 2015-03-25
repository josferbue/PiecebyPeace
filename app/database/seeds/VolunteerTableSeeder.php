<?php

class VolunteerTableSeeder extends Seeder {

    public function run()
    {
        DB::table('volunteer')->delete();
        DB::table('project_volunteer')->delete();


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

        );

        DB::table('volunteer')->insert( $volunteers );


        $project_volunteer = array(
            array(
                'project_id'      => Project::whereNull('company_id')->get()[0]->id,
                'volunteer_id'      => Volunteer::where('name','=','volunteer1')->first()->id,


            ),
            array(
                'project_id'      => Project::whereNull('company_id')->get()[1]->id,
                'volunteer_id'      => Volunteer::where('name','=','volunteer2')->first()->id,

            ),

        );


        DB::table('project_volunteer')->insert( $project_volunteer );

    }

}
