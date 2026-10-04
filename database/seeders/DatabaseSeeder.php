<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Family;
use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $akane = User::create([
            'name' => '明音',
            'email' => 'akane@example.com',
            // Userモデルで'password' => 'hashed'と書いているので、ここでは平文でOK
            'password' => 'password',
        ]);
        $tomoko = User::create([
            'name' => 'ともこ',
            'email' => 'tomoko@example.com',
            'password' => 'password',
        ]);

        // 山本家のデータを作成
        $family = Family::create([
            'name' => '山本家',
            'invite_code' => '1234',
            'created_by' => $akane->id,
        ]);

        // 明音をownerとして山本家に追加
        $family->members()->attach(
            // 誰を登録する？
            $akane->id,
            // roleは？
            ['role' => 'owner']
        );

        // ともこをmemberとして山本家に追加
        $family->members()->attach(
            // 誰を登録する？
            $tomoko->id,
            // roleは？
            ['role' => 'member']
        );

        // 予定を作成
        $event = Event::create([
            'family_id' => $family->id,
            'created_by' => $akane->id,
            'title' => '病院',
            'start_at' => '2026-09-26 10:00',
            'end_at' => '2026-09-26 11:00',
            'memo' => '定期検診',
        ]);

        // ともこをこの予定の対象に追加
        $event->users()->attach(
            // 誰のID？
            $tomoko->id
        );
    }
}
