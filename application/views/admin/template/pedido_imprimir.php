<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $titulo; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('/public/dist/bootstrap/dist/css/bootstrap.min.css'); ?>">

</head>
<body>


  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1><?php echo $config->empresa ?></h1>
        <h5><?php echo $config->email ?> - <?php echo $config->telefone ?></h5>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-md-12 text-center">
        <h1>Dados comprador</h1>
        <table>
          <tr>
            <td>Nome: <?php echo $pedido->nome ?></td>
          </tr>
          <tr>
            <td>Telefone: <?php echo $pedido->telefone ?></td>
          </tr>
          <tr>
            <td>Email: <?php echo $pedido->email ?></td>
          </tr>
        </table>
      </div>
    </div>

    <hr>

    <div class="row">
      <div class="col-md-12 text-center">
        <h1>Dados do envio</h1>
        <table>
          <tr>
            <td>Endereço: <?php echo $pedido->endereco ?></td>
          </tr>
          <tr>
            <td>CEP: <?php echo $pedido->cep ?></td>
          </tr>
          <tr>
            <td>Forma Envio: <?php echo ($pedido->forma_envio == 1 ? 'Sedex' : 'PAC') ?></td>
          </tr>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center">Itens do Pedido</h1>


        <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Item</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Valor</th>
            <th scope="col">Valor Total</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($itens as $item): ?>
            <tr>
              <td><?php echo $item->nome_item ?></td>
              <td><?php echo $item->quantidade ?></td>
              <td><?php echo formataMoedaReal($item->valor_unitario, 1) ?></td>
              <td><?php echo formataMoedaReal($item->valor_total_item, 1)?></td>
            </tr>
          <?php endforeach; ?>

        </tbody>
      </table>

    </div>
  </div>
  <hr>

  <hr>

  <div class="row">
    <div class="col-md-12 text-center">
      <h1>Totais</h1>
      <table>
        <tr>
          <td>Total Produtos: <?php echo formataMoedaReal($pedido->total_produto, 1) ?></td>
        </tr>
        <tr>
          <td>Total Frete: <?php echo formataMoedaReal($pedido->total_frete, 1) ?></td>
        </tr>
        <tr>
          <td>Total Pedido: <?php echo formataMoedaReal($pedido->total_pedido, 1) ?></td>
        </tr>
      </table>
    </div>
  </div>

</div>

<!-- jQuery 3 -->
<script src="<?php echo base_url('/public/js/jquery.min.js'); ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('/public/js/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>

</body>
</html>
