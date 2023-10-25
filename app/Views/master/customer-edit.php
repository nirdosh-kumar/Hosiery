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
					<li><a href="<?php echo base_url(); ?>master/add-customer" class="activelink">Add <img src="<?php echo base_url(); ?>public/assets/img/icons/add-icon.png" class="ps-2" alt="Add" /></a></li>
					
					<li><a href="<?php echo base_url(); ?>master/list-customer">View <img src="<?php echo base_url(); ?>public/assets/img/icons/viewall-icon.png" class="ps-2" alt="edit" /></a></li>
					<li><a href="javascript:void(0)">Edit <img src="<?php echo base_url(); ?>public/assets/img/icons/edit-icon.png" class="ps-2" alt="View" /></a></li>
					<li><a href="javascript:void(0)">Delete <img src="<?php echo base_url(); ?>public/assets/img/icons/delete-icon.png" class="ps-2" alt="Delete" /></a></li>
					<li><a href="javascript:void(0)">Zoom <img src="<?php echo base_url(); ?>public/assets/img/icons/zoom-icon.png" class="ps-2" alt="Zoom" /></a></li>
				</ul>
				</div>
			  </div>
			</div>

          <div class="page-mid">
              <div class="row">
                <div class="col-12 col-sm-12">
                  <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Customer</button>
                    </div>
                  </nav>

                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
<?php echo form_open('', ['id'=>'customerForm']); ?>
  <!-- Start -->
  <div class="row mb-4">
	<!-- Column 1 -->
	  <div class="col-12 col-sm-12 col-md-4">
		<div id="response"></div>
		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Customer Code<sup>*</sup></label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="code" id="code" maxlength="8" autocomplete="off" value="<?php echo $editRow['customer_code']; ?>" />
			  <div class="invalid-feedback" id="error_code"></div>
			</div>
		  </div>

		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Customer Name<sup>*</sup></label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="sname" id="sname" maxlength="60" autocomplete="off" value="<?php echo $editRow['customer_name']; ?>" />
			  <div class="invalid-feedback" id="error_sname"></div>
			</div>
		  </div>
			<?php /* <div class="row mb-2">
				<div class="col-sm-5">
				  <label class="col-form-label">Agent</label>
				</div>
				<div class="col-sm-7">
				  <select class="form-select js-example-basic-single" name="agent" id="agent">
					<option value="1">Yes</option>
					<option value="0">No</option>
				  </select>
				  <div class="invalid-feedback" id="error_agent"></div>
				</div>
			  </div> */ ?>
		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Fixed Discount %<sup>*</sup></label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="fixed" id="fixed" maxlength="8" autocomplete="off" value="<?php echo $editRow['fixed_discount_percentage']; ?>" />
			  <div class="invalid-feedback" id="error_fixed"></div>
			</div>
		  </div>
	  </div>
	  <!-- Column 1 -->

	  <!-- Column 2 -->
	  <div class="col-12 col-sm-12 col-md-4">
		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Payment Terms<sup>*</sup></label>
			</div>
			<div class="col-sm-7">
			  <select class="form-select js-example-basic-single" name="terms" id="terms">
				<option value="">----</option>
			  <?php if(!empty($pterms)) { 
			  foreach($pterms as $row){
			  ?>
			  <option value="<?php echo $row['codeID']; ?>" <?php if($editRow['payment_terms_ID']==$row['codeID']) echo 'selected'; ?>><?php echo $row['generalTitle']; ?></option>
			  <?php }
			  } ?>
			  </select>
			  <div class="invalid-feedback" id="error_terms"></div>
			</div>
		  </div>
		<div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">GST No</label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="gstno" id="gstno" maxlength="30" autocomplete="off" value="<?php echo $editRow['gst_no']; ?>" pattern="^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$" title="Invalid GST Number." />
			  <div class="invalid-feedback" id="error_gstno"></div>
			</div>
		  </div>
		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">VAT No</label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="vatno" id="vatno" maxlength="30" autocomplete="off" value="<?php echo $editRow['vat_no']; ?>" />
			  <div class="invalid-feedback" id="error_gstno"></div>
			</div>
		  </div>
	  </div>
	  <!-- Column 2 -->

	  <!-- Column 3 -->
	  <div class="col-12 col-sm-12 col-md-4">
		<div class="row mb-2">
		  <div class="col-sm-5">
			<label class="col-form-label">Sort Order 1</label>
		  </div>
		  <div class="col-sm-7">
			<input type="number" class="form-control" name="order1" id="order1" autocomplete="off" value="<?php echo $editRow['sort_order_1']; ?>" />
			<div class="invalid-feedback" id="error_order1"></div>
		  </div>
		</div>

		<div class="row mb-2">
		  <div class="col-sm-5">
			<label class="col-form-label">Sort Order 2</label>
		  </div>
		  <div class="col-sm-7">
			<input type="number" class="form-control" name="order2" id="order2" autocomplete="off" value="<?php echo $editRow['sort_order_2']; ?>" />
			<div class="invalid-feedback" id="error_order2"></div>
		  </div>
		</div>

		<div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Active Status<sup>*</sup></label>
			</div>
			<div class="col-sm-7">
			  <select class="form-select js-example-basic-single" name="publish" id="publish">
				<option value="1" <?php if($editRow['active_status']==1) echo 'selected'; ?>>Yes</option>
				<option value="0" <?php if($editRow['active_status']==0) echo 'selected'; ?>>No</option>
			  </select>
			  <div class="invalid-feedback" id="error_publish"></div>
			</div>
		  </div>
	  </div>
	  <!-- Column 3 -->
  </div>

  <div class="row mb-4">
	<!-- Column 1 -->
	  <div class="col-12 col-sm-12 col-md-4">
		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Address Line 1</label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="address1" id="address1" maxlength="150" autocomplete="off" value="<?php echo $editRow['address_line_1']; ?>" />
			  <div class="invalid-feedback" id="error_address1"></div>
			</div>
		  </div>

		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Address Line 2</label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="address2" id="address2" maxlength="150" autocomplete="off" value="<?php echo $editRow['address_line_2']; ?>" />
			  <div class="invalid-feedback" id="error_address2"></div>
			</div>
		  </div>

		   <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Address Line 3</label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="address3" id="address3" maxlength="150" autocomplete="off" value="<?php echo $editRow['address_line_3']; ?>" />
			  <div class="invalid-feedback" id="error_address3"></div>
			</div>
		  </div>
	  </div>
	  <!-- Column 1 -->

	  <!-- Column 2 -->
	  <div class="col-12 col-sm-12 col-md-4">
		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">City/Village/District</label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="city" id="city" maxlength="60" autocomplete="off" value="<?php echo $editRow['city_village_district']; ?>" />
			  <div class="invalid-feedback" id="error_city"></div>
			</div>
		  </div>

		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">State</label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="state" id="state" maxlength="60" autocomplete="off" value="<?php echo $editRow['state']; ?>" />
			   <div class="invalid-feedback" id="error_state"></div>
			</div>
		  </div>

		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Country</label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="country" id="country" maxlength="60" autocomplete="off" value="<?php echo $editRow['country']; ?>" />
			  <div class="invalid-feedback" id="error_country"></div>
			</div>
		  </div>

		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">PIN Code</label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="pin" id="pin" maxlength="30" autocomplete="off" value="<?php echo $editRow['pin_code']; ?>" />
			  <div class="invalid-feedback" id="error_pin"></div>
			</div>
		  </div>
	  </div>
	  <!-- Column 2 -->

	  <!-- Column 3 -->
	  <div class="col-12 col-sm-12 col-md-4">
		<div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Telephone 1</label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="phone1" id="phone1" maxlength="30" autocomplete="off" value="<?php echo $editRow['telephone_1']; ?>" />
			  <div class="invalid-feedback" id="error_phone1"></div>
			</div>
		  </div>

		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Telephone 2</label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="phone2" id="phone2" maxlength="30" autocomplete="off" value="<?php echo $editRow['telephone_2']; ?>" />
			  <div class="invalid-feedback" id="error_phone2"></div>
			</div>
		  </div>

		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Email 1</label>
			</div>
			<div class="col-sm-7">
			  <input type="email" class="form-control" name="email1" id="email1" maxlength="100" autocomplete="off" value="<?php echo $editRow['email_1']; ?>" />
			  <div class="invalid-feedback" id="error_email1"></div>
			</div>
		  </div>

		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Email 2</label>
			</div>
			<div class="col-sm-7">
			  <input type="email" class="form-control" name="email2" id="email2" maxlength="100" autocomplete="off" value="<?php echo $editRow['email_2']; ?>" />
			  <div class="invalid-feedback" id="error_email2"></div>
			</div>
		  </div>
	  </div>
	  <!-- Column 3 -->
  </div>

  <!-- Start -->
  <div class="row">
	  <div class="col-12 col-sm-12">
		<div class="row mb-2"><div class="col-sm-12">Attribute:</div></div>
	  </div>
	  <?php if(!empty($getAttribute)) { 
	  foreach($getAttribute as $k=>$row){
		  $attr = !empty($editAttr[$k]['attributeTitle']) ? $editAttr[$k]['attributeTitle'] : '';
	  ?>
	<!-- Column -->
	<div class="col-12 col-sm-12 col-md-4">
	  <div class="row mb-2">
		<div class="col-sm-5">
		  <label class="col-form-label"><?php echo $row['generalTitle']; ?></label>
		</div>
		<div class="col-sm-7">
		  <input type="text" class="form-control" name="attrb[]" id="attrb<?php echo $k; ?>" autocomplete="off" value="<?php echo $attr; ?>" />
		  <input type="hidden" name="attrcode[]" value="<?php echo $row['codeID']; ?>" />
		  <div class="invalid-feedback" id="error_attrb<?php echo $k; ?>"></div>
		</div>
	  </div>
	</div>
	<!-- Column -->
	  <?php }
	  } ?>
  </div>

	<hr/>

  <!-- Contact start -->
  <div class="row">
	<div class="col-12 col-sm-12">
	  <div class="page-subheading">
		<h2>Contact Details</h2>
	  </div>
	</div>

	<div class="col-12 col-sm-12">
	  <table class="table table-bordered">
		  <thead>
			<tr>
			  <th scope="col">Sr.</th>
			  <th scope="col">Name</th>
			  <th scope="col">Designation</th>
			  <th scope="col">Email</th>
			  <th scope="col">Mobile</th>
			  <th scope="col">Telephone</th>
			  <th scope="col">Action</th>
			</tr>
		  </thead>
		  <tbody id="tbody">
		  <?php 
		  $start = 0;
		  if(!empty($editContact)) {
				$x=1;
				$start = count($editContact);
		  foreach($editContact as $k=>$row){
		  ?>
			<tr id="del-<?php echo $k; ?>">
			  <td><?php echo $x; ?></td>
			  <td>
				<input type="text" class="form-control form-control1 text-center" name="cname[]" id="cname0" maxlength="60" autocomplete="off" value="<?php echo $row['contactName']; ?>" />
				<div class="invalid-feedback" id="error_cname0"></div>
			  </td>
			  <td>
				<input type="text" class="form-control form-control1 text-center" name="position[]" id="position0" maxlength="60" autocomplete="off" value="<?php echo $row['designation']; ?>" />
				<div class="invalid-feedback" id="error_position0"></div>
			</td>
			  <td>
				<input type="email" class="form-control form-control1 text-center" name="cemail[]" id="cemail0" maxlength="100" autocomplete="off" value="<?php echo $row['email']; ?>" />
				<div class="invalid-feedback" id="error_cemail0"></div>
			</td>
			  <td>
				<input type="number" class="form-control form-control1 text-center" name="cphone[]" id="cphone0" maxlength="30" autocomplete="off" value="<?php echo $row['mobile']; ?>" />
				<div class="invalid-feedback" id="error_cphone0"></div>
			</td>
			  <td>
				<input type="number" class="form-control form-control1 text-center" name="ctele[]" id="ctele0" maxlength="30" autocomplete="off" value="<?php echo $row['telephone']; ?>" />
				<div class="invalid-feedback" id="error_ctele0"></div>
				</td>
			  <td><?php if($k > 0) { ?>
				<a href="javascript:void(0);" id="<?php echo $k; ?>" class="text-danger remove"><i class="fa fa-trash" aria-hidden="true"></i></a>
			  <?php } ?></td>
			</tr>
		  <?php $x++; }
		  } ?>
		  </tbody>
	  </table>
	</div>
  </div><!-- Contact close -->

  <div class="row">
	<div class="col-12 col-sm-12">
	  <div class="form-save-btn">
		<button id="addBtn" type="button" class="btn btn-save bg-success">+ Add More</button> 
		<button type="submit" id="submitbtn" class="btn btn-save">Save</button>
	  </div>
	</div>
  </div>
  <!-- Close -->
  <?php echo form_close(); ?>
                    </div>

                    
                  </div>
                </div>
              </div>
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

/* $('.js-example-basic-single').select2({
	 placeholder: "",
    allowClear: true
}); */
$('#terms').select2({
	placeholder: "",
    allowClear: true,
	minimumInputLength: 2,
	ajax: {
		url: '<?php echo base_url(); ?>master/select2-generalcode/3',
		//type: 'post',
		dataType: 'json',
		delay: 250,
		data: function (params) {
			var query = {
				search: params.term,
				//type: 'public'
			  }

			  // Query parameters will be ?search=[term]&type=public
			  return query;
		},
		processResults: function (response) {
			return {
				results:response.result
			};
		},
		cache: true
	}
});
var rowIdx = <?php echo $start; ?>;
$("#addBtn").on('click', function(){
	let htm='';	
	htm='<tr id="del-'+rowIdx+'"><td>1</td><td><input type="text" class="form-control form-control1 text-center" name="cname[]" id="cname'+rowIdx+'" maxlength="60" autocomplete="off"><div class="invalid-feedback" id="error_cname'+rowIdx+'"></div></td><td><input type="text" class="form-control form-control1 text-center" name="position[]" id="position'+rowIdx+'" maxlength="60" autocomplete="off"><div class="invalid-feedback" id="error_position'+rowIdx+'"></div></td><td><input type="email" class="form-control form-control1 text-center" name="cemail[]" id="cemail'+rowIdx+'" maxlength="100" autocomplete="off"><div class="invalid-feedback" id="error_cemail'+rowIdx+'"></div></td><td><input type="number" class="form-control form-control1 text-center" name="cphone[]" id="cphone'+rowIdx+'" maxlength="30" autocomplete="off"><div class="invalid-feedback" id="error_cphone'+rowIdx+'"></div></td><td><input type="number" class="form-control form-control1 text-center" name="ctele[]" id="ctele'+rowIdx+'" maxlength="30" autocomplete="off"><div class="invalid-feedback" id="error_ctele0"></div></td><td><a href="javascript:void(0);" id="'+rowIdx+'" class="text-danger remove"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>';
	
	$("#tbody").append(htm);
	
	let x=2;
	$(".remove").each(function(){
		$("#del-"+rowIdx+" td:first").text(x)
		x++;
	});
	rowIdx++;
});
$("body").on('click', '.remove', function(){
	let id = $(this).attr('id');
	$("#del-"+id).remove();
	
	let x=2;
	$(".remove").each(function(){
		let id = $(this).attr('id');
		$("#del-"+id+" td:first").text(x)
		x++;
	});
});
$("#customerForm").submit(function(e){
	e.preventDefault();
	var form_data = new FormData(this);
	form_data.append('customerform', 'true');
	$.ajax({
		type: "POST",
		url: $("#customerForm").attr('action'),
		data: form_data,
		cache: false,
		contentType: false,
		processData: false,
		beforeSend:function(){
			$("#submitbtn").text("Please Wait...");
		},
		success:function(res){
			$("#submitbtn").text("Save");
			$('input[name="<?php echo csrf_token(); ?>"]').val(res.token);
			
			if(res.status == false) {
				if(res.post){
					$("#response").html("<div class='alert alert-danger' role='alert'>"+res.post+"</div>");
				}
				$("#customerForm .invalid-feedback").each(function(){
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
					   window.location.href="<?php echo base_url(); ?>master/list-customer";
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