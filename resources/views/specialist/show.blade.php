@extends('layouts.main')
@section('content')
    <h2 class="mt-3">{{$specialist->name}}</h2>
    <div>
        <div class="mb-1">Учреждение: {{$specialist->workplace}}</div>
        <div class="mb-1">Специализация: {{$specialization}}</div>
        <div class="mb-1">Ученая степень: {{$specialist->academic_degree}}</div>
        <div class="mb-1">Дополнительная информация: {{$specialist->additional_info}}</div>
    </div>
    <div>
        <form action="{{route('specialist.destroy', $specialist->id)}}" method="post">
            @csrf
            @method('delete')
            <a href="{{route('specialist.edit', $specialist->id)}}" class="btn btn-primary">Изменить</a>
            <button type="submit" class="btn btn-danger">Удалить</button>
            <a href="{{route('specialist.index')}}" class="btn btn-primary">Назад</a>
        </form>
    </div>
@endsection
