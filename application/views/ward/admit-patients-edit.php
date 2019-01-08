
   <?php //echo '<pre>';print_r($hospital_details);exit; ?>
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
		 <?php if($userdetails['role_id']==2){ ?>
            <div class=" pull-left">
               <div class="page-title">Admitted Patient Edit</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li><li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('Ward_management/admit-patients/'.base64_encode(1)); ?>">Admitted Patient List</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Edit</li>
            </ol>
			<?php } ?>
         </div>
      </div>
   
         <div class="panel tab-border card-topline-green">
            <header class="panel-heading panel-heading-gray custom-tab ">
               <ul class="nav nav-tabs">
                  <li class="nav-item"><a href="#home" data-toggle="tab" class="<?php if(isset($tab) && $tab ==''){ echo "active"; } ?>">Edit Ward details </a>
                  </li>
                  
               </ul>
            </header>
            <div class="panel-body">
               <div class="tab-content">
                  <div class="tab-pane <?php if(isset($tab) && $tab ==''){ echo "active"; } ?>" id="home">
				  <div class="container">
                     
					  <form action="<?php echo base_url('Ward_management/admitpatientseditpost'); ?>" method="post" id="room_num" name="room_num" enctype="multipart/form-data">
							<?php $csrf = array(
													   'name' => $this->security->get_csrf_token_name(),
													   'hash' => $this->security->get_csrf_hash()
													   ); ?>
													<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />													
													<input type="hidden" name="wardname" id="wardname" value="<?php echo $list['a_p_id']; ?>" >
													<div class="modal-header">
														<h4 class="modal-title" id="smallModalLabel">Ward details rename</h4>
													</div>
													<div class="row d-flex justify-content-center">
											 <div class="form-group col-md-6">
											  <label ><strong>Ward Name</strong></label>
												<select  class="form-control" name="ward_name" id="ward_name" >
												<option value="">Select Ward Number</option>
												<?php foreach($ward_list as $List){ ?>					
																	<?php if($List['w_id']==$list['w_name']){ ?>
																		<option selected value="<?php echo $List['w_id'];?>"><?php echo $List['ward_name'];?></option>
																	<?php }else{ ?>
																	<option  value="<?php echo $List['w_id'];?>"><?php echo $List['ward_name'];?></option>
																	<?php } ?>
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
																	<?php if($List['ward_id']==$list['w_type']){ ?>
																		<option selected value="<?php echo $List['ward_id'];?>"><?php echo $List['ward_type'];?></option>
																	<?php }else{ ?>
																	<option  value="<?php echo $List['ward_id'];?>"><?php echo $List['ward_type'];?></option>
																	<?php } ?>
																	<?php } ?>																	
										</select>
											</div>
										</div>										 
										<div class="row d-flex justify-content-center">
											 <div class="form-group col-md-6">
											  <label ><strong>Room Type</strong></label>
											 <select  class="form-control" name="room_type" id="room_type">
												<option value="">Select Room Type </option>
												<?php foreach($roomtype_list as $List){ ?>
													<?php if($List['w_r_t_id']==$list['room_type']){ ?>
													<option selected value="<?php echo $List['w_r_t_id'];?>"><?php echo $List['room_type'];?></option>
													<?php }else{ ?>
													<option  value="<?php echo $List['w_r_t_id'];?>"><?php echo $List['room_type'];?></option>
													<?php } ?>
													<?php } ?>						
										</select>
											</div>
										</div>
										
										<div class="row d-flex justify-content-center">
											 <div class="form-group col-md-6" >
											  <label ><strong>Floor Number</strong></label>
												<select  class="form-control" onchange="get_floorno_list(this.value);" name="floor_number" id="floor_number">
												<option value="">Select Floor Number</option>
												<?php foreach($floor_list as $List){ ?>
												<?php if($List['w_f_id']==$list['floor_no']){ ?>
													<option selected value="<?php echo $List['w_f_id'];?>"><?php echo $List['ward_floor'];?></option>
													<?php }else{ ?>
													<option  value="<?php echo $List['w_f_id'];?>"><?php echo $List['ward_floor'];?></option>
													<?php } ?>
													<?php } ?>	
												
										</select></div>
										</div>
										<div class="row d-flex justify-content-center">
											<div class="form-group col-md-6" >
											  <label ><strong>Room Number</strong></label>
												 <select  class="form-control" id="roomno_id" onchange="get_bed_count(this.value);" name="room_num" >
												
												<?php foreach($roomnum_list as $List){ ?>
												<?php if($List['w_r_n_id']==$list['room_no']){ ?>
													<option selected value="<?php echo $List['w_r_n_id'];?>"><?php echo $List['room_num'];?></option>
													<?php }else{ ?>
													<option  value="<?php echo $List['w_r_n_id'];?>"><?php echo $List['room_num'];?></option>
													<?php } ?>
													<?php } ?>	
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
												<div id="beds">
												<?php foreach($bed_list as $List){ ?>
													<li class="row row--1" id="bedcount_id" name="bed"  value="<?php echo $List['r_b_id'];?>">
													<div class="panel-body"> 
													<ol class="seats" type="A">
													<li class="seat">
													<?php if($List['r_b_id']==$list['bed_no']){ ?>
														<input type="checkbox" id="1A<?php echo $List['r_b_id'] ?>" checked />
														<label for="1A<?php echo $List['r_b_id'] ?>">bed <?php echo $List['bed'];?></label>
													<?php }else{ ?>
														<input type="checkbox" id="1A<?php echo $List['r_b_id'] ?>" />
														<label for="1A<?php echo $List['r_b_id'] ?>">bed <?php echo $List['bed'];?></label>
													<?php } ?>	
													</li>
													</ol>
													</div>
													</li>
													
												<?php } ?>																													
												</div>
													</div>
													  </div>
													 <div class="panel-body">
													  <div class="d-flex justify-content-center">
													<li class="row row--1" id="bedcount_id" name="bed"  value="<?php echo $List['r_b_id'];?>"></li>
													</div>
													  </div>
													</div>													
												  </div>
												</div>
											 </div>
												</div>
													
													<div class="modal-footer">
														<button type="submit" class="btn btn-link waves-effect">Update </button>
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
   						$('#beds').empty();
						$('#bedcount_id').empty();  																		
   						for(i=0; i<data.list.length; i++) { 																																			
							$('#bedcount_id').append('<div class="panel-body"> <ol class="seats" type="A"><li class="seat" > <input type="checkbox" name="bed"  value="'+data.list[i].r_b_id+'" id="1A'+i+'" /> <label for="1A'+i+'">Bed '+data.list[i].bed+'</label></ol></li></div>'); 							 						
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