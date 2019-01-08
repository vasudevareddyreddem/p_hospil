<div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
			  <div class="page-title-breadcrumb">
				 <div class=" pull-left">
					<div class="page-title">Medicine List</div>
				 </div>
				 <ol class="breadcrumb page-breadcrumb pull-right">
					<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
					</li>
					<li><a class="parent-item active" >Medicine List</a>&nbsp;</i>
					</li>
				 </ol>
			  </div>
		   </div>
					<div class="row">
                       <div class="col-md-12">
                            <div class="card card-topline-aqua">
							
                                <div class="card-head">
                                     <header>Medicine List</header>
                                   
                                </div>
                                <div class="table-responsive">
								<?php if(count($medicine_list)>0){ ?>
									<table class="table table-striped table-bordered table-hover table-checkable order-column" id="example4">
                                        <thead>
                                            <tr>
												<th style="display:none"></th>
												<th>HSN</th>
												<th>MFR</th>
												<th>Batch No</th>
												<th>Medicine Name</th>
												<th>Medicine Type</th>
												<th>Expiry Date</th>
												<th>Dosage</th>
												<th>QTY</th>
												<th>Amount</th>
												<th>SGST</th>
												<th>CGST</th>
												<th>MRP</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php foreach($medicine_list as $list){ ?>
                                            <tr>
                                                <td style="display:none"><input type="text" value="<?php echo htmlentities($list['id']); ?>"></td>
                                                <td><input type="text" onkeyup="autosavefields(this.value,'<?php echo $list['id']; ?>','hsn');" value="<?php echo htmlentities($list['hsn']); ?>"></td>
                                                <td><input type="text" onkeyup="autosavefields(this.value,'<?php echo $list['id']; ?>','othercode');" value="<?php echo htmlentities($list['othercode']); ?>"></td>
                                                <td><input type="text" onkeyup="autosavefields(this.value,'<?php echo $list['id']; ?>','batchno');" value="<?php echo htmlentities($list['batchno']); ?>"></td>
												<td><input type="text" onkeyup="autosavefields(this.value,'<?php echo $list['id']; ?>','medicine_name');" value="<?php echo htmlentities($list['medicine_name']); ?>"></td>
                                                <td><input type="text" onkeyup="autosavefields(this.value,'<?php echo $list['id']; ?>','medicine_type');" value="<?php echo htmlentities($list['medicine_type']); ?>"></td>
                                                <td><input type="text" onkeyup="autosavefields(this.value,'<?php echo $list['id']; ?>','expiry_date');" value="<?php echo htmlentities($list['expiry_date']); ?>"></td>
                                                <td><input type="text" onkeyup="autosavefields(this.value,'<?php echo $list['id']; ?>','dosage');" value="<?php echo htmlentities($list['dosage']); ?>"></td>
                                                <td><input type="text" onkeyup="autosavefields(this.value,'<?php echo $list['id']; ?>','qty');" value="<?php echo htmlentities($list['qty']); ?>"></td>
                                                <td><input type="text" onkeyup="autosavefields(this.value,'<?php echo $list['id']; ?>','amount');" value="<?php echo htmlentities($list['amount']); ?>"></td>
                                                <td><input type="text" onkeyup="autosavefields(this.value,'<?php echo $list['id']; ?>','sgst');" value="<?php echo htmlentities($list['sgst']); ?>"></td>
                                                <td><input type="text" onkeyup="autosavefields(this.value,'<?php echo $list['id']; ?>','cgst');" value="<?php echo htmlentities($list['cgst']); ?>"></td>
                                                <td><input readonly="true" type="text" id="total_amt<?php echo $list['id']; ?>" value="<?php echo htmlentities($list['total_amount']); ?>"></td>
                                                <td>
												  <a href="javascript;void(0);" onclick="admindelete('<?php echo base64_encode(htmlentities($list['id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus2('<?php echo $list['status'];?>')" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">Delete</a>
												</td>
                                                
                                            </tr>
										<?php } ?>
											
                                            
                                        </tbody>
                                    </table>
								<?php } ?>
                                </div>
								<div class="clearfix">&nbsp;</div>
							 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
			
			<div style="padding:10px">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 style="pull-left" class="modal-title">Confirmation</h4>
			</div>
			<div class="modal-body">
			<div class="alert alert-danger alert-dismissible" id="errormsg" style="display:none;"></div>
			  <div class="row">
				<div id="content1" class="col-xs-12 col-xl-12 form-group">
				Are you sure ? 
				</div>
				<div class="col-xs-6 col-md-6">
				  <button type="button" aria-label="Close" data-dismiss="modal" class="btn  blueBtn">Cancel</button>
				</div>
				<div class="col-xs-6 col-md-6">
                <a href="?id=value" class="btn  blueBtn popid" style="text-decoration:none;float:right;"> <span aria-hidden="true">Ok</span></a>
				</div>
			 </div>
		  </div>
      </div>
      
    </div>
  </div>
                            </div>
                        </div>
                    </div>
				
                    
                </div>
            </div>
			<div id="sucessmsg" style="display:none;"></div>

			<script>
			
			
			
			
			
			
			
			
	function admindelete(id){
	$(".popid").attr("href","<?php echo base_url('medicine/delete'); ?>"+"/"+id);
}
function adminstatus2(id){
	
			$('#content1').html('Are you sure you want to delete?');

}		
			
			
			
			
			
			function autosavefields(val,id,name){
				if(val!='' && id!='' && name!=''){
					jQuery.ajax({
						url: "<?php echo base_url('medicine/editmedicine_details');?>",
							data: {
								med_id: id,
								med_name: val,
								field_name: name,
							},
							dataType: 'json',
							type: 'POST',
							success: function (data) {
								$('#sucessmsg').show();
								$('#total_amt'+id).val(data.t_amt);
								if(data.msg==1){
									$('#sucessmsg').html('<div class="alt_cus"><div class="alert_msg1 animated slideInUp bg-succ"> Details successfully updated<i class="fa fa-check  text-success ico_bac" aria-hidden="true"></i></div></div>');  
								}else if(data.msg==2){
									$('#sucessmsg').html('<div class="alt_cus"><div class="alert_msg1 animated slideInUp bg-warn"> Technical problem will occurred. Please try again<i class="fa fa-check  text-success ico_bac" aria-hidden="true"></i></div></div>');  
								}else if(data.msg==3){
									$('#sucessmsg').html('<div class="alt_cus"><div class="alert_msg1 animated slideInUp bg-warn"> You have no permissions to access this page. Please try again<i class="fa fa-check  text-success ico_bac" aria-hidden="true"></i></div></div>');  
								}
							}
					});
				}else{
					$('#sucessmsg').html('<div class="alt_cus"><div class="alert_msg1 animated slideInUp bg-warn">Field is required. Please try again<i class="fa fa-check  text-success ico_bac" aria-hidden="true"></i></div></div>');  

				}
			}
			$(document).ready(function() {
				$('#addmedicinelist').DataTable( {
				 "columns": [
							{ "targets": 0, "orderDataType": "dom-text", "type": "string" },
							{ "targets": 1, "orderDataType": "dom-text", "type": "string" },
							{ "targets": 2, "orderDataType": "dom-text", "type": "string" },
							{ "targets": 3, "orderDataType": "dom-text", "type": "string" },
							{ "targets": 4, "orderDataType": "dom-text", "type": "string" },
							{ "targets": 5, "orderDataType": "dom-text", "type": "string" },
							{ "targets": 6, "orderDataType": "dom-text", "type": "string" },
							{ "targets": 7, "orderDataType": "dom-text", "type": "string" },
							{ "targets": 8, "orderDataType": "dom-text", "type": "string" }
						],
						
				});
				});
			</script>
			<script>
$(document).ready(function() {
    $('#example4').DataTable( {
		 "columnDefs": [
			{ "targets": 0, "orderDataType": "dom-text", "type": "string" },
			{ "targets": 1, "orderDataType": "dom-text", "type": "string" },
			{ "targets": 2, "orderDataType": "dom-text", "type": "string" },
			{ "targets": 3, "orderDataType": "dom-text", "type": "string" },
			{ "targets": 4, "orderDataType": "dom-text", "type": "string" },
			{ "targets": 5, "orderDataType": "dom-text", "type": "string" },
			{ "targets": 6, "orderDataType": "dom-text", "type": "string" }
          
        ],
        "order": [[ 0, "desc" ]]
    } );
} );


</script>
