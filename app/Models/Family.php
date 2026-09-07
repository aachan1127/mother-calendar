<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    // この家族のメンバーを取得する（家族内での権限[role]もここで取得）
    public function members()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role')
            ->withTimestamps();
    }

    // この家族に紐づく予定を取得
    public function events()
    {
        return $this->hasMany(Event::class);
        // return $this->hasMany(Event::class, 'family_id');　とも書ける（Laravelの外部キーの命名規則）
    }

    // この家族を作ったユーザー
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
