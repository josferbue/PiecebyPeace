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

        );

        DB::table('volunteer')->insert( $volunteers );
/*        $pros = Project::whereNull('company_id')->get();

        foreach($pros as $pro_fila){
            $pro_company = $pro_fila;
        }
        $pros = Project::whereNull('ngo_id')->get();

        foreach($pros as $pro_fila){
            $pro_ong = $pro_fila;
        }

        $project_volunteer = array(
            array(
                'project_id'      => (int)$pro_company["id"],
                'volunteer_id'    => Volunteer::where('name','=','volunteer1')->first()->id,


            ),
            array(
                'project_id'      => (int)$pro_ong["id"],
                'volunteer_id'    => Volunteer::where('name','=','volunteer2')->first()->id,

            ),

        );


        DB::table('project_volunteer')->insert( $project_volunteer );*/

    }

}
