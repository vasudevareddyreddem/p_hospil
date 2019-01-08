<div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
			  <div class="page-title-breadcrumb">
				 <div class=" pull-left">
					<div class="page-title">Rejected Patient List</div>
				 </div>
				 <ol class="breadcrumb page-breadcrumb pull-right">
					<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
					</li>
					<li><a class="parent-item active" >Rejected Patient List</a>&nbsp;</i>
					</li>
				 </ol>
			  </div>
		   </div>
					<div class="row">
                       <div class="col-md-12">
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                     <header>Rejected Patient List</header>
                                   
                                </div>
                                <div class="card-body  table-responsive">
								<?php if(count($rejected_patient_list)>0){ ?>
								<table class="table table-striped table-bordered table-hover table-checkable order-column" id="example4">
                                        <thead>
                                            <tr>
												
                                                <th>Patient Name </th>
                                                <th>Mobile</th>
                                                <th>City</th>
												<th>Hospital Name</th>
                                                <th>Department</th>
                                                <th>Speciality</th>
                                                <th>Doctor Name</th>
                                                <th>Booking Date & Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php foreach($rejected_patient_list as $list){ ?>
										
										<?php //echo '<pre>';print_r($list);exit; ?>
                                            <tr>
                                               
                                                <td><?php echo htmlentities($list['patinet_name']); ?></td>
                                                <td><?php echo htmlentities($list['mobile']); ?></td>
												 <td><?php echo htmlentities($list['city']); ?></td>
												 <td><?php echo htmlentities($list['hos_bas_name']); ?></td>
												 <td><?php echo htmlentities($list['t_name']); ?></td>
												 <td><?php echo htmlentities($list['specialist_name']); ?></td>
												 <td><?php echo htmlentities($list['resource_name']); ?></td>
												 <td><?php echo htmlentities($list['date']); ?> &nbsp;<?php echo htmlentities($list['time']); ?></td>
                                               
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
 