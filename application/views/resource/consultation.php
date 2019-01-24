<style>
   .entry:not(:first-of-type)
   {
   margin-top: 10px;
   }
   .glyphicon
   {
   font-size: 12px;
   }
   .bg-indigo {
   background: #6673fc;
   color:#fff;
   }
   .min-h-300{
   min-height:300px;
   margin-top:50px;
   }
   .sw-toolbar-top .sw-btn-group-extra{
   display:none;
   }
   .sw-toolbar-top .sw-btn-prev{
   display:none;
   }.sw-toolbar-top .sw-btn-next{
   display:none;
   }
</style>
<?php //echo '<pre>';print_r($patient_privious_medicine_list);exit; ?>
<div class="page-content-wrapper">
<div class="page-content">
<div class="row">
<div class="col-md-12">
<div class="card card-topline-aqua">
<div class="card-head">
   <header>Start Consultation</header>
</div>
<div class="row py-4 px-2">
    <div class="col-md-9 table-responsive">
        <table class="" border="1" border-color="red" cellpadding="15px" style="border-collapse: collapse;width: 100%;border-color: #ccc; border: 1px solid #ccc;">
            <tr>
                <th colspan="6" class="text-center bg-info">Patient Details</th>
            </tr> 
            <tr class="text-center">
                <td><b>Patient Name</b></td>
                <td><b>Gender</b></td>
                <td><b>Mobile</b></td>
                <td><b>Blood group</b></td>
                <td><b>Age</b></td>
                <td><b>Address</b></td>
            </tr>
            <tr>
                <td><?php echo isset($patient_details['name'])?$patient_details['name']:''; ?></td>
                <td><?php echo isset($patient_details['gender'])?$patient_details['gender']:''; ?></td>
                <td><?php echo isset($patient_details['mobile'])?$patient_details['mobile']:''; ?></td>
                <td><?php echo isset($patient_details['bloodgroup'])?$patient_details['bloodgroup']:''; ?></td>
                <td><?php echo isset($patient_details['age'])?$patient_details['age']:''; ?></td>
                <td><?php echo isset($patient_details['perment_address'])?$patient_details['perment_address']:''; ?></td>
            </tr>
          </table>
      </div>
   <!--<div class="panel-group col-md-9" id="accordion">
      <div class="panel panel-default">
         <div class="panel-heading">
            <h4 data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="panel-title expand">
               <div class="right-arrow pull-right" style="cursor:pointer">+</div>
               <a href="#">Patient Details</a>
            </h4>
         </div>
         <div id="collapse1" class="panel-collapse collapse">
            <div class="panel-body row">
               <div class="col-md-3">
                  <strong>Patient Name</strong>
                  <p><?php echo isset($patient_details['name'])?$patient_details['name']:''; ?></p>
               </div>
               <div class="col-md-3">
                  <strong>Gender</strong>
                  <p><?php echo isset($patient_details['gender'])?$patient_details['gender']:''; ?></p>
               </div>
               <div class="col-md-3">
                  <strong>Mobile</strong>
                  <p><?php echo isset($patient_details['mobile'])?$patient_details['mobile']:''; ?></p>
               </div>
               <div class="col-md-3">
                  <strong>Blood group:</strong>
                  <p><?php echo isset($patient_details['bloodgroup'])?$patient_details['bloodgroup']:''; ?></p>
               </div>
              
               <div class="col-md-3">
                  <strong>Age</strong>
                  <p><?php echo isset($patient_details['age'])?$patient_details['age']:''; ?></p>
               </div>
               <div class="col-md-3">
                  <strong>Address</strong>
                  <p>
                     <?php echo isset($patient_details['perment_address'])?$patient_details['perment_address']:''; ?>
                     
                  </p>
               </div>
            </div>
         </div>
      </div>
   </div>-->
   <div class="col-md-3">
      <a href="javascript:void(0)" data-toggle="modal" data-target="#medicine_list_hmodal" class="btn btn-sm btn-warning mt-5">Previous Medication Reports</a>
      <a target="_blank" href="<?php echo base_url('resources/patient_report_details/'.base64_encode($patient_id));?>" class="btn btn-sm btn-success" type="button">Previous Investigation Reports</a>
   </div>
</div>
<div class="card-body row">
<div id="smartwizard" class="col-md-12">
   <ul>
      <li><a href="#step-1" >Vitals</a></li>
      <li><a href="#step-2">Medication</a></li>
      <li><a href="#step-3">Investigation</a></li>
   </ul>
   <div>
      <div id="step-1" class="">
         <div class="row">
          
           
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="table-responsive">
                  <table id="example1" class="table table-striped table-bordered">
                     <thead>
                        
                        <tr>
                           <th>Date</th>
                           <th>BP (80-120)</th>
                           <th>Pulse  (70-80)</th>
                           <th>FBS/RBS  (70-110)</th>
                           <th>Temp  (98.6 F)</th>
                           <th>Weight</th>
                        
                        </tr>
                     </thead>
                     <tbody>
					 <?php if(isset($encounters_list) && count($encounters_list)>0){ ?>
						<?php $cnt=0;foreach($encounters_list as $list){ ?>
								<tr>
                           <td><?php echo $list['date']; ?> </td>
                           <td><?php echo isset($list['bp'])?$list['bp']:''; ?> </td>
                           <td><?php echo isset($list['pulse'])?$list['pulse']:''; ?> </td>
                           <td><?php echo isset($list['fbs_rbs'])?$list['fbs_rbs']:''; ?></td>
                           <td><?php echo isset($list['temp'])?$list['temp']:''; ?></td>
                           <td><?php echo isset($list['weight'])?$list['weight']:''; ?></td>
                          
                        </tr>
						<?php } ?>
						<?php } ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         
      </div>
      <div id="step-2" class="">
         <!--<a href="<?php echo base_url('resources/skip_prescription/'.base64_encode($patient_id).'/'.base64_encode($billing_id)); ?>" >Alternate way</a>-->
         <form id="add_medicines" name="add_medicines" onsubmit="return check_qty()"  action="<?php echo base_url('resources/medicine'); ?>" method="post" >
            <input type="hidden" name="pid" id="pid" value="<?php echo isset($patient_id)?$patient_id:''; ?>">
            <input type="hidden" name="bid" id="bid" value="<?php echo isset($billing_id)?$billing_id:''; ?>">
            <div class="row">
               <div class="col-md-12 ">
                  <div class="container">
				  <!-- one-->
                     <div class="row">
                        <div class="col-sm-3 nopadding">
                           <label> Select Medicine</label>
                           <div class="form-group">
                              <select class="form-control  select2" id="medicine_name0"  name="medicine_name[]">
                                 <option value="">Select</option>
                                 <?php foreach($medicine_list as $list){ ?>
                                 <option value="<?php echo $list['medicine_name'].'_'.$list['qty']; ?>"><?php echo $list['medicine_name']; ?>-<?php echo "dosage ".$list['dosage']; ?> - <?php echo "Avl qty :".$list['qty']; ?> - <?php echo "Type :".$list['medicine_type']; ?></option>
                                 <?php } ?>
                              </select>
                           </div>
                        </div>
                        <div class="col-sm-1 nopadding">
                           <label> Qty</label>
                           <div class="form-group">
                              <input type="text" class="form-control" id="qty0"  name="qty[]" onchange="check_avaiable_qty(this.value,'0');" value="" placeholder="Qty">
                           </div>
                        </div>
                        <div class="col-sm-3 nopadding">
                           <label> Frequency</label>
                           <div class="row">
                              <div class="checkbox checkbox-black col-md-4">
                                 <input id="checkboxbg1" name="Frequency[0][]" type="checkbox" value="Morning">
                                 <label for="checkboxbg1">
                                 Mrng
                                 </label>
                              </div>
                              <div class="checkbox checkbox-black col-md-4">
                                 <input id="checkboxbg1" type="checkbox" name="Frequency[0][]" value="Afternoon">
                                 <label for="checkboxbg1">
                                 Afnoon
                                 </label>
                              </div>
                              <div class="checkbox checkbox-black col-md-4">
                                 <input id="checkboxbg1" type="checkbox" name="Frequency[0][]" value="Night">
                                 <label for="checkboxbg1">
                                 Night
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-2 nopadding">
                           <label> Food </label>
                           <select class="form-control" name="food[]" id="food">
                              <option value="" >Select</option>
                              <option value="Before">Before</option>
                              <option value="After">After</option>
                           </select>
                        </div>
                        <div class="col-sm-2 nopadding">
                           <label> Days </label>
                           <div class="form-group">
                              <input type="text" class="form-control" id="amount0"  name="days[]"  value="" placeholder="No of Days">
                           </div>
                        </div>
                     </div>
					 <!-- one-->
					 <!-- two-->
                     <div class="row">
                        <div class="col-sm-3 nopadding">
                           <label> Select Medicine</label>
                           <div class="form-group">
                              <select class="form-control  select2" id="medicine_name1"  name="medicine_name[]">
                                 <option value="">Select</option>
                                 <?php foreach($medicine_list as $list){ ?>
                                 <option value="<?php echo $list['medicine_name'].'_'.$list['qty']; ?>"><?php echo $list['medicine_name']; ?>-<?php echo "dosage ".$list['dosage']; ?> - <?php echo "Avl qty :".$list['qty']; ?> - <?php echo "Type :".$list['medicine_type']; ?></option>
                                 <?php } ?>
                              </select>
                           </div>
                        </div>
                        <div class="col-sm-1 nopadding">
                           <label> Qty</label>
                           <div class="form-group">
                              <input type="text" class="form-control" id="qty1"  name="qty[]" onchange="check_avaiable_qty(this.value,'1');" value="" placeholder="Qty">
                           </div>
                        </div>
                        <div class="col-sm-3 nopadding">
                           <label> Frequency</label>
                           <div class="row">
                              <div class="checkbox checkbox-black col-md-4">
                                 <input id="checkboxbg1" name="Frequency[1][]" type="checkbox" value="Morning">
                                 <label for="checkboxbg1">
                                 Mrng
                                 </label>
                              </div>
                              <div class="checkbox checkbox-black col-md-4">
                                 <input id="checkboxbg1" name="Frequency[1][]" type="checkbox" value="Afternoon">
                                 <label for="checkboxbg1">
                                 Afnoon
                                 </label>
                              </div>
                              <div class="checkbox checkbox-black col-md-4">
                                 <input id="checkboxbg1" name="Frequency[1][]" type="checkbox" value="Night">
                                 <label for="checkboxbg1">
                                 Night
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-2 nopadding">
                           <label> Food </label>
                           <select class="form-control" name="food[]" id="food">
                              <option value="" >Select</option>
                              <option value="Before">Before</option>
                              <option value="After">After</option>
                           </select>
                        </div>
                        <div class="col-sm-2 nopadding">
                           <label> Days </label>
                           <div class="form-group">
                              <input type="text" class="form-control" id="amount0"  name="days[]"  value="" placeholder="No of Days">
                           </div>
                        </div>
                     </div>
					  <!-- two-->
					  <!-- three-->
                     <div class="row">
                        <div class="col-sm-3 nopadding">
                           <label> Select Medicine</label>
                           <div class="form-group">
                              <select class="form-control  select2" id="medicine_name2"  name="medicine_name[]">
                                 <option value="">Select</option>
                                 <?php foreach($medicine_list as $list){ ?>
                                 <option value="<?php echo $list['medicine_name'].'_'.$list['qty']; ?>"><?php echo $list['medicine_name']; ?>-<?php echo "dosage ".$list['dosage']; ?> - <?php echo "Avl qty :".$list['qty']; ?> - <?php echo "Type :".$list['medicine_type']; ?></option>
                                 <?php } ?>
                              </select>
                           </div>
                        </div>
                        <div class="col-sm-1 nopadding">
                           <label> Qty</label>
                           <div class="form-group">
                              <input type="text" class="form-control" id="qty2"  name="qty[]" onchange="check_avaiable_qty(this.value,'2');" value="" placeholder="Qty">
                           </div>
                        </div>
                        <div class="col-sm-3 nopadding">
                           <label> Frequency</label>
                           <div class="row">
                              <div class="checkbox checkbox-black col-md-4">
                                 <input id="checkboxbg1" type="checkbox" name="Frequency[2][]" value="Morning">
                                 <label for="checkboxbg1">
                                 Mrng
                                 </label>
                              </div>
                              <div class="checkbox checkbox-black col-md-4">
                                 <input id="checkboxbg1" type="checkbox" name="Frequency[2][]" value="Afternoon">
                                 <label for="checkboxbg1">
                                 Afnoon
                                 </label>
                              </div>
                              <div class="checkbox checkbox-black col-md-4">
                                 <input id="checkboxbg1" type="checkbox" name="Frequency[2][]" value="Night">
                                 <label for="checkboxbg1">
                                 Night
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-2 nopadding">
                           <label> Food </label>
                           <select class="form-control" name="food[]" id="food">
                              <option value="" >Select</option>
                              <option value="Before">Before</option>
                              <option value="After">After</option>
                           </select>
                        </div>
                        <div class="col-sm-2 nopadding">
                           <label> Days </label>
                           <div class="form-group">
                              <input type="text" class="form-control" id="amount0"  name="days[]"  value="" placeholder="No of Days">
                           </div>
                        </div>
                     </div>
					 <!-- three-->
					 <!-- four-->
                     <div class="row">
                        <div class="col-sm-3 nopadding">
                           <label> Select Medicine</label>
                           <div class="form-group">
                              <select class="form-control  select2" id="medicine_name3"  name="medicine_name[]">
                                 <option value="">Select</option>
                                 <?php foreach($medicine_list as $list){ ?>
                                 <option value="<?php echo $list['medicine_name'].'_'.$list['qty']; ?>"><?php echo $list['medicine_name']; ?>-<?php echo "dosage ".$list['dosage']; ?> - <?php echo "Avl qty :".$list['qty']; ?> - <?php echo "Type :".$list['medicine_type']; ?></option>
                                 <?php } ?>
                              </select>
                           </div>
                        </div>
                        <div class="col-sm-1 nopadding">
                           <label> Qty</label>
                           <div class="form-group">
                              <input type="text" class="form-control" id="qty3"  name="qty[]" value="" onchange="check_avaiable_qty(this.value,'3');" placeholder="Qty">
                           </div>
                        </div>
                        <div class="col-sm-3 nopadding">
                           <label> Frequency</label>
                           <div class="row">
                              <div class="checkbox checkbox-black col-md-4">
                                 <input id="checkboxbg1" type="checkbox" name="Frequency[3][]" value="Morning">
                                 <label for="checkboxbg1">
                                 Mrng
                                 </label>
                              </div>
                              <div class="checkbox checkbox-black col-md-4">
                                 <input id="checkboxbg1" type="checkbox" name="Frequency[3][]" value="Afternoon">
                                 <label for="checkboxbg1">
                                 Afnoon
                                 </label>
                              </div>
                              <div class="checkbox checkbox-black col-md-4">
                                 <input id="checkboxbg1" type="checkbox" name="Frequency[3][]" value="Night">
                                 <label for="checkboxbg1">
                                 Night
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-2 nopadding">
                           <label> Food </label>
                           <select class="form-control" name="food[]" id="food">
                              <option value="" >Select</option>
                              <option value="Before">Before</option>
                              <option value="After">After</option>
                           </select>
                        </div>
                        <div class="col-sm-2 nopadding">
                           <label> Days </label>
                           <div class="form-group">
                              <input type="text" class="form-control" id="days"  name="days[]"  value="" placeholder="No of Days">
                           </div>
                        </div>
                        <div class="col-sm-1 nopadding">
                           <label> &nbsp; </label>
                           <div class="input-group-btn">
                              <button class="btn btn-success" type="button"  onclick="education_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true">+</span> </button>
                           </div>
                        </div>
                     </div>
					  <!-- four-->
                     <div class="row">
                        <div id="education_fields">
                        </div>
                     </div>
                     
                     <div class="row">
                        <div class="col-md-12">
                           <label> Directions</label>
                           <textarea type="textarea" name="directions" id="directions" class="form-control"  placeholder="Enter Directions" ></textarea>
                        </div>
                     </div>
                  </div>
				  										<input type="hidden" name="cheking_value" id="cheking_value" value="0">

                  <div class="clearfix">&nbsp;</div>
                  <button class="btn btn-sm btn-success" type="submit">Submit</button>
                  <?php if(isset($patient_medicine_list) && count($patient_medicine_list)>0){?>
                  <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#prescriptionmodel"  type="button">View Prescription</a>
                  <?php } ?>
                  <div class="clearfix">&nbsp;</div>
               </div>
            </div>
         </form>
      </div>
      <div id="step-3" class="">
         <div class="container">
		 
			<form  action="<?php echo base_url('resources/save_op_patient_lab_test_names'); ?>" method="post">
			 <input type="hidden" name="pid" id="patient_id_test_list" value="<?php echo isset($patient_id)?$patient_id:''; ?>">
            <input type="hidden" name="bid" id="patient_bid_test_list" value="<?php echo isset($billing_id)?$billing_id:''; ?>">
			<input type="hidden" name="test_patient_id" id="test_patient_id" value="<?php echo isset($patient_id)?$patient_id:''; ?>">
            <input type="hidden" name="test_patient_bid" id="test_patient_bid" value="<?php echo isset($billing_id)?$billing_id:''; ?>">

            <div class="row clearfix">
               <div class="col-md-12 column">
                  <table class="table table-bordered table-hover" id="tab_logic">
                     <thead>
                        <tr>
                           <th class="text-center">
                              Type
                           </th>
                           <th class="text-center">
                              Test Type
                           </th>
                           <th class="text-center">
                              Test Name
                           </th>
                           <th class="text-center">
                              Frequency
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr id='addr0'>
                           <td>
                              <select class="form-control" onchange="investdation_serach_one(this.value);" name="investdation_serach[]" id="investdation_serach">
									<option value="">Select </option>
									<option value="Lab">Lab </option>
									<option value="Radiology">Radiology</option>
                              </select>
                           </td>
                           <td>
                               <select onchange="test_list_purpose(this.value)" id="internal_code" name="internal_code[]" class="form-control  select2" style="width:100%">
                                 <option value="" >Select</option>
                              </select>
                           </td>
                           <td>
                              <select id="lab_test_name" name="lab_test_name[]" class="form-control select2" style="width:100%">
                                 <option value="" >Select</option>
                              </select>
                           </td>
                           <td>
                              <select class="form-control " name="frequency[]" id="frequency">
                                 <option value="" >Select</option>
                                 <option value="6 Hours">6 Hours</option>
                                 <option value="12 Hours">12 Hours</option>
                                 <option value="24 Hours">24 Hours</option>
                                 <option value="48 Hours">48 Hours</option>
                              </select>
                           </td>
                        </tr>
                        <tr id='addr1'></tr>
                     </tbody>
                  </table>
				  
               </div>
			
            </div>
                <a id="add_row" onclick="add_more_data()" class="btn btn-default pull-left">Add Row</a> 
                <a id="delete_row"  onclick="delete_more_data()" class="pull-right btn btn-default">Delete Row</a>
			<div class="row  pull-right mr-2">
               <button class="btn btn-primary" type="submit">Submit</button>
            </div>
			</form>
			 <a href="javascript:void(0)" onclick="get_patient_list()" data-toggle="modal" data-target="#test_list_searchmodal" class="btn btn-warning ml-2">View</a>
            <div class=" clearfix">&nbsp;</div>
            <div class=" clearfix">&nbsp;</div>
			<a href="<?php echo base_url('resources/worksheet'); ?>" class="btn btn-default pull-right">completed</a>
			<?php if(isset($patient_medicine_list) && count($patient_medicine_list)>0 || isset($patient_investigation_list) && count($patient_investigation_list)>0){ ?>
				<a href="<?php echo base_url('resources/patient_details_print/'.base64_encode($patient_id).'/'.base64_encode($billing_id)); ?>" target="_blank" class="btn btn-default pull-right">Print</a>
			<?php } ?>
            <div class=" clearfix">&nbsp;</div>
            <div class=" clearfix">&nbsp;</div>
         </div>
      </div>
    
   </div>
</div>
<!-- test vierw  purpose-->
<div class="modal fade" id="test_list_searchmodal" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header bg-indigo">
            <h5 class="modal-title" id="lineModalLabel">Lab Test List</h5>
            <button type="button" id="popupclose" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
         </div>
         <div class="modal-body" style="height:400px;overflow:hidden; overflow-y: scroll;">
            <div class="">
               <div class="">
                  <div class=" card card-topline-red">
                     <div class="card-head">
                        <header>List</header>
                     </div>
                     <div class="card-body ">
                        <div class="row">
                           
						   <div class="col-md-12 ">

                              <div class="table-scrollable">
                                 <table class="table table-bordered">
                                    <thead>
                                       <tr>
                                          <th> Test Name</th>
                                          <th> Amount</th>
                                          <th> Duration</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody id="lab_test_type_list">
                                        
                                    </tbody>
                                 </table>
                              </div>
                              <div class="clearfix">&nbsp;</div>
								 <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
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
<!--view preciption modal-->
<div class="modal fade" id="prescriptionmodel" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header bg-indigo">
            <h5 class="modal-title" id="lineModalLabel">Prescription</h5>
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
         </div>
         <div class="modal-body">
            <div class="">
               <div class="">
                  <div class=" card card-topline-red">
                     <div class="card-head">
                        <header>Prescription List</header>
                     </div>
                     <div class="card-body ">
                        <div class="col-md-12 ">
                           <div class="table-scrollable">
                              <table class="table table-bordered">
                                 <thead>
                                    <tr>
                                       <th>Search for Medicine</th>
                                       <th>Qty</th>
                                       <th>Dosage </th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
								 
								 <?php //echo '<pre>';print_r($patient_medicine_list);exit; ?>
                                    <?php foreach($patient_medicine_list as $list){ ?>
                                    <tr id="medicine_id_<?php echo $list['m_id']; ?>">
                                       <td><?php echo $list['medicine_name']; ?></td>
                                       <td><?php echo $list['qty']; ?></td>
                                       <td><?php echo $list['dosage']; ?> </td>
                                       <td><span onclick="removemedicine_from_list('<?php echo $list['m_id']; ?>','<?php echo $list['qty']; ?>','<?php echo $list['medicine_name']; ?>','<?php echo $list['medicine_id']; ?>');" class="btn btn-danger btn-sm" >Remove</span></td>
                                    </tr>
                                    <?php }?>											
                                 </tbody>
                              </table>
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
<!--medicine_list_hmodal_modal-->
<div class="modal fade" id="medicine_list_hmodal" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
            <h5 class="modal-title" id="lineModalLabel">Previous Medicine List </h5>
         <div class="modal-header bg-indigo">
            <button type="button" id="popupclose" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
         </div>
         <div class="modal-body" style="height:400px;overflow:hidden; overflow-y: scroll;">
            <div class="">
               <div class="">
                  <div class=" card card-topline-red">
                     <div class="card-head">
                        <header>Previous Medicine List</header>
                     </div>
                     <div class="card-body ">
                        <div class="row">
                           	<table class="table table-striped table-bordered table-hover table-checkable order-column" id="example4">
								<thead>
									<tr>
										<th> Medicine Name </th>
										<th> Batch No </th>
										<th> Expiry Date </th>
										<th> Qty  </th>
										<th> Frequency </th>
										
									</tr>
								</thead>
								<tbody>
								<?php foreach($patient_privious_medicine_list as $list){ ?>
									<tr class="odd gradeX">
										<td><?php echo isset($list['medicine_name'])?$list['medicine_name']." - dosage ".$list['dosage']." - type ".$list['medicine_type']:''; ?></td>
										<td><?php echo $list['batchno']; ?></td>
										<td><?php echo $list['expiry_date'];?></td>
										<td><?php echo $list['qty']; ?></td>
										<td><?php echo $list['frequency']; ?> </td>
										
									</tr>
									
								<?php } ?>
									
								</tbody>
							</table>
							  
                        </div>
						
						<div>
						<h3>
						Prescription File
						</h3><hr>
						<?php if(isset($patient_privious_alternate_medicine_list) && count($patient_privious_alternate_medicine_list)>0){ ?>
						<?php foreach($patient_privious_alternate_medicine_list as $list){  ?>
						<a href="<?php echo base_url('assets/sheet_prescriptions/'. $list['sheet_prescription_file']); ?>">Download</a><br>
						
						<?php } ?>
						
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
<!-- patient_lab_test_list_model-->
<script type="text/javascript">
 var j=0;
function add_more_data(){
	$('#addr1'+j).html("<td><div class='form-group'><div class=''><select class='form-control select2'name='investdation_serach[]' id='investdation_serach"+j+"' onchange='investdation_serach_row(this.value,"+j+")'><option value=''>select</option><option value='Lab'>Lab</option><option value='Radiology'>Radiology</option></select></div></div></td><td><div class='form-group'><div class=''><select class='form-control select2' onchange='test_list_purpose_row(this.value,"+j+")' name='internal_code[]' id='internal_code_row"+j+"'><option value=''>select</option></select></div></div></td><td>  <div class='form-group'><div class=''><select class='form-control select2'  name='lab_test_name[]' id='lab_test_name_row"+j+"' style='width:100%;'><option value =''>Select</option><option value ='yellow'>YELLOW</option><option value = 'Red'>RED</option><option value ='Blue'>BLUE</option><option value ='White (ppc)'>WHITE (PPC)</option></select></div></div></td><td>  <div class='form-group'><div class=''><select class='form-control'  name='frequency[]' id='frequency' style='width:100%;'><option value =''>Select</option><option value ='6 Hours'>6 Hours</option><option value ='12 Hours'>12 Hours</option><option value ='24 Hours'>24 Hours</option><option value ='48 Hours'>48 Hours</option></select></div></div></td>");
      $('#tab_logic').append('<tr id="addr1'+(j+1)+'"></tr>');
      j++; 
}
function delete_more_data(){
		if(j>1){
         $("#addr1"+(j-1)).html('');
         j--;
         }
}

</script>
<script type="text/javascript">
function check_avaiable_qty(qty,ids){
	var medicine_name=$('#medicine_name'+ids).val();
	if(medicine_name!=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('Users/get_medicine_avaiable_qty_with_name');?>",
   			data: {
				m_id: medicine_name,				
				p_qty:qty,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
						var datas = JSON.parse(data);
						if(datas.msg==1){
							$('#cheking_value').val(1);					
						}else{
							console.log('sdmnasbdhb');
							$('#cheking_value').val(0);
							alert('available quantity is less than given quantity');
						}
						
   					}
           });
	   }
	
}
function investdation_serach_one(val){
	if(val!=''){
   			$('#internal_code').empty();
   			jQuery.ajax({
   					url: "<?php echo base_url('resources/investigationsearch');?>",
   					data: {
   						searchdata: val,
   					},
   					dataType: 'json',
   					type: 'POST',
   					success: function (data) {
					//var parsedData = JSON.parse(data);
						console.log(data);
						console.log(Object.values(data))
   						if(data.msg==1){
   						   $('#internal_code').empty();
   						   $('#internal_code').append("<option value=''>select </option>");                      
   
								for(i=0; i<data.text.length; i++) {
									 $('#internal_code').append("<option value='"+data.text[i].test_type+"'>"+data.text[i].test_type+"</option>");                      
								}
   						}
   				 }
   			});
   		}
	
}
function investdation_serach_row(val,id){
	if(val!=''){
   			$('#internal_code_row'+id).empty();
   			jQuery.ajax({
   					url: "<?php echo base_url('resources/investigationsearch');?>",
   					data: {
   						searchdata: val,
   					},
   					dataType: 'json',
   					type: 'POST',
   					success: function (data) {
					//var parsedData = JSON.parse(data);
						console.log(data);
						console.log(Object.values(data))
   						if(data.msg==1){
   						   $('#internal_code_row'+id).empty();
   						   $('#internal_code_row'+id).append("<option value=''>select </option>");                      
   
								for(i=0; i<data.text.length; i++) {
									console.log(data.text[i].t_name);
									 $('#internal_code_row'+id).append("<option value='"+data.text[i].test_type+"'>"+data.text[i].test_type+"</option>").trigger("chosen:updated"); ;                      
								}
   						}
   				 }
   			});
   		}
	
}
function test_list_purpose_row(val,id){
		if(val!=''){
   			$('#lab_test_name_row'+id).empty();
   			jQuery.ajax({
   					url: "<?php echo base_url('resources/test_name_testsearch');?>",
   					data: {
   						type: $('#investdation_serach'+id).val(),
   						test_type_id: val,
   					},
   					dataType: 'json',
   					type: 'POST',
   					success: function (data) {
						//alert(data);return false;
					    if(data.msg==1){
   						   $('#lab_test_name_row'+id).empty();
   						   $('#lab_test_name_row'+id).append("<option value=''>select </option>");                      
								for(i=0; i<data.text.length; i++) {
									 $('#lab_test_name_row'+id).append("<option value='"+data.text[i].t_id+"'>"+data.text[i].t_name+"</option>");                      
								}
   						}
   				 }
   			});
   		}
}
   function form_submittion(){
    
    if($('#medicinename').val()!=''){
     document.getElementById("addpostprescription").submit(); 
    }
   }
   var room = 4;
   function education_fields() {
   
      room++;
      var objTo = document.getElementById('education_fields')
      var divtest = document.createElement("div");
   divtest.setAttribute("class", "form-group removeclass"+room);
   var rdiv = 'removeclass'+room;
      divtest.innerHTML = '<div class="row" style="margin:0px"><div class="col-sm-3 nopadding"><div class="form-group"><select style="width:100%;height:40px;" class="form-control" id="medicine_name'+room+'" onchange="get_medicin_amount_list(this.value,'+room+')" name="medicine_name[]"><option value="">Select</option><?php foreach($medicine_list as $list){ ?> <option value="<?php echo $list['medicine_name'].'_'.$list['qty']; ?>"><?php echo $list['medicine_name']; ?>-<?php echo "dosage ".$list['dosage']; ?> - <?php echo "Avl qty :".$list['qty']; ?> - <?php echo "Type :".$list['medicine_type']; ?></option><?php } ?></select></div></div>	<div class="col-sm-1 nopadding"><div class="form-group"><input type="text" class="form-control" id="qty'+room+'"  name="qty[]" onchange="check_avaiable_qty(this.value,'+room+');" value="" placeholder="Qty"></div></div>	<div class="col-sm-3 nopadding"><div class="row"><div class="checkbox checkbox-black col-md-4"> <input id="checkboxbg1" type="checkbox" name="Frequency['+room+'][]" value="Morning"> <label for="checkboxbg1"> Mrng </label> </div><div class="checkbox checkbox-black col-md-4"> <input id="checkboxbg1" type="checkbox" name="Frequency['+room+'][]" value="Afternoon"> <label for="checkboxbg1"> Afnoon </label> </div><div class="checkbox checkbox-black col-md-4"> <input id="checkboxbg1" type="checkbox" name="Frequency['+room+'][]" value="Night"> <label for="checkboxbg1"> Night </label> </div> </div></div>	<div class="col-sm-2 nopadding"><select class="form-control" name="food[]" id="food"> <option value="" >Select</option> <option value="Before">Before</option> <option value="After">After</option> </select></div>	<div class="col-sm-2 nopadding"><div class="form-group"><input type="text" class="form-control" id="amount'+room+'"  name="days[]"  value="" placeholder="No of days"></div></div><div class="col-sm-1 nopadding"><div class="input-group-btn"><button class="btn btn-danger" type="button" onclick="remove_education_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true">-</span> </button>  </div></div></div>';
      
      objTo.append(divtest);
   }
     function remove_education_fields(rid) {
      $('.removeclass'+rid).remove();
     }
        $(document).ready(function() {
                 $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
   			   if(stepNumber==1 && stepDirection=='forward'){
   				   	<?php if(isset($patient_medicine_list) && count($patient_medicine_list)<=0){?>
   				   if($('#frequency').val()=='' && $('#priority').val()==''){
   					   alert('Medication/Investigation details required');return false;
   				   }
   					<?php } ?>
   				   
   			   }
   			   //alert());
   				//return confirm("Do you want to leave the step "+frequency+"?");
   	});
            
        }); 
      
</script>
<script>
function get_patient_list(){
			$('#lab_test_type_list').empty();
			jQuery.ajax({
					url: "<?php echo base_url('resources/get_patinent_list');?>",
					data: {
						patinet_id: $('#patient_id_test_list').val(),
						patinet_bid: $('#patient_bid_test_list').val(),
					},
					dataType: 'json',
					type: 'POST',
					success: function (data) {
						console.log(data);
						if(data.msg==1){
						$('#lab_test_type_list').empty();
						for(i=0; i<data.text.length; i++) {
						//$('#testlist').append("<option value="+data.text[i].l_assistent_id+">"+data.text[i].l_code+"</option>");                      
						$('#lab_test_type_list').append("<tr id=td_id"+data.text[i].PLid+"><td>"+data.text[i].t_name+"</td><td>"+data.text[i].amuont+"</td><td>"+data.text[i].duration+"</td><td><a class='btn btn-sm btn-danger' onclick='remove_patient_lab_test("+data.text[i].PLid+");'>Remove</a></td></tr>");                      

						}
						}
				 }
			});
	}
	function remove_patient_lab_test(t_id){
		jQuery.ajax({
					url: "<?php echo base_url('resources/remove_patient_treatment_id');?>",
					data: {
						t_id: t_id,
						patinet_id: $('#test_patient_id').val(),
					},
					dataType: 'json',
					type: 'POST',
					success: function (data) {
						if(data.msg==1){
							 $('#countdisplaying').show();
							 $('#testcount').empty();
							 $('#test_list_count').empty();
							 $('#testcount').append(data.count);
							 $('#test_list_count').append(data.count);
   						jQuery('#td_id'+t_id).hide();
   					}
				 }
			});
		
	}
   function check_lab_test(){
   	var count=$('#test_list_count').val();
   	if(count==''){
   		alert('Please select atleast one Investigation test');		
   		return false;
   		
   	}
   	
   }
   
   function check_qty(){
   	var med_name = $('#medicine_name').val();
   	var qty=$('#qty').val();
   	var or_qty = med_name.split("_");
   	var av_qty=or_qty[1];
   	//document.write(Number.isInteger(qty));
   	if(qty!=''){
   		 
   		if(Number(av_qty)> Number(qty)){
   			
   			//alert('done');return false;
   		}else{
   			alert('medicine quantity is greater than available quantity');return false;
   		}
   	}
   	
   	
   }
   function addtestlist(){
   	
   	var favorite = [];
               $.each($("input[name='testlistid']:checked"), function(){            
                   favorite.push($(this).val());
               });
   			
   			if(favorite==''){
   				alert('Please choose atleast one test');
   				return false;
   			}
   			jQuery.ajax({
   					url: "<?php echo base_url('resources/selected_test');?>",
   					data: {
   						ids: favorite,
   						patinet_id: $('#test_patient_id').val(),
   						patinet_bid: $('#test_patient_bid').val(),
   					},
   					dataType: 'json',
   					type: 'POST',
   					success: function (data) {
   						if(data.msg==1){
   							 $('#countdisplaying').show();
   							 $('#testcount').empty();
   							 $('#test_list_count').empty();
   							 $('#testcount').append(data.count);
   							 $('#test_list_count').val(data.count);
   							 $('#popupclose').click();
   							 alert('Test added successfully');
   	
   						}
   						
   						
   					}
   			});
          //+ favorite.join("/");
   	}
   	function investdation_serach(id){
		alert();
   		if(id!=''){
   			$('#internal_code').empty();
   			jQuery.ajax({
   					url: "<?php echo base_url('resources/investigationsearch');?>",
   					data: {
   						searchdata: id,
   					},
   					dataType: 'json',
   					type: 'POST',
   					success: function (data) {
					//var parsedData = JSON.parse(data);
						console.log(data);
						console.log(Object.values(data))
   						if(data.msg==1){
   						   $('#internal_code').empty();
   						   $('#internal_code').append("<option value=''>select </option>");                      
   
								for(i=0; i<data.text.length; i++) {
									console.log(data.text[i].t_name);
									 $('#internal_code').append("<option value='"+data.text[i].t_name+"'>"+data.text[i].t_name+"</option>");                      
								}
   						}
   				 }
   			});
   		}
   	}
	function test_list_purpose(id){
   		if(id!=''){
   			$('#lab_test_name').empty();
   			jQuery.ajax({
   					url: "<?php echo base_url('resources/test_name_testsearch');?>",
   					data: {
   						type: $('#investdation_serach').val(),
   						test_type_id: id,
   					},
   					dataType: 'json',
   					type: 'POST',
   					success: function (data) {
					    if(data.msg==1){
   						   $('#lab_test_name').empty();
   						   $('#lab_test_name').append("<option value=''>select </option>");                      
								for(i=0; i<data.text.length; i++) {
									 $('#lab_test_name').append("<option value='"+data.text[i].t_id+"'>"+data.text[i].t_name+"</option>");                      
								}
   						}
   				 }
   			});
   		}
   	}
   	function labtest_serach(id){
   		if(id!=''){
   			$('#testlist').empty();
   			jQuery.ajax({
   					url: "<?php echo base_url('resources/testsearch');?>",
   					data: {
   						type: $('#investdation_serach').val(),
   						test_type_id: id,
   					},
   					dataType: 'json',
   					type: 'POST',
   					success: function (data) {
   						if(data.msg==1){
   						$('#testlist').empty();
   						for(i=0; i<data.text.length; i++) {
   						//$('#testlist').append("<option value="+data.text[i].l_assistent_id+">"+data.text[i].l_code+"</option>");                      
   						$('#testlist').append("<tr><td>"+data.text[i].t_name+"</td><td>"+data.text[i].type+"</td><td>"+data.text[i].modality+"</td><td><input type='checkbox' id='testlistid' name='testlistid' value="+data.text[i].t_id+"></td></tr>");                      
   						
   						}
   						
   						}
   					
   				 }
   				 
   			});
   		}
   	}
   	function get_patient_list(){
   			$('#lab_test_type_list').empty();
   			jQuery.ajax({
   					url: "<?php echo base_url('resources/get_patinent_list');?>",
   					data: {
   						patinet_id: $('#patient_id_test_list').val(),
   						patinet_bid: $('#patient_bid_test_list').val(),
   					},
   					dataType: 'json',
   					type: 'POST',
   					success: function (data) {
   						console.log(data);
   						if(data.msg==1){
   						$('#lab_test_type_list').empty();
   						for(i=0; i<data.text.length; i++) {
   						//$('#testlist').append("<option value="+data.text[i].l_assistent_id+">"+data.text[i].l_code+"</option>");                      
   						$('#lab_test_type_list').append("<tr id=td_id"+data.text[i].PLid+"><td>"+data.text[i].t_name+"</td><td>"+data.text[i].amuont+"</td><td>"+data.text[i].duration+"</td><td><a onclick='remove_patient_lab_test("+data.text[i].PLid+");' class='btn btn-sm btn-danger'>Remove</a></td></tr>");                      
   
   						}
   						}
   				 }
   			});
   	}
   	function remove_patient_lab_test(t_id){
   		jQuery.ajax({
   					url: "<?php echo base_url('resources/remove_patient_treatment_id');?>",
   					data: {
   						t_id: t_id,
   						patinet_id: $('#test_patient_id').val(),
   					},
   					dataType: 'json',
   					type: 'POST',
   					success: function (data) {
   						if(data.msg==1){
   							 $('#countdisplaying').show();
   							 $('#testcount').empty();
   							 $('#test_list_count').empty();
   							 $('#testcount').append(data.count);
   							 $('#test_list_count').append(data.count);
      						jQuery('#td_id'+t_id).hide();
      					}
   				 }
   			});
   		
   	}
   	
   	$(".form-control").change(function(){
               $('#addinvestigation').bootstrapValidator('revalidateField', 'investigation_formdate');
               $('#addinvestigation').bootstrapValidator('revalidateField', 'investigation_todate');
   
   	}); 
   	$(document).ready(function() {
   		$('#addinganotherdoctor').bootstrapValidator({
   		fields: {
             assign_another_doctor: {
                     validators: {
   					notEmpty: {
   						message: 'Doctor is required'
   					}
   				}
               }
   			}
   		
   	})
        
   });	
   	$(document).ready(function() {
   		
    
       $('#addinvestigation').bootstrapValidator({
   		fields: {
             
                investigation_type: {
                    validators: {
   					notEmpty: {
   						message: 'Investigation type is required'
   					}
   				}
               },frequency: {
                     validators: {
   					notEmpty: {
   						message: 'Frequency is required'
   					}
   				}
               },priority: {
                     validators: {
   					notEmpty: {
   						message: 'Priority is required'
   					}
   				}
               }
   			}
   		
   	})
        
   });
   	$(document).ready(function() {
   	$('#add_medicines_backup').bootstrapValidator({
   		fields: {
             
                type_of_medicine: {
                    validators: {
   					notEmpty: {
   						message: 'Type of Medicine? is required'
   					}
   				}
               }, 
   			medicine_name: {
                    validators: {
   					notEmpty: {
   						message: 'Search for Medicine is required'
   					}
   				}
               },
   			frequency: {
                    validators: {
   					notEmpty: {
   						message: 'Frequency is required'
   					}
   				}
               },
   			qty: {
                    validators: {
   					notEmpty: {
   						message: 'Qty is required'
   					},
   					regexp: {
   					regexp:  /^[0-9]+$/,
   					message: 'Qty can only consist of digits'
   					}
   				}
               },
   			days: {
                    validators: {
   					notEmpty: {
   						message: 'No of Days is required'
   					},
   					regexp: {
   					regexp:  /^[0-9]+$/,
   					message: 'No of Days can only consist of digits'
   					}
   				}
               }
   			}
   		
   	})
        
   });
   
   	$(document).ready(function() {
   	$('#vitalscomment').bootstrapValidator({
   		fields: {
             
                'comments[]': {
                    validators: {
   					notEmpty: {
   						message: 'Comment is required'
   					}
   				}
               }
   			}
   		
   	})
        
   });	
   
      function removemedicine_from_list(id,qty,med_name,org_medicine_id){
      	if(id!=''){
      		 jQuery.ajax({
      					url: "<?php echo site_url('resources/removemedicine_from_list');?>",
      					data: {
      						medicine_id: id,
      						medicine_qty: qty,
      						medicine_name: med_name,
      						org_medicine_id: org_medicine_id,
      					},
      					dataType: 'json',
      					type: 'POST',
      					success: function (data) {
      					if(data.msg==1){
      						jQuery('#medicine_id_'+id).hide();
      					}
      				 }
      				});
      			}
      	
      } function removemedicine(id,qty,med_name){
      	if(id!=''){
      		 jQuery.ajax({
      					url: "<?php echo site_url('resources/removemedicine');?>",
      					data: {
      						medicine_id: id,
      						medicine_qty: qty,
      						medicine_name: med_name,
      					},
      					dataType: 'json',
      					type: 'POST',
      					success: function (data) {
      					if(data.msg==1){
      						jQuery('#medicine_id_'+id).hide();
      					}
      				 }
      				});
      			}
      	
      }
      function removeinvestigation(id){
      	if(id!=''){
      		 jQuery.ajax({
      					url: "<?php echo site_url('resources/removeinvestigation');?>",
      					data: {
      						investigation_id: id,
      					},
      					dataType: 'json',
      					type: 'POST',
      					success: function (data) {
      					if(data.msg==1){
      						jQuery('#investigation_id_'+id).hide();
      					}
      				 }
      				});
      			}
      	
      }
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
   
   
</script>
<script>
   $(document).ready(function() {
     $("#select2insidemodal").select2({
       dropdownParent: $("#myModal")
     });
   });
   
</script>
