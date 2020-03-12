var App = function(){

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

var selecionaValorFreteCarrinho = function(){
  $('[name="frete_carrinho"]').on('click', function(){
    var valor = $(this).val();
    var total_carrinho = $(this).attr('data-total-carrinho');

    $('.linha-total-frete-carrinho').removeClass("hide");
    $('.total-carrinho-frete').html("R$ "+valor);
    $('.total-carrinho').html(total_carrinho);

  });
}

var calcularFreteCarrinho = function(){
  $(".btn-calcular-frete-carrinho").on('click', function(){

    var cep_produto = $("#cep").val();

    if ( !cep_produto) {
      alert("Voce precisa preencher os dados");
      $("#cep").focus();
      return false;
    }

    $('.retorno_frete').removeClass('hide');
    $('.retorno_frete').html('<div>Calculando frete...</div>');

    $.ajax({
      type: 'post',
      url: url_loja +'carrinho/calculaFrete',
      data: {cep:cep_produto},
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

  });
}

var calcularFreteProduto = function(){
  $(".btn-calcular-frete-produto").on('click', function(){

    var id_produto = $("#id_produto").val();
    var cep_produto = $("#cep").val();

    if ( !cep_produto) {
      alert("Voce precisa preencher os dados");
      $("#cep").focus();
      return false;
    }

    $('.retorno_frete').removeClass('hide');
    $('.retorno_frete').html('<div>Calculando frete...</div>');

    $.ajax({
      type: 'post',
      url: url_loja +'ajax/calcularfrete',
      data: {id:id_produto, cep:cep_produto},
      dataType: 'JSON'
    }).then (function(res){

      if (res.erro == 0) {

        $('.retorno_frete').html(res.valor_frete);

      } else{
        $('.retorno_frete').html(res.msg);
      }

    }, function(){
      alert('Erro buscar o cep');
    });

  });
}

var mascaraForm = function(){
  $('#cep').mask('00000-000', {reverse: true});
  $('#cc_validade').mask('00/0000', {reverse: true});

}

var atualizarQtdCarrinho = function(){

  $('.btn-atualizar-qtd-carrinho').on('click', function(){

    var id_produto = $(this).attr('data-id');
    var qtd_compra = $("#carrinho_qtd_"+id_produto).val();

    if (qtd_compra != 0) {

      $.ajax({
        type: 'post',
        url: url_loja +'carrinho/alterar',
        data: {id:id_produto, qtd: qtd_compra},
        dataType: 'JSON'
      }).then (function(res){

        if (res.erro == 0) {
          // location.reload();
          $(location).attr('href', url_loja+'carrinho');
        } else{

        }

      }, function(){
        alert('Erro ao remover produto');
      });

    } else{
      alert('Nao pode passar valor 0');
    }

  });
}

var removerItemCarrinho = function(){

  $('.remover-item-carrinho').on('click', function(){

    var id_produto = $(this).attr('data-id');

    $.ajax({
      type: 'post',
      url: url_loja +'carrinho/apagar_item',
      data: {id:id_produto},
      dataType: 'JSON'
    }).then (function(res){

      if (res.erro == 0) {
        // location.reload();
        $(location).attr('href', url_loja+'carrinho');
      } else{

      }

    }, function(){
      alert('Erro ao remover produto');
    });

  });

}

var getCarrinhoitem = function(){

  $.getJSON(url_loja+'carrinho/getCarrinhoTopo', function(res){

    if (res.erro == 0) {
      console.log(res.itens);
    }

  });

}

var limparCarrinho = function(){

  $('.btn-limpar-carrinho').on('click', function(){

    $.ajax({
      type: 'post',
      url: url_loja +'carrinho/limpar',
      data: {limpar:true},
      dataType: 'JSON'
    }).then (function(res){

      if (res.erro == 0) {
        $('.total-carrinho-menu').html("0");

      } else{
      }

    }, function(){
      alert('Erro ao remover produto');
    });


  });
}

var addProdutoCarrinho = function (){
  $('.btn-add-produto').on('click', function(){

    var id_produto = $(this).attr('data-id');

    $.ajax({
      type: 'post',
      url: url_loja +'carrinho/addProduto',
      data: {id:id_produto},
      dataType: 'JSON'
    }).then (function(res){

      if (res.erro == 0) {
        $('.msg-add-carrinho').removeClass('hide');
        $('.msg-carrinho-alert').html('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+res.msg+'</div>');
        $('.total-carrinho-menu').html(res.itens);
      } else{
        alert(res.msg);
      }

    }, function(){
      alert('Erro ao adicionar produto');
    });

  })
}

return {
  init: function(){
    addProdutoCarrinho();
    getCarrinhoitem();
    limparCarrinho();
    removerItemCarrinho();
    atualizarQtdCarrinho();
    mascaraForm();
    calcularFreteProduto();
    calcularFreteCarrinho();
    calcularCep();
  }
}

}();

jQuery(document).ready(function(){
  App.init();
});
