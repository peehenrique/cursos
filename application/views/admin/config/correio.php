<section class="content-header">
  <h1><?php echo $titulo; ?></h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url('admin'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?php echo $titulo; ?></li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Configuracoes Correio</h3>
      </div>
      <!-- form start -->
      <form role="form" method="post" action="<?php echo base_url('admin/config/correio'); ?>">

        <?php
        errosValidacao();
        getMsg('msgCadastro');

        ?>

        <div class="box-body">


          <div class="form-group">
            <label>CEP ORIGEM</label>
            <?php
            $attributes = array('id' => 'cep_origem', 'class' => 'form-control', 'required' => 'required');
            echo form_input('cep_origem', $query->cep_origem, $attributes);
            ?>
          </div>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</section>
