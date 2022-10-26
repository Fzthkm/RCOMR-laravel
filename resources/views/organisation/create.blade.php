@extends('layouts.main')
@section('content')
    <h2 class="mt-3">Создание учреждений</h2>
       <form action="{{ route('organisation.store') }}" method="post" class="mt-4">
           @csrf
           <div class="form-group mb-3">
               <label for="name" class="form-label">Название учреждения</label>
               <input type="text" name="name" id="name" class="form-control">
           </div>
           <div class="form-group mb-3">
               <label for="region" class="form-label">Регион</label>
               <select id="region" name="region_id" class="form-select">
                   @foreach($regions as $region)
                       <option value="{{$region->id}}">{{$region->name}}</option>
                   @endforeach
               </select>
           </div>
           <button type="submit" class="btn btn-primary">Создать</button>
           <a href="{{route('organisation.index')}}" class="btn btn-primary">Назад</a>
       </form>
@endsection
