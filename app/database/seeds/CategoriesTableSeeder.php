<?php

class CategoriesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('category')->delete();

        $categories = array(
            array( // 1
                'name'         => 'categories.Environment',
            ),
            array( // 2
                'name'         => 'categories.Human_Rights',
            ),
            array( // 3
                'name'         => 'categories.Immigration',
            ),
            array( // 4
                'name'         => 'categories.Youth_And_Family',
            ),
            array( // 5
                'name'         => 'categories.Cooperation_For_Development',
            ),
            array( // 6
                'name'         => 'categories.Humanitarian_Aid',
            ),
            array( // 7
                'name'         => 'categories.Sports',
            ),
            array( // 8
                'name'         => 'categories.Addictions',
            ),
            array( // 9
                'name'         => 'categories.Culture',
            ),
            array( // 10
                'name'         => 'categories.Social_Art',
            ),
            array( // 11
                'name'         => 'categories.Homeless',
            ),
            array( // 12
                'name'         => 'categories.Women',
            ),
            array( // 13
                'name'         => 'categories.Health_And_Disease',
            ),
            array( // 14
                'name'         => 'categories.Sponsorship',
            ),
            array( // 15
                'name'         => 'categories.Sexual_Diversity',
            ),
            array( // 16
                'name'         => 'categories.People_In_Risk_Of_Exclusion',
            ),
            array( // 17
                'name'         => 'categories.Elders',
            ),
            array( // 18
                'name'         => 'categories.Refugees',
            ),
            array( // 19
                'name'         => 'categories.Children',
            ),
            array( // 20
                'name'         => 'categories.People_With_Disabilities',
            ),
            array( // 21
                'name'         => 'categories.Animal_Welfare',
            ),
            array( // 22
                'name'         => 'categories.Others',
            ),
        );

        DB::table('category')->insert( $categories );

        DB::table('project_category')->delete();



        $pro_category = array(
            array(
                'project_id'       => (int)DB::table('project')->where('name','=','Ayuda en Togo')->first()->id,
                'category_id'      => (int)DB::table('category')->where('name','=','categories.Cooperation_For_Development')->first()->id,
            ),
            array(
                'project_id'       => (int)DB::table('project')->where('name','=','Ayuda en Togo')->first()->id,
                'category_id'      => (int)DB::table('category')->where('name','=','categories.Children')->first()->id,
            ),
            array(
                'project_id'       => (int)DB::table('project')->where('name','=','Ayudemos a los elefantes')->first()->id,
                'category_id'      => (int)DB::table('category')->where('name','=','categories.Animal_Welfare')->first()->id,
            ),
            array(
                'project_id'       => (int)DB::table('project')->where('name','=','Contra la pobreza en Adama')->first()->id,
                'category_id'      => (int)DB::table('category')->where('name','=','categories.Cooperation_For_Development')->first()->id,
            ),
            array(
                'project_id'       => (int)DB::table('project')->where('name','=','Contra la pobreza en Adama')->first()->id,
                'category_id'      => (int)DB::table('category')->where('name','=','categories.Youth_And_Family')->first()->id,
            ),
            array(
                'project_id'       => (int)DB::table('project')->where('name','=','Contra la pobreza en Adama')->first()->id,
                'category_id'      => (int)DB::table('category')->where('name','=','categories.Homeless')->first()->id,
            ),
            array(
                'project_id'       => (int)DB::table('project')->where('name','=','Contra la tala masiva de árboles en el amazonas')->first()->id,
                'category_id'      => (int)DB::table('category')->where('name','=','categories.Environment')->first()->id,
            ),
            array(
                'project_id'       => (int)DB::table('project')->where('name','=','Conservación del medio ambiente')->first()->id,
                'category_id'      => (int)DB::table('category')->where('name','=','categories.Environment')->first()->id,
            ),
            array(
                'project_id'       => (int)DB::table('project')->where('name','=','Di no a las drogas')->first()->id,
                'category_id'      => (int)DB::table('category')->where('name','=','categories.Addictions')->first()->id,
            ),
            array(
                'project_id'       => (int)DB::table('project')->where('name','=','Di no a las drogas')->first()->id,
                'category_id'      => (int)DB::table('category')->where('name','=','categories.Health_And_Disease')->first()->id,
            ),
            array(
                'project_id'       => (int)DB::table('project')->where('name','=','Ayuda a un mayor')->first()->id,
                'category_id'      => (int)DB::table('category')->where('name','=','categories.Elders')->first()->id,
            ),
            array(
                'project_id'       => (int)DB::table('project')->where('name','=','Salvemos al ciervo rojo')->first()->id,
                'category_id'      => (int)DB::table('category')->where('name','=','categories.Animal_Welfare')->first()->id,
            ),
            array(
                'project_id'       => (int)DB::table('project')->where('name','=','Prevención de la violencia')->first()->id,
                'category_id'      => (int)DB::table('category')->where('name','=','categories.Immigration')->first()->id,
            ),
            array(
                'project_id'       => (int)DB::table('project')->where('name','=','Prevención de la violencia')->first()->id,
                'category_id'      => (int)DB::table('category')->where('name','=','categories.Children')->first()->id,
            ),
            array(
                'project_id'       => (int)DB::table('project')->where('name','=','Por una ciudad más accesible para todos')->first()->id,
                'category_id'      => (int)DB::table('category')->where('name','=','categories.People_In_Risk_Of_Exclusion')->first()->id,
            ),
            array(
                'project_id'       => (int)DB::table('project')->where('name','=','Por una ciudad más accesible para todos')->first()->id,
                'category_id'      => (int)DB::table('category')->where('name','=','categories.People_With_Disabilities')->first()->id,
            ),

        );

        DB::table('project_category')->insert( $pro_category );
    }

}