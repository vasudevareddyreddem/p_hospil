<?php //echo '<pre>';print_r($hospital_details);exit; ?>
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Doctors</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Doctors</li>
            </ol>
         </div>
      </div>
   
         <div class="panel tab-border card-topline-green">
            <header class="panel-heading panel-heading-gray custom-tab ">
               <ul class="nav nav-tabs">
                  <li class="nav-item"><a href="#home" data-toggle="tab" class="<?php if(isset($tab) && $tab ==''){ echo "active"; } ?>">Add Doctor</a>
                  </li>
                  <li class="nav-item"><a href="#about" data-toggle="tab" class="<?php if(isset($tab) && $tab ==1){ echo "active"; } ?>">Doctors List</a>
                  </li>
               </ul>
            </header>
            <div class="panel-body">
               <div class="tab-content">
                  <div class="tab-pane <?php if(isset($tab) && $tab ==''){ echo "active"; } ?>" id="home">
				  <div class="container">
                     <div class="row">
					  <form action="<?php echo base_url('hospital/resourcepost'); ?>" method="post" id="addresource" name="addresource" enctype="multipart/form-data">
                        <div class="col-md-12 ">
                           
						  
                              <div class="row">
							  <div class="col-md-4">
									<label> Resource Designation</label>
									<select class="form-control" id="designation" name="designation" >
										<option value="6">Doctor</option>
									</select>
									</div>
                                 <div class="col-md-4">
									<label> Name</label>
										<input class="form-control" autofocus="autofocus" id="resource_name" name="resource_name" value="" type="text" placeholder="Name">
									</div>
									<div class="col-md-4">
									<label> Mobile Number</label>
										<input class="form-control" id="resource_mobile" name="resource_mobile" value="" type="text" placeholder=" Mobile Number">
									</div>
									<div class="col-md-4">
										<label> Address1</label>
                                        <textarea type="textarea" id="resource_add1" name="resource_add1" value="" class="form-control"  placeholder="Address1" rows="1"></textarea>
									</div>
										<div class="col-md-4">
										<label> Address2</label>
                                            <textarea type="textarea" id="resource_add2" name="resource_add2" value="" class="form-control"  placeholder="Address2" rows="1"></textarea>
									</div>
									
									<div class="col-md-4">
									<label> City</label>
										<input class="form-control" id="resource_city" name="resource_city" value="" type="text" placeholder="City">
									</div>
								    <div class="col-md-4">
										<label> State</label>

												<div class="">
                                                    <?php $states = array ('Andhra Pradesh' => 'Andhra Pradesh', 'Arunachal Pradesh' => 'Arunachal Pradesh', 'Assam' => 'Assam', 'Bihar' => 'Bihar', 'Chhattisgarh' => 'Chhattisgarh', 'Goa' => 'Goa', 'Gujarat' => 'Gujarat', 'Haryana' => 'Haryana', 'Himachal Pradesh' => 'Himachal Pradesh', 'Jammu & Kashmir' => 'Jammu & Kashmir', 'Jharkhand' => 'Jharkhand', 'Karnataka' => 'Karnataka', 'Kerala' => 'Kerala', 'Madhya Pradesh' => 'Madhya Pradesh', 'Maharashtra' => 'Maharashtra', 'Manipur' => 'Manipur', 'Meghalaya' => 'Meghalaya', 'Mizoram' => 'Mizoram', 'Nagaland' => 'Nagaland', 'Odisha' => 'Odisha', 'Punjab' => 'Punjab', 'Rajasthan' => 'Rajasthan', 'Sikkim' => 'Sikkim', 'Tamil Nadu' => 'Tamil Nadu', 'Telangana' => 'Telangana', 'Tripura' => 'Tripura', 'Uttarakhand' => 'Uttarakhand','Uttar Pradesh' => 'Uttar Pradesh', 'West Bengal' => 'West Bengal', 'Andaman & Nicobar' => 'Andaman & Nicobar', 'Chandigarh' => 'Chandigarh', 'Dadra and Nagar Haveli' => 'Dadra and Nagar Haveli', 'Daman & Diu' => 'Daman & Diu', 'Delhi' => 'Delhi', 'Lakshadweep' => 'Lakshadweep', 'Puducherry' => 'Puducherry'); ?>
										 <select class="form-control" required="required" name="resource_state" id="resource_state">
											<option value = "">Select State</option>
												<?php foreach($states as $key=>$state):
                                            if(isset($resource_list['resource_state']) && $resource_list['resource_state'] == $state):
                                                $selected ='selected=selected';
                                                else : 
                                                $selected = '';
                                                endif;
                                                ?>
                                            <option value = "<?php echo $state?>" <?php echo $selected;?> ><?php echo $state?></option>
                                        <?php endforeach; ?>
                                      </select> 
                                      </div>		
                                      </div>
								    
									<div class="col-md-4">
										<label> Pin code</label>
										<input class="form-control" id="resource_zipcode" name="resource_zipcode" value="" type="text" placeholder="Pin code">
									</div>
										
									 <div class="col-md-4">
									<label> Alternative Contact Number</label>
										<input class="form-control" id="resource_contatnumber" name="resource_contatnumber" type="text" placeholder="Alternative Contact Number">
									</div>
									<div class="col-md-4">
										<label>In Time</label>
										<div class="">
										<?php $time_list=array("06:00 am","06:30 am","07:00 am","07:30 am","08:00 am","08:30 am","09:00 am","09:30 am","10:00 am","10:30 am","11:00 am","11:30 am","12:00 pm","12:30 pm","01:00 pm","01:30 pm","02:00 pm","02:30 pm","03:00 pm","03:30 pm","04:00 pm","04:30 pm","05:00 pm","05:30 pm","06:00 pm","06:30 pm","07:00 pm","07:30 pm","08:00 pm","08:30 pm","09:00 pm","09:30 pm","10:00 pm","10:30 pm","11:00 pm","11:30 pm","12:00 am","12:30 am","1:00 am","1:30 am","2:00 am","2:30 am","3:00 am","3:30 am","4:00 am","4:30 am","5:00 am","5:30 am"); ?>
										<select class="form-control" id="in_time" name="in_time">
										<option value="">Select</option>
										<?php foreach($time_list as $key=>$list):
                                            if(isset($resource_list['in_time']) && $resource_list['in_time'] == $list):
                                                $selected ='selected=selected';
                                                else : 
                                                $selected = '';
                                                endif;
                                         ?>
										 <option value="<?php echo $list; ?>"<?php echo $selected;?> ><?php echo $list; ?></option>
										 <?php endforeach; ?>
										 </select>
                                         </div>
									</div>
								    <div class="col-md-4">
										<label>Out Time</label>
										<div class="">
										<?php $time_list=array("06:00 am","06:30 am","07:00 am","07:30 am","08:00 am","08:30 am","09:00 am","09:30 am","10:00 am","10:30 am","11:00 am","11:30 am","12:00 pm","12:30 pm","01:00 pm","01:30 pm","02:00 pm","02:30 pm","03:00 pm","03:30 pm","04:00 pm","04:30 pm","05:00 pm","05:30 pm","06:00 pm","06:30 pm","07:00 pm","07:30 pm","08:00 pm","08:30 pm","09:00 pm","09:30 pm","10:00 pm","10:30 pm","11:00 pm","11:30 pm","12:00 am","12:30 am","1:00 am","1:30 am","2:00 am","2:30 am","3:00 am","3:30 am","4:00 am","4:30 am","5:00 am","5:30 am"); ?>
										<select class="form-control" id="out_time" name="out_time">
										<option value="">Select</option>
										<?php foreach($time_list as $key=>$list):
                                            if(isset($resource_list['out_time']) && $resource_list['out_time'] == $list):
                                                $selected ='selected=selected';
                                                else : 
                                                $selected = '';
                                                endif;
                                        ?>
										<option value="<?php echo $list; ?>"<?php echo $selected;?> ><?php echo $list; ?></option>
										<?php endforeach; ?>
										</select>
                                        </div>
									</div>
									<div class="col-md-4">
									<label> Resource Email ID</label>
										<input class="form-control" id="resource_email" name="resource_email" type="text" placeholder="Resource Email ID">
									</div>
										<div class="col-md-4">
									<label> Resource Password</label>
										<input class="form-control" id="resource_password" name="resource_password" type="password" placeholder="Password">
									</div>
										<div class="col-md-4">
									<label> Resource Confirm Password</label>
										<input class="form-control" id="resource_cinformpaswword" name="resource_cinformpaswword" type="password" placeholder="Confirm Password">
									</div>
										<div class="col-md-4">
									<label> Resource Photo</label>
										<input class="form-control" id="resource_photo" name="resource_photo" type="file" placeholder="Resource Photo">
									</div>
										<div class="col-md-4">
									<label> Resource Document</label>
										<input class="form-control" id="resource_document" name="resource_document" type="file" placeholder="Resource Document">
									</div>
										<div class="col-md-4">
									<label> Resource Bank Holder Name</label>
										<input class="form-control" id="resource_bank_holdername" name="resource_bank_holdername" type="text" placeholder="Resource Bank Holder Name">
									</div>
										<div class="col-md-4">
									<label> Resource Bank Acc Number</label>
										<input class="form-control" id="resource_bank_accno" name="resource_bank_accno" type="text" placeholder="Resource Bank Acc Number">
									</div>
										<div class="col-md-4">
									<label> Resource Bank IFSC Code</label>
										<input class="form-control" id="resource_ifsc_code" name="resource_ifsc_code" type="text" placeholder="Resource Bank IFSC Code">
									</div>
									
										<div class="col-md-4">
									<label> Resource Upload Any document</label>
										<input class="form-control" id="resource_other_document" name="resource_other_document" type="file" placeholder="Resource Photo">
									</div>
									<div class="col-md-4">
									<label> Consultation Fee</label>
										<input class="form-control" id="consultation_fee" name="consultation_fee" type="text" placeholder="consultation fee">
									</div>
                              </div>
                           </div>
                           <div class="clearfix">&nbsp;</div>
						   <div class="col-sm-10">
                           <button type="submit" class="btn btn-sm btn-success pull-right" type="button">Add Doctor</button>
                           </div>
                           <div class="clearfix">&nbsp;</div>
                        
						</form>
                      </div>
                     </div>
                  </div>
                  <div class="tab-pane <?php if(isset($tab) && $tab ==1){ echo "active"; } ?>" id="about">
                     <div class="container">
                        <div class="row">
                            <div class="card-body col-md-12 table-responsive">
								<?php if(count($resource_list)>0){ ?>
                                    <table id="example4" class="table table-striped table-bordered table-hover  order-column" style="width:100%;">
                                        <thead>
                                            <tr>
												<th>Role</th>
												<th>Name</th>
												<th>Email Address</th>
                                                <th>Contact Number </th>
                                                <th>Create date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php foreach($resource_list as $list){ ?>
                                            <tr>
                                                <td><?php echo htmlentities($list['r_name']); ?></td>
                                                <td><?php echo htmlentities($list['resource_name']); ?></td>
                                                <td><?php echo htmlentities($list['resource_email']); ?></td>
                                                <td><?php echo htmlentities($list['resource_contatnumber']); ?></td>
                                                <td><?php echo htmlentities($list['r_created_at']); ?></td>
												<td><?php if($list['r_status']==1){ echo "Active";}else{ echo "Deactive"; } ?></td>
                                                <td class="valigntop">
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li>
																<a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode($list['r_id']).'/'.base64_encode($list['r_status']).'/'.base64_encode($list['a_id']);?>');adminstatus('<?php echo $list['r_status'];?>')" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                                                                    <i class="fa fa-edit"></i><?php if($list['r_status']==0){ echo "Active";}else{ echo "Deactive"; } ?> </a>
                                                            </li> 
															<li>
                                                                <a href="<?php echo base_url('hospital/resourceview/'.base64_encode($list['r_id'])); ?>">
                                                                    <i class="fa fa-edit"></i>View</a>
                                                            </li> 
															<li>
                                                                <a href="<?php echo base_url('hospital/resourceedit/'.base64_encode($list['r_id'])); ?>">
                                                                    <i class="fa fa-edit"></i>Edit</a>
                                                            </li>
                                                            <li>															    
															<a href="javascript;void(0);" onclick="admindelete('<?php echo base64_encode(htmlentities($list['r_id'])).'/'.base64_encode(htmlentities($list['r_status']));?>');adminstatus2('<?php echo $list['r_status'];?>')" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                                                                    <i class="fa fa-trash-o"></i>Delete</a>
                                                            </li>
                                                            
                                                            
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
										<?php } ?>
											
                                            
                                        </tbody>
                                    </table>
								<?php }else{ ?>
								<div>No data Available</div>
								<?php } ?>
								
                                </div>
                        </div>
                       
                     </div>
                  </div>
               </div>
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
<script>
$(document).ready(function() {
    $('#example4').DataTable( {
        "order": [[ 4, "desc" ]]
    } );
} );

function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('hospital/resourcestatus'); ?>"+"/"+id);
}
function adminstatus(id){
	if(id==1){
			$('#content1').html('Are you sure you want to deactivate?');
		
	}if(id==0){
			$('#content1').html('Are you sure you want to activate?');
	}
}
function admindelete(id){
	$(".popid").attr("href","<?php echo base_url('hospital/resourcedelete'); ?>"+"/"+id);
}
function adminstatus2(id){
	
			$('#content1').html('Are you sure you want to delete?');

}


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
						message: 'Mobile Number is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'Mobile Number must be 10 to 14 digits'
					}
				
				}
            },resource_contatnumber: {
              validators: {
					notEmpty: {
						message: 'Contact Number is required'
					},
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
                        message: 'Password  must be at least 6 characters. '
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
						message: 'Password and Confirm Password do not match'
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
					message:'Address 2 wont allow <> [] = % '
					}
                }
            },
			 resource_city: {
                 validators: {
					notEmpty: {
						message: 'City is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'City can only consist of alphabets and Space'
					}
				
				}
            }, resource_state: {
                  validators: {
					notEmpty: {
						message: 'State is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'State can only consist of alphabets and Space'
					}
				
				}
            },resource_zipcode: {
                  validators: {
					notEmpty: {
						message: 'Pin code is required'
					},
					regexp: {
					regexp: /^[0-9]{5,7}$/,
					message: 'Pin code  must be  5 to 7 characters'
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
					     message:'Bank Acc Number must be 9 to 16 digits'
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