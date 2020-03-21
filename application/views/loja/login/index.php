<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">

      <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

      <form action="" method="post">
        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Senha" name="senha">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox" name="manter_conectado"> Lembre de mim
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Logar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->

      <a href="#">Esqueceu a senha</a><br>

    </div>

  </div>

</div>
