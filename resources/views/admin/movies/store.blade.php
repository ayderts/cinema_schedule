@extends('layouts.admin')
@section('content')
    <div>
        <form accept-charset="{{route('movie.store')}}" method="POST" enctype="multipart/form-data">
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

            <div class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Название">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Изображение</label>
                <input type="file" name="image" class="form-control" id="image" placeholder="Изображение">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea  class="form-control" name="description" id="description" placeholder="Описание"></textarea>
            </div>
            <div class="mb-3">
                <label for="duration" class="form-label">Продолжительность</label>
                <input type="text" name="duration" class="form-control" id="duration" placeholder="Продолжительность">
            </div>
            <div class="mb-3">
                <label for="age_limit" class="form-label">Возрастные ограничения</label>
                <input type="text" name="age_limit" class="form-control" id="age_limit" placeholder="Возрастные ограничения">
            </div>
            <button type="submit" class="btn btn-primary">ДОБАВИТЬ</button>
        </form>
    </div>
@endsection
