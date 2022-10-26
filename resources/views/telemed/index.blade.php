@extends('layouts.main')
@section('content')
    <h2 class="mt-3">Заявки по РТМС</h2>
    <div class="d-flex">
        <a href="{{ route('telemed.create') }}" class="btn btn-primary m-1">Добавить</a>
        <a class="btn btn-primary m-1" href="/">Назад</a>
    </div>
    <table class="table table-striped">
        <thead>
        <th scope="col">№</th>
        <th scope="col">Дата</th>
        <th scope="col">Организация</th>
        <th scope="col">Пациент</th>
        <th scope="col">Специалист</th>
        </thead>
        <tbody>
        @foreach($applications as $application)
            <tr>
                <td><a href="{{route('telemed.show', $application->id)}}">{{$application->number}}</a></td>
                <td>{{date_format(date_create($application->creating_date), 'd.m.Y')}}</td>
                <td>{{$application->organisation}}</td>
                <td>{{$application->patient_name}}</td>
                <td>{{$application->specialist}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
