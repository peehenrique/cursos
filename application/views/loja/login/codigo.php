<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">

      <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

      <form action="" method="post">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Codigo" name="codigo">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Recupear Codigo</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->

    </div>

  </div>

</div>
