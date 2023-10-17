@extends('layouts.admin')


@section('content')
    <div class="container">
        <h1>Просмотр сеанса</h1>
        <div class="d-flex justify-content-start align-items-center">
            <a href="{{ route('admin.session.index') }}" class="btn btn-primary m-2">НАЗАД</a>
            <a href="{{ route('admin.session.update',$session->id) }}" class="btn btn-success m-2">РЕДАКТИРОВАТЬ</a>
            <form action="{{ route('session.destroy', ['session' => $session->id]) }}" class="m-2" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger ">УДАЛИТЬ</button>
            </form>
        </div>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Фильм</th>
                <th>Время</th>
                <th>Стоимость билета</th>
                <th>Изображение</th>
                <th>Описание</th>
                <th>Продолжительность</th>
                <th>Возрастные ограничения</th>
            </tr>
            <tr>
                <td>{{ $session->id }}</td>
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
        </table>
    </div>


@endsection
<style>
    .image-modal-content {
        max-width: 100%;
        max-height: 80vh; /* Set a maximum height to fit within the modal */
    }
    .image-small{
        width: 30%;
    }
</style>
