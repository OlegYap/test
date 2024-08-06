{{--@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-5">Admin Panel</h1>
        <button class="btn btn-primary mb-3" id="add-product" data-toggle="modal" data-target="#addModal">Add Product</button>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->category }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning edit-btn" data-id="{{ $product->id }}" data-toggle="modal" data-target="#editModal"><i class="fas fa-pen"></i></button>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $product->id }}"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price">
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" class="form-control" id="category" name="category">
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveProduct">Save Product</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editId" name="id">
                        <div class="form-group">
                            <label for="editName">Name</label>
                            <input type="text" class="form-control" id="editName" name="name">
                        </div>
                        <div class="form-group">
                            <label for="editPrice">Price</label>
                            <input type="number" class="form-control" id="editPrice" name="price">
                        </div>
                        <div class="form-group">
                            <label for="editCategory">Category</label>
                            <input type="text" class="form-control" id="editCategory" name="category">
                        </div>
                        <div class="form-group">
                            <label for="editImage">Image</label>
                            <input type="file" class="form-control-file" id="editImage" name="image">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Add Product
            $('#saveProduct').click(function() {
                var formData = new FormData($('#addForm')[0]);
                $.ajax({
                    url: '{{ route('products.store') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        location.reload();
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });

            // Edit Product
            $('.edit-btn').click(function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '/products/' + id + '/edit',
                    type: 'GET',
                    success: function(response) {
                        $('#editId').val(response.id);
                        $('#editName').val(response.name);
                        $('#editPrice').val(response.price);
                        $('#editCategory').val(response.category);
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });

            $('#saveChanges').click(function() {
                var id = $('#editId').val();
                var formData = new FormData($('#editForm')[0]);
                formData.append('_method', 'PUT');
                $.ajax({
                    url: '/products/' + id,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        location.reload();
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });

            // Delete Product
            $('.delete-btn').click(function() {
                var id = $(this).data('id');
                if (confirm('Are you sure you want to delete this product?')) {
                    $.ajax({
                        url: '/products/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            location.reload();
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        });
    </script>
@endsection--}}

@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Products</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
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

            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
</div>

<script src="{{ asset('js/script.js') }}"></script>
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
