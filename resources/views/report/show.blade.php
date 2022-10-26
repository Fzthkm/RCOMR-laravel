@extends('layouts.main')
@section('content')
    <h2 class="mt-3">Отчет за период с {{date_format(date_create($report['start']), 'd.m.Y')}}
        по {{date_format(date_create($report['end']), 'd.m.Y')}}</h2>

    <div class="border border-dark rounded p-3 mb-4">
        <h4>Общая информация</h4>
        <p>Было создано заявок: {{$report['created_application_count']}}, из них отменено: {{$report['app_canceled_count']}}<br>
            Было выполнено заявок: {{$report['completed_application_count']}}
            ({{round($report['application_percent'], 2)}}%)</p>
        <p>Было проведено заявок по телемедицине: {{$report['created_telemed_count']}}, из них отменено: {{$report['telemed_canceled_count']}}
            ({{round(($report['created_telemed_count'] - $report['telemed_canceled_count'])*100/($report['created_telemed_count'] == 0?1:$report['created_telemed_count']), 2)}}%)</p>
    </div>
    <div class="border border-dark rounded p-3 mb-4">
        <h4>Информация о Covid-19</h4>
        <p>Среди выполненных заявок, заявок с Covid-19: {{$report['covid_app_count']}}, что
            составляет {{round($report['covid_app_percent'], 2)}}% от общего количества</p>
        <table class="table table-striped border border-dark p-3 mb-4">
            <thead>
            <th scope="col">Дата выезда</th>
            <th scope="col">Специалист</th>
            </thead>
            <tbody>
            @foreach($report['covid_app_list'] as $app)
                <tr>
                    <td>{{date_format(date_create($app->consult_date), 'd.m.Y')}}</td>
                    <td class="col-md-5">{{$report['covid_app_specialists'][0][strval($app->specialist_id)]}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <h4>Итого: {{$report['covid_app_count']}}</h4>
    </div>
    <div class="border border-dark rounded p-3 mb-4">
        <h4>Выезды специалистов</h4>
        <table class="table table-striped border border-dark p-3 mb-4">
            <thead>
            <th scope="col">Специалист</th>
            <th scope="col">Количество выездов</th>
            </thead>
            <tbody>
            @foreach($report['app_specialist_list'] as $key => $value)
                <tr>
                    <td>{{$key}}</td>
                    <td class="col-md-2 text-center">{{$value}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <h4>Итого: {{count($report['app_specialist_list'])}}</h4>
    </div>
    <div class="border border-dark rounded p-3 mb-4">
        <h4>Выезды по специализациям</h4>
        <table class="table table-striped border border-dark p-3 mb-4">
            <thead>
            <th scope="col">Специализация</th>
            <th scope="col">Количество выездов</th>
            </thead>
            <tbody>
            @foreach($report['app_specialization_list'] as $key => $value)
                <tr>
                    <td>{{$key}}</td>
                    <td class="col-md-2 text-center">{{$value}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <h4>Итого: {{count($report['app_specialist_list'])}}</h4>
    </div>

    <div class="border border-dark rounded p-3 mb-4">
        <h4>Выезды из учреждений</h4>
        @foreach($report['application_workplace_list'] as $workplace => $specializations_count)
            <h4>{{$workplace}}</h4>
        <table class="table table-striped border border-dark p-3 mb-4">
            <thead>
            <th scope="col">Специализация</th>
            <th scope="col">Количество выездов</th>
            </thead>
            <tbody>

                @foreach($specializations_count as $specialization => $count)
                    <tr>
                        <td>{{$specialization}}</td>
                        <td class="col-md-2 text-center">{{$count}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach
        <h4>Итого: {{count($report['app_specialist_list'])}}</h4>
    </div>

    <div class="border border-dark rounded p-3 mb-4">
        <h4>Выезды в учреждения</h4>
        @foreach($report['application_organisation_list'] as $workplace => $specializations_count)
            <h4>{{$workplace}}</h4>
            <table class="table table-striped border border-dark p-3 mb-4">
                <thead>
                <th scope="col">Специализация</th>
                <th scope="col">Количество выездов</th>
                </thead>
                <tbody>

                @foreach($specializations_count as $specialization => $count)
                    <tr>
                        <td>{{$specialization}}</td>
                        <td class="col-md-2 text-center">{{$count}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endforeach
        <h4>Итого: {{count($report['app_specialist_list'])}}</h4>
    </div>
    <div class="border border-dark rounded p-3 mb-4">
        <h4>Вызовы по регионам</h4>
            <table class="table table-striped border border-dark p-3 mb-4">
                <thead>
                <th scope="col">Регион</th>
                <th scope="col">Количество выездов</th>
                </thead>
                <tbody>
                @foreach($report['application_region_list'] as $region => $count)
                    <tr>
                        <td>{{$region}}</td>
                        <td>{{$count}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        <h4>Итого: {{count($report['app_specialist_list'])}}</h4>
    </div>
    {{--        {{dd($report)}}--}}
@endsection
