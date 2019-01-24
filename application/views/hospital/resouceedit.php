<?php //echo '<pre>';print_r($userdetails);exit; ?>
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
           
		<?php if($userdetails['role_id']==2){ ?>
		 <div class=" pull-left">
               <div class="page-title">Edit <?php echo isset($resouse_detail['resource_name'])?$resouse_detail['resource_name']:''; ?> Details</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li> <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('hospital/resource/'.base64_encode(1)); ?>">Resourse List</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Edit Resourse</li>
            </ol>
		<?php }elseif($userdetails['role_id']==3 ||$userdetails['role_id']==4 || $userdetails['role_id']==5 || $userdetails['role_id']==6){ ?>
			 <div class=" pull-left">
               <div class="page-title">Edit Profile Details</div>
            </div>
			<ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li> <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('profile'); ?>">profile</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Edit  profile</li>
            </ol>
		<?php } ?>
         </div>
      </div>
      <div class="row">
         <div class="panel tab-border card-topline-green">
           
            <div class="panel-body">
               <div class="tab-content">
			   <div class="">
                     <div class="row">
					  <form action="<?php echo base_url('hospital/resourceditepost'); ?>" method="post" id="addresource" name="addresource" enctype="multipart/form-data">
                        <div class="col-md-12 ">
                           
						  		<input  type="hidden" class="form-control" id="resource_id" name="resource_id" value="<?php echo isset($resouse_detail['r_id'])?$resouse_detail['r_id']:''; ?>">
						  		<input  type="hidden" class="form-control" id="admin_id" name="admin_id" value="<?php echo isset($resouse_detail['a_id'])?$resouse_detail['a_id']:''; ?>">

                              <div class="row">
							  <?php if($userdetails['role_id']==2){ ?>
									  <?php if($resouse_detail['role_id']==6){ ?>
											<div class="col-md-6">
											<label> Resource Designation</label>
											<select class="form-control" id="designation" name="designation">
												<option value="6" <?php if($resouse_detail['role_id']==6){ echo "selected"; }?> >Doctor</option>
												
											</select>
											</div>
									  <?php }else{ ?>
											<div class="col-md-6">
												<label> Resource Designation</label>
												<select class="form-control" id="designation" name="designation">
													<option value="">Select</option>
												<option value="3" <?php if($resouse_detail['role_id']==3){ echo "selected";} ?>>Receptionist</option>
													<option value="4" <?php if($resouse_detail['role_id']==4){ echo "selected";}?>>Pharmacy</option>
													<option value="5" <?php if($resouse_detail['role_id']==5){ echo "selected"; }?>>lab coordinator</option>
													<option value="9" <?php if($resouse_detail['role_id']==9){ echo "selected"; }?>>Ward management</option>
													<option value="10" <?php if($resouse_detail['role_id']==10){ echo "selected"; }?>>Nurse</option>
													
												</select>
											</div>
									  <?php } ?>
								<?php }else{ ?>
										<input type="hidden" id="designation" name="designation" value="<?php echo $resouse_detail['role_id']; ?>">
								<?php }	 ?>	
                               <div class="col-md-6">
									<label> Name</label>
										<input class="form-control" id="resource_name" name="resource_name" value="<?php echo isset($resouse_detail['resource_name'])?$resouse_detail['resource_name']:''; ?>" type="text" placeholder="Name">
									</div>
									<div class="col-md-6">
									<label> Mobile Number</label>
										<input class="form-control" id="resource_mobile" name="resource_mobile" value="<?php echo isset($resouse_detail['resource_mobile'])?$resouse_detail['resource_mobile']:''; ?>" type="text" placeholder=" Mobile Number">
									</div>
									<div class="col-md-6">
										<label> Address1</label>
											<textarea type="textarea" id="resource_add1" name="resource_add1"  class="form-control"  placeholder="Address1" ><?php echo isset($resouse_detail['resource_add1'])?$resouse_detail['resource_add1']:''; ?></textarea>
									</div>
									<div class="col-md-6">
										<label> Address2</label>
											<textarea type="textarea" id="resource_add2" name="resource_add2"  class="form-control"  placeholder="Address2" ><?php echo isset($resouse_detail['resource_add2'])?$resouse_detail['resource_add2']:''; ?></textarea>
									</div>
									
									<div class="col-md-6">
									<label> City</label>
										<input class="form-control" id="resource_city" name="resource_city" value="<?php echo isset($resouse_detail['resource_city'])?$resouse_detail['resource_city']:''; ?>" type="text" placeholder="City">
									</div>
									<div class="col-md-6">
										<label> State</label>
										<?php $states = array ('Andhra Pradesh' => 'Andhra Pradesh', 'Arunachal Pradesh' => 'Arunachal Pradesh', 'Assam' => 'Assam', 'Bihar' => 'Bihar', 'Chhattisgarh' => 'Chhattisgarh', 'Goa' => 'Goa', 'Gujarat' => 'Gujarat', 'Haryana' => 'Haryana', 'Himachal Pradesh' => 'Himachal Pradesh', 'Jammu & Kashmir' => 'Jammu & Kashmir', 'Jharkhand' => 'Jharkhand', 'Karnataka' => 'Karnataka', 'Kerala' => 'Kerala', 'Madhya Pradesh' => 'Madhya Pradesh', 'Maharashtra' => 'Maharashtra', 'Manipur' => 'Manipur', 'Meghalaya' => 'Meghalaya', 'Mizoram' => 'Mizoram', 'Nagaland' => 'Nagaland', 'Odisha' => 'Odisha', 'Punjab' => 'Punjab', 'Rajasthan' => 'Rajasthan', 'Sikkim' => 'Sikkim', 'Tamil Nadu' => 'Tamil Nadu', 'Telangana' => 'Telangana', 'Tripura' => 'Tripura', 'Uttarakhand' => 'Uttarakhand','Uttar Pradesh' => 'Uttar Pradesh', 'West Bengal' => 'West Bengal', 'Andaman & Nicobar' => 'Andaman & Nicobar', 'Chandigarh' => 'Chandigarh', 'Dadra and Nagar Haveli' => 'Dadra and Nagar Haveli', 'Daman & Diu' => 'Daman & Diu', 'Delhi' => 'Delhi', 'Lakshadweep' => 'Lakshadweep', 'Puducherry' => 'Puducherry'); ?>
								  <select class="form-control" required="required" name="resource_state" id="resource_state">
								  <option value = "">Select State</option>
									<?php foreach($states as $key=>$state):
											if($resouse_detail['resource_state'] == $state):
											$selected ='selected=selected';
											else : 
											$selected = '';
											endif;
									 ?>
										<option value = "<?php echo $state?>" <?php echo $selected;?> ><?php echo $state?></option>
									<?php endforeach; ?>
								  </select>
									</div>
									
									<div class="col-md-6">
										<label> Zipcode</label>
										<input class="form-control" id="resource_zipcode" name="resource_zipcode" value="<?php echo isset($resouse_detail['resource_zipcode'])?$resouse_detail['resource_zipcode']:''; ?>" type="text" placeholder="State">
									</div>
									 <div class="col-md-6">
									<label> Alternative Contact Number</label>
										<input class="form-control" id="resource_contatnumber" name="resource_contatnumber" type="text" value="<?php echo isset($resouse_detail['resource_contatnumber'])?$resouse_detail['resource_contatnumber']:''; ?>" placeholder="Alternative Contact Number">
									</div>
									<?php if($resouse_detail['role_id']==6){ ?>
									<div class="col-md-6">
										<label>In Time</label>
										<?php $time_list=array("06:00 am","06:30 am","07:00 am","07:30 am","08:00 am","08:30 am","09:00 am","09:30 am","10:00 am","10:30 am","11:00 am","11:30 am","12:00 pm","12:30 pm","01:00 pm","01:30 pm","02:00 pm","02:30 pm","03:00 pm","03:30 pm","04:00 pm","04:30 pm","05:00 pm","05:30 pm","06:00 pm","06:30 pm","07:00 pm","07:30 pm","08:00 pm","08:30 pm","09:00 pm","09:30 pm","10:00 pm","10:30 pm","11:00 pm","11:30 pm","12:00 am","12:30 am","1:00 am","1:30 am","2:00 am","2:30 am","3:00 am","3:30 am","4:00 am","4:30 am","5:00 am","5:30 am"); ?>
										<select class="form-control" id="in_time" name="in_time">
										<option value="">Select</option>
										<?php foreach($time_list as $key=>$list):
                                       if($resouse_detail['in_time'] == $list):
                                                $selected ='selected=selected';
                                                else : 
                                                $selected = '';
                                                endif;
                                        ?>
											<option value="<?php echo $list; ?>"<?php echo $selected;?> ><?php echo $list; ?></option>
										<?php endforeach; ?>
										</select>
                                    </div>
								    <?php } ?>
									<?php if($resouse_detail['role_id']==6){ ?> 
									<div class="col-md-6">
										<label>Out Time</label>
										<?php $time_list=array("06:00 am","06:30 am","07:00 am","07:30 am","08:00 am","08:30 am","09:00 am","09:30 am","10:00 am","10:30 am","11:00 am","11:30 am","12:00 pm","12:30 pm","01:00 pm","01:30 pm","02:00 pm","02:30 pm","03:00 pm","03:30 pm","04:00 pm","04:30 pm","05:00 pm","05:30 pm","06:00 pm","06:30 pm","07:00 pm","07:30 pm","08:00 pm","08:30 pm","09:00 pm","09:30 pm","10:00 pm","10:30 pm","11:00 pm","11:30 pm","12:00 am","12:30 am","1:00 am","1:30 am","2:00 am","2:30 am","3:00 am","3:30 am","4:00 am","4:30 am","5:00 am","5:30 am"); ?>
										<select class="form-control" id="out_time" name="out_time">
										<option value="">Select</option>
										<?php foreach($time_list as $key=>$list):
                                         if(isset($resouse_detail['out_time']) && $resouse_detail['out_time'] == $list):
                                                $selected ='selected=selected';
                                                else : 
                                                $selected = '';
                                                endif;
                                        ?>
											<option value="<?php echo $list; ?>"<?php echo $selected;?> ><?php echo $list; ?></option>
										<?php endforeach; ?>
										</select>
                                    </div>
									<div class="col-md-6">
											<label> Consultation Fee</label>
												<input class="form-control" id="consultation_fee" name="consultation_fee" type="text" placeholder="consultation fee" value="<?php echo isset($resouse_detail['consultation_fee'])?$resouse_detail['consultation_fee']:''; ?>">
											</div>
									<?php } ?>
									<div class="col-md-6">
									<label> Resource Email ID</label>
										<input class="form-control" id="resource_email" name="resource_email" value="<?php echo isset($resouse_detail['resource_email'])?$resouse_detail['resource_email']:''; ?>" type="text" placeholder="Resource Email ID">
									</div>
										<div class="col-md-6">
									<label> Resource Photo</label>
										<input class="form-control" id="resource_photo" name="resource_photo" type="file"  placeholder="Resource Photo">
									</div>
									
									<?php if($userdetails['out_source']!=1){ ?>
										<div class="col-md-6">
									<label> Resource Document</label>
										<input class="form-control" id="resource_document" name="resource_document" type="file" placeholder="Resource Document">
									</div>
										<div class="col-md-6">
									<label> Resource Bank Holder Name</label>
										<input class="form-control" id="resource_bank_holdername" name="resource_bank_holdername" type="text" value="<?php echo isset($resouse_detail['resource_bank_holdername'])?$resouse_detail['resource_bank_holdername']:''; ?>"  placeholder="Resource Bank Holder Name">
									</div>
										<div class="col-md-6">
									<label> Resource Bank Acc Number</label>
										<input class="form-control" id="resource_bank_accno" name="resource_bank_accno" type="text" value="<?php echo isset($resouse_detail['resource_bank_accno'])?$resouse_detail['resource_bank_accno']:''; ?>"  placeholder="Resource Bank Acc Number">
									</div>
										<div class="col-md-6">
									<label> Resource Bank IFSC Code</label>
										<input class="form-control" id="resource_ifsc_code" name="resource_ifsc_code" type="text" value="<?php echo isset($resouse_detail['resource_ifsc_code'])?$resouse_detail['resource_ifsc_code']:''; ?>"   placeholder="Resource Bank IFSC Code">
									</div>
									
										<div class="col-md-6">
									<label> Resource Upload Any document</label>
										<input class="form-control" id="resource_other_document" name="resource_other_document" type="file"  placeholder="Resource Photo">
									</div>
									<?php } ?>
                              </div>
                           </div>
                           <div class="clearfix">&nbsp;</div>
						   <div class="col-sm-12">
                           <button type="submit" class="btn btn-sm btn-success pull-right" type="button">Update Resource</button>
                           </div><div class="clearfix">&nbsp;</div>
                        </div>
						</form>
                     </div>
                 
               </div>
            </div>
            <div class="clearfix">&nbsp;</div>
         </div>
      </div>
   </div>
</div>
<script>
$(document).ready(function() {
    $('#addresource').bootstrapValidator({
        
        fields: {
            
            resource_name: {
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
			consultation_fee: {
                 validators: {
					notEmpty: {
						message: 'Consultation fee is required'
					},
					regexp: {
					regexp: /^[0-9. ]+$/,
					message: 'Consultation fee can only consist of digits space and dot'
					}
				}
            },
			 resource_mobile: {
                validators: {
					notEmpty: {
						message: 'landline Number is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'landline Number must be 10 to 14 digits'
					}
				
				}
            },resource_contatnumber: {
              validators: {
					
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'Contact Number must be 10 to 14 digits'
					}
				
				}
            },designation: {
              validators: {
					notEmpty: {
						message: 'Select a Designation'
					}
				
				}
            },resource_email: {
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
			resource_password: {
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
           
            resource_cinformpaswword: {
					 validators: {
						 notEmpty: {
						message: 'Confirm Password is required'
					},
					identical: {
						field: 'resource_password',
						message: 'password and confirm Password do not match'
					}
					}
				},
			resource_add1: {
                 validators: {
					notEmpty: {
						message: 'Address1 is required'
					},
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address1 wont allow <> [] = % '
					}
                }
            },resource_add2: {
                 validators: {
					
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address1 wont allow <> [] = % '
					}
                }
            },
			 resource_city: {
                 validators: {
					notEmpty: {
						message: 'City is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'City can only consist of alphanumeric, space and dot'
					}
				
				}
            }, resource_state: {
                  validators: {
					notEmpty: {
						message: 'State is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'State can only consist of alphanumeric, space and dot'
					}
				
				}
            },resource_zipcode: {
                  validators: {
					notEmpty: {
						message: 'Zipcode is required'
					},
					regexp: {
					regexp: /^[0-9]{5,7}$/,
					message: 'Zipcode  must be  5 to 7 characters'
					}
				}
            },resource_photo: {
                   validators: {
					 regexp: {
					regexp: /\.(jpe?g|png|gif)$/i,
					message: 'Uploaded file is not a valid image. Only JPG, PNG and GIF files are allowed'
					}
				}
            },resource_document: {
                   validators: {
					regexp: {
					regexp: "(.*?)\.(docx|doc|pdf|xlsx|xls)$",
					message: 'Uploaded file is not a valid. Only docx,doc,xlsx,pdf files are allowed'
					}
				}
            },resource_bank_holdername: {
                 validators: {
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Bank Holder Name can only consist of alphanumeric, space and dot'
					}
				}
            },resource_bank_accno: {
                validators: 
						{
						regexp:{
					     regexp:  /^[0-9]{9,16}$/,
					     message:'Bank Account  must be 9 to 16 digits'
					    }
					}
				},
				resource_ifsc_code: {
                validators: {
					regexp: {
					 regexp: /^[A-Za-z0-9]{4}\d{7}$/,
					 message: 'IFSC Code must be alphanumeric'
					}
				}
				},
				resource_other_document: {
                validators: {
					validators: {
					regexp: {
					regexp: "(.*?)\.(docx|doc|pdf|xlsx|xls)$",
					message: 'Uploaded file is not a valid. Only docx,doc,xlsx,pdf files are allowed'
					}
				}
				}
				},
			 resource_other_details: {
                  validators: {
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address1 wont allow <> [] = % '
					}
                }
            }
            }
        })
     
});
</script>