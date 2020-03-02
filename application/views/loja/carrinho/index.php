<div class="container">
  <div class="row">
    <div class="col-md-12">

      <h2>Total de items no carrinho: <?php echo $this->carrinhocompra->totalItem() ?></h2>

      <table class="table table-bordered">
        <thead>
          <th>ID</th>
          <th>Nome</th>
          <th>Valor</th>
          <th>Quantidade</th>
          <th>SubTotal</th>
          <th>Opcoes</th>
        </thead>
        <tbody>

          <?php foreach ($carrinho as $indice => $linha): ?>
            <tr>
              <td><?php echo $linha['id'] ?></td>
              <td><?php echo $linha['nome'] ?></td>
              <td><?php echo formataMoedaReal($linha['valor'], 1) ?></td>
              <td>
                <input type="tel" name="carrinho_qtd" id="carrinho_qtd_<?php echo $linha['id'] ?>" value="<?php echo $linha['qtd'] ?>">
                <a href="javascript:void(0)" class="btn btn-warning btn-atualizar-qtd-carrinho" data-id="<?php echo $linha['id'] ?>"> <i class="fa fa-undo"></i> </a>
              </td>
              <td><?php echo formataMoedaReal($linha['subtotal'], 1) ?></td>
              <td> <a href="javascript:void(0)" class="btn btn-danger remover-item-carrinho" data-id="<?php echo $linha['id'] ?>">X</a> </td>

            </tr>
          <?php endforeach; ?>

        </tbody>
        <tfoot>
          <tr>
            <td colspan="4" class="text-right">TOTAL CARRINHO</td>
            <td class="total-carrinho"> <?php echo formataMoedaReal($this->carrinhocompra->total(), 1); ?> </td>
          </tr>
          <tr>
            <td colspan="4" class="text-right">TOTAL PESO</td>
            <td class="total-carrinho"> <?php echo $this->carrinhocompra->totalPeso(); ?> </td>
          </tr>

        </tfoot>
      </table>

    </div>

  </div>

  <div class="row">

    <div class="col-md-6">
      <form class="form-inline" action="index.html" method="post">
        <div class="form-group">
          <input type="text" class="form-control" id="cep-calculo-produto" placeholder="Seu CEP aqui">
        </div>
        <button type="button" class="btn btn-sucess">
          Calcular frete
        </button>
      </form>
      <div >
        <p>R$ VALOR DO FRETE</p>
      </div>
    </div>

    <div class="col-md-6 text-right">
      <a href="<?php echo base_url(); ?>" class="btn btn-primary">Continuar comprando</a>
      <a href="<?php echo base_url(); ?>" class="btn btn-success">Finalizar compra</a>
    </div>

  </div>

</div>
