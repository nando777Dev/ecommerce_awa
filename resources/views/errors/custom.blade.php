@extends('layouts.app')
@section('title', 'Error')

@section('content')
<style>
    html, body {
        height: 100%;
        margin: 0;
    }
    .error-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        text-align: center;
        background: #f7d0d0; /* Light gray background */
        font-family: Arial, sans-serif;
        padding-bottom: 50px; /* Padding to ensure footer is not too close */
    }
    .error-code {
        font-size: 12vw; /* Increased responsive font size */
        background: -webkit-linear-gradient(#b20101, #ed0000); /* Light to dark gray gradient */
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin: 20px 0;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1); /* Added text shadow */
    }
    .error-message {
        margin-top: 50px;
        font-size: 2em;
        color: #333;
    }
    .support-message {
        font-size: 1em;
        color: #666;
    }
    .page_menu {
        margin-bottom: 40px; /* Margin to ensure footer is not too close */
    }
</style>

@php
    $code = $code ?? 'default';
@endphp

@if($code == '401')
<section class="page_menu">
    <div class="container">
        <div class="error-container">
            <h1 class="error-message">Ops! algo inesperado aconteceu!</h1>
            <div class="error-code">401</div>
            <p class="support-message">
                Não autenticado<br>
                Se o problema persistir, entre em contato com nosso suporte através do email.
            </p>
        </div>
    </div>
</section>
@elseif ($code == '500')
<section class="page_menu">
    <div class="container">
        <div class="error-container">
             <h1 class="error-message">Ops! algo inesperado aconteceu!</h1>
             <div class="error-code">500</div>
            <p class="support-message">
                Estamos trabalhando para solucionar este problema. Tente novamente mais tarde!<br>
                Se o problema persistir, entre em contato com nosso suporte através do email.
            </p>
        </div>
    </div>
</section>
@elseif ($code == '502')
<section class="page_menu">
    <div class="container">
        <div class="error-container">
            <h1 class="error-message">Ops! Ocorreu um erro no processo de pagamento</h1>
            <div class="error-code">502</div>
            <p class="support-message">
                Ocorreu um erro durante o processamento do seu pagamento. Por favor, tente novamente mais tarde.<br>
                Se o problema persistir, entre em contato com nosso suporte através do email.
            </p>
        </div>
    </div>
</section>
@elseif ($code == '404')
<section class="page_menu">
    <div class="container">
        <div class="error-container">
            <h1 class="error-message">Ops! algo inesperado aconteceu!</h1>
            <div class="error-code">404</div>

            <p class="support-message">
                Ocorreu um erro durante o processamento da sua requisição. Por favor, tente novamente mais tarde.<br>
                Se o problema persistir, entre em contato com nosso suporte através do email.
            </p>
        </div>
    </div>
</section>
@else
<section class="page_menu">
    <div class="container">
        <div class="error-container">
            <h1 class="error-message">Ops! algo inesperado aconteceu!</h1>
            <div class="error-code">Erro</div>
            <p class="support-message">
                Ocorreu um erro inesperado. Por favor, tente novamente mais tarde.<br>
                Se o problema persistir, entre em contato com nosso suporte através do email.
            </p>
        </div>
    </div>
</section>
@endif
@endsection
