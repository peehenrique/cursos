<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="../../favicon.ico">

  <title><?php echo $titulo ?></title>

  <link rel="stylesheet" href="<?php echo base_url('/public/dist/bootstrap/dist/css/bootstrap.min.css'); ?>">

  <link rel="stylesheet" href="<?php echo base_url('/public/dist/font-awesome/css/font-awesome.min.css'); ?>">

  <link rel="stylesheet" href="<?php echo base_url('/public/css/loja.css'); ?>">

  <script type="text/javascript">
  var url_loja = "<?php echo base_url()?>";
  </script>

</head>

<body>

  <header>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url() ?>">Logo loja</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo base_url() ?>">Home <span class="sr-only"></span></a></li>

            <?php foreach ($categorias as $categoria):
              $sub_cat = $this->loja_model->getSubCategoria($categoria->id);
              ?>

              <?php if ($sub_cat){ ?>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $categoria->nome ?> <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <?php foreach ($sub_cat as $sub): ?>
                      <li><a href="<?php echo base_url('categoria/'. $sub->meta_link) ?>"><?php echo $sub->nome ?></a></li>
                    <?php endforeach; ?>
                  </ul>
                </li>
              <?php }else{ ?>
                <li><a href="<?php echo base_url('categoria/'. $categoria->meta_link) ?>"><?php echo $categoria->nome ?></a></li>
              <?php } ?>

            <?php endforeach; ?>

          </ul>
          <form class="navbar-form navbar-left" action="<?php echo base_url('busca') ?>" method="post">
            <div class="form-group">
              <input type="text" name="query_busca" id="query_busca" class="form-control" placeholder="Buscar produto">
            </div>
            <button type="submit" class="btn btn-default">Buscar produto</button>
          </form>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo base_url('listar-marcas') ?>">Listar marcas</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="total-carrinho-menu">
                  <?php echo $this->carrinhocompra->totalItem() ?>
                </span>
                Carrinho <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url('carrinho'); ?>">Ver carrinho</a></li>
                  <li><a href="javascript:void(0)" class="btn-limpar-carrinho">Limpar carrinho</a> </li>
                  <li role="separator" class="divider"></li>
                  <li><a href="<?php echo base_url('checkout'); ?>">Finalizar compra</a></li>
                </ul>
              </li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>

    <div class="row mt-3">

      <div class="container">

        <?php
        if (isset($view)) {
          $this->load->view($view);
        }
        ?>
      </div>

    </div>

    <footer>

    </footer>

    <!-- jQuery 3 -->
    <script src="<?php echo base_url('/public/js/jquery.min.js'); ?>"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url('/public/js/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>

    <script src="<?php echo base_url('/public/js/app_loja.js'); ?>"></script>

  </body>
  </html>
