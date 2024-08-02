@extends('layouts.app')
@section('title', 'Sobre nós')

@section('content')
    <style>
        .carts {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 500%;
            width: 100%;

        }
    </style>
    <section id="cart">
        <div class="container carts">
            <div class="justify-content-center">
                <div class="margintop40" style="width: 150%">
                    <h4 class="heading uppercase bottom30 text-center">Já é cliente? entre com sua conta ou crie uma clicando( <a style="color: #00A8FF" href="{{route('register')}}">Aqui</a>)</h4>

                    <form class="contact-form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email-log" placeholder="jane.doe@example.com" name="email" required>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <label for="pass">Senha</label>
                            <input type="password" class="form-control" id="pass-log" placeholder="*****" name="password" required>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <label>
                                <div class="squaredFour">
                                    <input type="checkbox" value="None" id="squaredFour" name="remember" checked />
                                    <label for="squaredFour"></label>
                                </div>
                                <h5>Mantenha me conectado</h5>
                                <a href="#.">Esqueceu sua senha?</a>
                            </label>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="uppercase margintop40 btn-light" value="Entrar">
                        </div>
                    </form>
                   {{-- <a href="#." class="uppercase btn-common facebook-share"><i class="fa fa-facebook"></i>Login com facebook</a>--}}
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="accordion-container padding">
                        <div class="set">
                            <a href="#." class="active uppercase"><i class="fa fa-plus"></i>Tipos pagamentos</a>
                            <div class="content" style="display:block;">
                                <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                <p>when an unknown printer took a galley of type and scrambled it to make a type specimen book lorem Ipsum has been the industry's standard dummy text ever since the</p>
                            </div>
                        </div>
                        <div class="set">
                            <a href="#." class="uppercase"><i class="fa fa-plus"></i>Informações de compra</a>
                            <div class="content">
                                <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                <p>when an unknown printer took a galley of type and scrambled it to make a type specimen book lorem Ipsum has been the industry's standard dummy text ever since the</p>
                            </div>
                        </div>

                        <div class="set">
                            <a href="#."><i class="fa fa-plus"></i>Formas de pagamento </a>
                            <div class="content">
                                <ul>

                                    <li><a href="#.">PIX</a></li>
                                    <li><a href="#.">Boleto</a></li>
                                    <li><a href="#.">Cartão de credito</a></li>

                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
