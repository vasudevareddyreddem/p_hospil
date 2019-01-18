			<div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
			  <div class="page-title-breadcrumb">
				 <div class=" pull-left">
					<div class="page-title">Completed Worksheet</div>
				 </div>
				 <ol class="breadcrumb page-breadcrumb pull-right">
					<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
					</li>
					<li><a class="parent-item active" >Worksheet List</a>&nbsp;</i>
					</li>
				 </ol>
			  </div>
		   </div>
					<div class="row">
                       <div class="col-md-12">
                            <div class="card card-topline-aqua">
							
                                <div class="card-head">
                                     <header>Completed worksheet</header>
                               
                                </div>
                                <div class="card-body table-responsive">
								<?php if(count($worksheet)>0){ ?>
                                    <table id="example4" class="table table-striped table-bordered" style="width:100%;">
                                        <thead>
                                            <tr>
												<th>Patient Id</th>
												<th>Patient Name </th>
                                                <th>Age</th>
                                                <th>Visit-Type</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php foreach($worksheet as $list){ ?>
                                            <tr>
                                                <td><?php echo htmlentities($list['pid']); ?></td>
												<td><?php echo htmlentities($list['name']); ?></td>
                                                <td> <?php echo htmlentities($list['age']); ?> </td>
												<td><?php if($list['patient_type']==0){ echo "OP";}else{ echo "IP"; } ?></td>
												<td><?php if($list['completed']==1){ echo "Completed"; }else{ echo "pending"; } ?></td>
                                              
                                            </tr>
										<?php } ?>
											
                                        </tbody>
                                    </table>
										<?php }else{ ?>
										<div>No data available</div>
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