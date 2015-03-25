<?php

class CompanyTableSeeder extends Seeder {

    public function run()
    {
        DB::table('company')->delete();


        $companies = array(
            array(
                'name'      => 'company1',
                'email'      => 'company1@example.org',
                'banned'   => 0,
                'sector'   => 'sector1',
                'description' => 'descripcion',
                'phone' => '646464646',
                'active' =>1,
                'user_id' => User::where('username','=','company1')->first()->id,
                'project_id' => Project::whereNull('ngo_id')->get()[0]->id,


            ),
            array(
                'name'      => 'company2',
                'email'      => 'company2@example.org',
                'banned'   => 0,
                'sector'   => 'sector2',
                'description' => 'descripcion2',
                'phone' => '622211365',
                'active' =>1,
                'user_id' => User::where('username','=','company2')->first()->id,
                'project_id' => Project::whereNull('ngo_id')->get()[1]->id,

            ),

        );

        DB::table('company')->insert( $companies );
    }

}
