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
                      <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">User List</button>
                    </div>
                  </nav>
                </div>  
              </div>

              <div class="row">
                <!-- Column start -->
                  <div class="col-12 col-sm-12 col-md-12">
				  <?php if(!empty($userList)) { ?>
                     <table class="table table-bordered item-code-table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
						  <th scope="col">Role</th>
						  <th scope="col">Status</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php foreach($userList as $row) { 
					  $status = $row['isActive'] == 1 ? 'Active' : 'Inactive';
					  ?>
                        <tr>
                          <td class="ps-1"><?php echo $row['userName']; ?></td>
                          <td class="ps-1"><?php echo $row['userEmail']; ?></td>
						  <td class="ps-1"><?php echo $row['userRole']; ?></td>
						  <td class="ps-1"><?php echo $status; ?></td>
                          <td>
							<a href="<?php echo base_url(); ?>user/edit-user/<?php echo $row['userID']; ?>" class="ms-1 me-2 text-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
	<?php if($row['userRole'] !== 'Super'){ ?>
		<a href="<?php echo base_url(); ?>user/permission/<?php echo $row['userID']; ?>" class="me-2 text-success"><i class="fa fa-key" aria-hidden="true"></i></a>
		<a href="<?php echo base_url(); ?>user/delete-user/<?php echo $row['userID']; ?>" class="me-2 text-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
	<?php } ?>
                          </td>
                        </tr>
					  <?php } ?>
                      </tbody>
                    </table>
				  <?php } ?>
                  </div>
                  <!-- Column close -->
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