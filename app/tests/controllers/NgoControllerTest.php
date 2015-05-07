<?php

class NgoControllerTest extends BaseControllerTestCase {


    public function testRegisterAsNgoResponse()
    {
        $this->flushSession();

        $this->requestAction('GET', 'NgoController@getCreate');
        $this->assertResponseOk();
    }

    public function testRegisterAsNgoRequiredParameter()
    {
        $this->flushSession();

        $this->requestAction('GET', 'NgoController@getCreate');
        $this->assertResponseOk();

        $ngoData = array(
            //'username'                      => 'ngo3',
            'email'                         => 'ngo3@gmail.com',
            'password'                      => 'ngo33',
            'password_confirmation'         => 'ngo33',
            'name'                          => 'ngo  3',
            'description'                   => 'Description ngo 3',
            'phone'                         => '6789610123',
        );

        $this->withInput( $ngoData )->requestAction('POST', 'NgoController@postIndex');
        $this->assertSessionHasErrors('username');
    }

    public function testRegisterAsNgoNotEnoughLength()
    {
        $this->flushSession();

        $this->requestAction('GET', 'NgoController@getCreate');
        $this->assertResponseOk();

        $ngoData = array(
            'username'                      => 'ab',
            'email'                         => 'ngo3@gmail.com',
            'password'                      => 'ngo33',
            'password_confirmation'         => 'ngo33',
            'name'                          => 'ngo  3',
            'description'                   => 'Description ngo 3',
            'phone'                         => '6789610123',
        );

        $this->withInput( $ngoData )->requestAction('POST', 'NgoController@postIndex');
        $this->assertSessionHasErrors('username');
    }

    public function testRegisterAsNgoTooMuchLength()
    {
        $this->flushSession();

        $this->requestAction('GET', 'NgoController@getCreate');
        $this->assertResponseOk();

        $ngoData = array(
            'username'                      => 'abcdefghijklmnopqrstuvwxyz1234567890',
            'email'                         => 'ngo3@gmail.com',
            'password'                      => 'ngo33',
            'password_confirmation'         => 'ngo33',
            'name'                          => 'ngo  3',
            'description'                   => 'Description ngo 3',
            'phone'                         => '6789610123',
        );

        $this->withInput( $ngoData )->requestAction('POST', 'NgoController@postIndex');
        $this->assertSessionHasErrors('username');
    }

    public function testRegisterAsCompanyUsernameAlreadyTaken()
    {
        $this->flushSession();

        $this->requestAction('GET', 'NgoController@getCreate');
        $this->assertResponseOk();

        $ngoData = array(
            'username'                      => 'ngo1',
            'email'                         => 'ngo1@gmail.com',
            'password'                      => 'ngo11',
            'password_confirmation'         => 'ngo11',
            'name'                          => 'ngo  1',
            'description'                   => 'Description ngo 1',
            'phone'                         => '6789610123',
        );

        $this->withInput( $ngoData )->requestAction('POST', 'NgoController@postIndex');
        $this->assertSessionHasErrors('username');
    }

    public function testRegisterAsNgoEmailFieldIsNotAEmail()
    {
        $this->flushSession();

        $this->requestAction('GET', 'NgoController@getCreate');
        $this->assertResponseOk();

        $ngoData = array(
            'username'                      => 'ngo3',
            'email'                         => 'emailBad',
            'password'                      => 'ngo33',
            'password_confirmation'         => 'ngo33',
            'name'                          => 'ngo  3',
            'description'                   => 'Description ngo 3',
            'phone'                         => '6789610123',
        );

        $this->withInput( $ngoData )->requestAction('POST', 'NgoController@postIndex');
        $this->assertSessionHasErrors('email');
    }

    public function testRegisterAsNgoPhoneFieldDoesNotMatchPattern()
    {
        $this->flushSession();

        $this->requestAction('GET', 'NgoController@getCreate');
        $this->assertResponseOk();

        $ngoData = array(
            'username'                      => 'company1',
            'email'                         => 'ngo3@gmail.com',
            'password'                      => 'ngo33',
            'password_confirmation'         => 'ngo33',
            'name'                          => 'ngo  3',
            'description'                   => 'Description ngo 3',
            'phone'                         => 'badPhone',
        );

        $this->withInput( $ngoData )->requestAction('POST', 'NgoController@postIndex');
        $this->assertSessionHasErrors('phone');
    }

    public function testRegisterAsNgoLogoFieldIsNotAnImage()
    {
        $this->flushSession();

        $this->requestAction('GET', 'NgoController@getCreate');
        $this->assertResponseOk();

        $ngoData = array(
            'username'                      => 'ngo3',
            'email'                         => 'ngo3@gmail.com',
            'password'                      => 'ngo33',
            'password_confirmation'         => 'ngo33',
            'name'                          => 'ngo  3',
            'description'                   => 'Description ngo 3',
            'phone'                         => '6789610123',
            'logo'                          => 'abcd',
        );

        $this->withInput( $ngoData )->requestAction('POST', 'NgoController@postIndex');
        $this->assertSessionHasErrors('logo');

    }

}
