<?php

class CompanyViewsTest extends BaseControllerTestCase {


    public function testCreateResponse()
    {
        $crawler = $this->client->request('GET', URL::to('userCompany/create'));

        $this->assertTrue($this->client->getResponse()->isOk());
    }

}