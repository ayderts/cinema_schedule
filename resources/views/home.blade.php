@extends('layouts.guest')

@section('content')
    <div>
        <h1>Список сеансов</h1>
        <div class="sessions-list">
            @php
                $sortedSessions = $sessions->sortBy('date_time');
            @endphp


                <table class="table">
                    <tr>
                        <th>Фильм</th>
                        <th>Время</th>
                        <th>Стоимость билета</th>
                        <th>Изображение</th>
                        <th>Описание</th>
                        <th>Продолжительность</th>
                        <th>Возрастные ограничения</th>
                    </tr>
                    @foreach($sortedSessions as $session)
                    <tr>
                        <td>{{ $session->movie->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($session->date_time)->format('d.m.y H:i')}} </td>
                        <td>{{ $session->price }}</td>
                        <td>    <div class="image-thumbnail">
                                <img class="image-small"
                                     src="{{ asset('images/' . $session->movie->image) }}"
                                     alt="{{ $session->movie->title }}"
                                     data-toggle="modal"
                                     data-target="#imageModal-{{ $session->movie->id }}"
                                >
                            </div></td>

                        <td>{{ $session->movie->description }}</td>
                        <td>{{ $session->movie->duration ? $session->movie->duration.' минут' : ''}}</td>
                        <td>{{ $session->movie->age_limit ? $session->movie->age_limit.' +' : '' }}</td>
                    </tr>
                    @endforeach
                </table>
        </div>
    </div>
    <style>
        .image-small {
            max-width: 100px; /* Adjust the width to your preferred size */
            max-height: 100px; /* Adjust the height to your preferred size */
        }
    </style>
@endsection
