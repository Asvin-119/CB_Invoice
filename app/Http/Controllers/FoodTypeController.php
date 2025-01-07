<?php

namespace App\Http\Controllers;

use App\Models\FoodType;
use Illuminate\Http\Request;

class FoodTypeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'food_type' => 'required|string|max:255',
        ]);

        FoodType::create($request->all());

        // Redirect back with success message
        return redirect()->back()->with('success', 'Food Type added successfully.');
    }
}
