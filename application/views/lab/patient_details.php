<style>
    input[type="file"]{
        height: 34px;
        padding: 0px;
    }

</style>


<?php //echo '<pre>';print_r($report_lists);exit; ?>
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Patient Report Details</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Patient Report Details</li>
            </ol>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="panel tab-border card-topline-yellow">
               <div class="panel-body">
                  <div class="tab-content">
                     <div class=" ">
                        <div class="card-body ">
                           <div class="panel panel-default">
                              <div class="panel-heading">Patient Report Details</div>
                              <div class="panel-body">
								<div class="card-head">
                                    <header>Name : &nbsp;<span><?php echo isset($patient_details['name'])?$patient_details['name']:''; ?> </span>
									<h4 class="py-2"><?php echo isset($patient_details['mobile'])?$patient_details['mobile']:''; ?></h4></header>
									<div class="tools">
                                   <h4><b>ID: <span><?php echo isset($patient_details['pid'])?$patient_details['pid']:''; ?></span></b></h4>
                                   <h5><b>DOB: <span><?php echo isset($patient_details['dob'])?$patient_details['dob']:''; ?></span></b></h5>
									
									</div>
                                 </div>
								 <?php if(isset($report_lists) && count($report_lists)>0){ ?>
								 <?php foreach($report_lists as $Lis){ ?>
									 <div class="">
										<header><?php echo $Lis['t_name']; ?> : &nbsp;<span><a  target="_blank" href="<?php echo base_url('assets/patient_reports/'.$Lis['image']); ?>">Download</a></span>
									</div>
								 <?php } ?>
								 <?php } ?>
                                 <form id="uploadreports" name="uploadreports" action="<?php echo base_url('lab/uploadreports'); ?>" method="post" enctype="multipart/form-data">
                                    	<input type="hidden" id="pid" name="pid" value="<?php echo isset($patient_id)?$patient_id:''; ?>">
                                    	<input type="hidden" id="b_id" name="b_id" value="<?php echo isset($billing_id)?$billing_id:''; ?>">

									<div class="row">
                                       <div class="col-md-12">
                                          <div id="education_fields">
                                          </div>
                                       </div>
                                       <div class="col-md-12">
                                          <div class="row">
                                             <div class="col-md-3 nopadding">
                                                <div class="form-group">
                                                   <select id="test_id[]" name="test_id[]" class="form-control">
												   <option value="">Select</option>
												   <?php if(isset($labtest_list) && count($labtest_list)>0){ ?>
													   <?php foreach($labtest_list as $list){ ?>
															   <option value="<?php echo $list['t_id']; ?>"><?php echo $list['t_name']; ?></option>
													   <?php } ?>
												   <?php } ?>
												   <?php if(isset($direct_labtest_list) && count($direct_labtest_list)>0){ ?>
													   <?php foreach($direct_labtest_list as $list){ ?>
															   <option value="<?php echo $list['t_id']; ?>"><?php echo $list['t_name']; ?></option>
													   <?php } ?>
												   <?php } ?>
												   </select>
                                                </div>
                                             </div>
											 <div class="col-md-3 nopadding">
                                                <div class="form-group">
                                                   <input type="text" class="form-control" id="problem_name" name="problem_name[]" value="" placeholder="Enter Problem">
                                                </div>
                                             </div> 
											 <div class="col-md-3 nopadding">
                                                <div class="form-group">
                                                   <input type="text" class="form-control" id="symptoms" name="symptoms[]" value="" placeholder="Enter Symptoms">
                                                </div>
                                             </div>
                                             <div class="col-md-3 nopadding">
                                                <div class="form-group">
                                                   <div class="input-group">
                                                      <input type="file" class="form-control" id="document" name="document[]" value="">
                                                      <div class="input-group-btn">
                                                         <button class="btn btn-success" type="button"  onclick="education_fields();"> <span class="fa fa-plus" aria-hidden="true"></span> </button>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
									     <div class="col-md-11 py-1">
                                       <button type="submit" class="btn btn-success pull-right">submit</button>
                                    </div>
                                    </div>
                                  
									 </form>
                              </div>
                             
                              
                        </div>
                     </div>
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
   var room = 1;
   function education_fields() {
    
       room++;
       var objTo = document.getElementById('education_fields')
       var divtest = document.createElement("div");
   	divtest.setAttribute("class", "form-group removeclass"+room);
   	var rdiv = 'removeclass'+room;
       divtest.innerHTML = '<div class="row"><div class="col-md-3 nopadding"><div class="form-group">    <select id="test_id[]" name="test_id[]" class="form-control" required><option value="">Select</option><?php if(isset($labtest_list) && count($labtest_list)>0){ ?> <?php foreach($labtest_list as $list){ ?><?php if($list['out_source']==0){ ?> <option value="<?php echo $list['t_id']; ?>"><?php echo $list['t_name']; ?></option><?php } ?>  <?php } ?> <?php } ?> </select></div></div><div class="col-md-3 nopadding"><div class="form-group"> <input type="text" class="form-control" id="problem_name" name="problem_name[]" value="" placeholder="Enter Problem"></div></div><div class="col-md-3 nopadding"><div class="form-group"> <input type="text" class="form-control"id="symptoms" name="symptoms[]" value="" placeholder="Enter Symptoms"></div></div><div class="col-md-3 nopadding"><div class="form-group"><div class="input-group"> <input type="file" class="form-control" id="document" name="document[]"><div class="input-group-btn"> <button class="btn btn-danger" type="button" onclick="remove_education_fields('+ room +');"> <span class="fa fa-minus" aria-hidden="true"></span> </button></div></div></div></div></div>';
       
       objTo.appendChild(divtest)
   }
      function remove_education_fields(rid) {
   	   $('.removeclass'+rid).remove();
      }
</script>
<script>
$(document).ready(function() {
 
    $('#uploadreports').bootstrapValidator({
        
        fields: {
            'test_id[]': {
                validators: {
                      notEmpty: {
                        message: 'Test Name is required'
                    }
                }
            },
			'document[]': {
                validators: {
                      notEmpty: {
                        message: 'Document is required'
                    },
					regexp: {
					regexp: "(.*?)\.(docx|doc|xlsx|xls)$",
					message: 'Uploaded file is not a valid. Only docx,doc,xlsx files are allowed'
					}
                }
            }
            }
        })
     
});


</script>
