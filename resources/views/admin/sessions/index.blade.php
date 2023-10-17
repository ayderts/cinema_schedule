@extends('layouts.admin')

@section('content')
    <div>
        <h1>Список сеансов</h1>
        <div class="sessions-list">
            @php
                $sortedSessions = $sessions->sortBy('date_time');
            @endphp

            @foreach($sortedSessions as $session)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{route('admin.session.show', $session->id)}}">
                                {{$session->id}}. {{$session->movie->title}} - {{\Carbon\Carbon::parse($session->date_time)->format('d.m.y H:i')}}
                            </a>
                        </h5>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-4">
        <a href="{{route('admin.session.store')}}" class="btn btn-success">ДОБАВИТЬ</a>
    </div>
@endsection

