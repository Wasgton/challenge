<?php

namespace Tests\Feature;

use App\Models\ApiAuth;
use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

CONST API_KEY = '$2y$10$0Q0NCRivMxQ1KXdZdHj8XegRCC4cE3eOi7i752CvjBHr4cXkEpP..';

class PatientTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function can_list_all_patients()
    {
        $response = $this->get(Route('users.index'),[
            'api-key'=>API_KEY,
            'Accept'=>'application/json'
        ]);
        $response->assertStatus(200);
    }

    /**
     * @test
     * @return void
     */
    public function can_list_single_patient()
    {
        $response = $this->get(Route('users.show',1), [
            'api-key'=>API_KEY,
            'Accept'=>'application/json'
        ]);
        $response->assertStatus(200);
    }

    /**
     * @test
     * @return void
     */
    public function can_update_patients()
    {
        $data = [
            "id" => 1,
            "title" => "Mrs",
            "name" => "Erin",
            "last_name" => "Lopez",
            "gender" => "female",
            "phone" => "071-405-4008",
            "cell" => "081-062-6986",
            "email" => "erin.lopez@example.com",
            "username" => "ticklishmouse840",
            "street" => "High Street",
            "city" => "Donabate",
            "state" => null,
            "postcode" => "97025",
            "latitude" => "24.5730",
            "longitude" => "155.0219",
            "timezone" => "-10:00",
            "timezone_description" => "Hawaii",
            "nat" => "IE",
            "registered" => "2019-01-28 01:55:40",
            "uuid" => "58718546-f351-4fbe-93dd-ad0f7e608710",
            "dob" => "1946-06-03 17:38:18",
            "imported_t" => "2022-01-09T22:43:32.000000Z",
            "updated_at" => "2022-01-09T22:43:33.000000Z",
            "status" => "published"
        ];

        $response = $this->put(Route('users.index',[1,$data]),[
            'api-key'=>API_KEY,
            'Accept'=>'application/json'
        ]);
        $response->assertStatus(200);
    }

    /**
     * @test
     * @return void
     */
    public function can_delete_patients()
    {
        $response = $this->delete(Route('users.destroy',1),[
            'api-key'=>API_KEY,
            'Accept'=>'application/json'
        ]);
        $response->assertStatus(200);
    }

}
