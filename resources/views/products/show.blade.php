@extends('layouts.app')

    <!DOCTYPE html>
<html>
<head>
    <title>Product Details</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="menu-button">☰ Menu</div>
<div class="menu">
    <a href="{{ route('products.index') }}">Back to Products</a>
</div>
<h1>{{ $product->name }}</h1>
<p>{{ $product->description }}</p>
<p>Price: ${{ $product->price }}</p>
<p>Category: {{ $product->category }}</p>
@if($product->image)
    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" style="width:300px;">
@endif
<a href="{{ route('products.edit', $product->id) }}">Edit</a>
<form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>
</body>
</html>
