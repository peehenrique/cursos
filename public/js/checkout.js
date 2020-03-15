var Checkout = function(){


  var selecionaValorFreteCarrinho = function(){
    $('[name="frete_carrinho"]').on('click', function(){
      var valor = $(this).val();
      var total_carrinho = $(this).attr('data-total-carrinho');

      $('.linha-total-frete-carrinho').removeClass("hide");
      $('.total-carrinho-frete').html("R$ "+valor);
      $('.total-carrinho').html(total_carrinho);

    });
  }

  var limpa_formulario_cep = function(){
    // Limpa valores do formulário de cep.
    $("#endereco").val("");
    $("#bairro").val("");
    $("#cidade").val("");
    $("#uf").val("");
  }

  var calcularCep = function(){
    $('.btn-calcular-cep').on('click', function(){

      //Nova variável "cep" somente com dígitos.
      var cep = $('#cep').val().replace(/\D/g, '');
      var cep_checkout = $('#cep').val();

      $('.retorno_frete').removeClass('hide');
      $('.retorno_frete').html('<div>Calculando frete...</div>');

      $.ajax({
        type: 'post',
        url: url_loja +'checkout/calculaFrete',
        data: {cep:cep_checkout},
        dataType: 'JSON'
      }).then (function(res){

        if (res.erro == 0) {

          $('.retorno_frete').html(res.valor_frete);
          selecionaValorFreteCarrinho();

        } else{
          $('.retorno_frete').html(res.msg);
        }

      }, function(){
        alert('Erro buscar o cep');
      });




      //Verifica se campo cep possui valor informado.
      if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

          //Preenche os campos com "..." enquanto consulta webservice.
          $("#endereco").val("...");
          $("#bairro").val("...");
          $("#cidade").val("...");
          $("#uf").val("...");
          $("#ibge").val("...");

          //Consulta o webservice viacep.com.br/
          $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

            if (!("erro" in dados)) {
              //Atualiza os campos com os valores da consulta.
              $("#endereco").val(dados.logradouro);
              $("#bairro").val(dados.bairro);
              $("#cidade").val(dados.localidade);
              $("#uf").val(dados.uf);
              $("#numero").focus();

            } //end if.
            else {
              //CEP pesquisado não foi encontrado.
              limpa_formulario_cep();
              alert("CEP não encontrado.");
            }
          });
        } //end if.
        else {
          //cep é inválido.
          limpa_formulário_cep();
          alert("Formato de CEP inválido.");
        }
      } //end if.
      else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
      }

    });

  }




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


  //INTEGRACAO COM API PAGSEGURO
  var setSessionId = function(){

    $.ajax({
      url: url_loja+'pagar/pg_session_id',
      dataType: 'json',
      success: function(res){
        if (res.erro == 0) {
          var id_sessao = res.id_sessao;
          PagSeguroDirectPayment.setSessionId(id_sessao);
        }else{
          alert(res.msg);
        }
      },
      error: function(error){
        alert('Ocorreu um erro, tente novamente');
      }
    })

  }


  var btnPagarBoleto = function(){

    $('.btn-pagar-boleto').on('click', function(e){
      $('.erro_validacao').html('');
      $('.msg_envio').html('');

      var hash_pagamento = PagSeguroDirectPayment.getSenderHash();
      $('[name="hash"]').val(hash_pagamento);

      var form = $('.form_checkout_pagar');
      var erro_validacao = false;
      var retorno_erro_validacao = "";

      $(form).find('input').each(function(){
        if ($(this).val() == "" && $(this).prop('disabled') == false ) {
          erro_validacao = true;
          var nome_campo = $(this).attr('placeholder');
          retorno_erro_validacao += '<p>'+nome_campo + ' e um campo obrigatorio</p>';
        }
      });

      if (!erro_validacao) {
        e.preventDefault();

        $.ajax({
          type: 'post',
          url: url_loja+'pagar/pg_boleto',
          data: form.serialize(),
          dataType: 'JSON',
          beforeSend: function(){
            $('.msg_envio').removeClass('hide');
          },
          success: function(res){

            if (res.erro == 0) {

              alert('form enviado');

            } else{
              $('.erro_validacao').removeClass('hide');
              $('.erro_validacao').html(res.msg);
            }

          },
          error: function(){
            alert('erro ao enviar formulario');
          }
        });


      } else{
        $('.erro_validacao').removeClass('hide');
        $('.erro_validacao').html(retorno_erro_validacao);
      }



    })


  }



  return {
    init: function(){
      formaPagamento();
      calcularCep();
      setSessionId();
      btnPagarBoleto();
    }
  }

}();

jQuery(document).ready(function(){
  Checkout.init();
});
