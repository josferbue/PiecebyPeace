<?php

class NGOsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('ngo')->delete();


        $ngos = array(
            array(
                'name'=>'NGO-1',
                'banned'=>0,
                'description' => 'NGO1 NGO1 NGO1 NGO1',
                'phone' => '612345678',
                'active' => true,
                'logo'=> '/logos/imageNotFound.gif',
                'user_id' => User::where('username','=','ngo1')->first()->id,
            ),
            array(
                'name'=>'NGO-2',
                'banned'=>0,
                'description' => 'NGO2 NGO2 NGO2 NGO2',
                'phone' => '687654321',
                'active' => true,
                'logo'=> '/logos/imageNotFound.gif',
                'user_id' => User::where('username','=','ngo2')->first()->id,
            ),
        );

        DB::table('ngo')->insert( $ngos );
    }

}
