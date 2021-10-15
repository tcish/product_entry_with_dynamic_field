<?php require_once "inc/header.php"; ?>
<div class="jumbotron m-0 vh-100">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1 class="float-left font-weight-bold">Products</h1>
        <a href="<?php echo base_url(); ?>Product/insertPage" class="btn btn-outline-info float-right">Add Product</a>
        <table class="customTable mt-5 text-center table-responsive-xl w-100 table-info" id="show">
          <?php
            if ($productName) {
          ?>
            <tr class="text-info">
              <th>Product Name</th>
              <th>Description</th>
              <th>Edit Delete</th>
            </tr>
          <?php
            foreach ($productName as $key) { ?>
              <tr>
                <td><?= $key["name"] ?></td>
                <td><a href="<?= base_url()?>Product/detailPage/<?= $key["id"] ?>" class="btn btn-primary btn-sm">Details</a></td>
                <td>
                  <a href='<?= base_url() ?>Product/updatePage/<?= $key["id"] ?>' class='btn btn-outline-primary btn-sm'>Edit</a>
                  <a href='<?= base_url() ?>Product/deleteProduct/<?= $key["id"] ?>' class='btn btn-outline-danger btn-sm'>Delete</a>
                </td>
              </tr>
      <?php }
          }else {
            echo "<td colspan='3'><h2>Nothing add yet!</h2></td>";
          }
        ?>
        </table>
      </div>
    </div>
  </div>
</div>
<?php require_once "inc/footer.php"; ?>