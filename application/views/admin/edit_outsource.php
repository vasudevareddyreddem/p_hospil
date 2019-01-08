<?php //echo '<pre>';print_r($lab_detils);exit; ?>
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Edit Out Source Lab Details</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Edit Out Source Lab Details</li>
            </ol>
         </div>
      </div>
         <div class="panel tab-border card-topline-green">
            
            <div class="panel-body">
               <div class="tab-content">
                  <div class="tab-pane active" id="home">
				  <div class="container">
                     <div class="row">
					  <form action="<?php echo base_url('admin/editlab'); ?>" method="post" id="addlab" name="addlab" enctype="multipart/form-data">
						<input type="hidden" name="lab_id" name="lab-id" value="<?php echo isset($lab_detils['r_id'])?$lab_detils['r_id']:''; ?>">                    
					   <div class="col-md-12 ">
                           
						  
                              <div class="row">
                                 <div class="col-md-6">
									<label> Name</label>
										<input class="form-control" id="lab_name" name="lab_name"  type="text" placeholder="Name" value="<?php echo isset($lab_detils['resource_name'])?$lab_detils['resource_name']:''; ?>" >
									</div>
									<div class="col-md-6">
									<label> Mobile Number</label>
										<input class="form-control" id="lab_mobile" name="lab_mobile"  type="text" placeholder=" Mobile Number" value="<?php echo isset($lab_detils['resource_mobile'])?$lab_detils['resource_mobile']:''; ?>">
									</div>
									<div class="col-md-6">
										<label> Address1</label>
											<textarea type="textarea" id="lab_add1" name="lab_add1"  class="form-control"  placeholder="Address1" ><?php echo isset($lab_detils['resource_add1'])?$lab_detils['resource_add1']:''; ?></textarea>
									</div>
										<div class="col-md-6">
										<label> Address2</label>
											<textarea type="textarea" id="lab_add2" name="lab_add2"  class="form-control"  placeholder="Address2" ><?php echo isset($lab_detils['resource_add2'])?$lab_detils['resource_add2']:''; ?></textarea>
									</div>
									
									<div class="col-md-6">
									<label> City</label>
										<input class="form-control" id="lab_city" name="lab_city"  type="text" placeholder="City" value="<?php echo isset($lab_detils['resource_city'])?$lab_detils['resource_city']:''; ?>">
									</div>
										<div class="col-md-6">
										<label> State</label>
<?php $states = array ('Andhra Pradesh' => 'Andhra Pradesh', 'Arunachal Pradesh' => 'Arunachal Pradesh', 'Assam' => 'Assam', 'Bihar' => 'Bihar', 'Chhattisgarh' => 'Chhattisgarh', 'Goa' => 'Goa', 'Gujarat' => 'Gujarat', 'Haryana' => 'Haryana', 'Himachal Pradesh' => 'Himachal Pradesh', 'Jammu & Kashmir' => 'Jammu & Kashmir', 'Jharkhand' => 'Jharkhand', 'Karnataka' => 'Karnataka', 'Kerala' => 'Kerala', 'Madhya Pradesh' => 'Madhya Pradesh', 'Maharashtra' => 'Maharashtra', 'Manipur' => 'Manipur', 'Meghalaya' => 'Meghalaya', 'Mizoram' => 'Mizoram', 'Nagaland' => 'Nagaland', 'Odisha' => 'Odisha', 'Punjab' => 'Punjab', 'Rajasthan' => 'Rajasthan', 'Sikkim' => 'Sikkim', 'Tamil Nadu' => 'Tamil Nadu', 'Telangana' => 'Telangana', 'Tripura' => 'Tripura', 'Uttarakhand' => 'Uttarakhand','Uttar Pradesh' => 'Uttar Pradesh', 'West Bengal' => 'West Bengal', 'Andaman & Nicobar' => 'Andaman & Nicobar', 'Chandigarh' => 'Chandigarh', 'Dadra and Nagar Haveli' => 'Dadra and Nagar Haveli', 'Daman & Diu' => 'Daman & Diu', 'Delhi' => 'Delhi', 'Lakshadweep' => 'Lakshadweep', 'Puducherry' => 'Puducherry'); ?>
								  <select class="form-control" required="required" name="lab_state" id="lab_state">
								  <option value = "">Select State</option>
									<?php foreach($states as $key=>$state):
											if($lab_detils['resource_state'] == $state):
											$selected ='selected=selected';
											else : 
											$selected = '';
											endif;
										 ?>
										<option value = "<?php echo $state?>" <?php echo $selected;?> ><?php echo $state?></option>
									<?php endforeach; ?>
								  </select>									</div>
									<div class="col-md-6">
										<label> Zipcode</label>
										<input class="form-control" id="lab_zipcode" name="lab_zipcode"  type="text" placeholder="Zipcode" value="<?php echo isset($lab_detils['resource_zipcode'])?$lab_detils['resource_zipcode']:''; ?>">
									</div>
										<div class="col-md-6">
										<label> Other Details</label>
										<input class="form-control" id="lab_other_details" name="lab_other_details"  type="text" placeholder="Other Details" value="<?php echo isset($lab_detils['resource_other_details'])?$lab_detils['resource_other_details']:''; ?>">
									</div>
									 	<div class="col-md-6">
									<label> Lab Contact Number</label>
										<input class="form-control" id="lab_contatnumber" name="lab_contatnumber" type="text" placeholder="Lab Contact Number" value="<?php echo isset($lab_detils['resource_contatnumber'])?$lab_detils['resource_contatnumber']:''; ?>">
									</div>
										
									<div class="col-md-6">
									<label> Lab Email ID</label>
										<input class="form-control" id="lab_email" name="lab_email" type="text" placeholder="Lab Email ID" value="<?php echo isset($lab_detils['resource_email'])?$lab_detils['resource_email']:''; ?>">
									</div>
										
									<div class="col-md-6">
									<label> Lab Photo</label>
										<input class="form-control" id="lab_photo" name="lab_photo" type="file" placeholder="lab Photo">
									</div>
									<?php if(isset($lab_detils['resource_photo']) && $lab_detils['resource_photo']!=''){ ?>
									<div class="col-md-6" style="padding:20px;">
									<label> Lab Photo</label>
									 <img width="50px" height="50px" src="<?php echo base_url('assets/adminprofilepic/'.$lab_detils['resource_photo']); ?>">

									</div>
									<?php } ?>
									
                              </div>
                           </div>
                           <div class="clearfix">&nbsp;</div>
						   <div class="col-sm-10">
                           <button type="submit" class="btn btn-sm btn-success pull-right" type="button">Update Lab</button>
                           </div><div class="clearfix">&nbsp;</div>
                        </div>
						</form>
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
    $('#addlab').bootstrapValidator({
        
        fields: {
            
            lab_name: {
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
			 lab_mobile: {
                validators: {
					notEmpty: {
						message: 'landline Number is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'landline Number must be 10 to 14 digits'
					}
				
				}
            },lab_contatnumber: {
              validators: {
					notEmpty: {
						message: 'Contact Number is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'Contact Number must be 10 to 14 digits'
					}
				
				}
            },lab_email: {
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
			lab_password: {
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
           
            lab_cinformpaswword: {
					 validators: {
						 notEmpty: {
						message: 'Confirm Password is required'
					},
					identical: {
						field: 'lab_password',
						message: 'password and confirm Password do not match'
					}
					}
				},
			lab_add1: {
                 validators: {
					notEmpty: {
						message: 'Address1 is required'
					},
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address wont allow <> [] = % '
					}
                }
            },lab_add2: {
                 validators: {
					notEmpty: {
						message: 'Address1 is required'
					},
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address wont allow <> [] = % '
					}
                }
            },
			 lab_city: {
                 validators: {
					notEmpty: {
						message: 'City is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'City can only consist of alphanumeric, space and dot'
					}
				
				}
            }, lab_state: {
                  validators: {
					notEmpty: {
						message: 'State is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'State can only consist of alphanumeric, space and dot'
					}
				
				}
            },lab_zipcode: {
                  validators: {
					notEmpty: {
						message: 'Zipcode is required'
					},
					stringLength: {
                        max: 7,
                        message: 'Zipcode  must be less than 7 characters'
                    },
					regexp: {
					regexp: /^[0-9]{5,7}$/,
					message: 'Zipcode  must be  5 to 7 characters'
					}
				}
            },lab_photo: {
                   validators: {
					 regexp: {
					regexp: /\.(jpe?g|png|gif)$/i,
					message: 'Uploaded file is not a valid image. Only JPG, PNG and GIF files are allowed'
					}
				}
            }
            }
        })
     
});
</script>