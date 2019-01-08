<div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
			  <div class="page-title-breadcrumb">
				 <div class=" pull-left">
					<div class="page-title">Patient Lab Report Details</div>
				 </div>
				 <ol class="breadcrumb page-breadcrumb pull-right">
					<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
					</li>
					<li><a class="parent-item active" >Patient Details</a>&nbsp;</i>
					</li>
				 </ol>
			  </div>
		   </div>
					<div class="row">
                       <div class="col-md-12">
                            <div class="card card-topline-aqua">
							
                                <div class="card-head">
                                     <header>Patient Lab Report Details</header>
                                   
                                </div>
                                <div class="card-body ">
								<?php if(count($patient_details)>0){ ?>
								<table class="table table-striped table-bordered table-hover table-checkable order-column" id="example4">
                                        <thead>
                                            <tr>
                                                <th>Problem</th>
                                                <th>Symptom</th>
                                                <th>Date& Time</th>
                                                <th>Download</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php foreach($patient_details as $list){ ?>
                                            <tr>
                                                <td><?php echo htmlentities($list['problem']); ?></td>
                                                <td><?php echo htmlentities($list['symptoms']); ?></td>
                                                <td><?php echo date('M j Y h:i A',strtotime(htmlentities($list['create_at'])));?></td>
                                                <td><a href="<?php echo base_url('assets/patient_reports/'.$list['image']); ?>">download</a></td>
                                               
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
        "order": [[2, "desc" ]]
    } );
} );


</script>