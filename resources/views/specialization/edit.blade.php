@extends('layouts.main')
@section('content')
    <h2 class="mt-3">Изменение специализации</h2>
    <form action="{{ route('specialization.update', $specialization->id) }}" method="post">
        @csrf
        @method('patch')
        <div class="form-group mb-3">
            <label for="name" class="form-label">Название специализации</label>
            <input type="text" name="name" id="name" value="{{$specialization->name}}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        <a href="{{route('specialization.show', $specialization->id)}}" class="btn btn-primary">Назад</a>
    </form>
@endsection
