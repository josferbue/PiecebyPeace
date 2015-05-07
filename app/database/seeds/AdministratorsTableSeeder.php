<?php

class AdministratorsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('administrator')->delete();


        $administrators = array(
            array(
                'name'      => 'Rafael',
                'banned'      => false,
                'user_id' => User::where('username','=','admin')->first()->id,
            ),

        );

        DB::table('administrator')->insert( $administrators );
    }

}
