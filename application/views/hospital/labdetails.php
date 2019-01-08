<?php //echo '<pre>';print_r($hospital_details);exit; ?>
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Lab Details</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Lab Details</li>
            </ol>
         </div>
      </div>
      <div class="panel tab-border card-topline-green">
         <header class="panel-heading panel-heading-gray custom-tab ">
            <ul class="nav nav-tabs">
               <li class="nav-item"><a href="#home" data-toggle="tab" class="<?php if(isset($tab) && $tab ==''){ echo "active"; } ?>">Lab Details </a>
               </li>
               <li class="nav-item"><a href="#about" class="<?php if(isset($tab) && $tab ==1){ echo "active"; } ?>" data-toggle="tab">Lab Details List</a>
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
                              <label class="control-label" for="field1"><strong>Lab Details</strong></label>
                              <div class="controls">
                                 <form action="<?php echo base_url('hospital/tabdetailspost'); ?>" method="POST" id="labdetailsform" name="labdetailsform" role="form" autocomplete="off">
                                    <div class="entry input-group ">
                                       
									     <select  class="form-control" id="investigation" name="investigation[]" required>
									   <option value="">Select Investigation </option>
									   <option value="Lab">Lab</option>
									   <option value="Radiology">Radiology</option>
									   </select>
									   <input class="form-control" id="lab_code" name="lab_code[]" placeholder="Lab Code" required>&nbsp;
									   <input class="form-control" id="lab_name" name="lab_name[]" placeholder="Lab Name" required>&nbsp;
									    <select  class="form-control" id="lab_assistent" name="lab_assistent[]" required>
									   		<option value="">Assign Lab Assistant</option>
										<?php if(count($labassistents_list)>0){ ?>
									   <?php foreach($labassistents_list as $list){ ?>
									   <option value="<?php echo $list['r_id']; ?>"><?php echo $list['resource_name']; ?> </option>
									   <?php } ?>
									   <?php }else{ ?>
									   <option value="">Lab Assistants are Not added</option>
									   <?php } ?>
									   </select>
                                       <span class="input-group-btn">
                                       <button class="btn btn-success btn-add" type="button">
                                       <span class="glyphicon glyphicon-plus">+</span>
                                       </button>
                                       </span>
                                    </div>
                                 
                                 <br>
								 									
                              </div>
							  <button type="submit" class="btn btn-sm btn-success">Add Lab details</button>

								 </form>
                           </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane <?php if(isset($tab) && $tab ==1){ echo "active"; } ?>" id="about">
                  <div class="container">
					<?php if(count($labdetails_list)>0){ ?>
                                    <table id="saveStage" class="table table-striped table-bordered table-hover  order-column" style="width:100%;">
                                        <thead>
                                            <tr>
												<th>Investigation </th>
												<th>Lab Name</th>
												<th>Lab Code</th>
												<th>Lab Assistant</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php foreach($labdetails_list as $list){ ?>
                                            <tr>
                                                <td><?php echo htmlentities($list['l_investigation']); ?></td>
                                                <td><?php echo htmlentities($list['l_name']); ?></td>
                                                <td><?php echo htmlentities($list['l_code']); ?></td>
                                                <td><?php echo htmlentities($list['resource_name']); ?></td>
												<td><?php if($list['l_status']==1){ echo "Active";}else{ echo "Deactive"; } ?></td>
                                                <td><a href="<?php echo base_url('hospital/labdetailsstatus/'.base64_encode($list['l_id']).'/'.base64_encode($list['l_status'])); ?>">
                                                                   <?php if($list['l_status']==0){ echo "Active";}else{  echo "Deactive";}?>  </a> |
												<a href="<?php echo base_url('hospital/labdetailsdeletes/'.base64_encode($list['l_id'])); ?>">Delete</a>
                                                    
                                                          
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
      </div>
   </div>
</div>
<script>
$(document).ready(function() {
    $('#labdetailsform1').bootstrapValidator({
        
        fields: {
            
            'lab_code[]': {
                 validators: {
					notEmpty: {
						message: 'Lab Code is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Lab Code can only consist of alphanumeric, space and dot'
					}
				}
            },
			 'lab_name[]': {
                validators: {
					notEmpty: {
						message: 'Lab Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Lab Name can only consist of alphanumeric, space and dot'
					}
				}
            },'lab_assistent[]': {
                 validators: {
					notEmpty: {
						message: 'Lab Assistent is required'
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

