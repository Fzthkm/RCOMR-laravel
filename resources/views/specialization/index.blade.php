@extends('layouts.main')
@section('content')
    <h2 class="mt-3">Специализации</h2>
    <div class="d-flex">
        <a href="{{ route('specialization.create') }}" class="btn btn-primary m-1">Добавить</a>
        <a href="/" class="btn btn-primary m-1">Назад</a>
    </div>

    <table class="table table-striped">
        <thead>
        <th scope="col">№</th>
        <th scope="col">Название специализации</th>
        </thead>
        <tbody>
        @php ($i = 0)
        @foreach($specializations as $specialization)
            <tr>
                <td>{{++$i}}</td>
                <td>
                    <a href="{{route('specialization.show', $specialization->id)}}">
                        {{$specialization->name}}
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
