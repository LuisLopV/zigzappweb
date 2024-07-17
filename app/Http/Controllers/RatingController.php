<?php

namespace App\Http\Controllers;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        Rating::create([
            'score' => $request->score,
            'comment' => $request->comment,
            'qualifier_id' => auth()->user()->profile->id,
            'qualified_id' => $request->qualified_id,
            'travels_id' => $request->travel_id,
        ]);

        return redirect()->route('travels.index');
    }
}
