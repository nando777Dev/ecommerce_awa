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
                console.log(interestFreeInstallments)

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
            // Faça a requisição AJAX para obter as taxas
            $.ajax({
                url: '/get-tax-rates',
                type: 'GET',
                success: function(response) {
                    calculateInstallments(totalValue, response, isTaxRateActive, interestFreeInstallments);
                }
            });
        } else if (this.value === 'BOLETO' || this.value === 'PIX') {
            // Faça a requisição AJAX para obter a primeira taxa
            $.ajax({
                url: '/get-tax-rates',
                type: 'GET',
                success: function(response) {
                    const firstRate = response[0]; // Pega apenas a primeira taxa
                    displaySinglePaymentOptions(totalValue, firstRate, isTaxRateActive);
                }
            });
        } else {
            parcelasGroup.style.display = 'none'; // Esconde o grupo de parcelas se não for um método de pagamento com parcelas
        }
    });

    const form = document.querySelector('form');

    form.addEventListener('submit', function(event) {
        const selectedOption = document.getElementById('parcelas').selectedOptions[0];
        const billingTypeValue = billingType.value;
        const [installmentsCount, installmentValue] = selectedOption.value.split('|');

        // Atualizar inputs ocultos com os dados selecionados
        document.getElementById('hidden-billing-type').value = billingTypeValue;
        document.getElementById('hidden-installments').value = installmentsCount;
        document.getElementById('hidden-installment-value').value = installmentValue;
    });
});
