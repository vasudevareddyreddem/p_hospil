
<?php //echo '<pre>';print_r($bed_details_list);exit; ?>
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Bed Transfer</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Nurse</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Bed Transfer</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel tab-border card-topline-green">
                  
                    <div class="panel-body">
                        <div id="smartwizard" class="col-md-12">
                            <ul>
                                <li><a href="#step-1">Patient List <br /><small>This is step Patient list </small></a></li>
                                <li><a href="#step-2">Bed Transfer<br /><small>This is step Bed Transfer</small></a></li>
                                <li><a href="#step-3">Transferred Patient List<br /><small>This is step Investigation</small></a></li>
                            </ul>
                            <div>
                                <div id="step-1" class="">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="panel-body">
                        
                        <div class="clearfix">&nbsp;</div>
                        <div class="table-responsive">
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
														
														<a href="<?php echo base_url('nurse/bed_transfer/'.base64_encode($list['a_p_id'])); ?>#step-2">
																	<i class="fa fa-edit"></i>Transfer</a>
															
											              
													</td>
												</tr>
											<?php } ?>
										<?php } ?>
                                        </tbody>
                                    </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                                </div>
                                <div id="step-2" class="">
        <div class="row">
            <div class="col-md-12 ">
                <div class="container">
                    <div class="">
                        <form action="<?php echo base_url('nurse/transferpatientseditpost'); ?>" method="post" id="room_num" name="room_num" enctype="multipart/form-data">
							<?php $csrf = array(
							   'name' => $this->security->get_csrf_token_name(),
							   'hash' => $this->security->get_csrf_hash()
							   ); ?>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />													
								<input type="hidden" name="previous_bed_id" id="previous_bed_id" value="<?php echo $bed_details_list['a_p_id']; ?>" >
								<input type="hidden" name="pid" id="pid" value="<?php echo $bed_details_list['pt_id']; ?>" >
								<input type="hidden" name="bid" id="bid" value="<?php echo $bed_details_list['bill_id']; ?>" >
								<div class="modal-header">
									<h4 class="modal-title" id="smallModalLabel">Ward details rename</h4>
								</div>
								<div class="row d-flex justify-content-center">
										 <div class="form-group col-md-6">
										  <label ><strong>Ward Name</strong></label>
											<select  class="form-control" name="ward_name" id="ward_name" >
											<option value="">Select Ward Number</option>
											<?php foreach($ward_list as $List){ ?>					
																<?php if($List['w_id']==$bed_details_list['w_name']){ ?>
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
															<?php if($List['ward_id']==$bed_details_list['w_type']){ ?>
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
													<?php if($List['w_r_t_id']==$bed_details_list['room_type']){ ?>
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
												<?php if($List['w_f_id']==$bed_details_list['floor_no']){ ?>
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
												<?php if($List['w_r_n_id']==$bed_details_list['room_no']){ ?>
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
													<?php if($List['r_b_id']==$bed_details_list['bed_no']){ ?>
														<input type="checkbox" name="bed_number" id="1A<?php echo $List['r_b_id'] ?>" checked  value="<?php echo $List['r_b_id'] ?>"/>
														<label for="1A<?php echo $List['r_b_id'] ?>">bed <?php echo $List['bed'];?></label>
													<?php }else{ ?>
														<input type="checkbox" name="bed_number"  id="1A<?php echo $List['r_b_id'] ?>" value="<?php echo $List['r_b_id'] ?>" />
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
														<button type="submit" class="btn btn-link waves-effect">Transfer </button>
													</div>
												 </form>
                    </div>
                </div>
            </div>
        </div>
                                </div>
                                <div id="step-3" class="">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <h3 class="text-center">Transferred Patient list</h3><br>
                            <table id="" class="table table-bordered" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Patient ID</th>
                                        <th>Patient Name</th>
                                        <th>Ward Type</th>
                                        <th>Ward Number</th>
                                        <th>Room Type</th>
                                        <th>Room Number</th>
                                        <th>Bed No</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>xxxxxx500</td>
                                        <td>patient 1</td>
                                        <td>xxxx</td>
                                        <td>26</td>
                                        <td>xxxxx</td>
                                        <td>211</td>
                                        <td>25 </td>
                                        <td>Completed</td>
                                    </tr>
                                </tbody>
                            </table>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
	$("input:checkbox").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});
	$(document).ready(function() {
    $('#example4').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );
        $(function() {
            $(document).on('click', '.btn-add', function(e) {
                e.preventDefault();

                var controlForm = $('.controls form:first'),
                    currentEntry = $(this).parents('.entry:first'),
                    newEntry = $(currentEntry.clone()).appendTo(controlForm);

                newEntry.find('input').val('');
                controlForm.find('.entry:not(:last) .btn-add')
                    .removeClass('btn-add').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('<span class="glyphicon glyphicon-minus">-</span>');
            }).on('click', '.btn-remove', function(e) {
                $(this).parents('.entry:first').remove();

                e.preventDefault();
                return false;
            });
        });
    </script>
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