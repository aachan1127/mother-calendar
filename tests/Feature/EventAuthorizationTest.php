<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

// 予定APIの認可テスト
class EventAuthorizationTest extends TestCase
{
    // 未ログインユーザーが家族の予定を閲覧できないことを確認するテスト
    public function test_guest_cannot_view_family_events(): void
    {
        // Laravelのテスト機能を使ってGETリクエストを送る
        $response = $this->getJson('/api/families/1/events');
        // HTTP 401が返ったか確認する
        $response->assertUnauthorized();
    }
}
