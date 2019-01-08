<?php //echo '<pre>';print_r($hospital_details);exit; ?>
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Edit Executive</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Edit Executive</li>
            </ol>
         </div>
      </div>
   
         <div class="panel tab-border card-topline-green">
            <header class="panel-heading panel-heading-gray custom-tab ">
               <ul class="nav nav-tabs">
                  <li class="nav-item"><a href="#home" data-toggle="tab" class="active">Edit Executive</a>
                  </li>
                 
               </ul>
            </header>
            <div class="panel-body">
               <div class="tab-content">
                  <div class="tab-pane active" id="home">
				  <div class="container">
                     
					 <form id="defaultForm" method="post" class="" action="<?php echo base_url('Executive/edit_indexpost');  ?>"  enctype="multipart/form-data">
					 	<input type="hidden" id="e_id" name="e_id" value="<?php echo $edit_executive_list['e_id'] ?>">
								<div class="row">
								<div class="col-md-6">
									<label> Name</label>
								<input class="form-control" id="name" name="name" type="text" placeholder=" Enter Name" value="<?php echo isset($edit_executive_list['name'])?$edit_executive_list['name']:''; ?>">
								</div>
								
								<div class="col-md-6">
									<label>Mobile</label>
								<input class="form-control" id="mobile" name="mobile" type="text" placeholder="Enter Mobile" value="<?php echo isset($edit_executive_list['mobile'])?$edit_executive_list['mobile']:''; ?>">
								</div>
								<div class="col-md-6">
									<label>Email Address</label>
								<input class="form-control" id="email_id" name="email_id"  type="text" placeholder=" Enter Email Address" value="<?php echo isset($edit_executive_list['email_id'])?$edit_executive_list['email_id']:''; ?>">
								</div>
								
								
								<div class="col-md-6">
									<label> Address</label>
								<input class="form-control" id="address" name="address"  type="text" placeholder="Enter Address" value="<?php echo isset($edit_executive_list['address'])?$edit_executive_list['address']:''; ?>">
								</div>
								<div class="col-md-6">
									<label> Bank Account Number</label>
									<input class="form-control" id="bank_account" name="bank_account"  type="text" placeholder="Enter Bank Account Number" value="<?php echo isset($edit_executive_list['bank_account'])?$edit_executive_list['bank_account']:''; ?>">
								</div>
								<div class="col-md-6">
									<label> Bank Name</label>
									<input class="form-control" id="bank_name" name="bank_name"  type="text" placeholder="Enter Bank Name" value="<?php echo isset($edit_executive_list['bank_name'])?$edit_executive_list['bank_name']:''; ?>">
								</div>
								<div class="col-md-6">
									<label> Bank Ifsc Code</label>
									<input class="form-control" id="ifsccode" name="ifsccode"  type="text" placeholder="Enter Bank Ifsc Code" value="<?php echo isset($edit_executive_list['ifsccode'])?$edit_executive_list['ifsccode']:''; ?>">
								</div>
								<div class="col-md-6">
									<label> Bank Account Holder Name</label>
									<input class="form-control" id="bank_holder_name" name="bank_holder_name"  type="text" placeholder="Enter Bank Account Holder Name" value="<?php echo isset($edit_executive_list['bank_holder_name'])?$edit_executive_list['bank_holder_name']:''; ?>">
								</div>
								<div class="col-md-6">
									<label> Kyc</label>
									<input class="form-control" id="kyc" name="kyc" type="file" placeholder="Bank Account Holder Name" value="<?php echo isset($edit_executive_list['kyc'])?$edit_executive_list['kyc']:''; ?>">
								</div>
								
								
								<div class="col-md-6">
									<label>Location</label>
									<input class="form-control" id="location" name="location" type="text" placeholder="Enter Location" value="<?php echo isset($edit_executive_list['location'])?$edit_executive_list['location']:''; ?>">
								</div>
									<div class="form-group">
                            <label class=" control-label">Profile Image</label>
							<input type="file" id="profile_pic" name="profile_pic" class="form-control">
                        </div> 
								</div><br>
								<div class="">
								<label>&nbsp;</label>
								<button type="submit" class="btn btn-sm btn-success pull-right" type="button">Update</button>
								</div>	
							
							</form>
						
					
                     </div>
                  </div>
                  <div class="tab-pane" id="about">
                     <div class="container">
                        <div class="row">
                            <div class="col-md-12">
							
                            <div class="card card-topline-aqua">
                                
								<div class="clearfix">&nbsp;</div>
                                <div class="text-center">
                                    <div class="col-md-12">
                                        <a href="financial.php" class="btn btn-info">Save</a>
                                        <a href="#"type="button" class="btn btn-default">Cancel</a>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                       
                     </div>
                  </div>
               </div>
            </div>
            <div class="clearfix">&nbsp;</div>
       
      </div>
   </div>
</div>


 <script>
$(document).ready(function() {
 
   $('#defaultForm').bootstrapValidator({
//       
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
			
            email_id: {
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
			mobile: {
                 validators: {
					notEmpty: {
						message: 'Mobile Number is required'
					},
					regexp: {
					regexp:  /^[0-9]{10}$/,
					message:'Mobile Number must be 10 digits'
					}
				
				}
            },
			password: {
                validators: {
					notEmpty: {
						message: 'Password is required'
					},
					stringLength: {
                        min: 6,
                        message: 'Password  must be at least 6 characters'
                    },
					regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~'"\\|=^?$%*)(_+-]*$/,
					message: 'Password wont allow <>[]'
					}
				}
            },
           
           org_password: {
					 validators: {
						 notEmpty: {
						message: 'Confirm Password is required'
					},
					identical: {
						field: 'password',
						message: 'password and confirm Password do not match'
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
            },
			
			bank_account: {
                 validators: 
					{
					    
						regexp: 
						{
					     regexp:  /^[0-9]{9,16}$/,
					     message:'Bank Account  must be 9 to 16 digits'
					    }
				}
            },
			
			bank_name: {
                 validators: {
					
					regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:' Name of the bank wont allow <> [] = % '
					}
				
				}
            },
			
			ifsccode: {
                 validators: {
					
					regexp: {
					 regexp: /^[A-Za-z0-9]{4}\d{7}$/,
					message: 'IFSC Code must be alphanumeric'
					}
				}
            },
			bank_holder_name:{
			 validators: {
					
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'Bank Holder Name can only consist of alphabets and space'
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
            },
			location:{
			validators: {
					notEmpty: {
						message: 'location is required'
					}
				}
            },
			profile_pic: {
                validators: {
					regexp: {
					regexp: "(.*?)\.(png|jpeg|jpg|gif)$",
					message: 'Uploaded file is not a valid. Only png,jpg,jpeg,gif files are allowed'
					}
				}
            }
		   
			
        }
    });
    // Validate the form manually
    $('#validateBtn').click(function() {
        $('#defaultForm').bootstrapValidator('validate');
    });

    $('#resetBtn').click(function() {
        $('#defaultForm').data('bootstrapValidator').resetForm(true);
    });
	
});


</script>