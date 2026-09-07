<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    // 1人のユーザーが複数の家族グループに所属できる（家族内での権限[role]もここで取得）
    public function families()
    {
        return $this->belongsToMany(Family::class)
            ->withPivot('role')
            ->withTimestamps();
    }

    // このユーザーが作成した予定を取得
    public function createdEvents()
    {
        return $this->hasMany(Event::class, 'created_by');
    }

    // このユーザーが対象になっている予定を取得
    public function events()
    {
        return $this->belongsToMany(Event::class)
            ->withTimestamps();
    }


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
