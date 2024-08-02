
@extends('layouts.app')

@section('title', 'Carrinho')

@section('content')
<style>
    body, html {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    .account-section {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50vh;
        background-color: #f0f0f0;
    }

    .cards-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .card {
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 8px;
        width: 250px; /* Aumentado de 200px para 250px */
        height: 200px; /* Aumentado de 150px para 200px */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        box-shadow: 0 15px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, background-color 0.3s; /* Adicionada transição para a cor de fundo */
    }

    .card:hover {
        transform: translateY(-10px);
        cursor: pointer;
        background-color: #79B6C8; /* Cor de fundo ao passar o mouse */
    }

    .card i {
        font-size: 36px;
        margin-bottom: 10px;
        color: #303030;
        transition: color 0.3s; /* Adicionada transição para a cor do ícone */
    }

    .card:hover i {
        color: #ffffff; /* Cor do ícone ao passar o mouse */
    }

    .card p {
        margin: 0;
        color: #000;
        font-weight: bold;
        transition: color 0.3s; /* Adicionada transição para a cor do texto */
    }

    .card:hover p {
        color: #ffffff; /* Cor do texto ao passar o mouse */
    }
</style>
<section class="account-section">
    <div class="cards-container">
        <div class="card" onclick="location.href='/minha-conta/details'">
            <i class="fa fa-user"></i>
            <p>Perfil</p>
        </div>
        <div class="card" onclick="location.href='/minha-conta/minhas-compras'">
            <i class="fa fa-shopping-bag"></i>
            <p>Minhas Compras</p>
        </div>
        <div class="card" onclick="location.href='/cart/view'">
            <i class="fa fa-shopping-cart"></i>
            <p>Meu carrinho</p>
        </div>
        <div class="card" onclick="location.href='#'" data-target="change-password">
            <i class="fa fa-cog"></i>
            <p>Configurações</p>
        </div>
    </div>
</section>
@endsection
