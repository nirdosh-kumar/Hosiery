<?php 
echo $this->extend('template/base'); 

echo $this->section('css');
?>
<!-- Datatable -->
<link href="<?php echo base_url(); ?>public/assets/lib/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
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
				 <ul>
					<li><a href="<?php echo base_url(); ?>product/add-type" class="">Add <img src="<?php echo base_url(); ?>public/assets/img/icons/add-icon.png" class="ps-2" alt="Add" /></a></li>
					<li><a href="<?php echo base_url(); ?>product/list-type" class="activelink">View <img src="<?php echo base_url(); ?>public/assets/img/icons/viewall-icon.png" class="ps-2" alt="edit" /></a></li>
					<li><a href="javascript:void(0)">Edit <img src="<?php echo base_url(); ?>public/assets/img/icons/edit-icon.png" class="ps-2" alt="View" /></a></li>
					<li><a href="javascript:void(0)">Delete <img src="<?php echo base_url(); ?>public/assets/img/icons/delete-icon.png" class="ps-2" alt="Delete" /></a></li>
					<li><a href="javascript:void(0)">Zoom <img src="<?php echo base_url(); ?>public/assets/img/icons/zoom-icon.png" class="ps-2" alt="Zoom" /></a></li>
				</ul>
				</div>
			  </div>
			</div>

          <div class="page-mid">
              <div class="row">
                <div class="col-12 col-sm-12 mb-1">
                  <nav>
                    <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                      <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Product Type List</button>
                    </div>
                  </nav>
                </div>  
              </div>

              <div class="row">
                <!-- Column start -->
                  <div class="col-12 col-sm-12 col-md-12">
<?php if(!empty($typeList)) { ?>
 <table id="datatable1" class="table table-bordered cell-border item-code-table table-hover" style="width:100%">
  <thead>
	<tr>
		<th scope="col">Product Category</th>
	  <th scope="col">Product Type Code</th>
	  <th scope="col">Product Type Name</th>
	  <th scope="col">Created By</th>
	  <th scope="col">Action</th>
	</tr>
  </thead>
  <tbody>
  <?php foreach($typeList as $row) { 
  ?>
	<tr>
	  <td class="ps-1"><?php echo $row['product_category_name']; ?></td>
	  <td class="ps-1"><?php echo $row['product_type_code']; ?></td>
	   <td class="ps-1"><?php echo $row['product_type_name']; ?></td>
	  <td class="ps-1"><?php echo $row['userName']; ?></td>
	  <td>							
		<?php if(user_right('product/edit-type') == true){ ?>
		<a href="<?php echo base_url(); ?>product/edit-type/<?php echo $row['product_type_ID']; ?>" class="ms-1 me-2 text-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
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
          </div>
        </div>
      </div>
    </section>

<?php
echo $this->endSection();

echo $this->section('js');
?>
<!-- Datatable -->
<script src="<?php echo base_url(); ?>public/assets/lib/datatables/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
	new DataTable('#datatable, #datatable1, #datatable2');
});
</script>
<?php 
echo $this->endSection(); 
?>	