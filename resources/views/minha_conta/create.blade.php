<div class="modal-dialog modal_xl no-print" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalTitle"> Adicionar venda ao sistema
            </h4>
        </div>


        <div class="modal-body">
            <div class="row">

            </div>


            <hr>




            <br>
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <h4>Produtos:</h4>
                </div>

                <div class="col-sm-12 col-xs-12">
                    <div class="table-responsive">
                        <table class="table bg-gray">
                            <tr class="bg-green">
                                <th>#</th>

                                <th>Produdo</th>
                                <th>Qtd</th>

                                <th>Valor</th>
                                <th>Subtotal</th>

                            </tr>
                            <tr>

                            {{--@foreach($produtos_details as $produto)

                                @php
                                    //$quantidade = $produto['quantidade'] * $produto['quantidade'] ??  $produto['quantidade'];
                                    $quantidade_final =  $produto['quantidade'];

                                    $valor_formatado = $produto['default_sell_price'] * $quantidade_final;

                                    $valor_final = $valor_formatado;
                                    //$valor_retornado =

                                    //$unidade = $produto['qdt_per_box'] > 0 ? '' : 'UN';
                                @endphp
                                <tr>
                                    <td>#</td>
                                    <td>{{$produto['nome']}}</td>
                                    <td>{{$produto['quantidade'] }} </td>


                                    <td>R$ {{@number_format($produto['default_sell_price'] * $quantidade_final, 2, ',', '.')}}</td>
                                    <td>R$ {{ @number_format($valor_final , 2, ',', '.') }}</td>


                                </tr>
                                @endforeach
--}}
                                </tr>

                        </table>
                    </div>
                </div>
            </div>

            <div class="row">


               {{-- <div class="col-md-6 col-sm-12 col-xs-12 pull-right ">
                    <div class="table-responsive">
                        <table class="table bg-gray">
                            @if($pedidos->billing_type == 'CREDIT_CARD')
                                <tr>
                                    <th>Valor total: </th>
                                    <td></td>
                                    <td><span class="display_currency pull-right" > {{$pedidos->valor_before_taxa}}</span></td>
                                </tr>
                                <tr>
                                    --}}{{-- @php
                                         $vl_taxa = $pedido_franquia->valor_taxa;
                                         $valor_total = $pedido_franquia->total_pedido + $pedido_franquia->valor_taxa;
                                     @endphp--}}{{--
                                    <th>Valor a receber pos taxa</th>
                                    <td><b>(-)</b></td>
                                    <td class="text-right">
                                        {{$pedidos->valor_after_taxa}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Forma de pagamento: </th>
                                    <td></td>
                                    <td class="text-right">{{$pedidos->billing_type}}</td>

                                </tr>
                                <tr>
                                    <th>Quantidade de parcelas: </th>
                                    <td></td>
                                    <td class="text-right">{{$pedidos->quantidade_parcela}}</td>

                                </tr>
                                <tr>
                                    <th>Valor parcela: </th>
                                    <td></td>
                                    <td class="text-right">{{$pedidos->valor_parcela}}</td>

                                </tr>
                                <tr>
                                    <th>Total: </th>
                                    <td></td>
                                    <td class="text-right"><span ></span>{{$pedidos->valor_before_taxa}}</td>

                                </tr>
                            @else

                                <tr>
                                    <th>Valor total: </th>
                                    <td></td>
                                    <td><span class="display_currency pull-right" > {{$pedidos->valor_before_taxa}}</span></td>
                                </tr>
                                <tr>
                                    --}}{{-- @php
                                         $vl_taxa = $pedido_franquia->valor_taxa;
                                         $valor_total = $pedido_franquia->total_pedido + $pedido_franquia->valor_taxa;
                                     @endphp--}}{{--
                                    <th>Valor a receber pos taxa</th>
                                    <td><b>(-)</b></td>
                                    <td class="text-right">
                                        {{$pedidos->valor_after_taxa}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Forma de pagamento: </th>
                                    <td></td>
                                    <td class="text-right">{{$pedidos->billing_type}}</td>

                                </tr>
                                <tr>
                                    <th>Quantidade de parcelas: </th>
                                    <td></td>
                                    <td class="text-right">{{$pedidos->quantidade_parcela}}</td>

                                </tr>
                                <tr>
                                    <th>Quantidade de parcelas: </th>
                                    <td></td>
                                    <td class="text-right">{{$pedidos->valor_parcela}}</td>

                                </tr>
                                <tr>
                                    <th>Total: </th>
                                    <td></td>
                                    <td class="text-right"><span ></span>{{$pedidos->valor_before_taxa}}</td>

                                </tr>
                            @endif
                        </table>
                    </div>
                </div>--}}
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var element = $('div.modal-xl');
        __currency_convert_recursively(element);
    });
</script>
