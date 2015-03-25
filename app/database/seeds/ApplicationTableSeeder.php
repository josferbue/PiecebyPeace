<?php

class ApplicationTableSeeder extends Seeder {

    public function run()
    {
        DB::table('application')->delete();


        $applications = array(
            array(
                'moment'      => new DateTime,
                'comments'      => 'comments1',
                'result'   => 0,
                'project_id' => Project::whereNull('company_id')->get()[0]->id,
                'volunteer_id' => Volunteer::whereNull('name' , '=','volunteer2')->first()->id,


            ),

            array(
                'moment'      => new DateTime,
                'comments'      => 'comments2',
                'result'   => 0,
                'project_id' => Project::whereNull('company_id')->get()[1]->id,
                'volunteer_id' => Volunteer::whereNull('name' , '=','volunteer2')->first()->id,

            ),

        );

        DB::table('application')->insert( $applications );
    }

}
