<?php 
echo $this->extend('template/base'); 

echo $this->section('css');
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/lib/select2/dist/css/select2.min.css" />
<!-- remove this if you use Modernizr -->
<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
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
						<li><a href="<?php echo base_url(); ?>master/add-company" class="">Add <img src="<?php echo base_url(); ?>public/assets/img/icons/add-icon.png" class="ps-2" alt="Add" /></a></li>
						<li><a href="<?php echo base_url(); ?>master/list-company" class="">View <img src="<?php echo base_url(); ?>public/assets/img/icons/viewall-icon.png" class="ps-2" alt="edit" /></a></li>
						<li><a href="<?php echo current_url(); ?>" class="activelink">Edit <img src="<?php echo base_url(); ?>public/assets/img/icons/edit-icon.png" class="ps-2" alt="View" /></a></li>
						<li><a href="<?php echo base_url(); ?>master/delete-company/<?php echo $editRow['company_ID']; ?>" class="delete">Delete <img src="<?php echo base_url(); ?>public/assets/img/icons/delete-icon.png" class="ps-2" alt="Delete" /></a></li>
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
                      <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Company</button>
                    </div>
                  </nav>

                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
<?php echo form_open_multipart('', ['id'=>'companyForm']); ?>
  <!-- Start -->
  <div class="row">
	<!-- Column 1 -->
	  <div class="col-12 col-sm-12 col-md-4">
		<div id="response"></div>
		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Company Name<sup>*</sup></label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="company" id="company" value="<?php echo $editRow['company_name']; ?>" autocomplete="off" />
			  <div class="invalid-feedback" id="error_company"></div>
			</div>
		  </div>

		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Reg No</label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="regno" id="regno" value="<?php echo $editRow['reg_no']; ?>" autocomplete="off" />
			  <div class="invalid-feedback" id="error_regno"></div>
			</div>
		  </div>

		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Ownership</label>
			</div>
			<div class="col-sm-7">
			  <select class="form-select" name="owner" id="owner">
				<option value="">----</option>
				<?php if(!empty($ownership)) { 
				foreach($ownership as $row){
				?>
				<option value="<?php echo $row['codeID']; ?>" <?php if($editRow['ownership_ID'] == $row['codeID']) echo 'selected'; ?>><?php echo $row['generalTitle']; ?></option>
				<?php }
				} ?>
			  </select>
			  <div class="invalid-feedback" id="error_owner"></div>
			</div>
		  </div>

		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Currency<sup>*</sup></label>
			</div>
			<div class="col-sm-7">
			  <select class="form-select js-example-basic-single" name="currency" id="currency">
			  <option value="">----</option>
			  <?php if(!empty($getCurrency)) { 
			  foreach($getCurrency as $row){
			  ?>
				<option value="<?php echo $row['currency_ID']; ?>" <?php if($editRow['currency_ID'] == $row['currency_ID']) echo 'selected';?>><?php echo $row['currency_name']; ?></option>
			  <?php }
			  } ?>
			  </select>
			  <div class="invalid-feedback" id="error_currency"></div>
			</div>
		  </div>
	  </div>
	  <!-- Column 1 -->

	  <!-- Column 2 -->
	  <div class="col-12 col-sm-12 col-md-4">
		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">GST No</label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="gstno" id="gstno" value="<?php echo $editRow['gst_no']; ?>" pattern="^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$" title="Invalid GST Number." autocomplete="off" />
			  <div class="invalid-feedback" id="error_gstno"></div>
			</div>
		  </div>

		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">VAT No</label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="vatno" id="vatno" value="<?php echo $editRow['vat_no']; ?>" autocomplete="off" />
			  <div class="invalid-feedback" id="error_vatno"></div>
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
		<div class="row mb-2">
		  <div class="col-sm-5">
			<label class="col-form-label">Company Logo<sup>*</sup></label>
		  </div>
		  <div class="col-sm-7">
			<div class="logo-pic">
			  <div class="logopicture">
				<div class="imgdelete"></div>
				<?php if(!empty($editRow['logo'])) { ?>
					<img id="blah" src="<?php echo base_url(); ?>public/uploads/company/<?php echo $editRow['logo']; ?>" alt="your image" style="width:100%;" />
				<?php } ?>
			  </div>
			  <div class="uploadbtn">
				<input type="file" name="logo" id="imgInp" accept="image/*" class="inputfile inputfile-1 form-control" />
				<label for="imgInp"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose a file&hellip;</span></label>
				<div class="invalid-feedback" id="error_logo"></div>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	  <!-- Column 3 -->
  </div>

  <div class="row">
	<!-- Column 1 -->
	  <div class="col-12 col-sm-12 col-md-4">
		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Address Line 1</label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="address1" id="address1" value="<?php echo $editRow['address_line_1']; ?>" autocomplete="off" />
			  <div class="invalid-feedback" id="error_address1"></div>
			</div>
		  </div>

		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Address Line 2</label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="address2" id="address2" value="<?php echo $editRow['address_line_2']; ?>" autocomplete="off" />
			  <div class="invalid-feedback" id="error_address2"></div>
			</div>
		  </div>

		   <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Address Line 3</label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="address3" id="address3" value="<?php echo $editRow['address_line_3']; ?>" autocomplete="off" />
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
			  <input type="text" class="form-control" name="city" id="city" value="<?php echo $editRow['city_village_district']; ?>" autocomplete="off" />
			  <div class="invalid-feedback" id="error_city"></div>
			</div>
		  </div>

		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">State</label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="state" id="state" value="<?php echo $editRow['state']; ?>" autocomplete="off" />
			   <div class="invalid-feedback" id="error_state"></div>
			</div>
		  </div>

		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Country</label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="country" id="country" value="<?php echo $editRow['country']; ?>" autocomplete="off" />
			  <div class="invalid-feedback" id="error_country"></div>
			</div>
		  </div>

		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">PIN Code</label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="pin" id="pin" value="<?php echo $editRow['pin_code']; ?>" autocomplete="off" />
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
			  <input type="text" class="form-control" name="phone1" id="phone1" value="<?php echo $editRow['telephone_1']; ?>" autocomplete="off" />
			  <div class="invalid-feedback" id="error_phone1"></div>
			</div>
		  </div>

		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Telephone 2</label>
			</div>
			<div class="col-sm-7">
			  <input type="text" class="form-control" name="phone2" id="phone2" value="<?php echo $editRow['telephone_2']; ?>" autocomplete="off" />
			  <div class="invalid-feedback" id="error_phone2"></div>
			</div>
		  </div>

		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Email 1</label>
			</div>
			<div class="col-sm-7">
			  <input type="email" class="form-control" name="email1" id="email1" value="<?php echo $editRow['email_1']; ?>" autocomplete="off" />
			  <div class="invalid-feedback" id="error_email1"></div>
			</div>
		  </div>

		  <div class="row mb-2">
			<div class="col-sm-5">
			  <label class="col-form-label">Email 2</label>
			</div>
			<div class="col-sm-7">
			  <input type="email" class="form-control" name="email2" id="email2" value="<?php echo $editRow['email_2']; ?>" autocomplete="off" />
			  <div class="invalid-feedback" id="error_email2"></div>
			</div>
		  </div>
	  </div>
	  <!-- Column 3 -->
  </div>

  <!-- Start -->
  <div class="row">
	  <div class="col-12 col-sm-12">
	  <?php //_p($editAttr);?>
		<div class="row mb-2"><div class="col-sm-12">Attribute:</div></div>
	  </div>
	  <?php if(!empty($getAttribute)) { 
	  foreach($getAttribute as $k=>$row){
		$attr = !empty($editAttr[$k]['attribute_value']) ? $editAttr[$k]['attribute_value'] : '';
	  ?>
	<!-- Column -->
	<div class="col-12 col-sm-12 col-md-4">
	  <div class="row mb-2">
		<div class="col-sm-5">
		  <label class="col-form-label"><?php echo $row['generalTitle']; ?></label>
		</div>
		<div class="col-sm-7">
		  <input type="text" class="form-control" name="attrb[]" id="attrb<?php echo $k; ?>" value="<?php echo $attr; ?>" autocomplete="off" />
		  <input type="hidden" name="attrcode[]" value="<?php echo $row['codeID']; ?>" />
		  <div class="invalid-feedback" id="error_attrb<?php echo $k; ?>"></div>
		</div>
	  </div>
	</div>
	<!-- Column -->
	  <?php }
	  } ?>
  </div>

  <div class="row">
	<div class="col-12 col-sm-12">
	  <div class="form-save-btn">
		<button type="submit" id="companybtn" class="btn btn-save">submit</button>
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
//Custom choose file js
//'use strict';
;( function ( document, window, index )
{
  var inputs = document.querySelectorAll( '.inputfile' );
  Array.prototype.forEach.call( inputs, function( input )
  {
    var label  = input.nextElementSibling,
      labelVal = label.innerHTML;

    input.addEventListener( 'change', function( e )
    {
      var fileName = '';
      if( this.files && this.files.length > 1 )
        fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
      else
        fileName = e.target.value.split( '\\' ).pop();

      if( fileName )
        label.querySelector( 'span' ).innerHTML = fileName;
      else
        label.innerHTML = labelVal;
    });

    // Firefox bug fix
    input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
    input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
  });
}( document, window, 0 ));

//Custom choose file preview js
imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
}

/* $('.js-example-basic-single').select2({
	 placeholder: "",
    allowClear: true
}); */

$('body').on('click', '.delete', function(){
	var zz=confirm('Are you sure to delete this record');
	if(zz==false){
		return false;
	}
});
$('#owner').select2({
	placeholder: "",
    allowClear: true,
	minimumInputLength: 2,
	ajax: {
		url: '<?php echo base_url(); ?>master/select2-generalcode/2',
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
$('#currency').select2({
	placeholder: "",
    allowClear: true,
	minimumInputLength: 2,
	ajax: {
		url: '<?php echo base_url(); ?>master/select2-currency',
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
$("#companyForm").submit(function(e){
	e.preventDefault();
	var form_data = new FormData(this);
	form_data.append('companyform', 'true');
	$.ajax({
		type: "POST",
		url: $("#companyForm").attr('action'),
		data: form_data,
		cache: false,
		contentType: false,
		processData: false,
		beforeSend:function(){
			$("#companybtn").text("Please Wait...");
		},
		success:function(res){
			$("#companybtn").text("Submit");
			$('input[name="<?php echo csrf_token(); ?>"]').val(res.token);
			
			if(res.status == false) {
				if(res.post){
					$("#response").html("<div class='alert alert-danger' role='alert'>"+res.post+"</div>");
				}
				$("#companyForm .invalid-feedback").each(function(){
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
					   window.location.href="<?php echo base_url(); ?>master/list-company";
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