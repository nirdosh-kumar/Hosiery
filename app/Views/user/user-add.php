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
<?php echo form_open_multipart('', ['id'=>'userForm']); ?>
<div class="row">
<div class="col-12 col-sm-12 mb-1">
  <nav>
	<div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
	  <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Add User</button>
	</div>
  </nav>
</div>  
</div>

<div class="row">
<!-- Column 1 -->
  <div class="col-12 col-sm-12 col-md-4">
	<div id="response"><?php //echo ROOTPATH; ?></div>
	  <div class="row mb-2">
		<div class="col-sm-5">
		  <label class="col-form-label">Name<sup>*</sup></label>
		</div>
		<div class="col-sm-7">
		  <input type="text" class="form-control" name="user" id="user" />
		  <div class="invalid-feedback" id="error_user"></div>
		</div>
	  </div>

	  <div class="row mb-2">
		<div class="col-sm-5">
		  <label class="col-form-label">Email Address<sup>*</sup></label>
		</div>
		<div class="col-sm-7">
		  <input type="email" class="form-control" name="email" id="email" />
		  <div class="invalid-feedback" id="error_email"></div>
		</div>
	  </div>

	  <div class="row mb-2">
		<div class="col-sm-5">
		  <label class="col-form-label">Position<sup>*</sup></label>
		</div>
		<div class="col-sm-7">
		  <select class="form-select" name="role" id="role">
			<option value="">----</option>
			<option value="Super">Super Admin</option>
			<option value="Admin">Admin</option>
			<option value="Employee">Employee</option>
		  </select>
		  <div class="invalid-feedback" id="error_role"></div>
		</div>
	  </div>
  </div>
  <!-- Column 1 -->

  <!-- Column 2 -->
  <div class="col-12 col-sm-12 col-md-4">
	  <div class="row mb-2">
		<div class="col-sm-5">
		  <label class="col-form-label">Password<sup>*</sup></label>
		</div>
		<div class="col-sm-7">
		  <input type="password" class="form-control" name="password" id="password" />
		  <div class="invalid-feedback" id="error_password"></div>
		</div>
	  </div>

	  <div class="row mb-2">
		<div class="col-sm-5">
		  <label class="col-form-label">Confirm Password<sup>*</sup></label>
		</div>
		<div class="col-sm-7">
		  <input type="text" class="form-control" name="confirm" id="confirm" />
		  <div class="invalid-feedback" id="error_confirm"></div>
		</div>
	  </div>

	  <div class="row mb-2">
		<div class="col-sm-5">
		  <label class="col-form-label">Image<sup>*</sup></label>
		</div>
		<div class="col-sm-7">
		  <input type="file" class="form-control" name="photo" id="photo" />
		  <div class="invalid-feedback" id="error_photo"></div>
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
<div class="col-12 col-sm-4">
  <div class="row mb-2">
	<div class="col-sm-5"></div>
	<div class="col-sm-7">
	  <div class="form-check">
		<input class="form-check-input" type="checkbox" value="1" name="isactive" id="isactive">
		<label class="form-check-label" for="isactive">
		  Active
		</label>
	  </div>
	</div>
  </div>
</div>

<div class="col-12 col-sm-4">
</div>

<div class="col-12 col-sm-4">
</div>
</div>

<div class="row">
<div class="col-12 col-sm-12">
  <div class="form-save-btn">
	<button type="submit" id="userbtn" class="btn btn-save">Submit</button>
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
<script>
	$("#userForm").submit(function(e){
		e.preventDefault();
		var form_data = new FormData(this);
		form_data.append('userform', 'true');
		$.ajax({
			type: "POST",
			url: $("#userForm").attr('action'),
			data: form_data,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend:function(){
				$("#userbtn").text("Please Wait...");
			},
			success:function(res){
				$("#userbtn").text("Submit");
				$('input[name="<?php echo csrf_token(); ?>"]').val(res.token);
				
				if(res.status == false) {
					if(res.post){
						$("#response").html("<div class='alert alert-danger' role='alert'>"+res.post+"</div>");
					}
					$("#userForm .invalid-feedback").each(function(){
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
					//location.reload();
					setTimeout(function(){
						   window.location.href="<?php echo base_url(); ?>user/list-user";
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