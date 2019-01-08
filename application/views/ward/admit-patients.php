<style>
.panel-title > a:before {
  content: "\f068";
  float: right !important;
  position: relative;
  top: 1px;
  display: inline-block;
  font-family: FontAwesome;
  font-style: normal;
  font-weight: normal;
  line-height: 1;
}
.panel-title > a.collapsed:before {
  content: "\f067";
}
	 .panel-title > a {
        display: block;
       
        text-decoration: none;
    }
	ol {
  list-style: none;
  padding: 0;
  margin: 0;
}


</style>

<?php //echo '<pre>';print_r($tab);exit; ?>

<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Appointments</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Appointments</li>
            </ol>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="panel tab-border card-topline-green">
               <header class="panel-heading panel-heading-gray custom-tab ">
                  <ul class="nav nav-tabs x-scrool">
				   
					 <li style="border-right:2px solid #fff" class="nav-item"><a href="#aboutop" data-toggle="tab" class="<?php if(isset($tab)&& $tab==''){ echo "active";}?>"> Patients List</a>
                     </li>
					 
                      <li style="border-right:2px solid #fff;position:relative" class="nav-item"><a href="#home" data-toggle="tab" class=" <?php if(isset($tab)&& $tab==2){ echo "active";}?>">Ward Details</a>
					
                     </li>
                     <li class="nav-item "><a href="#about" data-toggle="tab" class="<?php if(isset($tab)&& $tab==3){ echo "active";}?>">Admitted Patient List</a>
                     </li>
                   
                  </ul>
               </header>
               <div class="panel-body">
                  <div class="tab-content">
				   <div class="tab-pane <?php if(isset($tab)&& $tab==''){ echo "active";}?>" id="aboutop">
						<div class="card ">
                                <div class="card-head">
                                     <header>Patients List</header>
                                  
                                </div>
                                <div class="card-body table-responsive">
                                    <table id="example1" class="table table-bordered" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Patient ID</th>
												<th>Patient Name</th>
                                                <th>Gender </th>
                                                <th>Age</th>
                                                <th>Doctor Name</th>
                                                <th>Diagnosis</th>
                                                <th>Date of Admit</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
										
                                        <tbody>										
										<?php if(isset($ip_patient_list)  && count($ip_patient_list)>0){ ?>
											<?php foreach($ip_patient_list as $list){ ?>
												<tr>
													<td><?php echo $list['pid']; ?></td>
													<td><?php echo $list['name']; ?></td>
													<td><?php echo $list['gender']; ?></td>
													<td><?php echo $list['age']; ?></td>
													<td><?php echo $list['resource_name']; ?></td>
													<td><?php echo $list['t_name']; ?></td>
													<td><?php echo $list['create_at']; ?></td>
													<td class="valigntop">
														<div class="btn-group">
															<button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
																<i class="fa fa-angle-down"></i>
															</button>
															<ul class="dropdown-menu" role="menu">
																<li>
																	<a href="<?php echo base_url('ward_management/admit/'.base64_encode(2).'/'.base64_encode($list['pid']).'/'.base64_encode($list['b_id']).'/'.base64_encode($list['a_id'])); ?>">
																		<i class="fa fa-edit"></i>Room/Bed </a>
																</li>
															   												
															</ul>
														</div>
													</td>
												</tr>
											<?php } ?>
										<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
								<div class="clearfix">&nbsp;</div>
							
                            </div>			
						
                     </div>
                     <div class="tab-pane <?php if(isset($tab)&& $tab==2){ echo "active";}?>" id="home">
                        <div class="card ">
                                <div class="card-head">
                                     <header>Ward Details</header>                                 
                                </div>
                                <div class="card-body ">
                                    <form class=" pad30 form-horizontal" action="<?php echo base_url('Ward_management/admitdetails'); ?> " method="post"  id="contact_form">
                                        
										<input type="hidden" name="p_id" id="p_id" value="<?php echo isset($p_id)?$p_id:''; ?>">
										<input type="hidden" name="b_id" id="b_id" value="<?php echo isset($b_id)?$b_id:''; ?>">
										<input type="hidden" name="d_id" id="d_id" value="<?php echo isset($d_id)?$d_id:''; ?>">

										
										<div class="row d-flex justify-content-center">
											 <div class="form-group col-md-6">
											  <label ><strong>Ward Name</strong></label>
												<select  class="form-control" name="ward_name" id="ward_name">
												<option value="">Select Ward Number</option>
												<?php foreach($ward_list as $List){ ?>
												<option value="<?php echo $List['w_id'];?>"><?php echo $List['ward_name'];?></option>
												<?php } ?>	
												</select>											
											</div>
										</div>
										<div class="row d-flex justify-content-center">
											 <div class="form-group col-md-6">
											  <label ><strong>Ward Type</strong></label>
												<select  class="form-control"  name="ward_type" id="ward_type">
												<option value="">Select Ward Type</option>
												<?php foreach($wardtype_list as $List){ ?>
												<option value="<?php echo $List['ward_id'];?>"><?php echo $List['ward_type'];?></option>
												<?php } ?>										
										</select>
											</div>
										</div>										 
										<div class="row d-flex justify-content-center">
											 <div class="form-group col-md-6">
											  <label ><strong>Room Type</strong></label>
											 <select  class="form-control" name="room_type" id="room_type">
												<option value="">Select Room Type </option>
												<?php foreach($roomtype_list as $list){ ?>
												<option value="<?php echo $list['w_r_t_id'];?>"><?php echo $list['room_type'];?></option>
												<?php } ?>
										
										</select>
											</div>
										</div>
										
										<div class="row d-flex justify-content-center">
											 <div class="form-group col-md-6" >
											  <label ><strong>Floor Number</strong></label>
												<select  class="form-control" onchange="get_floorno_list(this.value);" name="floor_number" id="floor_number">
												<option value="">Select Floor Number</option>
												<?php foreach($floor_list as $list){ ?>
												<option value="<?php echo $list['w_f_id'];?>"><?php echo $list['ward_floor'];?></option>
												<?php } ?>			
										</select></div>
										</div>
										<div class="row d-flex justify-content-center">
											<div class="form-group col-md-6" >
											  <label ><strong>Room Number</strong></label>
												 <select  class="form-control" id="roomno_id" onchange="get_bed_count(this.value);" name="room_num" >
												 <option value="">Select Room Number </option>
								
												 </select>												
											</div>
										</div>
										
										   <div class="row d-flex justify-content-center">
											 <div class="form-group col-md-6">	
												<label ><strong>Bed Number</strong></label>											 
												<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
												  <div class="panel panel-warning">
													<div class="panel-heading" role="tab" id="headingOne" style="border-bottom:1px solid #ddd">
													  <h4 class="panel-title">
													  
														<a class="collapsed"  role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
														Select Bed
														</a>
													  </h4>
													</div>
													<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
													  <div class="panel-body">
													  <div class="d-flex justify-content-center">												  
																<li class="row row--1" id="bedcount_id" name="bed"  ></li>																														
														</div>
													  </div>
													</div>													
												  </div>
												</div>
											 </div>
												</div>																		
										<a class="btn btn-primary pull-right" type="submit">Next</a>
										<button class="btn btn-success pull-right" type="submit">Assign</button>
                                    </form>
                                </div>
								<div class="clearfix">&nbsp;</div>												
                            </div>
                     </div>
                     <div class="tab-pane <?php if(isset($tab)&& $tab==3){ echo "active";}?>" id="about">
							<div class="card ">
                                <div class="card-head">
                                     <header>Admitted Patient List</header>
                                  
                                </div>
                                <div class="card-body table-responsive">
                                    <table id="example4" class=" table table-bordered" style="width:100%;">
                                        <thead>
                                            <tr>
											
                                                <th>Patient ID</th>
												<th>Patient Name</th>
                                                <th>Ward Name </th>
                                                <th>Ward Type </th>
                                                <th>Room Type</th>
												<th>Floor No</th>
                                                <th>Room No</th>
                                                <th>Bed No</th>
                                                <th>Date of Admit</th>
                                                <th>Status</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                         <tbody>										
										<?php if(isset($ip_admitted_patient_list)  && count($ip_admitted_patient_list)>0){ ?>
											<?php foreach($ip_admitted_patient_list as $list){ ?>
												<tr>
													<td><?php echo $list['pt_id']; ?></td>
													<td><?php echo $list['name']; ?></td>
													<td><?php echo $list['ward_name']; ?></td>
													<td><?php echo $list['ward_type']; ?></td>
													<td><?php echo $list['room_type']; ?></td>
													<td><?php echo $list['ward_floor']; ?></td>
													<td><?php echo $list['room_num']; ?></td>
													<td><?php echo $list['bed']; ?></td>
													<td><?php echo $list['date_of_admit']; ?></td>	
													<td><?php if($list['status']==1){ echo "Active";}else{ echo "Deactive"; } ?></td>
													<td class="valigntop">
														<div class="btn-group">
															<button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
																<i class="fa fa-angle-down"></i>
															</button>
															 <ul class="dropdown-menu" role="menu">
                                                            
															<li>
                                                                <a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($list['a_p_id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus('<?php echo $list['status'];?>')" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                                                                    <i class="fa fa-edit"></i><?php if($list['status']==0){ echo "Active";}else{ echo "Deactive"; } ?> </a>
                                                            </li> 
															
															<li>
																<a href="<?php echo base_url('ward_management/admittedpatientsedit/'.base64_encode($list['a_p_id'])); ?>">
																	<i class="fa fa-edit"></i>Edit</a>
															</li>
															<li>
																<a href="<?php echo base_url('ward_management/transferpatientsedit/'.base64_encode($list['a_p_id'])); ?>">
																	<i class="fa fa-edit"></i>Transfer</a>
															</li>
											                <li>
                                                                <a href="<?php echo base_url('ward_management/admitpatientsdelete/'.base64_encode($list['a_p_id'])); ?>">
                                                                    <i class="fa fa-trash-o"></i>Delete</a>
                                                            </li>
                                                           
                                                        </ul>
														</div>
													</td>
												</tr>
											<?php } ?>
										<?php } ?>
                                        </tbody>
                                    </table>
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
            </div>
         </div>
      </div>
   </div>
</div></div>

<div id="sucessmsg" style="display:none;"></div>

<script>
$(document).ready(function() {
    $('#example4').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );
$(document).ready(function() {
    $('#example1').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );
function admindeactive(aid){
	$(".popid").attr("href","<?php echo base_url('ward_management/admitted_patients_status'); ?>"+"/"+aid);
}
function adminstatus(aid){
	if(aid==1){
			$('#content1').html('Are you sure you want to Deactivate?');
		
	}if(aid==0){
			$('#content1').html('Are you sure you want to activate?');
	}
}


function get_bed_count(id){	
		if(id!=''){
			jQuery.ajax({
   					url: "<?php echo base_url('Ward_management/get_bedcount_list');?>",
   					data: {
   						b_id: id,
   					},
   					dataType: 'json',
   					type: 'POST',
   					success: function (data) {						 
						//console.log(data);return false;
   						$('#bedcount_id').empty();  																		
   						for(i=0; i<data.list.length; i++) {
							if(data.list[i].completed==0 && data.list[i].a_p_id!=''){						
								$('#bedcount_id').append('<div class="panel-body"> <ol class="seats" type="A"><li class="seat" > <input type="checkbox" name="bed" disabled  value="'+data.list[i].r_b_id+'" id="1A'+i+'" /> <label for="1A'+i+'">Bed '+data.list[i].bed+'</label></ol></li></div>'); 							 						

							}else{
								$('#bedcount_id').append('<div class="panel-body"> <ol class="seats" type="A"><li class="seat" > <input type="checkbox" name="bed"   value="'+data.list[i].r_b_id+'" id="1A'+i+'" /> <label for="1A'+i+'">Bed '+data.list[i].bed+'</label></ol></li></div>'); 							 						

							}
						}							
   						//console.log(data);return false;
   					}   				
   			}); 				
		}
}

function get_floorno_list(id){	

		if(id!=''){
			jQuery.ajax({
   					url: "<?php echo base_url('Ward_management/get_roomno_list');?>",
   					data: {
   						dep_id: id,
   					},
   					dataType: 'json',
   					type: 'POST',
   					success: function (data) {
						//console.log(data);return false;
   						$('#roomno_id').empty();
   						$('#roomno_id').append("<option>select</option>");
   						for(i=0; i<data.list.length; i++) {
   						$('#roomno_id').append("<option value="+data.list[i].w_r_n_id+">"+data.list[i].room_num+"</option>");                                               
   						}
   						//console.log(data);return false;
   					}  				
   				});				
			}
}




   </script>
