@extends('layouts.main')
@section('content')
    <h2 class="mt-3">Добавление специализации</h2>

    <form action="{{ route('specialization.store') }}" method="post">
        @csrf
        <div class="form-group mb-3">
            <label for="name" class="form-label">Наименование специализации</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
        <a href="{{route('specialization.index')}}" class="btn btn-primary">Назад</a>
    </form>
@endsection
