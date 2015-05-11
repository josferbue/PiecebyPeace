<?php

use Illuminate\Database\Query\Builder;

class CompanyTest extends TestCase {

    public function setUp(){
        parent::setUp();
        $this->company = Company::find(1);
    }

    public function testName()
    {
        $company = $this->company;
        $this->assertEquals( $company->name, 'Boliri Association' );
    }

    public function testNameIsAString()
    {
        $company = $this->company;
        $this->assertInternalType( 'string', $company->name);
    }

    public function testBanned()
    {
        $company = $this->company;
        $this->assertEquals( (boolean) $company->banned, false );
    }

    public function testBannedIsABoolean()
    {
        $company = $this->company;
        $this->assertInternalType( 'boolean', (boolean) $company->banned);
    }

    public function testSector()
    {
        $company = $this->company;
        $this->assertEquals( $company->sector, 'Servicios' );
    }

    public function testSectorIsAString()
    {
        $company = $this->company;
        $this->assertInternalType( 'string', $company->sector);
    }

    public function testDescription()
    {
        $company = $this->company;
        $this->assertEquals( $company->description, 'En esta empresa se ayuda al cliente a no gastar dinero innecesariamente.' );
    }

    public function testDescriptionIsAString()
    {
        $company = $this->company;
        $this->assertInternalType( 'string', $company->description);
    }

    public function testPhone()
    {
        $company = $this->company;
        $this->assertEquals( $company->phone, '635256458' );
    }

    public function testPhoneIsAString()
    {
        $company = $this->company;
        $this->assertInternalType( 'string', $company->phone);
    }

    public function testLinkComplainsWithURLPattern()
    {
        $company = $this->company;
        $this->assertRegExp('{\d+}', $company->phone);
    }

    public function testImage()
    {
        $company = $this->company;
        $this->assertNull( $company->image );
    }

    public function testActive()
    {
        $company = $this->company;
        $this->assertEquals( (boolean) $company->active, true );
    }

    public function testActiveIsABoolean()
    {
        $company = $this->company;
        $this->assertInternalType( 'boolean', (boolean) $company->active);
    }

}
