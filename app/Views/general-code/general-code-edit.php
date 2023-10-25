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
					<li><a href="<?php echo base_url(); ?>general-code/add-general-code" class="">Add <img src="<?php echo base_url(); ?>public/assets/img/icons/add-icon.png" class="ps-2" alt="Add" /></a></li>
					<li><a href="<?php echo base_url(); ?>general-code/list-general-code" class="">View <img src="<?php echo base_url(); ?>public/assets/img/icons/viewall-icon.png" class="ps-2" alt="edit" /></a></li>
					<li><a href="<?php echo current_url(); ?>" class="activelink">Edit <img src="<?php echo base_url(); ?>public/assets/img/icons/edit-icon.png" class="ps-2" alt="View" /></a></li>
					<li><a href="<?php echo base_url(); ?>general-code/delete-general-code/<?php echo $editRow['codeID']; ?>" class="delete">Delete <img src="<?php echo base_url(); ?>public/assets/img/icons/delete-icon.png" class="ps-2" alt="Delete" /></a></li>
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
		  <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">General Codes</button>
		</div>
	  </nav>
	</div>  
</div>
<?php echo form_open('', ['id'=>'generalForm']); ?>
<div class="row">
<!-- Column 1 -->
<div class="col-12 col-sm-12 col-md-4">
	<div id="response"><?php //_p($editRow);?></div>
  <div class="row mb-2">
	<div class="col-sm-5">
	  <label class="col-form-label">General Code Type<sup>*</sup></label>
	</div>
	<div class="col-sm-7">
	  <select class="form-select" name="general" id="general">
	  <option value="">----</option>
	  <?php if(!empty($getType)) { 
		foreach($getType as $row){
	  ?>
		<option value="<?php echo $row['typeID']; ?>" <?php if($editRow['typeID'] == $row['typeID']) echo 'selected';?>><?php echo $row['typeTitle']; ?></option>
	  <?php }
	  } ?>
	  </select>
	  <input type="hidden" name="oldgeneral" value="<?php echo $editRow['typeID']; ?>"/>
	  <div class="invalid-feedback" id="error_general"></div>
	</div>
  </div>

  <div class="row mb-2">
	<div class="col-sm-5">
	  <label class="col-form-label">General Code<sup>*</sup></label>
	</div>
	<div class="col-sm-7">
	  <input type="text" class="form-control" name="code" id="code" value="<?php echo $editRow['generalCode']; ?>" autocomplete="off" />
	  <input type="hidden" name="oldcode" value="<?php echo $editRow['generalCode']; ?>"/>
	  <div class="invalid-feedback" id="error_code"></div>
	</div>
  </div>

  <div class="row mb-2">
	<div class="col-sm-5">
	  <label class="col-form-label">General Code Name<sup>*</sup></label>
	</div>
	<div class="col-sm-7">
	  <input type="text" class="form-control" name="title" id="title" value="<?php echo $editRow['generalTitle']; ?>" autocomplete="off" />
	  <div class="invalid-feedback" id="error_title"></div>
	</div>
  </div>

  <div class="row mb-2">
	<div class="col-sm-5">
	  <label class="col-form-label">General Code Desc.<sup>*</sup></label>
	</div>
	<div class="col-sm-7">
	  <input type="text" class="form-control" name="msg" id="msg" value="<?php echo $editRow['generalDes']; ?>" autocomplete="off" />
	  <div class="invalid-feedback" id="error_msg"></div>
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
	  <input type="number" class="form-control" name="order1" id="order1" value="<?php echo $editRow['order1']; ?>" autocomplete="off" />
	  <div class="invalid-feedback" id="error_order1"></div>
	</div>
  </div>

  <div class="row mb-2">
	<div class="col-sm-5">
	  <label class="col-form-label">Sort Order 2</label>
	</div>
	<div class="col-sm-7">
	  <input type="number" class="form-control" name="order2" id="order2" value="<?php echo $editRow['order2']; ?>" autocomplete="off" />
	  <div class="invalid-feedback" id="error_order2"></div>
	</div>
  </div>

  <div class="row mb-2">
	<div class="col-sm-5">
	  <label class="col-form-label">Active Status<sup>*</sup></label>
	</div>
	<div class="col-sm-7">
	  <select class="form-select" name="publish" id="publish">
		<option value="1" <?php if($editRow['isPublish'] == 1) echo 'selected';?>>Yes</option>
		<option value="0" <?php if($editRow['isPublish'] == 0) echo 'selected';?>>No</option>
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
		<button type="submit" id="generalbtn" class="btn btn-save">Submit</button>
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
$('body').on('click', '.delete', function(){
	var zz=confirm('Are you sure to delete this record');
	if(zz==false){
		return false;
	}
});
$("#generalForm").submit(function(e){
	e.preventDefault();
	var form_data = new FormData(this);
	form_data.append('generalform', 'true');
	$.ajax({
		type: "POST",
		url: $("#generalForm").attr('action'),
		data: form_data,
		cache: false,
		contentType: false,
		processData: false,
		beforeSend:function(){
			$("#generalbtn").text("Please Wait...");
		},
		success:function(res){
			$("#generalbtn").text("Submit");
			$('input[name="<?php echo csrf_token(); ?>"]').val(res.token);
			
			if(res.status == false) {
				if(res.post){
					$("#response").html("<div class='alert alert-danger' role='alert'>"+res.post+"</div>");
				}
				$("#generalForm .invalid-feedback").each(function(){
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
					   window.location.href="<?php echo base_url(); ?>general-code/list-general-code";
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