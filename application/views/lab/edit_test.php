<?php //echo '<pre>';print_r($hospital_details);exit; ?>
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Edit Lab Test</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Edit Lab Test</li>
            </ol>
         </div>
      </div>
	  <div class="panel tab-border card-topline-green">
            
            <div class="panel-body">
               <div class="tab-content">
                  <div class="tab-pane active" id="home">
				  <div class="container">
                     
					  <form action="<?php echo base_url('lab/updatetest'); ?>" method="post" id="addtreatment" name="addtreatment" enctype="multipart/form-data">
							<div class="row">
							<input type="hidden" name="t_id" id="t_id" value="<?php echo isset($tet_details['t_id'])?$tet_details['t_id']:''; ?>">
							<div class="col-md-6">
							<label> Test Type</label>
								<input class="form-control" id="test_type" name="test_type" value="<?php echo isset($tet_details['test_type'])?$tet_details['test_type']:''; ?>" type="text" placeholder="Test Type">
								</div>
							
								<div class="col-md-6">
									<label>Type</label>
									<select class="form-control" name="type" onchange="get_labtype(this.value);" id="type">
									<option value="">Select</option>
									<option value="Lab" <?php if($tet_details['type']=='Lab'){ echo "selected"; } ?>>Lab</option>
									<option value="Radiology" <?php if($tet_details['type']=='Radiology'){ echo "selected"; } ?>>Radiology</option>
									</select>
								</div>
								<div class="col-md-6">
									<label> Name</label>
								<input class="form-control" id="test_name" name="test_name" value="<?php echo isset($tet_details['t_name'])?$tet_details['t_name']:''; ?>" type="text" placeholder="Name">
								</div>
								<?php if($tet_details['modality']!=''){ 
										$show='';
										}else{
										$show='display:none';
										} ?>										
									<div class="col-md-6" id="modality_id" style="<?php echo $show; ?>">
									<label>Modality</label>
									<input class="form-control" id="modality" name="modality" value="<?php echo isset($tet_details['modality'])?$tet_details['modality']:''; ?>" type="text" placeholder="Enter Modality">
									</div>
								<div class="col-md-6">
									<label> Duration</label>
									<input class="form-control" id="duration" name="duration" value="<?php echo isset($tet_details['duration'])?$tet_details['duration']:''; ?>" type="text" placeholder="Duration">
								</div>
								<div class="col-md-6">
									<label> Amount</label>
									<input class="form-control" id="amuont" name="amuont" value="<?php echo isset($tet_details['amuont'])?$tet_details['amuont']:''; ?>" type="text" placeholder="Amount">
								</div>
								<div class="">
								<label>&nbsp;</label>
								</div>	
									</div>
							
							<button type="submit" class="btn btn-sm btn-success pull-right" type="button">Update Test</button>
                            <div class="clearfix">&nbsp;</div>
							</form>
						</div>
					
                     </div>
                  </div>
               </div>
            </div>
            <div class="clearfix">&nbsp;</div>
       
      </div>
   </div>
</div>
<script>

function get_labtype(value){
	if(value=='Radiology'){
		$('#modality_id').show();
		$('#modality').val('');
	}else{
		$('#modality_id').hide();
		$('#modality').val('');
	}
	
}
$(document).ready(function() {
    $('#addtreatment').bootstrapValidator({
        
        fields: {
            
            test_type: {
                 validators: {
					notEmpty: {
						message: 'Test type is required'
					}
				}
            },
			type: {
                 validators: {
					notEmpty: {
						message: 'Type is required'
					}
				}
            },test_name: {
                 validators: {
					notEmpty: {
						message: 'Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Name can only consist of alphanumeric, space and dot'
					}
				}
            },modality: {
                 validators: {
					notEmpty: {
						message: 'Modality is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Modality can only consist of alphanumeric, space and dot'
					}
				}
            },			
			duration: {
                 validators: {
					notEmpty: {
						message: 'Duration is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Duration can only consist of alphanumeric, space and dot'
					}
				}
            },
			amuont: {
                 validators: {
					notEmpty: {
						message: 'Amuont is required'
					},
					regexp: {
					regexp: /^[0-9. ]*$/,
					message: 'Amuont can only consist of digits and dot'
					}
				}
            }
            }
        })
     
});
</script>