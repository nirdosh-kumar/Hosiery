<?php 
echo $this->extend('template/base'); 
//_p($sizesList,1);
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
						<li><a href="<?php echo base_url(); ?>master/add-sizeset" class="">Add <img src="<?php echo base_url(); ?>public/assets/img/icons/add-icon.png" class="ps-2" alt="Add" /></a></li>
						<li><a href="<?php echo base_url(); ?>master/list-sizeset" class="">View <img src="<?php echo base_url(); ?>public/assets/img/icons/viewall-icon.png" class="ps-2" alt="edit" /></a></li>
						<li><a href="<?php echo current_url(); ?>" class="activelink">Edit <img src="<?php echo base_url(); ?>public/assets/img/icons/edit-icon.png" class="ps-2" alt="View" /></a></li>
						<li><a href="<?php echo base_url(); ?>master/delete-sizeset/<?php echo $editRow['size_set_ID']; ?>" class="delete">Delete <img src="<?php echo base_url(); ?>public/assets/img/icons/delete-icon.png" class="ps-2" alt="Delete" /></a></li>
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
		  <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Size Set</button>
		</div>
	  </nav>
	</div>  
</div>
<?php echo form_open('', ['id'=>'sizesetForm']); ?>
<div class="row">
	<div class="col-12 col-sm-12 col-md-4">
	  <div class="row mb-1">
		<div class="col-sm-3">
		  <label class="col-form-label">Size Set<sup>*</sup></label>
		</div>
		<div class="col-sm-6">
		  <input type="text" class="form-control" name="sizeset" id="sizeset" maxlength="30" autocomplete="off" value="<?php echo $editRow['size_set_name']; ?>" />
		  <div class="invalid-feedback" id="error_sizeset"></div>
		</div>
	  </div>

	  <div class="row mb-1">
		<div class="col-sm-3">
		  <label class="col-form-label">Size<sup>*</sup></label>
		</div>
		<div class="col-sm-6">
		  <select class="js-example-basic-multiple form-select" name="multisize[]" id="multisize" multiple="multiple">
			<option value="26">26</option>
			<?php if(!empty($getCode)) { 
			foreach($getCode as $row){
			?>
			<option value="<?php echo $row['codeID']; ?>"
			<?php 
			foreach($sizesList as $val){
					if($val['size_ID'] == $row['codeID']) echo 'selected';
				}
			?>
			><?php echo $row['generalTitle']; ?></option>
			<?php }
			} ?>
		  </select>
		  <div class="invalid-feedback" id="error_multisize"></div>
		</div>
		<div class="col-sm-3">
		  
		</div>
	  </div>

	  <div class="row">
		<div class="col-sm-3">
		</div>
		
		<div class="col-12 col-sm-6">
		  
		</div>

		<div class="col-12 col-sm-3">
		 
		</div>
	  </div>
	</div>

	<div class="col-12 col-sm-12 col-md-4">
	</div>

	<div class="col-12 col-sm-12 col-md-4">
	</div>
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
$('.js-example-basic-multiple').select2();
$('body').on('click', '.delete', function(){
	var zz=confirm('Are you sure to delete this record');
	if(zz==false){
		return false;
	}
});
$("#sizesetForm").submit(function(e){
	e.preventDefault();
	var form_data = new FormData(this);
	form_data.append('sizesetform', 'true');
	$.ajax({
		type: "POST",
		url: $("#sizesetForm").attr('action'),
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
				$("#sizesetForm .invalid-feedback").each(function(){
					let idstr;
					var txt = $(this).attr('id').split("_");
					idstr = txt[1];
					//console.log(idstr);
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
				//location.reload();
				setTimeout(function(){
					   window.location.href="<?php echo base_url(); ?>master/list-sizeset";
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