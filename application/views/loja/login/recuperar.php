<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">

      <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

      <?php
      echo "<pre>";
      print_r($user);
      echo "</pre>";
       ?>

      <form action="<?php echo base_url('login/recuperar'); ?>" method="post">
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Senha" name="senha">
          <input type="hidden" name="id_usuario" value="<?php echo $user->id ?>">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Salvar nova senha</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->

    </div>

  </div>

</div>
