@extends('layouts.main')
@section('content')
    <h2 class="mt-3">Редактирование информации об учреждении {{$organisation->name}}</h2>
    <form action="{{ route('organisation.update', $organisation->id) }}" method="post">
        @csrf
        @method('patch')
        <div class="form-group mb-3">
            <label for="name" class="form-label">Название учреждения</label>
            <input type="text" name="name" id="name" placeholder="Название" value="{{$organisation->name}}" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="region" class="form-label">Регион</label>
            <select id="region" name="region_id" class="form-select">
                @foreach($regions as $region)
                    <option value="{{$region->id}}" {{ $organisation->region_id == $region->id ? 'selected' : '' }}>{{$region->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </form>
@endsection
