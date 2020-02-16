
<div class="row">
  <div class="col-md-12">

    <?php if ($produtos){ ?>

      <h1 class="text-center">Relatórios de pedidos mais vendidos</h1>

      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Cod. Produto</th>
            <th scope="col">Nome do Produto</th>
            <th scope="col">Quantidade vendida</th>
          </tr>
        </thead>
        <tbody>

          <?php foreach ($produtos as $produto): ?>
            <tr>
              <td><?php echo $produto->cod_produto ?></td>
              <td><?php echo $produto->nome_produto ?></td>
              <td><?php echo $produto->quant_vendidos ?></td>
            </tr>
          <?php endforeach; ?>

        </tbody>

      </table>

    <?php }else{
      echo "Nao possui vendas nesse periodo ".formataDataView(dataDb());
    } ?>

  </div>


</div>
