<?php //echo '<pre>';print_r($hospital_details);exit; ?>

<div class="page-content-wrapper">
                <div class="page-content" >
						<div class="page-bar">
			  <div class="page-title-breadcrumb">
				 <div class=" pull-left">
					<div class="page-title">View Hospital Details</div>
				 </div>
				 <?php if($userdetails['role_id']==1){ ?>
				 <ol class="breadcrumb page-breadcrumb pull-right">
					<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
					</li>
					<li><a class="parent-item" href="<?php echo base_url('hospital'); ?>">Hospital List</a>&nbsp;<i class="fa fa-angle-right"></i>
					</li>
					<li class="active"><?php echo isset($hospital_details['hos_bas_name'])?$hospital_details['hos_bas_name']:''; ?></li>
				 </ol>
				 	<?php }else if($userdetails['role_id']==2){  ?>
					<ol class="breadcrumb page-breadcrumb pull-right">
						<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
						</li>
						<li class="active">Profile</li>
					</ol>
				<?php } ?>
			  </div>
		   </div>
		     
					 <div class="row" style="margin-top:50px;">
                       
                        <div class="col-md-12 col-sm-12">
                            <div class="card  card-topline-yellow">
                                <div class="card-head">
                                    <header>View</header>
									<?php if($userdetails['role_id']==1){ ?>
									<a  href="<?php echo base_url('hospital'); ?>">Back</a>&nbsp; | &nbsp; 
									<a  href="<?php echo base_url('hospital/edit/'.base64_encode($hospital_details['hos_id'])); ?>">Edit</a>
									<?php }else{ ?>
									<a  href="<?php echo base_url('hospital/edit/'.base64_encode($hospital_details['hos_id'])); ?>">Edit</a>

									<?php } ?>
                                </div>
                                <div class="card-body ">
											 <div class="col-sm-12">
												 <div class="row">
												  <div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Hospital Contact Number</strong>
														 </div>
														 <div class=" col-sm-6">
														  <?php echo isset($hospital_details['hos_con_number'])?$hospital_details['hos_con_number']:''; ?>
														 </div>
													 </div>
													</div>
													<div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Hospital Email Id</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['hos_email_id'])?$hospital_details['hos_email_id']:''; ?>
														 </div>
													 </div>
													</div>
													
													<div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Name of the Representative</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['hos_representative'])?$hospital_details['hos_representative']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Hospital Representative Landline Number</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['hos_rep_contact'])?$hospital_details['hos_rep_contact']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Hospital Representative Mobile Number</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['hos_rep_mobile'])?$hospital_details['hos_rep_mobile']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Email</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['hos_rep_email'])?$hospital_details['hos_rep_email']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>National ID</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['hos_rep_nationali_id'])?$hospital_details['hos_rep_nationali_id']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Address1</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['hos_rep_add1'])?$hospital_details['hos_rep_add1']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Address2</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['hos_rep_add2'])?$hospital_details['hos_rep_add2']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Pincode</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['hos_rep_zipcode'])?$hospital_details['hos_rep_zipcode']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>City</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['hos_rep_city'])?$hospital_details['hos_rep_city']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>State</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['hos_rep_state'])?$hospital_details['hos_rep_state']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Country</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['hos_rep_country'])?$hospital_details['hos_rep_country']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Name of the Hospital</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['hos_bas_name'])?$hospital_details['hos_bas_name']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Hospital Contact Number</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['hos_bas_contact'])?$hospital_details['hos_bas_contact']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Email</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['hos_bas_email'])?$hospital_details['hos_bas_email']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>National ID</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['hos_bas_nationali_id'])?$hospital_details['hos_bas_nationali_id']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Address1</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['hos_bas_add1'])?$hospital_details['hos_bas_add1']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Address2</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['hos_bas_add2'])?$hospital_details['hos_bas_add2']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Zipcode</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['hos_bas_zipcode'])?$hospital_details['hos_bas_zipcode']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>City</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['hos_bas_city'])?$hospital_details['hos_bas_city']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>State</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['hos_bas_state'])?$hospital_details['hos_bas_state']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Country</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['hos_bas_country'])?$hospital_details['hos_bas_country']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Upload Documents</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php if($hospital_details['hos_bas_country']!=''){ ?>
														  <a href="<?php echo base_url('assets/hospital_basic_documents/'.$hospital_details['hos_bas_country']); ?>">Download</a>
														  <?php } ?>
														 </div>
													 </div>
													 <div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Logo</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php if($hospital_details['hos_bas_logo']!=''){ ?>
														  <img width="50px" height="50px" src="<?php echo base_url('assets/hospital_logos/'.$hospital_details['hos_bas_logo']); ?>">
														  <?php } ?>
														 </div>
													 </div>
													</div>
													<div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Hospital Bank Holder Name</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['bank_holder_name'])?$hospital_details['bank_holder_name']:''; ?>
														 </div>
													 </div>
													</div>
													<div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Hospital Bank Acc No</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['bank_acc_no'])?$hospital_details['bank_acc_no']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Hospital Bank Name</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['bank_name'])?$hospital_details['bank_name']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Hospital Bank IFSC Code</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['bank_ifsc'])?$hospital_details['bank_ifsc']:''; ?>
														 </div>
													 </div>
													</div>
													<div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Upload Documents</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php if($hospital_details['bank_document']!=''){ ?>
														  <a href="<?php echo base_url('assets/bank_documents/'.$hospital_details['bank_document']); ?>">Download</a>
														  <?php } ?>
														 </div>
													 </div>
													</div>
													<div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Hospital KYC Details</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['kyc_doc1'])?$hospital_details['kyc_doc1']:''; ?>
														 </div>
													 </div>
													</div>
													<div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Upload Documents</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php if($hospital_details['kyc_file1']!=''){ ?>
														  <a href="<?php echo base_url('assets/kyc_documents/'.$hospital_details['kyc_file1']); ?>">Download</a>
														  <?php } ?>
														 </div>
													 </div>
													</div>
													<div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Hospital KYC Details</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['kyc_doc2'])?$hospital_details['kyc_doc2']:''; ?>
														 </div>
													 </div>
													</div>
													<div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Upload Documents</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php if($hospital_details['kyc_file2']!=''){ ?>
														  <a href="<?php echo base_url('assets/kyc_documents/'.$hospital_details['kyc_file2']); ?>">Download</a>
														  <?php } ?>
														 </div>
													 </div>
													</div>
													<div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Hospital KYC Details</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($hospital_details['kyc_doc3'])?$hospital_details['kyc_doc3']:''; ?>
														 </div>
													 </div>
													</div>
													<div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Upload Documents</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php if($hospital_details['kyc_file3']!=''){ ?>
														  <a href="<?php echo base_url('assets/kyc_documents/'.$hospital_details['kyc_file3']); ?>">Download</a>
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
                    </div>
                    </div>