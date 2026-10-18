<?php

namespace App\Http\Controllers\Api;

use App\Models\Family;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //
    public function index(Family $family)
    {
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
