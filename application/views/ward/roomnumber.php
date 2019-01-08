<?php //echo '<pre>';print_r($hospital_details);exit; ?>
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Room Number</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Room Number</li>
            </ol>
         </div>
      </div>
   
         <div class="panel tab-border card-topline-green">
            <header class="panel-heading panel-heading-gray custom-tab ">
               <ul class="nav nav-tabs">
                  <li class="nav-item"><a href="#home" data-toggle="tab" class="<?php if(isset($tab) && $tab ==''){ echo "active"; } ?>">Add Room Number </a>
                  </li>
                  <li class="nav-item"><a href="#about" data-toggle="tab" class="<?php if(isset($tab) && $tab ==1){ echo "active"; } ?>">Room List</a>
                  </li>
               </ul>
            </header>
            <div class="panel-body">
               <div class="tab-content">
                  <div class="tab-pane <?php if(isset($tab) && $tab ==''){ echo "active"; } ?>" id="home">
				  <div class="container">
                     
					  <form action="<?php echo base_url('Ward_management/roomnumberpost'); ?>" method="post" id="room_num" name="room_num" enctype="multipart/form-data">
							<div class="row">
							<div class="col-md-6">
							<label>  Floor Number</label>
										<select name="floor_number" id="floor_number" class="form-control">
										<option value="">Select Floor Number</option>
										<?php foreach($floor_list as $List){ ?>
										<option value="<?php echo $List['w_f_id'];?>"><?php echo $List['ward_floor'];?></option>
										<?php } ?>
										
										</select>
							</div>
							
						
								<div class="col-md-6">
									<label> Room Number</label>
								<input class="form-control" id="room_num" name="room_num" value="" type="text" placeholder="Room Number">
								</div>
								
								
	
								<div class="col-md-6">	<br>
									<label> Bed Number</label>
								<input class="form-control" id="bed_num" name="bed_num" value="" type="text" placeholder="Bed Number">
								</div>
								
								<div class="col-md-2">
								<label style="visibility: hidden;">test	</label><br><br>
								<button type="submit" class="btn btn-sm btn-success " type="button">   Add </button>
								</div>	
							</div>
							</form>
						
					
                     </div>
                  </div>
                  <div class="tab-pane <?php if(isset($tab) && $tab ==1){ echo "active"; } ?>" id="about">
                     <div class="container">
                        <div class="row">
                            <div class="card-body col-md-12 table-responsive">
								<?php if(count($roomnum_list)>0){ ?>
                                    <table id="example4" class="table table-striped table-bordered table-hover  order-column" style="width:100%;">
                                        <thead>
                                            <tr>
												<th>Floor Number</th>
												<th>Room Number</th>
												<th>Bed Count</th>
                                                <th>Create date</th>
                                                <th>Status</th>
                                                <th>Action</th>
												
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php foreach($roomnum_list as $list){ ?>
                                            <tr>
                                                <td><?php echo htmlentities($list['ward_floor']); ?></td>
                                               <td><?php echo htmlentities($list['room_num']); ?></td>
												 <td><?php echo htmlentities($list['bed_count']); ?></td>
                                                <td><?php echo htmlentities($list['create_at']); ?></td>
												<td><?php if($list['status']==1){ echo "Active";}else{ echo "Deactive"; } ?></td>
                                                <td class="valigntop">
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            
															<li>
                                                                <a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($list['w_r_n_id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus('<?php echo $list['status'];?>')" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                                                                    <i class="fa fa-edit"></i><?php if($list['status']==0){ echo "Active";}else{ echo "Deactive"; } ?> </a>
                                                            </li> 
															
													<li>
                                                            <a href="<?php echo base_url('ward_management/roomnumberedit/'.base64_encode($list['w_r_n_id'])); ?>">
                                                             <i class="fa fa-edit"></i>Edit</a>
                                                    </li>
											                <li>
															<a href="javascript;void(0);" onclick="admindelete('<?php echo base64_encode(htmlentities($list['w_r_n_id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus2('<?php echo $list['status'];?>')" href="javascript:void(0)" data-toggle="modal" data-target="#myModal"> 
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
								<div>No data available</div>
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
        "order": [[ 1, "desc" ]]
    } );
} );
function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('ward_management/roomnumberstatus'); ?>"+"/"+id);
}
function adminstatus(id){
	if(id==1){
			$('#content1').html('Are you sure you want to Deactivate?');
		
	}if(id==0){
			$('#content1').html('Are you sure you want to activate?');
	}
}
function admindelete(id){
	$(".popid").attr("href","<?php echo base_url('ward_management/roomnumberdelete'); ?>"+"/"+id);
}
function adminstatus2(id){
	
			$('#content1').html('Are you sure you want to delete?');

}
$(document).ready(function() {
    $('#room_num').bootstrapValidator({
        
        fields: {
			floor_number: {
                 validators: {
					notEmpty: {
						message: 'Floor number is required'
					}
				}
            },
			
            
            room_num: {
                 validators: {
					notEmpty: {
						message: 'Room number is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9&. ]+$/,
					message: 'Room number can only consist of alphanumeric, space and dot'
					}
				}
            },bed_num: {
                 validators: {
					notEmpty: {
						message: 'Bed number is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9&. ]+$/,
					message: 'Bed number can only consist of alphanumeric, space and dot'
					}
				}
            }
            }
        })
     
});

</script>