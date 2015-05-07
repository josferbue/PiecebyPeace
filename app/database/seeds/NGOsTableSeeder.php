<?php

class NGOsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('ngo')->delete();


        $ngos = array(
            array(
                'name'=>'Green One',
                'banned'=>0,
                'description' => 'Esta ONG se centra en la ayuda a países sudamericanos para evitar la tala masiva de bosques.',
                'phone' => '612345678',
                'active' => true,
                'logo'=> '/logos/testlogos/greenone.jpg',
                'user_id' => User::where('username','=','greenone')->first()->id,
            ),
            array(
                'name'=>'Eat Innovations',
                'banned'=>0,
                'description' => 'Esta ONG se centra en la ayuda a países africanos mediante voluntariado internacional.',
                'phone' => '652258852',
                'active' => true,
                'logo'=> '/logos/testlogos/eat.jpg',
                'user_id' => User::where('username','=','eat')->first()->id,
            ),
            array(
                'name'=>'Elephant Combs',
                'banned'=>0,
                'description' => 'Esta ONG se centra en la ayuda a animales en peligro de extinción.',
                'phone' => '693235412',
                'active' => true,
                'logo'=> '/logos/testlogos/elephant.jpg',
                'user_id' => User::where('username','=','elephant')->first()->id,
            ),
            array(
                'name'=>'Send Square',
                'banned'=>0,
                'description' => 'Esta ONG se centra en la ayuda a personas con problemas psicológicos.',
                'phone' => '684236850',
                'active' => true,
                'logo'=> '/logos/testlogos/send.jpg',
                'user_id' => User::where('username','=','send')->first()->id,
            ),
            array(
                'name'=>'Steps',
                'banned'=>0,
                'description' => 'Esta ONG se centra en realizar proyectos de cooperación al desarrollo.',
                'phone' => '658741023',
                'active' => true,
                'logo'=> '/logos/testlogos/steps.jpg',
                'user_id' => User::where('username','=','steps')->first()->id,
            ),
        );

        DB::table('ngo')->insert( $ngos );
    }

}
