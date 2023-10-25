<?php 
echo $this->extend('template/base'); 
//_p($editRow,1);
echo $this->section('css');
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/lib/select2/dist/css/select2.min.css" />
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
						<li><a href="<?php echo base_url(); ?>product/add-category" class="">Add <img src="<?php echo base_url(); ?>public/assets/img/icons/add-icon.png" class="ps-2" alt="Add" /></a></li>
						<li><a href="<?php echo base_url(); ?>product/list-category" class="">View <img src="<?php echo base_url(); ?>public/assets/img/icons/viewall-icon.png" class="ps-2" alt="edit" /></a></li>
						<li><a href="<?php echo current_url(); ?>" class="activelink">Edit <img src="<?php echo base_url(); ?>public/assets/img/icons/edit-icon.png" class="ps-2" alt="View" /></a></li>
						<li><a href="<?php echo base_url(); ?>product/delete-category/<?php echo $editRow['product_category_ID']; ?>" class="delete">Delete <img src="<?php echo base_url(); ?>public/assets/img/icons/delete-icon.png" class="ps-2" alt="Delete" /></a></li>
						<li><a href="javascript:void(0)">Zoom <img src="<?php echo base_url(); ?>public/assets/img/icons/zoom-icon.png" class="ps-2" alt="Zoom" /></a></li>
					</ul>
				</div>
			  </div>
			</div>

<div class="page-mid">
<?php echo form_open('', ['id'=>'categoryForm']); ?>
  <div class="row">
	<div class="col-12 col-sm-12 mb-1">
	  <nav>
		<div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
		  <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Product Category</button>
		</div>
	  </nav>
	</div>  
  </div>

  <div class="row">
	<!-- Column 1 -->
	  <div class="col-12 col-sm-12 col-md-4">
	  <div id="response"></div>
		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Category Code <i class="fa fa-question-circle" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Product Category Code"></i><sup>*</sup></label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="code" id="code" maxlength="8" autocomplete="off" value="<?php echo $editRow['product_category_code']; ?>" />
			  <div class="invalid-feedback" id="error_code"></div>
			</div>
		  </div>

		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Category Name <i class="fa fa-question-circle" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Product Category Name"></i><sup>*</sup></label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="catname" id="catname" maxlength="60" autocomplete="off" value="<?php echo $editRow['product_category_name']; ?>" />
			  <div class="invalid-feedback" id="error_catname"></div>
			</div>
		  </div>
	  </div>
	  <!-- Column 1 -->

	  <!-- Column 2 -->
	  <div class="col-12 col-sm-12 col-md-4">
		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Sort Order 1<sup>*</sup></label>
			</div>
			<div class="col-sm-7">
			  <input type="number" class="form-control" name="order1" id="order1" autocomplete="off" value="9999" value="<?php echo $editRow['sort_order_1']; ?>" />
			  <div class="invalid-feedback" id="error_order1"></div>
			</div>
		  </div>

		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Sort Order 2<sup>*</sup></label>
			</div>
			<div class="col-sm-7">
			  <input type="number" class="form-control" name="order2" id="order2" autocomplete="off" value="9999" value="<?php echo $editRow['sort_order_2']; ?>" />
			  <div class="invalid-feedback" id="error_order2"></div>
			</div>
		  </div>
		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Active Status<sup>*</sup></label>
			</div>
			<div class="col-sm-7">
			  <select class="form-select js-example-basic-single" name="publish" id="publish">
				<option value="1" <?php if($editRow['active_status'] == 1) echo 'selected'; ?>>Yes</option>
				<option value="0" <?php if($editRow['active_status'] == 0) echo 'selected'; ?>>No</option>
			  </select>
			  <div class="invalid-feedback" id="error_publish"></div>
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
		<button type="submit" id="submitbtn" class="btn btn-save">Save</button>
	  </div>
	</div>
  </div>
<?php echo form_close(); ?>
</div>
        </div>
      </div>
    </section>
<?php
echo $this->endSection();

echo $this->section('js');
?>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>public/assets/lib/select2/dist/js/select2.min.js"></script>
<script>
$('body').on('click', '.delete', function(){
	var zz=confirm('Are you sure to delete this record');
	if(zz==false){
		return false;
	}
});
$('.js-example-basic-single').select2({
	placeholder: "",
    allowClear: true
});

$("#categoryForm").submit(function(e){
	e.preventDefault();
	var form_data = new FormData(this);
	form_data.append('categoryform', 'true');
	$.ajax({
		type: "POST",
		url: $("#categoryForm").attr('action'),
		data: form_data,
		cache: false,
		contentType: false,
		processData: false,
		beforeSend:function(){
			$("#submitbtn").text("Please Wait...");
		},
		success:function(res){
			$("#submitbtn").text("Submit");
			$('input[name="<?php echo csrf_token(); ?>"]').val(res.token);
			
			if(res.status == false) {
				if(res.post){
					$("#response").html("<div class='alert alert-danger' role='alert'>"+res.post+"</div>");
				}
				$("#categoryForm .invalid-feedback").each(function(){
					let idstr;
					var txt = $(this).attr('id').split("_");
					idstr = txt[1];
					console.log(idstr);
					$("#"+idstr).removeClass('is-valid');
					
					if(res.message[idstr] != "" & res.message[idstr] != undefined){
						$("#error_"+idstr).text(res.message[idstr]);
						$("#"+idstr).addClass('is-invalid');
						$( "input[name='"+idstr+"']" ).addClass('is-invalid');
					}else{
						$("#"+idstr).removeClass('is-invalid');
						$( "input[name='"+idstr+"']" ).removeClass('is-invalid');
						$("#error_"+idstr).text('');
					}
				});
			}
			if(res.status == true) {
				setTimeout(function(){
					   window.location.href="<?php echo base_url(); ?>product/list-category";
				  }, 1500);
			}
	},
	error:function(){
		$("#response").html("<div class='alert alert-danger' role='alert'><strong>Oops!</strong> Try that again in a few moments.</div>");
		}
	});
});
</script>
<?php 
echo $this->endSection(); 
?>	