<div class="modal-content view_modal" style="width: 150%; align-items: center">
<div class="modal-header">
    <h5 class="modal-title" id="productDetailsModalLabel">Pedido {{$pedido->number_pedido}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" style="width: 100%">
    <!-- Conteúdo do modal -->
    <section id="cart" class="padding">
        <div class="container" style="width: 95%; height: 50%">
            <div class="row">
                <div class="col-sm-8">
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
                                <td class="text-right"><span>{{$pedido->billing_type}}</span></td>
                            </tr>
                            @if($pedido->billing_type == 'CREDIT_CARD')
                            <tr>
                                <td>Qdt. Parcelas</td>
                                <td class="text-right"><span>{{$pedido->quantidade_parcela}}</span></td>
                            </tr>
                            <tr>
                                <td>Valor parcelas</td>
                                <td class="text-right"><h5>R$<span id="cart-subtotal">{{$pedido->valor_parcela}}</span></h5></td>
                            </tr>
                            @endif
                            @if($pedido->frete)
                                <tr>
                                <td>Frete</td>
                                <td class="text-right"><h5>R$<span id="shipping-cost">10,00</span></h5></td>
                            </tr>
                            @endif

                            <tr>
                                <td>Total</td>
                                <td class="text-right"><h5 class="price">R$<span id="cart-total">{{$pedido->billing_type == 'CREDIT_CARD' ?$pedido->valor_parcela * $pedido->quantidade_parcela : $pedido->valor_before_taxa}}</span></h5></td>
                            </tr>
                            </tbody>
                        </table>
                        {{--                        <form action="{{ route('checkout') }}" method="POST">--}}

                        {{--                        </form>--}}
                    </div>
                </div>
            </div>
    </section>
    <!-- Outros detalhes do pedido -->
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
</div>
</div>

