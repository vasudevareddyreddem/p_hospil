<?php //echo '<pre>';print_r($hospital_details);exit; ?>
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Notification
				</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Notification</li>
            </ol>
         </div>
      </div>
	   
      <div class="panel tab-border card-topline-green">
         
         <div class="panel-body">
            <div class="tab-content">
               <div  id="resources">
                  <div class="row">
                     <div class="col-md-12 ">
                        <div class="container">
						<form id="notification" name="notification" action="<?php echo base_url('admin/sendnotification'); ?>" method="post" >
							<div class="form-group col-md-6">
							<label for="mobile">Notification</label>
							<input type="text" class="form-control" id="notification"  name="notification" placeholder="Enter Notification" value="">
							</div>
							<div class="form-group col-md-6">
							<label for="mobile">&nbsp;</label>
							<button class="btn btn-praimry " type="submit">Submit</button>
							</div>
							</form>
							
   
    
							</div> 
                        </div>
                        <div class="clearfix">&nbsp;</div>
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
 
    $('#notification').bootstrapValidator({
        
        fields: {
            notification: {
                validators: {
                      notEmpty: {
                        message: 'Notification is required '
                    }
                }
            }
            }
        })
     
});


</script>
<!--script for add row comment-->


