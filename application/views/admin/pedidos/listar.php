<section class="content-header">
  <h1>
    <?php echo $titulo; ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url('admin'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?php echo $titulo; ?></li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <div class="row mb-2">
        <div class="col-md-12 text-left">
          <div class="btn-group">
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Relatório <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="#">Vendas diárias</a></li>
              <li><a href="#">Vendas por período</a></li>
              <li><a href="#">Produtos mais vendidos</a></li>
            </ul>
          </div>
        </div>
      </div>

      <?php
      getMsg('msgCadastro');
      ?>

      <table class="table table-striped table_listar_data_table">
        <thead>
          <tr>
            <th scope="col">Numero do pedido</th>
            <th scope="col">Nome do Cliente</th>
            <th scope="col">Total</th>
            <th scope="col" class="text-center">Status</th>
            <th scope="col" class="text-right">Opções</th>
          </tr>
        </thead>

        <tbody>

          <?php foreach ($pedidos as $pedido): ?>

            <tr>
              <td><?php echo $pedido->id; ?></td>
              <td><?php echo $pedido->nome; ?></td>
              <td><?php echo formataMoedaReal($pedido->total_pedido, 1); ?></td>
              <td><?php
              switch ($pedido->status) {
                case 1:
                echo "Aguardando Pagamento";
                break;
                case 2:
                echo "Pagamento confirmado";
                break;
                case 3:
                echo "Enviado";
                break;
                default:
                echo "Cancelado";
                break;
              }
              ?></td>
              <td class="text-right">
                <button class="btn btn-primary btn-mudar-status-pedido" data-toggle="modal" data-id-pedido="<?php echo $pedido->id; ?>">Mudar Status</button>
                <a href="<?php echo base_url('admin/pedidos/codigo_rastreio') ?>" class="btn btn-warning">Rastrear Pedido</a>
                <a href="<?php echo base_url('admin/pedidos/imprimir/'.$pedido->id.'') ?>" target="_blank" class="btn btn-success">Imprimir Pedido</a>
              </td>
            </tr>

          <?php endforeach; ?>

        </tbody>

      </table>

    </div>
  </div>
</section>


<div class="modal_dinamico">

</div>
