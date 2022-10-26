@extends('layouts.main')
@section('content')
    <h2 class="mt-3">{{$specialization->name}}</h2>
    <div>
        <form action="{{route('specialization.destroy', $specialization->id)}}" method="post">
            @csrf
            @method('delete')
            <a href="{{route('specialization.edit', $specialization->id)}}" class="btn btn-primary">Изменить</a>
            <button type="submit" class="btn btn-danger">Удалить</button>
            <a href="{{route('specialization.index')}}" class="btn btn-primary">Назад</a>
        </form>
    </div>
@endsection
