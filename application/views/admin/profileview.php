<?php //echo '<pre>';print_r($admin_detail);exit; ?>

<div class="page-content-wrapper">
                <div class="page-content" >
						<div class="page-bar">
						  <div class="page-title-breadcrumb">
							 <div class=" pull-left">
								<div class="page-title">Profile Details</div>
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
									<a  href="<?php echo base_url('admin/edit/'.base64_encode($admin_detail['a_id'])); ?>">Edit</a>
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
														  <?php echo isset($admin_detail['a_name'])?$admin_detail['a_name']:''; ?>
														 </div>
													 </div>
													</div>
													<div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Email Address</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($admin_detail['a_email_id'])?$admin_detail['a_email_id']:''; ?>
														 </div>
													 </div>
													</div>
													<div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Mobile Number</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php echo isset($admin_detail['a_mobile'])?$admin_detail['a_mobile']:''; ?>
														 </div>
													 </div>
													</div>
													<div class="col-md-6">
													<div class="row">												  
														 <div class=" col-sm-6">
														 <strong>Photo</strong>
														 </div>
														<div class=" col-sm-6">
														  <?php if($admin_detail['a_profile_pic']!=''){ ?>
														  <img src="<?php echo base_url('assets/adminprofilepic/'.$admin_detail['a_profile_pic']); ?>" height="50px" width="50px">
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