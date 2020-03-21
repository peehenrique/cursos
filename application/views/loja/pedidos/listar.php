<div class="container">
  <div class="row">
    <div class="col-md-12">
      <p>Ola, <strong><?php echo $user->username ?></strong></p>

      <?php
      if ($pedidos) {
        echo "<pre>";
        print_r($pedidos);
        echo "</pre>";
      }

      ?>
    </div>

  </div>

</div>
