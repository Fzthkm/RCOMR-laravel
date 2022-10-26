@extends('layouts.main')
@section('content')
    <h2 class="mt-3">Создание заявки</h2>
    <form action="{{ route('telemed.store') }}" method="post">
        @csrf
        <div class="form-group mb-3">
            <label for="number" class="form-label">Номер заявки</label>
            <input type="text" name="number" id="number" class="form-control" value="{{old('number')}}">
        </div>
        <div class="form-group mb-3">
            <label for="creating_date" class="form-label">Дата поступления заявки</label>
            <input type="date" name="creating_date" id="creating_date" value="{{old('creating_date')}}">
        </div>
        <div class="form-group mb-3">
            <label for="consult_date" class="form-label">Дата проведения консультации</label>
            <input type="date" name="consult_date" id="consult_date" value="{{old('consult_date')}}">
        </div>
        <!-- Организация -->
        <div class="form-group mb-3">
            <label for="organisation" class="form-label">Организация</label>
            <input list="organisations" name="organisation_id" id="organisation" class="form-control">
            <datalist id="organisations">
                @foreach($organisations as $organisation)
                    <option>{{$organisation->name}}</option>
                @endforeach
            </datalist>
            <a href="{{route('organisation.create')}}">Добавить учреждение</a>
        </div>
        <div class="form-group mb-3">
            <label for="patient_name" class="form-label">Имя пациента</label>
            <input type="text" name="patient_name" id="patient_name" class="form-control" value="{{old('patient_name')}}">
        </div>
        <div class="form-group mb-3">
            <label for="patient_year" class="form-label">Год рождения</label>
            <input type="number" name="patient_year" id="patient_year" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="diagnosis" class="form-label">Диагноз</label>
            <input type="text" name="diagnosis" id="diagnosis" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="covid" class="form-label text-danger"><h4>Covid-19</h4></label>
            <input type="checkbox" name="covid" id="covid" class="form-check-input">
        </div>
        <div class="form-group mb-3">
            <label for="specialist" class="form-label">Специалист</label>
            <input list="specialists" name="specialist_id" id="organisation" class="form-control">
            <datalist id="specialists">
                @foreach($specialists as $specialist)
                    <option>{{$specialist->name}}</option>
                @endforeach
            </datalist>
            <a href="{{route('specialist.create')}}">Добавить специалиста</a>
        </div>
        <button type="submit" class="btn btn-primary mb-5">Создать</button>
    </form>
@endsection
