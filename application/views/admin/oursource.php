<?php //echo '<pre>';print_r($hospital_details);exit; ?>
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Out Source Lab </div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Out Source Lab </li>
            </ol>
         </div>
      </div>
         <div class="panel tab-border card-topline-green">
            <header class="panel-heading panel-heading-gray custom-tab ">
               <ul class="nav nav-tabs">
                  <li class="nav-item"><a href="#home" data-toggle="tab" class="<?php if(isset($tab) && $tab ==''){ echo "active"; } ?>">Add Out Source Lab</a>
                  </li>
                  <li class="nav-item"><a href="#about" data-toggle="tab" class="<?php if(isset($tab) && $tab ==1){ echo "active"; } ?>">Out Source Lab List</a>
                  </li>
               </ul>
            </header>
            <div class="panel-body">
               <div class="tab-content">
                  <div class="tab-pane <?php if(isset($tab) && $tab ==''){ echo "active"; } ?>" id="home">
				  <div class="container">
                     <div class="row">
					  <form action="<?php echo base_url('admin/addlab'); ?>" method="post" id="addlab" name="addlab" enctype="multipart/form-data">
                        <div class="col-md-12 ">
                           
						  
                              <div class="row">
                                 <div class="col-md-4">
									<label> Name</label>
										<input class="form-control" id="lab_name" name="lab_name" value="" type="text" placeholder="Name">
									</div>
									<div class="col-md-4">
									<label> Mobile Number</label>
										<input class="form-control" id="lab_mobile" name="lab_mobile" value="" type="text" placeholder=" Mobile Number">
									</div>
									<div class="col-md-4">
										<label> Address1</label>
											<textarea type="textarea" id="lab_add1" name="lab_add1" value="" class="form-control"  placeholder="Address1" rows="1"></textarea>
									</div>
										<div class="col-md-4">
										<label> Address2</label>
											<textarea type="textarea" id="lab_add2" name="lab_add2" value="" class="form-control"  placeholder="Address2" rows="1"></textarea>
									</div>
									
									<div class="col-md-4">
									<label> City</label>
										<input class="form-control" id="lab_city" name="lab_city" value="" type="text" placeholder="City">
									</div>
										<div class="col-md-4">
										<label> State</label>
								  <?php $states = array ('Andhra Pradesh' => 'Andhra Pradesh', 'Arunachal Pradesh' => 'Arunachal Pradesh', 'Assam' => 'Assam', 'Bihar' => 'Bihar', 'Chhattisgarh' => 'Chhattisgarh', 'Goa' => 'Goa', 'Gujarat' => 'Gujarat', 'Haryana' => 'Haryana', 'Himachal Pradesh' => 'Himachal Pradesh', 'Jammu & Kashmir' => 'Jammu & Kashmir', 'Jharkhand' => 'Jharkhand', 'Karnataka' => 'Karnataka', 'Kerala' => 'Kerala', 'Madhya Pradesh' => 'Madhya Pradesh', 'Maharashtra' => 'Maharashtra', 'Manipur' => 'Manipur', 'Meghalaya' => 'Meghalaya', 'Mizoram' => 'Mizoram', 'Nagaland' => 'Nagaland', 'Odisha' => 'Odisha', 'Punjab' => 'Punjab', 'Rajasthan' => 'Rajasthan', 'Sikkim' => 'Sikkim', 'Tamil Nadu' => 'Tamil Nadu', 'Telangana' => 'Telangana', 'Tripura' => 'Tripura', 'Uttarakhand' => 'Uttarakhand','Uttar Pradesh' => 'Uttar Pradesh', 'West Bengal' => 'West Bengal', 'Andaman & Nicobar' => 'Andaman & Nicobar', 'Chandigarh' => 'Chandigarh', 'Dadra and Nagar Haveli' => 'Dadra and Nagar Haveli', 'Daman & Diu' => 'Daman & Diu', 'Delhi' => 'Delhi', 'Lakshadweep' => 'Lakshadweep', 'Puducherry' => 'Puducherry'); ?>

								<select class="form-control" required="required" name="lab_state" id="lab_state">
								  <option value = "">Select State</option>
									<?php foreach($states as $key=>$state):
											if(isset($out_sourcelab_list['lab_state']) && $out_sourcelab_list['lab_state'] == $state):
											$selected ='selected=selected';
											else : 
											$selected = '';
											endif;
										 ?>
										<option value = "<?php echo $state?>" <?php echo $selected;?> ><?php echo $state?></option>
									<?php endforeach; ?>
								  </select> 
							  </div>
									<div class="col-md-4">
										<label> Zipcode</label>
										<input class="form-control" id="lab_zipcode" name="lab_zipcode" value="" type="text" placeholder="Zipcode">
									</div>
										<div class="col-md-4">
										<label> Other Details</label>
										<input class="form-control" id="lab_other_details" name="lab_other_details" value="" type="text" placeholder="Other Details">
									</div>
									 	<div class="col-md-4">
									<label> Lab Contact Number</label>
										<input class="form-control" id="lab_contatnumber" name="lab_contatnumber" type="text" placeholder="Lab Contact Number">
									</div>
										
									<div class="col-md-4">
									<label> Lab Email ID</label>
										<input class="form-control" id="lab_email" name="lab_email" type="text" placeholder="Lab Email ID">
									</div>
										<div class="col-md-4">
									<label> Lab Password</label>
										<input class="form-control" id="lab_password" name="lab_password" type="password" placeholder="Password">
									</div>
										<div class="col-md-4">
									<label> Lab Confirm Password</label>
										<input class="form-control" id="lab_cinformpaswword" name="lab_cinformpaswword" type="password" placeholder="Confirm Password">
									</div>
										<div class="col-md-4">
									<label> Lab Photo</label>
										<input class="form-control" id="lab_photo" name="lab_photo" type="file" placeholder="lab Photo">
									</div>
									
                              </div>
                           </div>
                           <div class="clearfix">&nbsp;</div>
						   <div class="col-sm-10">
                           <button type="submit" class="btn btn-sm btn-success pull-right" type="button">Add Lab</button>
                           </div><div class="clearfix">&nbsp;</div>
                        </div>
						</form>
                     </div>
                  </div>
                  <div class="tab-pane <?php if(isset($tab) && $tab ==1){ echo "active"; } ?>" id="about">
                     <div class="container">
                        <div class="row">
                            <div class="card-body col-md-12 table-responsive">
								<?php if(count($out_sourcelab_list)>0){ ?>
                                    <table id="example4" class="table table-striped table-bordered table-hover  order-column" style="width:100%;">
                                        <thead>
                                            <tr>
												<th>Name</th>
												<th>Email Address</th>
                                                <th>Contact Number </th>
                                                <th>Created Date&Time</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php foreach($out_sourcelab_list as $list){ ?>
                                            <tr>
                                                <td><?php echo htmlentities($list['resource_name']); ?></td>
                                                <td><?php echo htmlentities($list['resource_email']); ?></td>
                                                <td><?php echo htmlentities($list['resource_contatnumber']); ?></td>
                                                <td><?php echo date('M-j-Y h:i A',strtotime(htmlentities($list['r_created_at'])));?></td>
												<td><?php if($list['r_status']==1){ echo "Active";}else{ echo "Deactive"; } ?></td>
                                                <td class="valigntop">
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                           
                                                            <li>
                                                                <a href="<?php echo base_url('admin/viewoutsourcelab/'.base64_encode($list['r_id'])); ?>">
                                                                    <i class="fa fa-eye"></i>View</a>
                                                            </li> 
															<li>
															    <a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($list['r_id'])).'/'.base64_encode(htmlentities($list['r_status']));?>');adminstatus('<?php echo $list['r_status'];?>')" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                                                                    <i class="fa fa-line-chart"></i><?php if($list['r_status']==0){ echo "Active";}else{ echo "Deactive"; } ?> </a>
                                                            </li> 
															<li>
                                                                <a href="<?php echo base_url('admin/editoutsource/'.base64_encode($list['r_id'])); ?>">
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
        "order": [[ 3, "desc" ]]
    } );
} );
function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('admin/resourcestatus'); ?>"+"/"+id);
}
function adminstatus(id){
	if(id==1){
			$('#content1').html('Are you sure you want to deactivate?');
		
	}if(id==0){
			$('#content1').html('Are you sure you want to activate?');
	}
}
function admindelete(id){
	$(".popid").attr("href","<?php echo base_url('admin/resourcedelete'); ?>"+"/"+id);
}
function adminstatus2(id){
	
			$('#content1').html('Are you sure you want to delete?');

}
















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
						message: 'Mobile Number is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'Mobile number must be 10 to 14 digits'
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
                        message: 'Password  must be at least 6 characters. '
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
						message: 'Password and Confirm Password do not match'
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
					regexp: /^[a-zA-Z ]+$/,
					message: 'City can only consist of alphabets and Space'
					}
				
				}
            }, lab_state: {
                  validators: {
					notEmpty: {
						message: 'State is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'State can only consist of alphabets and Space'
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