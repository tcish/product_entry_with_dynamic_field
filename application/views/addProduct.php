<?php require_once "inc/header.php"; ?>
<div class="jumbotron m-0">
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-8 col-md-6 col-lg-5 offset-sm-2 offset-md-3 offset-lg-3">
        <div class="shadow-lg p-4">
          <h1 class="text-center mb-3 pb-1 custom__border text-info">Product Entry Form</h1>
          <form autocomplete="off" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label class="font-weight-bold" for="">Product Name:</label>
              <input type="text" class="form-control" name="productName" placeholder="Enter product name" value="<?php echo set_value("productName"); ?>">
              <?php
                echo form_error("productName", "<span class='text-danger font-weight-bold'>", "</span>");
                if($this->session->flashdata('propertyExist')){
                  echo $this->session->flashdata('propertyExist');
                  unset ($_SESSION["propertyExist"]);
                }

                if($this->session->flashdata('msg')){
                  echo $this->session->flashdata('msg');
                  unset ($_SESSION["msg"]);
                }
              ?>
            </div>
            <div class="form-group" id="dynamic_field">
              <div class="row mt-4" id="autoGenId_1">
                <div class="col-12 col-sm-8">
                <?php if(isset($propertyExist)) { echo $propertyExist; } ?>
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
            <button class="btn-block btn btn-outline-success">Submit</button>
            <a href="<?= base_url(); ?>Product" class="btn btn-outline-dark btn-block">Go Back</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once "inc/footer.php"; ?>