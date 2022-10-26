@extends('layouts.main')
@section('content')
    <h2 class="mt-3">{{$organisation->name}}</h2>
    <div class="mb-3">{{isset($region) ? 'Регион: '.$region->name : ''}}</div>

    <form action="{{route('organisation.destroy', $organisation->id)}}" method="post">
        <a href="{{route('organisation.edit', $organisation->id)}}" class="btn btn-primary">Изменить</a>
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger">Удалить</button>

        <a href="{{route('organisation.index')}}" class="btn btn-primary">Назад</a>
    </form>
@endsection
