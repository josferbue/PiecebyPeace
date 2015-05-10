<?php

class ApplicationsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('application')->delete();

        $pros = Project::whereNull('company_id')->get();

        foreach($pros as $pro_fila){
            $pro_company = $pro_fila;
        }
        $pros = Project::whereNull('ngo_id')->get();

        foreach($pros as $pro_fila){
            $pro_ong = $pro_fila;
        }

        $applications = array(
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 0,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 0,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 0,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 0,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 0,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 0,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 0,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 0,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 0,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 0,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 0,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 0,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),

            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 1,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 1,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 1,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 1,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 1,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 1,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 1,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 1,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),

            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),
            array(
                'moment'      => new DateTime,
                'comments'      => 'Buenas. Me gustaría participar en este proyecto de voluntariado.',
                'result'   => 2,
                'project_id' => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id' => Volunteer::where('name' , '=','Raquel')->first()->id,


            ),


        );

        DB::table('application')->insert( $applications );
    }

}
