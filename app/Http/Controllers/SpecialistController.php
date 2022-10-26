<?php

namespace App\Http\Controllers;

use App\Models\Specialist;
use App\Models\Specialization;
use Illuminate\Http\Request;

class SpecialistController extends Controller
{
    public function index()
    {
        $specialists = Specialist::all();
//        foreach ($specialists as $specialist){
//            $specialist->specialization = Specialization::find($specialist->specialization_id)->name;
//        }
        return view('specialist.index', compact('specialists'));
    }

    public function create(){
        $specializations = Specialization::all();
        return view('specialist.create', compact('specializations'));
    }

    public function store(){
        $data = request()->validate([
            'name' => 'string',
            'workplace' => 'string',
            'specialization_id' => '',
            'academic_degree' => '',
            'additional_info' => '',
        ]);
        $specialization_id = Specialization::where('name', $data['specialization_id'])->get();
        $data['specialization_id'] = $specialization_id[0]->id;
        Specialist::create($data);
        return redirect()->route('specialist.index');
    }

    public function show(Specialist $specialist){
        $specialization = isset($specialist->specialization_id)? Specialization::find($specialist->specialization_id)->name : $specialist->specialization_name;
        return view('specialist.show', compact('specialist', 'specialization'));
    }

    public function edit(Specialist $specialist){
        $specializations = Specialization::all();
        $specialization = isset($specialist->specialiation_id)? Specialization::find($specialist->specialization_id)->name : $specialist->specialization_name;
        return view('specialist.edit', compact('specialist', 'specializations', 'specialization'));
    }

    public function update(Specialist $specialist){
        $data = request()->validate([
            'name' => 'string',
            'workplace' => 'string',
            'specialization_id' => '',
            'academic_degree' => '',
            'additional_info' => '',
        ]);
        $data->specialization_id = Specialization::firstOrFail()->where('name', $data->specialization_id)->id;
        $specialist->update($data);
        return redirect()->route('specialist.show', $specialist->id);
    }

    public function destroy(Specialist $specialist){
        $specialist->delete();
        return redirect()->route('specialist.index');
    }
}
