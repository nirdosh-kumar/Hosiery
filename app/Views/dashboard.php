<?php 
echo $this->extend('template/base'); 

echo $this->section('css');
?>
<?php 
echo $this->endSection();

echo $this->section('content');
?>
   <?php /* <section class="container-fluid page-content">
      <div class="row">
        <div class="col-12 col-sm-12">
		  <?php echo $this->include('template/lefticons'); ?>

          <div class="page-mid">
            <form>
              <div class="row">
                <div class="col-12 col-sm-12 mb-1">
                  <nav>
                    <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                      <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">General Codes</button>
                    </div>
                  </nav>
                </div>  
              </div>

              <div class="row">
                <!-- Column 1 -->
                  <div class="col-12 col-sm-12 col-md-4">
                      <div class="row mb-2">
                        <div class="col-sm-5">
                          <label class="col-form-label">General Code Type<sup>*</sup></label>
                        </div>
                        <div class="col-sm-7">
                          <select class="form-select">
                            <option selected="">General Code Type 1</option>
                            <option value="1">General Code Type 2</option>
                            <option value="2">General Code Type 3</option>
                          </select>
                        </div>
                      </div>

                      <div class="row mb-2">
                        <div class="col-sm-5">
                          <label class="col-form-label">General Code<sup>*</sup></label>
                        </div>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="general-code" />
                        </div>
                      </div>

                      <div class="row mb-2">
                        <div class="col-sm-5">
                          <label class="col-form-label">General Code Name<sup>*</sup></label>
                        </div>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="general-code-name" />
                        </div>
                      </div>

                      <div class="row mb-2">
                        <div class="col-sm-5">
                          <label class="col-form-label">General Code Desc.<sup>*</sup></label>
                        </div>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="general-code-desc" />
                        </div>
                      </div>
                  </div>
                  <!-- Column 1 -->

                  <!-- Column 2 -->
                  <div class="col-12 col-sm-12 col-md-4">
                      <div class="row mb-2">
                        <div class="col-sm-5">
                          <label class="col-form-label">Sort Order 1</label>
                        </div>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="sort-order1" />
                        </div>
                      </div>

                      <div class="row mb-2">
                        <div class="col-sm-5">
                          <label class="col-form-label">Sort Order 2</label>
                        </div>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" id="sort-order2" />
                        </div>
                      </div>

                      <div class="row mb-2">
                        <div class="col-sm-5">
                          <label class="col-form-label">Active Status<sup>*</sup></label>
                        </div>
                        <div class="col-sm-7">
                          <select class="form-select">
                            <option selected="">Yes</option>
                            <option value="1">No</option>
                          </select>
                        </div>
                      </div>
                  </div>
                  <!-- Column 2 -->

                  <!-- Column 3 -->
                  <div class="col-12 col-sm-12 col-md-4">

                  </div>
                  <!-- Column 3 -->
              </div>

              <div class="row">
                <div class="col-12 col-sm-12">
                  <div class="form-save-btn">
                    <button type="submit" class="btn btn-save">Save</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section> */ ?>
	<div class="dashboard-bg"></div>
<?php
echo $this->endSection();

echo $this->section('js');
?>
<?php 
echo $this->endSection(); 
?>	