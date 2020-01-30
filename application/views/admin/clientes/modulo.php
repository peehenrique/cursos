<section class="content-header">
  <h1>
    <?php echo $titulo; ?>
  </h1>
  <ol class="breadcrumb">
    <?php
    if (isset($navegacao)) {
      echo '<li><a href="'. base_url($navegacao['link']). '">'. $navegacao['titulo'] .'</a></li>';
    }
    ?>
    <li class="active"><?php echo $titulo; ?></li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <div class="row mb-2">
        <div class="col-md-12 text-left">
          <a href="<?php echo base_url('admin/clientes'); ?>" class="btn btn-success"> <i class="fa fa-arrow-left"></i> Voltar</a>
        </div>
      </div>

      <form class="form-horizontal" action="<?php echo base_url('admin/clientes/core'); ?>" method="post">

        <?php
        errosValidacao();
        getMsg('msgCadastro');
        ?>

        <div class="form-group">
          <label class="col-sm-2 control-label">Nome</label>
          <div class="col-sm-7">
            <input type="text" name="nome" class="form-control" placeholder="Nome*" value="<?php echo ( $dados != NULL ? $dados->nome : set_value('nome')); ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">CPF</label>
          <div class="col-sm-7">
            <input type="text" name="cpf" id="cpf" class="form-control" placeholder="CPF" value="<?php echo ( $dados != NULL ? $dados->cpf : set_value('cpf')); ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Telefone</label>
          <div class="col-sm-7">
            <input type="text" name="telefone" id="telefone" class="form-control" placeholder="Telefone" value="<?php echo ( $dados != NULL ? $dados->telefone : set_value('telefone')); ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Data de nascimento</label>
          <div class="col-sm-7">
            <input type="text" name="data_nascimento" id="data_nascimento" class="form-control" placeholder="Data de nascimento" value="<?php echo ( $dados != NULL ? date('d-m-Y', strtotime($dados->data_nascimento)) : set_value('data_nascimento')); ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Email</label>
          <div class="col-sm-7">
            <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo ( $dados != NULL ? $dados->email : set_value('email')); ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Senha</label>
          <div class="col-sm-4">
            <input type="password" name="senha" class="form-control" value="" placeholder="Senha">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Status Usuario</label>
          <div class="col-sm-4">
            <select class="form-control" name="ativo">
              <?php if($dados) { ?>
                <option value="0" <?= ($dados->ativo == 0 ? 'selected="selected"' : '') ?>>Inativo</option>
                <option value="1" <?= ($dados->ativo == 1 ? 'selected="selected"' : '') ?>>Ativo</option>
              <?php } else{ ?>
                <option value="0" >Inativo</option>
                <option value="1" selected="selected">Ativo</option>
              <?php } ?>
            </select>
          </div>
        </div>


        <?php if ($dados) { ?>
          <input type="hidden" name="id_cliente" value="<?= $dados->id; ?>">
        <?php  }  ?>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Salvar</button>
          </div>
        </div>

      </form>

    </div>
  </div>
</section>
