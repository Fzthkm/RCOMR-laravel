@extends('layouts.main')
@section('content')
    <h2 class="mt-3">Специалисты</h2>
    <div class="d-flex">
        <a href="{{ route('specialist.create') }}" class="btn btn-primary m-1">Добавить</a>
        <a href="/" class="btn btn-primary m-1">Назад</a>
    </div>

    <table class="table table-striped">
        <thead>
        <th scope="col">№</th>
        <th scope="col">ФИО</th>
        <th scope="col">Специализация</th>
        <th scope="col">Учреждение</th>
        <th scope="col">Ученая степень</th>
        </thead>
        <tbody>
        @php($i = 0)
        @foreach($specialists as $specialist)
            <tr>
                <td>{{++$i}}</td>
                <td>
                    <a href="{{route('specialist.show', $specialist->id)}}">
                        {{$specialist->name}}
                    </a>
                </td>
                <td>{{$specialist->specialization_name}}</td>
                <td>{{$specialist->workplace}}</td>
                <td>{{$specialist->academic_degree}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

