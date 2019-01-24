
 <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<?php //echo '<pre>';print_r($hospital_details);exit; ?>
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Add Medicine </div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Add Medicine</li>
            </ol>
         </div>
      </div>
	  <div class="row">	
			<div class="col-md-12">
	<div class="card ">
		<div class="card-head">
			<header>Add Medicine</header>
			</div>
			
		<form method="post" id="add_medicine" action="<?php echo base_url('medicine/exelupload'); ?>" enctype="multipart/form-data">
		<div class="row" style="padding:20px;">
			<div class="col-md-5">
			<label>Upload excel file</label>
				<div>
					<input class="form-control" type="file" name="uploadfile" id="uploadfile">
				</div>
			</div>
			<div class="col-md-3">
			<label>Click Here to Upload</label>
			<div>
				<input class="btn btn-primary btn-sm" type="submit" name="upload" value="Upload" >
			</div>
			</div>
		</form>
		<div class="col-md-3">
		<label>Downlaod</label>
			<div>
		<a href="<?php echo base_url('assets/med.xlsx'); ?>">Download  sample  File</a>
		</div>
		</div>
		</div>
	
		<div class="card-body">
		<div class="row">
			<div class="col-md-1">
			  <div class="form-group">
				<label >HSN</label>
			  </div>
			</div>
			<div class="col-md-1">
			  <div class="form-group">
					<label >MFR</label>
			  </div>
			</div>
			<div class="col-md-1">
			  <div class="form-group">
					<label >Batch No</label>
			  </div>
			</div>
			<div class="col-md-1">
			  <div class="form-group">
					<label >Medicine Name</label>
			  </div>
			</div>
			<div class="col-md-1">
			  <div class="form-group">
					<label >Medicine Type</label>
			  </div>
			</div>
			<div class="col-md-1">
			  <div class="form-group">
					<label>Expiry Date</label>
			  </div>
			</div>
			<div class="col-md-1">
			  <div class="form-group">
					<label >Medicine Dosage</label>
			  </div>
			</div>
			<div class="col-md-1">
			  <div class="form-group">
					<label >Qty</label>
			  </div>
			</div>
			<div class="col-md-1">
			  <div class="form-group">
					<label >Rate</label>
			  </div>
			</div>
			<div class="col-md-1">
			  <div class="form-group">
					<label >SGST</label>
			  </div>
			</div>
			<div class="col-md-1">
			  <div class="form-group">
					<label >CGST</label>
			  </div>
			</div>
			
			<div class="col-md-1">
			  <div class="form-group">
					<label >MRP</label>
			  </div>
			</div>
			
			</div>
			<form id="addmedicines" name="addmedicines" action="<?php echo base_url('medicine/addpost'); ?>" method="post" enctype="multipart/form-data">

			<div class="input_fields_wrap">
			<div class="row">
			<div class="col-md-1">
			  <div class="form-group">
				<input type="text" id="hsn[]" name="addmedicn[0][hsn]" class="form-control hero-demo"  placeholder="HSN">
			  </div>
			</div>
			<div class="col-md-1">
			  <div class="form-group">
				<input type="text" id="othercode" name="addmedicn[0][othercode]" class="form-control hero-demo"  placeholder="MFR">
			  </div>
			</div>
			<div class="col-md-1">
			  <div class="form-group">
				<input type="text" id="batchno" name="addmedicn[0][batchno]" class="form-control hero-demo"  placeholder="Batch No">
			  </div>
			</div>
			<div class="col-md-1">
			  <div class="form-group">
				<input type="text" id="medicins" name="addmedicn[0][medicine]" class="form-control searchingmedicine"  placeholder="Medicine Name">
			  </div>
			</div>
			<div class="col-md-1">
			  <div class="form-group">
				<input type="text" id="medicins" name="addmedicn[0][medicine_type]" class="form-control searchingmedicine"  placeholder="Medicine Type">
			  </div>
			</div>
			<div class="col-md-1">
			  <div class="form-group">
				<input type="text" id="medicins" name="addmedicn[0][expiry_date]" class="form-control searchingmedicine"  placeholder="Expiry Date">
			  </div>
			</div>
			<div class="col-md-1">
			  <div class="form-group">
				<input type="text" id="medicins" name="addmedicn[0][dosage]" class="form-control searchingmedicine"  placeholder="Medicine dosage">
			  </div>
			</div>
			<div class="col-md-1">
			  <div class="form-group">
				<input type="text" id="qty"  name="addmedicn[0][qty]" class="form-control hero-demo"  placeholder="QTY">
			  </div>
			</div>
			<div class="col-md-1">
			  <div class="form-group">
				<input type="text"  id="amount0" onkeyup="amount_count('0',this.value);" name="addmedicn[0][amount]" class="form-control hero-demo"  placeholder="Amount">
			  </div>
			</div>
			<div class="col-md-1">
			  <div class="form-group">
				<input type="text" id="sgst0" onkeyup="amount_count('0',this.value);" name="addmedicn[0][sgst]" class="form-control hero-demo"  placeholder="SGST">
			  </div>
			</div>
			<div class="col-md-1">
			  <div class="form-group">
				<input type="text" id="cgst0" onkeyup="amount_count('0',this.value);" name="addmedicn[0][cgst]" class="form-control hero-demo" placeholder="CGST">
			  </div>
			</div>
			
			<div class="col-md-1">
			  <div class="form-group">
				<input type="text" id="total0" readonly="true" name="addmedicn[0][total]" class="form-control hero-demo"  placeholder="Total">
			  </div>
			</div>
			
			</div>

			</div>
		
			<a class="add_field_button btn btn-primary">Add More Medicine</a>
			<a id="remobing" class="remove_field btn btn-warning">Remove</a>
			<button class="btn btn-success"  type="submit">Submit</button>
			</form>
			
		</div>
</div>
	  </div>
	
   
   </div>
</div>
<script>
$(document).ready(function(){

	load_data();

	function load_data()
	{
		$.ajax({
			url:"<?php echo base_url('medicine/fetch'); ?>",
			method:"POST",
			success:function(data){
				$('#customer_data').html(data);
			}
		})
	}

	$('#import_form').on('submit', function(event){
		event.preventDefault();
		$.ajax({
			url:"<?php echo base_url('medicine/import'); ?>",
			method:"POST",
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			success:function(data){
				$('#file').val('');
				load_data();
				alert(data);
			}
		})
	});

	
	

});
</script>

<script>

function  amount_count(id,val){
	
	var amount=$('#amount'+id).val();
	var cgst=$('#sgst'+id).val();
	var sgst=$('#cgst'+id).val();
	if(amount!='' && cgst!='' && sgst!=''){
		
		var perc= (parseInt(cgst)+parseInt(sgst));
		var percent_amount= ((amount)*(perc))/100;
		var amt= (parseInt(percent_amount)+parseInt(amount));
		$('#total'+id).val(amt);
		
	}else{
		$('#total'+id).val('');
	}
	
	//alert(val);
}

   $(document).ready(function() {
    var max_fields      = 15; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    var availableAttributes = [<?php echo $medicine_lists; ?>];
    
    
    
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
		   $(wrapper).append("<div id='addr"+x+"' class='row'><div class='col-md-1'><div class='form-group'><input type='text' id='hsn[]' name='addmedicn["+x+"][hsn]' class='form-control'  placeholder='HSN'></div></div><div class='col-md-1'><div class='form-group'><input type='text' id='othercode' name='addmedicn["+x+"][othercode]' class='form-control'  placeholder='MFR'></div></div><div class='col-md-1'><div class='form-group'><input type='text' id='batchno[]' name='addmedicn["+x+"][batchno]' class='form-control'  placeholder='Batch No'></div></div><div class='col-md-1'><div class='form-group'><input type='text' id='autocomplete' name='addmedicn["+x+"][medicine]' class='form-control searchng'  placeholder='Medicine Name'></div></div><div class='col-md-1'><div class='form-group'><input type='text' id='autocomplete' name='addmedicn["+x+"][medicine_type]' class='form-control searchng'  placeholder='Medicine Type'></div></div><div class='col-md-1'><div class='form-group'><input type='text' id='autocomplete' name='addmedicn["+x+"][expiry_date]' class='form-control searchng'  placeholder='Expiry Date'></div></div><div class='col-md-1'><div class='form-group'><input type='text' id='autocomplete' name='addmedicn["+x+"][dosage]' class='form-control searchng'  placeholder='Medicine dosage'></div></div><div class='col-md-1'><div class='form-group'><input type='text' pattern='[0-9]' id='qty' name='addmedicn["+x+"][qty]' class='form-control'  placeholder='QTY' required></div></div>   <div class='col-md-1'><div class='form-group'><input type='text' onkeyup=amount_count("+x+",this.value);  id='amount"+x+"' pattern='[0-9]' name='addmedicn["+x+"][amount]' class='form-control'  placeholder='Amount'></div></div>    <div class='col-md-1'><div class='form-group'><input type='text' onkeyup=amount_count("+x+",this.value);  id='sgst"+x+"' name='addmedicn["+x+"][sgst]' class='form-control hero-demo'  placeholder='SGST'></div></div><div class='col-md-1'><div class='form-group'><input type='text' onkeyup=amount_count("+x+",this.value); id='cgst"+x+"' name='addmedicn["+x+"][cgst]' class='form-control' placeholder='CGST'></div></div><div class='col-md-1'><div class='form-group'><input type='text' id='total"+x+"' name='addmedicn["+x+"][total]' value='' class='form-control '  placeholder='total'></div></div></div>"); 
            
            $(wrapper).find('.searchng').autocomplete({
                source: availableAttributes
            });	
        }
    });
     $('#remobing').click(function(e){
        e.preventDefault();
		$('div#addr'+x).remove(); x--;
		})
  
    $(".searchingmedicine").autocomplete({
		source: availableAttributes
	});	
    
});

$(document).ready(function() {
 
    $('#addmedicines').bootstrapValidator({
		 framework: 'bootstrap',
		fields: {
          
             'addmedicn[0][hsn]': {
                 validators: {
					notEmpty: {
						message: 'HSN is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'HSN can only consist of alphanumeric, space and dot'
					}
				}
            },
			'addmedicn[0][othercode]': {
                 validators: {
					notEmpty: {
						message: 'MFR is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'MFR can only consist of alphanumeric, space and dot'
					}
				}
            },
			'addmedicn[0][batchno]': {
                 validators: {
					notEmpty: {
						message: 'Batch No is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Batch No can only consist of alphanumeric, space and dot'
					}
				}
            },
			'addmedicn[0][medicine]': {
                 validators: {
					notEmpty: {
						message: 'Medicine Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Medicine Name can only consist of alphanumeric, space and dot'
					}
				}
            },
			'addmedicn[0][dosage]': {
                 validators: {
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Medicine dosage can only consist of alphanumeric, space and dot'
					}
				}
            },
			'addmedicn[0][qty]': {
                 validators: {
					notEmpty: {
						message: 'Qty is required'
					},
					regexp: {
					regexp: /^[0-9]*$/,
					message: 'Qty can only consist digits'
					}
				}
            },
			'addmedicn[0][amount]': {
                 validators: {
					notEmpty: {
						message: 'Amount is required'
					},
					regexp: {
					regexp: /^[0-9]*$/,
					message: 'Amount can only consist digits'
					}
				}
            },
			'addmedicn[0][sgst]': {
                 validators: {
					notEmpty: {
						message: 'SGST is required'
					},
					  between: {
                            min: 0,
                            max: 100,
                            message: 'The percentage of SGST must be between 0 and 100'
                        }
				}
            },
			'addmedicn[0][cgst]': {
                 validators: {
					notEmpty: {
						message: 'CGST is required'
					},
					 between: {
                            min: 0,
                            max: 100,
                            message: 'The percentage of CGST must be between 0 and 100'
                        }
				}
            },
           'addmedicn[0][other]': {
                validators: {
					notEmpty: {
						message: 'Other is required'
					},
                    regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Others can only consist of alphanumeric, space and dot'
					}
                }
            }
			}
		
	})
     
});
$(document).ready(function() {
 
    $('#add_medicine').bootstrapValidator({
		fields: {
          
             uploadfile: {
                 validators: {
					notEmpty: {
						message: 'File is required'
					},
					regexp: {
					regexp: "(.*?)\.(xlsx|xls)$",
					message: 'Uploaded file is not a valid. Only xlsx,xls files are allowed'
					}
				}
            }
			}
		
	})
     
});
   </script> 
