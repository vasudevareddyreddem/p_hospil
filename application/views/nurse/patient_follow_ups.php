<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Patient Follow Ups</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Nurse</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Patient Follow Ups</li>
            </ol>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="panel tab-border card-topline-green">
              
               <div class="panel-body">
                
				<div class="clearfix">&nbsp;</div>
				<div class="table-responsive">
						 <table id="example4" class="table table-bordered" style="width:100%;">
                                        <thead>
                                            <tr>
                                               
                                                <th>Patient ID</th>
												<th>Patient Name</th>
                                                <th>Gender </th>
                                                <th>Age</th>
                                                <th>Doctor</th>
                                                <th>Diagnosis</th>
                                                <th>Date of Admit</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php if(isset($admit_patient_list) && count($admit_patient_list)>0){ ?>
										<?php foreach($admit_patient_list as $list){ ?>
                                            <tr>
                                               
                                                <td><?php echo isset($list['pt_id'])?$list['pt_id']:''; ?></td>
                                                <td><?php echo isset($list['name'])?$list['name']:''; ?></td>
                                                <td><?php echo isset($list['gender'])?$list['gender']:''; ?></td>
                                                <td><?php echo isset($list['age'])?$list['age']:''; ?></td>
                                                <td><?php echo isset($list['resource_name'])?$list['resource_name']:''; ?></td>
                                                <td><?php echo isset($list['t_name'])?$list['t_name']:''; ?></td>
                                                <td><?php echo isset($list['date_of_admit'])?$list['date_of_admit']:''; ?></td>
											
                                                <td class="valigntop">
                                                    <div class="btn-group">
                                                        <a href="<?php echo base_url('nurse/consultation/'.base64_encode($list['pt_id']).'/'.base64_encode($list['bill_id']));?>" class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" > Start Consultation
                                                           
                                                        </a>
                                                      
                                                    </div>
                                                </td>
                                            </tr>
										<?php } ?>
										<?php } ?>
											
                                        </tbody>
                                    </table>
				</div>
            </div>
         </div>
      </div>
   </div>
</div>
<div id="sucessmsg" style="display:none;"></div>
 <script>
$(document).ready(function() {
    $('#example4').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );
</script>
