<?php

namespace App\Http\Controllers;

use App\Models\FeeType;
use Illuminate\Http\Request;

class FeeTypeController extends Controller
{
 public function index()
{
    $fee_types = FeeType::all();   // ← fetch all fee types
    return view('fee_types.index', compact('fee_types'));
}


    public function create()
    {
        return view('fee_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'amount' => 'required|numeric',
            'class' => 'required'
        ]);

        FeeType::create($request->only('name','amount','class'));
        return redirect()->route('fee_types.index')->with('success', 'Fee Type added!');
    }
}
