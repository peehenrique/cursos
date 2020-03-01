<div class="container">
  <div class="row">
    <div class="col-md-12">

      <h2>Carrinho aqui</h2>

      <?php

      $carrinho = $this->carrinhocompra->listarProdutos();
      echo "<pre>";
      print_r($carrinho);

      ?>

    </div>

  </div>

</div>
