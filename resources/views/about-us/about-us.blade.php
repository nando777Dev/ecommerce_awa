@extends('layouts.app')
@section('title', 'Sobre nós')

@section('content')
    <style>
        .background-image {
            background-size: cover; /* Ajusta a imagem para cobrir toda a área */
            background-position: center; /* Centraliza a imagem */
            background-repeat: no-repeat; /* Evita a repetição da imagem */
            width: 100%;
            height: 40vh; /* Ajusta a altura para ocupar 70% da altura da viewport */
            display: flex; /* Usa flexbox para centralizar o conteúdo */
            align-items: flex-start; /* Alinha o conteúdo ao topo */
            justify-content: center; /* Centraliza horizontalmente o conteúdo */
            text-align: center; /* Centraliza o texto */
            padding-top: 20px; /* Ajuste o padding conforme necessário */
        }

        .padding {
            padding: 50px; /* Ajuste o padding conforme necessário */
        }

        .blog_image img {
            width: 100%;
            height: auto;
        }
        .blog_item {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }
        .blog_text {
            display: flex;
            flex-direction: column;
            justify-content: flex-start; /* Alinha o texto ao topo */
        }
    </style>
    @if(empty($config_text_main)))

    <section class="padding">
        <div id="background-container" class="container background-image">
            <div class="header_content padding">
                <div class="row">

                    <div class="col-md-12 text-center">
                        <h1>Configure sua pagina antes pelo ERP</h1>
                        <br><br>
                        <a class="btn btn-success" href="https://app.contetecnologia.com.br/ecommerce/list-about-config">Clique aqui</a>
                    </div>
                </div>
            </div>
        </div>

    </section>
    @else
    <section class="page_menu">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="hidden">hidden</h3>
                    <ul class="breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li><a href="#.">Pages</a></li>
                        <li class="active">Sobre nós</li>
                    </ul>
                </div>
            </div>
        </div>

    <section class="padding">
        <div id="background-container" class="container background-image">
            <div class="header_content padding">
                <div class="row">

                    <div class="col-md-12 text-center">
                        <h1 class="uppercase" id="header-text">{{ $config_text_main->custom_field ?? 'Configure esse texto pelo ERP' }}</h1>
                        <p id="paragraph-text">{!! $config_text_main->custom_text ?? 'Configure esse texto pelo ERP' !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <img id="background-image" src="{{ $url_img . $config_text_main->image   }}" style="display:none;" alt="background">
    </section>
    <section class="page_menu">
        <div class="container" style="visibility: hidden">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="hidden">hidden</h3>
                    <ul class="breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li><a href="#.">Pages</a></li>
                        <li class="active">Sobre nós</li>
                    </ul>
                </div>
            </div>
        </div>

    <!--BLog -->
    <section id="blog" class="padding_bottom margintop30">
        <h3 class="hidden">heading</h3>
        <div class="container">
            <div class="row">
                @foreach ($config as $item)
                    <div class="col-sm-12">
                        <article class="blog_item bottom_half row">
                            <div class="col-md-6 blog_image" style="align-content: center;">
                                <img src="{{ $url_img . $item->image ?? '' }}" alt="blog" style="width: 575px; height: 360px;">
                            </div>
                            <div class="col-md-6 blog_text">
                                <ul class="meta margintop15 marginbottom15">
                                    <!-- Add any metadata if needed -->
                                </ul>
                                <h5 class="uppercase marginbottom15">{{ $item->custom_field ?? 'Configure esse texto pelo ERP' }}</h5>
                                <p>{!! $item->custom_text ?? 'Configure esse texto pelo ERP' !!}</p>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <ul class="pager">
                        <!-- Render pagination links -->
                        {{ $config->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection

@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.2/color-thief.umd.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var img = document.getElementById('background-image');
            var colorThief = new ColorThief();

            img.onload = function() {
                var dominantColor = colorThief.getColor(img);
                var brightness = (dominantColor[0] * 0.299 + dominantColor[1] * 0.587 + dominantColor[2] * 0.114) / 255;

                var textColor = brightness > 0.5 ? 'black' : 'white';
                document.getElementById('header-text').style.color = textColor;
                document.getElementById('paragraph-text').style.color = textColor;
            };

            if (img.complete) {
                img.onload();
            }
        });
    </script>
@endsection
