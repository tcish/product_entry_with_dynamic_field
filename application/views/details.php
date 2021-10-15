<?php require_once "inc/header.php"; ?>

<div class="container bg-light mt-5">
  <h3 class="pt-2 d-inline-block">Specification</h3>
  <a href="<?= base_url() ?>Product/" class="btn btn-success btn-sm mt-3 float-right">Go Back</a>
  <hr>
  <?php
    foreach ($getPname as $name) { ?>
      <h5 class="text-info p-2" style="background: rgba(55, 73, 187, .05);"><?= $name["name"] ?></h5>
<?php } ?>
  <div class="p-2" style="font-size: 1.1rem;">
    <?php
      foreach ($getProperty as $key) { ?>
        <span><?= $key["name"] ?></span>: <span><?= $key["property_value"] ?></span><br>
        <hr>
<?php } ?>
  </div>
</div>