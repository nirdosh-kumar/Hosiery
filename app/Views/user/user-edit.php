<?php 
echo $this->extend('template/base'); 

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
						<li><a href="<?php echo base_url(); ?>user/add-user" class="">Add <img src="<?php echo base_url(); ?>public/assets/img/icons/add-icon.png" class="ps-2" alt="Add" /></a></li>
						<li><a href="<?php echo base_url(); ?>user/list-user" class="">View <img src="<?php echo base_url(); ?>public/assets/img/icons/viewall-icon.png" class="ps-2" alt="edit" /></a></li>
						<li><a href="<?php echo current_url(); ?>" class="activelink">Edit <img src="<?php echo base_url(); ?>public/assets/img/icons/edit-icon.png" class="ps-2" alt="View" /></a></li>
						<li><a href="<?php echo base_url(); ?>user/delete-user/<?php echo $editRow['userID']; ?>" class="delete">Delete <img src="<?php echo base_url(); ?>public/assets/img/icons/delete-icon.png" class="ps-2" alt="Delete" /></a></li>
						<li><a href="javascript:void(0)">Zoom <img src="<?php echo base_url(); ?>public/assets/img/icons/zoom-icon.png" class="ps-2" alt="Zoom" /></a></li>
					</ul>
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
	<div id="response"><?php //_p($editRow); ?></div>
	  <div class="row mb-2">
		<div class="col-sm-5">
		  <label class="col-form-label">Name<sup>*</sup></label>
		</div>
		<div class="col-sm-7">
		  <input type="text" class="form-control" name="user" id="user" value="<?php echo $editRow['userName']; ?>" autocomplete="off" />
		  <div class="invalid-feedback" id="error_user"></div>
		</div>
	  </div>

	  <div class="row mb-2">
		<div class="col-sm-5">
		  <label class="col-form-label">Email Address<sup>*</sup></label>
		</div>
		<div class="col-sm-7">
		  <input type="email" class="form-control" name="email" id="email" value="<?php echo $editRow['userEmail']; ?>" autocomplete="off" />
		  <div class="invalid-feedback" id="error_email"></div>
		</div>
	  </div>

	  <div class="row mb-2">
		<div class="col-sm-5">
		  <label class="col-form-label">Group<sup>*</sup></label>
		</div>
		<div class="col-sm-7">
		  <select class="form-select js-example-basic-multiple" multiple="multiple" name="role[]" id="role">
			<?php if(!empty($groupList)) {
			foreach($groupList as $row){
				$groupArr = explode(',', $editRow['groupID']);
				?>
				<option value="<?php echo $row['groupID']; ?>" 
				<?php 
				foreach($groupArr as $val){
					if($val == $row['groupID']) echo 'selected';
				}
				?>
				><?php echo $row['groupTitle']; ?></option>
				<?php
			}
		}
			?>
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
		  <label class="col-form-label">Password</label>
		</div>
		<div class="col-sm-7">
		  <input type="password" class="form-control" name="password" id="password" />
		  <div class="invalid-feedback" id="error_password"></div>
		</div>
	  </div>

	  <div class="row mb-2">
		<div class="col-sm-5">
		  <label class="col-form-label">Confirm Password</label>
		</div>
		<div class="col-sm-7">
		  <input type="password" class="form-control" name="confirm" id="confirm" />
		  <div class="invalid-feedback" id="error_confirm"></div>
		</div>
	  </div>

	  <?php /* <div class="row mb-2">
		<div class="col-sm-5">
		  <label class="col-form-label">Image<sup>*</sup></label>
		</div>
		<div class="col-sm-7">
		  <input type="file" class="form-control" name="photo" id="photo" />
		  <div class="invalid-feedback" id="error_photo"></div>
		  <?php if(!empty($editRow['userImage'])){ ?>
		  <a target="_new" href="<?php echo base_url(); ?>public/uploads/user/<?php echo $editRow['userImage']; ?>"></a>
		  <?php } ?>
		</div>
	  </div> */ ?>
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
		<input class="form-check-input" type="checkbox" value="1" name="isactive" id="isactive" <?php if($editRow['isActive'] == 1) echo 'checked';?>>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>public/assets/lib/select2/dist/js/select2.min.js"></script>
<script>
$('body').on('click', '.delete', function(){
	var zz=confirm('Are you sure to delete this record');
	if(zz==false){
		return false;
	}
});
$('.js-example-basic-multiple').select2();

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