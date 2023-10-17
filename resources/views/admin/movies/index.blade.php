@extends('layouts.admin')

@section('content')
    <div>
        <h1>Cписок фильмов</h1>
        @foreach($movies as $movie)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{route('admin.movie.show',$movie->id)}}">{{$movie->id}}.{{$movie->title}}</a>
            </h5>
        </div>
    </div>
        @endforeach
    </div>
    <div class="mt-4">
        <a  href="{{route('admin.movie.store')}}" class="btn btn-success">ДОБАВИТЬ</a>
    </div>
@endsection

