<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    public function test_api_response_status()
    {
        $response = $this->get('/api/websites/'); // API rotası

        $response->assertStatus(200); // Beklenen durum kodu
    }

    // Başka testler ekleyebilirsiniz.
}
