<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Family;

// 予定APIの認可テスト
class EventAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    // 未ログインユーザーが家族の予定を閲覧できないことを確認するテスト👉閲覧を拒否（401）
    public function test_guest_cannot_view_family_events(): void
    {
        // Laravelのテスト機能を使ってGETリクエストを送る
        $response = $this->getJson('/api/families/1/events');
        // HTTP 401が返ったか確認する
        $response->assertUnauthorized();
    }

    // 家族に所属するユーザーが予定一覧を取得できることを確認👉閲覧を許可（200）
    public function test_family_member_can_view_events(): void
    {
        // テスト用ユーザーを作成
        $user = User::factory()->create();

        // テスト用の家族を作成
        $family = Family::factory()->create();

        // ユーザーを家族のメンバーとして登録
        $family->members()->attach($user->id, [
            'role' => 'member',
        ]);

        // 作成したユーザーでログインした状態にする
        $response = $this->actingAs($user)
            ->getJson("/api/families/{$family->id}/events");

        // HTTP 200が返ることを確認
        $response->assertOk();
    }

    // 家族に所属していないユーザーは予定一覧を取得できないことを確認👉閲覧を拒否（403）
    public function test_non_member_cannot_view_family_events(): void
    {
        // テスト用ユーザーを作成
        $user = User::factory()->create();

        // テスト用の家族を作成
        $family = Family::factory()->create();

        // 家族には所属させずにログイン状態でGETリクエスト
        $response = $this->actingAs($user)
            ->getJson("/api/families/{$family->id}/events");

        // HTTP 403が返ることを確認
        $response->assertForbidden();
    }
}
