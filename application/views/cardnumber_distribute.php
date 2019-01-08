<?php //echo '<pre>';print_r($hospital_details);exit; ?>
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Card Number Distribute</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Card Number Distribute</li>
            </ol>
         </div>
      </div>
   
         <div class="panel tab-border card-topline-green">
            <header class="panel-heading panel-heading-gray custom-tab ">
               <ul class="nav nav-tabs">
                  <li class="nav-item"><a href="#home" data-toggle="tab" class="<?php if(isset($tab) && $tab ==''){ echo "active"; } ?>">Add Seller</a>
                  </li>
                  <li class="nav-item"><a href="#about" data-toggle="tab" class="<?php if(isset($tab) && $tab ==1){ echo "active"; } ?>">Seller List</a>
                  </li>
				  <li class="nav-item"><a href="#card_seller" data-toggle="tab" class="<?php if(isset($tab) && $tab ==2){ echo "active"; } ?>">Card Numbers Assign</a>
                  </li>
				  <li class="nav-item"><a href="#assign_seller_add" data-toggle="tab" class="<?php if(isset($tab) && $tab ==3){ echo "active"; } ?>">Seller Assigned Card Numbers List</a>
                  </li>
				  <li class="nav-item"><a href="#patient_assign_seller_add" data-toggle="tab" class="<?php if(isset($tab) && $tab ==4){ echo "active"; } ?>">Patient Assigned Card Numbers List</a>
                  </li>
               </ul>
            </header>
            <div class="panel-body">
               <div class="tab-content">
                  <div class="tab-pane <?php if(isset($tab) && $tab ==''){ echo "active"; } ?>" id="home">
				  <div class="container">
                     
					  <form action="<?php echo base_url('admin/cardnumbersellerpost'); ?>" method="post" id="add_seller" name="add_seller" enctype="multipart/form-data">
								<div class="row">
								<div class="col-md-6">
									<label> Name</label>
								<input class="form-control" id="name" name="name" value="" type="text" placeholder="Name">
								</div>
								
								<div class="col-md-6">
									<label>Mobile</label>
								<input class="form-control" id="mobile" name="mobile" value="" type="text" placeholder="Mobile">
								</div>
								<div class="col-md-6">
									<label>Email Address</label>
								<input class="form-control" id="email_id" name="email_id" value="" type="text" placeholder="Email Address">
								</div>
								<div class="col-md-6">
									<label>Password</label>
								<input class="form-control" id="password" name="password" value="" type="password" placeholder="Password">
								</div>
								<div class="col-md-6">
									<label> Confirm Password</label>
								<input class="form-control" id="confirmpassword" name="confirmpassword" value="" type="password" placeholder="Confirm Password">
								</div>
								<div class="col-md-6">
									<label> Address</label>
								<input class="form-control" id="address" name="address" value="" type="text" placeholder="Address">
								</div>
								<div class="col-md-6">
									<label> Bank Account Number</label>
									<input class="form-control" id="bank_account" name="bank_account" value="" type="text" placeholder="Bank Account Number">
								</div>
								<div class="col-md-6">
									<label> Bank Name</label>
									<input class="form-control" id="bank_name" name="bank_name" value="" type="text" placeholder="Bank Name">
								</div>
								<div class="col-md-6">
									<label> Bank Ifsc Code</label>
									<input class="form-control" id="ifsccode" name="ifsccode" value="" type="text" placeholder="Bank Ifsc Code">
								</div>
								<div class="col-md-6">
									<label> Bank Account Holder Name</label>
									<input class="form-control" id="bank_holder_name" name="bank_holder_name" value="" type="text" placeholder="Bank Account Holder Name">
								</div>
								<div class="col-md-6">
									<label> Kyc</label>
									<input class="form-control" id="kyc" name="kyc" value="" type="file" placeholder="Bank Account Holder Name">
								</div>
								
								
								</div><br>
								<div class="">
								<label>&nbsp;</label>
								<button type="submit" class="btn btn-sm btn-success pull-right" type="button">Add</button>
								</div>	
							
							</form>
						
					
                     </div>
                  </div>
                  <div class="tab-pane <?php if(isset($tab) && $tab ==1){ echo "active"; } ?>" id="about">
                     <div class="container">
                        <div class="row">
                            <div class="card-body col-md-12 table-responsive">
								<?php if(count($card_seller_list)>0){ ?>
                                    <table id="example4" class="table table-striped table-bordered table-hover  order-column" style="width:100%;">
                                        <thead>
                                            <tr>
												<th>Name</th>
												<th>Mobile</th>
												<th>Email Address</th>
                                                <th>Create Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php foreach($card_seller_list as $list){ ?>
                                            <tr>
                                                <td><?php echo htmlentities($list['name']); ?></td>
                                                <td><?php echo htmlentities($list['mobile']); ?></td>
                                                <td><?php echo htmlentities($list['email_id']); ?></td>
                                                <td><?php echo htmlentities($list['created_at']); ?></td>
												<td><?php if($list['status']==1){ echo "Active";}else{ echo "Deactive"; } ?></td>
												<td>
													<a class="fa fa-pencil btn btn-success" href="<?php echo base_url('admin/cards_distributor_edit/'.base64_encode($list['s_id'])); ?>" ></a>  
													<a class="fa fa-info-circle btn btn-warning" href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($list['s_id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus('<?php echo $list['status'];?>')" href="javascript:void(0)" data-toggle="modal" data-target="#myModal"></a>
													<a class="fa fa-trash btn btn-danger" href="javascript;void(0);" onclick="admindelete('<?php echo base64_encode(htmlentities($list['s_id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus2('<?php echo $list['status'];?>')" href="javascript:void(0)" data-toggle="modal" data-target="#myModal"></a>
												</td>
												</tr>
											
										<?php } ?>	  
                                        </tbody>
                                    </table>
								<?php }else{ ?>
								<div>No data Available</div>
								<?php } ?>
								
                                </div>
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
				   <div class="tab-pane <?php if(isset($tab) && $tab ==2){ echo "active"; } ?>" id="card_seller">
				    <div class="container">
                     
					  <form action="<?php echo base_url('admin/cardnumberassign_post'); ?>" method="post" id="assign_seller" name="assign_seller" enctype="multipart/form-data">
								<div class="row">
								<div class="col-md-4">
									<label> Name</label>
								 
								<select class="form-control select2" style="width:100%" name="seller_id" id="seller_id">
								<option value="">Select</option>
								<?php foreach($ative_card_seller_list as $s_list){ ?>
								<option value="<?php echo $s_list['s_id']; ?>"><?php echo $s_list['name']; ?></option>
								<?php } ?>
								</select>
								</div>
								
								<div class="col-md-4">
									<label>Card Numbers From</label>
									<select class="form-control select2" style="width:100%" name="card_number_from" id="card_number_from">
										<option value="">Select</option>
										<?php foreach($card_number_list as $s_list){ ?>
											<option value="<?php echo $s_list['c_id']; ?>"><?php echo $s_list['card_number']; ?></option>
											<?php } ?>
									</select>
								</div>
								<div class="col-md-4">
									<label>Card Numbers To</label>
									<select class="form-control select2" style="width:100%" name="card_number_to" id="card_number_to">
										<option value="">Select</option>
										<?php foreach($card_number_list as $s_list){ ?>
											<option value="<?php echo $s_list['c_id']; ?>"><?php echo $s_list['card_number']; ?></option>
											<?php } ?>
									</select>
								</div>
								
								
								
								</div>
								<br>
								<div class="">
								<label>&nbsp;</label>
								<button type="submit" class="btn btn-sm btn-success pull-right" type="button">Assign</button>
								</div>	
							
							</form>
						
					
                     </div>
				   </div>
				   <div class="tab-pane <?php if(isset($tab) && $tab ==3){ echo "active"; } ?>" id="assign_seller_add">
				     <div class="container">
                        <div class="row">
                            <div class="card-body col-md-12 table-responsive">
								<?php if(count($seller_card_number_list)>0){ ?>
                                    <table id="example5" class="table table-striped table-bordered table-hover  order-column" style="width:100%;">
                                        <thead>
                                            <tr>
												<th>Distributor Name</th>
												<th>Mobile</th>
												<th>Email Address</th>
                                                <th>Card Numbers From</th>
                                                <th>Card Numbers To</th>
                                                <th>Create Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php foreach($seller_card_number_list as $list){ ?>
                                            <tr>
                                                <td><?php echo htmlentities($list['name']); ?></td>
                                                <td><?php echo htmlentities($list['mobile']); ?></td>
                                                <td><?php echo htmlentities($list['email_id']); ?></td>
                                                <td><?php echo htmlentities($list['start_nums']); ?></td>
                                                <td><?php echo htmlentities($list['end_nums']); ?></td>
                                                <td><?php echo htmlentities($list['updated_at']); ?></td>
												<td>
													<a class="fa fa-pencil btn btn-success" href="<?php echo base_url('admin/cards_assign_edit/'.base64_encode($list['assign_seller'])); ?>" ></a>  
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
				   <div class="tab-pane <?php if(isset($tab) && $tab ==4){ echo "active"; } ?>" id="patient_assign_seller_add">
				     <div class="container">
                        <div class="row">
                            <div class="card-body col-md-12 table-responsive">
								<?php if(count($assign_card_number_list)>0){ ?>
                                    <table id="example6" class="table table-striped table-bordered table-hover  order-column" style="width:100%;">
                                        <thead>
                                            <tr>
												<th>Distributor Name</th>
												<th>Patient Name</th>
												<th>Card Number</th>
												<th>Mobile Number </th>
												<th>Whatsapp Number </th>
												<th>Email Address</th>
                                                <th>City</th>
                                                <th>Created Date & Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php foreach($assign_card_number_list as $list){ ?>
                                            <tr>
                                                <td><?php echo htmlentities($list['s_name']); ?></td>
                                                <td><?php echo htmlentities($list['patient_name']); ?></td>
                                                <td><?php echo htmlentities($list['card_number']); ?></td>
                                                <td><?php echo htmlentities($list['mobile_num']); ?></td>
                                                <td><?php echo htmlentities($list['whatsapp_num']); ?></td>
                                                <td><?php echo htmlentities($list['email_id']); ?></td>
                                                <td><?php echo htmlentities($list['city']); ?></td>
                                                <td><?php echo htmlentities($list['created_at']); ?></td>
												
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
       
      </div>
   </div>
</div>
<script>
$(document).ready(function() {
    $('#example4').DataTable( {
        "order": [[ 1, "desc" ]]
    } );
} );
$(document).ready(function() {
    $('#example6').DataTable( {
        "order": [[ 7, "desc" ]]
    } );
} );
function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('admin/distributor_status'); ?>"+"/"+id);
}
function adminstatus(id){
	if(id==1){
			$('#content1').html('Are you sure you want to deactivate?');
		
	}if(id==0){
			$('#content1').html('Are you sure you want to activate?');
	}
}
function admindelete(id){
	$(".popid").attr("href","<?php echo base_url('admin/cards_distributor_delete'); ?>"+"/"+id);
}
function adminstatus2(id){
	
			$('#content1').html('Are you sure you want to delete?');

}




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
$(document).ready(function() {
    $('#add_seller').bootstrapValidator({
        
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
			password: {
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
           
            confirmpassword: {
					 validators: {
						 notEmpty: {
						message: 'Confirm Password is required'
					},
					identical: {
						field: 'password',
						message: 'Password and confirm Password do not match'
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
<script>
  $(function () {
    $("#example5").DataTable();
  
  });
</script>