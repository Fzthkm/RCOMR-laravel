@extends('layouts.main')
@section('content')
    <h2 class="mt-3">Добавление специалиста</h2>
    <form action="{{ route('specialist.store') }}" method="post">
        @csrf
        <div class="form-group mb-3">
            <label for="name" class="form-label">ФИО *</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="workplace" class="form-label">Место работы *</label>
            <input type="text" name="workplace" id="workplace" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="specialization" class="form-label">Специализация *</label>
            <input list="specializations" name="specialization_id" id="specialization" class="form-control">
            <datalist id="specializations">
                @foreach($specializations as $specialization)
                    <option value="{{$specialization->name}}"></option>
                @endforeach
            </datalist>
        </div>
        <div class="form-group mb-3">
            <label for="academic_degree" class="form-label">Ученая степень, ученое звание</label>
            <input type="text" name="academic_degree" id="academic_degree" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="additional_info" class="form-label">Дополнительная информация</label>
            <input type="text" name="additional_info" id="additional_info" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
        <a href="{{route('specialist.index')}}" class="btn btn-primary">Назад</a>
    </form>
@endsection
