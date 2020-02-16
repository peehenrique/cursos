
<div class="row">
  <div class="col-md-12">

    <?php if ($dados){ ?>

      <h1 class="text-center">Relatórios de pedidos <?php echo formataDataView(dataDb()); ?></h1>

      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">N. Pedido</th>
            <th scope="col">Cliente</th>
            <th scope="col">Tipo Frete</th>
            <th scope="col">T. Produto</th>
            <th scope="col">V. Frete</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $t_frete = 0;
          $t_pedido = 0;
          ?>

          <?php foreach ($dados as $dado): ?>
            <tr>
              <td><?php echo $dado->id ?></td>
              <td><?php echo $dado->nome ?></td>
              <td><?php echo ($dado->forma_envio == 1 ? 'Sedex' : 'PAC') ?></td>
              <td class="text-right"><?php echo formataMoedaReal($dado->total_produto, 1) ?></td>
              <td class="text-right"><?php echo formataMoedaReal($dado->total_frete, 1) ?></td>
              <td class="text-right"><?php echo formataMoedaReal($dado->total_pedido, 1) ?></td>
            </tr>

            <?php

            $t_frete = $t_frete + $dado->total_frete;
            $t_pedido = $t_pedido + $dado->total_pedido;

            ?>

          <?php endforeach; ?>

          <tr>
            <td colspan="4" class="text-right">Totais...</td>
            <td class="text-right"><?php echo formataMoedaReal($t_frete, 1) ?></td>
            <td class="text-right"><?php echo formataMoedaReal($t_pedido, 1) ?></td>
          </tr>

        </tbody>

      </table>


    <?php }else{
      echo "Nao possui vendas nesse periodo ".formataDataView(dataDb());
    } ?>


  </div>


</div>
