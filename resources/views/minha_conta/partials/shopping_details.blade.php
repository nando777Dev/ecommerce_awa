@extends('layouts.app')

@section('title', 'Minhas Compras')

@section('content')
<style>
    body, html {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    .orders-section {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        background-color: #f0f0f0;
    }

    .main-orders {
        width: 75%;
        display: flex;
        flex-direction: column;
        gap: 10px;
        background-color: #ffffff;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }


    .back-btn:hover {
        background-color: #0056b3;
    }

    .orders-container {
        max-height: 65vh;
        overflow-y: auto;
    }

    .order-card {
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 50px;
        margin-bottom: 20px;
        transition: transform 0.3s;
    }

    .order-card:hover {
        transform: translateY(-10px);
        cursor: pointer;
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
        margin-bottom: 10px;
        background-color: #303030;
        color: #ffffff;
        border-radius: 5px;
        padding: 10px;
        font-size: 15px;
    }

    .order-header h3 {
        margin: 10px;
    }

    .order-links a {
        margin-left: 10px;
        color: #ffffff;
        text-decoration: none;
    }

    .order-body {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .product-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
        font-size: 14px;
    }

    .order-thumbnail {
        width: 80px;
        height: 80px;
        margin-right: 10px;
    }

    .order-info {
        display: flex;
        flex-direction: column;
    }

    .order-info p {
        margin: 0;
        font-weight: bold;
    }

    .order-detail-btn {
        background-color: #007bff;
        color: #ffffff;
        border: none;
        padding: 10px;
        cursor: pointer;
        border-radius: 4px;
        margin-top: 10px;
        transition: background-color 0.3s;
    }

    .order-detail-btn:hover {
        background-color: #0056b3;
    }

    .sidebar-products {
        width: 20%;
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-height: 70vh;
        overflow-y: auto;
    }

    .sidebar-products h4 {
        margin-top: 0;
    }

    .recommended-products-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .product-card {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        font-size: 8px;
    }

    .product-card img {
        width: 50px;
        height: 50px;
        margin-right: 10px;
    }

    .pagination-links {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination-links .page-item {
        margin: 0 5px;
    }

    .pagination-links .page-item .page-link {
        color: #007bff;
        text-decoration: none;
        border: 1px solid #ddd;
        padding: 5px 10px;
        border-radius: 4px;
    }

    .pagination-links .page-item.active .page-link {
        background-color: #007bff;
        color: #ffffff;
        border-color: #007bff;
    }

    .pagination-links .page-item.disabled .page-link {
        color: #ddd;
    }

    .pagination-links .page-link:hover {
        background-color: #0056b3;
        color: #ffffff;
    }
</style>

<section class="orders-section">
    <div class="main-orders">
        <ul class="breadcrumb">
            <li><a href="/minha-conta">Menu</a></li>
            <li class="active">Suas compras</li>
        </ul>
        <div class="orders-container">
            @foreach ($groupedOrders as $order)
            <div class="order-card">
                <div class="order-header">
                    <p>Data do Pedido: {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</p>
                    <h3>Pedido #{{ $order->number_pedido }}</h3>
                    <div class="order-links">
                        <a href="{{ route('shipping-details', ['id' => $order->id]) }}" class="order-detail-link">Ver Detalhes</a>
                        <a href="{{ $order->invoice_url }}" class="order-receipt-link" target="_blank">Recibo</a>
                    </div>
                </div>
                <div class="order-body">
                    @foreach ($order->products as $product)
                    <div class="product-item">
                        <img src="{{ $url . $product->image }}" alt="Produto" class="order-thumbnail">
                        <div class="order-info">
                            <p>{{ $product->nome_produto }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="sidebar-products">
        <h4>Produtos Recomendados</h4>
        <hr>
        <div class="recommended-products-container">
            @foreach ($recommendedProducts as $product)
            <div class="product-card">
                <img src="{{ $url.$product->image }}" alt="Produto">
                <p>{{ $product->name }}</p>
            </div>
            @endforeach

            <!-- Paginação dos produtos recomendados -->
            <div class="pagination-links">
                {{-- {{ $recommendedProducts->links('pagination::bootstrap-4') }} --}}
            </div>
        </div>
    </div>
</section>

@endsection
