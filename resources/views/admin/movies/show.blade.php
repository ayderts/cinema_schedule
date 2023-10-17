@extends('layouts.admin')

@section('content')
@section('content')
    <div class="container">
        <h1>Просмотр фильма</h1>
        <div class="d-flex justify-content-start align-items-center">
            <a href="{{ route('admin.movie.index') }}" class="btn btn-primary m-2">НАЗАД</a>
            <a href="{{ route('admin.movie.update',$movie->id) }}" class="btn btn-success m-2">РЕДАКТИРОВАТЬ</a>
            <form action="{{ route('movie.destroy', ['movie_id' => $movie->id]) }}" class="m-2" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger ">УДАЛИТЬ</button>
            </form>
        </div>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Изображение</th>
                <th>Описание</th>
                <th>Продолжительность</th>
                <th>Возрастные ограничения</th>
            </tr>
            <tr>
                <td>{{ $movie->id }}</td>
                <td>{{ $movie->title }}</td>
                <td>    <div class="image-thumbnail">
                        <img class="image-small"
                            src="{{ asset('images/' . $movie->image) }}"
                            alt="{{ $movie->title }}"
                            data-toggle="modal"
                            data-target="#imageModal-{{ $movie->id }}"
                        >
                    </div></td>
                <td>{{ $movie->description }}</td>
                <td>{{ $movie->duration ? $movie->duration.' минут' : ''  }} </td>
                <td>{{ $movie->age_limit ? $movie->age_limit.' +' : '' }}</td>
            </tr>
        </table>


    </div>
    <!-- Modal -->
    <div class="modal fade" id="imageModal-{{ $movie->id }}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: none;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">{{ $movie->title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="d-flex justify-content-center">
                        <img class="image-modal-content" src="{{ asset('images/' . $movie->image) }}" alt="{{ $movie->title }}">
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
<script>
    $(document).ready(function () {
        console.log('AYDER')
        // Enable Bootstrap modal functionality
        $('[data-toggle="modal"]').modal();
    });
</script>
<style>
    .image-modal-content {
        max-width: 100%;
        max-height: 80vh; /* Set a maximum height to fit within the modal */
    }
    .image-small{
        width: 30%;
    }
</style>
