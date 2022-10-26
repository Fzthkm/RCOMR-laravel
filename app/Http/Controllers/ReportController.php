<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Organisation;
use App\Models\Specialist;
use App\Models\Specialization;
use App\Models\Telemed;
use App\Models\Region;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){
        return view('report.index');
    }

    public function generate(){
        $data = request()->validate([
            'start' => 'date',
            'end' => 'date'
        ]);
        return redirect('/report/'.$data['start'] .'/'. $data['end']);
    }

    public function show($start, $end){
        $create_applications = Application::all()
            ->whereBetween('creating_date', [$start, $end]);
        $create_telemeds = Telemed::all()
            ->whereBetween('creating_date', [$start, $end]);
        $completed_applications = Application::all()
            ->whereBetween('consult_date', [$start,$end])
            ->where('status', '!=', 'cancel');
        $canceled_applications = Application::all()
            ->whereBetween('consult_date', [$start,$end])
            ->where('status', '=', 'cancel');
        $canceled_telemeds = Telemed::all()
            ->whereBetween('consult_date', [$start,$end])
            ->where('status', '=', 'cancel');
        $application_specialist_list = [];
        foreach ($completed_applications as $app) {
            $spec_name = Specialist::find($app->specialist_id)->name;
            if(array_key_exists($spec_name,$application_specialist_list)) {
                $application_specialist_list[$spec_name] += 1;
            }
            else {
                $application_specialist_list[$spec_name] = 1;
            }
        }
        $application_specialization_list = [];
        foreach ($application_specialist_list as $name => $count) {
            $specialization_name = Specialization::find(Specialist::where('name', '=', $name)->get()[0]->specialization_id)->name;
            if(array_key_exists($specialization_name,$application_specialization_list)) {
                $application_specialization_list[$specialization_name] += 1;
            }
            else {
                $application_specialization_list[$specialization_name] = 1;
            }
        }
        $covid_app_completed = Application::all()
            ->whereBetween('consult_date', [$start, $end])
            ->where('covid', '=', 'on')
            ->where('status', '!=', 'cancel');
        $covid_app_specialists = [];
        foreach($covid_app_completed as $app){
            array_push($covid_app_specialists, [$app->specialist_id => Specialist::find($app->specialist_id)->name]);
        }
        //Расчет процентов
        $app_completed_percent = count($create_applications) > 0? (count($completed_applications) * 100) / count($create_applications) : 100;
        $covid_app_percent = count($create_applications) > 0? count($covid_app_completed)*100 / count($completed_applications) : 100;

        $application_workplace_list = [];
        foreach ($application_specialist_list as $name => $count) {
            $workplace_name = Specialist::where('name', '=', $name)->get()[0]->workplace;
            $specialization_name = Specialization::find(Specialist::where('name', '=', $name)->get()[0]->specialization_id)->name;
            if(array_key_exists($workplace_name,$application_workplace_list)) {
                if(array_key_exists($specialization_name, $application_workplace_list[$workplace_name])){
                    $application_workplace_list[$workplace_name][$specialization_name] += 1;
                }
                else{
                    $application_workplace_list[$workplace_name][$specialization_name] = 1;
                }
            }
            else {
                $application_workplace_list[$workplace_name][$specialization_name] = 1;
            }
        }
        $application_organisation_list = [];
        foreach ($completed_applications as $app) {
            $organisation_name = Organisation::find($app->organisation_id)->name;
            $specialization_name = Specialization::find(Specialist::find($app->specialist_id)->specialization_id)->name;
            if(array_key_exists($organisation_name,$application_workplace_list)) {
                if(array_key_exists($specialization_name, $application_workplace_list[$organisation_name])){
                    $application_organisation_list[$organisation_name][$specialization_name] += 1;
                }
                else{
                    $application_organisation_list[$organisation_name][$specialization_name] = 1;
                }
            }
            else {
                $application_organisation_list[$organisation_name][$specialization_name] = 1;
            }
        }
        $application_region_list = [];
        foreach($completed_applications as $app){
            $region = Region::find(Organisation::find($app->organisation_id)->region_id);
            if(array_key_exists($region->name,$application_region_list)) {
                $application_region_list[$region->name] += 1;
            }
            else {
                $application_region_list[$region->name] = 1;
            }
        }
        $report = [
            'start' => $start,
            'end' => $end,
            'apps_created' => $create_applications,
            'apps_completed' => $completed_applications,
            'created_application_count' => count($create_applications),
            'created_telemed_count' => count($create_telemeds),
            'completed_application_count' => count($completed_applications),
            'telemed_canceled_count' => count($canceled_telemeds),
//            'completed_telemed_count' => count($completed_telemeds),
            'completed_applications_list' => $completed_applications,
//            'completed_telemeds_list' => $completed_telemeds,
            'application_percent' => $app_completed_percent,
            'covid_app_percent' => $covid_app_percent,
            'app_specialist_list' => $application_specialist_list,
            'app_specialization_list' => $application_specialization_list,
//            'telemed_specialist_list' => $telemed_specialist_list,
            'covid_app_count' => count($covid_app_completed),
            'covid_app_list' => $covid_app_completed,
            'covid_app_specialists' => $covid_app_specialists,
            'application_specialization_list' => $application_specialization_list,
            'application_workplace_list' => $application_workplace_list,
            'application_organisation_list' => $application_organisation_list,
            'application_region_list' => $application_region_list,
            'app_canceled_count' => count($canceled_applications),
        ];

        return view('report.show', compact('report'));
    }
}
