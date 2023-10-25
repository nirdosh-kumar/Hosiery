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
				<ul>
					<li><a href="<?php echo base_url(); ?>user/add-group" class="activelink">Add <img src="<?php echo base_url(); ?>public/assets/img/icons/add-icon.png" class="ps-2" alt="Add" /></a></li>
					<li><a href="<?php echo base_url(); ?>user/list-group">View <img src="<?php echo base_url(); ?>public/assets/img/icons/viewall-icon.png" class="ps-2" alt="edit" /></a></li>
					<li><a href="javascript:void(0)">Edit <img src="<?php echo base_url(); ?>public/assets/img/icons/edit-icon.png" class="ps-2" alt="View" /></a></li>
					<li><a href="javascript:void(0)">Delete <img src="<?php echo base_url(); ?>public/assets/img/icons/delete-icon.png" class="ps-2" alt="Delete" /></a></li>
					<li><a href="javascript:void(0)">Zoom <img src="<?php echo base_url(); ?>public/assets/img/icons/zoom-icon.png" class="ps-2" alt="Zoom" /></a></li>
				</ul>
				
				</div>
			  </div>
			</div>

          <div class="page-mid">
<?php echo form_open('', ['id'=>'groupForm']); ?>
<div class="row">
<div class="col-12 col-sm-12 mb-1">
  <nav>
	<div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
	  <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Add Group</button>
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
		  <label class="col-form-label">Name<sup>*</sup></label>
		</div>
		<div class="col-sm-7">
		  <input type="text" class="form-control" name="title" id="title" autocomplete="off" />
		  <div class="invalid-feedback" id="error_title"></div>
		</div>
	  </div>
  </div>
</div>

<div class="row">
	<div class="col-12 col-sm-4">
	</div>

	<div class="col-12 col-sm-4">
	</div>
</div>
			  
<div class="row">
<div class="col-12 col-sm-12">
  <div class="form-save-btn">
	<button type="submit" id="groupbtn" class="btn btn-save">Submit</button>
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
	$("#groupForm").submit(function(e){
		e.preventDefault();
		var form_data = new FormData(this);
		form_data.append('groupform', 'true');
		$.ajax({
			type: "POST",
			url: $("#groupForm").attr('action'),
			data: form_data,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend:function(){
				$("#groupbtn").text("Please Wait...");
			},
			success:function(res){
				$("#groupbtn").text("Submit");
				$('input[name="<?php echo csrf_token(); ?>"]').val(res.token);
				
				if(res.status == false) {
					if(res.post){
						$("#response").html("<div class='alert alert-danger' role='alert'>"+res.post+"</div>");
					}
					$("#groupForm .invalid-feedback").each(function(){
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
						   window.location.href="<?php echo base_url(); ?>user/list-group";
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