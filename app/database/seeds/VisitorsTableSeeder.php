<?php

class VisitorsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('visitor')->delete();

        $visitors = array(

            array(
                'ipAddress'      => '1.2.3.4',
                'campaign_id'    => Campaign::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','steps')->first()->id)->first()->id)->first()->id,
            ),
            array(
                'ipAddress'      => '1.2.3.4',
                'campaign_id'    => Campaign::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','steps')->first()->id)->first()->id)->first()->id,
            ),

        );

        DB::table('visitor')->insert( $visitors );
    }

}
