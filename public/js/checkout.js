var Checkout = function(){

  var formaPagamento = function(){
    $('.forma_pagamento').on('change', function(){

      var tipo = $(this).val();

      switch (tipo) {
        case "1":
        $('.pagamento-cartao').removeClass('hide');
        $('.pagamento-boleto').addClass('hide');
        $('.pagamento-transferencia').addClass('hide');
        $('.pagamento-cartao input').prop('disabled', false);
        break;

        case "2":
        $('.pagamento-boleto').removeClass('hide');
        $('.pagamento-cartao').addClass('hide');
        $('.pagamento-transferencia').addClass('hide');
        $('.pagamento-cartao input').prop('disabled', true);
        break;

        case "3":
        $('.pagamento-transferencia').removeClass('hide');
        $('.pagamento-boleto').addClass('hide');
        $('.pagamento-cartao').addClass('hide');
        $('.pagamento-cartao input').prop('disabled', true);
        break;

      }


    });
  }

  return {
    init: function(){
      formaPagamento();
    }
  }

}();

jQuery(document).ready(function(){
  Checkout.init();
});
