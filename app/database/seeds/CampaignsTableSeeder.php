<?php

class CampaignsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('campaign')->delete();

        $campaigns = array(
            array(
                'name'      => 'Campaña para apoyar a las personas discapacitadas',
                'description'      => 'Esta es una campaña de concienciación y de ayuda a las personas con alguna discapacidad.',
                'image'=> '/logos/testlogos/dis.jpg',
                'startDate'   => \Carbon\Carbon::createFromDate(2014,7,23)->toDateTimeString(),
                'finishDate' => \Carbon\Carbon::createFromDate(2014,8,23)->toDateTimeString(),
                'visits' => 872,
                'link' => 'https://www.fundacionmapfre.org/fundacion/es_es/accion-social/discapacidad/apoyo-familiar/',
                'maxVisits' => 5000,
                'expirationDate' => \Carbon\Carbon::createFromDate(2015,7,15)->toDateTimeString(),
                'ngo_id' => Ngo::where('user_id','=',User::where('username','=','send')->first()->id)->first()->id,
            ),
            array(
                'name'      => 'Contra el abuso infantil',
                'description'      => 'Esta campaña de concienciación trata de combatir el abuso infantil, tanto físico como emocional.',
                'image'=> '/logos/testlogos/infantil.jpg',
                'startDate'   => \Carbon\Carbon::createFromDate(2015,8,23)->toDateTimeString(),
                'finishDate' => \Carbon\Carbon::createFromDate(2015,9,23)->toDateTimeString(),
                'visits' => 180,
                'link' => 'http://www.humanium.org/es/abuso-infantil/',
                'maxVisits' => 1000,
                'expirationDate' => \Carbon\Carbon::createFromDate(2015,8,20)->toDateTimeString(),
                'ngo_id' => Ngo::where('user_id','=',User::where('username','=','steps')->first()->id)->first()->id,
            ),
            array(
                'name'      => 'Campaña de recaudación de fondos',
                'description'      => 'Esta campaña tiene como objetivo la recaudación de fondos para proyectos de voluntariado.',
                'image'=> '/logos/testlogos/crowdfunding.jpg',
                'startDate'   => \Carbon\Carbon::createFromDate(2015,7,23)->toDateTimeString(),
                'finishDate' => \Carbon\Carbon::createFromDate(2015,8,23)->toDateTimeString(),
                'visits' => 190,
                'link' => 'http://nayanagar.org/post/67062526840/agenda',
                'maxVisits' => 1000,
                'expirationDate' => \Carbon\Carbon::createFromDate(2015,7,15)->toDateTimeString(),
                'ngo_id' => Ngo::where('user_id','=',User::where('username','=','greenone')->first()->id)->first()->id,
            ),
            array(
                'name'      => 'Contra la violencia de género',
                'description'      => 'Esta campaña de concienciación trata de combatir la violencia de género.',
                'image'=> '/logos/testlogos/violenciagenero.jpg',
                'startDate'   => \Carbon\Carbon::createFromDate(2015,8,23)->toDateTimeString(),
                'finishDate' => \Carbon\Carbon::createFromDate(2015,9,23)->toDateTimeString(),
                'visits' => 190,
                'link' => 'http://www.msssi.gob.es/campannas/campanas14/haySalida016.htm',
                'maxVisits' => 1000,
                'expirationDate' => \Carbon\Carbon::createFromDate(2015,8,20)->toDateTimeString(),
                'ngo_id' => Ngo::where('user_id','=',User::where('username','=','send')->first()->id)->first()->id,
            ),
            array(
                'name'      => 'Cena Solidaria Ecocentro',
                'description'      => 'Por segundo año consecutivo podrás degustar un menú especial en Ecocentro. Disfrutarás de una cena
                                        Bio-Vegetariana con productos de calidad a un precio solidario, 10,90 €.',
                'image'=> '/logos/testlogos/cena.png',
                'startDate'   => \Carbon\Carbon::createFromDate(2015,7,23)->toDateTimeString(),
                'finishDate' => \Carbon\Carbon::createFromDate(2015,8,23)->toDateTimeString(),
                'visits' => 37,
                'link' => 'http://nayanagar.org/post/115777711836/cena-ecocentro',
                'maxVisits' => 1000,
                'expirationDate' => \Carbon\Carbon::createFromDate(2015,7,15)->toDateTimeString(),
                'ngo_id' => Ngo::where('user_id','=',User::where('username','=','eat')->first()->id)->first()->id,
            ),
        );

        DB::table('campaign')->insert( $campaigns );
    }

}
