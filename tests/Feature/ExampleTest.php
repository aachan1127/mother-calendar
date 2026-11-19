<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');
        // レスポンスのHTTPステータスが200か確認（200ならテスト成功、200以外なら失敗）
        $response->assertStatus(200);
    }
}
