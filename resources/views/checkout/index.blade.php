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

    <section id="cart" class="padding">
        <div class="container">
            <form action="{{ route('checkout.store') }}" method="POST" class="cart-form">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="heading uppercase marginbottom15">Checkout</h4>

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

                            @foreach($itens as $index => $item)
                                <tr>
                                    <td style="width: 15%; height: 15%">
                                        <img class="shopping-product" src="{{ $url . $item['image'] }}" alt="your product" style="width: 50%; height: 10%">
                                    </td>
                                    <td class="product-name">
                                        <h5>{{ $item['nome'] }}</h5>
                                    </td>
                                    <td></td>
                                    <td class="price">
                                        <h5>R$<span class="item-price">{{ number_format($item['price'], 2, ',', '.') }}</span></h5>
                                    </td>
                                    <td>
                                        <span>{{ $item['quantity'] }}</span>
                                    </td>
                                    <td class="price">
                                        <h5>R$<span class="item-subtotal">{{ number_format($item['quantity'] * $item['price'], 2, ',', '.') }}</span></h5>
                                    </td>
                                </tr>
                                <!-- Hidden inputs for each item -->
                                <input type="hidden" name="items[{{ $index }}][id_produto]" value="{{ $item['id_produto'] }}">
                                <input type="hidden" name="items[{{ $index }}][name]" value="{{ $item['nome'] }}">
                                <input type="hidden" name="items[{{ $index }}][quantity]" value="{{ $item['quantity'] }}">
                                <input type="hidden" name="items[{{ $index }}][price]" value="{{ $item['price'] }}">
                                <input type="hidden" name="items[{{ $index }}][total_before_taxe]" value="{{ $item['price'] * $item['quantity'] }}">
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="shop_measures margintop40">
                        <h4 class="heading uppercase bottom30">Detalhes de pagamento</h4>
                        @csrf
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="fullname">Nome completo</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nome completo" required value="{{ $contactDetails->name }}">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="cpf_cnpj">CPF/CNPJ</label>
                                <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" placeholder="Apenas números" required value="{{ $contactDetails->cpf_cnpj }}">
                            </div>

                            <input type="hidden" id="hidden-billing-type" name="billingType" value="">
                            <input type="hidden" id="hidden-installments" name="installments" value="">
                            <input type="hidden" id="hidden-installment-value" name="installmentValue" value="">
                            <input type="hidden" id="is_active_taxe_rate" name="is_active_taxe_rate" value="{{ $items->is_active_taxe_rate }}">
                            <input type="hidden" id="interest_free_installments" name="interest_free_installments" value="{{ $items->interest_free_installments }}">
                            <div class="col-md-12 form-group">
                                <label for="cpf_cnpj">Formas de pagamento</label>
                                <input type="hidden" class="form-control" id="cpf_cnpj" name="cpf_cnpj" placeholder="Apenas números" required value="{{ $contactDetails->cpf_cnpj }}">
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="align-content: center">
                            <div class="col-md-6 form-group ml-6" >

                                <select class="form-control" name="billingTypeSelect" id="billingType">
                                    <option selected>Selecione a forma de pagamento</option>
                                    <option class="uppercase" value="BOLETO">Boleto</option>
                                    <option class="uppercase" value="CREDIT_CARD">Cartão</option>
                                    <option class="uppercase" value="PIX">Pix</option>
                                </select>
                            </div>

                            <div class="col-md-6 form-group mr-4" id="parcelas-group" style="display:none;">
                                <label for="parcelas">Parcelas</label>
                                <select class="form-control" id="parcelas" name="parcelas"></select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <!-- Campos adicionais para os dados do cartão -->
                            <div id="cartao-fields" class="col-md-12" style="display: none;">
                                <div class="row">
                                    <div class="col-md-12 form-group mb-4">
                                        <label for="holderName">Titular</label>
                                        <input type="text" class="form-control" id="holderName" name="holderName" placeholder="Mome impresso no cartão">
                                    </div>
                                    <div class="col-md-12 form-group mb-4">
                                        <label for="cardNumber">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                                    </div>
                                    <div class="col-md-6 form-group mb-4">
                                        <label for="number">Numero cartão</label>
                                        <input type="text" class="form-control" id="number" name="number" placeholder="Titular do Cartão">
                                    </div>
                                    <div class="col-md-3 form-group mb-4">
                                        <label for="cardExpiry">MM</label>
                                        <input type="text" class="form-control" id="cardExpiry" name="expiryMonth" placeholder="MM">
                                    </div>
                                    <div class="col-md-3 form-group mb-4">
                                        <label for="cardExpiry">AA</label>
                                        <input type="text" class="form-control" id="cardExpiry" name="expiryYear" placeholder="AAAA">
                                    </div>
                                    <div class="col-md-6 form-group mb-4">
                                        <label for="cardCVV">CVV</label>
                                        <input type="text" class="form-control" id="cardCVV" name="ccv" placeholder="CVV">
                                    </div>
                                    <div class="col-md-6 form-group mb-4">
                                        <label for="cardHolder">numero cartão</label>
                                        <input type="text" class="form-control" id="cardHolder" name="cardHolder" placeholder="Titular do Cartão">
                                    </div>

                                    <div class="col-md-6 form-group mb-4">
                                        <label for="cpfCnpj">CPF</label>
                                        <input type="text" class="form-control" id="cpfCnpj" name="cpfCnpj" placeholder="CPF Titular">
                                    </div>
                                    <div class="col-md-6 form-group mb-4">
                                        <label for="postalCode">CEP</label>
                                        <input type="text" class="form-control" id="postalCode" name="postalCode" placeholder="CEP">
                                    </div>
                                    <div class="col-md-6 form-group mb-4">
                                        <label for="addressNumber">Numero</label>
                                        <input type="text" class="form-control" id="addressNumber" name="addressNumber" placeholder="Número">
                                    </div> <div class="col-md-6 form-group mb-4">
                                        <label for="cardNumber">Complemento</label>
                                        <input type="text" class="form-control" id="cardNumber" name="addressComplement" placeholder="Complemento">
                                    </div>
                                    <div class="col-md-6 form-group mb-4">
                                        <label for="phone">Telefone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Número de  telefone">
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12 form-group">
                                <input type="hidden" id="total-input" name="total" value="0">
                                <input type="submit" class="uppercase btn-dark border-radius margintop30" value="Finalizar compra">
                            </div>
                        </div>
                    </div>
                    <div class="row">


                    </div>


                </div>

                <div class="col-sm-4">
                    <div class="shop_measures margintop40">
                        <h4 class="heading uppercase bottom30">Informações gerais</h4>
                        <table class="table table-responsive">
                            <tbody>
                            <tr>
                                <td>Subtotal</td>
                                <td class="text-right"><h5>R$<span id="cart-subtotal">0,00</span></h5></td>
                            </tr>
                            <tr>
                                <td>Frete</td>
                                <td class="text-right"><h5>R$<span id="shipping-cost">0,00</span></h5></td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td class="text-right"><h5 class="price">R$<span id="cart-total">0,00</span></h5></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>




@endsection


@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {

        function formatCurrency(value) {
            return parseFloat(value.replace(/\./g, '').replace(',', '.'));
        }

        function toCurrency(value) {
            return value.toFixed(2).replace('.', ',');
        }

        function calculateTotal() {
            let subtotal = 0;
            let shipping = formatCurrency($('#shipping-cost').text()) || 0;

            $('.item-subtotal').each(function() {
                let itemSubtotal = formatCurrency($(this).text());
                subtotal += itemSubtotal;
            });

            $('#cart-subtotal').text(toCurrency(subtotal));
            let total = subtotal + shipping;
            $('#cart-total').text(toCurrency(total));
            $('#total-input').val(toCurrency(total));
        }

        function calculateInstallments(total, taxRates, isTaxRateActive, interestFreeInstallments) {
            const parcelasSelect = document.getElementById('parcelas');
            parcelasSelect.innerHTML = '';

            let installmentCounter = 1;
            taxRates.forEach(rate => {
                for (let i = installmentCounter; i <= rate.interest_installments; i++) {
                    let valorParcela;
                    let textoParcela;

                    if (isTaxRateActive === 0 || i <= interestFreeInstallments) {
                        valorParcela = toCurrency(total / i);
                        textoParcela = "sem juros";
                    } else {
                        let rateAmount = rate.amount / 100;
                        let valorParcelaSimples = (total + (total * rateAmount * i)) / i;
                        valorParcela = toCurrency(valorParcelaSimples);
                        textoParcela = "com juros";
                    }

                    let option = document.createElement('option');
                    option.value = `${i}|${valorParcela.replace(',', '.')}`;
                    option.text = `${i}x de R$ ${valorParcela} ${textoParcela}`;
                    parcelasSelect.appendChild(option);
                }
                installmentCounter = rate.interest_installments + 1;
            });
        }

        function displaySinglePaymentOptions(total, rate, isTaxRateActive) {
            const parcelasSelect = document.getElementById('parcelas');
            parcelasSelect.innerHTML = ''; // Limpa o select

            const totalWithFee = isTaxRateActive === 1 ? total * (1 + rate.amount / 100) : total;
            const formattedTotal = toCurrency(totalWithFee);

            const options = [
                { method: 'BOLETO', value: `1x de R$ ${formattedTotal} com juros (${rate.name})` },
                { method: 'PIX', value: `1x de R$ ${formattedTotal} com juros (${rate.name})` }
            ];

            options.forEach(option => {
                let selectOption = document.createElement('option');
                selectOption.value = `1|${formattedTotal.replace(',', '.')}`; // Adicionar o valor da parcela junto com a quantidade
                selectOption.text = option.value;
                parcelasSelect.appendChild(selectOption);
            });
        }

        calculateTotal();

        $('.cart-form').on('change', 'input, select', function() {
            calculateTotal();
        });

        const billingType = document.getElementById('billingType');
        const parcelasGroup = document.getElementById('parcelas-group');
        const valorTotal = document.getElementById('total-input');
        const isTaxRateActive = parseInt(document.getElementById('is_active_taxe_rate').value);
        const interestFreeInstallments = parseInt(document.getElementById('interest_free_installments').value);

        billingType.addEventListener('change', function() {
            const totalValue = formatCurrency(valorTotal.value);
            parcelasGroup.style.display = 'block';

            if (this.value === 'CREDIT_CARD') {
                $('#cartao-fields').show();
                $.ajax({
                    url: '/get-tax-rates',
                    type: 'GET',
                    success: function(response) {
                        calculateInstallments(totalValue, response, isTaxRateActive, interestFreeInstallments);
                    }
                });
            } else if (this.value === 'BOLETO' || this.value === 'PIX') {
                $('#cartao-fields').hide();
                $.ajax({
                    url: '/get-tax-rates',
                    type: 'GET',
                    success: function(response) {
                        const firstRate = response[0];
                        displaySinglePaymentOptions(totalValue, firstRate, isTaxRateActive);
                    }
                });
            } else {
                parcelasGroup.style.display = 'none';
                $('#cartao-fields').hide();
            }
        });

        const form = document.querySelector('form');

        form.addEventListener('submit', function(event) {
            const selectedOption = document.getElementById('parcelas').selectedOptions[0];
            const billingTypeValue = billingType.value;
            const [installmentsCount, installmentValue] = selectedOption.value.split('|');

            document.getElementById('hidden-billing-type').value = billingTypeValue;
            document.getElementById('hidden-installments').value = installmentsCount;
            document.getElementById('hidden-installment-value').value = installmentValue;
        });
    });
</script>










@endsection
