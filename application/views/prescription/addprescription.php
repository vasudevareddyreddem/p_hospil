  <link href="<?php echo base_url(); ?>assets/vendor/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap.min.js"></script>
<?php //echo '<pre>';print_r($detailss);exit; ?>
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Prescription  List</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Prescription  List</li>
            </ol>
         </div>
      </div>
      <div class="panel tab-border card-topline-green">
         <header class="panel-heading panel-heading-gray custom-tab ">
            <ul class="nav nav-tabs">
               <li class="nav-item"><a href="#home" data-toggle="tab" class="<?php if(isset($tab) && $tab ==''){ echo "active"; } ?>"> Add Prescription  </a>
               </li>
               <li class="nav-item"><a href="#about" class="<?php if(isset($tab) && $tab ==1){ echo "active"; } ?>" data-toggle="tab">Prescription  List</a>
               </li>
            </ul>
         </header>
         <div class="panel-body">
            <div class="tab-content">
               <div class="tab-pane <?php if(isset($tab) && $tab ==''){ echo "active"; } ?>" id="home">
                  <div class="row">
                     <div class="col-md-12 ">
                        <div class="container">
                           <div class="control-group" id="fields">
                              <label class="control-label" for="field1"><strong>Prescription  Details</strong></label>
                              <div class="controls">
                                 <form action="<?php echo base_url('Users/addpostprescription'); ?>" method="POST" id="addpostprescription" name="addpostprescription">
                                    <div class="entry input-group ">
									<div class="row">
                                       <div class="form-group col-md-4">
                                                   <label for="Name">Name</label>
                                                   <input type="text" class="form-control" id="name"  name="name"  value="">
                                                </div>
                                                <div class="form-group col-md-4">
                                                   <label for="Name">Patient Id</label>
                                                   <input type="text" class="form-control" id="id"  name="id"  value="">
                                                </div> 
												<div class="form-group col-md-4">
                                                   <label for="Name">Mobile</label>
                                                   <input type="text" class="form-control" id="mobile"  name="mobile"  value="">
                                                </div>
                                                </div>
									<div class="row">
									   <div id="education_fields">
          
										</div>
										
										<div class="col-sm-4 nopadding">
										  <div class="form-group">
										  
										  <select style="width:100%;height:40px;" onchange="get_medicin_amount_list(this.value,'0')" class="form-control select2" id="medicinename" name="addmedicn[0][medicine]">
											<option value="">Select</option>
                                             <?php foreach($medicine_list as $list){ ?>
                                             <option value="<?php echo $list['id']; ?>"><?php echo $list['medicine_name']; ?>-<?php echo "dosage ".$list['dosage']; ?> - <?php echo "Avl qty :".$list['qty']; ?> - <?php echo "Type :".$list['medicine_type']; ?></option>
                                             <?php } ?>
										  </select>
										  </div>
										</div>
										
										
										<div class="col-sm-1 nopadding">
										  <div class="form-group">
											<input type="text" class="form-control" id="qty"  name="addmedicn[0][qty]" value="" placeholder="Qty">
										  </div>
										</div>
										
										<div class="col-sm-2 nopadding">
										  <div class="form-group">
											<input type="text" class="form-control" id="expirydate0"  name="addmedicn[0][expirydate]" value="" placeholder="Expiry Date">
										  </div>
										</div>
										
										<div class="col-sm-2 nopadding">
										  <div class="form-group">
											<input type="text" class="form-control" id="usage_instructions"  name="addmedicn[0][usage_instructions]" value="" placeholder="Usage Instructions">
										  </div>
										</div>
										
										<div class="col-sm-2 nopadding">
										  <div class="form-group">
											<input type="text" class="form-control" id="amount0"  name="addmedicn[0][amount]"  value="" placeholder="Total Amount">
										  </div>
										</div>
										
										<div class="col-sm-1 nopadding">
										  <div class="input-group-btn">
											<button class="btn btn-success" type="button"  onclick="education_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
										  </div>
										</div>
										</div>
										  

                                      
                                    </div>
                                 
                                 <br>
								 									
                              </div>
							  <button type="submit" onclick="form_submittion();" class="btn btn-sm btn-success">Add  Prescription </button>

								 </form>
                           </div>
                        </div>                                         
                        <div class="clearfix">&nbsp;</div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane <?php if(isset($tab) && $tab ==1){ echo "active"; } ?>" id="about">
                  <div class="container table-responsive">
					<?php if(count($prescriptions_list)>0){ ?>
                                    <table id="saveStage" class="table table-striped table-bordered table-hover  order-column" style="width:100%;">
                                        <thead>
                                            <tr>
												<th>Patient Id</th>
												
												<th>Name</th>
												<th>Mobile</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php foreach($prescriptions_list as $list){ ?>
                                            <tr>
                                                <td><?php echo htmlentities($list['pid']); ?></td>
                                                <td><?php echo htmlentities($list['name']); ?></td>
                                                <td><?php echo htmlentities($list['mobile_number']); ?></td>
                                                <td class="text-center"><a class="btn btn-primary btn-sm text-center" href="<?php echo base_url('users/view_manualprescription/'.base64_encode($list['id']).'/'.base64_encode($list['b_id'])); ?>">View</a>
                                                 </td>
												
                                            </tr>
										<?php } ?>
											
                                            
                                        </tbody>
                                    </table>
								<?php } ?>
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
function get_medicin_amount_list(val,ids){
	
	if(val!=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('Users/get_medicin_amount_list');?>",
   			data: {
				m_id: val,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
						if(data.msg=1){
							var datas = JSON.parse(data);
							$('#expirydate'+ids).empty();
							$('#amount'+ids).empty();
							$('#expirydate'+ids).val(datas.expiry_date);
							$('#amount'+ids).val(datas.total_amount);
						}
						
   					}
           });
	   }
}




 function form_submittion(){
	 
	 if($('#medicinename').val()!=''){
	  document.getElementById("addpostprescription").submit(); 
	 }
 }
var room = 1;
function education_fields() {
 
    room++;
    var objTo = document.getElementById('education_fields')
    var divtest = document.createElement("div");
	divtest.setAttribute("class", "form-group removeclass"+room);
	var rdiv = 'removeclass'+room;
    divtest.innerHTML = '<div class="col-sm-4 nopadding"><div class="form-group"><select style="width:100%;height:40px;" class="form-control" id="medicinename" onchange="get_medicin_amount_list(this.value,'+room+')" name="addmedicn['+room+'][medicine]"><option value="">Select</option><?php foreach($medicine_list as $list){ ?> <option value="<?php echo $list['id']; ?>"><?php echo $list['medicine_name']; ?>-<?php echo "dosage ".$list['dosage']; ?> - <?php echo "Avl qty :".$list['qty']; ?> - <?php echo "Type :".$list['medicine_type']; ?></option><?php } ?></select></div></div>	<div class="col-sm-1 nopadding"><div class="form-group"><input type="text" class="form-control" id="qty"  name="addmedicn['+room+'][qty]" value="" placeholder="Qty"></div></div>	<div class="col-sm-2 nopadding"><div class="form-group"><input type="text" class="form-control" id="expirydate'+room+'"  name="addmedicn['+room+'][expirydate]" value="" placeholder="Expiry Date"></div></div>	<div class="col-sm-2 nopadding"><div class="form-group"><input type="text" class="form-control" id="usage_instructions"  name="addmedicn['+room+'][usage_instructions]" value="" placeholder="Usage Instructions"></div></div>	<div class="col-sm-2 nopadding"><div class="form-group"><input type="text" class="form-control" id="amount'+room+'"  name="addmedicn['+room+'][amount]"  value="" placeholder="Total Amount"></div></div><div class="col-sm-1 nopadding"><div class="input-group-btn"><button class="btn btn-danger" type="button" onclick="remove_education_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button>  </div></div><div class="clearfix">&nbsp;</div>';
    
    objTo.appendChild(divtest)
}
   function remove_education_fields(rid) {
	   $('.removeclass'+rid).remove();
   }


$(document).ready(function() {
    $('#addpostprescription').bootstrapValidator({
        
        fields: {
            
            name: {
                 validators: {
					
   					regexp: {
   					regexp: /^[a-zA-Z0-9. ]+$/,
   					message: 'Name can only consist of alphanumeric, space and dot'
   					}
				}
            },id: {
                 validators: {
   					notEmpty: {
   						message: 'Patient Id is required'
   					},
   					regexp: {
   					regexp: /^[0-9.]*$/,
   					message: 'Patient Id can only consist of digits and dot'
   					}
				 }
            },
			mobile: {
                 validators: {
					
   					regexp: {
   					regexp:  /^[0-9]{10,14}$/,
   					message:'Mobile Number must be 10 to 14 digits'
   					}
				}
            },
			'addmedicn[0][medicine]': {
                 validators: {
					notEmpty: {
						message: 'Medicine Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Medicine Name can only consist of alphanumeric, space and dot'
					}
				}
            },
			'addmedicn[0][dosage]': {
                 validators: {
					notEmpty: {
						message: 'Medicine Dosage is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Medicine dosage can only consist of alphanumeric, space and dot'
					}
				}
            },
			'addmedicn[0][usage_instructions]': {
                 validators: {
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Usage instructions can only consist of alphanumeric, space and dot'
					}
				}
            },
			'addmedicn[0][amount]': {
                 validators: {
					notEmpty: {
						message: 'Amount is required'
					},
					regexp: {
					regexp: /^[0-9]*$/,
					message: 'Amount can only consist digits'
					}
				}
            },
			'addmedicn[0][qty]': {
                 validators: {
					notEmpty: {
						message: 'Qty is required'
					},
					regexp: {
					regexp: /^[0-9]*$/,
					message: 'Qty can only consist digits'
					}
				}
            }
            }
        })
     
});

   
</script>


