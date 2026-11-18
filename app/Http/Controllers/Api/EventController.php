<?php

namespace App\Http\Controllers\Api;

use App\Models\Family;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EventController extends Controller
{
    public function index(Family $family)
    {
        // Gateを使って、ログインユーザーがこの家族のメンバーかどうかを確認する
        Gate::authorize('view', $family);
        // この家族に紐づく予定を取得する
        return $family->events()
            ->orderBy('start_at', 'asc')
            ->get();
    }

    public function store(Request $request, Family $family)
    {
        // 予定入力のバリデーション
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
            'memo' => 'nullable|string',
        ]);

        return $validated;
        // return $request->all();
    }
}
