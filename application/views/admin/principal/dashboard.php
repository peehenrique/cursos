<section>

  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?php echo $t_pedidos ?></h3>

          <p>Pedidos</p>
        </div>
        <div class="icon">
          <i class="fa fa-shopping-cart"></i>
        </div>
        <a href="<?php echo base_url('admin/pedidos') ?>" class="small-box-footer">Visualizar pedidos <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?php echo $t_clientes ?></h3>

          <p>Clientes</p>
        </div>
        <div class="icon">
          <i class="fa fa-user-circle-o"></i>
        </div>
        <a href="<?php echo base_url('admin/clientes') ?>" class="small-box-footer">Visualizar clientes <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?php echo $t_produtos; ?></h3>

          <p>Produtos</p>
        </div>
        <div class="icon">
          <i class="fa fa-cube"></i>
        </div>
        <a href="<?php echo base_url('admin/produtos') ?>" class="small-box-footer">Visualizar produtos <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?php echo $t_categorias ?></h3>

          <p>Categorias</p>
        </div>
        <div class="icon">
          <i class="fa fa-square"></i>
        </div>
        <a href="<?php echo base_url('admin/categorias') ?>" class="small-box-footer">Visualizar categorias <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
</section>


<div class="row">

  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Ultimos pedidos</h3>
      </div>
      <div class="box-body">

        <table class="table table-striped table_listar_data_table">
          <thead>
            <tr>
              <th scope="col">Nome</th>
              <th scope="col">Total Pedido</th>
              <th scope="col" class="text-center">Status</th>
            </tr>
          </thead>

          <tbody>
            <?php
            foreach ($pedidos as $row) {
              echo '<tr>';
              echo '<td>'. $row->nome .'</td>';
              echo '<td>'. formataMoedaReal($row->total_pedido) .'</td>';
              echo '<td>'. $row->titulo_status .'</td>';
              echo "</tr>";
            }
            ?>
          </tbody>

        </table>
      </div>
      <div class="box-footer">
        <a href="<?php echo base_url('admin/pedidos') ?>">Visualizar todos os pedidos <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Ultimos clientes cadastrados</h3>
      </div>
      <div class="box-body">


        <table class="table table-striped table_listar_data_table">
          <thead>
            <tr>
              <th scope="col">Nome</th>
              <th scope="col">Data Cadastro</th>
            </tr>
          </thead>

          <tbody>
            <?php
            foreach ($clientes as $row) {
              echo '<tr>';
              echo '<td>'. $row->nome .'</td>';
              echo '<td>'. formataDataView($row->data_cadastro) .'</td>';
              echo "</tr>";
            }
            ?>
          </tbody>

        </table>
      </div>
      <div class="box-footer">
        <a href="<?php echo base_url('admin/clientes') ?>">Visualizar todos os clientes <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>

</div>
