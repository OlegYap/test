@extends('layouts.app')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
<div class="admin-panel">
    <header class="header">
        <h1>Edit Product</h1>
        <a href="{{ route('products.index') }}" class="btn btn-primary">Back to Products</a>
    </header>
    <main class="main-content">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="product-name">Name:</label>
            <input type="text" id="product-name" name="name" value="{{ $product->name }}" required>

            <label for="product-description">Description:</label>
            <textarea id="product-description" name="description">{{ $product->description }}</textarea>

            <label for="product-price">Price:</label>
            <input type="number" id="product-price" name="price" step="0.01" value="{{ $product->price }}" required>

            <label for="product-category">Category:</label>
            <input type="text" id="product-category" name="category" value="{{ $product->category }}" required>

            <label for="product-image">Image:</label>
            <input type="file" id="product-image" name="image">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="product-image">
            @endif

            <button type="submit">Update</button>
        </form>
    </main>
</div>
</body>
</html>


<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .admin-panel {
        width: 80%;
        margin: auto;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: gray;
        color: #fff;
        padding: 15px;
    }

    .header h1 {
        margin: 0;
    }

    .btn {
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        color: #fff;
    }

    .btn-primary {
        background-color: gray;
    }

    .btn-primary:hover {
        background-color: gray;
    }

    main {
        padding: 20px;
    }

    form label {
        display: block;
        margin: 10px 0 5px;
    }

    form input, form textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    form button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 15px;
        border-radius: 4px;
        cursor: pointer;
    }

    form button:hover {
        background-color: #0056b3;
    }

    .product-image {
        width: 100px;
        height: 75px;
        object-fit: cover;
        border-radius: 4px;
    }
</style>
