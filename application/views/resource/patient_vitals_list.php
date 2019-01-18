			<div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
			  <div class="page-title-breadcrumb">
				 <div class=" pull-left">
					<div class="page-title">Patient Vitals List</div>
				 </div>
				 <ol class="breadcrumb page-breadcrumb pull-right">
					<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
					</li>
					<li><a class="parent-item active" >Patient Vitals List</a>&nbsp;</i>
					</li>
				 </ol>
			  </div>
		   </div>
					<div class="row">
                       <div class="col-md-12">
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                     <header>Patient Vitals List</header>
                               
                                </div>
                                <div class="card-body ">
								<?php if(count($patients_vital_list)>0){ ?>
                                    <table id="example4" class="table table-striped table-bordered" style="width:100%;">
                                        <thead>
                                            <tr>
												<th>S.NO </th>
												<th>BP (80-120) </th>
												<th>Pulse (70-80)</th>
												<th>FBS/RBS (70-110) </th>
                                                <th>Temp (98.6 F)</th>
                                                <th>Weight</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php $cnt=1;foreach($patients_vital_list as $list){ ?>
                                            <tr>
                                                <td><?php echo isset($cnt)?$cnt:''; ?></td>
                                                <td><?php echo htmlentities($list['bp']); ?></td>
                                                <td><?php echo htmlentities($list['pulse']); ?></td>
                                                
												<td> <?php echo htmlentities($list['fbs_rbs']); ?></td>
												<td> <?php echo htmlentities($list['temp']); ?></td>
												<td> <?php echo htmlentities($list['weight']); ?></td>
												<td> <?php echo htmlentities($list['date']); ?></td>
												
                                            </tr>
										<?php $cnt++;} ?>
											
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
        "order": [[ 6, "desc" ]]
    } );
} );
</script>