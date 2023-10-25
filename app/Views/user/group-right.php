<?php 
echo $this->extend('template/base'); 
$rightArr1=[
	'User'=>[
		'user/list-user'=>'View', 
		'user/add-user'=>'Add', 
		'user/edit-user'=>'Edit',	
		'user/delete-user'=>'Delete',
		],
	'Group'=>[
		'user/list-group'=>'View', 
		'user/add-group'=>'Add', 
		'user/edit-group'=>'Edit',
		'user/right-group'=>'Permission',	
		'user/delete-group'=>'Delete'
	],
];
$rightArr2=[
	'Company'=>[
		'master/list-company'=>'View', 
		'master/add-company'=>'Add', 
		'master/view-company'=>'Edit', 
		'master/delete-company'=>'Delete',
	],
	'Currency'=>[
		'master/list-currency'=>'View', 
		'master/add-currency'=>'Add', 
		'master/view-currency'=>'Edit', 
		'master/delete-currency'=>'Delete',
	],
	'General Codes Type'=>[
		'general-code/list-type'=>'View', 
		'general-code/add-type'=>'Add', 
		'general-code/edit-type'=>'Edit', 
		'general-code/delete-type'=>'Delete',
	],
	'General Codes'=>[
		'general-code/list-general-code'=>'View', 
		'general-code/add-general-code'=>'Add', 
		'general-code/edit-general-code'=>'Edit', 
		'general-code/delete-general-code'=>'Delete',
	],
	'Supplier'=>[
		'master/list-supplier'=>'View', 
		'master/add-supplier'=>'Add', 
		'master/edit-supplier'=>'Edit', 
		'master/delete-supplier'=>'Delete',
	],
	'Customer'=>[
		'master/list-customer'=>'View', 
		'master/add-customer'=>'Add', 
		'master/edit-customer'=>'Edit', 
		'master/delete-customer'=>'Delete',
	],
	'Size Set'=>[
		'master/list-sizeset'=>'View', 
		'master/add-sizeset'=>'Add', 
		'master/edit-sizeset'=>'Edit', 
		'master/delete-sizeset'=>'Delete',
	],
	'Product Category'=>[
		'product/list-category'=>'View', 
		'product/add-category'=>'Add', 
		'product/edit-category'=>'Edit', 
		'product/delete-category'=>'Delete',
	],
	'Product Type'=>[
		'product/list-type'=>'View', 
		'product/add-type'=>'Add', 
		'product/edit-type'=>'Edit', 
		'product/delete-type'=>'Delete',
	],
];

if($groupRow['groupTitle'] === 'Admin'){
	$rightArr = array_merge($rightArr1, $rightArr2);
}else{
	$rightArr = $rightArr2;
}

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
					<li><a href="<?php echo base_url(); ?>user/add-group" class="">Add <img src="<?php echo base_url(); ?>public/assets/img/icons/add-icon.png" class="ps-2" alt="Add" /></a></li>
					<li><a href="<?php echo base_url(); ?>user/list-group" class="">Edit <img src="<?php echo base_url(); ?>public/assets/img/icons/edit-icon.png" class="ps-2" alt="edit" /></a></li>
					<li><a href="<?php echo current_url(); ?>" class="activelink">View <img src="<?php echo base_url(); ?>public/assets/img/icons/viewall-icon.png" class="ps-2" alt="View" /></a></li>
					<li><a href="javascript:void(0)">Delete <img src="<?php echo base_url(); ?>public/assets/img/icons/delete-icon.png" class="ps-2" alt="Delete" /></a></li>
					<li><a href="javascript:void(0)">Zoom <img src="<?php echo base_url(); ?>public/assets/img/icons/zoom-icon.png" class="ps-2" alt="Zoom" /></a></li>
				</ul>
				</div>
			  </div>
			</div>

          <div class="page-mid">
<?php echo form_open('', ['id'=>'rightForm']); ?>
<div class="row">
<div class="col-12 col-sm-12 mb-1">
  <nav>
	<div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
	  <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Group Right</button>
	</div>
  </nav>
</div>  
</div>

<div class="row">
	<div class="col-12 col-sm-12 col-md-12">
	<div id="response"></div>
		<table class="table table-bordered item-code-table table-hover">
		  <thead>
			<tr>
			  <th scope="col">Template</th>
			  <th scope="col">Sub Template</th>
			  <th scope="col">Permission</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php foreach($rightArr as $template=>$templateArr) { 
		$pageclass = filter_clean($template);
	?>
			<tr>
			  <td class="p-2">
				<div class="form-check">
				  <input class="form-check-input" type="checkbox" name="page[]" value="<?php echo $template; ?>" id="<?php echo $pageclass; ?>" 
		<?php if(!empty($userTemplate)) {
			foreach($userTemplate as $tempval){
				if($tempval['pageHead'] == filter_clean($template)) { echo 'checked'; }
			}
		} ?>
		/>
				  <label class="form-check-label bold" for="<?php echo $pageclass; ?>">
					<?php echo $template; ?>
				  </label>
				</div>
			  </td>
			  <td colspan="2" class="p-2">
				<!-- Permissions start -->
				<?php if (count($templateArr) !== count($templateArr, COUNT_RECURSIVE)) { 
			foreach($templateArr as $subtemplate=>$rightArr){
				$subpageclass = filter_clean($subtemplate);
		?>
				<div class="border-bottom p-1 mb-1">
				  <div class="row">
					<div class="col-2">
					  <div class="form-check">
						<input type="checkbox" name="subpage[]" value="<?php echo $subtemplate;
					?>" class="form-check-input <?php echo $pageclass; ?>" id="<?php echo $subpageclass; ?>" 
		<?php if(!empty($usersubTemplate)) {
			foreach($usersubTemplate as $subtempval){
				if($subtempval['pagesubHead'] == filter_clean($subtemplate)) { echo 'checked'; }
			}
		} ?>
						/>
						<label class="form-check-label bold" for="<?php echo $subpageclass; ?>">
						  <?php echo $subtemplate; ?>
						</label>
					  </div>
					</div>
					<?php foreach($rightArr as $subkey=>$right) { ?>
					<div class="col-2">
					  <div class="form-check">
						<input type="checkbox" name="right[<?php echo $pageclass.'*-*'.$subpageclass; ?>][]" value="<?php echo $subkey; ?>" class="form-check-input <?php echo $pageclass; ?> <?php echo $subpageclass; ?>" 
						<?php 
		if(!empty($userRight)) {
			foreach($userRight as $rightval){
				if($rightval['urlSegment'] == $subkey) { echo 'checked'; }
			}
		}
						?>
						/>
						<label class="form-check-label" for="">
						  <?php echo $right; ?>
						</label>
					  </div>
					</div>
					<?php } ?>
				  </div>
				</div>
				<?php }
				}else{ ?> 
				<div class="border-bottom p-1 mb-1">
				  <div class="row">
					<?php /* <div class="col-2">
					  <div class="form-check">
						<label class="form-check-label bold" for="">
						  --
						</label>
					  </div>
					</div> */ ?>
					<?php foreach($templateArr as $key=>$right) { ?>
					<div class="col-2">
					  <div class="form-check">
						<input type="checkbox" name="right[<?php echo $pageclass; ?>][]" value="<?php echo $key; ?>" class="form-check-input <?php echo $pageclass; ?>" 
		<?php 
		if(!empty($userRight)) {
			foreach($userRight as $rightval){
				if($rightval['urlSegment'] == $key) { echo 'checked'; }
			}
		}
		?> />
						<label class="form-check-label" for="">
						  <?php echo $right; ?>
						</label>
					  </div>
					</div>
					<?php } ?>
				  </div>
				</div>
				<?php } ?>
				<!-- Permissions close -->

			  </td>
			</tr>
		  <?php  } ?>
		  </tbody>
		</table>
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
	$("input[name='page[]']").on('change', function(){
		var str = $(this).attr('id').toLowerCase();
		if($("#"+str).is(':checked') == true){
			$("."+str).prop('checked', true);
		}else{
			$("."+str).prop('checked', false);
		}
	});
	$("input[name='subpage[]']").on('change', function(){
		var strsub = $(this).attr('id').toLowerCase();
		if($("#"+strsub).is(':checked') == true){
			$("."+strsub).prop('checked', true);
		}else{
			$("."+strsub).prop('checked', false);
		}
	});
	$("#rightForm").submit(function(e){
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: $("#rightForm").attr('action'),
			data: $("#rightForm").serialize()+'&rightform=true',
			beforeSend:function(){
				$("#rightbtn").text("Please Wait...");
			},
			success:function(res){
				$("#rightbtn").text("Submit");
				$('input[name="<?php echo csrf_token(); ?>"]').val(res.token);
				
				if(res.status == false) {
					$("#response").html("<div class='alert alert-danger' role='alert'><strong>Oops!</strong> "+res.error+"</div>");
					$("html, body").animate({ scrollTop: 50 }, "slow");
				}
				
				if(res.status == true) {
					$("#response").html("<div class='alert alert-success' role='alert'>Permission has been set successfully</div>");
					
					/* setTimeout(function(){
						   window.location.href="<?php echo base_url(); ?>/users-list";
					  }, 1500); */
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