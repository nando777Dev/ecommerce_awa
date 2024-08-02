@extends('layouts.app')
@section('title', 'Home')

@section('content')

    <section class="padding">
        <div id="background-container" class="container background-image">
            <div class="header_content padding">
                <div class="row">

                    <div class="col-md-12 text-center">
                        <h1 class="uppercase" id="header-text">Politica de Privacidade</h1><br>
                        {!! $config_home->politica_privacidade !!}
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
