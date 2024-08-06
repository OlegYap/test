@extends('layouts.app')

    <!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="menu-button">☰ Menu</div>
<div class="menu">
    <a href="{{ route('products.index') }}">Back to Products</a>
</div>
<h1>Edit Product</h1>
<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label>Name:</label>
    <input type="text" name="name" value="{{ $product->name }}" required>
    <label>Description:</label>
    <textarea name="description">{{ $product->description }}</textarea>
    <label>Price:</label>
    <input type="number" step="0.01" name="price" value="{{ $product->price }}" required>
    <label>Category:</label>
    <input type="text" name="category" value="{{ $product->category }}" required>
    <label>Image:</label>
    <input type="file" name="image">
    @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" style="width:100px;">
    @endif
    <button type="submit">Update</button>
</form>
</body>
</html>
