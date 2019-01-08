			<div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
			  <div class="page-title-breadcrumb">
				 <div class=" pull-left">
					<div class="page-title">Referrals</div>
				 </div>
				 <ol class="breadcrumb page-breadcrumb pull-right">
					<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
					</li>
					<li><a class="parent-item active" >Referrals List</a>&nbsp;</i>
					</li>
				 </ol>
			  </div>
		   </div>
					<div class="row">
                       <div class="col-md-12">
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                     <header>My Referrals</header>
                               
                                </div>
                                <div class="card-body ">
								<?php if(count($worksheet)>0){ ?>
                                    <table id="example4" class="table table-striped table-bordered" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Slot</th>
												<th>Patient Id</th>
												 <th>Patient Card Number </th>
												<th>Patient Name </th>
                                                <th>Age</th>
                                                <th>Visit-Type</th>
                                                <th>Referred By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php foreach($worksheet as $list){ ?>
                                            <tr>
                                                <td><button class="btn btn-xs bg-success no-margin" type="button"><?php echo htmlentities($list['type']); ?></button></td>
                                                <td><?php echo htmlentities($list['pid']); ?></td>
                                                <td><?php echo htmlentities($list['card_number']); ?></td>
                                                <td><?php echo htmlentities($list['name']); ?></td>
                                                
												<td> <?php echo htmlentities($list['age']); ?></td>
												<td><?php echo htmlentities($list['visit_type']); ?></td>
												<td><?php echo htmlentities($list['assignbydoctor']); ?></td>
                                                <td> 
												  <a href="<?php echo base_url('resources/consultation/'.base64_encode($list['pid']).'/'.base64_encode($list['b_id'])); ?>" class="btn btn-xs bg-primary no-margin" type="button">Start Consultation</a>
												  <button class="btn btn-xs bg-danger no-margin" type="button">Close</button>
                                                </td>
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