<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">

      <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

      <form action="" method="post">
        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Recuperar Senha</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->

    </div>

  </div>

</div>
