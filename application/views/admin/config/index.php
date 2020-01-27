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
        <h3 class="box-title">Salvar configuracoes</h3>
      </div>
      <!-- form start -->
      <form role="form" method="post" action="<?php echo base_url('admin/config'); ?>">

        <?php
        errosValidacao();
        getMsg('msgCadastro');

        echo dataDiaDb();
        ?>

        <div class="box-body">
          <div class="form-group">
            <label>Titulo</label>
            <?php
            $attributes = array('class' => 'form-control', 'required' => '');
            echo form_input('titulo', $query->titulo, $attributes);
            ?>
          </div>
          <div class="form-group">
            <label>Nome da empresa</label>
            <?php
            $attributes = array('class' => 'form-control', 'required' => '');
            echo form_input('empresa', $query->empresa, $attributes);
            ?>
          </div>
          <div class="form-group">
            <label>CEP</label>
            <!-- <input type="text" class="form-control" name="cep" placeholder="CEP" required> -->
            <?php
            $attributes = array('class' => 'form-control', 'required' => '');
            echo form_input('cep', $query->cep, $attributes);
            ?>
          </div>
          <div class="form-group">
            <label>ENDERECO</label>
            <?php
            $attributes = array('class' => 'form-control', 'required' => '');
            echo form_input('endereco', $query->endereco, $attributes);
            ?>
          </div>
          <div class="form-group">
            <label>Bairro</label>
            <?php
            $attributes = array('class' => 'form-control', 'required' => '');
            echo form_input('bairro', $query->bairro, $attributes);
            ?>
          </div>
          <div class="form-group">
            <label>Cidade</label>
            <?php
            $attributes = array('class' => 'form-control', 'required' => '');
            echo form_input('cidade', $query->cidade, $attributes);
            ?>
          </div>
          <div class="form-group">
            <label>Complemento</label>
            <?php
            $attributes = array('class' => 'form-control', 'required' => '');
            echo form_input('complemento', $query->complemento, $attributes);
            ?>
          </div>
          <div class="form-group">
            <label>Estado</label>
            <?php
            $attributes = array('class' => 'form-control', 'required' => '');
            echo form_input('estado', $query->estado, $attributes);
            ?>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $query->email; ?>" required>
          </div>
          <div class="form-group">
            <label>Telefone</label>
            <?php
            $attributes = array('class' => 'form-control', 'required' => '');
            echo form_input('telefone', $query->telefone, $attributes);
            ?>
          </div>
          <div class="form-group">
            <label>Produtos em destaque</label>
            <?php
            $attributes = array('class' => 'form-control', 'required' => '');
            echo form_input('p_destaque', $query->p_destaque, $attributes);
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
