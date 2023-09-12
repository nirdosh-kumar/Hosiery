<?php 
echo $this->extend('template/base'); 

echo $this->section('css');
?>
<?php 
echo $this->endSection();

echo $this->section('content');
?>
    <section class="container-fluid page-content">
      <div class="row">
        <div class="col-12 col-sm-12">
           <div class="row">
			  <div class="col-12">
				<div id="sidebaricons" class="sidenav1">
				  <a href="<?php echo base_url(); ?>user/add-user" id="add">Add <img src="<?php echo base_url(); ?>public/assets/img/icons/add-icon.png" class="ps-2" alt="Add" /></a>
				  <a href="<?php echo base_url(); ?>user/list-user" id="edit">Edit <img src="<?php echo base_url(); ?>public/assets/img/icons/edit-icon.png" class="ps-2" alt="edit" /></a>
				  <a href="javascript:void(0)" id="previous">Prev <img src="<?php echo base_url(); ?>public/assets/img/icons/prev-icon.png" class="ps-2" alt="Previous" /></a>
				  <a href="javascript:void(0)" id="next">Next <img src="<?php echo base_url(); ?>public/assets/img/icons/next-icon.png" class="ps-2" alt="Next" /></a>
				  <a href="javascript:void(0)" id="print">Print <img src="<?php echo base_url(); ?>public/assets/img/icons/print-icon.png" class="ps-2" alt="Next" /></a>
				  <a href="javascript:void(0)" id="zoom">Zoom <img src="<?php echo base_url(); ?>public/assets/img/icons/zoom-icon.png" class="ps-2" alt="Next" /></a>
				  <a href="javascript:void(0)" id="viewall">View <img src="<?php echo base_url(); ?>public/assets/img/icons/viewall-icon.png" class="ps-2" alt="Next" /></a>
				  <a href="javascript:void(0)" id="filter">Filter <img src="<?php echo base_url(); ?>public/assets/img/icons/filter-icon.png" class="ps-2" alt="Next" /></a>
				  <a href="javascript:void(0)" id="save">Save <img src="<?php echo base_url(); ?>public/assets/img/icons/save-icon.png" class="ps-2" alt="Next" /></a>
				</div>
			  </div>
			</div>

          <div class="page-mid">
            <form>
              <div class="row">
                <div class="col-12 col-sm-12 mb-1">
                  <nav>
                    <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                      <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">User Permission</button>
                    </div>
                  </nav>
                </div>  
              </div>

              <div class="row">
                <div class="col-12 col-sm-12">
                  <div class="page-tab-sub-headings">
                    User Name : Pranav |  Email : pranav@cyberxel.in | Role : Admin
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12 col-sm-12 col-md-12">
                  <table class="table table-bordered item-code-table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Template</th>
                          <th scope="col">Sub Template</th>
                          <th scope="col">Permission</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="p-2">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1">
                              <label class="form-check-label bold" for="flexCheckDefault1">
                                Users
                              </label>
                            </div>
                          </td>
                          <td colspan="2" class="p-2">
                            <!-- Permissions start -->
                            <div class="border-bottom p-1 mb-1">
                              <div class="row">
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2">
                                    <label class="form-check-label bold" for="flexCheckDefault2">
                                      Users
                                    </label>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault3">
                                    <label class="form-check-label" for="flexCheckDefault3">
                                      View
                                    </label>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault4">
                                    <label class="form-check-label" for="flexCheckDefault4">
                                      Add
                                    </label>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                                    <label class="form-check-label" for="flexCheckDefault5">
                                      Edit
                                    </label>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">
                                      Permission
                                    </label>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault7">
                                    <label class="form-check-label" for="flexCheckDefault7">
                                      Delete
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- Permissions close -->

                            <!-- Permissions start -->
                            <div class="border-bottom p-1 mb-1">
                              <div class="row">
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault8">
                                    <label class="form-check-label bold" for="flexCheckDefault8">
                                      Users
                                    </label>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault9">
                                    <label class="form-check-label" for="flexCheckDefault9">
                                      View
                                    </label>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault10">
                                    <label class="form-check-label" for="flexCheckDefault110">
                                      Add
                                    </label>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault11">
                                    <label class="form-check-label" for="flexCheckDefault11">
                                      Edit
                                    </label>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault12">
                                    <label class="form-check-label" for="flexCheckDefault12">
                                      Permission
                                    </label>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault13">
                                    <label class="form-check-label" for="flexCheckDefault13">
                                      Delete
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- Permissions close -->

                          </td>
                        </tr>
                        <tr>
                          <td class="p-2">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault14" checked>
                              <label class="form-check-label bold" for="flexCheckDefault14">
                                Master
                              </label>
                            </div>
                          </td>
                          <td colspan="2" class="p-2">
                            <!-- Permissions start -->
                            <div class="border-bottom p-1 mb-1">
                              <div class="row">
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault15" checked>
                                    <label class="form-check-label bold" for="flexCheckDefault15">
                                      Category
                                    </label>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault16" checked>
                                    <label class="form-check-label" for="flexCheckDefault16">
                                      View
                                    </label>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault17" checked>
                                    <label class="form-check-label" for="flexCheckDefault17">
                                      Add
                                    </label>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault18" checked>
                                    <label class="form-check-label" for="flexCheckDefault18">
                                      Edit
                                    </label>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault19">
                                    <label class="form-check-label" for="flexCheckDefault19">
                                      Delete
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- Permissions close -->

                            <!-- Permissions start -->
                            <div class="border-bottom p-1 mb-1">
                              <div class="row">
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault20">
                                    <label class="form-check-label bold" for="flexCheckDefault20">
                                      Sub Category
                                    </label>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault21">
                                    <label class="form-check-label" for="flexCheckDefault21">
                                      View
                                    </label>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault22">
                                    <label class="form-check-label" for="flexCheckDefault22">
                                      Add
                                    </label>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault23">
                                    <label class="form-check-label" for="flexCheckDefault23">
                                      Edit
                                    </label>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault24">
                                    <label class="form-check-label" for="flexCheckDefault24">
                                      Delete
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- Permissions close -->

                            <!-- Permissions start -->
                            <div class="border-bottom p-1 mb-1">
                              <div class="row">
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault25">
                                    <label class="form-check-label bold" for="flexCheckDefault25">
                                      Sub Sub Category
                                    </label>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault26">
                                    <label class="form-check-label" for="flexCheckDefault26">
                                      View
                                    </label>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault27">
                                    <label class="form-check-label" for="flexCheckDefault27">
                                      Add
                                    </label>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault28">
                                    <label class="form-check-label" for="flexCheckDefault28">
                                      Edit
                                    </label>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault29">
                                    <label class="form-check-label" for="flexCheckDefault29">
                                      Delete
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- Permissions close -->
                          </td>
                        </tr>
                      </tbody>
                    </table>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
<?php
echo $this->endSection();

echo $this->section('js');
?>
<?php 
echo $this->endSection(); 
?>