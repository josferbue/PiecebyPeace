<?php

class CompanyControllerTest extends BaseControllerTestCase {

    public function testRegisterAsCompany()
    {
        $this->requestAction('GET', '/company/create');
        $this->assertRequestOk();
    }

}
