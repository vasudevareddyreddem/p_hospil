<?php //echo '<pre>';print_r($hospital_details);exit; ?>
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Department List</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Department List</li>
            </ol>
         </div>
      </div>
      <div class="panel tab-border card-topline-green">
         <header class="panel-heading panel-heading-gray custom-tab ">
            <ul class="nav nav-tabs">
               <li class="nav-item"><a href="#home" data-toggle="tab" class="<?php if(isset($tab) && $tab ==''){ echo "active"; } ?>"> Add Department </a>
               </li>
               <li class="nav-item"><a href="#about" class="<?php if(isset($tab) && $tab ==1){ echo "active"; } ?>" data-toggle="tab">Department Wise Consultant Names</a>
               </li>
            </ul>
         </header>
         <div class="panel-body">
            <div class="tab-content">
               <div class="tab-pane <?php if(isset($tab) && $tab ==''){ echo "active"; } ?>" id="home">
                  <div class="row">
                     <div class="col-md-12 ">
                        <div class="container">
                           <div class="control-group" id="fields">
                              <label class="control-label" for="field1"><strong>Department Details</strong></label>
                              <div class="controls">
                                 <form action="<?php echo base_url('hospital/treatmenaddtpost'); ?>" method="POST" id="treatmentform" name="treatmentform" role="form" autocomplete="off">
                                    <div class="entry input-group ">
                                       
									   <select  class="form-control" id="treatment_name" onchange="get_department_list(this.value);" name="treatment_name" required>
									   <?php if(count($treatment_list)>0){ ?>
									   <option value="">Select</option>
									   <?php foreach($treatment_list as $list){ ?>
									   <option value="<?php echo $list['t_id']; ?>"><?php echo $list['t_name']; ?> </option>
									   <?php } ?>
									   <?php } ?>
									   </select>&nbsp;
										<select id="specialist_doc" name="specialist_doctor_id" class="form-control" >
                                                  <option value="">Select Speciality</option>
                                         </select>
										<select  class="form-control" id="assign_doctor" name="assign_doctor" required>
									   <?php if(count($doctors_list)>0){ ?>
									   <option value="">Select</option>
									   <?php foreach($doctors_list as $list){ ?>
									   <option value="<?php echo $list['a_id']; ?>"><?php echo $list['resource_name']; ?> </option>
									   <?php } ?>
									   <?php } ?>
									   </select>
                                      
                                    </div>
                                 
                                 <br>
								 									
                              </div>
							  <button type="submit" class="btn btn-sm btn-success">Add  consultant</button>

								 </form>
                           </div>
                        </div>                                         
                        <div class="clearfix">&nbsp;</div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane <?php if(isset($tab) && $tab ==1){ echo "active"; } ?>" id="about">
                  <div class="container table-responsive">
					<?php if(count($hospital_treatment_list)>0){ ?>
                                    <table id="saveStage" class="table table-striped table-bordered table-hover  order-column" style="width:100%;">
                                        <thead>
                                            <tr>
												<th>Department Name</th>
												<th>Speciality Name</th>
												<th>Consultant Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php foreach($hospital_treatment_list as $list){ ?>
                                            <tr>
                                                <td><?php echo htmlentities($list['t_name']); ?></td>
                                                <td><?php echo htmlentities($list['specialist_name']); ?></td>
                                                <td><?php echo htmlentities($list['resource_name']); ?></td>
												<td><?php if($list['t_d_status']==1){ echo "Active";}else{ echo "Deactive"; } ?></td>
                                                
												<td><a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($list['t_d_id'])).'/'.base64_encode(htmlentities($list['t_d_status']));?>');adminstatus('<?php echo $list['t_d_status'];?>')" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                                                                   <?php if($list['t_d_status']==0){ echo "Active";}else{  echo "Deactive";}?>  </a> |
												<a href="javascript;void(0);" onclick="admindelete('<?php echo base64_encode(htmlentities($list['t_d_id'])).'/'.base64_encode(htmlentities($list['t_d_status']));?>');adminstatus2('<?php echo $list['t_d_status'];?>')" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">Delete</a>          
                                                </td>
												
                                            </tr>
										<?php } ?>
											
                                            
                                        </tbody>
                                    </table>
								<?php } ?>
                  </div>
               </div>
            </div>
         </div>
         <div class="clearfix">&nbsp;</div>
		 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
			
			<div style="padding:10px">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 style="pull-left" class="modal-title">Confirmation</h4>
			</div>
			<div class="modal-body">
			<div class="alert alert-danger alert-dismissible" id="errormsg" style="display:none;"></div>
			  <div class="row">
				<div id="content1" class="col-xs-12 col-xl-12 form-group">
				Are you sure ? 
				</div>
				<div class="col-xs-6 col-md-6">
				  <button type="button" aria-label="Close" data-dismiss="modal" class="btn  blueBtn">Cancel</button>
				</div>
				<div class="col-xs-6 col-md-6">
                <a href="?id=value" class="btn  blueBtn popid" style="text-decoration:none;float:right;"> <span aria-hidden="true">Ok</span></a>
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


function get_department_list(id){
	
		if(id!=''){
			jQuery.ajax({
   					url: "<?php echo base_url('hospital/get_specialists_list');?>",
   					data: {
   						dep_id: id,
   					},
   					dataType: 'json',
   					type: 'POST',
   					success: function (data) {
						//console.log(data);return false;
   						$('#specialist_doc').empty();
   						$('#specialist_doc').append("<option>select</option>");
   						for(i=0; i<data.list.length; i++) {
   							$('#specialist_doc').append("<option value="+data.list[i].s_id+">"+data.list[i].specialist_name+"</option>");                      
                         
   						}
   						//console.log(data);return false;
   					}
   				
   				});
				
			}
}
function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('hospital/addtreatmentstatus'); ?>"+"/"+id);
}
function adminstatus(id){
	if(id==1){
			$('#content1').html('Are you sure you want to deactivate?');
		
	}if(id==0){
			$('#content1').html('Are you sure you want to activate?');
	}
}
function admindelete(id){
	$(".popid").attr("href","<?php echo base_url('hospital/addtreatmentdeletes'); ?>"+"/"+id);
}
function adminstatus2(id){
	
			$('#content1').html('Are you sure you want to delete?');

}
$(document).ready(function() {
    $('#treatmentform1').bootstrapValidator({
        
        fields: {
            
            'treatment_name[]': {
                 validators: {
					notEmpty: {
						message: 'Treatment is required'
					}
				}
            },
			'assign_doctor[]': {
                 validators: {
					notEmpty: {
						message: 'Doctor is required'
					}
				}
            }
            }
        })
     
});

   $(function() {
   $(".expand").on( "click", function() {
    // $(this).next().slideToggle(200);
    $expand = $(this).find(">:first-child");
    
    if($expand.text() == "+") {
      $expand.text("-");
    } else {
      $expand.text("+");
    }
   });
   });
</script>
<!--script for add row comment-->
<script>
   $(function()
   {
     $(document).on('click', '.btn-add', function(e)
     {
         e.preventDefault();
   
         var controlForm = $('.controls form:first'),
             currentEntry = $(this).parents('.entry:first'),
             newEntry = $(currentEntry.clone()).appendTo(controlForm);
   
         newEntry.find('input').val('');
         controlForm.find('.entry:not(:last) .btn-add')
             .removeClass('btn-add').addClass('btn-remove')
             .removeClass('btn-success').addClass('btn-danger')
             .html('<span class="glyphicon glyphicon-minus">-</span>');
     }).on('click', '.btn-remove', function(e)
     {
   $(this).parents('.entry:first').remove();
   
   e.preventDefault();
   return false;
   });
   });
   
</script>
<script>
   $(document).ready(function() {
     $("#select2insidemodal").select2({
       dropdownParent: $("#myModal")
     });
   });
   
</script>

