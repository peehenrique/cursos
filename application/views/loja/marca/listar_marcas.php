<div class="row">
  <div class="col-md-12">
    <ul>
      <?php foreach ($marcas as $marca): ?>
        <li> <a href="<?php echo base_url('marca/'.$marca->meta_link); ?>">
          <?php echo $marca->nome_marca ?></a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

</div>
