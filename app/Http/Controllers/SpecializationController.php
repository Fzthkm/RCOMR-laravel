<?php

namespace App\Http\Controllers;

use App\Models\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    public function index(){
        $specializations = Specialization::all()->sortBy('name');
        return view('specialization.index', compact('specializations'));
    }

    public function create(){
        return view('specialization.create');
    }

    public function store(){
        $data = request()->validate([
            'name' => 'string'
        ]);
        Specialization::create($data);
        return redirect()->route('specialization.index');
    }

    public function show(Specialization $specialization){
        return view('specialization.show', compact('specialization'));
    }

    public function edit(Specialization $specialization){
        return view('specialization.edit', compact('specialization'));
    }

    public function update(Specialization $specialization){
        $data = request()->validate([
            'name' => 'string'
        ]);
        $specialization->update($data);
        return redirect()->route('specialization.show', $specialization->id);
    }

    public function destroy(Specialization $specialization){
        $specialization->delete();
        return redirect()->route('specialization.index');
    }
}
