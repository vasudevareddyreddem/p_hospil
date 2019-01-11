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
                                       
					
                                            <div class="">
	
	<div class="card-body table-responsive">
	<?php if(isset($patients_list) && count($patients_list)>0){ ?>
		<table class="table table-striped table-bordered table-hover table-checkable order-column" id="example4">
			<thead>
				<tr>
					<th> Patient Id </th>
					
					<th> Name </th>
					
					<th> Age </th>
					<th> Mobile </th>
					<th> Created on </th>
					
				</tr>
			</thead>
			<tbody>
			<?php foreach($patients_list as $list){ ?>
				<tr class="odd gradeX">
					
					<td> <?php echo $list['pid']; ?> </td>
					
					<td>
						<?php echo $list['name']; ?>
					</td>
					
					<td><?php echo $list['age']; ?> </td>
					<td><?php echo $list['mobile']; ?> </td>
					<td><?php echo date('M j h:i A',strtotime(htmlentities($list['create_at'])));?></td>
					
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