<div class="page-container">
 			<!-- start sidebar menu -->
 			<div class="sidebar-container">
 				<div class="sidemenu-container navbar-collapse collapse fixed-menu">
	                <div id="remove-scroll">
	                    <ul class="sidemenu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
	                        <li class="sidebar-toggler-wrapper hide">
	                            <div class="sidebar-toggler">
	                                <span></span>
	                            </div>
	                        </li>
	                       <li class="sidebar-user-panel">
	                            <div class="user-panel">
								<?php //echo '<pre>';print_r($userdetails);exit; ?>
	                                <div class="pull-left image">
										   <?php if($userdetails['role_id']==1 || $userdetails['role_id']==8){ ?>
												<?php if($userdetails['a_profile_pic']!=''){?>
														<img src="<?php echo base_url('assets/adminprofilepic/'.$userdetails['a_profile_pic']);?>" class="img-circle" alt="<?php echo htmlentities($userdetails['a_profile_pic']); ?>" />
														<?php }else{ ?>
														 <img src="<?php echo base_url();?>assets/vendor/img/dp.jpg" class="img-circle" alt="User Image" />
														<?php } ?>
										
											<?php }else if($userdetails['role_id']==2){ ?>
														<?php if($img['img']!=''){?>
															<img src="<?php echo base_url('assets/hospital_logos/'.$img['img']);?>" class="img-circle" alt="<?php echo htmlentities($img['img']); ?>" />
															<?php }else{ ?>
															 <img src="<?php echo base_url();?>assets/vendor/img/dp.jpg" class="img-circle" alt="User Image" />
															<?php } ?>
											<?php } else{ ?>
														<?php if($img['img']!=''){?>
															<img src="<?php echo base_url('assets/adminprofilepic/'.$img['img']);?>" class="img-circle" alt="<?php echo htmlentities($img['img']); ?>" />
														<?php }else{ ?>
															<img src="<?php echo base_url();?>assets/vendor/img/dp.jpg" class="img-circle" alt="User Image" />
														<?php } ?>
											<?php } ?>
	                                </div>
	                                <div class="pull-left info">
	                                    <p> <?php echo isset($userdetails['r_name'])?htmlentities($userdetails['r_name']):''; ?> </p>
	                                    <a href="#"><i class="fa fa-circle user-online"></i><span class="txtOnline"> Online</span></a>
	                                </div>
	                            </div>
	                        </li>
						<?php if($userdetails['role_id']==1){ ?>	
	                        <li class="nav-item start <?php if($this->uri->segment(1)=='dashboard'){ echo "active";} ?>">
	                            <a href="<?php echo base_url('dashboard');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title">Dashboard</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                           
	                        </li> 
						<li class="nav-item  <?php if($this->uri->segment(1)=='hospital'|| $this->uri->segment(2)=='add'){ echo "active";} ?>">
	                            <a  class="nav-link nav-toggle"> <i class="material-icons"> local_hospital</i>
	                                <span class="title">Hospital</span>  <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                            <ul class="sub-menu">
	                                <li class="nav-item  ">
	                                    <a href="<?php echo base_url('hospital'); ?>" class="nav-link "> <span class="title">View / Modify</span>
	                                    </a>
	                                </li>
	                                <li class="nav-item ">
	                                    <a href="<?php echo base_url('hospital/add/'.base64_encode(1)); ?>" class="nav-link "> <span class="title">Add New</span>
	                                    </a>
	                                </li>
	                                
	                            </ul>
	                        </li> 
							<!--<li class="nav-item start <?php if($this->uri->segment(2)=='logos'){ echo "active";} ?>">
	                            <a href="<?php echo base_url('admin/logos');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">list</i>
	                                <span class="title">Add Logos</span>
	                                <span class="selected"></span>
                                	<span class="arrow"></span>
	                            </a>
	                        </li> 
                            
                            <li class="nav-item start <?php if($this->uri->segment(2)=='couponcodes'){ echo "active";} ?>">
	                            <a href="<?php echo base_url('admin/couponcodes');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">list</i>
	                                <span class="title">Coupon Code</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li> -->
							 
							<li class="nav-item  <?php if($this->uri->segment(2)=='gropchat' || $this->uri->segment(2)=='outsourcelabgropchat' || $this->uri->segment(2)=='admin_softwareteam'){ echo "active";}else{'deactive';}?> ">
	                            <a  class="nav-link nav-toggle"> <i class="material-icons">email</i>
	                                <span class="title">Chat</span>  <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                            <ul class="sub-menu ">
	                               <li class="nav-item ">
	                                    <a href="<?php echo base_url('admin/gropchat'); ?>" class="nav-link "> <span class="title">Group of Hospital</span>
	                                    </a>
	                                </li>
									<li class="nav-item ">
	                                    <a href="<?php echo base_url('admin/outsourcelabgropchat'); ?>" class="nav-link "> <span class="title">Group of Out Source Lab</span>
	                                    </a>
	                                </li>
	                                <li class="nav-item ">
	                                    <a href="<?php echo base_url('chat/admin_softwareteam'); ?>" class="nav-link "> <span class="title">Software Team</span>
	                                    </a>
	                                </li>
	                            </ul>
	                        </li>
	                       
							
							<li class="nav-item <?php if($this->uri->segment(2)=='announcement'){ echo "active";} ?> ">
	                            <a  href="<?php echo base_url('admin/announcement'); ?>" class="nav-link "> <i class="material-icons">announcement</i>
	                                <span class="title">Release Announcement</span> <span class="arrow"></span>
	                            </a>
	                        </li>
							
							
							<!--<li class="nav-item <?php if($this->uri->segment(2)=='cardnumbers'){ echo "active";} ?> ">
	                            <a  href="<?php echo base_url('admin/cardnumbers'); ?>" class="nav-link "> <i class="material-icons">announcement</i>
	                                <span class="title">Card Numbers</span> <span class="arrow"></span>
	                            </a>
	                        </li>
							<li class="nav-item <?php if($this->uri->segment(2)=='cardnumber_distribute'){ echo "active";} ?> ">
	                            <a  href="<?php echo base_url('admin/cardnumber_distribute'); ?>" class="nav-link "> <i class="material-icons">assignment</i>
	                                <span class="title">Card Numbers Distribute</span> <span class="arrow"></span>
	                            </a>
	                        </li>
							<li class="nav-item  <?php if($this->uri->segment(2)=='index' || $this->uri->segment(2)=='notreceived_patientlist' || $this->uri->segment(2)=='patientlist'){ echo "active";} ?>">
	                            <a  href="<?php echo base_url('executive/index'); ?>" class="nav-link "> <i class="material-icons">assignment</i>
	                                <span class="title">Executive</span> <span class="arrow"></span>
	                            </a>
	                        </li>
							<li class="nav-item  <?php if($this->uri->segment(2)=='rejected_patient_list' && $this->uri->segment(1)=='admin' || $this->uri->segment(2)=='patientlist'){ echo "active";} ?>">
	                            <a  href="<?php echo base_url('admin/rejected_patient_list'); ?>" class="nav-link "> <i class="material-icons">assignment</i>
	                                <span class="title">Rejected Patient list</span> <span class="arrow"></span>
	                            </a>
	                        </li>-->
						
						
						<?php }else if($userdetails['role_id']==2){ ?>
						 <li class="nav-item start <?php if($this->uri->segment(1)=='dashboard'){ echo "active";} ?>">
	                            <a href="<?php echo base_url('dashboard');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title">Dashboard</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                           
	                        </li> 
							<li class="nav-item start  <?php if($this->uri->segment(2)=='patient_list'){ echo "active";} ?>">
									<a href="<?php echo base_url('hospital/patient_list');?>" class="nav-link nav-toggle">
										<i class="material-icons">person_add</i>
										<span class="title">Patient List</span>
										<span class="selected"></span>
										<span class="arrow "></span>
									</a>
								</li>
						  <li class="nav-item  start <?php if($this->uri->segment(1)=='profile' || $this->uri->segment(2)=='resource' || $this->uri->segment(2)=='adddoctor' || $this->uri->segment(2)=='addtreatment' || $this->uri->segment(2)=='addtreatment' || $this->uri->segment(2)=='treatment' || $this->uri->segment(2)=='addspecialist'){ echo "active";} ?>">
	                            <a  class="nav-link nav-toggle"> <i class="material-icons">local_hospital</i>
	                                <span class="title">Hospital</span>  <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                            <ul class="sub-menu">
	                                <li class="nav-item  <?php if($this->uri->segment(2)=='index'){ echo "active";} ?> ">
	                                    <a href="<?php echo base_url('profile'); ?>" class="nav-link "> <span class="title">Hospital Details</span>
	                                    </a>
	                                </li>
									 <li class="nav-item ">
	                                    <a href="<?php echo base_url('hospital/resource'); ?>" class="nav-link "> <span class="title">Add Resources </span>
	                                    </a>
	                                </li>
									<li class="nav-item ">
	                                    <a href="<?php echo base_url('hospital/adddoctor'); ?>" class="nav-link "> <span class="title">Add Doctor </span>
	                                    </a>
	                                </li>
	                                <li class="nav-item ">
	                                    <a href="<?php echo base_url('hospital/addtreatment'); ?>" class="nav-link "> <span class="title">Add Department</span>
	                                    </a>
	                                </li>
									<!--<li class="nav-item ">
	                                    <a href="<?php echo base_url('hospital/addspecialist'); ?>" class="nav-link "> <span class="title">Add Speciality</span>
	                                    </a>
	                                </li>-->
	                                
									<li class="nav-item ">
	                                    <a href="<?php echo base_url('hospital/treatment'); ?>" class="nav-link "> <span class="title">Assign Department to Consultant </span>
	                                    </a>
	                                </li>
									<!--<li class="nav-item ">
	                                    <a href="<?php echo base_url('hospital/labdetails'); ?>" class="nav-link "> <span class="title"> Lab Details </span>
	                                    </a>
	                                </li>-->
	                                
	                            </ul>
	                        </li> 
							
							
							<li class="nav-item start <?php if($this->uri->segment(2)=='oursource'){ echo "active";} ?>">
	                            <a href="<?php echo base_url('lab/oursource');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">track_changes</i>
	                                <span class="title">OutSource </span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li>
							<!--<li class="nav-item  start  <?php if($this->uri->segment(2)=='wardname' || $this->uri->segment(2)=='wardtype' || $this->uri->segment(2)=='roomtype' || $this->uri->segment(2)=='floornumber' || $this->uri->segment(2)=='roomnumber'){ echo "active";} ?>">
	                            <a  class="nav-link nav-toggle"> <i class="material-icons">local_hospital</i>
	                                <span class="title">Ward Details</span>  <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                            <ul class="sub-menu">
	                                <li class="nav-item  ">
	                                    <a href="<?php echo base_url('ward_management/wardname'); ?>" class="nav-link "> <span class="title">Ward Name</span>
	                                    </a>
	                                </li>
									 <li class="nav-item ">
	                                    <a href="<?php echo base_url('ward_management/wardtype'); ?>" class="nav-link "> <span class="title">Ward Type</span>
	                                    </a>
	                                </li>
									 <li class="nav-item  ">
	                                    <a href="<?php echo base_url('ward_management/roomtype'); ?>" class="nav-link "> <span class="title">Room Type</span>
	                                    </a>
	                                </li>
									 <li class="nav-item  ">
	                                    <a href="<?php echo base_url('ward_management/floornumber'); ?>" class="nav-link "> <span class="title">Floor Number</span>
	                                    </a>
	                                </li>
	                                 <li class="nav-item  ">
	                                    <a href="<?php echo base_url('ward_management/roomnumber'); ?>" class="nav-link "> <span class="title">Room Number</span>
	                                    </a>
	                                </li>
							
	                            </ul>
	                        </li> -->
							
							
							
							<li class="nav-item <?php if($this->uri->segment(2)=='resourceschat' || $this->uri->segment(2)=='adminchat' || $this->uri->segment(2)=='admin_softwareteam'){ echo "active";} ?>">
	                            <a  class="nav-link nav-toggle"> <i class="material-icons">email</i>
	                                <span class="title">Chat</span>  <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                            <ul class="sub-menu">
	                                <li class="nav-item  ">
	                                    <a href="<?php echo base_url('admin/resourceschat'); ?>" class="nav-link "> <span class="title">Resources </span>
	                                    </a>
	                                </li>
	                                <li class="nav-item ">
	                                    <a href="<?php echo base_url('admin/adminchat'); ?>" class="nav-link "> <span class="title">Admin Chat</span>
	                                    </a>
	                                </li>
	                                <li class="nav-item ">
	                                    <a href="<?php echo base_url('chat/admin_softwareteam'); ?>" class="nav-link "> <span class="title">Software Team</span>
	                                    </a>
	                                </li>
	                            </ul>
	                        </li>
							<li class="nav-item  <?php if($this->uri->segment(2)=='announcement'){ echo "active";} ?> ">
	                            <a  href="<?php echo base_url('hospital/announcement'); ?>" class="nav-link "> <i class="material-icons">announcement</i>
	                                <span class="title">Release Announcement</span> <span class="arrow"></span>
	                            </a>
	                        </li>
							<li class="nav-item">
								  <a  href="<?php echo base_url('hospital/reports'); ?>" class="nav-link "> <i class="material-icons">announcement</i>
	                                <span class="title">Report</span> 
	                            </a>
							</li>
							
						<?php } else if($userdetails['role_id']==3){ ?>
						 
						 <li class="nav-item start <?php if($this->uri->segment(2)=='desk'){ echo "active";} ?> ">
	                            <a href="<?php echo base_url('resources/desk');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">assignment</i>
	                                <span class="title">Front desk</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                           
	                        </li>   
							<li class="nav-item start <?php if($this->uri->segment(1)=='appointments'){ echo "active";} ?> ">
	                            <a href="<?php echo base_url('appointments');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">assignment</i>
	                                <span class="title">Appointments</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                           
	                        </li>  
							<li class="nav-item start <?php if($this->uri->segment(2)=='vitals'){ echo "active";} ?> ">
	                            <a href="<?php echo base_url('resources/vitals');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">sd_storage</i>
	                                <span class="title">Vitals</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                           
	                        </li> 
							<li class="nav-item start <?php if($this->uri->segment(2)=='patient_databse'){ echo "active";} ?> ">
	                            <a href="<?php echo base_url('resources/patient_databse');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">sd_storage</i>
	                                <span class="title">Patient Registration Database </span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                           
	                        </li> 
                           <!-- <li class="nav-item start <?php if($this->uri->segment(1)=='billing'){ echo "active";} ?> ">
	                            <a href="<?php echo base_url('billing/index');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">sd_storage</i>
	                                <span class="title">Billing </span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                           
	                        </li> -->
							<li class="nav-item start <?php if($this->uri->segment(1)=='chat'){ echo "active";} ?> ">
	                            <a href="<?php echo base_url('chat');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">email</i>
	                                <span class="title">Chat </span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                           
	                        </li> 
							
						<?php } else if($userdetails['role_id']==4){ ?>
						 
							<li class="nav-item start <?php if($this->uri->segment(1)=='users' && $this->uri->segment(2)=='' ){ echo "active";} ?>">
	                            <a href="<?php echo base_url('users');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title">Prescription</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li>
							<li class="nav-item start <?php if($this->uri->segment(2)=='addprescription' || $this->uri->segment(2)=='view_manualprescription'){ echo "active";} ?>">
	                            <a href="<?php echo base_url('users/addprescription');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title">Add Prescription</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li>
							<li class="nav-item start <?php if($this->uri->segment(2)=='completedprescription' ||  $this->uri->segment(2)=='viewprescription'){ echo "active";} ?>">
	                            <a href="<?php echo base_url('users/completedprescription');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title">Completed Prescription</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li> 
							
						 <li class="nav-item start <?php if($this->uri->segment(1)=='medicine' && $this->uri->segment(2)=='' ){ echo "active";} ?>">
	                            <a href="<?php echo base_url('medicine');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title">Upload medicine</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li>
							<li class="nav-item start <?php if($this->uri->segment(1)=='medicine' && $this->uri->segment(2)=='lists' ){ echo "active";} ?>">
	                            <a href="<?php echo base_url('medicine/lists');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title">Medicine List</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li>
							  <li class="nav-item start <?php if($this->uri->segment(1)=='chat' ){ echo "active";} ?>">
	                            <a href="<?php echo base_url('chat');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">email</i>
	                                <span class="title">Chat</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li> 
						<?php } else if($userdetails['role_id']==5){ ?>
					
								<?php if($userdetails['out_source']==1){ ?>	
										<li class="nav-item start <?php if($this->uri->segment(2)=='patient_list'){ echo "active";} ?>">
											<a href="<?php echo base_url('lab/outsources_labtests');?>" class="nav-link nav-toggle">
												<i class="material-icons">person_add</i>
												<span class="title">Patient List</span>
												<span class="selected"></span>
												<span class="arrow "></span>
											</a>
										</li> 
										<li class="nav-item start <?php if($this->uri->segment(2)=='bidding_list'){ echo "active";} ?>">
											<a href="<?php echo base_url('lab/bidding_list');?>" class="nav-link nav-toggle">
												<i class="material-icons">dashboard</i>
												<span class="title">Procurement Lab Test List</span>
												<span class="selected"></span>
												
											</a>
										</li> 
										<li class="nav-item start <?php if($this->uri->segment(2)=='patient_database'){ echo "active";} ?>">
											<a href="<?php echo base_url('lab/patient_database');?>" class="nav-link nav-toggle">
												<i class="material-icons">dashboard</i>
												<span class="title">Patient Database</span>
												<span class="selected"></span>
												<span class="arrow "></span>
											</a>
										</li>
										<li class="nav-item start <?php if($this->uri->segment(1)=='lab' && $this->uri->segment(2)=='' ){ echo "active";} ?>">
									<a href="<?php echo base_url('lab');?>" class="nav-link nav-toggle">
										<i class="material-icons">format_color_fill</i>
										<span class="title">Lab Test Details</span>
										<span class="selected"></span>
										<span class="arrow "></span>
									</a>
								</li>
										<li class="nav-item start <?php if($this->uri->segment(2)=='adminchat' || $this->uri->segment(2)=='admin_softwareteam'){ echo "active";}else{'deactive';}?>">
	                            <a  class="nav-link nav-toggle"> <i class="material-icons">email</i>
	                                <span class="title">Chat</span>
                                       <span class="selected"></span>									
                                	<span class="arrow "></span>
	                            </a>
	                            <ul class="sub-menu">
	                               <li class="nav-item ">
	                                    <a href="<?php echo base_url('admin/adminchat'); ?>" class="nav-link "> <span class="title">Admin Chat</span>
	                                    </a>
	                                </li>
	                                <li class="nav-item ">
	                                    <a href="<?php echo base_url('chat/admin_softwareteam'); ?>" class="nav-link "> <span class="title">Software Team</span>
	                                    </a>
	                                </li>
	                            </ul>
	                        </li>
								<?php  }else{ ?>
								<li class="nav-item start <?php if($this->uri->segment(2)=='patient_list'){ echo "active";} ?>">
									<a href="<?php echo base_url('lab/patient_list');?>" class="nav-link nav-toggle">
										<i class="material-icons">person_add</i>
										<span class="title">Patient List</span>
										<span class="selected"></span>
										<span class="arrow "></span>
									</a>
								</li>
								<li class="nav-item start <?php if($this->uri->segment(1)=='lab' && $this->uri->segment(2)=='' ){ echo "active";} ?>">
									<a href="<?php echo base_url('lab');?>" class="nav-link nav-toggle">
										<i class="material-icons">format_color_fill</i>
										<span class="title">Lab Test Details</span>
										<span class="selected"></span>
										<span class="arrow "></span>
									</a>
								</li>
								<li class="nav-item start <?php if($this->uri->segment(2)=='outsources_labtests'){ echo "active";} ?>">
									<a href="<?php echo base_url('lab/outsources_labtests');?>" class="nav-link nav-toggle">
										<i class="material-icons">details</i>
										<span class="title">Out Source Lab Test Details</span>
										<span class="selected"></span>
										<span class="arrow "></span>
									</a>
								</li> 
								<li class="nav-item start <?php if($this->uri->segment(2)=='bidding_list'){ echo "active";} ?>">
									<a href="<?php echo base_url('lab/bidding_list');?>" class="nav-link nav-toggle">
										<i class="material-icons">format_list_numbered</i>
										<span class="title">Procurement Lab Test List</span>
										<span class="selected"></span>
										
									</a>
								</li> 
							<li class="nav-item start <?php if($this->uri->segment(2)=='patient_database'){ echo "active";} ?> ">
	                            <a href="<?php echo base_url('lab/patient_database');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">sd_storage</i>
	                                <span class="title">Patient Database</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li>
									<li class="nav-item start <?php if($this->uri->segment(1)=='chat' && $this->uri->segment(2)=='' ){ echo "active";} ?>">
										<a href="<?php echo base_url('chat');?>" class="nav-link nav-toggle">
											<i class="material-icons">email</i>
											<span class="title">Chat</span>
											<span class="selected"></span>
											<span class="arrow "></span>
										</a>
									</li>
							
							<?php }?>
						
						<?php } else if($userdetails['role_id']==6){ ?>	
							
							<li class="nav-item start <?php if($this->uri->segment(2)=='worksheet'){ echo "active";} ?>">
	                            <a href="<?php echo base_url('resources/worksheet');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">description</i>
	                                <span class="title">My WorkSheet</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li>
							<li class="nav-item start <?php if($this->uri->segment(2)=='completed_worksheet'){ echo "active";} ?>">
	                            <a href="<?php echo base_url('resources/completed_worksheet');?>" class="nav-link nav-toggle">
	                                <i class="material-icons"> done_all</i>
	                                <span class="title">Completed WorkSheet</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li>
							<!--<li class="nav-item start <?php if($this->uri->segment(2)=='worksheet'){ echo "active";} ?>">
	                            <a href="<?php echo base_url('resources/worksheet');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">assignment</i>
	                                <span class="title">Appointments</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li>-->
							<li class="nav-item start <?php if($this->uri->segment(2)=='referrals'){ echo "active";} ?>">
	                            <a href="<?php echo base_url('resources/referrals');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">border_all</i>
	                                <span class="title">Referrals </span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li> 
							<li class="nav-item start <?php if($this->uri->segment(1)=='chat' && $this->uri->segment(2)=='' ){ echo "active";} ?>">
	                            <a href="<?php echo base_url('chat');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">email</i>
	                                <span class="title">Chat</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li> 							
						<?php } else if($userdetails['role_id']==8){ ?>
						<li class="nav-item start ">
	                            <a href="<?php echo base_url('admin/chat');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">email</i>
	                                <span class="title">Chat</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li>
							<li class="nav-item start ">
	                            <a href="<?php echo base_url('admin/notification');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">notifications</i>
	                                <span class="title">Notification</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li>
							<li class="nav-item start ">
	                            <a href="<?php echo base_url('admin/notificationlist');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">notifications</i>
	                                <span class="title">Sent Notification List</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li> 
							<?php } else if($userdetails['role_id']==9){ ?>
							<!--ward management-->
							<li class="nav-item start ">
	                            <a href="<?php echo base_url('dashboard');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title">Dashboard</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li>
							<li class="nav-item start ">
	                            <a href="<?php echo base_url('ward_management/admit');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">assignment</i>
	                                <span class="title">Admit</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li>
							<li class="nav-item start ">
	                            <a href="<?php echo base_url('ward_management/discharge');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">assignment</i>
	                                <span class="title">Discharge</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li>
							<li class="nav-item start ">
	                            <a href="<?php echo base_url('ward_management/transfer');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">assignment</i>
	                                <span class="title">Transfer Patient</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li>
							<li class="nav-item start ">
	                            <a href="<?php echo base_url('ward_management/bed_chart');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">assignment</i>
	                                <span class="title">Bed Chart</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li>	
							<li class="nav-item start ">
	                            <a href="<?php echo base_url('ward_management/observation');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">assignment</i>
	                                <span class="title">Observation/ Nursing </span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li>
						
							<li class="nav-item start ">
	                            <a href="<?php echo base_url('ward_management/patient_history');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">assignment</i>
	                                <span class="title">Patient History</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li>	
							<!--<li class="nav-item start ">
	                            <a href="<?php echo base_url('ward_management/discharge_report');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">assignment</i>
	                                <span class="title">Discharge Report</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li>-->
							<!--ward management-->
							<!--nurse-->
							<?php } else if($userdetails['role_id']==10){ ?>
							<!--<li class="nav-item start ">
	                            <a href="<?php echo base_url('nurse');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">notifications</i>
	                                <span class="title">Nurse</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li>-->
							<li class="nav-item start ">
	                            <a href="<?php echo base_url('nurse/patient_follow_ups');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">notifications</i>
	                                <span class="title">Patient Follow Ups</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li>
							<li class="nav-item start ">
	                            <a href="<?php echo base_url('nurse/bed_transfer');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">notifications</i>
	                                <span class="title">Bed Transfer</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li>
                            <li class="nav-item start ">
	                            <a href="<?php echo base_url('nurse/patient_discharge');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">notifications</i>
	                                <span class="title">Patient Discharge</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li>
                            <li class="nav-item start ">
	                            <a href="<?php echo base_url('nurse/reports');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">notifications</i>
	                                <span class="title">Reports</span>
	                                <span class="selected"></span>
                                	<span class="arrow "></span>
	                            </a>
	                        </li>
							<?php } ?>
							<li class="nav-item  ">
	                            <a  href="<?php echo base_url('dashboard/logout'); ?>" class="nav-link "> <i class="material-icons"> power_settings_new</i>
	                                <span class="title">Logout</span> <span class="arrow"></span>
	                            </a>
	                        </li>
	                        
	                            </ul>
	                        </li>
	                    </ul>
	                </div>
                </div>
            </div>
            <!-- end sidebar menu --> 
			
			