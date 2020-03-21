
<div class="row mt-3">

  <?php foreach ($destaques as $destaque): ?>
    <div class="col-md-3">
      <div class="thumbnail">
        <img src="<?php echo base_url('uploads/fotos_produtos/'. $destaque->foto . '') ?>">
        <div class="caption">
          <h3><?php echo $destaque->nome_produto ?></h3>
          <p><?php echo formataMoedaReal($destaque->valor, 1) ?></p>
          <p><a href="<?php echo base_url('produto/' . $destaque->meta_link .'') ?>" class="btn btn-primary" role="button">Ver produto</a>
            <a href="<?php echo base_url('carrinho/add/'. $destaque->id) ?>" class="btn btn-default" role="button">Add carrinho</a></p>
        </div>
      </div>
    </div>

  <?php endforeach; ?>

</div>
