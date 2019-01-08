
<?php //echo '<pre>';print_r($executive_list);exit; ?>
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Patients List</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Patients List</li>
            </ol>
         </div>
      </div>
   
         <div class="panel tab-border card-topline-green">
            
            <div class="panel-body">
               <div class="tab-content">
                    
                 
                   
                   <div class="tab-pane active">
                     <div class="container">
                        <div class="row ">
						 <div class="col-md-12">
						 <a href="<?php echo base_url('executive/index/'.base64_encode(2)); ?>" class="btn btn-primary">Back</a>
                           <table id="example5" class="table table-striped table-bordered table-hover table-checkable order-column" >
                                        <thead>
                                             <tr>
                                                <th>Patient Name</th>
                                                <th>Reason</th>
												
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php $cnt=1;foreach($patient_list as $lis){ ?>
				                             <tr>
                                                <td><?php echo $lis['patinet_name']; ?></td>
                                                <td><?php echo $lis['reason']; ?></td>
                                               
                                              
                                            </tr>
											
											<?php } ?>
											
                                            
                                        </tbody>
                                    </table>
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
    $('#example5').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );
</script>

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
					regexp: /\.(docx|doc|pdf|xlsx|xls)$/i,
					message: 'Uploaded file is not a valid. Only docx,doc,xlsx,pdf files are allowed'
					}
				}
            },
			location:{
			validators: {
					notEmpty: {
						message: 'location is required'
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
