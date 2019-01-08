<?php //echo '<pre>';print_r($resouse_detail);exit; ?>

<div class="page-content-wrapper">
                <div class="page-content" >
						<div class="page-bar">
						  <div class="page-title-breadcrumb">
							 <div class=" pull-left">
								<div class="page-title">View Profile Details</div>
							 </div>
							 <ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li class="active">View Profile Details</li>
							 </ol>
						  </div>
						</div>
						  
					 <div class="row" style="margin-top:50px;">
                       
                        <div class="col-md-12 col-sm-12">
                            <div class="card  card-topline-yellow">
                                <div class="card-head">
                                    <header>View</header>
									<a  href="<?php echo base_url('hospital/resourceedit/'.base64_encode($resouse_detail['r_id'])); ?>">Edit</a>
                                </div>
                                <div class="card-body ">
											 <div class="col-sm-12">
												 <div class="row">
												  <div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Name</strong>
														 </div>
														 <div class=" col-sm-6">
														  <?php echo isset($resouse_detail['resource_name'])?$resouse_detail['resource_name']:''; ?>
														 </div>
													 </div>
													</div>
													<div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Mobile Number</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($resouse_detail['resource_mobile'])?$resouse_detail['resource_mobile']:''; ?>
														 </div>
													 </div>
													</div>
													
													<div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Address1</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($resouse_detail['resource_add1'])?$resouse_detail['resource_add1']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Address2</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($resouse_detail['resource_add2'])?$resouse_detail['resource_add2']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>City</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($resouse_detail['resource_city'])?$resouse_detail['resource_city']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>State</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($resouse_detail['resource_state'])?$resouse_detail['resource_state']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong> Pin code</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($resouse_detail['resource_zipcode'])?$resouse_detail['resource_zipcode']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Other Details</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($resouse_detail['resource_other_details'])?$resouse_detail['resource_other_details']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Resource Contact Number</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($resouse_detail['resource_contatnumber'])?$resouse_detail['resource_contatnumber']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Resource Designation</strong>
														 </div>
														<div class=" col-sm-6">
														 <?php if($resouse_detail['role_id']==3){ echo "Receptionist";}else if($resouse_detail['role_id']==4){ echo "Pharmacy";}else if($resouse_detail['role_id']==5){ echo "lab coordinator";}else if($resouse_detail['role_id']==6){ echo "Doctor";} ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Resource Email ID</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($resouse_detail['resource_email'])?$resouse_detail['resource_email']:''; ?>
														 </div>
													 </div>
													</div>
													<div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong> Resource Photo</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php if($resouse_detail['resource_photo']!=''){ ?>
														  <img src="<?php echo base_url('assets/adminprofilepic/'.$resouse_detail['resource_photo']); ?>" height="50px" width="50px">
														  <?php } ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Resource Document</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php if($resouse_detail['resource_document']!=''){ ?>
														  <a href="<?php echo base_url('assets/resourse_doc/'.$resouse_detail['resource_document']); ?>">Download</a>
														  <?php } ?>
														 </div>
													 </div>
													</div>
													<div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Resource Bank Holder Name</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($resouse_detail['resource_bank_holdername'])?$resouse_detail['resource_bank_holdername']:''; ?>
														 </div>
													 </div>
													</div>
													<div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Resource Bank Acc Number</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($resouse_detail['resource_bank_accno'])?$resouse_detail['resource_bank_accno']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Resource Bank IFSC Code</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($resouse_detail['resource_ifsc_code'])?$resouse_detail['resource_ifsc_code']:''; ?>
														 </div>
													 </div>
													</div>
													<div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Resource Upload Any document</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php if($resouse_detail['resource_other_document']!=''){ ?>
														  <a href="<?php echo base_url('assets/resourse_doc/'.$resouse_detail['resource_other_document']); ?>">Download</a>
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