@extends('layouts.main')
@section('content')
    <h2>Изменение информации о специалисте</h2>
    <form action="{{route('specialist.update', $specialist->id)}}">
        @csrf
        @method('patch')
        <div class="form-group mb-3">
            <label for="name">ФИО *</label>
            <input type="text" name="name" id="name" value="{{$specialist->name}}" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="workplace">Место работы</label>
            <input type="text" value="{{$specialist->workplace}}" name="workplace" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="specialization">Специализация</label>
            <input list="specializations" name="specialization_id" id="specialization" class="form-control" value="{{$specialization}}">
            <datalist id="specializations">
                 @foreach($specializations as $spec)
                    <option value="{{$spec->name}}" {{($spec->name == $specialization)? "selected" : ""}}></option>
                @endforeach
            </datalist>
        </div>
        <div class="form-group mb-3">
            <label for="academic_degree">Ученая степень</label>
            <input type="text" value="{{$specialist->academic_degree}}" name="academic_degree" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="additional_info" class="form-label">Дополнительная информация</label>
            <input type="text" value="{{$specialist->additional_info}}" id="additional_info" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </form>
@endsection
