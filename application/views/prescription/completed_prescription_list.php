<div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
			  <div class="page-title-breadcrumb">
				 <div class=" pull-left">
					<div class="page-title">Completed Prescription List</div>
				 </div>
				 <ol class="breadcrumb page-breadcrumb pull-right">
					<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
					</li>
					<li><a class="parent-item active" >Completed Prescription List</a>&nbsp;</i>
					</li>
				 </ol>
			  </div>
		   </div>
					<div class="row">
                       <div class="col-md-12">
                            <div class="card card-topline-aqua">
							
                                <div class="card-head">
                                     <header>Completed Prescription List</header>
                                   
                                </div>
                                <div class="card-body table-responsive">
								<?php if(count($prescriptions)>0){ ?>
									<table class="table table-striped table-bordered table-hover table-checkable order-column" id="example4">
                                        <thead>
                                            <tr>
												<th>Patient Id</th>
												<th>Name</th>
                                                <th>Doctor</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php foreach($prescriptions as $list){ ?>
                                            <tr>
                                                <td><?php echo htmlentities($list['pid']); ?></td>
                                                <td><?php echo htmlentities($list['name']); ?></td>
                                                <td><?php echo htmlentities($list['created_by']); ?></td>
                                                <td><?php echo date('M j Y h:i A',strtotime(htmlentities($list['create_at'])));?></td>
                                                <td><a target="_blank" href="<?php echo base_url('Users/viewprescription/'.base64_encode($list['pid']).'/'.base64_encode($list['b_id'])); ?>">view</a></td>
                                               
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
<script>
$(document).ready(function() {
    $('#example4').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );
</script>