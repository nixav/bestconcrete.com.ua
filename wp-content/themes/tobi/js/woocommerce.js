jQuery(document).ready(function () {
    var $ = jQuery;



    $(document).on('click', '.plus, .minus', function () {
        var $this = $(this);
        var qty_input = $this.parent().find('.qty');
        var current_qty = parseInt(qty_input.val());
        var add_to_cart_button = $this.parents('.add-to-cart-wrap').find('.ajax_add_to_cart')



        if ($this.hasClass('plus')) {
            qty_input.val(current_qty + 1)
            $('.woocommerce-cart-form :input[name="update_cart"]').prop('disabled', false);
        } else if ($this.hasClass('minus')) {
            if (current_qty > 1) {
                qty_input.val(current_qty - 1)
                $('.woocommerce-cart-form :input[name="update_cart"]').prop('disabled', false);
            }

            add_to_cart_button.attr('data-quantity', qty_input.val())
        }
    });
});