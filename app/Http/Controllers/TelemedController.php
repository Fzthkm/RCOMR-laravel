<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\Specialist;
use App\Models\Telemed;
use App\Models\Specialization;
use Illuminate\Http\Request;

class TelemedController extends Controller
{
    public function index()
    {
        $applications = Telemed::all()->sortByDesc('number')->sortByDesc('creating_date')->take(1000);
        foreach($applications as $application){
            $application->organisation = isset($application->organisation_id)? Organisation::find($application->organisation_id)->name : 'необходимо указать id в базе данных';
            $application->specialist = isset($application->specialist_id)? Specialist::find($application->specialist_id)->name : 'необходимо указать id в базе данных';
        }
        return view('telemed.index', compact('applications'));
    }

    public function create(){
        $organisations = Organisation::all()->sortBy('name');
        $specialists = Specialist::all()->sortBy('name');
        return view('telemed.create', compact('organisations', 'specialists'));
    }

    public function store(){
        $data = request()->validate([
            'number' => '',
            'creating_date' => '',
            'consult_date'=>'',
            'organisation_id' => '',
            'patient_name' => '',
            'patient_year' => '',
            'diagnosis' => '',
            'covid' => '',
            'specialist_id'=>'',
            'status' => ''
        ]);
        $data['organisation_name'] = $data['organisation_id'];
        $data['specialist_name'] = $data['specialist_id'];
        $data['organisation_id'] = Organisation::firstOrFail()->where('name', $data['organisation_id'])->get()[0]->id;
        $data['specialist_id'] = Specialist::firstOrFail()->where('name', $data['specialist_id'])->get()[0]->id;
        $date = date('Y-m-d');
        if(!isset($data['creating_date'])) {
            $data['creating_date'] = $date;
        }
        if(!isset($data['consult_date'])) {
            $data['consult_date'] = $date;
        }
        $data['status'] = 'create';
        Telemed::create($data);
        return redirect()->route('telemed.index');
    }

    public function show(Telemed $telemed){
        return view('telemed.show', compact('telemed'));
    }

    public function edit(Telemed $telemed){
        $specialists = Specialist::all()->sortBy('name');
        $organisations = Organisation::all()->sortBy('name');
        $specialist = Specialist::find($telemed->specialist_id)->name;
        $organisation = Organisation::find($telemed->organisation_id)->name;
        return view('telemed.edit', compact('telemed', 'specialists', 'organisations', 'specialist', 'organisation'));
    }

    public function update(Telemed $telemed){
        $data = request()->validate([
            'number' => '',
            'creating_date' => '',
            'consult_date'=>'',
            'organisation_id' => '',
            'patient_name' => '',
            'patient_year' => '',
            'diagnosis' => '',
            'covid' => '',
            'specialist_id'=>'',
            'status' => ''
        ]);
        $org_id = Organisation::firstOrFail()->where('name', $data['organisation_id'])->get();
        if(isset($org_id[0])) {
            $data['organisation_id'] = $org_id[0]->id;
        }
        $specialist_id = Specialist::firstOrFail()->where('name', $data['specialist_id'])->get();
        if(isset($specialist_id[0])){
            $data['specialist_id'] = $specialist_id[0]->id;
        }
        $date = date('Y-m-d');
        if(!isset($data['creating_date'])) {
            $data['creating_date'] = $date;
        }
        if(!isset($data['consult_date'])) {
            $data['consult_date'] = $date;
        }
        $telemed->update($data);
        return redirect()->route('telemed.show', $telemed->id);
    }

    public function destroy(Telemed $telemed){
        $telemed->delete();
        return redirect()->route('telemed.index');
    }

    public function cancel(Telemed $telemed){
        $telemed->status = 'cancel';
        $telemed->update();
        return redirect()->route('telemed.show',$telemed->id);
    }
}
