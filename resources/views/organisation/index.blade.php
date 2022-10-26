@extends('layouts.main')
@section('content')
    <h2 class="mt-3">Организации</h2>
    <div class="d-flex">
        <a href="{{ route('organisation.create') }}" class="btn btn-primary m-1">Добавить</a>
        <a href="/" class="btn btn-primary m-1">Назад</a>
    </div>

    <table class="table table-striped">
        <thead>
            <th scope="col">№</th>
            <th scope="col">Название</th>
            <th scope="col">Регион</th>
        </thead>
        <tbody>
            @php($i = 0)
            @foreach($organisations as $organisation)
                <tr>
                        <td>{{++$i}}</td>
                        <td>
                            <a href="{{route('organisation.show', $organisation->id)}}">
                                {{$organisation->name}}
                            </a>
                        </td>
                        <td>{{isset($organisation->region_id) ? $regions[$organisation->region_id - 1]->name : ''}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
