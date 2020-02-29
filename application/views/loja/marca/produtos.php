
<div class="row mt-3">

  <?php foreach ($produtos as $produto): ?>
    <div class="col-md-3">
      <div class="thumbnail">
        <img src="<?php echo base_url('uploads/fotos_produtos/'. $produto->foto . '') ?>">
        <div class="caption">
          <h3><?php echo $produto->nome_produto ?></h3>
          <p><?php echo formataMoedaReal($produto->valor, 1) ?></p>
          <p><a href="<?php echo base_url('produto/' . $produto->meta_link .'') ?>" class="btn btn-primary" role="button">Ver produto</a> <a href="#" class="btn btn-default" role="button">Add carrinho</a></p>
        </div>
      </div>
    </div>

  <?php endforeach; ?>

</div>
