@extends('layouts.main')
@section('content')
    <h2 class="mt-3">Заявка №{{$telemed->number}}</h2>
    <div class="mb-3">
        <div class="mb-3">Дата создания: {{date_format(date_create($telemed->creating_date), 'd.m.Y')}}</div>
        <div class="mb-3">Пациент: {{$telemed->patient_name}}</div>
        <div class="mb-3">Год рождения: {{$telemed->patient_year}}</div>
        <div class="mb-3">Диагноз: {{$telemed->diagnosis}}
            @if($telemed->covid == 'true')
                , <span class="text-danger">Covid-19</span>
            @endif
        </div>
        <div class="mb-3">Организация: {{$telemed->organisation_name}}</div>
        <div class="mb-3">Специалист: {{$telemed->specialist_name}}</div>
        <div class="mb-3">Дата проведения консультации: {{date_format(date_create($telemed->consult_date), 'd.m.Y')}}</div>
        @if($telemed->status == 'cancel')
            <div class="mb-3 text-danger">Заявка отменена</div>
        @endif
    </div>
    <form action="{{route('telemed.destroy', $telemed->id)}}" method="post">
        <a href="{{route('telemed.edit', $telemed->id)}}" class="btn btn-primary">Изменить</a>
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger">Удалить</button>

        <a href="{{route('telemed.index')}}" class="btn btn-primary">Назад</a>
    </form>
    <form action="{{route('telemed.cancel', $telemed->id)}}" method="post">
        @csrf
        <button type="submit" class="btn btn-danger mt-3">Отменить заявку</button>
    </form>
@endsection
