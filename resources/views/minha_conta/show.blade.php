<!-- resources/views/minha_conta/partials/product_details_modal.blade.php -->
<div class="modal fade" id="productDetailsModal" tabindex="-1" role="dialog" aria-labelledby="productDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productDetailsModalLabel">Detalhes do Pedidos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <section id="cart" class="padding">
                    <div class="container" style="width: 95%; height: 50%">
                        <div class="row">
                            <div class="col-sm-8">

                                <h4 class="heading uppercase marginbottom15">pedido numero - {{ $pedidos->number_pedido}}</h4>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="uppercase">Imagem</th>
                                            <th class="uppercase">Produto</th>
                                            <th class="uppercase"></th>
                                            <th class="uppercase">Preço</th>
                                            <th class="uppercase">Quantidade</th>
                                            <th class="uppercase"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($itens as $item)

                                            <tr>
                                                <td style="width: 8%; height: 8%">
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
                                                    <div class="input-group spinner text-center">
                                                        <span class="text-center">1</span>
                                                    </div>
                                                </td>


                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>


                                <div class="row">
                                    <div class="col-sm-8">
                                        <a href="/produtos" class="uppercase btn-light border-radius margintop30">Continue comprando</a>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="shop_measures margintop40">
                                    <h4 class="heading uppercase bottom30">Detalhes de pagamento</h4>
                                    <table class="table table-responsive">
                                        <tbody>

                                        <tr>
                                            <td>Forma de pagamento</td>
                                            <td class="text-right"><h5>R$<span id="cart-subtotal">0,00</span></h5></td>
                                        </tr>
                                        <tr>
                                            <td>Qdt. Parcelas</td>
                                            <td class="text-right"><h5>R$<span id="cart-subtotal">0,00</span></h5></td>
                                        </tr>
                                        <tr>
                                            <td>Valor parcelas</td>
                                            <td class="text-right"><h5>R$<span id="cart-subtotal">0,00</span></h5></td>
                                        </tr>
                                        <tr>
                                            <td>Frete</td>
                                            <td class="text-right"><h5>R$<span id="shipping-cost">10,00</span></h5></td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td class="text-right"><h5 class="price">R$<span id="cart-total">10,00</span></h5></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    {{--                        <form action="{{ route('checkout') }}" method="POST">--}}

                                    {{--                        </form>--}}
                                </div>
                            </div>
                        </div>
                </section>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
