<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();

        $administratorRole = new Role;
        $administratorRole->name = 'ADMINISTRATOR';
        $administratorRole->save();

        $ngoRole = new Role;
        $ngoRole->name = 'NonGovernmentalOrganization';
        $ngoRole->save();

        $volunteerRole = new Role;
        $volunteerRole ->name = 'VOLUNTEER';
        $volunteerRole ->save();

        $companyRole = new Role;
        $companyRole ->name = 'COMPANY';
        $companyRole ->save();

        $user = User::where('username','=','admin')->first();
        $user->attachRole( $administratorRole );

        $user = User::where('username','=','eat')->first();
        $user->attachRole( $ngoRole );

        $user = User::where('username','=','elephant')->first();
        $user->attachRole( $ngoRole );

        $user = User::where('username','=','greenone')->first();
        $user->attachRole( $ngoRole );

        $user = User::where('username','=','send')->first();
        $user->attachRole( $ngoRole );

        $user = User::where('username','=','steps')->first();
        $user->attachRole( $ngoRole );

        $user = User::where('username','=','boliri')->first();
        $user->attachRole( $companyRole );

        $user = User::where('username','=','chaos')->first();
        $user->attachRole( $companyRole );

        $user = User::where('username','=','jaylodet')->first();
        $user->attachRole( $companyRole );

        $user = User::where('username','=','xeilaale')->first();
        $user->attachRole( $companyRole );

        $user = User::where('username','=','xorysoft')->first();
        $user->attachRole( $companyRole );

        $user = User::where('username','=','manu')->first();
        $user->attachRole( $volunteerRole );

        $user = User::where('username','=','maria')->first();
        $user->attachRole( $volunteerRole );

        $user = User::where('username','=','carlos')->first();
        $user->attachRole( $volunteerRole );

        $user = User::where('username','=','jose')->first();
        $user->attachRole( $volunteerRole );

        $user = User::where('username','=','marta')->first();
        $user->attachRole( $volunteerRole );

        $user = User::where('username','=','fernando')->first();
        $user->attachRole( $volunteerRole );

        $user = User::where('username','=','antonio')->first();
        $user->attachRole( $volunteerRole );

        $user = User::where('username','=','rafael')->first();
        $user->attachRole( $volunteerRole );

        $user = User::where('username','=','juan')->first();
        $user->attachRole( $volunteerRole );

        $user = User::where('username','=','raquel')->first();
        $user->attachRole( $volunteerRole );

    }

}
