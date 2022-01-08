<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PatientTest extends TestCase
{
    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function RouteShouldReturnOk()
    {
        $response = $this->get(Route('users'));
        $response->assertStatus(200);
    }

}
