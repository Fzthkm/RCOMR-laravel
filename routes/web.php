<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TelemedController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SpecializationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/organisation/', [OrganisationController::class, 'index'])->name('organisation.index');
Route::get('/organisation/create', [OrganisationController::class, 'create'])->name('organisation.create');
Route::post('/organisation', [OrganisationController::class, 'store'])->name('organisation.store');
Route::get('/organisation/{organisation}', [OrganisationController::class, 'show'])->name('organisation.show');
Route::get('/organisation/{organisation}/edit', [OrganisationController::class, 'edit'])->name('organisation.edit');
Route::patch('/organisation/{organisation}', [OrganisationController::class, 'update'])->name('organisation.update');
Route::delete('/organisation/{organisation}', [OrganisationController::class, 'destroy'])->name('organisation.destroy');


Route::get('/specialist', [SpecialistController::class, 'index'])->name('specialist.index');
Route::get('/specialist/create', [SpecialistController::class, 'create'])->name('specialist.create');
Route::post('/specialist', [SpecialistController::class, 'store'])->name('specialist.store');
Route::get('/specialist/{specialist}', [SpecialistController::class, 'show'])->name('specialist.show');
Route::get('/specialist/{specialist}/edit', [SpecialistController::class, 'edit'])->name('specialist.edit');
Route::patch('/specialist/{specialist}', [SpecialistController::class, 'update'])->name('specialist.update');
Route::delete('/specialist/{specialist}', [SpecialistController::class, 'destroy'])->name('specialist.destroy');


Route::get('/app', [ApplicationController::class, 'index'])->name('application.index');
Route::get('/app/create', [ApplicationController::class, 'create'])->name('application.create');
Route::post('/app', [ApplicationController::class, 'store'])->name('application.store');
Route::get('/app/{application}', [ApplicationController::class, 'show'])->name('application.show');
Route::get('/app/{application}/edit', [ApplicationController::class, 'edit'])->name('application.edit');
Route::post('/app/{application}/cancel', [ApplicationController::class, 'cancel'])->name('application.cancel');
Route::patch('/app/{application}', [ApplicationController::class, 'update'])->name('application.update');
Route::delete('/app/{application}', [ApplicationController::class, 'destroy'])->name('application.destroy');


Route::get('/rtms', [TelemedController::class, 'index'])->name('telemed.index');
Route::get('/rtms/create', [TelemedController::class, 'create'])->name('telemed.create');
Route::post('/rtms', [TelemedController::class, 'store'])->name('telemed.store');
Route::get('/rtms/{telemed}', [TelemedController::class, 'show'])->name('telemed.show');
Route::get('/rtms/{telemed}/edit', [TelemedController::class, 'edit'])->name('telemed.edit');
Route::post('/rtms/{telemed}/cancel', [TelemedController::class, 'cancel'])->name('telemed.cancel');
Route::patch('/rtms/{telemed}', [TelemedController::class, 'update'])->name('telemed.update');
Route::delete('/rtms/{telemed}', [TelemedController::class, 'destroy'])->name('telemed.destroy');

Route::get('/region', [RegionController::class, 'index'])->name('region.index');
Route::get('/region/create', [RegionController::class, 'create'])->name('region.create');
Route::post('/region', [RegionController::class, 'store'])->name('region.store');
Route::get('/region/{region}', [RegionController::class, 'show'])->name('region.show');
Route::get('/region/{region}/edit', [RegionController::class, 'edit'])->name('region.edit');
Route::patch('/region/{region}', [RegionController::class, 'update'])->name('region.update');
Route::delete('/region/{region}', [RegionController::class, 'destroy'])->name('region.destroy');


Route::get('/spec', [SpecializationController::class, 'index'])->name('specialization.index');
Route::get('/spec/create', [SpecializationController::class, 'create'])->name('specialization.create');
Route::post('/spec', [SpecializationController::class, 'store'])->name('specialization.store');
Route::get('/spec/{specialization}', [SpecializationController::class, 'show'])->name('specialization.show');
Route::get('/spec/{specialization}/edit', [SpecializationController::class, 'edit'])->name('specialization.edit');
Route::patch('/spec/{specialization}', [SpecializationController::class, 'update'])->name('specialization.update');
Route::delete('/spec/{specialization}', [SpecializationController::class, 'destroy'])->name('specialization.destroy');


Route::get('/report', [ReportController::class, 'index'])->name('report.index');
Route::post('/report', [ReportController::class, 'generate'])->name('report.generate');
Route::get('/report/{start}/{end}', [ReportController::class, 'show'])->name('report.show');
