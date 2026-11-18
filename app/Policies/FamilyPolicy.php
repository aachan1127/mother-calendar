<?php

namespace App\Policies;

use App\Models\Family;
use App\Models\User;

class FamilyPolicy
{
    // 家族一覧を閲覧できるか
    public function viewAny(User $user): bool
    {
        return false;
    }

    // 特定の家族を閲覧できるか
    public function view(User $user, Family $family): bool
    {
        // 家族のメンバーを検索する
        return $family->members()
            // ログインユーザーに絞る
            ->whereKey($user->id)
            // 所属しているか確認する
            ->exists();
    }

    // 新しい家族を作成できるか
    public function create(User $user): bool
    {
        return false;
    }

    // 家族情報を変更できるか
    public function update(User $user, Family $family): bool
    {
        return false;
    }

    // 家族を削除できるか
    public function delete(User $user, Family $family): bool
    {
        return false;
    }

    // 削除した家族を復元できるか
    public function restore(User $user, Family $family): bool
    {
        return false;
    }

    // 家族を完全削除できるか
    public function forceDelete(User $user, Family $family): bool
    {
        return false;
    }
}
