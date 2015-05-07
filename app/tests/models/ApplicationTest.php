<?php

use Illuminate\Database\Query\Builder;

class ApplicationTest extends TestCase {
    protected $application;

    public function setUp(){
        parent::setUp();
        $this->application = Application::find(1);
    }

    public function testMoment()
    {
        $application = $this->application;
        $this->assertEquals( date('Y-m-d', strtotime($application->moment)), date('Y-m-d', strtotime(\Carbon\Carbon::createFromDate(2015,5,6))));

    }

    public function testMomentIsADate()
    {
        $application = $this->application;
        $this->assertInternalType( 'string', date('Y-m-d', strtotime($application->moment)));
    }

    public function testComments()
    {
        $application = $this->application;
        $this->assertEquals( $application->comments, 'comments1' );
    }

    public function testCommentsIsAString()
    {
        $application = $this->application;
        $this->assertInternalType( 'string', $application->comments);
    }

    public function testResult()
    {
        $application = $this->application;
        $this->assertEquals( $application->result, 2);
    }

    public function testResultIsAnInt()
    {
        $application = $this->application;
        $this->assertInternalType( 'int', (int) $application->result);
    }
}
