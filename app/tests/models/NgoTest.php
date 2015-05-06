<?php

class NgoTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->ngo = Ngo::find(1);
    }

    public function testName()
    {
        $ngo = $this->ngo;
        $this->assertEquals($ngo->name, 'NGO-1');
    }

    public function testNameIsAString()
    {
        $ngo = $this->ngo;
        $this->assertInternalType('string', $ngo->name);
    }

    public function testBanned()
    {
        $ngo = $this->ngo;
        $this->assertEquals((boolean)$ngo->banned, false);
    }

    public function testBannedIsABoolean()
    {
        $ngo = $this->ngo;
        $this->assertInternalType('boolean', (boolean)$ngo->banned);
    }

    public function testDescription()
    {
        $ngo = $this->ngo;
        $this->assertEquals($ngo->description, 'NGO1 NGO1 NGO1 NGO1');
    }

    public function testDescriptionIsAString()
    {
        $ngo = $this->ngo;
        $this->assertInternalType('string', $ngo->description);
    }

    public function testPhone()
    {
        $ngo = $this->ngo;
        $this->assertEquals($ngo->phone, '612345678');
    }

    public function testPhoneIsAString()
    {
        $ngo = $this->ngo;
        $this->assertInternalType('string', $ngo->phone);
    }

    public function testPhoneComplainsWithURLPattern()
    {
        $ngo = $this->ngo;
        $this->assertRegExp('{\d+}', $ngo->phone);
    }

    public function testLogo()
    {
        $ngo = $this->ngo;
        $this->assertNotNull($ngo->logo);
    }

    public function testActive()
    {
        $ngo = $this->ngo;
        $this->assertEquals((boolean)$ngo->active, true);
    }

    public function testActiveIsABoolean()
    {
        $ngo = $this->ngo;
        $this->assertInternalType('boolean', (boolean)$ngo->active);
    }
}
