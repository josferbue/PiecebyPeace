<?php

use Illuminate\Database\Query\Builder;

class AdministratorTest extends TestCase {

    public function setUp(){
        parent::setUp();
        $this->administrator = Administrator::find(1);
    }

    public function testName()
    {
        $administrator = $this->administrator;
        $this->assertEquals( $administrator->name, 'Rafael' );
    }

    public function testNameIsAString()
    {
        $administrator = $this->administrator;
        $this->assertInternalType( 'string', $administrator->name);
    }

    public function testBanned()
    {
        $administrator = $this->administrator;
        $this->assertEquals( (boolean) $administrator->banned, false );
    }

    public function testBannedIsABoolean()
    {
        $administrator = $this->administrator;
        $this->assertInternalType( 'boolean', (boolean) $administrator->banned);
    }

}
