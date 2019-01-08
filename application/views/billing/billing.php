
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Billing</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Billing</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel tab-border card-topline-yellow">
                    <header class="panel-heading panel-heading-gray custom-tab ">
                        <ul class="nav nav-tabs x-scrool">

                            <li style="border-right:2px solid #fff" class="nav-item">
                                <a href="#bill" data-toggle="tab" class="<?php if(isset($tab)&& $tab==''){ echo " active";}?>"> Bill</a>
                            </li>

                            <li class="nav-item">
                                <a href="#bill_list" data-toggle="tab" class="<?php if(isset($tab)&& $tab==1){ echo "active";}?>">Bills List</a>
                            </li>

                        </ul>
                    </header>
                    <div class="panel-body">
                        <div class="tab-content">
                            
                            <div class="tab-pane  <?php if(isset($tab) && $tab==''){ echo " active";}?>" id="bill">
                                <div class="card">
                                    <div class="card-head">
                                        <header>Bill Details</header>
                                    </div>
                                    <div class="card-body ">
                                        <div class="card-body " id="bar-parent" style="margin-top:30px">

                                            <form name="bill_details" onsubmit="rerurn check_validation();" id="bill_details" action="<?php echo  base_url('billing/addpost'); ?>" method="post" class="pad30 form-horizontal">
												<input type="hidden" id="appointment_user_id"  name="appointment_user_id"  value="">
												<input type="hidden" id="percentage"  name="percentage"  value="">
                                                <div class="row">
                                                    
                                                    <div class="form-group col-md-6">
                                                        <label for="bd_category">Category</label>
                                                        <select class="form-control" id="category_type" name="category_type" onchange="get_payment_option(this.value);">
                                                            <option value="" >Select</option>
                                                            <option value="2">IP</option>
                                                            <option value="3">Lab</option>
                                                        </select>
                                                    </div> 
													<div class="form-group col-md-6">
                                                        <label for="bd_category">Payment Type</label>
                                                        <select class="form-control" id="payment_type" name="payment_type">
                                                            <option value="" >Select</option>
                                                            <option value="1">Online</option>
                                                            <option value="2">Cash on delivery</option>
                                                            <option value="3">Swipe on delivery</option>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="form-group col-md-6">
                                                        <label for="bd_cnumber">Patient Id</label>
                                                        <input type="text" name="patient_id" id="patient_id" class="form-control" placeholder="Enter Patient Number">
                                                    </div>  
                                                    <div class="form-group col-md-6">
                                                        <label for="bd_cnumber">Card Number</label>
                                                        <input type="text" name="card_number" id="card_number" class="form-control" placeholder="Enter Card Number">
                                                    </div>
                                                    
                                                    <div class="form-group col-md-6">
                                                        <label for="bd_name">Name</label>
                                                        <input type="text" name="p_name" id="p_name" class="form-control" placeholder="Enter Name">
                                                    </div>
                                                    
                                                    <div class="form-group col-md-6">
                                                        <label for="bd_mobile">Mobile</label>
                                                        <input type="text" name="p_mobile" id="p_mobile" class="form-control" placeholder="Enter Mobile Number">
                                                    </div>
                                                    
                                                    <div class="form-group col-md-6">
                                                        <label for="bd_amount">Amount</label>
                                                        <input type="text" name="p_amount" id="p_amount" class="form-control" placeholder="Enter Amount">
                                                    </div> 
													<div class="form-group col-md-6">
                                                        <label for="bd_amount">Coupon code Id</label>
                                                        <input type="text" name="coupon_id" id="coupon_id" class="form-control" placeholder="Enter Coupon code Id">
                                                    </div>
                                                    
                                                    <div class="form-group col-md-6">
                                                        <label for="bd_ccode">Coupon Code</label>
                                                        <input type="text" name="coupon_code" onkeyup="removeErrormsg(this.value);" id="coupon_code" class="form-control" placeholder="Enter Coupon Code">
														<span id="ipmodule">
														<a href="javascript:void(0);" onclick="check_coupon_code();">Apply</a>
														</span>
														<span id="labmodule" style="display:none;">
														<a href="javascript:void(0);" onclick="check_coupon_code1();">Apply</a>
														</span>
															<span id="successmsg1" style="color:green;"></span>
															<span id="errormsg1" style="color:red;"></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="bd_dammount"> Pay Amount </label>
                                                        <input type="text" name="coupon_discount_amount" id="coupon_discount_amount" class="form-control" placeholder="Pay Amount">
                                                    </div>
													<input  type="hidden" name="already_coupon_code_used" id="already_coupon_code_used" value="">
													<input  type="hidden" name="b_id" id="b_id" value="">
                                                    
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </form>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="tab-pane <?php if(isset($tab)&& $tab==1){ echo " active";}?>" id="bill_list">
                                <div class="card">
                                    <div class="card-head">
                                        <header>Bills List</header>
                                    </div>
                                    <div class="card-body table-responsive ">
                                        <?php if(isset($billing_list) && count($billing_list)>0){ ?>
                                        <table class="table table-striped table-bordered" id="example3">
                                            <thead>
                                                <tr>
                                                    <th> Category </th>
                                                    <th> Card Number </th>
                                                    <th> Name </th>
                                                    <th> Mobile </th>
                                                    <th> Amount </th>
                                                    <th> Pay Amount </th>
                                                    <th> Discount Amount </th>
                                                    <th> Coupon Code </th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php foreach($billing_list as $list){ ?>
                                                <tr>
                                                    <td><?php if($list['category_type']==2){  echo "IP";}else{ echo "Lab"; } ?></td>
                                                    <td><?php echo isset($list['card_number'])?$list['card_number']:''; ?></td>
                                                    <td><?php echo isset($list['p_name'])?$list['p_name']:''; ?></td>
                                                    <td><?php echo isset($list['p_mobile'])?$list['p_mobile']:''; ?></td>
                                                    <td><?php echo isset($list['p_amount'])?$list['p_amount']:''; ?></td>
                                                    <td><?php echo isset($list['pay_amount'])?$list['pay_amount']:''; ?></td>
                                                    <td><?php echo $list['p_amount']-$list['pay_amount'];  ?></td>
                                                    <td><?php echo isset($list['coupon_code'])?$list['coupon_code']:''; ?></td>
                                                   
                                                </tr>
											<?php } ?>
                                            </tbody>
                                        </table>
										<?php } ?>
                                        
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
function check_validation(){
	
}
function removeErrormsg(val){
	if(val==''){
		$("#successmsg1").hide();
		var totalamount=$('#p_amount').val();
		var amount=$('#coupon_discount_amount').val(totalamount);
		$('#already_coupon_code_used').val(0);
	}else{
		$("#successmsg1").empty();
		$("#successmsg1").show();
	}
}
function get_payment_option(val){
	if(val==2){
		$('#ipmodule').show();
		$('#labmodule').hide();
	}else{
		$('#labmodule').show();
		$('#ipmodule').hide();
	}
}
function check_coupon_code(){
	var coupon_code=$('#coupon_code').val();
	var type=$('#category_type').val();
	var patient_id=$('#patient_id').val();
	var p_amount=$('#p_amount').val();
	var coupon_id=$('#coupon_id').val();
	
	if( coupon_code!='' && type!='' && patient_id!='' && p_amount!='' && coupon_id!=''){
		
		if($('#already_coupon_code_used').val()==1){
			 $('#sucessmsg').html('<div class="alt_cus"><div class="alert_msg1 animated slideInUp bg-warn"> Coupon Code already used. Please try again<i class="fa fa-check  text-success ico_bac" aria-hidden="true"></i></div></div>');  
				return false;
			}
		jQuery.ajax({
			url:'<?php echo base_url('billing/check_coupon_code'); ?>',
			data:{
				coupon_code:coupon_code,
				type:type,
				patient_id:patient_id,
				bill_amount:p_amount,
				coupon_id:coupon_id,
			},
			datatype:'JSON',
			method:'POST',
			success:function (data){
						$('#sucessmsg').show();
						var pdata=JSON.parse(data);
						//alert(pdata);
						//alert(pdata.amt);
						//alert(pdata.cou_amt);
						//alert(data);
						if(pdata.msg==1){
   							$('#sucessmsg').html('<div class="alt_cus"><div class="alert_msg1 animated slideInUp bg-succ">Coupon Code applied Successfully.<i class="fa fa-check  text-success ico_bac" aria-hidden="true"></i></div></div>');  
							$('#coupon_discount_amount').val(pdata.amt);
							$('#b_id').val(pdata.billing_id);
							$('#already_coupon_code_used').val(1);
							$('#appointment_user_id').val(pdata.appointment_user_id);
							$('#percentage').val(pdata.cou_amt);
							document.getElementById("successmsg1").innerHTML="Coupon Code applied Successfully. Payable Amount is "+pdata.cou_amt+" % decreased";
						}
						if(pdata.msg==2){
							 $('#sucessmsg').html('<div class="alt_cus"><div class="alert_msg1 animated slideInUp bg-warn"> Invalid Coupon Code. Please try again<i class="fa fa-check  text-success ico_bac" aria-hidden="true"></i></div></div>');  
						}if(pdata.msg==3){
   							$('#sucessmsg').html('<div class="alt_cus"><div class="alert_msg1 animated slideInUp bg-warn"> Coupon code was not correct. Please try again once <i class="fa fa-check  text-success ico_bac" aria-hidden="true"></i></div></div>');  
						}if(pdata.msg==4){
   							$('#sucessmsg').html('<div class="alt_cus"><div class="alert_msg1 animated slideInUp bg-warn">Your wallet having insufficient amount. Please recharge again<i class="fa fa-check  text-success ico_bac" aria-hidden="true"></i></div></div>');  
						}if(pdata.msg==5){
   							$('#sucessmsg').html('<div class="alt_cus"><div class="alert_msg1 animated slideInUp bg-warn">Coupon Code is expired. Please try another one <i class="fa fa-check  text-success ico_bac" aria-hidden="true"></i></div></div>');  
						}
			}
		});
	}else{
		alert('Required field is missing. Please fill all fileds');
		
	}
	
	
}
function check_coupon_code1(){
	var coupon_code=$('#coupon_code').val();
	var type=$('#category_type').val();
	var patient_id=$('#patient_id').val();
	var p_amount=$('#p_amount').val();
	var coupon_id=$('#coupon_id').val();
	
	if( coupon_code!='' && type!='' && patient_id!='' && p_amount!='' && coupon_id!=''){
		
		if($('#already_coupon_code_used').val()==1){
			 $('#sucessmsg').html('<div class="alt_cus"><div class="alert_msg1 animated slideInUp bg-warn"> Coupon Code already used. Please try again<i class="fa fa-check  text-success ico_bac" aria-hidden="true"></i></div></div>');  
				return false;
			}
		jQuery.ajax({
			url:'<?php echo base_url('billing/check_labcoupon_code'); ?>',
			data:{
				coupon_code:coupon_code,
				type:type,
				patient_id:patient_id,
				bill_amount:p_amount,
				coupon_id:coupon_id,
			},
			datatype:'JSON',
			method:'POST',
			success:function (data){
						$('#sucessmsg').show();
						var pdata=JSON.parse(data);
						//alert(pdata);
						//alert(pdata.amt);
						//alert(pdata.cou_amt);
						//alert(data);
						if(pdata.msg==1){
   							$('#sucessmsg').html('<div class="alt_cus"><div class="alert_msg1 animated slideInUp bg-succ">Coupon Code applied Successfully.<i class="fa fa-check  text-success ico_bac" aria-hidden="true"></i></div></div>');  
							$('#coupon_discount_amount').val(pdata.amt);
							$('#b_id').val(pdata.billing_id);
							$('#already_coupon_code_used').val(1);
							$('#appointment_user_id').val(pdata.appointment_user_id);
							$('#percentage').val(pdata.cou_amt);
							document.getElementById("successmsg1").innerHTML="Coupon Code applied Successfully. Payable Amount is "+pdata.cou_amt+" % decreased";
						}
						if(pdata.msg==2){
							 $('#sucessmsg').html('<div class="alt_cus"><div class="alert_msg1 animated slideInUp bg-warn"> Invalid Coupon Code. Please try again<i class="fa fa-check  text-success ico_bac" aria-hidden="true"></i></div></div>');  
						}if(pdata.msg==3){
   							$('#sucessmsg').html('<div class="alt_cus"><div class="alert_msg1 animated slideInUp bg-warn">Coupon code was not correct. Please try again once<i class="fa fa-check  text-success ico_bac" aria-hidden="true"></i></div></div>');  
						}if(pdata.msg==4){
   							$('#sucessmsg').html('<div class="alt_cus"><div class="alert_msg1 animated slideInUp bg-warn">Your wallet having insufficient amount. Please recharge again<i class="fa fa-check  text-success ico_bac" aria-hidden="true"></i></div></div>');  
						}if(pdata.msg==5){
   							$('#sucessmsg').html('<div class="alt_cus"><div class="alert_msg1 animated slideInUp bg-warn">Coupon Code is expired. Please try another one <i class="fa fa-check  text-success ico_bac" aria-hidden="true"></i></div></div>');  
						}
			}
		});
	}else{
		alert('Required field is missing. Please fill all fileds');
		
	}
	
	
}

    $(document).ready(function() {

        $('#bill_details').bootstrapValidator({
            fields: {
                
                category_type: {
                    validators: {
                        notEmpty: {
                            message: 'Category is required'
                        }
                    }
                },
				payment_type: {
                    validators: {
                        notEmpty: {
                            message: 'Payment type is required'
                        }
                    }
                },
                patient_id: {
                    validators: {
                        notEmpty: {
                            message: 'Patient Id is required'
                        },
                        regexp: {
                            regexp: /^[0-9]*$/,
                            message: 'Patient Id must be in digits'
                        }
                    }
                },
				card_number: {
                    validators: {
                        notEmpty: {
                            message: 'Card Number is required'
                        },
                        regexp: {
                            regexp: /^[0-9]*$/,
                            message: 'Card Number must be in digits'
                        }
                    }
                },
                p_name: {
                    validators: {
                        notEmpty: {
                            message: 'Name is required'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9. ]+$/,
                            message: 'Name can only consist of alphanumeric, space and dot'
                        }
                    }
                },
                p_mobile: {
                    validators: {
                        notEmpty: {
                            message: 'Mobile Number is required'
                        },
                        regexp: {
                            regexp: /^[0-9]{10,14}$/,
                            message: 'Mobile Number must be 10 to 14 digits'
                        }
                    }
                },
                coupon_id: {
                    validators: {
                        notEmpty: {
                            message: 'Coupon Code id is required'
                        },
                        regexp: {
                            regexp: /^[0-9]*$/,
                            message: 'Coupon Code id must be in digits'
                        }
                    }
                },
				p_amount: {
                    validators: {
                        notEmpty: {
                            message: 'Amount is required'
                        },
                        regexp: {
                            regexp: /^[0-9]*$/,
                            message: 'Amount must be in digits'
                        }
                    }
                },
                
                coupon_code: {
                    validators: {
                        notEmpty: {
                            message: 'Coupon Code is required'
                        }
                    }
                }
            }
        })

    });
</script>