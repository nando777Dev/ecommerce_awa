@extends('layouts.app')
@section('title', 'Home')

@section('content')


    <style>
        .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        animation: blink 1s infinite;
    }

    .popup-content {
        background: #ffffff;
        padding: 20px;
        border-radius: 50%;
        text-align: center;
        box-shadow: 0 20px 8px rgba(1, 1, 1, 0.566);
        position: relative;
        width: 350px;
        height: 350px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        box-sizing: border-box;
    }

    .close-btn {
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 24px;
        cursor: pointer;
    }

    @keyframes blink {
        50% {
            opacity: 0.5;
        }
    }
    </style>
    <section class="rev_slider_wrapper">


        <div id="rev_slider" class="rev_slider"  data-version="5.0">
            <ul>
                <!-- SLIDE - Inicio do carrossel de destaque  -->

                @foreach($config_carrossel as $carrossel)
                <li data-transition="fade">

                    <!-- MAIN IMAGE -->

                    <img src="{{ $url_carrossel . $carrossel->img}}" alt="" data-bgposition="center center" data-bgfit="cover">

                    <div class="tp-caption tp-resizeme"
                         data-x="right" data-hoffset=""
                         data-y="0" data-voffset="10"
                         data-width="['auto','auto','auto','auto']"
                         data-height="['auto','auto','auto','auto']"
                         data-transform_idle="o:1;"
                         data-transform_in="x:right;s:2000;e:Power4.easeInOut;"
                         data-transform_out="s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                         data-start="3000"
                         data-splitin="none"
                         data-splitout="none"
                         data-responsive_offset="on"
                         style="z-index: 7; white-space: nowrap;">
                    </div>
                    <!-- LAYER NR. 1 -->
                    <h3 class="tp-caption tp-resizeme uppercase"
                        data-x="left"
                        data-y="185"
                        data-width="full"
                        data-transform_idle="o:1;"
                        data-transform_in="y:-50px;opacity:0;s:1500;e:Power3.easeOut;"
                        data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                        data-start="800">{{ $carrossel->titulo }}
                    </h3>
                    <h1 class="tp-caption tp-resizeme uppercase"
                        data-x="left"
                        data-y="228"
                        data-width="full"
                        data-transform_idle="o:1;"
                        data-transform_in="y:-50px;opacity:0;s:1500;e:Power3.easeOut;"
                        data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                        data-start="1000">
                        <strong>{!! $carrossel->descricao !!}

                    </h1>
                    <div class="tp-caption tp-resizeme"
                         data-x="left"
                         data-y="415"
                         data-width="full"
                         data-transform_idle="o:1;"
                         data-transform_in="y:-50px;opacity:0;s:1500;e:Power3.easeOut;"
                         data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                         data-start="1300">

                    </div>
                    <div class="tp-caption tp-resizeme"
                         data-x="left"
                         data-y="510"
                         data-width="full"
                         data-transform_idle="o:1;"
                         data-transform_in="y:-50px;opacity:0;s:1500;e:Power3.easeOut;"
                         data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                         data-start="1600">
                        <a href="{{$carrossel->link_acao}}" class="btn-common">{{ $carrossel->nome_botao }}
                        </a>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>


        <!-- END REVOLUTION SLIDER -->
    </section>

    <section id="cart" class="padding">

    </section>

    <!-- Pop-up -->
    {{--<div id="promotion-popup" class="popup-overlay">
        <div class="popup-content">
            <span class="close-btn">&times;</span>
            <h2>Promoção Especial!</h2>
            <p>Confira nossas <a href="/promocoes">promoções</a> e aproveite as ofertas!</p>
        </div>
    </div>--}}
    <!--Three Box Products-->

    <!--NEW ARRIVALS-->
    <section id="arrivals" class="padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="heading_space uppercase">Recentimente Adicionados
                    </h2>
                    <p class="bottom_half">Produtos que foram recentimente adicionados
                    </p>
                </div>
            </div>

            <div class="row">

                <div id="fourCol-slider" class="owl-carousel products-container" style="align-content: center">
                    @foreach($product_details as $produto)

                        <div class="item">
                            <div class="product_wrap">
                                <div class="image">
                                    <div class="tag">

                                            <div class="tag-btn">
                                                <span class="uppercase text-center">Novo</span>
                                            </div>

                                    </div>

                                    <a class="fancybox" href="{{ $produto['image_url'] }}">
                                        <img src="{{ $produto['image_url'] }}" alt="{{ $produto['name'] }}" class="img-responsive" style="width: 277px; height: 240px">
                                    </a>
                                    <div class="social">
                                        <ul>
                                            <li>
                                                <a href="#.">
                                                    <i class="fa fa-heart-o"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_desc">
                                    <a href="/produtos/show/ {{$produto['id']}}"> {{$produto['name']}}</a><br>
                                    <span class="price">
                                     <i>R$ </i>{{ number_format($produto['default_sell_price'], 2) }}
                                        </span>
                                    <a class="fancybox" href="{{ $produto['image_url'] }}" data-fancybox-group="gallery">
                                        <i class="fa fa-shopping-bag open"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


            </div>
            @foreach($filteredPopups as $popup)
                <div id="promotion-popup-{{ $popup->id }}" class="popup-overlay">
                    <div class="popup-content">
                        <span class="close-btn">&times;</span>
                        <h2>{{ $popup->titulo }}</h2>
                        {!! $popup->text_variation !!}
                        @if(!empty($popup->link_action))
                            <a href="{{ $popup->link_action }}">{{ $popup->name_button ?: 'Clique aqui...' }}</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!--Special Design Product-->
    <section>
        <div class="container">
            <div class="row">
                <div class="design clearfix">
                    <div class="col-md-5 col-md-offset-1">
                        <div class="design_img">
                            <div class="tag">
                                <div class="tag-btn-destaque">
                                    <span class="uppercase text-center">destaque</span>
                                </div>
                            </div>
                            <img src="{{$produtoAleatorio['image_url']}}" alt="desing Product">
                        </div>
                    </div>
                    <div class="col-md-5 col-md-offset-1">
                        <div class="descrp">
                            <h3 class="uppercase heading_space">
                                <a href="product_detail.html">{{$produtoAleatorio['name']}}
                                </a>
                            </h3>

                            <h3 class="price marginbottom15">
                                <i>
                                </i>R${{ number_format($produtoAleatorio['default_sell_price'], 2, ',', '.')}}&nbsp;
                                    <span>
                                    <i>
                                    </i>R${{ number_format($produtoAleatorio['default_sell_price'], 2, ',', '.')}}
                                  </span>
                            </h3>
                            <p class="marginbottom15 detail">Descrição:
                                <span>{!! $produtoAleatorio['description'] !!}
                                </span>
                            </p>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--FEATURED PRODUCTS-->
    <section id="featured_product" class="padding_top">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="heading_space uppercase">Destaque de produtos
                    </h2>
                    <p class="bottom_half">Claritas est etiam processus dynamicus, qui sequitur.
                    </p>
                </div>
                @foreach($produtoDestaque as $produto)
                <div class="col-md-3 col-sm-6">
                    <div class="product_wrap bottom_half">
                        <div class="image">
                            <div class="tag">
                                <div class="tag-btn-destaque">
                                    <span class="uppercase text-center">destaque</span>
                                </div>
                            </div>
                            <a class="fancybox" href="{{ $produto['image_url'] }}">
                                <img src="{{ $produto['image_url'] }}" alt="{{ $produto['name'] }}" class="img-responsive" style="width: 277px; height: 240px">
                            </a>
                        </div>
                        <div class="product_desc">
                            <a href="/produtos/show/ {{$produto['id']}}"> {{$produto['name']}}</a><br>
                            <span class="price">
                                     <i>R$ </i>{{ number_format($produto['default_sell_price'], 2) }}
                                        </span>
                            <a class="fancybox" href="{{ $produto['image_url'] }}" data-fancybox-group="gallery">
                                <i class="fa fa-shopping-bag open"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        // Check if there are no items in the cart and show the popup
        if ($('#cart').length) {
            $('.popup-overlay').fadeIn();
        }

        // Close the popup when the close button is clicked
        $('.close-btn').on('click', function() {
            $(this).closest('.popup-overlay').fadeOut();
        });
    });
</script>

@endsection

