@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Products</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="admin-panel">
    <header class="header">
        <h1>Управление товарами</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Добавить продукт</a>
    </header>
    <main class="main-content">
        <table class="product-table">
            <thead>
            <tr>
                <th>Изображение</th>
                <th>ID</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Категория</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                        @else
                            <img src="{{ asset('images/default.png') }}" alt="Default Image" class="product-image">
                        @endif
                    </td>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->category }}</td>
                    <td class="actions">
{{--                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-edit">
                            <i class="fas fa-pencil-alt"></i>
                        </a>--}}
                        <button class="btn btn-edit" onclick="openEditModal({{ $product->id }})">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Вы точно хотите удалить этот продукт?')">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination">
            {{ $products->links('vendor.pagination.default') }}
        </div>
    </main>
</div>

<div id="edit-product-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h2>Редактировать продукт</h2>
        <form id="edit-product-form" method="POST" action="">
            @csrf
            @method('PUT')

            <label for="product-name">Название:</label>
            <input type="text" id="product-name" name="name" required>

            <label for="product-price">Цена:</label>
            <input type="number" id="product-price" name="price" required>

            <label for="product-category">Категория:</label>
            <input type="text" id="product-category" name="category" required>

            <label for="product-description">Описание:</label>
            <textarea id="product-description" name="description" rows="4" required></textarea>

            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
</div>

</body>
</html>


<script>
    function openEditModal(productId) {
        fetch(`/products/${productId}/edit`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('product-name').value = data.name;
                document.getElementById('product-price').value = data.price;
                document.getElementById('product-category').value = data.category;
                document.getElementById('product-description').value = data.description; // Добавлено
                document.getElementById('edit-product-form').action = `/products/${productId}`;
                document.getElementById('edit-product-modal').style.display = 'block';
            })
            .catch(error => console.error('Error fetching product data:', error));
    }
    function closeEditModal() {
        document.getElementById('edit-product-modal').style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target === document.getElementById('edit-product-modal')) {
            closeEditModal();
        }
    };
</script>

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

    .product-table {
        width: 100%;
        border-collapse: collapse;
    }

    .product-table th, .product-table td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .product-table th {
        background-color: #f4f4f4;
    }

    .product-image {
        width: 100px;
        height: 75px;
        object-fit: cover;
        border-radius: 4px;
    }

    .actions {
        display: flex;
        gap: 10px;
    }

    .btn-edit, .btn-delete {
        background: none;
        border: none;
        cursor: pointer;
    }

    .icon-pencil, .icon-cross {
        font-size: 18px;
    }

    .btn-edit i {
        color: #007bff;
    }

    .btn-edit i:hover {
        color: #0056b3;
    }

    .btn-delete i {
        color: #dc3545;
    }

    .btn-delete i:hover {
        color: #c82333;
    }

    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: #fff;
        margin: 15% auto;
        padding: 20px;
        border-radius: 8px;
        width: 80%;
        max-width: 500px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    form label {
        display: block;
        margin: 10px 0 5px;
    }

    form input {
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

    .pagination {
        padding: 20px;
        text-align: center;
    }

    .pagination .page-item {
        display: inline-block;
        margin: 0 5px;
    }

    .pagination .page-link {
        padding: 0.5rem 0.75rem;
        line-height: 1.25;
        color: gray;
        background-color: #fff;
        border: 1px solid #dee2e6;
        text-decoration: none;
    }

    .pagination .page-link:hover {
        color: gray;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    .pagination .page-item.active .page-link {
        color: #fff;
        background-color: gray;
        border-color: white;
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        cursor: auto;
    }
</style>
