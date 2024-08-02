$(document).ready(function() {

    function updateSubtotal(element) {

        var quantity = parseFloat($(element).val());
        var price = parseFloat($(element).closest('tr').find('.item-price').text().replace('.', '').replace(',', '.'));
        var subtotal = quantity * price;

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
