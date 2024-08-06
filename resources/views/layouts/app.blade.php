<!DOCTYPE html>
<html>
<head>
    <title>Delivery App</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="menu-button">☰</div>
<div class="menu">
    <a href="{{ route('main.index') }}">Home</a>
    <a href="{{ route('products.index') }}">Manage Products</a>
    <a href="{{ route('products.create') }}">Add Product</a>
</div>
<div class="content">
    @yield('content')
</div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.querySelector('.menu-button');
        const menu = document.querySelector('.menu');
        const content = document.querySelector('.content');

        menuButton.addEventListener('click', function() {
            menu.classList.toggle('show');
            content.classList.toggle('shift');
        });
    });
</script>


<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        overflow-x: hidden; /* Предотвращает горизонтальную прокрутку */
    }

    .menu-button {
        cursor: pointer;
        font-size: 24px;
        padding: 7px;
        background: #333;
        color: #fff;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        width: 50px; /* Ширина кнопки меню */
        text-align: center;
    }

    .menu {
        position: fixed;
        top: 50px;
        left: -250px; /* Начальная позиция скрыта за пределами экрана */
        width: 175px;
        height: 100vh; /* Обеспечивает, что меню занимает всю высоту экрана */
        background: #333;
        color: #fff;
        overflow-y: auto;
        transition: left 0.3s ease;
        z-index: 999;
    }

    .menu.show {
        left: 0; /* Показывает меню при добавлении класса 'show' */
    }

    .menu a {
        color: #fff;
        display: block;
        padding: 15px;
        text-decoration: none;
    }

    .menu a:hover {
        background: #555;
    }

    .content {
        margin-left: 50px; /* Сдвигает основной контент вправо на ширину кнопки меню */
        padding: 20px;
        transition: margin-left 0.3s ease;
    }

    .content.shift {
        margin-left: 250px; /* Сдвигает контент вправо на ширину меню при открытом меню */
    }
</style>
