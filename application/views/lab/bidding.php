<?php //echo '<pre>';print_r($bidding_test_list);exit; ?>
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Procurement Lab Test List</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Procurement Lab Test List</li>
            </ol>
         </div>
      </div>
	  <div class="row">	
			<div class="col-md-12">
                            <div class="panel tab-border card-topline-yellow">
                                
                                <div class="panel-body">
                                    <div class="tab-content">
                                       
					
                                            <div class="card card-topline-red">
	
	<div class="card-body table-responsive">
	<?php if(isset($bidding_test_list) && count($bidding_test_list)>0){ ?>
		<table class="table table-striped table-bordered table-hover table-checkable order-column" id="example4">
			<thead>
				<tr>
					<th> Test Name </th>
					<th> Date & Time </th>
					<th> Amount</th>
					<th> Duration </th>
					<th> Status </th>
					<th> Action </th>
					
				</tr>
			</thead>
			<tbody>
			<?php foreach($bidding_test_list as $list){ ?>
				<tr class="odd gradeX">
					<form action="<?php echo base_url('lab/bidding_post'); ?>" method="post">
					<input type="hidden" name="bid_id" id="bid_id" value="<?php echo $list['id']; ?>">
					<td> <?php echo $list['t_name']; ?> </td>
					<td> <?php echo $list['create_at']; ?> </td>
					<td> <input type="text" name="amount" id="amount" value="<?php echo $list['amount']; ?>" required> </td>
					<td> <input type="text" name="duration" id="duration" value="<?php echo $list['duration']; ?>" required> </td>
					<td> <?php if($list['status']==1){ echo "Initiate"; }else if($list['status']==2){ echo "Accept"; }else if($list['status']==3){ echo "Decline"; }else if($list['status']==4){ echo "Approved"; } ?> </td>

					<td>
					<?php if($list['status']!=4){ ?>
					<button type="submit">Accept | </button>
					</form>
					<a href="<?php echo base_url('lab/bidding_decline/'.base64_encode($list['id'])); ?>">Decline 
					<?php } ?>
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
                                </div>
                            </div>
                        </div>
	  </div>
	
   
   </div>
</div>
<script>
$(document).ready(function() {
    $('#example4').DataTable( {
        "order": [[ 1, "desc" ]]
    } );
} );
</script>
<script>
function assign_doctore(){
	var pid=$('#patientid').val();
	var bid=$('#billing_id').val();
	var dep=$('#department_name').val();
	var doctid=$('#department_doctors').val();
	jQuery.ajax({
				url: "<?php echo base_url('resources/assign_doctor');?>",
					data: {
						patient_id: pid,
						billing_id: bid,
						depart_id: dep,
						doct_id: doctid,
					},
					dataType: 'json',
					type: 'POST',
					success: function (data) {
						
						//console.log(data);return false;
					}
				
				});
	
	
}
function get_doctor_list(id){
				jQuery.ajax({
					url: "<?php echo base_url('resources/get_doctors_list');?>",
					data: {
						dep_id: id,
					},
					dataType: 'json',
					type: 'POST',
					success: function (data) {
						$('#department_doctors').empty();
						$('#department_doctors').append("<option>select</option>");
						for(i=0; i<data.list.length; i++) {
							$('#department_doctors').append("<option value="+data.list[i].t_d_doc_id+">"+data.list[i].resource_name+"</option>");                      
                      
						}
						//console.log(data);return false;
					}
				
				});
	
}
	$(document).ready(function() {
 
    $('#vitals').bootstrapValidator({
		fields: {
			tep_actuals: {
                 validators: {
					notEmpty: {
						message: 'Actualsis required'
					}
				}
            },tep_range: {
                 validators: {
					notEmpty: {
						message: 'Range is required'
					}
				}
            },temp_site_positioning: {
                 validators: {
					notEmpty: {
						message: 'Positioning is required'
					}
				}
            },notes: {
                 validators: {
					notEmpty: {
						message: 'Notes is required'
					}
				}
            },pulse_actuals: {
                 validators: {
					notEmpty: {
						message: 'Actuals is required'
					}
				}
            },pulse_range: {
                 validators: {
					notEmpty: {
						message: 'Range is required'
					}
				}
            },pulse_rate_rhythm: {
                 validators: {
					notEmpty: {
						message: 'Rhythm is required'
					}
				}
            },pulse_rate_vol: {
                 validators: {
					notEmpty: {
						message: 'Vol is required'
					}
				}
            },notes1: {
                 validators: {
					notEmpty: {
						message: 'Notes is required'
					}
				}
            }
			}
		
	})
     
});
	$(document).ready(function() {
 
    $('#bills').bootstrapValidator({
		fields: {
          
             patient_payer_deposit_amount: {
                 validators: {
					notEmpty: {
						message: 'Patient amount / payer amount / deposit is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Patient amount / payer amount / deposit can only consist of alphanumeric, space and dot'
					}
				}
            },
			payment_mode: {
                 validators: {
					notEmpty: {
						message: 'Payment mode is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Payment mode can only consist of alphanumeric, space and dot'
					}
				}
            },bill_amount: {
                 validators: {
					notEmpty: {
						message: 'Amount is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Amount can only consist of alphanumeric, space and dot'
					}
				}
            },received_form: {
                 validators: {
					notEmpty: {
						message: 'Received from is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Received from can only consist of alphanumeric, space and dot'
					}
				}
            }
			}
		
	})
     
});	
$(document).ready(function() {
 
    $('#orderinfo').bootstrapValidator({
		fields: {
          
             service_type: {
                 validators: {
					notEmpty: {
						message: 'Service type is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Service type can only consist of alphanumeric, space and dot'
					}
				}
            },
			service: {
                 validators: {
					notEmpty: {
						message: 'Service is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Service can only consist of alphanumeric, space and dot'
					}
				}
            },visit_type: {
                 validators: {
					notEmpty: {
						message: 'Visit type is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Visit type can only consist of alphanumeric, space and dot'
					}
				}
            },doctor: {
                 validators: {
					notEmpty: {
						message: 'Doctor is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Doctor can only consist of alphanumeric, space and dot'
					}
				}
            },payer: {
                 validators: {
					notEmpty: {
						message: 'Payer is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Payer can only consist of alphanumeric, space and dot'
					}
				}
            },price: {
                  validators: {
					notEmpty: {
						message: 'price is required'
					},
                    regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'price can only consist of alphanumeric, space and dot'
					}
                }
            },qty: {
                  validators: {
					notEmpty: {
						message: 'Qty is required'
					},
                    regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Qty can only consist of alphanumeric, space and dot'
					}
                }
            },amount: {
                  validators: {
					notEmpty: {
						message: 'Amount is required'
					},
                    regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Amount can only consist of alphanumeric, space and dot'
					}
                }
            },
           bill: {
                validators: {
					notEmpty: {
						message: 'Bill is required'
					},
                    regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'BIll can only consist of alphanumeric, space and dot'
					}
                }
            }
			}
		
	})
     
});	$(document).ready(function() {
 
    $('#visitinfo').bootstrapValidator({
		fields: {
          
             visit_no: {
                 validators: {
					notEmpty: {
						message: 'Visit Number is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Visit Number can only consist of alphanumeric, space and dot'
					}
				}
            },
			department: {
                 validators: {
					notEmpty: {
						message: 'Department is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Department can only consist of alphanumeric, space and dot'
					}
				}
            },docotr_name: {
                 validators: {
					notEmpty: {
						message: 'Doctor is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Doctor can only consist of alphanumeric, space and dot'
					}
				}
            },no_of_visits: {
                 validators: {
					notEmpty: {
						message: 'No- of visits is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'No- of visits can only consist of alphanumeric, space and dot'
					}
				}
            },visit_desc: {
                  validators: {
					notEmpty: {
						message: 'Visit description is required'
					},
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Visit description wont allow <> [] = % '
					}
                }
            },
           payer_address: {
                validators: {
					notEmpty: {
						message: 'Address is required'
					},
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address wont allow <> [] = % '
					}
                }
            }
			}
		
	})
     
});
$(document).ready(function() {
 
    $('#payer').bootstrapValidator({
		fields: {
          
             payer_name: {
                 validators: {
					notEmpty: {
						message: 'Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Name can only consist of alphanumeric, space and dot'
					}
				}
            },payer_mobile: {
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
           payer_address: {
                validators: {
					notEmpty: {
						message: 'Address is required'
					},
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address wont allow <> [] = % '
					}
                }
            }
			}
		
	})
     
});

	$(document).ready(function() {
 
    $('#economicdetails').bootstrapValidator({
		fields: {
          
             dependency: {
                 validators: {
					notEmpty: {
						message: 'Living dependency is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Living dependency can only consist of alphanumeric, space and dot'
					}
				}
            },arrangement: {
                 validators: {
					notEmpty: {
						message: 'Living arrangement is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Living arrangement can only consist of alphanumeric, space and dot'
					}
				}
            },incomegroup: {
                 validators: {
					notEmpty: {
						message: 'Income group is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Income group can only consist of alphanumeric, space and dot'
					}
				}
            },description: {
                validators: {
					notEmpty: {
						message: 'Description is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Description can only consist of alphanumeric, space and dot'
					}
                }
            },confidential: {
                validators: {
					notEmpty: {
						message: 'Confidential is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Confidential can only consist of alphanumeric, space and dot'
					}
                }
            },
           student: {
                validators: {
					notEmpty: {
						message: 'student is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'student group can only consist of alphanumeric, space and dot'
					}
                }
            }
			}
		
	})
     
});
	
	$(document).ready(function() {
 
    $('#guardian').bootstrapValidator({
		fields: {
          
             relationship: {
                 validators: {
					notEmpty: {
						message: 'Relationship is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Relationship can only consist of alphanumeric, space and dot'
					}
				}
            },g_first_name: {
                 validators: {
					notEmpty: {
						message: 'First Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'First Name can only consist of alphanumeric, space and dot'
					}
				}
            },g_middel_name: {
                 validators: {
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Middle Name can only consist of alphanumeric, space and dot'
					}
				}
            },g_last_name: {
                 validators: {
					notEmpty: {
						message: 'Last Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Last Name can only consist of alphanumeric, space and dot'
					}
				}
            },g_address1: {
                validators: {
					notEmpty: {
						message: 'Address is required'
					},
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address wont allow <> [] = % '
					}
                }
            },g_address2: {
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
           
			g_pincode: {
                validators: {
					notEmpty: {
						message: 'Zipcode is required'
					},
					stringLength: {
                        max: 6,
                        message: 'Zipcode  must be less than 10 characters'
                    },
					regexp: {
					// regexp: /^[0-9A-Za-z ]{5,10}$/,
					 regexp: /^[0-9][1-9]([0-9][0-9][0-9])|[1-9][0-9]([0-9][0-9][0-9])$/ ,
					message: 'Zipcode is not valid, Should be like 32216.'
					}
				}
            },g_city: {
               validators: {
					notEmpty: {
						message: 'City is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'City can only consist of alphanumeric, space and dot'
					}
				}
            },g_state: {
              validators: {
					notEmpty: {
						message: 'State is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'State can only consist of alphanumeric, space and dot'
					}
				}
            },
			g_country: {
              validators: {
					notEmpty: {
						message: 'Country is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Country can only consist of alphanumeric, space and dot'
					}
				}
			},nationality: {
              validators: {
					notEmpty: {
						message: 'Nationality is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Nationality can only consist of alphanumeric, space and dot'
					}
				}
			},living: {
              validators: {
					notEmpty: {
						message: 'Living dependency is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Living dependency can only consist of alphanumeric, space and dot'
					}
				}
			},
			gender: {
              validators: {
					notEmpty: {
						message: 'gender is required'
					}
				}
			},
			g_language: {
              validators: {
					notEmpty: {
						message: 'Language is required'
					}
				}
			}
			}
		
	})
     
});

	$(document).ready(function() {
 
    $('#referral').bootstrapValidator({
		fields: {
          
             referred: {
                 validators: {
					notEmpty: {
						message: 'Referred by is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Referred by can only consist of alphanumeric, space and dot'
					}
				}
            },
			internal_external: {
              validators: {
					notEmpty: {
						message: 'Internal external is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Internal external can only consist of alphanumeric, space and dot'
					}
				}
			},search_doctor: {
              validators: {
					notEmpty: {
						message: 'Search doctor is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Search doctor can only consist of alphanumeric, space and dot'
					}
				}
			}
			}
		      })
     
});
$(document).ready(function() {
 
    $('#next').bootstrapValidator({
		fields: {
          
             relation: {
                 validators: {
					notEmpty: {
						message: 'Relation is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Relation can only consist of alphanumeric, space and dot'
					}
				}
            },first_name: {
                 validators: {
					notEmpty: {
						message: 'First Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'First Name can only consist of alphanumeric, space and dot'
					}
				}
            },middel_name: {
                 validators: {
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Middle Name can only consist of alphanumeric, space and dot'
					}
				}
            },last_name: {
                 validators: {
					notEmpty: {
						message: 'Last Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Last Name can only consist of alphanumeric, space and dot'
					}
				}
            },next_address1: {
                validators: {
					notEmpty: {
						message: 'Address is required'
					},
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address wont allow <> [] = % '
					}
                }
            },next_address2: {
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
           
			next_pincode: {
                validators: {
					notEmpty: {
						message: 'Zipcode is required'
					},
					stringLength: {
                        max: 6,
                        message: 'Zipcode  must be less than 10 characters'
                    },
					regexp: {
					// regexp: /^[0-9A-Za-z ]{5,10}$/,
					 regexp: /^[0-9][1-9]([0-9][0-9][0-9])|[1-9][0-9]([0-9][0-9][0-9])$/ ,
					message: 'Zipcode is not valid, Should be like 32216.'
					}
				}
            },next_city: {
               validators: {
					notEmpty: {
						message: 'City is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'City can only consist of alphanumeric, space and dot'
					}
				}
            },next_state: {
              validators: {
					notEmpty: {
						message: 'State is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'State can only consist of alphanumeric, space and dot'
					}
				}
            },
			next_country: {
              validators: {
					notEmpty: {
						message: 'Country is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Country can only consist of alphanumeric, space and dot'
					}
				}
			},
			next_email: {
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
			next_mobile: {
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
			next_occupation: {
              validators: {
					notEmpty: {
						message: 'Occupation is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Occupation can only consist of alphanumeric, space and dot'
					}
				}
			}
			}
		      })
     
});
	$(document).ready(function() {
 
    $('#demographic').bootstrapValidator({
		fields: {
          
             religion: {
                 validators: {
					notEmpty: {
						message: 'Religion is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Religion can only consist of alphanumeric, space and dot'
					}
				}
            },caste: {
                 validators: {
					notEmpty: {
						message: 'Caste is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Caste can only consist of alphanumeric, space and dot'
					}
				}
            },mothername: {
                 validators: {
					notEmpty: {
						message: 'Mother name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Mother name can only consist of alphanumeric, space and dot'
					}
				}
            },
            language: {
               validators: {
					notEmpty: {
						message: 'Language is required'
					}
				}
            },primarylanguage: {
               validators: {
					notEmpty: {
						message: 'Primary Language is required'
					}
				}
            },preferred_language: {
               validators: {
					notEmpty: {
						message: 'Preferred Language is required'
					}
				}
            },
            occupation: {
                validators: {
					notEmpty: {
						message: 'Occupation is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Occupation  can only consist of alphanumeric, space and dot'
					}
				}
            },
			education: {
                validators: {
					notEmpty: {
						message: 'Education is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Education  can only consist of alphanumeric, space and dot'
					}
				}
            },
			birth_place: {
                validators: {
					notEmpty: {
						message: 'Birth place is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Birth place  can only consist of alphanumeric, space and dot'
					}
				}
            },
			work_phone: {
                validators: {
					notEmpty: {
						message: 'Work phone is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'Work Phone must be 10 to 14 digits'
					}
				}
            },home_phone: {
                validators: {
					notEmpty: {
						message: 'Home phone is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'Home Phone must be 10 to 14 digits'
					}
				}
            },
			
			bloodgroup: {
                 validators: {
					notEmpty: {
						message: 'Blood group is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Blood group can only consist of alphanumeric, space and dot'
					}
				}
            },
			citizen_proof: {
                 validators: {
					 notEmpty: {
                        message: 'Please select Senior citizen proof'
                    }
				
				}
            },
            patient_identifier: {
                 validators: {
					regexp: {
					regexp: "(.*?)\.(docx|doc|pdf|xlsx|xls|png|jpeg|jpg)$",
					message: 'Uploaded file is not a valid. Only docx,doc,xlsx,pdf,png,jpeg,jpg files are allowed'
					}
            }
            }
			}
		      })
     
});
		
		$(document).ready(function() {
 
    $('#basic_details').bootstrapValidator({
        
        fields: {
            registrationtype: {
                validators: {
                      notEmpty: {
                        message: 'Please select Registration Type '
                    }
                }
            },
			patient_category: {
                validators: {
                      notEmpty: {
                        message: 'Please select Patient category '
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
            email: {
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
					regexp:  /^[0-9]{2}$/,
					message:'Mobile Number must be 10 to 14 digits'
					}
				
				}
            },
			bloodgroup: {
                 validators: {
					notEmpty: {
						message: 'Blood group is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Blood group can only consist of alphanumeric, space and dot'
					}
				}
            },
			martial_status: {
                 validators: {
					 notEmpty: {
                        message: 'Please select Marital status'
                    }
				
				}
            },
            nationali_id: {
                 validators: {
					notEmpty: {
						message: 'National ID is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,16}$/,
					message:'National ID must be 10 to 14 digits'
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
            p_c_name: {
                validators: {
					notEmpty: {
						message: 'City is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'City can only consist of alphanumeric, space and dot'
					}
				
				}
            },
            p_country_name: {
                validators: {
					notEmpty: {
						message: 'Country is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Country can only consist of alphanumeric, space and dot'
					}
				
				}
            },
			p_s_name: {
                validators: {
					notEmpty: {
						message: 'State is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'State can only consist of alphanumeric, space and dot'
					}
				
				}
            },
            p_zipcode: {
                 validators: {
					notEmpty: {
						message: 'Zipcode is required'
					},
					stringLength: {
                        max: 6,
                        message: 'Zipcode  must be less than 10 characters'
                    },
					regexp: {
					// regexp: /^[0-9A-Za-z ]{5,10}$/,
					 regexp: /^[0-9][1-9]([0-9][0-9][0-9])|[1-9][0-9]([0-9][0-9][0-9])$/ ,
					message: 'Zipcode is not valid, Should be like 32216.'
					}
				}
            },
			temp_address: {
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
			t_c_name: {
                validators: {
					notEmpty: {
						message: 'City is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'City can only consist of alphanumeric, space and dot'
					}
				
				}
            },
			t_s_name: {
                validators: {
					notEmpty: {
						message: 'State is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'State can only consist of alphanumeric, space and dot'
					}
				
				}
            },
			t_zipcode: {
              validators: {
					notEmpty: {
						message: 'Zipcode is required'
					},
					stringLength: {
                        max: 6,
                        message: 'Zipcode  must be less than 10 characters'
                    },
					regexp: {
					// regexp: /^[0-9A-Za-z ]{5,10}$/,
					 regexp: /^[0-9][1-9]([0-9][0-9][0-9])|[1-9][0-9]([0-9][0-9][0-9])$/ ,
					message: 'Zipcode is not valid, Should be like 32216.'
					}
				}
            },
			t_country_name: {
                validators: {
					notEmpty: {
						message: 'Country is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Country can only consist of alphanumeric, space and dot'
					}
				
				}
            }
            }
        })
     
});


</script>