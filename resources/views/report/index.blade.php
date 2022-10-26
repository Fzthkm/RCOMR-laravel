@extends('layouts.main')
@section('content')
    <h2 class="mt-3">Создание отчётов</h2>
    <p>Для создания отчета необходимо выбрать отчетный период, т.е. время, которое будет учтено при создании отчета</p>
    <form action="{{route('report.generate')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="start" class="form-label">Дата начала</label>
            <input type="date" id="start" name="start">
        </div>
        <div class="form-group">
            <label for="end" class="form-label">Дата конца</label>
            <input type="date" id="end" name="end">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Создать</button>
    </form>
@endsection
