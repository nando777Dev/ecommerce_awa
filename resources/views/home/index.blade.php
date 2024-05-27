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
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
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
                        <strong>{{ $carrossel->customized_1 }}
                        </strong> {{ $carrossel->customized_2 }}
                    </h1>
                    <div class="tp-caption tp-resizeme"
                         data-x="left"
                         data-y="415"
                         data-width="full"
                         data-transform_idle="o:1;"
                         data-transform_in="y:-50px;opacity:0;s:1500;e:Power3.easeOut;"
                         data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                         data-start="1300">
                        <p>{{ $carrossel->customized_3 }}
                            <br>{{ $carrossel->customized_5 }}
                        </p>
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
    <div id="promotion-popup" class="popup-overlay">
        <div class="popup-content">
            <span class="close-btn">&times;</span>
            <h2>Promoção Especial!</h2>
            <p>Confira nossas <a href="/promocoes">promoções</a> e aproveite as ofertas!</p>
        </div>
    </div>
    <!--Three Box Products-->
    <section id="grid_box">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <a class="grid_box clearfix" href="grid_list.html">
                        <div class="image_left">

                        </div>
                        <div class="grid_body">
                            <h2 class="uppercase">Linha de planejados
                            </h2>
                            <h4>Moveis em MDF
                            </h4>
                            <h3>50% Off
                            </h3>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a class="grid_box clearfix" href="grid_list.html">
                        <div class="image_left">

                        </div>
                        <div class="grid_body">
                            <h2 class="uppercase">Promoções
                            </h2>
                            <h4>Cadeiras p/ Escritorio
                            </h4>
                            <h3>A partir>  R$ 167.00
                            </h3>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a class="grid_box clearfix" href="grid_list.html">
                        <div class="image_left">

                        </div>
                        <div class="grid_body">
                            <h2 class="uppercase">Destaques
                            </h2>
                            <h4>Explore nossos produtos
                            </h4>
                            <h3>
                            </h3>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>
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
                                        <div class="tag-btn-destaque">
                                            <span class="uppercase pull-right">Destaque</span>

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
           {{-- <div class="row">
                <div id="fourCol-slider" class="owl-carousel products-container" style="align-content: center">
                    <button onclick="testarScript()" style="visibility: hidden"></button>
                </div>
                <!-- Adicione as setas de navegação -->
                    <div class="owl-nav">
                        <button type="button" class="owl-prev"><i class="fa fa-chevron-left"></i></button>
                        <button type="button" class="owl-next"><i class="fa fa-chevron-right"></i></button>
                    </div>
            </div>--}}
            {{--<div class="row">
                <div id="fourCol-slider" class="owl-carousel">


                    --}}{{--<div class="item">
                        <div class="product_wrap">
                            <div class="image">
                                <div class="social">
                                    <ul>
                                        <li>
                                            <a href="#.">
                                                <i class="fa fa-expand">
                                                </i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#.">
                                                <i class="fa fa-exchange">
                                                </i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#.">
                                                <i class="fa fa-heart-o">
                                                </i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <a class="fancybox" href="../../../images/product5.jpg">
                                    <img src="../../../images/product5.jpg" alt="Product" class="img-responsive">
                                </a>
                            </div>
                            <div class="product_desc">
                                <p>Estou aqui
                                </p>
                                <span class="price">
                    <i class="fa fa-gbp">
                    </i>Valor teste 189,90
                  </span>
                                <a class="fancybox" href="../../../images/product5.jpg" data-fancybox-group="gallery">
                                    <i class="fa fa-shopping-bag open">
                                    </i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="product_wrap">
                            <div class="image">
                                <div class="tag">
                                    <div class="tag-btn">
                      <span class="uppercase text-center">New
                      </span>
                                    </div>
                                </div>
                                <a class="fancybox" href="../../../images/product6.jpg">
                                    <img src="../../../images/product6.jpg" alt="Product" class="img-responsive">
                                </a>
                                <div class="social">
                                    <ul>
                                        <li>
                                            <a href="#.">
                                                <i class="fa fa-expand">
                                                </i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#.">
                                                <i class="fa fa-exchange">
                                                </i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#.">
                                                <i class="fa fa-heart-o">
                                                </i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_desc">
                                <p>Sacrificial Chair Design
                                </p>
                                <span class="price">
                    <i class="fa fa-gbp">
                    </i>170.00
                  </span>
                                <a class="fancybox" href="../../../images/product6.jpg" data-fancybox-group="gallery">
                                    <i class="fa fa-shopping-bag open">
                                    </i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="product_wrap">
                            <div class="image">
                                <a class="fancybox" href="../../../images/product7.jpg">
                                    <img src="../../../images/product7.jpg" alt="Product" class="img-responsive">
                                </a>
                                <div class="social">
                                    <ul>
                                        <li>
                                            <a href="#.">
                                                <i class="fa fa-expand">
                                                </i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#.">
                                                <i class="fa fa-exchange">
                                                </i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#.">
                                                <i class="fa fa-heart-o">
                                                </i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_desc">
                                <p>Sacrificial Chair Design
                                </p>
                                <span class="price">
                    <i class="fa fa-gbp">
                    </i>170.00
                  </span>
                                <a class="fancybox" href="../../../images/product7.jpg" data-fancybox-group="gallery">
                                    <i class="fa fa-shopping-bag open">
                                    </i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="product_wrap">
                            <div class="image">
                                <a class="fancybox" href="../../../images/product8.jpg">
                                    <img src="../../../images/product8.jpg" alt="Product" class="img-responsive">
                                </a>
                                <div class="social">
                                    <ul>
                                        <li>
                                            <a href="#.">
                                                <i class="fa fa-expand">
                                                </i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#.">
                                                <i class="fa fa-exchange">
                                                </i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#.">
                                                <i class="fa fa-heart-o">
                                                </i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_desc">
                                <p>Sacrificial Chair Design
                                </p>
                                <span class="price">
                    <i class="fa fa-gbp">
                    </i>170.00
                  </span>
                                <a class="fancybox" href="../../../images/product8.jpg" data-fancybox-group="gallery">
                                    <i class="fa fa-shopping-bag open">
                                    </i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="product_wrap">
                            <div class="image">
                                <a class="fancybox" href="../../../images/product1.jpg">
                                    <img src="../../../images/product1.jpg" alt="Product" class="img-responsive">
                                </a>
                                <div class="social">
                                    <ul>
                                        <li>
                                            <a href="#.">
                                                <i class="fa fa-expand">
                                                </i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#.">
                                                <i class="fa fa-exchange">
                                                </i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#.">
                                                <i class="fa fa-heart-o">
                                                </i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_desc">
                                <p>Sacrificial Chair Design
                                </p>
                                <span class="price">
                    <i class="fa fa-gbp">
                    </i>170.00
                  </span>
                                <a class="fancybox" href="../../../images/product1.jpg" data-fancybox-group="gallery">
                                    <i class="fa fa-shopping-bag open">
                                    </i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="product_wrap">
                            <div class="image">
                                <div class="tag">
                                    <div class="tag-btn">
                      <span class="uppercase text-center">New
                      </span>
                                    </div>
                                </div>
                                <a class="fancybox" href="../../../images/product2.jpg">
                                    <img src="../../../images/product2.jpg" alt="Product" class="img-responsive">
                                </a>
                                <div class="social">
                                    <ul>
                                        <li>
                                            <a href="#.">
                                                <i class="fa fa-expand">
                                                </i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#.">
                                                <i class="fa fa-exchange">
                                                </i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#.">
                                                <i class="fa fa-heart-o">
                                                </i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_desc">
                                <p>Sacrificial Chair Design
                                </p>
                                <span class="price">
                    <i class="fa fa-gbp">
                    </i>170.00
                  </span>
                                <a class="fancybox" href="../../../images/product2.jpg" data-fancybox-group="gallery">
                                    <i class="fa fa-shopping-bag open">
                                    </i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="product_wrap">
                            <div class="image">
                                <div class="tag">
                                    <div class="tag-btn">
                      <span class="uppercase text-center">New
                      </span>
                                    </div>
                                </div>
                                <a class="fancybox" href="../../../images/product3.jpg">
                                    <img src="../../../images/product3.jpg" alt="Product" class="img-responsive">
                                </a>
                                <div class="social">
                                    <ul>
                                        <li>
                                            <a href="#.">
                                                <i class="fa fa-expand">
                                                </i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#.">
                                                <i class="fa fa-exchange">
                                                </i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#.">
                                                <i class="fa fa-heart-o">
                                                </i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_desc">
                                <p>Sacrificial Chair Design
                                </p>
                                <span class="price">
                    <i class="fa fa-gbp">
                    </i>170.00
                  </span>
                                <a class="fancybox" href="../../../images/product3.jpg" data-fancybox-group="gallery">
                                    <i class="fa fa-shopping-bag open">
                                    </i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="product_wrap">
                            <div class="image">
                                <div class="tag">
                                    <div class="tag-btn">
                      <span class="uppercase text-center">New
                      </span>
                                    </div>
                                </div>
                                <a class="fancybox" href="../../../images/product4.jpg">
                                    <img src="../../../images/product4.jpg" alt="Product" class="img-responsive">
                                </a>
                                <div class="social">
                                    <ul>
                                        <li>
                                            <a href="#.">
                                                <i class="fa fa-expand">
                                                </i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#.">
                                                <i class="fa fa-exchange">
                                                </i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#.">
                                                <i class="fa fa-heart-o">
                                                </i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_desc">
                                <p>Sacrificial Chair Design
                                </p>
                                <span class="price">
                    <i class="fa fa-gbp">
                    </i>170.00
                  </span>
                                <a class="fancybox" href="../../../images/product4.jpg" data-fancybox-group="gallery">
                                    <i class="fa fa-shopping-bag open">
                                    </i>
                                </a>
                            </div>
                        </div>
                    </div>--}}{{--
                </div>
            </div>--}}
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
                                <div class="tag-btn">
                    <span class="uppercase text-center">New
                    </span>
                                </div>
                            </div>
                            <img src="../../../images/design-prouct.jpg" alt="desing Product">
                        </div>
                    </div>
                    <div class="col-md-5 col-md-offset-1">
                        <div class="descrp">
                            <h3 class="uppercase heading_space">
                                <a href="product_detail.html">Sacrificial Chair Design
                                </a>
                            </h3>
                            <ul class="review">
                                <li>
                                    <img src="../../../images/star.png" alt="rating">
                                </li>
                                <li>
                                    <a href="#.">10 review(s)
                                    </a>
                                </li>
                                <li>
                                    <a href="#.">Add your review
                                    </a>
                                </li>
                            </ul>
                            <h3 class="price marginbottom15">
                                <i class="fa fa-gbp" aria-hidden="true">
                                </i>170.00 &nbsp;
                                <span>
                    <i class="fa fa-gbp" aria-hidden="true">
                    </i>69.00
                  </span>
                            </h3>
                            <p class="marginbottom15 detail">Size:
                                <span>Large
                  </span>
                            </p>
                            <p class="marginbottom15 detail">Color:
                                <span>Grey white & Brown
                  </span>
                            </p>
                            <p class="detail">Dimensions:
                                <span>Height: 13cm x Length: 15cm
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
                    <h2 class="heading_space uppercase">featured products
                    </h2>
                    <p class="bottom_half">Claritas est etiam processus dynamicus, qui sequitur.
                    </p>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product_wrap bottom_half">
                        <div class="image">
                            <div class="tag">
                                <div class="tag-btn">
                    <span class="uppercase text-center">New
                    </span>
                                </div>
                            </div>
                            <a class="fancybox" href="../../../images/product1.jpg">
                                <img src="../../../images/product1.jpg" alt="Product" class="img-responsive">
                            </a>
                        </div>
                        <div class="product_desc">
                            <p>Sacrificial Chair Design
                            </p>
                            <span class="price">
                  <i class="fa fa-gbp">
                  </i>170.00
                </span>
                            <a class="fancybox" href="../../../images/product1.jpg" data-fancybox-group="gallery">
                                <i class="fa fa-shopping-bag open">
                                </i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product_wrap bottom_half">
                        <div class="image">
                            <a class="fancybox" href="../../../images/product2.jpg">
                                <img src="../../../images/product2.jpg" alt="Product" class="img-responsive">
                            </a>
                        </div>
                        <div class="product_desc">
                            <p>Sacrificial Chair Design
                            </p>
                            <span class="price">
                  <i class="fa fa-gbp">
                  </i>170.00
                </span>
                            <a class="fancybox" href="../../../images/product2.jpg" data-fancybox-group="gallery">
                                <i class="fa fa-shopping-bag open">
                                </i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product_wrap bottom_half">
                        <div class="image">
                            <div class="tag">
                                <div class="tag-btn">
                    <span class="uppercase text-center">New
                    </span>
                                </div>
                            </div>
                            <a class="fancybox" href="../../../images/product3.jpg">
                                <img src="../../../images/product3.jpg" alt="Product" class="img-responsive">
                            </a>
                        </div>
                        <div class="product_desc">
                            <p>Sacrificial Chair Design
                            </p>
                            <span class="price">
                  <i class="fa fa-gbp">
                  </i>170.00
                </span>
                            <a class="fancybox" href="../../../images/product3.jpg" data-fancybox-group="gallery">
                                <i class="fa fa-shopping-bag open">
                                </i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product_wrap bottom_half">
                        <div class="image">
                            <a class="fancybox" href="../../../images/product4.jpg">
                                <img src="../../../images/product4.jpg" alt="Product" class="img-responsive">
                            </a>
                        </div>
                        <div class="product_desc">
                            <p>Sacrificial Chair Design
                            </p>
                            <span class="price">
                  <i class="fa fa-gbp">
                  </i>170.00
                </span>
                            <a class="fancybox" href="../../../images/product4.jpg" data-fancybox-group="gallery">
                                <i class="fa fa-shopping-bag open">
                                </i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--NEWSLETER-->

    <!--Testinomial-->
    <section id="testinomial" class="padding">
        <div class="container">

            <div class="row">
                <div class="col-sm-4">
                    <div class="availability text-center margin_top">
                        <i class="fa fa-headphones">
                        </i>
                        <h5 class="uppercase">free shipping worldwide
                        </h5>
                        <span>Free shipping worldwide
              </span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="availability text-center margin_top">
                        <i class="fa fa-headphones">
                        </i>
                        <h5 class="uppercase">24/7 CUSTOMER SERVICE
                        </h5>
                        <span>Free shipping worldwide
              </span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="availability text-center margin_top">
                        <i class="fa fa-headphones">
                        </i>
                        <h5 class="uppercase">MONEY BACK GUARANTEE!
                        </h5>
                        <span>Free shipping worldwide
              </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script></script>
@endsection

@section('javascript')

    <script type="text/javascript">

        $(document).ready(function() {

            // Check if there are no items in the cart and show the popup
            if ($('#cart').length) {
                $('#promotion-popup').fadeIn();
            }

            // Close the popup when the close button is clicked
            $('.close-btn').on('click', function() {
                $('#promotion-popup').fadeOut();
            });
        });

    </script>

@endsection

