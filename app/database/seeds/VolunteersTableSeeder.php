<?php

class VolunteersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('volunteer')->delete();
        DB::table('project_volunteer')->delete();


        $volunteers = array(
            array(
                'name'      => 'Manuel',
                'banned'   => 0,
                'surname'   => 'Bernúdez',
                'address'   => 'C/ Lavanda nº3',
                'city'   => 'Sevilla',
                'zipCode'   => '41012',
                'country'   => 'España',
                'biography' => '',
                'user_id' => User::where('username','=','manu')->first()->id,

            ),
            array(
                'name'      => 'María',
                'banned'   => 0,
                'surname'   => 'Castrillón',
                'address'   => 'C/ Guadalhorce nº4',
                'city'   => 'Madrid',
                'zipCode'   => '28052',
                'country'   => 'España',
                'biography' => '',
                'user_id' => User::where('username','=','maria')->first()->id,
            ),
            array(
                'name'      => 'Carlos',
                'banned'   => 0,
                'surname'   => 'Andrade',
                'address'   => 'C/ Guadalhorce nº5',
                'city'   => 'Madrid',
                'zipCode'   => '28052',
                'country'   => 'España',
                'biography' => '',
                'user_id' => User::where('username','=','carlos')->first()->id,
            ),
            array(
                'name'      => 'Jose',
                'banned'   => 0,
                'surname'   => 'Fernández',
                'address'   => 'C/ Guadalhorce nº64',
                'city'   => 'Madrid',
                'zipCode'   => '28052',
                'country'   => 'España',
                'biography' => '',
                'user_id' => User::where('username','=','jose')->first()->id,
            ),
            array(
                'name'      => 'Marta',
                'banned'   => 0,
                'surname'   => 'Capote',
                'address'   => 'C/ Guadalhorce nº6',
                'city'   => 'Madrid',
                'zipCode'   => '28052',
                'country'   => 'España',
                'biography' => '',
                'user_id' => User::where('username','=','marta')->first()->id,
            ),
            array(
                'name'      => 'Fernando',
                'banned'   => 0,
                'surname'   => 'Márquez',
                'address'   => 'C/ Guadalhorce nº7',
                'city'   => 'Madrid',
                'zipCode'   => '28052',
                'country'   => 'España',
                'biography' => '',
                'user_id' => User::where('username','=','fernando')->first()->id,
            ),
            array(
                'name'      => 'Antonio',
                'banned'   => 0,
                'surname'   => 'Jiménez',
                'address'   => 'C/ Guadalhorce nº8',
                'city'   => 'Madrid',
                'zipCode'   => '28052',
                'country'   => 'España',
                'biography' => '',
                'user_id' => User::where('username','=','antonio')->first()->id,
            ),
            array(
                'name'      => 'Rafael',
                'banned'   => 0,
                'surname'   => 'Herrera',
                'address'   => 'C/ Guadalhorce nº9',
                'city'   => 'Madrid',
                'zipCode'   => '28052',
                'country'   => 'España',
                'biography' => '',
                'user_id' => User::where('username','=','rafael')->first()->id,
            ),
            array(
                'name'      => 'Juan',
                'banned'   => 0,
                'surname'   => 'Segura',
                'address'   => 'C/ Guadalhorce nº10',
                'city'   => 'Madrid',
                'zipCode'   => '28052',
                'country'   => 'España',
                'biography' => '',
                'user_id' => User::where('username','=','juan')->first()->id,
            ),
            array(
                'name'      => 'Raquel',
                'banned'   => 0,
                'surname'   => 'Cumplido',
                'address'   => 'C/ Guadalhorce nº11',
                'city'   => 'Madrid',
                'zipCode'   => '28052',
                'country'   => 'España',
                'biography' => '',
                'user_id' => User::where('username','=','raquel')->first()->id,
            ),
            array(
                'name'      => 'Isabel',
                'banned'   => 0,
                'surname'   => 'Ocaña',
                'address'   => 'C/ Clara Campoamor nº3',
                'city'   => 'Vejer de la Frontera',
                'zipCode'   => '11150',
                'country'   => 'España',
                'biography' => '',
                'user_id' => User::where('username','=','isabel')->first()->id,
            ),
            array(
                'name'      => 'Pablo',
                'banned'   => 0,
                'surname'   => 'Rodríguez',
                'address'   => 'C/ Guadalhorce nº65',
                'city'   => 'Madrid',
                'zipCode'   => '28052',
                'country'   => 'España',
                'biography' => '',
                'user_id' => User::where('username','=','pablo')->first()->id,
            ),

        );

        DB::table('volunteer')->insert( $volunteers );

        $project_volunteer = array(
            array(
                'project_id'      => Project::where('company_id','=',Company::where('user_id','=',User::where('username','=','boliri')->first()->id)->first()->id)->first()->id,
                'volunteer_id'    => Volunteer::where('name','=','Raquel')->first()->id,
            ),
            array(
                'project_id'      => Project::where('company_id','=',Company::where('user_id','=',User::where('username','=','boliri')->first()->id)->first()->id)->first()->id,
                'volunteer_id'    => Volunteer::where('name','=','Isabel')->first()->id,
            ),
            array(
                'project_id'      => Project::where('company_id','=',Company::where('user_id','=',User::where('username','=','boliri')->first()->id)->first()->id)->first()->id,
                'volunteer_id'    => Volunteer::where('name','=','Jose')->first()->id,
            ),
            array(
                'project_id'      => Project::where('company_id','=',Company::where('user_id','=',User::where('username','=','boliri')->first()->id)->first()->id)->first()->id,
                'volunteer_id'    => Volunteer::where('name','=','Fernando')->first()->id,
            ),
            array(
                'project_id'      => Project::where('company_id','=',Company::where('user_id','=',User::where('username','=','boliri')->first()->id)->first()->id)->first()->id,
                'volunteer_id'    => Volunteer::where('name','=','Manuel')->first()->id,
            ),
            array(
                'project_id'      => Project::where('company_id','=',Company::where('user_id','=',User::where('username','=','boliri')->first()->id)->first()->id)->first()->id,
                'volunteer_id'    => Volunteer::where('name','=','Juan')->first()->id,
            ),
            array(
                'project_id'      => Project::where('company_id','=',Company::where('user_id','=',User::where('username','=','boliri')->first()->id)->first()->id)->first()->id,
                'volunteer_id'    => Volunteer::where('name','=','Rafael')->first()->id,
            ),
            array(
                'project_id'      => Project::where('company_id','=',Company::where('user_id','=',User::where('username','=','boliri')->first()->id)->first()->id)->first()->id,
                'volunteer_id'    => Volunteer::where('name','=','Antonio')->first()->id,
            ),


            array(
                'project_id'      => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id'    => Volunteer::where('name','=','Antonio')->first()->id,
            ),
            array(
                'project_id'      => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id'    => Volunteer::where('name','=','Rafael')->first()->id,
            ),
            array(
                'project_id'      => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id'    => Volunteer::where('name','=','Juan')->first()->id,
            ),
            array(
                'project_id'      => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id'    => Volunteer::where('name','=','Manuel')->first()->id,
            ),
            array(
                'project_id'      => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id'    => Volunteer::where('name','=','María')->first()->id,
            ),
            array(
                'project_id'      => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id'    => Volunteer::where('name','=','Carlos')->first()->id,
            ),
            array(
                'project_id'      => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id'    => Volunteer::where('name','=','Jose')->first()->id,
            ),
            array(
                'project_id'      => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id'    => Volunteer::where('name','=','Marta')->first()->id,
            ),
            array(
                'project_id'      => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id'    => Volunteer::where('name','=','Fernando')->first()->id,
            ),
            array(
                'project_id'      => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id'    => Volunteer::where('name','=','Raquel')->first()->id,
            ),
            array(
                'project_id'      => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id'    => Volunteer::where('name','=','Isabel')->first()->id,
            ),
            array(
                'project_id'      => Project::where('ngo_id','=',Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id)->first()->id,
                'volunteer_id'    => Volunteer::where('name','=','Pablo')->first()->id,
            ),

        );

        DB::table('project_volunteer')->insert( $project_volunteer );

    }

}
