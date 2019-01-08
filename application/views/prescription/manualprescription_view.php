<?php //echo '<pre>';print_r($prescriptions);exit; ?>
<div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
			  <div class="page-title-breadcrumb">
				 <div class=" pull-left">
					<div class="page-title">Prescription View</div>
				 </div>
				 <ol class="breadcrumb page-breadcrumb pull-right">
					<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
					</li>
					<li><a class="parent-item active" >Prescription View</a>&nbsp;</i>
					</li>
				 </ol>
			  </div>
		   </div>
					<div class="row">
                                <div class="col-md-12">
                                    <div class="card ">
                                        <div class="card-head">
                                            <header>Name : &nbsp;<span><?php echo isset($details['name'])?$details['name']:''; ?> </span><h4 class="py-2"><?php echo isset($details['mobile'])?$details['mobile']:''; ?></h4></header>
											<div class="tools">
											<h4><b>ID: <span><?php echo isset($details['pid'])?$details['pid']:''; ?></span></b></h4>
											<h5><b>DOB: <span><?php echo isset($details['dob'])?$details['dob']:''; ?></span></b></h5>
											</div>
                                          
                                        </div>
                                        <div class="card-body " style="padding: 0px 24px 24px 24px;">
                                        <div class="table-responsive">
										<form id="prescription" name="prescription" method="post" target="_blank"  action="<?php echo base_url('Users/manualbillprescription'); ?>">
                                            <input type="hidden" name="id" id="id" value="<?php echo isset($details['id'])?$details['id']:''; ?>">
                                            <input type="hidden" name="pid" id="pid" value="<?php echo isset($details['pid'])?$details['pid']:''; ?>">
                                            <input type="hidden" name="bid" id="bid" value="<?php echo isset($b_id)?$b_id:''; ?>">
											<table class="table custom-table table-hover" style="border-top:none">
                                                <thead >
                                                    <tr>
                                                        <th>Medicine Name</th>
                                                        <th>QTY</th>
                                                        <th>Expiry Date</th>
                                                        <th>Usage Instructions</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php foreach($prescriptions as $list){ ?>
                                                    <tr>
                                                        <td><?php echo isset($list['medicine_name'])?$list['medicine_name']:''; ?></td>
                                                        
                                                        <td>
															<?php echo isset($list['qty'])?$list['qty']:''; ?>
														</td>
														<td>
															<?php echo isset($list['expirydate'])?$list['expirydate']:''; ?>
														</td>
														
														<td>
															<?php echo isset($list['usage_instructions'])?$list['usage_instructions']:''; ?>
														</td>
                                                        
                                                        <td><?php echo isset($list['amount'])?$list['amount']:''; ?></td>
                                                       
                                                    </tr>
													
													<?php } ?>
												 </tbody>
                                            </table>
											<div class="pull-right">
											<div class="pull-left form-group">
											<select onchange="savepaymentmode(this.value,'<?php echo $b_id; ?>');" id="paymentmode" name="paymentmode" class="form-control">
											<option value="">Select Payment </option>
											<option value="Swipe">Swipe</option>
											<option value="Cash Payment">Cash Payment</option>
											<option value="Other">Other</option>
											</select>
											</div> &nbsp;
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
								$('#sucessmsg').html('<div class="alt_cus"><div class="alert_msg1 animated slideInUp bg-warn"> Technical problem will occurred. Please try again<i class="fa fa-check  text-success ico_bac" aria-hidden="true"></i></div></div>');  
							}
					}
   				});
	
}
</script>