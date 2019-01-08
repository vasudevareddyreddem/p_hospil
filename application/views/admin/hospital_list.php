<div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
			  <div class="page-title-breadcrumb">
				 <div class=" pull-left">
					<div class="page-title">Hospital List</div>
				 </div>
				 <ol class="breadcrumb page-breadcrumb pull-right">
					<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
					</li>
					<li><a class="parent-item active" >Hospital List</a>&nbsp;</i>
					</li>
				 </ol>
			  </div>
		   </div>
					<div class="row">
                       <div class="col-md-12">
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                     <header>Hospitals</header>
                                   
                                </div>
                                <div class="card-body  table-responsive">
								<?php if(count($hospital_list)>0){ ?>
								<table class="table table-striped table-bordered table-hover table-checkable order-column" id="example4">
                                        <thead>
                                            <tr>
												<th>HIN</th>
												<th>Name</th>
                                                <th>Contact </th>
                                                <th>Patient Intake</th>
                                                <th>Onine Status</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php foreach($hospital_list as $list){ ?>
										
										<?php //echo '<pre>';print_r($list);exit; ?>
                                            <tr>
                                                <td><?php echo htmlentities($list['hos_id']); ?></td>
                                                <td><?php echo htmlentities($list['hos_bas_name']); ?></td>
                                                <td><?php echo htmlentities($list['hos_con_number']); ?></td>
                                                <td>Total : <?php echo htmlentities($list['patient_list']); ?>&nbsp;(OP:<?php echo isset($list['op_patient_list'])?$list['op_patient_list']:''; ?>)&nbsp;(IP:<?php echo isset($list['ip_patient_list'])?$list['ip_patient_list']:''; ?>)&nbsp;(Appointment:<?php echo isset($list['appoint_patient_list'])?$list['appoint_patient_list']:''; ?>)</td>
												<td><?php if($list['hos_curent_login']==1){ echo "Online";}else{ echo "Offline"; } ?></td>
												<td><?php if($list['hos_status']==1){ echo "Active";}else{ echo "Deactive"; } ?></td>
                                                <td class="valigntop">
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li>
                                                                <a href="<?php echo base_url('hospital/edit/'.base64_encode($list['hos_id'])); ?>">
                                                                    <i class="fa fa-edit"></i>Edit </a>
                                                            </li>
                                                            <li>
															    <a href="javascript;void(0);" onclick="admindelete('<?php echo base64_encode(htmlentities($list['hos_id'])).'/'.base64_encode(htmlentities($list['hos_status']));?>');adminstatus2('<?php echo $list['hos_status'];?>')" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                                                                    <i class="fa fa-trash-o"></i>Delete</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url('hospital/view/'.base64_encode($list['hos_id'])); ?>">
                                                                    <i class="fa fa-save"></i> View</a>
                                                            </li>
															<li>
                                                                <a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($list['hos_id'])).'/'.base64_encode(htmlentities($list['hos_status']));?>');adminstatus('<?php echo $list['hos_status'];?>')" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                                                                    <i class="fa fa-edit"></i><?php if($list['hos_status']==0){ echo "Active";}else{ echo "Deactive"; } ?> </a>
                                                            </li>
                                                            
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
										<?php } ?>
											
                                            
                                        </tbody>
                                    </table>
								<?php } ?>
                                </div>
								<div class="clearfix">&nbsp;</div>
							
                            </div>
                        </div>
                    </div>
				
                    
                </div>
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
				</div>
				<div class="row">
				<div class="col-md-6 col-sm-6  col-sm-6 ">
				  <button type="button" aria-label="Close" data-dismiss="modal" class="btn  blueBtn pull-left">Cancel</button>
				</div>
				<div class="col-md-6 col-sm-6  col-sm-6 ">
                <a href="?id=value" class="btn  blueBtn popid pull-right" style="text-decoration:none;"> <span aria-hidden="true">Ok</span></a>
				</div>
			 </div>
		  </div>
      </div>
      
    </div>
  </div>
  <script>
$(document).ready(function() {
    $('#example4').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );
</script>
  <script>
  function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('hospital/status'); ?>"+"/"+id);
}
function adminstatus(id){
	if(id==1){
			$('#content1').html('Are you sure you want to Deactivate?');
		
	}if(id==0){
			$('#content1').html('Are you sure you want to activate?');
	}
}
function admindelete(id){
	$(".popid").attr("href","<?php echo base_url('hospital/deletes'); ?>"+"/"+id);
}
function adminstatus2(id){
	
			$('#content1').html('Are you sure you want to delete?');

}
  </script>