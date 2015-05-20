<?php

use Illuminate\Database\Query\Builder;

class Project extends TestCase {

    public function setUp(){
        parent::setUp();
        $this->project = Project::find(1);
        $this->ngo = Ngo::find($this->project->ngo_id);
    }

    public function testName()
    {
        $project = $this->project;
        $this->assertEquals( $project->name, 'Ayuda en Togo' );
    }

    public function testNameIsAString()
    {
        $project = $this->project;
        $this->assertInternalType( 'string', $project->name);
    }

    public function testDescription()
    {
        $project = $this->project;
        $this->assertEquals( $project->description, 'Este proyecto consiste en la construcción de una escuela en la capital de Togo.' );
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
        $this->assertEquals( $project->address, 'Avenue de la Chance');
    }

    public function testAddressIsAString()
    {
        $project = $this->project;
        $this->assertInternalType( 'string', $project->address);
    }

    public function testCity()
    {
        $project = $this->project;
        $this->assertEquals( $project->city, 'Lomé');
    }

    public function testCityIsAString()
    {
        $project = $this->project;
        $this->assertInternalType( 'string', $project->city);
    }

    public function testZipCode()
    {
        $project = $this->project;
        $this->assertEquals( $project->zipCode, '526');
    }

    public function testZipCodeIsAString()
    {
        $project = $this->project;
        $this->assertInternalType( 'string', $project->zipCode);
    }

    public function testCountry()
    {
        $project = $this->project;
        $this->assertEquals( $project->country, 'Togo');
    }

    public function testCountryIsAString()
    {
        $project = $this->project;
        $this->assertInternalType( 'string', $project->country);
    }

    public function testMaxVolunteers()
    {
        $project = $this->project;
        $this->assertEquals( $project->maxVolunteers, 100);
    }

    public function testMaxVolunteersIsAnInt()
    {
        $project = $this->project;
        $this->assertInternalType( 'int', (int) $project->maxVolunteers);
    }

    public function testMaxVolunteersAreAlwaysPositive()
    {
        $project = $this->project;
        $this->assertGreaterThanOrEqual( $project->maxVolunteers, 0);
    }

    public function testStartDate()
    {
        $project = $this->project;
        $this->assertEquals( date('Y-m-d', strtotime($project->startDate)), date('Y-m-d', strtotime(\Carbon\Carbon::createFromDate(2015,7,23))));
    }

    public function testStartDateIsADate()
    {
        $project = $this->project;
        $this->assertInternalType( 'string', date('Y-m-d', strtotime($project->startDate)));
    }

    public function testFinishDate()
    {
        $project = $this->project;
        $this->assertEquals( date('Y-m-d', strtotime($project->finishDate)), date('Y-m-d', strtotime(\Carbon\Carbon::createFromDate(2015,12,23))));
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
        $this->assertGreaterThan( $project->startDate, $project->finishDate());
    }

    public function testHasNGOAssociated()
    {
        $project = $this->project;
        $ngo = Ngo::where('id','=',$project->ngo_id);
        $this->assertNotNull( $ngo );
    }

    public function testCorrectNgo()
    {
        $this->assertEquals( $this->ngo->name, 'Steps' );
    }

    public function testIsAVolunteeringProject()
    {
        $project = $this->project;
        $company = Company::where('id','=',$project->company_id);
        $this->assertNull( $company );
    }

}
