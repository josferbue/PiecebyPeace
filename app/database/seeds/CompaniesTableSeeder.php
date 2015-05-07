<?php

class CompaniesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('company')->delete();


        $companies = array(
            array(
                'name'      => 'Xorysoft',
                'banned'   => 0,
                'sector'   => 'Industrial',
                'description' => 'Esta empresa se dedica al ganado y a temas relacionados con la agricultura sostenible.',
                'phone' => '658987412',
                'active' =>1,
                'logo'=> '/logos/testlogos/xorysoft.png',

                'user_id' => User::where('username','=','xorysoft')->first()->id,



            ),
            array(
                'name'      => 'XeilaAle',
                'banned'   => 0,
                'sector'   => 'Comercial',
                'description' => 'En esta empresa se trabaja el acero inoxidable principalmente.',
                'phone' => '622211365',
                'active' =>1,
                'logo'=> '/logos/testlogos/xeilaale.png',
                'user_id' => User::where('username','=','xeilaale')->first()->id,


            ),
            array(
                'name'      => 'Boliri Association',
                'banned'   => 0,
                'sector'   => 'Servicios',
                'description' => 'En esta empresa se ayuda al cliente a no gastar dinero innecesariamente.',
                'phone' => '635256458',
                'active' =>1,
                'logo'=> '/logos/testlogos/boliri.png',
                'user_id' => User::where('username','=','boliri')->first()->id,


            ),
            array(
                'name'      => 'Jaylodet',
                'banned'   => 0,
                'sector'   => 'Comercial',
                'description' => 'En esta empresa se trabaja con telas importadas de todo el mundo.',
                'phone' => '691258752',
                'active' =>1,
                'logo'=> '/logos/testlogos/jaylodet.png',
                'user_id' => User::where('username','=','jaylodet')->first()->id,


            ),
            array(
                'name'      => 'Chaos',
                'banned'   => 0,
                'sector'   => 'Industrial',
                'description' => 'La empresa Chaos está centrada en el aseguramiento de la calidad.',
                'phone' => '654258753',
                'active' =>1,
                'logo'=> '/logos/testlogos/chaos.jpg',
                'user_id' => User::where('username','=','chaos')->first()->id,


            ),

        );

        DB::table('company')->insert( $companies );
    }

}
