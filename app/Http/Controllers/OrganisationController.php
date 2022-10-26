<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\Region;
use Illuminate\Http\Request;

class OrganisationController extends Controller
{
    public function index()
    {
        $organisations = Organisation::all()->reverse();
        $regions = Region::all();
        return view('organisation.index', compact('organisations', 'regions'));
    }

    public function create(){
        if(!Region::find(1)) {
            $regions = [
                ['name' => 'Брестская область'],
                ['name' => 'Витебская область'],
                ['name' => 'Гомельская область'],
                ['name' => 'Гродненская область'],
                ['name' => 'Минская область'],
                ['name' => 'Могилевская область'],
                ['name' => 'Город Минск'],
                ['name' => 'РНПЦ'],
            ];
            foreach($regions as $item){
                Region::create($item);
            }
        }
        $regions = Region::all();
        return view('organisation.create', compact('regions'));
    }

    public function store(){
        $data = request()->validate([
            'name' => 'string',
            'region_id' => 'integer',
        ]);
        Organisation::create($data);
        return redirect()->route('organisation.index');
    }

    public function show(Organisation $organisation){
        $region = Region::find($organisation->region_id);
        return view('organisation.show', compact('organisation', 'region'));
    }

    public function edit(Organisation $organisation){
        $regions = Region::all();
        return view('organisation.edit', compact('organisation', 'regions'));
    }

    public function update(Organisation $organisation){
        $data = request()->validate([
            'name' => 'string',
            'region_id' => 'integer',
        ]);
        $organisation->update($data);
        return redirect()->route('organisation.show', $organisation->id);
    }

    public function destroy(Organisation $organisation){
        $organisation->delete();
        return redirect()->route('organisation.index');
    }
}
