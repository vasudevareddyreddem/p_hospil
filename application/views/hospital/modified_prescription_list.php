<div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
			  <div class="page-title-breadcrumb">
				 <div class=" pull-left">
					<div class="page-title">Modified Prescription List</div>
				 </div>
				 <ol class="breadcrumb page-breadcrumb pull-right">
					<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
					</li>
					<li><a class="parent-item active" >Modified Prescription List</a>&nbsp;</i>
					</li>
				 </ol>
			  </div>
		   </div>
					<div class="row">
                       <div class="col-md-12">
                            <div class="card card-topline-aqua">
							
                                <div class="card-head">
                                     <header>Modified Prescription List</header>
                                   
                                </div>
                                <div class="card-body table-responsive">
								<?php if(count($get_m_precption_list)>0){ ?>
                                    <table id="example4" class="table table-striped table-bordered table-hover  order-column" style="width:100%;">
                                        <thead>
                                            <tr>
												<th>Patient Id</th>
												<th>Patient Card Number</th>
												<th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php foreach($get_m_precption_list as $list){ ?>
                                            <tr>
                                                <td><?php echo htmlentities($list['pid']); ?></td>
                                                <td><?php echo htmlentities($list['card_number']); ?></td>
                                                <td><?php echo htmlentities($list['name']); ?></td>
                                                <td><a href="<?php echo base_url('hospital/viewprescription/'.base64_encode($list['pid']).'/'.base64_encode($list['b_id'])); ?>">View</a></td>
                                               
                                            </tr>
										<?php } ?>
											
                                            
                                        </tbody>
                                    </table>
								<?php }else{ ?>
								<div>No data Available</div>
								
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
