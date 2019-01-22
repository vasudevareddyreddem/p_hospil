<?php //echo '<pre>';print_r($tab);exit; ?>

<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Front Desk</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Front Desk</li>
            </ol>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="panel tab-border card-topline-yellow">
               <header class="panel-heading panel-heading-gray custom-tab ">
                  <ul class="nav nav-tabs x-scrool">
				    
					 <li style="border-right:2px solid #fff" class="nav-item "><a href="#aboutop" data-toggle="tab" class="<?php if(isset($tab) && $tab==1 || $tab==0){ echo "active";}?>">OP Registration</a>
                     </li>
					 
                    <!-- <li style="border-right:2px solid #fff" class="nav-item"><a href="#home" data-toggle="tab" class="<?php if(isset($tab) && $tab!=11 && $tab!=12 && $tab!=13  && $tab!=0){ echo "active";}?>">IP New-Registration</a>
                     </li>-->
                     <li class="nav-item"><a href="#about" data-toggle="tab">Reschedule/Repeated -Registration</a>
                     </li>
                   
                  </ul>
               </header>
               <div class="panel-body">
                  <div class="tab-content">
				  <?php //echo $tab;exit; ?>
                    
                     <div class="tab-pane" id="about">
                        <div class="card">
                           <div class="card-head">
                              <header>Patients List</header>
                             
                           </div>
                           <div class="card-body table-responsive ">
                              <?php if(isset($patients_list) && count($patients_list)>0){ ?>
                              <table class="table table-striped table-bordered table-hover table-checkable order-column" id="example4">
                                 <thead>
                                    <tr>
                                       <th> Patient Id </th>
                                      
                                       <th> Name </th>
                                      
                                       <th> Age </th>
                                       <th> Mobile </th>
                                       <th> Action </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php foreach($patients_list as $list){ ?>
                                    <tr class="odd gradeX">
                                       <td> <?php echo $list['pid']; ?> </td>
                                       <td>
                                          <?php echo $list['name']; ?>
                                       </td>
                                      
                                       <td><?php echo $list['age']; ?> </td>
                                       <td><?php echo $list['mobile']; ?> </td>
                                       <td class="valigntop">
                                          <div class="btn-group">
                                             <button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                             <i class="fa fa-angle-down"></i>
                                             </button>
                                             <ul class="dropdown-menu pull-left" role="menu">
                                                <li>
                                                   <a href="<?php echo base_url('resources/desk/'.base64_encode($list['pid']).'/'.base64_encode(1)); ?>">
                                                   <i class="icon-docs"></i> Edit </a>
                                                </li>
											
													<li>
                                                    <a href="<?php echo base_url('resources/desk/'.base64_encode($list['pid']).'/'.base64_encode(0).'/'.base64_encode('reschedule')) ?>">
                                                    <i class="icon-docs"></i> Reschedule </a>
													</li>
												
													<?php if($list['patient_reschedule_date']==1){ ?>
														<li>
														   <a href="<?php echo base_url('resources/desk/'.base64_encode($list['pid']).'/'.base64_encode(0).'/'.base64_encode('repeated')); ?>">
														   <i class="icon-docs"></i> Repeated </a>
														</li>
													<?php } ?>
												<!--<li>
                                                   <a href="<?php echo base_url('resources/transforto_ip/'.base64_encode($list['pid'])); ?>">
                                                   <i class="icon-docs"></i> Transfer to ip </a>
                                                </li>-->
                                             </ul>
                                          </div>
                                       </td>
                                    </tr>
                                    <?php } ?>
                                 </tbody>
                              </table>
                              <?php }else{ ?>
                              <div>No data available</div>
                              <?php } ?>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane  <?php if(isset($tab) && $tab==1 || $tab==0){ echo "active";}?>" id="aboutop">
                        <div class="card ">
                           <div class="card-head">
                              <header>Patient Details</header>
                             
                           </div>
                           <div class="card-body ">
                           <div class="card-body " id="bar-parent" style="margin-top:30px">
                              <div class="row">
                                
                                 <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="tab-content">
                                       <div >
									   <h3>Basic Details</h3>
                                          <form class=" pad30 form-horizontal" action="<?php echo base_url('resources/opregistration'); ?> " method="post"  id="basic_details1" name="basic_details1">
                                             <input type="hidden" id="pid" name="pid" value="<?php echo isset($pid)?$pid:''; ?>">
											  <input type="hidden" id=" verifying" name="verifying" value="<?php echo isset($p_type)?$p_type:''; ?>">

                                             <input type="hidden" id="op" name="op" value="1">
                                             <input type="hidden" id="appointment_id" name="appointment_id" value="<?php echo isset($appointment_id)?$appointment_id:'';?>">
                                             <div class="row">
												<div class="form-group col-md-6">
                                                   <label for="Name">Name</label>
                                                   <input type="text" class="form-control" id="name2"  name="name" placeholder="Enter Name" value="<?php echo isset($patient_detailes['name'])?$patient_detailes['name']:''; ?>">
                                                </div>
												  <div class="form-group col-md-6">
                                                   <label for="mobile">Referred by?</label>
                                                   <input type="text" class="form-control" id="referred"  name="referred"  value="<?php echo isset($patient_detailes['referred'])?$patient_detailes['referred']:''; ?>">
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <label for="Name">Gender</label>
														<select id="gender" name="gender" class="form-control" >
														  <option value="">Select</option>
														  <option value="Male" <?php if(isset($patient_detailes['gender']) && $patient_detailes['gender']=='Male'){ echo "Selected"; } ?>>Male</option>
														  <option value="Female" <?php if(isset($patient_detailes['gender']) &&  $patient_detailes['gender']=='Female'){ echo "Selected"; } ?>>Female</option>
														  <option value="Other" <?php if(isset($patient_detailes['gender']) &&  $patient_detailes['gender']=='Other'){ echo "Selected"; } ?>>Other</option>
													   </select> 
												 </div>												
                                                <div class="form-group col-md-6">
                                                   <label for="mobile">Mobile Number</label>
                                                   <input type="text" class="form-control" id="mobile2"  name="mobile" placeholder="Enter Mobile Number" value="<?php echo isset($patient_detailes['mobile'])?$patient_detailes['mobile']:''; ?>">
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <label for="mobile">Email</label>
                                                   <input type="text" class="form-control" id="email2"  name="email" placeholder="Enter Email" value="<?php echo isset($patient_detailes['email'])?$patient_detailes['email']:''; ?>">
                                                </div>                                                
												<div class="form-group col-md-6">
                                                   <label for="mobile">Age</label>
                                                   <input type="text" class="form-control" id="age"  name="age" placeholder="Enter Age" value="<?php echo isset($patient_detailes['age'])?$patient_detailes['age']:''; ?>">
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <label for="mobile">Blood Group</label>
												   <?php $modes = array('No'=>'Unknown','O-'=>'O-','O+'=>'O+','A-'=>'A-','A+'=>'A+','B-'=>'B-','B+'=>'B+','AB-'=>'AB-','AB+'=>'AB+'); ?>
																	  <select class="form-control"  name="bloodgroup" name="bloodgroup">
																	  <option value = "">Select</option>
																		<?php foreach($modes as $key=>$state):
																				if($patient_detailes['bloodgroup'] == $state):
																				$selected ='selected=selected';
																				else : 
																				$selected = '';
																				endif;
																			 ?>
																			<option value = "<?php echo $state?>" <?php echo $selected;?> ><?php echo $state?></option>
																		<?php endforeach; ?>
																	  </select>
                                                </div>
                                                
                                                <div class="form-group col-md-6">
                                                   <label for="email"> Address</label>
                                                   <textarea type="textarea" id="perment_address" name="perment_address" class="form-control"  placeholder="Enter Address" ><?php echo isset($patient_detailes['perment_address'])?$patient_detailes['perment_address']:''; ?></textarea>
                                                </div>
												<div class="col-md-12"><h3>Assign</h3></div>
												<div class="form-group col-md-6">
                                                   <label for="Consultant  Department">Consultant  Department</label>
                                                   <select id="department_name1" name="department_name" onchange="get_doctor_list(this.value);" class="form-control" required>
                                                      <option value="">Select</option>
                                                      <?php foreach($departments_list as $lis){ ?>
                                                      <option value="<?php echo $lis['t_id']; ?>"><?php echo $lis['t_name']; ?></option>
                                                      <?php } ?>
                                                   </select>
                                                </div>
												<!--<div class="form-group col-md-6">
                                                   <label for="email">Consultant  Speciality</label>
                                                   <select id="specialist_doc" name="specialist_doctor_id" onchange="get_doctor_list(this.value);" class="form-control" required>
														  <option value="">Select Speciality</option>
													</select>
												</div>-->
                                                 
												
                                                <div class="form-group col-md-6">
                                                   <label for="email">Consultant Name</label>
                                                   <select id="department_doctors1" name="department_doctors" class="form-control" required>
                                                      <option value="">Select Consultant</option>
                                                   </select>
                                                </div>
												<?php if(isset($p_type) && $p_type!='repeated'){ ?>
												<div class="col-md-12">
												 <h3>Billing Information</h3>
												 </div>
                                                
														<div class="form-group col-md-6">
                                                                  <label for="mobile">Total Amount</label>
                                                                  <input type="text" class="form-control" id="patient_payer_deposit_amount"  name="patient_payer_deposit_amount" placeholder="Enter Total Amount" value="<?php echo isset($billing_detailes['patient_payer_deposit_amount'])?$billing_detailes['patient_payer_deposit_amount']:''; ?>">
                                                               </div>
                                                               <div class="form-group col-md-6">
                                                                  <label for="mobile">Payment Mode</label>
																   <?php $modes = array('Cash'=>'Cash','Online'=>'Online','Other'=>'Other'); ?>
																	  <select class="form-control"  name="payment_mode" name="payment_mode">
																		<option value = "">Select</option>
																		<?php foreach($modes as $key=>$state):
																				if($billing_detailes['payment_mode'] == $state):
																				$selected ='selected=selected';
																				else : 
																				$selected = '';
																				endif;
																			 ?>
																			<option value = "<?php echo $state?>" <?php echo $selected;?> ><?php echo $state?></option>
																		<?php endforeach; ?>
																	  </select>
                                                               </div>
                                                              
                                                               <div class="form-group col-md-6">
                                                                  <label for="mobile">Received from</label>
                                                                  <input type="text" class="form-control" id="received_form"  name="received_form" placeholder="Enter Received from" value="<?php echo isset($billing_detailes['received_form'])?$billing_detailes['received_form']:''; ?>">
                                                               </div>
															   <?php } ?>
                                          </div>
                                     
									   
												<div>
									   
													 <?php if(isset($billing_detailes['completed']) && $billing_detailes['completed']==1){ ?>
															<a target="_blank" href="<?php echo base_url('resources/print_op_patient_details/'.base64_encode($pid).'/'.base64_encode($bill_id)); ?>" class="btn btn-success  " type="bitton">Print</a>
															<a href="<?php echo base_url('resources/desk'); ?>" class="btn btn-success  " type="bitton">Submit</a>
													 <?php }else{ ?>
															<button class="btn btn-success"  name="form_submit" type="submit">Next</button>
													<?php } ?>
												</div> 
										  </form>
										    </div>
                                       <!-- end-->
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
         </div>
      </div>
   </div>
</div>
<div id="sucessmsg" style="display:none;"></div>
<script>

 $(document).ready(function() {
    $('#example4').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );
function get_department_list(id){
	
		if(id!=''){
			jQuery.ajax({
   					url: "<?php echo base_url('hospital/get_specialists_list');?>",
   					data: {
   						dep_id: id,
   					},
   					dataType: 'json',
   					type: 'POST',
   					success: function (data) {
						//console.log(data);return false;
   						$('#specialist_doc').empty();
   						$('#specialist_doc1').empty();
   						$('#specialist_doc').append("<option>select</option>");
   						$('#specialist_doc1').append("<option>select</option>");
   						for(i=0; i<data.list.length; i++) {
   							$('#specialist_doc').append("<option value="+data.list[i].s_id+">"+data.list[i].specialist_name+"</option>");                      
   							$('#specialist_doc1').append("<option value="+data.list[i].s_id+">"+data.list[i].specialist_name+"</option>");                      
                         
   						}
   						//console.log(data);return false;
   					}
   				
   				});
				
			}
}

   function get_doctor_list(id){
   				jQuery.ajax({
   					url: "<?php echo base_url('hospital/get_op_doctors_list');?>",
   					data: {
   						treate_ment_id: id,
   					},
   					dataType: 'json',
   					type: 'POST',
   					success: function (data) {
						//console.log(data);return false;
   						$('#department_doctors1').empty();
   						$('#department_doctors2').empty();
   						$('#department_doctors1').append("<option>select</option>");
   						$('#department_doctors2').append("<option>select</option>");
   						for(i=0; i<data.list.length; i++) {
   							$('#department_doctors1').append("<option value="+data.list[i].t_d_doc_id+">"+data.list[i].resource_name+"</option>");                      
   							$('#department_doctors2').append("<option value="+data.list[i].t_d_doc_id+">"+data.list[i].resource_name+"</option>");                      
                         
   						}
   						//console.log(data);return false;
   					}
   				
   				});
   	
   }
   
 $(document).ready(function() {
    
       $('#basic_details1').bootstrapValidator({
           
           fields: {
              gender: {
                   validators: {
                         notEmpty: {
                           message: 'Please select Gender '
                       }
                   }
               },
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
   					message:'Mobile Number must be 10 to 14 digits'
   					}
   				
   				}
               },
   			age: {
                    validators: {
   					notEmpty: {
   						message: 'Age is required'
   					},
   					regexp: {
   					regexp:  /^[0-9]*$/,
   					message:'Age must be digits'
   					}
   				
   				}
               },
   			bloodgroup: {
                    validators: {
   					notEmpty: {
   						message: 'Blood Group is required'
   					}
   				}
               },
			   perment_address: {
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
			   department_name1: {
                   validators: {
   					notEmpty: {
   						message: 'Consultant  Department is required'
   					}
                   }
               },
			   patient_payer_deposit_amount: {
                    validators: {
   					notEmpty: {
   						message: 'Total Amount is required'
   					},
   					regexp: {
   					regexp: /^[0-9.]*$/,
   					message: 'Total Amount can only consist of digits and dot'
   					}
   				}
               },
			   payment_mode: {
                    validators: {
   					notEmpty: {
   						message: 'Payment Mode is required'
   					}
   				}
               },
			  received_form: {
                      validators: {
					notEmpty: {
						message: 'Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Name can only consist of alphanumeric, space and dot'
					}
				}
               }
               }
           })
        
   });  
    
   
   
   
</script>
