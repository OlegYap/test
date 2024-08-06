@extends('layouts.app')
@section('content')
    <h1>Создать</h1>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="price">Цена</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="category">Категория</label>
            <input type="text" class="form-control" id="category" name="category" required>
        </div>
        <div class="form-group">
            <label for="image">Изображение</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
            <button type="submit" class="btn btn-primary">Подтвердить</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Назад</a>
    </form>
@endsection
