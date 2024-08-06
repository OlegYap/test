<!DOCTYPE html>
<html>
<head>
    <title>Main Menu</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<header>
    <h1 class="header-title"></h1>
    <i class="fas fa-shopping-cart header-cart"></i>
</header>
<main>
    <div class="menu-button">☰ Menu</div>
    <div class="menu">
        <a href="{{ route('main.index') }}">Home</a>
        <a href="{{ route('products.index') }}">Управление товарами</a>
        <a href="{{ route('products.create') }}">Добавить товар</a>
        <a href="#">О нас</a>
        <a href="#">Наши контакты</a>
    </div>
    <div class="content">
        <h1 style="text-align: center;">Доставка вкусной еды прямо к вам домой</h1>
        <div class="card-container">
            @foreach($products as $product)
                <div class="card">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="card-image">
                    @endif
                    <div class="card-content">
                        <h2 class="card-title">{{ $product->name }}</h2>
                        <p class="card-description">{{ $product->description }}</p>
                        <p class="card-price">${{ number_format($product->price, 2) }}</p>
                        <a href="#" class="card-link">В корзину</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="pagination">
        {{ $products->links('vendor.pagination.default') }}
    </div>
</main>
</body>
<footer>
    <div class="row">
        <div class="col">
            <img src="https://png.pngtree.com/png-clipart/20200225/original/pngtree-ninja-logo-design-icon-vector-png-image_5290326.jpg" alt="logo-footer" class="logo-footer">
            <p>Молодая компания готовая предоставить вам наши услуги</p>
        </div>
        <div class="col">
            <h3>Наши точки</h3>
            <p>Ул.Пушкина, г.Улан-Удэ</p>
            <p class="email-id">food@mail.ru</p>
            <h4>+79995552211</h4>
        </div>
        <div class="col">
            <h3>Ссылки</h3>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contacts</a></li>
            </ul>
        </div>
        <div class="col">
            <div class="social-icons">
                <i class="fab fa-telegram"></i>
                <i class="fab fa-vk"></i>
                <i class="fab fa-instagram"></i>
            </div>
        </div>
    </div>
    <hr>
    <div class="copyright">
        <p>&copy; 2024 Delivery App. Все права защищены.</p>
    </div>
</footer>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.querySelector('.menu-button');
        const menu = document.querySelector('.menu');

        menuButton.addEventListener('click', function() {
            menu.classList.toggle('show');
            document.querySelector('.content').classList.toggle('shift');
        });
    });
</script>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    .menu-button {
        cursor: pointer;
        font-size: 24px;
        padding: 15px;
        background: #333;
        color: #fff;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
    }
    .menu {
        position: fixed;
        top: 0;
        bottom: 5px;
        left: -250px;
        width: 250px;
        height: 100%;
        background: #333;
        color: #fff;
        overflow-y: auto;
        transition: left 0.3s ease;
        z-index: 999;
    }
    .menu.show {
        left: 0;
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
    header {
        background: #333;
        padding: 20px;
        text-align: center;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .header-title {
        margin: 0;
    }
    .header-cart {
        color: white;
        font-size: 24px;
    }
    main {
        flex: 1;
        padding: 20px;
        transition: margin-left 0.3s ease;
    }

    .home {
        display: none;
    }
    .content.shift {
        margin-left: 0;
    }
    .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        gap: 1rem;
        margin-left: 300px; /*регулирует расположение карточек*/
    }
    .card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 300px;
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: scale(1.03);
    }
    .card-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }
    .card-content {
        padding: 15px;
    }
    .card-title {
        margin: 0;
        font-size: 1.2em;
    }
    .card-description {
        margin: 10px 0;
        color: #666;
    }
    .card-price {
        font-size: 1em;
        color: #333;
    }
    .card-link {
        display: inline-block;
        padding: 10px 15px;
        background: #333;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background 0.3s ease;
    }
    .card-link:hover {
        background: #555;
    }
    footer {
        width: 100%;
        background: linear-gradient(to right, gray, white);
        color: #fff;
        border-top-left-radius: 15px;
        font-size: 13px;
        line-height: 10px;
        padding: 10px 0;
    }
    .row {
        width: 85%;
        margin: auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .col {
        flex: 1;
        padding: 10px;
        max-width: 25%;
    }
    .logo-footer {
        width: 80px;
        margin-bottom: 20px;
    }
    .col h3 {
        margin-bottom: 20px;
    }
    .email-id {
        border-bottom: 1px solid #ccc;
        margin: 20px 0;
    }
    ul li {
        list-style: none;
        margin-bottom: 12px;
    }
    ul li a {
        text-decoration: none;
        color: white;
    }
    .social-icons {
        display: flex;
        gap: 15px;
    }
    .social-icons .fab {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        text-align: center;
        line-height: 40px;
        font-size: 20px;
        color: #000;
        background: white;
        cursor: pointer;
    }
    hr {
        width: 90%;
        border: 0;
        border-bottom: 1px solid #ccc;
        margin: 20px auto;
    }
    .copyright {
        text-align: center;
        font-size: 12px;
        color: #666;
        padding: 10px 0;
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
