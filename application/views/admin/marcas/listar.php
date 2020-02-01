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
          <a href="<?php echo base_url('admin/marcas/modulo') ?>" class="btn btn-success">Nova Marca</a>
        </div>
      </div>

      <?php
      getMsg('msgCadastro');
      ?>

      <table class="table table-striped table_listar_data_table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Marca</th>
            <th scope="col" class="text-center">Status</th>
            <th scope="col" class="text-right">Opções</th>
          </tr>
        </thead>

        <tbody>
          <?php
          foreach ($marcas as $row) {
            echo '<tr>';
            echo '<td>'. $row->id .'</td>';
            echo '<td>'. $row->nome_marca .'</td>';
            echo '<td class="text-center">'. ($row->ativo == 1? '<span class="label label-success">Ativo</span>' : '<span class="label label-danger">Inativo</span>').'</td>';
            echo "<td class='text-right'>";
            echo '<a href="'. base_url('admin/marcas/modulo/'. $row->id).'" title="Editar" class="btn btn-primary" style="margin-right:5px"><i class="fa fa-pencil-square"></i></button>';
            echo '<a href="'. base_url('admin/marcas/del/'. $row->id).'" title="Apagar" class="btn btn-danger btn-apagar-registro"><i class="fa fa-trash-o"></i></button>';
            echo "</td>";
            echo "</tr>";
          }
          ?>
        </tbody>

      </table>

    </div>
  </div>
</section>
