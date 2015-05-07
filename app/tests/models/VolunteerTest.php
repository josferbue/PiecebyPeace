<?php

use Illuminate\Database\Query\Builder;

class VolunteerTest extends TestCase {
    protected $volunteer;

    public function setUp(){
        parent::setUp();
        $this->volunteer = Volunteer::find(1);
    }

    public function testName()
    {
        $volunteer = $this->volunteer;
        $this->assertEquals( $volunteer->name, 'volunteer1' );
    }

    public function testNameIsAString()
    {
        $volunteer = $this->volunteer;
        $this->assertInternalType( 'string', $volunteer->name);
    }

    public function testBanned()
    {
        $volunteer = $this->volunteer;
        $this->assertEquals( (boolean) $volunteer->banned, false );
    }

    public function testBannedIsABoolean()
    {
        $volunteer = $this->volunteer;
        $this->assertInternalType( 'boolean', (boolean) $volunteer->banned);
    }

    public function testSurname()
    {
        $volunteer = $this->volunteer;
        $this->assertEquals( $volunteer->surname, 'surname1' );
    }

    public function testSurnameIsAString()
    {
        $volunteer = $this->volunteer;
        $this->assertInternalType( 'string', $volunteer->surname);
    }

    public function testBiography()
    {
        $volunteer = $this->volunteer;
        $this->assertEquals( $volunteer->biography, 'biography1' );
    }

    public function testBiographyIsAString()
    {
        $volunteer = $this->volunteer;
        $this->assertInternalType( 'string', $volunteer->biography);
    }

    public function testAddress()
    {
        $volunteer = $this->volunteer;
        $this->assertEquals( $volunteer->address, 'address1' );
    }

    public function testAddressIsAString()
    {
        $volunteer = $this->volunteer;
        $this->assertInternalType( 'string', $volunteer->address);
    }
       public function testCity()
    {
        $volunteer = $this->volunteer;
        $this->assertEquals( $volunteer->city, 'Sevilla' );
    }

    public function testCityIsAString()
    {
        $volunteer = $this->volunteer;
        $this->assertInternalType( 'string', $volunteer->city);
    }

    public function testZipCode()
    {
        $volunteer = $this->volunteer;
        $this->assertEquals( $volunteer->zipCode, '49999' );
    }

    public function testZipCodeIsAString()
    {
        $volunteer = $this->volunteer;
        $this->assertInternalType( 'string', $volunteer->zipCode);
    }

    public function testCountry()
    {
        $volunteer = $this->volunteer;
        $this->assertEquals( $volunteer->country, 'España' );
    }

    public function testCountryIsAString()
    {
        $volunteer = $this->volunteer;
        $this->assertInternalType( 'string', $volunteer->country);
    }


}
