<?php

class MessagesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('message')->delete();
        DB::table('message_recipient')->delete();

        $messages = array(
            array(
                'subject' => 'Subject 1',
                'textBox' => 'This is a message 1',
                'administrator_id' => Administrator::where('user_id', '=', User::where('username', '=', 'administrator1')->first()->id)->first()->id,
            ),
            array(
                'subject' => 'Subject 2',
                'textBox' => 'This is a message 2',
                'administrator_id' => Administrator::where('user_id', '=', User::where('username', '=', 'administrator2')->first()->id)->first()->id,
            ),
        );

        DB::table('message')->insert($messages);

        $messages_recipientsNgo = array(
            # First message
            array(
                'message_id' => Message::where('subject', '=', 'Subject 1')->first()->id,
                'recipient_ngo_id' => Ngo::where('user_id', '=', User::where('username', '=', 'ngo1')->first()->id)->first()->id,
            ),
            array(
                'message_id' => Message::where('subject', '=', 'Subject 1')->first()->id,
                'recipient_ngo_id' => Ngo::where('user_id', '=', User::where('username', '=', 'ngo2')->first()->id)->first()->id,
            ),
            # Second message
            array(
                'message_id' => Message::where('subject', '=', 'Subject 2')->first()->id,
                'recipient_ngo_id' => Ngo::where('user_id', '=', User::where('username', '=', 'ngo1')->first()->id)->first()->id,
            ),
            array(
                'message_id' => Message::where('subject', '=', 'Subject 2')->first()->id,
                'recipient_ngo_id' => Ngo::where('user_id', '=', User::where('username', '=', 'ngo2')->first()->id)->first()->id,
            )
        );

        $messages_recipientsVolunteer = array(
            # First message
            array(
                'message_id' => Message::where('subject', '=', 'Subject 1')->first()->id,
                'recipient_volunteer_id' => Volunteer::where('user_id', '=', User::where('username', '=', 'volunteer1')->first()->id)->first()->id,
            ),
            array(
                'message_id' => Message::where('subject', '=', 'Subject 1')->first()->id,
                'recipient_volunteer_id' => Volunteer::where('user_id', '=', User::where('username', '=', 'volunteer2')->first()->id)->first()->id,
            ),
            # Second message
            array(
                'message_id' => Message::where('subject', '=', 'Subject 2')->first()->id,
                'recipient_volunteer_id' => Volunteer::where('user_id', '=', User::where('username', '=', 'volunteer1')->first()->id)->first()->id,
            ),
            array(
                'message_id' => Message::where('subject', '=', 'Subject 2')->first()->id,
                'recipient_volunteer_id' => Volunteer::where('user_id', '=', User::where('username', '=', 'volunteer2')->first()->id)->first()->id,
            ),
        );

        $messages_recipientsCompany = array(
            # First message
            array(
                'message_id' => Message::where('subject', '=', 'Subject 1')->first()->id,
                'recipient_company_id' => Company::where('user_id', '=', User::where('username', '=', 'company1')->first()->id)->first()->id,
            ),
            array(
                'message_id' => Message::where('subject', '=', 'Subject 1')->first()->id,
                'recipient_company_id' => Company::where('user_id', '=', User::where('username', '=', 'company2')->first()->id)->first()->id,
            ),

            # Second message
            array(
                'message_id' => Message::where('subject', '=', 'Subject 2')->first()->id,
                'recipient_company_id' => Company::where('user_id', '=', User::where('username', '=', 'company1')->first()->id)->first()->id,
            ),
            array(
                'message_id' => Message::where('subject', '=', 'Subject 2')->first()->id,
                'recipient_company_id' => Company::where('user_id', '=', User::where('username', '=', 'company2')->first()->id)->first()->id,
            ),
        );


        DB::table('message_recipient')->insert($messages_recipientsCompany);
        DB::table('message_recipient')->insert($messages_recipientsNgo);
        DB::table('message_recipient')->insert($messages_recipientsVolunteer);
    }

}
