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
            <div class="panel-group col-md-9" id="accordion">
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
                           <strong>Marital status</strong>
                           <p><?php echo isset($patient_details['martial_status'])?$patient_details['martial_status']:''; ?></p>
                        </div>
                        <div class="col-md-3">
                           <strong>DOB</strong>
                           <p><?php echo isset($patient_details['dob'])?$patient_details['dob']:''; ?></p>
                        </div>
                        <div class="col-md-3">
                           <strong>Age</strong>
                           <p><?php echo isset($patient_details['age'])?$patient_details['age']:''; ?></p>
                        </div>
                        <div class="col-md-3">
                           <strong>Address</strong>
                           <p>
                              <?php echo isset($patient_details['perment_address'])?$patient_details['perment_address'].',':''; ?>
                              <?php echo isset($patient_details['p_c_name'])?$patient_details['p_c_name'].',':''; ?>
                              <?php echo isset($patient_details['p_s_name'])?$patient_details['p_s_name'].',':''; ?>
                              <?php echo isset($patient_details['p_country_name'])?$patient_details['p_country_name'].',':''; ?>
                              <?php echo isset($patient_details['p_zipcode'])?$patient_details['p_zipcode'].',':''; ?>
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-3">
			   <a href="javascript:void(0)" data-toggle="modal" data-target="#medicine_list_hmodal" class="btn btn-sm btn-warning">Previous Medication Reports</a>
               <a target="_blank" href="<?php echo base_url('resources/patient_report_details/'.base64_encode($patient_id));?>" class="btn btn-sm btn-success" type="button">Previous Investigation Reports</a>
            </div>
         </div>
<div class="card-body row">
   <div id="smartwizard" class="col-md-12">
      <ul>
         <li><a href="#step-1" >Diagnosis<br /><small>This is step description</small></a></li>
         <li><a href="#step-2">Medication<br /><small>This is step description</small></a></li>
         <li><a href="#step-3">Investigation<br /><small>This is step description</small></a></li>
         <!--<li><a href="#step-3">Assign<br /><small>This is step description</small></a></li>-->
      </ul>
      <div>
         <div id="step-1" class="">
            <div class="row">
               <div class="col-md-2"> 
                  <strong>Whitefield</strong>
               </div>
               <!--<div class="col-md-1"> 
                  <span class="btn btn-xs btn-info" data-toggle="modal" data-target="#squarespaceModal">View All</span>
               </div>-->
            </div>
             <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="example1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2">Date</th>
                                    <th colspan="5" class="text-center">Actuals</th>
                                    <th colspan="5" class="text-center">Range</th>
                                </tr>
                                <tr>
                                    <th>BP</th>
                                    <th>Pulse</th>
                                    <th>FBS/RBS</th>
                                    <th>Temp</th>
                                    <th>Weight</th>
                                    <th>BP</th>
                                    <th>Pulse</th>
                                    <th>FBS/RBS</th>
                                    <th>Temp</th>
                                    <th>Weight</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>12/4/2019</td>
                                    <td>523</td>
                                    <td>523</td>
                                    <td>523</td>
                                    <td>523</td>
                                    <td>523</td>
                                    <td>523</td>
                                    <td>523</td>
                                    <td>523</td>
                                    <td>523</td>
                                    <td>523</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                 </div>
             </div>
            <div class="row clearfix">
			<?php if(isset($encounters_list) && count($encounters_list)>0){ ?>
               <?php $cnt=0;foreach($encounters_list as $list){
				?>
               <?php if($cnt<=2){ ?>
				<div class="col-md-4 py-4">
					<table class="table table-bordered ">
					<h3><?php echo isset($list['vitaltype'])?$list['vitaltype']:'Vitals'; ?> (<?php echo $list['date']; ?> )</h3>
						<tr>
							<th class="text-center">Vitals</th>
							<th class="text-center">Actuals</th>
							<th class="text-center">Range</th>
						</tr>
						<tr>
							<th class="text-center">BP</th>
							<th class="text-center"><?php echo isset($list['bp'])?$list['bp']:''; ?></th>
							<th class="text-center">120/80</th>
						</tr>
						<tr>
							<th class="text-center">Pulse</th>
							<th class="text-center"><?php echo isset($list['pulse'])?$list['pulse']:''; ?></th>
							<th class="text-center">70-80</th>
						</tr>
						<tr>
							<th class="text-center">FBS/RBS</th>
							<th class="text-center"><?php echo isset($list['fbs_rbs'])?$list['fbs_rbs']:''; ?></th>
							<th class="text-center">70-110	</th>
						</tr>
						<tr>
							<th class="text-center">Temp</th>
							<th class="text-center"><?php echo isset($list['temp'])?$list['temp']:''; ?></th>
							<th class="text-center">98.6 F</th>
						</tr>
						<tr>
							<th class="text-center">Weight</th>
							<th class="text-center"><?php echo isset($list['weight'])?$list['weight']:''; ?></th>
							<th class="text-center"></th>
						</tr>
						
					</table>
				</div>
				<?php } ?>
               <?php $cnt++;} ?>
               <?php } ?>
              <!-- <?php if(isset($encounters_list) && count($encounters_list)>0){ ?>
               <?php $cnt=0;foreach($encounters_list as $list){
									//echo "<pre>";print_r($list);exit; 

			   ?>
               <?php if($cnt<=3){ ?>								
               <div class="col-md-3 col-sm-3 col-xs-12">
                  <div class="card card-topline-purple">
                     <div class="card-head">
                        <header><?php echo isset($list['vitaltype'])?$list['vitaltype']:'Vitals'; ?> (<?php echo $list['date']; ?> )</header>
                     </div>
                     <div >Temperature : <?php echo isset($list['tep_actuals'])?$list['tep_actuals']:''; ?> : <?php echo isset($list['tep_range'])?$list['tep_range']:''; ?></div>
                     <div>Temperature site : <?php echo isset($list['temp_site_positioning'])?$list['temp_site_positioning']:''; ?></div>
                     <div>Notes: <?php echo isset($list['notes'])?$list['notes']:''; ?></div>
                     <div> Pulse rate : <?php echo isset($list['pulse_actuals'])?$list['pulse_actuals']:''; ?> : <?php echo isset($list['pulse_range'])?$list['pulse_range']:''; ?></div>
                     <div> Pulse rate sight : <?php echo isset($list['pulse_rate_rhythm'])?$list['pulse_rate_rhythm']:''; ?> : <?php echo isset($list['pulse_rate_vol'])?$list['pulse_rate_vol']:''; ?></div>
                     <div>Notes: <?php echo isset($list['notes1'])?$list['notes1']:''; ?></div>
                  </div>
               </div>
               <?php } ?>
               <?php $cnt++;} ?>
               <?php } ?>-->
               <div class="clearfix">&nbsp;</div>
               <!--<div class="container">
			    <form id="vitalscomment" name="vitalscomment" role="form" action="<?php echo base_url('resources/vitalscomment'); ?>" method="post" autocomplete="off">
                  <div class="form-group" id="fields">
                     <label class="control-label" for="field1"><strong>Cases</strong></label>
                     <div class="controls">
                        <form id="vitalscomment" name="vitalscomment" role="form" action="<?php echo base_url('resources/vitalscomment'); ?>" method="post" autocomplete="off">
                           <input type="hidden" name="bid" id="bid" value="<?php echo isset($billing_id)?$billing_id:''; ?>">
                          
						  <input type="hidden" name="pid" id="pid" value="<?php echo isset($patient_id)?$patient_id:''; ?>">
                           <div class="entry input-group ">
                              <textarea type="textarea" class="form-control" name="comments[]" id="comments[]"  placeholder="Enter Comments" required></textarea>
                              <span class="input-group-btn">
                              <button class="btn btn-success btn-add" type="button">
                              <span class="glyphicon glyphicon-plus">+</span>
                              </button>
                              </span>
                           </div>
						
                       
                        <br>
                     </div>
                  </div>
				  <div class="clearfix">&nbsp;</div>
				      <button class="btn btn-primary " type="submit" >Send</button>
                        </form>
               </div>-->
            </div>
         </div>
         <div id="step-2" class="">
           <a href="<?php echo base_url('resources/skip_prescription/'.base64_encode($patient_id).'/'.base64_encode($billing_id)); ?>" >Alternate way</a>
                        <form id="add_medicines" name="add_medicines" onsubmit="return check_qty()"  action="<?php echo base_url('resources/medicine'); ?>" method="post" >
                           <input type="hidden" name="pid" id="pid" value="<?php echo isset($patient_id)?$patient_id:''; ?>">
                           <input type="hidden" name="bid" id="bid" value="<?php echo isset($billing_id)?$billing_id:''; ?>">
                           <div class="row">
                              <div class="col-md-12 ">
                                 <div class="container">
								 <div class="row">
<div class="col-sm-3 nopadding">
 <label> Select Medicine</label>
  <div class="form-group">
  
 <select class="form-control  select2" id="medicine_name"  name="medicine_name">
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
	<input type="text" class="form-control" id="qty"  name="addmedicn[0][qty]" value="" placeholder="Qty">
  </div>
</div>

<div class="col-sm-3 nopadding">
 <label> Frequency</label>
<div class="row">
		<div class="checkbox checkbox-black col-md-4">
			<input id="checkboxbg1" type="checkbox" checked="checked">
			<label for="checkboxbg1">
			   Mrng
			</label>
		</div>
		<div class="checkbox checkbox-black col-md-4">
			<input id="checkboxbg1" type="checkbox" checked="checked">
			<label for="checkboxbg1">
				Afnoon
			</label>
		</div>
		<div class="checkbox checkbox-black col-md-4">
			<input id="checkboxbg1" type="checkbox" checked="checked">
			<label for="checkboxbg1">
				Night
			</label>
		</div>
		</div>
</div>

<div class="col-sm-2 nopadding">
 <label> Food </label>
		<select class="form-control" name="food" id="food">
		   <option value="" >Select</option>
		   <option value="Before">Before</option>
		   <option value="After">After</option>
		</select>
</div>

<div class="col-sm-2 nopadding">
 <label> Days </label>
  <div class="form-group">
	<input type="text" class="form-control" id="amount0"  name="addmedicn[0][amount]"  value="" placeholder="No of Days">
  </div>
</div>
</div>
								 <div class="row">
<div class="col-sm-3 nopadding">
 <label> Select Medicine</label>
  <div class="form-group">
  
 <select class="form-control  select2" id="medicine_name"  name="medicine_name">
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
	<input type="text" class="form-control" id="qty"  name="addmedicn[0][qty]" value="" placeholder="Qty">
  </div>
</div>

<div class="col-sm-3 nopadding">
 <label> Frequency</label>
<div class="row">
		<div class="checkbox checkbox-black col-md-4">
			<input id="checkboxbg1" type="checkbox" checked="checked">
			<label for="checkboxbg1">
			   Mrng
			</label>
		</div>
		<div class="checkbox checkbox-black col-md-4">
			<input id="checkboxbg1" type="checkbox" checked="checked">
			<label for="checkboxbg1">
				Afnoon
			</label>
		</div>
		<div class="checkbox checkbox-black col-md-4">
			<input id="checkboxbg1" type="checkbox" checked="checked">
			<label for="checkboxbg1">
				Night
			</label>
		</div>
		</div>
</div>

<div class="col-sm-2 nopadding">
 <label> Food </label>
		<select class="form-control" name="food" id="food">
		   <option value="" >Select</option>
		   <option value="Before">Before</option>
		   <option value="After">After</option>
		</select>
</div>

<div class="col-sm-2 nopadding">
 <label> Days </label>
  <div class="form-group">
	<input type="text" class="form-control" id="amount0"  name="addmedicn[0][amount]"  value="" placeholder="No of Days">
  </div>
</div>
</div>
								 <div class="row">
<div class="col-sm-3 nopadding">
 <label> Select Medicine</label>
  <div class="form-group">
  
 <select class="form-control  select2" id="medicine_name"  name="medicine_name">
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
	<input type="text" class="form-control" id="qty"  name="addmedicn[0][qty]" value="" placeholder="Qty">
  </div>
</div>

<div class="col-sm-3 nopadding">
 <label> Frequency</label>
<div class="row">
		<div class="checkbox checkbox-black col-md-4">
			<input id="checkboxbg1" type="checkbox" checked="checked">
			<label for="checkboxbg1">
			   Mrng
			</label>
		</div>
		<div class="checkbox checkbox-black col-md-4">
			<input id="checkboxbg1" type="checkbox" checked="checked">
			<label for="checkboxbg1">
				Afnoon
			</label>
		</div>
		<div class="checkbox checkbox-black col-md-4">
			<input id="checkboxbg1" type="checkbox" checked="checked">
			<label for="checkboxbg1">
				Night
			</label>
		</div>
		</div>
</div>

<div class="col-sm-2 nopadding">
 <label> Food </label>
		<select class="form-control" name="food" id="food">
		   <option value="" >Select</option>
		   <option value="Before">Before</option>
		   <option value="After">After</option>
		</select>
</div>

<div class="col-sm-2 nopadding">
 <label> Days </label>
  <div class="form-group">
	<input type="text" class="form-control" id="amount0"  name="addmedicn[0][amount]"  value="" placeholder="No of Days">
  </div>
</div>
</div>
								 		<div class="row">
									
										
										<div class="col-sm-3 nopadding">
										 <label> Select Medicine</label>
										  <div class="form-group">
										  
										 <select class="form-control  select2" id="medicine_name"  name="medicine_name">
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
											<input type="text" class="form-control" id="qty"  name="addmedicn[0][qty]" value="" placeholder="Qty">
										  </div>
										</div>
										
										<div class="col-sm-3 nopadding">
										 <label> Frequency</label>
										<div class="row">
												<div class="checkbox checkbox-black col-md-4">
                                                    <input id="checkboxbg1" type="checkbox" checked="checked">
                                                    <label for="checkboxbg1">
                                                       Mrng
                                                    </label>
                                                </div>
												<div class="checkbox checkbox-black col-md-4">
                                                    <input id="checkboxbg1" type="checkbox" checked="checked">
                                                    <label for="checkboxbg1">
                                                        Afnoon
                                                    </label>
                                                </div>
												<div class="checkbox checkbox-black col-md-4">
                                                    <input id="checkboxbg1" type="checkbox" checked="checked">
                                                    <label for="checkboxbg1">
                                                        Night
                                                    </label>
                                                </div>
                                                </div>
										</div>
										
										<div class="col-sm-2 nopadding">
										 <label> Food </label>
                                                <select class="form-control" name="food" id="food">
                                                   <option value="" >Select</option>
                                                   <option value="Before">Before</option>
                                                   <option value="After">After</option>
                                                </select>
										</div>
										
										<div class="col-sm-2 nopadding">
										 <label> Days </label>
										  <div class="form-group">
											<input type="text" class="form-control" id="amount0"  name="addmedicn[0][amount]"  value="" placeholder="No of Days">
										  </div>
										</div>
										
										<div class="col-sm-1 nopadding">
										 <label> &nbsp; </label>
										  <div class="input-group-btn">
											<button class="btn btn-success" type="button"  onclick="education_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true">+</span> </button>
										  </div>
										</div>
										
										</div>
										<div class="row">
										   <div id="education_fields">
          
										</div>
										</div>
										
										
										
                                   <!-- <div class="row">
                                      <?php //echo '<pre>';print_r($medicine_list);exit; ?>
                                       <div class="col-md-6">
                                          <label>Search for Medicine</label>
											<input type="hidden" name="qtav_check" id="qtav_check" value="">										  
                                          <select class="form-control  select2" id="medicine_name"  name="medicine_name">
                                             <option value="">Select</option>
                                             <?php foreach($medicine_list as $list){ ?>
                                             <option value="<?php echo $list['medicine_name'].'_'.$list['qty']; ?>"><?php echo $list['medicine_name']; ?>-<?php echo "dosage ".$list['dosage']; ?> - <?php echo "Avl qty :".$list['qty']; ?> - <?php echo "Type :".$list['medicine_type']; ?></option>
                                             <?php } ?>
                                          </select>
                                       </div>
                                       <div class="col-md-6">
                                                <label> Qty</label>
                                                <input class="form-control" name="qty" id="qty" type="text" placeholder="Enter Qty">
                                            </div>
                                            </div>
											 <div class="row">
                                       <div class="col-md-6">
                                         
                                              <label> Frequency </label>
                                                <select class="form-control" name="frequency" id="frequency">
                                                   <option value="" >Select</option>
                                                   <option value="Once in morning">Once in morning</option>
                                                   <option value="Once in afternoon">Once in afternoon</option>
                                                   <option value="Once in night">Once in night</option>
                                                   <option value="Twice in a day">Twice in a day</option>
                                                   <option value="Thrice in a day">Thrice in a day</option>
												   
                                                </select>
                                            
                                        
                                       </div>
									   
                                          <div class="col-md-6">
                                          
                                              <label> Food </label>
                                                <select class="form-control" name="food" id="food">
                                                   <option value="" >Select</option>
                                                   <option value="Before">Before</option>
                                                   <option value="After">After</option>
                                                </select>
                                         
                                       </div> 
                                       </div> 

										 <div class="row"> 

										 <div class="col-md-6">
                                                <label> No of Days</label>
                                                <input class="form-control" name="days" id="days" type="text" placeholder="Enter No of Days">
                                            </div>

                                       <div class="col-md-6">
                                          <label> Directions</label>
                                          <textarea type="textarea" name="directions" id="directions" class="form-control"  placeholder="Enter Directions" ></textarea>
                                       </div>
                                       
                                    </div> -->
									<div class="row"> 

										

                                       <div class="col-md-12">
                                          <label> Directions</label>
                                          <textarea type="textarea" name="directions" id="directions" class="form-control"  placeholder="Enter Directions" ></textarea>
                                       </div>
                                       
                                    </div>
                                 </div>
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
							TestName
						</th>
						<th class="text-center">
							Frequency
						</th>
					</tr>
				</thead>
				<tbody>
					<tr id='addr0'>
						
						<td>
							<select class="form-control " name="frequency" id="frequency">
								   <option value="" >Select</option>
								   <option>Lab</option>
								   <option>Radiology</option>
								</select>
							
						</td>
						<td>
						   <select  style="width:100%" class="form-control select2" name="frequency" id="frequency">
							   <option value="" >Select</option>
							   <option value="Once in morning">Once in morning</option>
							   <option value="Once in afternoon">Once in afternoon</option>
							   <option value="Once in night">Once in night</option>
							   <option value="Twice in a day">Twice in a day</option>
							   <option value="Thrice in a day">Thrice in a day</option>
							   
							</select>
							
						</td>
						<td>
							<select class="form-control select2" style="width:100%">
							   <option value="" >Select</option>
							   <option value="Once in morning">Once in morning</option>
							   <option value="Once in afternoon">Once in afternoon</option>
							   <option value="Once in night">Once in night</option>
							   <option value="Twice in a day">Twice in a day</option>
							   <option value="Thrice in a day">Thrice in a day</option>
							   
							</select>
						</td>
						<td>
						<select class="form-control " name="frequency" id="frequency">
								   <option value="" >Select</option>
								   <option>6 Hours</option>
								   <option>12 Hours</option>
								   <option>24 Hours</option>
								   <option>48 Hours</option>
								</select>
						</td>
					</tr>
                    <tr id='addr1'></tr>
				</tbody>
			</table>
		</div>
	</div>
	<button id="add_row" class="btn btn-default pull-left">Add Row</button><button id='delete_row' class="pull-right btn btn-default">Delete Row</button>
	<div class=" clearfix">&nbsp;</div>
	<div class=" clearfix">&nbsp;</div>
	<div class="row  pull-right ">
		
		<button class="btn btn-primary ">Submit</button>
	</div>
	<div class=" clearfix">&nbsp;</div>
	<div class=" clearfix">&nbsp;</div>
</div>
		</div>
         <!--<div id="step-3" class="">
            <div class=" text-center min-h-300">
				
				<div class="row">
				<div class="col-md-6">
				<div class="row">
				<div class="col">
				<form class="pharm" id="pharm" action="<?php echo base_url('resources/patient_completed'); ?>" method="post">
				  <input type="hidden" name="billing_id" id="billing_id" value="<?php echo isset($billing_id)?$billing_id:''; ?>">
					<input type="hidden" name="type" id="type" value="1">
					<input type="hidden" name="pid" id="pid" value="<?php echo isset($patient_id)?$patient_id:''; ?>">
					<button type="submit" class="btn btn-xs btn-info">Assign to Pharmacy</button>
				</form>
				</div>
				<div class="col">
					<form action="<?php echo base_url('resources/patient_completed'); ?>" method="post">
				    <input type="hidden" name="billing_id" id="billing_id" value="<?php echo isset($billing_id)?$billing_id:''; ?>">
                  <input type="hidden" name="type" id="type" value="2">
				<input type="hidden" name="pid" id="pid" value="<?php echo isset($patient_id)?$patient_id:''; ?>">
				<button type="submit" class="btn btn-xs btn-warning">Assign to Investigation</button>
				</form>
				</div>
				</div>
				</div>
				<div class="col-md-6">
				<div class="row">
				<form id="addinganotherdoctor" name="addinganotherdoctor" action="<?php echo base_url('resources/patient_completed'); ?>" method="post">
					<div class="col">
				
                  <input type="hidden" name="pid" id="pid" value="<?php echo isset($patient_id)?$patient_id:''; ?>">
                  <input type="hidden" name="billing_id" id="billing_id" value="<?php echo isset($billing_id)?$billing_id:''; ?>">
                  <input type="hidden" name="type" id="type" value="3">
					<select style="width:200px;" class="form-control" id="assign_another_doctor" name="assign_another_doctor">
						<option value="">Select </option>
						<?php foreach($doctors_list as $list){ ?>
						<option value="<?php echo $list['a_id']; ?>"><?php echo $list['resource_name']; ?></option>
						<?php } ?>
					</select>
				
				</div>
				<div class="col">
				<button type="submit" class="btn btn-xs btn-danger">Assign to another doctor</button>
				</div>
				 </form>
				 </div>
				 </div>
			
				</div>
            </div>
     
      </div>-->
   </div>
</div>
<!-- view all modal -->
<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header bg-indigo">
            <h5 class="modal-title" id="lineModalLabel">Encounters</h5>
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
         </div>
         <div class="modal-body">
            <div class="container">
               <div class="row">
                  <div class="card card-topline-red col-md-12">
                     <div class="card-head">
                        <header>List</header>
                     </div>
                     <div class="card-body " id="bar-parent">
                        <div class="row">
                           <div class="col-md-3 col-sm-3 col-xs-3">
                              <ul class="nav nav-tabs tabs-left">
                                 <?php $c=0;foreach($encounters_list as $lists){ ?>
                                 <?php if($c==0){?>
                                 <li class="nav-item">
                                    <a href="#tab_6_<?php echo $lists['id']; ?>" class="active" data-toggle="tab"><?php echo isset($lists['vitaltype'])?$lists['vitaltype']:'Vitals'; ?>(<?php echo $lists['date']; ?>)</a>
                                 </li>
                                 <?php }else{ ?>
                                 <li class="nav-item">
                                    <a href="#tab_6_<?php echo $lists['id']; ?>" data-toggle="tab"><?php echo isset($lists['vitaltype'])?$lists['vitaltype']:'Vitals'; ?>(<?php echo $lists['date']; ?>)</a>
                                 </li>
                                 <?php } ?>
                                 <?php $c++;} ?>
                              </ul>
                           </div>
                           <div class="col-md-9 col-sm-9 col-xs-9">
                              <div class="tab-content">
                                 <?php $cn=0;foreach($encounters_list as $list){ ?>
                                 <?php if($cn==0){ ?>
                                 <div class="tab-pane active" id="tab_6_<?php echo $list['id']; ?>">
                                    <div class="table-responsive  py-4">
										<table class="table table-bordered ">
										<h3><?php echo isset($list['vitaltype'])?$list['vitaltype']:'Vitals'; ?> (<?php echo $list['date']; ?> )</h3>
											<tr>
												<th class="text-center">Vitals</th>
												<th class="text-center">Actuals</th>
												<th class="text-center">Range</th>
											</tr>
											<tr>
												<th class="text-center">BP</th>
												<th class="text-center"><?php echo isset($list['bp'])?$list['bp']:''; ?></th>
												<th class="text-center">120/80</th>
											</tr>
											<tr>
												<th class="text-center">Pulse</th>
												<th class="text-center"><?php echo isset($list['pulse'])?$list['pulse']:''; ?></th>
												<th class="text-center">70-80</th>
											</tr>
											<tr>
												<th class="text-center">FBS/RBS</th>
												<th class="text-center"><?php echo isset($list['fbs_rbs'])?$list['fbs_rbs']:''; ?></th>
												<th class="text-center">70-110	</th>
											</tr>
											<tr>
												<th class="text-center">Temp</th>
												<th class="text-center"><?php echo isset($list['temp'])?$list['temp']:''; ?></th>
												<th class="text-center">98.6 F</th>
											</tr>
											<tr>
												<th class="text-center">Weight</th>
												<th class="text-center"><?php echo isset($list['weight'])?$list['weight']:''; ?></th>
												<th class="text-center">70-80</th>
											</tr>
											
										</table>
									</div>
                                 </div>
                                 <?php }else{ ?>
                                 <div class="tab-pane " id="tab_6_<?php echo $list['id']; ?>">
                                   <div class="table-responsive  py-4">
										<table class="table table-bordered ">
										<h3><?php echo isset($list['vitaltype'])?$list['vitaltype']:'Vitals'; ?> (<?php echo $list['date']; ?> )</h3>
											<tr>
												<th class="text-center">Vitals</th>
												<th class="text-center">Actuals</th>
												<th class="text-center">Range</th>
											</tr>
											<tr>
												<th class="text-center">BP</th>
												<th class="text-center"><?php echo isset($list['bp'])?$list['bp']:''; ?></th>
												<th class="text-center">120/80</th>
											</tr>
											<tr>
												<th class="text-center">Pulse</th>
												<th class="text-center"><?php echo isset($list['pulse'])?$list['pulse']:''; ?></th>
												<th class="text-center">70-80</th>
											</tr>
											<tr>
												<th class="text-center">FBS/RBS</th>
												<th class="text-center"><?php echo isset($list['fbs_rbs'])?$list['fbs_rbs']:''; ?></th>
												<th class="text-center">70-110	</th>
											</tr>
											<tr>
												<th class="text-center">Temp</th>
												<th class="text-center"><?php echo isset($list['temp'])?$list['temp']:''; ?></th>
												<th class="text-center">98.6 F</th>
											</tr>
											<tr>
												<th class="text-center">Weight</th>
												<th class="text-center"><?php echo isset($list['weight'])?$list['weight']:''; ?></th>
												<th class="text-center"></th>
											</tr>
											
										</table>
									</div>
                                 </div>
                                 <?php } ?>
                                 <?php $cn++;} ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
               <div class="btn-group" role="group">
                  <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
               </div>
               <div class="btn-group btn-delete hidden" role="group">
                  <button type="button" id="delImage" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Delete</button>
               </div>
               <div class="btn-group" role="group">
                  <button type="button" id="saveImage" class="btn btn-default btn-hover-green" data-action="save" role="button">Save</button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--add new modal-->

<!--view investigationmodel modal-->
<div class="modal fade" id="investigationmodel" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header bg-indigo">
            <h5 class="modal-title" id="lineModalLabel">Investigation</h5>
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
         </div>
         <div class="modal-body">
            <div class="">
               <div class="">
                  <div class=" card card-topline-red">
                     <div class="card-head">
                        <header>Investigation List</header>
                     </div>
                     <div class="card-body ">
                        <div class="col-md-12 ">
                           <div class="table-scrollable">
                              <table class="table table-bordered">
                                 <thead>
                                    <tr>
                                       <th>Investigation type</th>
                                       <th>Priority</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php foreach($patient_investigation_list as $list){ ?>
                                    <tr id="investigation_id_<?php echo $list['id']; ?>">
									   <td><?php echo $list['investigation_type']; ?></td>
										<td><?php echo $list['priority']; ?></td>
                                       <td><span onclick="removeinvestigation(<?php echo $list['id']; ?>);" class="btn btn-sm btn-danger" >Remove</span></td>
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
<!--view investigationmodel-->
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
                                       <td><span onclick="removemedicine('<?php echo $list['m_id']; ?>','<?php echo $list['qty']; ?>','<?php echo $list['medicine_name']; ?>');" class="btn btn-danger btn-sm" >Remove</span></td>
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
<!--view preciption modal-->
<!--search modal-->
<div class="modal fade" id="searchmodal" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header bg-indigo">
            <h5 class="modal-title" id="lineModalLabel">Add Test List</h5>
            <button type="button" id="popupclose" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
         </div>
         <div class="modal-body" style="height:400px;overflow:hidden; overflow-y: scroll;">
		 
            <div class="">
               <div class="">
                  <div class=" card card-topline-red">
                     <div class="card-head">
                        <header>Select Test</header>
                     </div>
                     <div class="card-body ">
                        <div class="row">
                           <div class="col-md-12 ">
                              <div class="row">
                                 <div class="col-md-3 ">
                                    &nbsp;
                                 </div>
                                 <div class="col-md-6 ">
                                    <label>Investigation search</label>
                                    <select class="form-control" onchange="investdation_serach(this.value);" name="investdation_serach" id="investdation_serach">
                                       <option value="">Select </option>
                                       <option value="Lab">Lab </option>
                                       <option value="Radiology">Radiology</option>
                                    </select>
                                 </div>
                              </div>
                              <br>
                              <div class="row">
							  <div class="col-md-3 ">
                                    &nbsp;
                                 </div>
                                 <div class="col-md-6">
                                    <label>Test Type</label>
                                    <select onchange="labtest_serach(this.value)" id="internal_code" name="internal_code" class="form-control  select2" style="width:100%">
                                    </select>
                                 </div>
                                 
                              </div>
                           </div>
						   <div class="col-md-12 ">

                           <input type="hidden" name="test_patient_id" id="test_patient_id" value="<?php echo isset($patient_id)?$patient_id:''; ?>">
                           <input type="hidden" name="test_patient_bid" id="test_patient_bid" value="<?php echo isset($billing_id)?$billing_id:''; ?>">

							 <div class="card-head">
                                 <header>Search results	</header>
                              </div>
                              <div class="table-scrollable" >
                                 <table class="table table-bordered">
                                    <thead>
                                       <tr>
                                          <th>Test Name</th>
                                          <th>Type</th>
                                          <th>Modality</th>
                                          <th>Select</th>
                                       </tr>
                                    </thead>
                                    <tbody id="testlist">
                                      
                                    </tbody>
                                 </table>
                              </div>
                              <div class="clearfix">&nbsp;</div>
								 <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
								 <button type="button" onclick="addtestlist();" class="btn btn-sm btn-info">Add </button>
								 <a href="javascript:void(0)" onclick="get_patient_list()" data-toggle="modal" data-target="#test_list_searchmodal" class="btn btn-sm btn-warning">View</a>
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
<input type="hidden" name="patient_id_test_list" id="patient_id_test_list" value="<?php echo isset($patient_id)?$patient_id:''; ?>">
 <input type="hidden" name="patient_bid_test_list" id="patient_bid_test_list" value="<?php echo isset($billing_id)?$billing_id:''; ?>">

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
										<td><?php echo date('M-j-Y',strtotime(htmlentities($list['expiry_date'])));?></td>
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
                                          <th> Type</th>
                                          <th> Amount</th>
                                          <th> Duration</th>
                                          <th>Short form</th>
                                          <th>Description </th>
                                          <th>Department</th>
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

<!-- patient_lab_test_list_model-->
    <script type="text/javascript">
	$(document).ready(function(){
      var i=1;
     $("#add_row").click(function(){b=i-1;
      $('#addr'+i).html($('#addr'+b).html()).find('td:first-child');
      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      i++; 
  });
     $("#delete_row").click(function(){
    	 if(i>1){
		 $("#addr"+(i-1)).html('');
		 i--;
		 }
	 });

});
    </script>
    <script type="text/javascript">
	function form_submittion(){
	 
	 if($('#medicinename').val()!=''){
	  document.getElementById("addpostprescription").submit(); 
	 }
 }
var room = 1;
function education_fields() {
 
    room++;
    var objTo = document.getElementById('education_fields')
    var divtest = document.createElement("div");
	divtest.setAttribute("class", "form-group removeclass"+room);
	var rdiv = 'removeclass'+room;
    divtest.innerHTML = '<div class="row" style="margin:0px"><div class="col-sm-3 nopadding"><div class="form-group"><select style="width:100%;height:40px;" class="form-control" id="medicinename" onchange="get_medicin_amount_list(this.value,'+room+')" name="addmedicn['+room+'][medicine]"><option value="">Select</option><?php foreach($medicine_list as $list){ ?> <option value="<?php echo $list['id']; ?>"><?php echo $list['medicine_name']; ?>-<?php echo "dosage ".$list['dosage']; ?> - <?php echo "Avl qty :".$list['qty']; ?> - <?php echo "Type :".$list['medicine_type']; ?></option><?php } ?></select></div></div>	<div class="col-sm-1 nopadding"><div class="form-group"><input type="text" class="form-control" id="qty"  name="addmedicn['+room+'][qty]" value="" placeholder="Qty"></div></div>	<div class="col-sm-3 nopadding"><div class="row"><div class="checkbox checkbox-black col-md-4"> <input id="checkboxbg1" type="checkbox" checked="checked"> <label for="checkboxbg1"> Mrng </label> </div><div class="checkbox checkbox-black col-md-4"> <input id="checkboxbg1" type="checkbox" checked="checked"> <label for="checkboxbg1"> Afnoon </label> </div><div class="checkbox checkbox-black col-md-4"> <input id="checkboxbg1" type="checkbox" checked="checked"> <label for="checkboxbg1"> Night </label> </div> </div></div>	<div class="col-sm-2 nopadding"><select class="form-control" name="food" id="food"> <option value="" >Select</option> <option value="Before">Before</option> <option value="After">After</option> </select></div>	<div class="col-sm-2 nopadding"><div class="form-group"><input type="text" class="form-control" id="amount'+room+'"  name="addmedicn['+room+'][amount]"  value="" placeholder="No of days"></div></div><div class="col-sm-1 nopadding"><div class="input-group-btn"><button class="btn btn-danger" type="button" onclick="remove_education_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true">-</span> </button>  </div></div></div>';
    
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
						if(data.msg==1){
						$('#internal_code').empty();
						$('#internal_code').append("<option value=''>select </option>");                      

						for(i=0; i<data.text.length; i++) {
						$('#internal_code').append("<option value="+data.text[i].id+">"+data.text[i].type_name+"</option>");                      
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
						type: 'Lab',
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
						$('#lab_test_type_list').append("<tr id=td_id"+data.text[i].PLid+"><td>"+data.text[i].t_name+"</td><td>"+data.text[i].type_name+"</td><td>"+data.text[i].amuont+"</td><td>"+data.text[i].duration+"</td><td>"+data.text[i].t_short_form+"</td><td>"+data.text[i].t_description+"</td><td>"+data.text[i].t_department+"</td><td><a onclick='remove_patient_lab_test("+data.text[i].PLid+");'>Remove</a></td></tr>");                      

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
	$('#add_medicines').bootstrapValidator({
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

   function removemedicine(id,qty,med_name){
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
