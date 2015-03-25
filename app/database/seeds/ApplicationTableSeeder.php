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
                ),

            array(
                'moment'      => new DateTime,
                'comments'      => 'comments2',
                'result'   => 0,
            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'comments3',
                'result'   => 0,
            ),
        );

        DB::table('application')->insert( $applications );
    }

}
