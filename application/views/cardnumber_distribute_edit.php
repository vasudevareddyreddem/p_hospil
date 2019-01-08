<?php //echo '<pre>';print_r($admin_detail);exit; ?>

<div class="page-content-wrapper">
                <div class="page-content" >
						<div class="page-bar">
						  <div class="page-title-breadcrumb">
							 <div class=" pull-left">
								<div class="page-title">Profile Edit</div>
							 </div>
							 <ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('admin/cardnumber_distribute/'.base64_encode(1)); ?>">
								Card Number distribute
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
										
											 <form id="edit_seller" name="edit_seller" action="<?php echo base_url('admin/cardnumbersellereditpost'); ?>" method="POST" enctype="multipart/form-data">
													 
													 <input type="hidden" name="s_id" id="s_id" value="<?php echo isset($seller_details['s_id'])?$seller_details['s_id']:''; ?>">
													 <div class="row">
												<div class="form-group col-md-6">
												   <label for="email">Name</label>
												   <input type="text" id="name" name="name" value="<?php echo isset($seller_details['name'])?$seller_details['name']:''; ?>" class="form-control"  placeholder="Enter Name" >
												</div>
												<div class="form-group col-md-6">
												   <label for="email">Email Id</label>
												   <input type="text" id="email_id" name="email_id" value="<?php echo isset($seller_details['email_id'])?$seller_details['email_id']:''; ?>"  class="form-control"  placeholder="Enter Email Id" >
												</div>
												<div class="form-group col-md-6">
												   <label for="email">Mobile Number</label>
												   <input type="text" id="mobile" name="mobile" value="<?php echo isset($seller_details['mobile'])?$seller_details['mobile']:''; ?>" class="form-control"  placeholder="Enter Mobile Number" >
												</div>
												
												<div class="col-md-6">
													<label> Address</label>
												<input class="form-control" id="address" name="address" value="<?php echo isset($seller_details['address'])?$seller_details['address']:''; ?>" type="text" placeholder="Address">
												</div>
												<div class="col-md-6">
													<label> Bank Account Number</label>
													<input class="form-control" id="bank_account" name="bank_account" value="<?php echo isset($seller_details['bank_account'])?$seller_details['bank_account']:''; ?>" type="text" placeholder="Bank Account Number">
												</div>
												<div class="col-md-6">
													<label> Bank Name</label>
													<input class="form-control" id="bank_name" name="bank_name" value="<?php echo isset($seller_details['bank_name'])?$seller_details['bank_name']:''; ?>" type="text" placeholder="Bank Name">
												</div>
												<div class="col-md-6">
													<label> Bank Ifsc Code</label>
													<input class="form-control" id="ifsccode" name="ifsccode" value="<?php echo isset($seller_details['ifsccode'])?$seller_details['ifsccode']:''; ?>" type="text" placeholder="Bank Ifsc Code">
												</div>
												<div class="col-md-6">
													<label> Bank Account Holder Name</label>
													<input class="form-control" id="bank_holder_name" name="bank_holder_name" value="<?php echo isset($seller_details['bank_holder_name'])?$seller_details['bank_holder_name']:''; ?>" type="text" placeholder="Bank Account Holder Name">
												</div>
												<div class="col-md-6">
													<label> Kyc</label>
													<input class="form-control" id="kyc" name="kyc" value="" type="file" >
													<?php if($seller_details['kyc']!=''){ ?>
												<a target="_blank" href="<?php echo base_url('assets/cardnumbers_sellers/'.$seller_details['kyc']); ?>">Download</a>
												<?php } ?>
												</div>
												<div class="form-group col-md-6">
												   <label for="email">Profile Pic</label>
												   <input type="file" id="image" name="image"   class="form-control"  >
												   	<?php if($seller_details['profile_pic']!=''){ ?>
												<img height="100px" width="100px" src="<?php echo base_url('assets/adminprofilepic/'.$seller_details['profile_pic']); ?>">
												<?php } ?>
												</div>
											
												</div>
												
												<div class="form-actions">
													<div class="row">
													   <div class="offset-md-11 col-md-1">
														  <button type="submit" class="btn btn-info">Update</button>
													   </div>
													</div>
												 </div>
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
    $('#edit_seller').bootstrapValidator({
        
        fields: {
            
            name: {
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
			 mobile: {
                validators: {
					notEmpty: {
						message: 'Mobile Number is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'Mobile number must be 10 to 14 digits'
					}
				
				}
            },email_id: {
                validators: {
					notEmpty: {
						message: 'Email is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
					message: 'Please enter a valid email address. For example johndoe@domain.com.'
					}
				}
            },
			address: {
                 validators: {
					notEmpty: {
						message: 'Address is required'
					},
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address wont allow <> [] = % '
					}
                }
            },bank_name: {
                 validators: {
					
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Bank Account Number wont allow <> [] = % '
					}
                }
            },bank_holder_name: {
                 validators: {
					
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Bank Account Holder Name wont allow <> [] = % '
					}
                }
            },bank_account:
          {
            validators: 
            {
				
              regexp: 
              {
					     regexp:  /^[0-9]{9,16}$/,
					     message:'Bank Account  must be 9 to 16 digits'
					    }
            }
          },
         account_name: {
          validators: {
					
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Account Name can only consist of alphanumaric, space and dot'
					}
				}
        }, 
		ifsccode: {
          validators: {
					
					regexp: {
					 regexp: /^[A-Za-z0-9]{4}\d{7}$/,
					 message: 'IFSC Code must be alphanumaric'
					}
				}
        },
		image: {
			validators: {

				regexp: {
				regexp: /\.(jpe?g|png|gif)$/i,
				message: 'Uploaded file is not a valid image. Only JPG,PNG and GIF files are allowed'
				}
			}
		},
			kyc: {
                   validators: {
					  
					 regexp: {
					regexp: /\.(jpe?g|png|gif|pdf|doc|docx)$/i,
					message: 'Uploaded file is not a valid image. Only pdf,doc,docx,JPG,PNG and GIF files are allowed'
					}
				}
            }
            }
        })
     
});

</script>