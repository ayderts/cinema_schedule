@extends('layouts.admin')
@section('content')
    <div>
        <form accept-charset="{{route('session.update',$session->id)}}" method="POST" enctype="multipart/form-data">>
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @method('patch')
            <div class="mb-3">
                <label for="date_time" class="form-label">Время сеанса</label>
                <input type="datetime-local" name="date_time" class="form-control" id="date_time" value="{{ date('Y-m-d\TH:i', strtotime($session->date_time)) }}">
            </div>
            <div class="mb-3">
                <label for="movie_id" class="form-label">Фильм</label>
                <select name="movie_id" class="form-select" id="movie_id">
                    @foreach($movies as $movie)
                        <option value="{{ $movie->id }}" {{ $session->movie_id === $movie->id ? 'selected' : '' }}>
                            {{ $movie->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">ИЗМЕНИТЬ</button>
        </form>
    </div>
@endsection
