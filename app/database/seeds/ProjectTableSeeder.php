<?php

class ProjectTableSeeder extends Seeder {

    public function run()
    {
        DB::table('project')->delete();


        $pro = array(
            array(
                'name'          => 'Project 1',
                'description'   => 'Example project 1',
                'address'       => 'C\\Utrera Nº 25',
                'city'          => 'Sevilla',
                'zipcode'       => '41700',
                'maxVolunteers' => 20,
                'startDate'     => \Carbon\Carbon::createFromDate(2015,7,23)->toDateTimeString(),
                'finishDate'    => \Carbon\Carbon::createFromDate(2015,8,23)->toDateTimeString(),
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
                'ngo_id'        => (int)DB::table('ngo')->first()->id,
                'company_id'    => null,


            ),
            array(
                'name'          => 'Project 2',
                'description'   => 'Example project 2',
                'address'       => 'C\\Navaja Nº 3',
                'city'          => 'Huelva',
                'zipcode'       => '47200',
                'maxVolunteers' => 20,
                'startDate'     => \Carbon\Carbon::createFromDate(2015,7,23)->toDateTimeString(),
                'finishDate'    => \Carbon\Carbon::createFromDate(2015,8,23)->toDateTimeString(),
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
                'ngo_id'        => null,
                'company_id'    => (int)DB::table('company')->first()->id,


            ),

        );

        DB::table('project')->insert( $pro );
    }

}
