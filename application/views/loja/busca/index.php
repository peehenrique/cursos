<div class="row">
  <div class="col-md-12">
    <h4><?php echo $titulo . ' [ ' . $this->input->post('query_busca') . ' ]' ?></h4>
    <ul>
      <?php foreach ($produtos as $produto): ?>
        <li> <a href="<?php echo base_url('produto/'.$produto->meta_link); ?>">
          <?php echo $produto->nome_produto ?></a>
        </li>
      <?php endforeach; ?>

    </ul>
  </div>

</div>
