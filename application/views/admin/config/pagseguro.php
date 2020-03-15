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
        <h3 class="box-title">Configuracoes PagSeguro</h3>
      </div>
      <!-- form start -->
      <form role="form" method="post" action="<?php echo base_url('admin/config/pagseguro'); ?>">

        <?php
        errosValidacao();
        getMsg('msgCadastro');

        ?>

        <div class="box-body">

          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $query->email; ?>" required="required">
          </div>
          <div class="form-group">
            <label>Token</label>
            <?php
            $attributes = array('class' => 'form-control', 'required' => 'required');
            echo form_input('token', $query->token, $attributes);
            ?>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Boleto</label>
            <div class="col-sm-4">
              <select class="form-control" name="boleto">
                  <option value="0" <?= ($query->boleto == 0 ? 'selected="selected"' : '') ?>>Nao</option>
                  <option value="1" <?= ($query->boleto == 1 ? 'selected="selected"' : '') ?>>Sim</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Cartao de Credito</label>
            <div class="col-sm-4">
              <select class="form-control" name="cartao">
                  <option value="0" <?= ($query->cartao == 0 ? 'selected="selected"' : '') ?>>Nao</option>
                  <option value="1" <?= ($query->cartao == 1 ? 'selected="selected"' : '') ?>>Sim</option>
              </select>
            </div>
          </div>

          <br><br>

          <div class="form-group">
            <label class="col-sm-2 control-label">Transferencia Bancaria</label>
            <div class="col-sm-4">
              <select class="form-control" name="transferencia">
                  <option value="0" <?= ($query->transferencia == 0 ? 'selected="selected"' : '') ?>>Nao</option>
                  <option value="1" <?= ($query->transferencia == 1 ? 'selected="selected"' : '') ?>>Sim</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Ambiente</label>
            <div class="col-sm-4">
              <select class="form-control" name="ambiente">
                  <option value="1" <?= ($query->ambiente == 1 ? 'selected="selected"' : '') ?>>Sandbox (Teste)</option>
                  <option value="2" <?= ($query->ambiente == 2 ? 'selected="selected"' : '') ?>>Produção (Real)</option>
              </select>
            </div>
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
