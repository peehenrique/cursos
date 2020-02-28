<section class="full-banner">

  <div class="row">

    <div class="container">
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img src="https://placeimg.com/1280/480/any" >
          </div>
          <div class="item">
            <img src="https://placeimg.com/1280/480/any" >
          </div>
          <div class="item">
            <img src="https://placeimg.com/1280/480/any" >
          </div>
        </div>

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

</section>

<div class="row mt-3">

  <?php foreach ($destaques as $destaque): ?>
    <div class="col-md-3">
      <div class="thumbnail">
        <img src="<?php echo base_url('uploads/fotos_produtos/'. $destaque->foto . '') ?>">
        <div class="caption">
          <h3><?php echo $destaque->nome_produto ?></h3>
          <p><?php echo formataMoedaReal($destaque->valor, 1) ?></p>
          <p><a href="<?php echo base_url('produto/' . $destaque->meta_link .'') ?>" class="btn btn-primary" role="button">Ver produto</a> <a href="#" class="btn btn-default" role="button">Add carrinho</a></p>
        </div>
      </div>
    </div>

  <?php endforeach; ?>

</div>
