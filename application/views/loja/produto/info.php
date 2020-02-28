<div class="container">
  <div class="row">

    <div class="col-md-6">

      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

        <div class="carousel-inner" role="listbox">

          <?php
          $c = 0;
          foreach ($fotos as $foto){ ?>
            <div class="item <?= ($c == 0 ? 'active' : '') ?>">
              <img src="<?php echo base_url('uploads/fotos_produtos/'. $foto->foto . '') ?>" class="img-responsive">
            </div>
            <?php
            $c++;
          } ?>

          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

      </div>
    </div>

    <div class="col-md-6">
      <h1><?php echo $produto->nome_produto; ?></h1>
      <h3><?php echo formataMoedaReal($produto->valor, 1) ?></h3>
      <a href="<?php echo base_url('marca/' . $produto->marca_meta_link) ?>">Marca: <?php echo $produto->nome_marca ?></a>
      <p>Codigo do produto: <?php echo $produto->cod_produto ?></p>
      <a href="<?php echo base_url('categoria/'.$produto->categoria_meta_link) ?>">Categoria: <?php echo $produto->nome_categoria ?></a>
      <?php if ($produto->controlar_estoque == 1): ?>
        <p>Quantidade estoque: <?php echo $produto->estoque ?></p>
      <?php endif; ?>
      <a href="#" class="btn btn-danger">COMPRAR PRODUTO</a>

      <hr>
      <form class="form-inline">
        <div class="form-group">
          <input type="tel" class="form-control" id="cep-calculo-produto" placeholder="SEU CEP AQUI">
        </div>
        <button type="button" class="btn btn-success btn-calcular-frete-produto">CALCULAR FRETE</button>
      </form>
    </div>

  </div>

  <div class="row">
    <div class="col-md-12">
      <h4>Informacoes do produto</h4>
      <?php echo $produto->informacao ?>
    </div>
  </div>

</div>
