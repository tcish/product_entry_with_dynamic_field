<?php
  require_once "inc/header.php";
  
  $arr = NULL;
  $arr_count = 0;
  foreach ($property as $value) {
    $arr[$arr_count]["id"] = $value["id"];
    $arr[$arr_count]["name"] = $value["name"];
    $arr[$arr_count]["property_value"] = $value["property_value"];
    $arr[$arr_count]["id"] = $value["id"];
    $arr[$arr_count]["product_id"] = $value["product_id"];
    $arr_count++;
  }
?>
<div class="jumbotron m-0">
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-8 col-md-6 col-lg-5 offset-sm-2 offset-md-3 offset-lg-3">
        <div class="shadow-lg p-4">
          <h1 class="text-center mb-3 pb-1 custom__border text-info">Product Update Form</h1>
          <form autocomplete="off" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label class="font-weight-bold" for="">Product Name:</label>
              <?php foreach ($updateFetch as $pName) { ?>
                <input type="text" class="form-control" name="productName" placeholder="Enter product name" value="<?= $pName["name"] ?>">
                <?php
                  echo form_error("productName", "<span class='text-danger font-weight-bold'>", "</span>");
                  if($this->session->flashdata('msg')){
                    echo $this->session->flashdata('msg');
                    unset ($_SESSION["msg"]);
                  }
                  if($this->session->flashdata('propertyExist')){
                    echo $this->session->flashdata('propertyExist');
                    unset ($_SESSION["propertyExist"]);
                  }
              } ?>
            </div>
            <div class="form-group" id="dynamic_field">
            <?php
              if ($arr == "") { ?>
                <div class="form-group" id="dynamic_field">
                  <div class="row mt-4" id="autoGenId_1">
                    <div class="col-12 col-sm-8">
                      <label class="font-weight-bold" for="">Product Property:</label>
                      <input type="text" class="form-control" name="pProperty[]" placeholder="Enter product property name" id="property">

                      <label class="font-weight-bold" for="">Property Value:</label>
                      <input type="text" class="form-control" name="pValue[]" placeholder="Enter Property Value" id="value">
                    </div>
                    <div class="col-12 col-sm-4" style="margin-top: 4rem;">
                      <button class="btn btn-outline-info mt-1" id="add_more">Add more</button>
                    </div>
                  </div>
                </div>
                <?php }else {
                  if(isset($propertyExist)) { echo "<span class='ml-5'>".$propertyExist."</span>"; }
                  $autoGenId = 1;
                  foreach ($arr as $show) { ?>
                  <div class="row">
                    <div class="col-12 col-sm-8">
                      <label class="font-weight-bold" for="">Product Property:</label>
                      <input type="text" class="form-control" name="pProperty[]" placeholder="Enter product property name" id="property" value="<?= $show["name"] ?>">
                      
                      <label class="font-weight-bold" for="">Property Value:</label>
                      <input type="text" class="form-control" name="pValue[]" placeholder="Enter Property Value" id="value" value="<?= $show["property_value"] ?>">
                    </div>
                    <?php
                      if ($autoGenId == 1) { ?>
                        <div class="col-12 col-sm-4" style="margin-top: 4rem;">
                          <button class="btn btn-outline-info" id="add_more">Add more</button>
                          <a class="btn btn-outline-danger mt-1" href="<?= base_url() ?>Product/delBeforeUpdate/<?= $show["id"]; ?>/<?= $show["product_id"] ?>">Remove</a>
                        </div>
                <?php }else { ?>
                        <div class="col-12 col-sm-4">
                          <a class="btn btn-outline-danger mt-5" href="<?= base_url() ?>Product/delBeforeUpdate/<?= $show["id"]; ?>/<?= $show["product_id"] ?>">Remove</a>
                        </div>
                <?php } ?>
                    <input type="hidden" name="arr_id[]" value="<?= $show["id"]; ?>">
                  </div>
        <?php $autoGenId++; } } ?>
            </div>
            <button class="btn-block btn btn-outline-success">Submit</button>
            <a href="<?= base_url(); ?>Product" class="btn btn-outline-dark btn-block">Go Back</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once "inc/footer.php"; ?>