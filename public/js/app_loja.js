var App = function(){

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
    }
  }

}();

jQuery(document).ready(function(){
  App.init();
});
