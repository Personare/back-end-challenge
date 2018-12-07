<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class CompanyTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPingApi()
    {
        $this->get('/');

        $this->assertEquals(
            $this->response->getContent(), $this->app->version()
        );
    }

    public function testCompanyGetFail()
    {
        $this->get('/api/v1/company');

        $this->assertEquals($this->response->status(), 401);

    }

    public function testCompanyDeleteFail()
    {
        $this->delete('/api/v1/company');

        $this->assertEquals($this->response->status(), 405);

    }

    public function testCompanyPostFail()
    {
        $this->put('/api/v1/company/1', ['name' => 'Sally Inc.']);

        $this->assertEquals($this->response->status(), 401);

    }

    public function testCompanyPostSuccess()
    {

        $company = factory('App\Company')->create();

        $this->actingAs($company)
            ->put('/api/v1/company/1', ['name' => 'Sally Inc.'])
            ->seeJson([
                'name' => 'Sally Inc.',
            ]);

        $this->seeInDatabase('companies', ['name' => 'Sally Inc.']);
    }

}
