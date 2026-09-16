<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //この予定が属しているFamilyを取得
    public function family()
    {
        return $this->belongsTo(Family::class);
        // return $this->belongsTo(Family::class, 'family_id'); とも書ける（Laravelの外部キーの命名規則）
    }

    // この予定を作成したユーザーを取得
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // この予定の対象になっているユーザーを取得
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps();
    }
}
