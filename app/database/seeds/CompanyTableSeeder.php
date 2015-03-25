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

            ),
            array(
                'name'      => 'company2',
                'email'      => 'company2@example.org',
                'banned'   => 0,
                'sector'   => 'sector2',
                'description' => 'descripcion2',
                'phone' => '622211365',
                'active' =>1,

            ),
            array(
                'name'      => 'company3',
                'email'      => 'company3@example.org',
                'banned'   => 1,
                'sector'   => 'sector3',
                'description' => 'descripcion3',
                'phone' => '634417896',
                'active' =>1,

            ),
        );

        DB::table('company')->insert( $companies );
    }

}
