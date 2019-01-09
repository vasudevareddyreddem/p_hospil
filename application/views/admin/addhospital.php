<div class="page-content-wrapper">
<div class="page-content">
   <div class="page-bar">
      <div class="page-title-breadcrumb">
         <div class=" pull-left">
            <div class="page-title">Add Hospital</div>
         </div>
         <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="<?php echo base_url('hospital'); ?>">Hospital List</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Add Hospital</li>
         </ol>
      </div>
   </div>
   <div class="row">
      <div class="col-md-12 col-sm-12">
         <!-- Nav tabs -->
         <ul class="nav nav-tabs nav-justified x-scrool" >
            <li class="nav-item">
               <a class="nav-link <?php if(isset($tab) && $tab==1){ echo "in show active"; }?>" data-toggle="tab" href="#Credentials" role="tab">Hospital Credentials</a>
            </li>
            <li class="nav-item">
               <a class="nav-link <?php if(isset($tab) && $tab==2){ echo "in show active"; }?>" data-toggle="tab" href="#Representative" role="tab"> Hospital Representative details</a>
            </li>
            <li class="nav-item">
               <a class="nav-link <?php if(isset($tab) && $tab==3){ echo "in show active"; }?>" data-toggle="tab" href="#BasicDetails" role="tab">Hospital Basic Details</a>
            </li>
            <li class="nav-item">
               <a class="nav-link <?php if(isset($tab) && $tab==4){ echo "in show active"; }?>" data-toggle="tab" href="#HospitalFinancialDetails" role="tab">Hospital Financial Details</a>
            </li>
            <li class="nav-item">
               <a class="nav-link <?php if(isset($tab) && $tab==5){ echo "in show active"; }?>" data-toggle="tab" href="#OtherDetails" role="tab"> Hospital Other Details </a>
            </li>
         </ul>
         <!-- Tab panels -->
         <div class="tab-content card">
            <!--Panel 1-->
            <div class="tab-pane fade  <?php if(isset($tab) && $tab==1){ echo "in show active"; }?>" id="Credentials" role="tabpanel">
               <br>
               <div class="card-body" id="bar-parent">
                  <form action="<?php echo base_url('hospital/addpostone'); ?>" method="post" name="credentials" id="credentials" class="form-horizontal" enctype="multipart/form-data">
							<?php $csrf = array(
										'name' => $this->security->get_csrf_token_name(),
										'hash' => $this->security->get_csrf_hash()
								); ?>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							      <input type="hidden" id="hospital_id" name="hospital_id" value="<?php echo isset($hospital_id)?$hospital_id:'' ?>">
              
					<div class="row">
                        <div class="form-group col-md-6">
                           <label for="email">Hospital Contact Number</label>
                           <input type="text" id="hos_con_number" name="hos_con_number" autofocus="autofocus" value="<?php echo isset($hospital_details['hos_con_number'])?$hospital_details['hos_con_number']:''; ?>" class="form-control"  placeholder="Enter Contact No" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Email Id</label>
                           <input type="text" id="hos_email_id" name="hos_email_id" value="<?php echo isset($hospital_details['hos_email_id'])?$hospital_details['hos_email_id']:''; ?>"  class="form-control"  placeholder="Enter Email Id" >
                        </div>
						<?php //echo '<pre>';print_r($hospital_id);exit; ?>
						<?php if(isset($hospital_id) && $hospital_id !=''){ ?>
                       
						<?php }else{ ?>
							<div class="form-group col-md-6">
                           <label for="email">Password</label>
                           <input type="password" id="hos_password" name="hos_password" class="form-control"  placeholder="Enter Password" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Confirm Password</label>
                           <input type="password" id="hos_confirmpassword" name="hos_confirmpassword" class="form-control"  placeholder="Enter Confirm Password" >
                        </div>
						<?php }	?>
                     </div>
                     <div class="form-actions">
                        <div class="row">
                           <div class="offset-md-11 col-md-1">
                              <button type="submit" class="btn btn-info">Next</button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <!--/.Panel 1-->
            <!--Panel 2-->
            <div class="tab-pane fade <?php if(isset($tab) && $tab==2){ echo "in show active"; }?>" id="Representative" role="tabpanel">
               <br>
               <div class="card-body" id="bar-parent">
                  <form action="<?php echo base_url('hospital/addposttwo'); ?>" method="post" name="representative" id="representative" class="form-horizontal" enctype="multipart/form-data">
                      	<?php $csrf = array(
										'name' => $this->security->get_csrf_token_name(),
										'hash' => $this->security->get_csrf_hash()
								); ?>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
								<input type="hidden" id="hospital_id" name="hospital_id" value="<?php echo $hospital_id; ?>">
					 <div class="row">
                        <div class="form-group col-md-6">
                           <label for="email">Name of the Representative</label>
                           <input type="text" id="hos_representative" name="hos_representative" value="<?php echo isset($hospital_details['hos_representative'])?$hospital_details['hos_representative']:''; ?>" class="form-control" id="email" placeholder="Enter Name" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Hospital Representative Contact Number</label>
                           <div class="row">
                            
                              <div class="col-md-12 row">
                                 <div class="col-md-4">
                                    <select id="mob_country_code" name="mob_country_code" value="<?php echo isset($hospital_details['mob_country_code'])?$hospital_details['mob_country_code']:''; ?>" class="form-control">
                                       <option value="+91">+91</option>
                                    </select>
                                 </div>
                                 <div class="col-md-8">
                                    <input type="text" id="hos_rep_mobile" name="hos_rep_mobile" value="<?php echo isset($hospital_details['hos_rep_mobile'])?$hospital_details['hos_rep_mobile']:''; ?>" class="form-control"  placeholder="Enter Mobile no" >
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Email</label>
                           <input type="text" id="hos_rep_email" name="hos_rep_email" value="<?php echo isset($hospital_details['hos_rep_email'])?$hospital_details['hos_rep_email']:''; ?>" class="form-control"  placeholder="Enter email" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">National ID</label>
                           <input type="text" id="hos_rep_nationali_id" name="hos_rep_nationali_id" value="<?php echo isset($hospital_details['hos_rep_nationali_id'])?$hospital_details['hos_rep_nationali_id']:''; ?>" class="form-control"  placeholder="Aadhaar Id" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Address1</label>
                           <textarea type="textarea" id="hos_rep_add1" name="hos_rep_add1"  class="form-control"  placeholder="Enter Address" ><?php echo isset($hospital_details['hos_rep_add1'])?$hospital_details['hos_rep_add1']:''; ?></textarea>
                        </div>
                       
                        <div class="form-group col-md-6">
                           <label for="email">Pin code</label>
                           <div class="row">
                              <div class="col-md-6">
                                 <input type="text" id="hos_rep_zipcode" name="hos_rep_zipcode" value="<?php echo isset($hospital_details['hos_rep_zipcode'])?$hospital_details['hos_rep_zipcode']:''; ?>" class="form-control"  placeholder="Enter Pin code" >
                              </div>
                              <div class="col-md-6 row">
                                 <input type="text" id="hos_rep_city" name="hos_rep_city" value="<?php echo isset($hospital_details['hos_rep_city'])?$hospital_details['hos_rep_city']:''; ?>" class="form-control"  placeholder="Enter City" >
                              </div>
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Nationality</label>
                           <div class="row">
                              <div class="col-md-6">
							  <?php $states = array ('Andhra Pradesh' => 'Andhra Pradesh', 'Arunachal Pradesh' => 'Arunachal Pradesh', 'Assam' => 'Assam', 'Bihar' => 'Bihar', 'Chhattisgarh' => 'Chhattisgarh', 'Goa' => 'Goa', 'Gujarat' => 'Gujarat', 'Haryana' => 'Haryana', 'Himachal Pradesh' => 'Himachal Pradesh', 'Jammu & Kashmir' => 'Jammu & Kashmir', 'Jharkhand' => 'Jharkhand', 'Karnataka' => 'Karnataka', 'Kerala' => 'Kerala', 'Madhya Pradesh' => 'Madhya Pradesh', 'Maharashtra' => 'Maharashtra', 'Manipur' => 'Manipur', 'Meghalaya' => 'Meghalaya', 'Mizoram' => 'Mizoram', 'Nagaland' => 'Nagaland', 'Odisha' => 'Odisha', 'Punjab' => 'Punjab', 'Rajasthan' => 'Rajasthan', 'Sikkim' => 'Sikkim', 'Tamil Nadu' => 'Tamil Nadu', 'Telangana' => 'Telangana', 'Tripura' => 'Tripura', 'Uttarakhand' => 'Uttarakhand','Uttar Pradesh' => 'Uttar Pradesh', 'West Bengal' => 'West Bengal', 'Andaman & Nicobar' => 'Andaman & Nicobar', 'Chandigarh' => 'Chandigarh', 'Dadra and Nagar Haveli' => 'Dadra and Nagar Haveli', 'Daman & Diu' => 'Daman & Diu', 'Delhi' => 'Delhi', 'Lakshadweep' => 'Lakshadweep', 'Puducherry' => 'Puducherry'); ?>
								  <select class="form-control" required="required" name="hos_rep_state" id="hos_rep_state">
								  <option value = "">Select State</option>
									<?php foreach($states as $key=>$state):
											if($hospital_details['hos_rep_state'] == $state):
											$selected ='selected=selected';
											else : 
											$selected = '';
											endif;
										 ?>
										<option value = "<?php echo $state?>" <?php echo $selected;?> ><?php echo $state?></option>
									<?php endforeach; ?>
								  </select>  
                              </div>
                              <div class="col-md-6 row">
                                 <input type="text" id="hos_rep_country" name="hos_rep_country" value="<?php echo isset($hospital_details['hos_rep_country'])?$hospital_details['hos_rep_country']:''; ?>" class="form-control"  placeholder="Enter Country" >
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-actions">
                        <div class="row">
                           <div class="col-md-12">
                              <a href="<?php echo base_url('hospital/add/'.base64_encode(1).'/'.$hospital_id); ?>" class="btn btn-default ">Back</a>
                              <button type="submit" class="btn btn-info pull-right">Next</button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <!--/.Panel 2-->
            <!--Panel 3-->
            <div class="tab-pane fade <?php if(isset($tab) && $tab==3){ echo "in show active"; }?>" id="BasicDetails" role="tabpanel">
               <br>
               <div class="card-body" id="bar-parent">
                  <form action="<?php echo base_url('hospital/addpostthree'); ?>" method="post" name="basicdetails" id="basicdetails" class="form-horizontal" enctype="multipart/form-data">
                     <?php $csrf = array(
										'name' => $this->security->get_csrf_token_name(),
										'hash' => $this->security->get_csrf_hash()
								); ?>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
								<input type="hidden" id="hospital_id" name="hospital_id" value="<?php echo $hospital_id; ?>">

					 <div class="row">
                        <div class="form-group col-md-6">
                           <label for="email">Hospital Identification Number(HIN)</label>
                           <input type="text"  class="form-control" value="<?php echo base64_decode(htmlentities($hospital_id)); ?>"  readonly="true" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Name of the Hospital</label>
                           <input type="text" id="hos_bas_name" name="hos_bas_name" value="<?php echo isset($hospital_details['hos_bas_name'])?$hospital_details['hos_bas_name']:''; ?>" class="form-control" id="email" placeholder="Enter Name" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Hospital Contact Number</label>
                           <input type="text" id="hos_bas_contact" name="hos_bas_contact" value="<?php echo isset($hospital_details['hos_bas_contact'])?$hospital_details['hos_bas_contact']:''; ?>" class="form-control"  placeholder="Enter Contact no" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Email</label>
                           <input type="text" id="hos_bas_email" name="hos_bas_email" value="<?php echo isset($hospital_details['hos_bas_email'])?$hospital_details['hos_bas_email']:''; ?>" class="form-control"  placeholder="Enter email" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">National ID</label>
                           <input type="text" id="hos_bas_nationali_id" name="hos_bas_nationali_id" value="<?php echo isset($hospital_details['hos_bas_nationali_id'])?$hospital_details['hos_bas_nationali_id']:''; ?>" class="form-control"  placeholder="National ID" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Address1</label>
                           <textarea type="textarea" id="hos_bas_add1" name="hos_bas_add1"   class="form-control"  placeholder="Enter Address" ><?php echo isset($hospital_details['hos_bas_add1'])?$hospital_details['hos_bas_add1']:''; ?></textarea>
                        </div>
                      
                        <div class="form-group col-md-6">
                           <label for="email">Nationality</label>
                           <div class="row">
                              <div class="col-md-6">
                                 <input type="text" id="hos_bas_zipcode" name="hos_bas_zipcode" value="<?php echo isset($hospital_details['hos_bas_zipcode'])?$hospital_details['hos_bas_zipcode']:''; ?>" class="form-control"  placeholder="Enter Pin code" >
                              
							  </div>
                              <div class="col-md-6 row">
                                 <input type="text" id="hos_bas_city" name="hos_bas_city" value="<?php echo isset($hospital_details['hos_bas_city'])?$hospital_details['hos_bas_city']:''; ?>" class="form-control"  placeholder="Enter City" >
                              </div>
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">&nbsp;</label>
                           <div class="row">
                              <div class="col-md-6">
								  <?php $states = array ('Andhra Pradesh' => 'Andhra Pradesh', 'Arunachal Pradesh' => 'Arunachal Pradesh', 'Assam' => 'Assam', 'Bihar' => 'Bihar', 'Chhattisgarh' => 'Chhattisgarh', 'Goa' => 'Goa', 'Gujarat' => 'Gujarat', 'Haryana' => 'Haryana', 'Himachal Pradesh' => 'Himachal Pradesh', 'Jammu & Kashmir' => 'Jammu & Kashmir', 'Jharkhand' => 'Jharkhand', 'Karnataka' => 'Karnataka', 'Kerala' => 'Kerala', 'Madhya Pradesh' => 'Madhya Pradesh', 'Maharashtra' => 'Maharashtra', 'Manipur' => 'Manipur', 'Meghalaya' => 'Meghalaya', 'Mizoram' => 'Mizoram', 'Nagaland' => 'Nagaland', 'Odisha' => 'Odisha', 'Punjab' => 'Punjab', 'Rajasthan' => 'Rajasthan', 'Sikkim' => 'Sikkim', 'Tamil Nadu' => 'Tamil Nadu', 'Telangana' => 'Telangana', 'Tripura' => 'Tripura', 'Uttarakhand' => 'Uttarakhand','Uttar Pradesh' => 'Uttar Pradesh', 'West Bengal' => 'West Bengal', 'Andaman & Nicobar' => 'Andaman & Nicobar', 'Chandigarh' => 'Chandigarh', 'Dadra and Nagar Haveli' => 'Dadra and Nagar Haveli', 'Daman & Diu' => 'Daman & Diu', 'Delhi' => 'Delhi', 'Lakshadweep' => 'Lakshadweep', 'Puducherry' => 'Puducherry'); ?>

								<select class="form-control" required="required" name="hos_bas_state" id="hos_bas_state">
								  <option value = "">Select State</option>
									<?php foreach($states as $key=>$state):
											if($hospital_details['hos_bas_state'] == $state):
											$selected ='selected=selected';
											else : 
											$selected = '';
											endif;
										 ?>
										<option value = "<?php echo $state?>" <?php echo $selected;?> ><?php echo $state?></option>
									<?php endforeach; ?>
								  </select> 
							  </div>
                              <div class="col-md-6 row">
                                 <input type="text" id="hos_bas_country" name="hos_bas_country" value="<?php echo isset($hospital_details['hos_bas_country'])?$hospital_details['hos_bas_country']:''; ?>" class="form-control"  placeholder="Enter Country" >
                              </div>
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Upload Documents</label>
                           <div class="compose-editor">
                              <input type="file" id="hos_bas_document" name="hos_bas_document"class="default">
                           </div>
                        </div>
                     </div>
                     <div class="form-actions">
                        <div class="row">
                           <div class="col-md-12">
                              <a href="<?php echo base_url('hospital/add/'.base64_encode(2).'/'.$hospital_id); ?>" class="btn  btn-default">Back</a>
                              <button type="submit" class="btn  pull-right btn-info">Next</button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <!--/.Panel 3-->
            <!--Panel 4-->
            <div class="tab-pane fade <?php if(isset($tab) && $tab==4){ echo "in show active"; }?>" id="HospitalFinancialDetails" role="tabpanel">
               <br>
               <div class="card-body" id="bar-parent">
                   <form action="<?php echo base_url('hospital/addpostfour'); ?>" method="post" name="financial" id="financial" class="form-horizontal" enctype="multipart/form-data">
                     <?php $csrf = array(
										'name' => $this->security->get_csrf_token_name(),
										'hash' => $this->security->get_csrf_hash()
								); ?>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
								<input type="hidden" id="hospital_id" name="hospital_id" value="<?php echo $hospital_id; ?>">
  
					 <div class="row">
                        <div class="form-group col-md-6">
                           <label for="email">Hospital Bank Holder Name</label>
                           <input type="text" id="bank_holder_name" name="bank_holder_name" value="<?php echo isset($hospital_details['bank_holder_name'])?$hospital_details['bank_holder_name']:''; ?>" class="form-control" id="email" placeholder=" Hospital Bank Holder Name" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Hospital Bank Acc No</label>
                           <input type="text" id="bank_acc_no" name="bank_acc_no" value="<?php echo isset($hospital_details['bank_acc_no'])?$hospital_details['bank_acc_no']:''; ?>" class="form-control"  placeholder="Hospital Bank Acc No" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Hospital Bank Name</label>
                           <input type="text" id="bank_name" name="bank_name" value="<?php echo isset($hospital_details['bank_name'])?$hospital_details['bank_name']:''; ?>" class="form-control"  placeholder="Hospital Bank Name" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Hospital Bank IFSC Code</label>
                           <input type="text"  id="bank_ifsc" name="bank_ifsc" value="<?php echo isset($hospital_details['bank_ifsc'])?$hospital_details['bank_ifsc']:''; ?>" class="form-control"  placeholder="Hospital Bank IFSC Code" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Upload Documents</label>
                           <div class="compose-editor">
                              <input type="file" id="bank_documents" name="bank_documents" class="default">
                           </div>
                        </div>
                     </div>
                     <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                              <a href="<?php echo base_url('hospital/add/'.base64_encode(3).'/'.$hospital_id); ?>" class="btn btn-default ">Back</a>
                              <button type="submit" class="btn pull-right  btn-info">Next</button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <!--/.Panel4-->
            <!--Panel 5-->
            <div class="tab-pane fade <?php if(isset($tab) && $tab==5){ echo "in show active"; }?>" id="OtherDetails" role="tabpanel">
               <br>
               <div class="card-body" id="bar-parent">
                <form action="<?php echo base_url('hospital/addpostfive'); ?>" method="post" name="otherdetails" id="otherdetails" class="form-horizontal" enctype="multipart/form-data">
                     <?php $csrf = array(
										'name' => $this->security->get_csrf_token_name(),
										'hash' => $this->security->get_csrf_hash()
								); ?>
								<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
								<input type="hidden" id="hospital_id" name="hospital_id" value="<?php echo $hospital_id; ?>">
    
					 <div class="row">
                        <div class="form-group col-md-6">
                           <label for="email">Hospital KYC Details</label>
                           <input type="text" class="form-control"  value="<?php echo isset($hospital_details['kyc_doc1'])?$hospital_details['kyc_doc1']:''; ?>" id="kyc_doc1" name="kyc_doc1" placeholder="Document Name" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Upload </label>
                           <div class="compose-editor">
                              <input type="file" id="kyc_file1" name="kyc_file1" class="default" >
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Hospital KYC Details</label>
                           <input type="text"  id="kyc_doc2" name="kyc_doc2" value="<?php echo isset($hospital_details['kyc_doc2'])?$hospital_details['kyc_doc2']:''; ?>" class="form-control"  placeholder="Document Name" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Upload </label>
                           <div class="compose-editor">
                              <input type="file" id="kyc_file2" name="kyc_file2" class="default" >
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Hospital KYC Details</label>
                           <input type="text" id="kyc_doc3" name="kyc_doc3" value="<?php echo isset($hospital_details['kyc_doc3'])?$hospital_details['kyc_doc3']:''; ?>" class="form-control"  placeholder="Document Name" >
                        </div>
                        <div class="form-group col-md-6">
                           <label for="email">Upload </label>
                           <div class="compose-editor">
                              <input type="file" id="kyc_file3" name="kyc_file3" class="default" >
                           </div>
                        </div>
                     </div>
                     <div class="form-actions">
                        <div class="row">
                           <div class="offset-md-9 col-md-3">
                              <a href="<?php echo base_url('hospital/add/'.base64_encode(4).'/'.$hospital_id); ?>" class="btn btn-default">Back</a>
                              <button type="submit" class="btn btn-success">Submit</button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <!--/.Panel5-->
         </div>
      </div>
   </div>
</div>
<script>
$(document).ready(function() {
    $('#credentials').bootstrapValidator({
        
        fields: {
            
            hos_con_number: {
              validators: {
					 notEmpty: {
						message: 'Mobile Number is required'
					},
                    regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'Mobile Number must be 10 to 14 digits'
					}
                }
            },
			 hos_email_id: {
                validators: {
					notEmpty: {
						message: 'Email is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
					message: 'Please enter a valid email address. For example johndoe@domain.com.'
					}
				}
            },
			hos_password: {
                validators: {
					notEmpty: {
						message: 'Password is required'
					},
					stringLength: {
                        min: 6,
                        message: 'Password  must be at least 6 characters. '
                    },
					regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~'"\\|=^?$%*)(_+-]*$/,
					message: 'Password wont allow <>[]'
					}
				}
            },
           
            hos_confirmpassword: {
					 validators: {
						 notEmpty: {
						message: 'Confirm Password is required'
					},
					identical: {
						field: 'hos_password',
						message: 'Password and Confirm Password do not match'
					}
					}
				}
            }
        })
     
});$(document).ready(function() {
    $('#representative').bootstrapValidator({
        
        fields: {
            
            hos_representative: {
                 validators: {
					notEmpty: {
						message: 'Representative Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Representative Name can only consist of alphanumeric, space and dot'
					}
				}
            },
			 hos_rep_contact: {
                validators: {
					notEmpty: {
						message: 'Landline Number is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'Landline Number must be 10 to 14 digits'
					}
				
				}
            },hos_rep_mobile: {
                 validators: {
					notEmpty: {
						message: 'Contact Number is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'Contact Number must be 10 to 14 digits'
					}
				
				}
            },hos_rep_email: {
                validators: {
					notEmpty: {
						message: 'Email is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
					message: 'Please enter a valid email address. For example johndoe@domain.com.'
					}
				}
            },
			hos_rep_add1: {
                validators: {
					notEmpty: {
						message: 'Address1 is required'
					},
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address1 wont allow <> [] = % '
					}
                }
            },hos_rep_add2: {
                validators: {
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address2 wont allow <> [] = % '
					}
                }
            },hos_rep_zipcode: {
              validators: {
					notEmpty: {
						message: 'Pin code is required'
					},
					regexp: {
					regexp: /^[0-9]{5,7}$/,
					message: 'Pin code  must be  5 to 7 characters'
					}
				}
            },hos_rep_city: {
               validators: {
					notEmpty: {
						message: 'City is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'City can only consist of alphabets and Space'
					}
				
				}
            },hos_rep_state: {
                validators: {
					notEmpty: {
						message: 'State is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'State can only consist of alphabets and Space'
					}
				
				}
            },
			hos_rep_country: {
                validators: {
					notEmpty: {
						message: 'Country is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Country can only consist of alphabets and Space'
					}
				
				}
            }
            }
        })
     
});$(document).ready(function() {
    $('#basicdetails').bootstrapValidator({
        
        fields: {
            
            hos_bas_name: {
                 validators: {
					notEmpty: {
						message: 'Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Name can only consist of alphanumeric, space and dot'
					}
				}
            },
			 hos_bas_contact: {
                validators: {
					notEmpty: {
						message: 'Contact Number is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'Contact Number must be 10 to 14 digits'
					}
				
				}
            },hos_bas_email: {
                validators: {
					notEmpty: {
						message: 'Email is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
					message: 'Please enter a valid email address. For example johndoe@domain.com.'
					}
				}
            },hos_bas_nationali_id: {
                validators: {
					notEmpty: {
						message: 'National ID is required'
					},
					regexp: {
					regexp:  /^[0-9]{10,14}$/,
					message:'National ID must be 10 to 14 digits'
					}
				
				}
            },hos_bas_add1: {
                validators: {
					notEmpty: {
						message: 'Address1 is required'
					},
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address1 wont allow <> [] = % '
					}
                }
            },hos_bas_add2: {
                validators: {
                    regexp: {
					regexp:/^[ A-Za-z0-9_@.,/!;:}{@#&`~"\\|^?$*)(_+-]*$/,
					message:'Address2 wont allow <> [] = % '
					}
                }
            },hos_bas_zipcode: {
              validators: {
					notEmpty: {
						message: 'Pin code is required'
					},
					regexp: {
					regexp: /^[0-9]{5,7}$/,
					message: 'Pin code  must be  5 to 7 characters'
					}
				}
            },hos_bas_city: {
               validators: {
					notEmpty: {
						message: 'City is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'City can only consist of alphabets and Space'
					}
				
				}
            },hos_bas_state: {
                validators: {
					notEmpty: {
						message: 'State is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'State can only consist of alphabets and Space'
					}
				
				}
            },
			hos_bas_country: {
                validators: {
					notEmpty: {
						message: 'Country is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'Country can only consist of alphabets and Space'
					}
				
				}
            },
			hos_bas_document: {
                validators: {
					regexp: {
					regexp: "(.*?)\.(docx|doc|pdf|xlsx|xls)$",
					message: 'Uploaded file is not a valid. Only docx,doc,xlsx,pdf files are allowed'
					}
				}
            }
            }
        })
     
});$(document).ready(function() {
    $('#financial').bootstrapValidator({
        
        fields: {
            
            bank_holder_name: {
                 validators: {
					notEmpty: {
						message: 'Bank Holder Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'Bank Holder Name can only consist of alphabets and space'
					}
				}
            },
			 bank_acc_no: {
                validators: 
					{
					    notEmpty: 
						{
						    message: 'Bank Acc No is required'
					    },
						regexp: 
						{
					     regexp:  /^[0-9]{9,16}$/,
					     message:'Bank Acc No  must be 9 to 16 digits'
					    }
				}
            },bank_name: {
                validators: {
					notEmpty: {
						message: 'Bank Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z ]+$/,
					message: 'Bank Name can only consist  of alphabets and Space'
					}
				}
            },bank_ifsc: {
                validators: {
					notEmpty: {
						message: 'IFSC Code is required'
					},
					regexp: {
					 regexp: /^[A-Za-z0-9]{4}\d{7}$/,
					message: 'IFSC Code must be alphanumeric'
					}
				}
            },
			bank_documents: {
                validators: {
					regexp: {
					regexp: "(.*?)\.(docx|doc|pdf|xlsx|xls)$",
					message: 'Uploaded file is not a valid. Only docx,doc,xlsx,pdf files are allowed'
					}
				}
            }
            }
        })
     
});$(document).ready(function() {
    $('#other').bootstrapValidator({
        
        fields: {
            
            kyc_doc1: {
                 validators: {
					notEmpty: {
						message: 'Document Name is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Document Name can only consist of alphanumeric, space and dot'
					}
				}
            },
			 kyc_file1: {
                validators: {
					notEmpty: {
						message: 'File is required'
					},
					regexp: {
					regexp: "(.*?)\.(docx|doc|pdf|xlsx|xls)$",
					message: 'Uploaded file is not a valid. Only docx,doc,xlsx,pdf files are allowed'
					}
				}
            },kyc_doc2: {
                 validators: {
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Document Name can only consist of alphanumeric, space and dot'
					}
				}
            },
			 kyc_file2: {
                validators: {
					regexp: {
					regexp: "(.*?)\.(docx|doc|pdf|xlsx|xls)$",
					message: 'Uploaded file is not a valid. Only docx,doc,xlsx,pdf files are allowed'
					}
				}
            }, kyc_doc3: {
                 validators: {
					regexp: {
					regexp: /^[a-zA-Z0-9. ]+$/,
					message: 'Document Name can only consist of alphanumeric, space and dot'
					}
				}
            },
			 kyc_file3: {
                validators: {
					regexp: {
					regexp: "(.*?)\.(docx|doc|pdf|xlsx|xls)$",
					message: 'Uploaded file is not a valid. Only docx,doc,xlsx,pdf files are allowed'
					}
				}
            }
            }
        })
     
});
</script>
