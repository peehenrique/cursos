<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $titulo; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('/public/dist/bootstrap/dist/css/bootstrap.min.css'); ?>">

</head>
<body>


  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1><?php echo $config->empresa ?></h1>
        <h5><?php echo $config->email ?> - <?php echo $config->telefone ?></h5>
      </div>
    </div>
    <hr>

    <?php
    $this->load->view($view);
    ?>
    <hr>
  </div>

  <!-- jQuery 3 -->
  <script src="<?php echo base_url('/public/js/jquery.min.js'); ?>"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url('/public/js/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>

</body>
</html>
