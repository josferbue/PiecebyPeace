<?php

use Illuminate\Database\Query\Builder;

class ProjectTest extends TestCase {

    public function setUp(){
        parent::setUp();
        $this->project = Project::find(1);
        $this->ngo = Ngo::find($this->project->ngo_id);
    }

    public function testName()
    {
        $project = $this->project;
        $this->assertEquals( $project->name, 'Contra la pobreza en Adama' );
    }

    public function testNameIsAString()
    {
        $project = $this->project;
        $this->assertInternalType( 'string', $project->name);
    }

    public function testDescription()
    {
        $project = $this->project;
        $this->assertEquals( $project->description, 'En este proyecto se seguirá con la labor de construcción de una insfraestructura sostenible para la ciudad.' );
    }

    public function testDescriptionIsAString()
    {
        $project = $this->project;
        $this->assertInternalType( 'string', $project->description);
    }

    public function testImage()
    {
        $project = $this->project;
        $this->assertNotNull( $project->image );
    }

    public function testAddress()
    {
        $project = $this->project;
        $this->assertEquals( $project->address, 'Aisha St.');
    }

    public function testAddressIsAString()
    {
        $project = $this->project;
        $this->assertInternalType( 'string', $project->address);
    }

    public function testCity()
    {
        $project = $this->project;
        $this->assertEquals( $project->city, 'Adama');
    }

    public function testCityIsAString()
    {
        $project = $this->project;
        $this->assertInternalType( 'string', $project->city);
    }

    public function testZipCode()
    {
        $project = $this->project;
        $this->assertEquals( $project->zipCode, '985');
    }

    public function testZipCodeIsAString()
    {
        $project = $this->project;
        $this->assertInternalType( 'string', $project->zipCode);
    }

    public function testCountry()
    {
        $project = $this->project;
        $this->assertEquals( $project->country, 'Etiopía');
    }

    public function testCountryIsAString()
    {
        $project = $this->project;
        $this->assertInternalType( 'string', $project->country);
    }

    public function testMaxVolunteers()
    {
        $project = $this->project;
        $this->assertEquals( $project->maxVolunteers, 75);
    }

    public function testMaxVolunteersIsAnInt()
    {
        $project = $this->project;
        $this->assertInternalType( 'int', (int) $project->maxVolunteers);
    }

    public function testMaxVolunteersAreAlwaysPositive()
    {
        $project = $this->project;
        $this->assertGreaterThanOrEqual( 0, $project->maxVolunteers);
    }

    public function testStartDate()
    {
        $project = $this->project;
        $this->assertEquals( date('Y-m-d', strtotime($project->startDate)), date('Y-m-d', strtotime(\Carbon\Carbon::createFromDate(2016,1,23))));
    }

    public function testStartDateIsADate()
    {
        $project = $this->project;
        $this->assertInternalType( 'string', date('Y-m-d', strtotime($project->startDate)));
    }

    public function testFinishDate()
    {
        $project = $this->project;
        $this->assertEquals( date('Y-m-d', strtotime($project->finishDate)), date('Y-m-d', strtotime(\Carbon\Carbon::createFromDate(2016,2,10))));
    }

    public function testFinishDateIsADate()
    {
        $project = $this->project;
        $this->assertInternalType( 'string', date('Y-m-d', strtotime($project->finishDate)));
    }

    public function testStartDateAfterCurrentDate()
    {
        $project = $this->project;
        $this->assertGreaterThan( $project->startDate, new DateTime('now'));
    }

    public function testFinishDateAfterCurrentDate()
    {
        $project = $this->project;
        $this->assertGreaterThan( $project->finishDate, new DateTime('now'));
    }

    public function testStartDateAfterFinishDate()
    {
        $project = $this->project;
        $this->assertGreaterThan( $project->startDate, $project->finishDate);
    }

    public function testHasNGOAssociated()
    {
        $project = $this->project;
        $ngo = Ngo::where('id','=',$project->ngo_id);
        $this->assertNotNull( $ngo );
    }

    public function testCorrectNgo()
    {
        $this->assertEquals( $this->ngo->name, 'Eat Innovations' );
    }

    public function testIsAVolunteeringProject()
    {
        $project = $this->project;
        $this->assertNull( $project->company_id );
    }

}
