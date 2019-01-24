<?php //echo '<pre>';print_r($prescriptions);exit; ?>
<div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
			  <div class="page-title-breadcrumb">
				 <div class=" pull-left">
					<div class="page-title">Prescription List</div>
				 </div>
				 <ol class="breadcrumb page-breadcrumb pull-right">
					<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
					</li>
					<li><a class="parent-item active" >Prescription List</a>&nbsp;</i>
					</li>
				 </ol>
			  </div>
		   </div>
					<div class="row">
                                <div class="col-md-12">
                                    <div class="card ">
                                        <div class="card-head">
                                            <header>Name : &nbsp;<span><?php echo isset($prescriptions['information']['name'])?$prescriptions['information']['name']:''; ?> </span><h4 class="py-2"><?php echo isset($prescriptions['information']['mobile'])?$prescriptions['information']['mobile']:''; ?></h4></header>
											<div class="tools">
											<h4><b>ID: <span><?php echo isset($prescriptions['information']['pid'])?$prescriptions['information']['pid']:''; ?></span></b></h4>
											<?php if($prescriptions['information']['sheet_prescription']==1){ ?>
											<form action="<?php echo base_url('users/sheet_prescription'); ?>" method="post" enctype="multipart/form-data">
											<input type="hidden" name="p_id" value="<?php echo isset($prescriptions['information']['pid'])?$prescriptions['information']['pid']:''; ?>">
											<input type="hidden" name="b_id" value="<?php echo isset($prescriptions['information']['b_id'])?$prescriptions['information']['b_id']:''; ?>">
											<input type="hidden" name="sheet_prescription_name" value="<?php echo isset($prescriptions['information']['sheet_prescription_file'])?$prescriptions['information']['sheet_prescription_file']:''; ?>">
											Upload Prescription File : <input type="file" name="sheet_prescription">
											<button type="submit" value="submit">submit</button>
											</form>
											<?php } ?>
											</div>
                                          
                                        </div>
                                        <div class="card-body " style="padding: 0px 24px 24px 24px;">
                                        <div class="table-responsive">
										<form id="prescription" name="prescription" method="post" target="_blank"  action="<?php echo base_url('Users/billprescription'); ?>">
                                            <input type="hidden" name="pid" id="pid" value="<?php echo isset($prescriptions['information']['pid'])?$prescriptions['information']['pid']:''; ?>">
                                            <input type="hidden" name="bid" id="bid" value="<?php echo isset($prescriptions['information']['b_id'])?$prescriptions['information']['b_id']:''; ?>">
											<table class="table custom-table table-hover" style="border-top:none">
                                                <thead>
                                                    <tr>
                                                        <th>Medicine Name</th>
														<th>Batch No</th>
														<th>Expiry Date</th>
														<th>No of Days</th>
														<th>QTY</th>
														<th>Amount</th>
                                                        <th>Usage </th>
                                                        <th>Total Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php foreach($prescriptions['medicine'] as $list){ ?>
                                                    <tr>
                                                        <td><?php echo isset($list['medicine_name'])?$list['medicine_name']:''; ?></td>
                                                        <td><?php echo isset($list['batchno'])?$list['batchno']:''; ?></td>
														 <td><?php echo isset($list['expiry_date'])?$list['expiry_date']:''; ?></td>
														 <td><?php echo isset($list['no_of_days'])?$list['no_of_days']:''; ?></td>
														<td style="width:100px">
															<div class="form-group">
															<input autocomplete="off" onkeyup="changeqty(this.value,'<?php echo isset($list['m_id'])?$list['m_id']:''; ?>','');change_qtys('<?php echo isset($list['m_id'])?$list['m_id']:''; ?>',this.value);" name="qty" id="qty<?php echo isset($list['m_id'])?$list['m_id']:''; ?>" type="text" class="form-control" value="<?php echo isset($list['qty'])?$list['qty']:''; ?>" placeholder="Enter Qty">
															</div>
														</td>
														 <td style="width:100px">
															<div class="form-group">
															<input autocomplete="off" onkeyup="changeamount(this.value,'<?php echo isset($list['m_id'])?$list['m_id']:''; ?>');change_qtys('<?php echo isset($list['m_id'])?$list['m_id']:''; ?>',this.value);" name="amount" id="amount<?php echo isset($list['m_id'])?$list['m_id']:''; ?>" type="text" class="form-control" value="<?php echo isset($list['amount'])?$list['amount']:''; ?>" placeholder="Enter amount">
															</div>
														</td>
                                                        <td>
															<div class="form-group">
																<select class="form-control">
																	<option value="<?php echo isset($list['frequency'])?$list['frequency']:''; ?>"><?php echo isset($list['frequency'])?$list['frequency']:''; ?></option>
																</select>
															</div>
														</td>
                                                     
														<td>
														<div class="form-group">
															<input name="total_amt" id="total_amt<?php echo isset($list['m_id'])?$list['m_id']:''; ?>" type="text" class="form-control" value="<?php echo isset($list['org_amount'])?$list['org_amount']:''; ?>" placeholder="Enter Total Amount">
															</div>
														</td>
                                                    </tr>
													<?php } ?>
                                                </tbody>
                                            </table>
											<div class="pull-right">
											<div class="pull-left form-group">
											<select onchange="savepaymentmode(this.value,'<?php echo $prescriptions['information']['b_id']; ?>');" id="paymentmode" name="paymentmode" class="form-control">
											<option value="">Select Payment </option>
											<option value="Swipe">Swipe</option>
											<option value="Cash Payment">Cash Payment</option>
											<option value="Other">Other</option>
											</select>
											</div> &nbsp;
											<a href="<?php echo base_url('Users/');?>" class="btn btn-warning">Submit</a>
											<button type="submit"  class="btn btn-success">Print Prescription</button>
											</div>

											</form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
				
                    
                </div>
            </div>
			<div id="sucessmsg" style="display:none;"></div>
<script>
function change_qtys(id,val){
	
	var qty=$('#qty'+id).val();
	var amt=$('#amount'+id).val();
	var total=(parseInt(qty)*parseInt(amt));
	$('#total_amt'+id).val(total);
	
}
$(document).ready(function() {
 $('#prescription').bootstrapValidator({
		fields: {
			paymentmode: {
                 validators: {
					notEmpty: {
						message: 'Payment mode is required'
					}
				}
            }
			}
		
	})
     
});
function savepaymentmode(payment,id){
	jQuery.ajax({
   					url: "<?php echo site_url('Users/billing_payment_mode');?>",
   					data: {
   						mode: payment,
   						billing_id: id,
   					},
   					dataType: 'json',
   					type: 'POST',
   					success: function (data) {
						$('#sucessmsg').show();
							if(data.msg==1){
								$('#sucessmsg').html('<div class="alt_cus"><div class="alert_msg1 animated slideInUp bg-succ">Payment Mode successfully updated <i class="fa fa-check  text-success ico_bac" aria-hidden="true"></i></div></div>');  
								
							}else{
								$('#sucessmsg').html('<div class="alt_cus"><div class="alert_msg1 animated slideInUp bg-warn"> Technical problem will occurred. Please try again<i class="fa fa-check  text-success ico_bac" aria-hidden="true"></i></div></div>');  
							}
					}
   				});
	
}
function changeqty(qty,id,reason){
	jQuery.ajax({
   					url: "<?php echo site_url('Users/prescriptionschanges');?>",
   					data: {
   						medicine_qty: qty,
   						medicine_id: id,
   						reason: reason,
						qtys: $('#qty'+id).val(),
   						amt: $('#amount'+id).val(),
   					},
   					dataType: 'json',
   					type: 'POST',
   					success: function (data) {
						$('#sucessmsg').show();
							if(data.msg==1){
								if(qty!=''){
								$('#sucessmsg').html('<div class="alt_cus"><div class="alert_msg1 animated slideInUp bg-succ">Quantity successfully updated <i class="fa fa-check  text-success ico_bac" aria-hidden="true"></i></div></div>');  
								}else if(reason!=''){
									$('#sucessmsg').html('<div class="alt_cus"><div class="alert_msg1 animated slideInUp bg-succ"> Reason successfully updated <i class="fa fa-check  text-success ico_bac" aria-hidden="true"></i></div></div>');  
								}
							}else{
								$('#sucessmsg').html('<div class="alt_cus"><div class="alert_msg1 animated slideInUp bg-warn"> Technical problem will occurred. Please try again<i class="fa fa-check  text-success ico_bac" aria-hidden="true"></i></div></div>');  
							}
					}
   				});
	
}
function changeamount(amount,id){
	jQuery.ajax({
   					url: "<?php echo site_url('Users/prescriptionschanges');?>",
   					data: {
   						amount: amount,
   						medicine_id: id,
   					},
   					dataType: 'json',
   					type: 'POST',
   					success: function (data) {
						$('#sucessmsg').show();
							if(data.msg==1){
								$('#sucessmsg').html('<div class="alt_cus"><div class="alert_msg1 animated slideInUp bg-succ">Amount successfully updated <i class="fa fa-check  text-success ico_bac" aria-hidden="true"></i></div></div>');  
								
							}else{
								$('#sucessmsg').html('<div class="alt_cus"><div class="alert_msg1 animated slideInUp bg-warn"> Technical problem will occurred. Please try again <i class="fa fa-check  text-success ico_bac" aria-hidden="true"></i></div></div>');  
							}
					}
   				});
	
}
</script>