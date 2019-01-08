<?php //echo '<pre>';print_r($hospital_details);exit; ?>
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Add Test Type</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Add Test Type</li>
            </ol>
         </div>
      </div>
   
         <div class="panel tab-border card-topline-green">
            <header class="panel-heading panel-heading-gray custom-tab ">
               <ul class="nav nav-tabs">
                  <li class="nav-item"><a href="#home" data-toggle="tab" class="<?php if(isset($tab) && $tab ==''){ echo "active"; } ?>">Add Test Type </a>
                  </li>
                  <li class="nav-item"><a href="#about" data-toggle="tab" class="<?php if(isset($tab) && $tab ==1){ echo "active"; } ?>">Test Type List</a>
                  </li>
               </ul>
            </header>
            <div class="panel-body">
               <div class="tab-content">
                  <div class="tab-pane <?php if(isset($tab) && $tab ==''){ echo "active"; } ?>" id="home">
				  <div class="container">
                     
					  <form action="<?php echo base_url('lab/addtest_type'); ?>" method="post" id="add_typetest" name="add_typetest" enctype="multipart/form-data">
								<div class="row">
								<div class="col-md-6">
									<label> Name</label>
								<input class="form-control" id="test_type" name="test_type" value="" type="text" placeholder="Name">
								</div>
								<div class="col-md-6">
									<label>Type</label>
									<select class="form-control" name="type" id="type">
									<option value="">Select</option>
									<option value="Lab">Lab</option>
									<option value="Radiology">Radiology</option>
									</select>
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
								<?php if(count($test_list)>0){ ?>
                                    <table id="example4" class="table table-striped table-bordered table-hover  order-column" style="width:100%;">
                                        <thead>
                                            <tr>
												<th>Test Name</th>
												<th>Type</th>
                                                <th>Created Date&Time</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php foreach($test_list as $list){ ?>
                                            <tr>
                                                <td><?php echo htmlentities($list['type_name']); ?></td>
                                                <td><?php echo htmlentities($list['type']); ?></td>
                                                <td><?php echo htmlentities($list['create_at']); ?></td>
												<td><?php if($list['status']==1){ echo "Active";}else{ echo "Deactive"; } ?></td>
                                                <td class="valigntop">
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li>
								                                <a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($list['id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus('<?php echo $list['status'];?>')" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                                                                    <i class="fa fa-edit"></i><?php if($list['status']==0){ echo "Active";}else{ echo "Deactive"; } ?> </a>
                                                            </li> 
															<li data-toggle="modal" data-target="#foldersmallModalmove<?php echo $list['id']; ?>"><a href="javascript:void(0);"> <i class="fa fa-edit"></i>Edit</a></a></li>

                                                            <li>
								                                <a href="javascript;void(0);" onclick="admindelete('<?php echo base64_encode(htmlentities($list['id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus2('<?php echo $list['status'];?>')" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                                                                    <i class="fa fa-trash-o"></i>Delete</a>
                                                            </li>
                                                            
                                                            
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
											<div class="modal fade" id="foldersmallModalmove<?php echo $list['id']; ?>" tabindex="-1" role="dialog">
										   <div class="modal-dialog modal-sm" role="document">
											  <div class="modal-content">
												 <form id="foldermoving" name="foldermoving" action="<?php echo base_url('lab/update_test_type'); ?>" method="post">
													<?php $csrf = array(
													   'name' => $this->security->get_csrf_token_name(),
													   'hash' => $this->security->get_csrf_hash()
													   ); ?>
													<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
													<input type="hidden" name="test_id" id="test_id" value="<?php echo $list['id']; ?>" >
													<div class="modal-header">
														<h4 class="modal-title" id="smallModalLabel">Test Type Rename</h4>
													</div>
													<div class="modal-body">
														<div class="form-group">
														<div class="form-line">
														<input type="text" id="editname" name="editname" class="form-control" value="<?php echo htmlentities($list['type_name']);?>" required>
														</div>
														</div>
													</div>
													<div class="col-md-12">
														<label>Type</label>
														<select class="form-control" name="type" id="type" required>
														<option value="">Select</option>
														<option value="Lab" <?php if($list['type']=='Lab'){ echo "selected";} ?>>Lab</option>
														<option value="Radiology" <?php if($list['type']=='Radiology'){ echo "selected";} ?>>Radiology</option>
														</select>
													</div>
													<div class="modal-footer">
														<button type="submit" class="btn btn-link waves-effect">Update </button>
														<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
													</div>
												 </form>
											  </div>
										   </div>
										</div>
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
        "order": [[ 2, "desc" ]]
    } );
} );

function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('lab/test_type_status'); ?>"+"/"+id);
}
function adminstatus(id){
	if(id==1){
			$('#content1').html('Are you sure you want to deactivate?');
		
	}if(id==0){
			$('#content1').html('Are you sure you want to activate?');
	}
}
function admindelete(id){
	$(".popid").attr("href","<?php echo base_url('lab/deletetest_type'); ?>"+"/"+id);
}
function adminstatus2(id){
	
			$('#content1').html('Are you sure you want to delete?');

}



$(document).ready(function() {
    $('#add_typetest').bootstrapValidator({
        
        fields: {
            
            test_type: {
                 validators: {
					notEmpty: {
						message: 'Lab Test Type is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Lab Test Type can only consist of alphanumeric, space and dot'
					}
				}
            },type: {
                 validators: {
					notEmpty: {
						message: 'Type is required'
					}
				}
            }
            }
        })
     
});
</script>