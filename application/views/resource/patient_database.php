<?php //echo '<pre>';print_r($hospital_details);exit; ?>
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Patient Registration Database</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Patient Registration Database</li>
            </ol>
         </div>
      </div>
	  <div class="row">	
			<div class="col-md-12">
                            <div class="panel tab-border card-topline-yellow">
                                
                                <div class="panel-body">
                                    <div class="tab-content">
                                       
					
                                            <div class="card card-topline-red">
	
	<div class="card-body table-responsive">
	<?php if(isset($patients_list) && count($patients_list)>0){ ?>
		<table class="table table-striped table-bordered table-hover table-checkable order-column" id="example4">
			<thead>
				<tr>
					<th> Patient Id </th>
					<th> Patient Card Number</th>
					<th> Name </th>
					<th> Type </th>
					<th> Category </th>
					<th> Age </th>
					<th> Mobile </th>
					<th> Created on </th>
					<th> Action </th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($patients_list as $list){ ?>
				<tr class="odd gradeX">
					
					<td> <?php echo $list['pid']; ?> </td>
					<td> <?php echo $list['card_number']; ?> </td>
					<td>
						<?php echo $list['name']; ?>
					</td>
					<td>
						<?php echo $list['registrationtype']; ?>
					</td>
					<td><?php echo $list['patient_category']; ?> </td>
					<td><?php echo $list['age']; ?> </td>
					<td><?php echo $list['mobile']; ?> </td>
					<td><?php echo date('M j h:i A',strtotime(htmlentities($list['create_at'])));?></td>
					<td class="valigntop">
						<div class="btn-group">
							<button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
								<i class="fa fa-angle-down"></i>
							</button>
							<ul class="dropdown-menu pull-left" role="menu">
								<li>
									<a href="<?php echo base_url('resources/desk/'.base64_encode($list['pid']).'/'.base64_encode(1)); ?>">
										<i class="icon-docs"></i> Edit </a>
								</li>
								<li>
									<a href="<?php echo base_url('resources/desk/'.base64_encode($list['pid']).'/'.base64_encode(8)); ?>">
										<i class="icon-docs"></i> Billing </a>
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