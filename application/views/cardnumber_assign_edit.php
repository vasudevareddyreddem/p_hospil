<?php //echo '<pre>';print_r($admin_detail);exit; ?>

<div class="page-content-wrapper">
                <div class="page-content" >
						<div class="page-bar">
						  <div class="page-title-breadcrumb">
							 <div class=" pull-left">
								<div class="page-title">Assigned Card Numbers Edit</div>
							 </div>
							 <ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('admin/cardnumber_distribute/'.base64_encode(3)); ?>">
								Assigned Card Numbers List
								</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								
								<li class="active">Profile Edit</li>
							 </ol>
						  </div>
						</div>
							 
					 <div class="row" style="">
                       
                        <div class="col-md-12 col-sm-12">
                            <div class="card  card-topline-yellow">
                                
                                <div class="card-body ">
											 <div class="col-sm-12">
										
											 <form action="<?php echo base_url('admin/cardnumber_assign_update_post'); ?>" method="post" id="assign_seller" name="assign_seller" enctype="multipart/form-data">
								<div class="row">
								<div class="col-md-4">
									<label> Name</label>
								 
								<select class="form-control select2" style="width:100%" name="seller_id" id="seller_id">
									<option value="">Select</option>
									<?php foreach($ative_card_seller_list as $s_list){ ?>
										<?php if($seller_id==$s_list['s_id']){ ?>
											<option selected  value="<?php echo $s_list['s_id']; ?>"><?php echo $s_list['name']; ?></option>
										<?php } ?>
									<?php } ?>
								</select>
								</div>
								
								<div class="col-md-4">
									<label>Card Numbers From</label>
									<select class="form-control select2" style="width:100%" name="card_number_from" id="card_number_from">
										<option value="">Select</option>
										<?php foreach($card_number_list as $s_list){ ?>
												<?php if($s_list['card_number']==$start_num['card_number']){ ?>
													<option  selected value="<?php echo $s_list['c_id']; ?>"><?php echo $s_list['card_number']; ?></option>
												<?php }else{ ?>
													<option value="<?php echo $s_list['c_id']; ?>"><?php echo $s_list['card_number']; ?></option>
												<?php } ?>
											<?php } ?>
									</select>
								</div>
								<div class="col-md-4">
									<label>Card Numbers To</label>
									<select class="form-control select2" style="width:100%" name="card_number_to" id="card_number_to">
										<option value="">Select</option>
										<?php foreach($card_number_list as $s_list){ ?>
											<?php if($s_list['card_number']==$end_num['card_number']){ ?>
												<option selected value="<?php echo $s_list['c_id']; ?>"><?php echo $s_list['card_number']; ?></option>
											<?php }else{ ?>
												<option value="<?php echo $s_list['c_id']; ?>"><?php echo $s_list['card_number']; ?></option>
											<?php } ?>
										<?php } ?>
									</select>
								</div>
								
								
								
								</div>
								<br>
								<div class="">
								<label>&nbsp;</label>
								<button type="submit" class="btn btn-sm btn-success pull-right" type="button">Update assign</button>
								</div>	
							
							</form>
											
											 </div>
											
									
										
                                    
								</div>
							</div>
						</div>
					</div>
                    </div>
                    </div>
<script>
$(document).ready(function() {
    $('#assign_seller').bootstrapValidator({
        
        fields: {
            
            seller_id: {
                 validators: {
					notEmpty: {
						message: 'Seller Name is required'
					}
				}
            },
			 card_number_from: {
                validators: {
					notEmpty: {
						message: 'Card Numbers From is required'
					}
				
				}
            },card_number_to: {
                   validators: {
					 notEmpty: {
						message: 'Card Numbers To is required'
					}
				}
				}
            }
        })
     
});

</script>