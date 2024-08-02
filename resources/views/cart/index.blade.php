@extends('layouts.app')

@section('title', 'Carrinho')

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

    <section class="page_menu">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="hidden">hidden</h3>
                    <ul class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li>Produtos</li>
                        <li class="active">Carrinho de compras</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>



    <!--Cart TAble-->


    @if($itemCount < 0 )
        <section id="cart" class="padding">
            <div class="container">
                <h1>Seu carrinho está vazio</h1>
            </div>
        </section>

        <!-- Pop-up -->
        <div id="promotion-popup" class="popup-overlay">
            <div class="popup-content">
                <span class="close-btn">&times;</span>
                <h2>Promoção Especial!</h2>
                <p>Confira nossas <a href="/promocoes">promoções</a> e aproveite as ofertas!</p>
            </div>
        </div>

    @else
        <section id="cart" class="padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="heading uppercase marginbottom15">Carrinho de compras</h4>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="uppercase">Imagem</th>
                                    <th class="uppercase">Produto</th>
                                    <th class="uppercase"></th>
                                    <th class="uppercase">Preço</th>
                                    <th class="uppercase">Quantidade</th>
                                    <th class="uppercase">Valor total</th>
                                    <th class="uppercase"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($itens as $item)
                                    @dd($item)
                                    <tr>
                                        <td style="width: 30%; height: 25%">
                                            <img class="shopping-product" src="{{$url . $item['image']}}" alt="your product" style="width: 50%; height: 10%">
                                        </td>
                                        <td class="product-name">
                                            <h5>{{$item['nome']}}</h5>
                                        </td>
                                        <td></td>
                                        <td class="price">
                                            <h5>R$<span class="item-price">{{ number_format($item['price'], 2, ',', '.') }}</span></h5>
                                        </td>
                                        <td>
                                            <div class="input-group spinner">
                                                <input type="text" name="quantidade" min="1" class="form-control item-quantity"  data-item-id="{{ $item['id_produto'] }}">
                                            </div>
                                        </td>
                                        <td>
                                            <h1>teste</h1>
                                        </td>
                                        <td class="price">
                                            <h5>R$<span class="item-subtotal">0,00</span></h5>
                                        </td>
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <td class="text-center">

                                                <input type="hidden" name="id" value="{{$item['id_produto']}}">

                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>


                        <div class="row">
                            <div class="col-sm-8">
                                <a href="/produtos" class="uppercase btn-light border-radius margintop30">Continue comprando</a>
                            </div>
                            {{-- <div class="col-sm-3 text-right">
                                 <a href="#." class="uppercase btn-dark border-radius margintop30">Atualizar carrinho</a>
                             </div>--}}
                            <div class="col-sm-3 text-right">
                                <a href="#." class="uppercase btn-dark border-radius margintop30">Limpar carrinho</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="shop_measures margintop40">
                            <h4 class="heading uppercase bottom30">Calculos de envio</h4>
                            <form class="cart-form">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="country">Selecione a cidade</label>
                                        <input type="text" class="form-control" id="country" placeholder="Fortaleza" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="city">Selecione o estado</label>
                                        <label class="select form-control">
                                            <select name="country" id="city">
                                                <option>GO</option>
                                                <option>PR</option>
                                                <option>CT</option>
                                                <option>SP</option>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="zip">CEP</label>
                                        <input type="text" class="form-control" id="zip" placeholder="Zip Code" required>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input type="submit" class="uppercase btn-dark border-radius margintop30" value="Update Shipping">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="shop_measures margintop40">
                            <h4 class="heading uppercase bottom30">cupom de desconto</h4>
                            <p class="bottom_half">Insira aqui caso tenha um cupom de desconto</p>
                            <form class="cart-form">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="country">codigo do cupom</label>
                                        <input type="text" class="form-control" id="country" placeholder="98F101192" required>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input type="submit" class="uppercase btn-dark border-radius margintop30" value="REdeem code">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="shop_measures margintop40">
                            <h4 class="heading uppercase bottom30">Carrinho total</h4>
                            <table class="table table-responsive">
                                <tbody>
                                <tr>
                                    <td>Carrinho Subtotal</td>
                                    <td class="text-right"><h5>R$<span id="cart-subtotal">0,00</span></h5></td>
                                </tr>
                                <tr>
                                    <td>Frete</td>
                                    <td class="text-right"><h5>R$<span id="shipping-cost">10,00</span></h5></td>
                                </tr>
                                <tr>
                                    <td>Total do Carrinho</td>
                                    <td class="text-right"><h5 class="price">R$<span id="cart-total">10,00</span></h5></td>
                                </tr>
                                </tbody>
                            </table>
                            {{--                        <form action="{{ route('checkout') }}" method="POST">--}}
                            @csrf
                            <input type="hidden" name="cart_total" id="cart_total_hidden" value="10,00">
                            <button type="submit" class="uppercase btn-light border-radius margintop30">Proceed to checkout</button>
                            {{--                        </form>--}}
                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endif

@endsection
@section('javascript')
    <script src="{{ asset('js/checkout.js') }}"></script>

@endsection

{{--@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {

            function updateSubtotal(element) {

                var quantity = parseFloat($(element).val());
                var price = parseFloat($(element).closest('tr').find('.item-price').text().replace('.', '').replace(',', '.'));
                var subtotal = quantity * price;
                alert()
                // Format subtotal to Brazilian currency
                var subtotalFormatted = subtotal.toFixed(2).replace('.', ',');

                $(element).closest('tr').find('.item-subtotal').text(subtotalFormatted);

                updateCartTotal();
            }

            function updateCartTotal() {
                var total = 0;
                $('.item-subtotal').each(function() {
                    var subtotal = parseFloat($(this).text().replace('.', '').replace(',', '.'));
                    total += subtotal;
                });

                // Format total to Brazilian currency
                var totalFormatted = total.toFixed(2).replace('.', ',');

                var shippingCost = parseFloat($('#shipping-cost').text().replace('.', '').replace(',', '.'));
                var cartTotal = total + shippingCost;
                var cartTotalFormatted = cartTotal.toFixed(2).replace('.', ',');

                $('#cart-subtotal').text(totalFormatted);
                $('#cart-total').text(cartTotalFormatted);
                $('#cart_total_hidden').val(cartTotalFormatted);
            }

            // Initial calculation
            $('.item-quantity').each(function() {
                updateSubtotal(this);
            });

            // Update subtotal on quantity change
            $(document).on('input', '.item-quantity', function() {
                updateSubtotal(this);
            });
        });

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


@endsection--}}
