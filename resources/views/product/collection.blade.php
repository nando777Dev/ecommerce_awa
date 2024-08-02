@extends('layouts.app')

@section('title', 'Destaques')

@section('content')
    <style>
        .size_img {
            width: 277px;
            height: 240px;
        }

        .text-size-inpage {
            font-size: 60px;
            font-family: 'Raleway', sans-serif;
            font-weight: 200;
        }

        .text-layout h2 > strong {
            font-size: 60px;
            font-family: 'Raleway', sans-serif;
            font-weight: 600;
        }

        .background-image {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            width: 100%;
            height: 70vh;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            text-align: center;
            padding-top: 30px;
            position: relative; /* Garantir que o texto fique acima da imagem */
        }

        .header_content {
            position: relative;
            z-index: 1; /* Certifique-se de que o conteúdo do cabeçalho fique acima da imagem desfocada */
        }

        .padding {
            padding: 0px;
        }

        .blog_image img {
            width: 00%;
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
            justify-content: flex-start;
        }

        /* Adiciona sombra ao texto dos h2 */
        .text-shadow {
            text-shadow: 10px 10px 10px rgba(255, 255, 255, 1);
        }

        /* Estilo para a imagem abaixo do texto */
        .image-below-text {
            text-align: center;
            margin-top: 20px;
        }

        /* Estilo para garantir que a imagem cubra 100% das laterais */
        .full-width-image {
            width: 50%;
            height: 1000%;
        }

    </style>

    <div style="visibility: hidden"
    ><h1>...</h1></div>

    <section class="text-layout padding">
        <div id="background-container" class="container" style="position: relative;">
            <div class="header_content padding mt-10" style="position: relative; z-index: 1;">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2 class="uppercase text-size-inpage text-shadow" style="color: {{ $config->color_title }}">
                            {!! $config->name !!}
                        </h2>
                        <h2 class="heading_space uppercase text-shadow" style="color: {{ $config->color_subtitle }}">
                            <strong>{!! $config->name_subtitle !!}</strong>
                        </h2>
                        <div style="color: {{ $config->color_title }};" class="text-shadow">
                            {!! $config->description !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add the image here -->
            <div class="image-below-text">
                <img src="{{ $url_config . $config->image }}" alt="Background Image" class="background-image">
            </div>
        </div>
    </section>



    <!--Page Nav-->
    <section class="page_menu">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li class="active">Coleções</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <section class="grid padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="shop-grid-controls">

                        <div class="view-button grid bottom30">
                            <i class="fa fa-th-large"></i>
                        </div>
                        <div class="view-button active list bottom30">
                            <i class="fa fa-align-justify"></i>
                        </div>
                        <div class="entry bottom30">
                            <form class="grid-form">
                                <div class="form-group">
                                    <div class="select form-control">
                                        <select name="country" id="city">
                                            <option selected>Defaul sorting</option>
                                            <option>Defaul sorting</option>
                                            <option>Defaul sorting</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 text-right">
                    <h5 class="result uppercase">
                        Mostrando {{ $products->firstItem() }}-{{ $products->lastItem() }} de {{ $products->total() }} resultados
                    </h5>
                </div>
            </div>
            <div class="row shop-grid list-view">
                @foreach($products as $product)
                    <div class="col-md-3 col-sm-6">
                        <div class="product_wrap heading_space">
                            <div class="image">
                                @if ($product->novo)
                                    <div class="tag">
                                        <div class="tag-btn">
                                            <span class="uppercase text-center">Novo</span>
                                        </div>
                                    </div>
                                @endif
                                @if ($product->destaque)
                                    <div class="tag">
                                        <div class="tag-btn">
                                            <span class="uppercase text-center">Destaque</span>
                                        </div>
                                    </div>
                                @endif
                                <a class="fancybox size_img" href="{{ $url_img . $product->image }}" >
                                    <img src="{{ $url_img . $product->image }}" alt="{{ $product->name_produto }}" class="img-responsive size_img" >
                                </a>
                            </div>
                            <div class="product_desc">
                                <p class="title"><a href="/produtos/show/ {{$product->id_produto}}" style="font-size: 12px">{{ $product->name_produto }}</a><br></p>
                                <div class="list_content">
                                    <h4 class="bottom30">{{$product->name_produto}}</h4>

                                    <p  class="bottom30">{!! $product->description !!}</p>
                                    <ul class="review_list bottomtop30">
                                        <li><img alt="star" src="../../../images/star.png"></li>

                                    </ul>
                                    <h4 class="price bottom30">R${{number_format($product->price, 2, ',', '.')  }} &nbsp;<span class="discount">R${{number_format($product->price, 2, ',', '.')  }}</span></h4>
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        <div class="cart-buttons">
                                            @csrf
                                            <input type="hidden" name="id_produto" value="{{ $product->id_produto}} ">
                                            <input type="hidden" name="nome_produto" value="{{ $product->name_produto}} ">
                                            <input type="hidden" name="price" value="{{ $product->price }} ">
                                            <input type="hidden" name="img" value="{{ $product->image }} ">
                                            <input type="hidden" name="quantidade" value="1">

                                            <button class="uppercase border-radius btn-dark" href="{{ route('cart.add', $product->id_produto) }}">
                                                <i class="fa fa-shopping-basket"></i> &nbsp; Adicione ao carrinho
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <span class="price"><i class="fa fa-gbp"></i>R${{number_format($product->price, 2, ',', '.')  }}</span>
                                <span class="discount"><i></i>R${{number_format($product->price, 2, ',', '.')  }}</span>
                                <a class="fancybox" href="../../../images/product5.jpg" data-fancybox-group="gallery"><i class="fa fa-shopping-bag open"></i></a>
                            </div>
                        </div>
                </div>
                @endforeach
            </div>



        <div class="row">
            <div class="col-md-6 col-sm-6">
                {{ $products->links() }}
            </div>
            <div class="col-md-6 col-sm-6 text-right">
                <h5 class="result uppercase">
                    Mostrando {{ $products->firstItem() }}-{{ $products->lastItem() }} de {{ $products->total() }} resultados
                </h5>
            </div>
        </div>
        </div>
    </section>
@endsection
