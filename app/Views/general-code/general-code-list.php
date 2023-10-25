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
					<li><a href="<?php echo base_url(); ?>general-code/add-general-code" class="">Add <img src="<?php echo base_url(); ?>public/assets/img/icons/add-icon.png" class="ps-2" alt="Add" /></a></li>
					<li><a href="<?php echo base_url(); ?>general-code/list-general-code" class="activelink">View <img src="<?php echo base_url(); ?>public/assets/img/icons/viewall-icon.png" class="ps-2" alt="edit" /></a></li>
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
                      <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">General Code List</button>
                    </div>
                  </nav>
                </div>  
              </div>

              <div class="row">
                <!-- Column start -->
                  <div class="col-12 col-sm-12 col-md-12">
<?php if(!empty($generalList)) { ?>
 <table id="datatable1" class="table table-bordered cell-border item-code-table table-hover" style="width:100%">
  <thead>
	<tr>
		<th>General Code Type</th>
	  <th scope="col">General Code</th>
	  <th scope="col">General Code Name</th>
	  <th scope="col">Sort Order 1</th>
	  <th scope="col">Sort Order 2</th>
	  <th scope="col">Action</th>
	</tr>
  </thead>
  <tbody>
  <?php foreach($generalList as $row) { 
  ?>
	<tr>
		<td><?php echo $row['typeTitle']; ?></td>
	  <td class="ps-1"><?php echo $row['generalCode']; ?></td>
	  <td class="ps-1"><?php echo $row['generalTitle']; ?></td>
	  <td class="ps-1"><?php echo $row['order1']; ?></td>
	   <td class="ps-1"><?php echo $row['order2']; ?></td>
	  <td>							
		<?php if(user_right('general-code/edit-general-code') == true){ ?>
		<a href="<?php echo base_url(); ?>general-code/edit-general-code/<?php echo $row['codeID']; ?>" class="ms-1 me-2 text-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
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
	$('#datatable, #datatable1, #datatable2').dataTable({
        /* No ordering applied by DataTables during initialisation */
        "order": []
    });
});
</script>
<?php 
echo $this->endSection(); 
?>	