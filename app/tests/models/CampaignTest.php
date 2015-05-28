<?php

use Illuminate\Database\Query\Builder;

class CampaignTest extends TestCase {

    public function setUp(){
        parent::setUp();
        $this->campaign = Campaign::find(1);
        $this->ngo = Ngo::find($this->campaign->ngo_id);
    }

    public function testName()
    {
        $campaign = $this->campaign;
        $this->assertEquals( $campaign->name, 'Contra el abuso infantil' );
    }

    public function testNameIsAString()
    {
        $campaign = $this->campaign;
        $this->assertInternalType( 'string', $campaign->name);
    }

    public function testDescription()
    {
        $campaign = $this->campaign;
        $this->assertEquals( $campaign->description, 'Esta campaña de concienciación trata de combatir el abuso infantil, tanto físico como emocional.' );
    }

    public function testDescriptionIsAString()
    {
        $campaign = $this->campaign;
        $this->assertInternalType( 'string', $campaign->description);
    }

    public function testImage()
    {
        $campaign = $this->campaign;
        $this->assertNotNull( $campaign->image );
    }

    public function testStartDate()
    {
        $campaign = $this->campaign;
        $this->assertEquals( date('Y-m-d', strtotime($campaign->startDate)), date('Y-m-d', strtotime(\Carbon\Carbon::createFromDate(2015,8,23))));
    }

    public function testStartDateIsADate()
    {
        $campaign = $this->campaign;
        $this->assertInternalType( 'string', date('Y-m-d', strtotime($campaign->startDate)));
    }

    public function testFinishDate()
    {
        $campaign = $this->campaign;
        $this->assertEquals( date('Y-m-d', strtotime($campaign->finishDate)), date('Y-m-d', strtotime(\Carbon\Carbon::createFromDate(2015,9,23))));
    }

    public function testFinishDateIsADate()
    {
        $campaign = $this->campaign;
        $this->assertInternalType( 'string', date('Y-m-d', strtotime($campaign->finishDate)));
    }

    public function testStartDateAfterCurrentDate()
    {
        $campaign = $this->campaign;
        $this->assertGreaterThan( $campaign->startDate, new DateTime('now'));
    }

    public function testFinishDateAfterCurrentDate()
    {
        $campaign = $this->campaign;
        $this->assertGreaterThan( $campaign->finishDate, new DateTime('now'));
    }

    public function testStartDateAfterFinishDate()
    {
        $campaign = $this->campaign;
        $this->assertGreaterThan( $campaign->startDate, $campaign->finishDate());
    }

    public function testVisits()
    {
        $campaign = $this->campaign;
        $this->assertEquals( $campaign->visits, 180);
    }

    public function testVisitsIsAnInt()
    {
        $campaign = $this->campaign;
        $this->assertInternalType( 'int', (int) $campaign->visits);
    }

    public function testVisitsAreAlwaysPositive()
    {
        $campaign = $this->campaign;
        $this->assertGreaterThanOrEqual( 0, $campaign->visits);
    }

    public function testLink()
    {
        $campaign = $this->campaign;
        $this->assertEquals( $campaign->link, 'http://www.humanium.org/es/abuso-infantil/');
    }

    public function testLinkIsAString()
    {
        $campaign = $this->campaign;
        $this->assertInternalType( 'string', $campaign->link);
    }

    public function testLinkComplainsWithURLPattern()
    {
        $campaign = $this->campaign;
        $this->assertRegExp('{http://.*}', $campaign->link);
    }

    public function testMaxVisits()
    {
        $campaign = $this->campaign;
        $this->assertEquals( (int) $campaign->maxVisits, 1000);
    }

    public function testMaxVisitsIsAnInt()
    {
        $campaign = $this->campaign;
        $this->assertInternalType( 'int', (int) $campaign->maxVisits);
    }

    public function testMaxVisitsAreAlwaysPositive()
    {
        $campaign = $this->campaign;
        $this->assertGreaterThanOrEqual( 0,  (int) $campaign->maxVisits);
    }

    public function testHasNGOAssociated()
    {
        $campaign = $this->campaign;
        $ngo = Ngo::where('id','=',$campaign->ngo_id);
        $this->assertNotNull( $ngo );
    }

    public function testCorrectNgo()
    {
        $this->assertEquals( $this->ngo->name, 'Steps' );
    }

}
