<?php //echo '<pre>';print_r($lab_detils);exit; ?>

<div class="page-content-wrapper">
                <div class="page-content" >
						<div class="page-bar">
						  <div class="page-title-breadcrumb">
							 <div class=" pull-left">
								<div class="page-title"> <?php echo $lab_detils['resource_name'];?> Profile Details</div>
							 </div>
							 <ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								
								<li class="active">Profile Details</li>
							 </ol>
						  </div>
						</div>
					 <div class="row" style="margin-top:50px;">
                       
                        <div class="col-md-12 col-sm-12">
                            <div class="card  card-topline-yellow">
                                <div class="card-head">
                                    <header>View</header>
									<a  href="<?php echo base_url('admin/editoutsource/'.base64_encode($lab_detils['r_id'])); ?>">Edit</a>
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
														  <?php echo isset($lab_detils['resource_name'])?$lab_detils['resource_name']:''; ?>
														 </div>
													 </div>
													</div>
													<div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong> Mobile Number</strong>
														 </div>
														 <div class=" col-sm-6">
														  <?php echo isset($lab_detils['resource_mobile'])?$lab_detils['resource_mobile']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong> Address1</strong>
														 </div>
														 <div class=" col-sm-6">
														  <?php echo isset($lab_detils['resource_add1'])?$lab_detils['resource_add1']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong> Address2</strong>
														 </div>
														 <div class=" col-sm-6">
														  <?php echo isset($lab_detils['resource_add2'])?$lab_detils['resource_add2']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong> City</strong>
														 </div>
														 <div class=" col-sm-6">
														  <?php echo isset($lab_detils['resource_city'])?$lab_detils['resource_city']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong> State</strong>
														 </div>
														 <div class=" col-sm-6">
														  <?php echo isset($lab_detils['resource_state'])?$lab_detils['resource_state']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong> Zipcode</strong>
														 </div>
														 <div class=" col-sm-6">
														  <?php echo isset($lab_detils['resource_zipcode'])?$lab_detils['resource_zipcode']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>  Other Details</strong>
														 </div>
														 <div class=" col-sm-6">
														  <?php echo isset($lab_detils['resource_other_details'])?$lab_detils['resource_other_details']:''; ?>
														 </div>
													 </div>
													</div><div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>  Lab Contact Number</strong>
														 </div>
														 <div class=" col-sm-6">
														  <?php echo isset($lab_detils['resource_contatnumber'])?$lab_detils['resource_contatnumber']:''; ?>
														 </div>
													 </div>
													</div>
													<div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Email Address</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($lab_detils['resource_email'])?$lab_detils['resource_email']:''; ?>
														 </div>
													 </div>
													</div>
													
													<div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong> Lab Photo</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php if($lab_detils['resource_photo']!=''){ ?>
														  <img src="<?php echo base_url('assets/adminprofilepic/'.$lab_detils['resource_photo']); ?>" height="50px" width="50px">
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