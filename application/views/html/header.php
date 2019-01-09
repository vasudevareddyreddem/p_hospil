
<?php //echo '<pre>';print_r($Unread_count);exit; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta http-equiv="X-UA-Compatible" content="IE=8">

 
    <title>Hospital</title>
    <!-- google font -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
	<!-- icons -->
    <link href="<?php echo base_url(); ?>assets/vendor/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/vendor/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<!--bootstrap -->
    <link href="<?php echo base_url(); ?>assets/vendor/plugins/tether/css/tether.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/vendor/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/vendor/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Include SmartWizard CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/plugins/wizard/css/smart_wizard.css" rel="stylesheet" type="text/css" />
    <!-- Material Design Lite CSS -->
	<link href="<?php echo base_url(); ?>assets/vendor/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
	 
	 <link href="<?php echo base_url(); ?>assets/vendor/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
	<link rel="<?php echo base_url(); ?>assets/vendor/stylesheet" href="plugins/material/material.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/css/material_style.css">
	<!-- Theme Styles -->
    <link href="<?php echo base_url(); ?>assets/vendor/css/theme_style.css" rel="stylesheet" id="rt_style_components" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/vendor/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/vendor/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/vendor/css/custom.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="assets/vendor/css/all-ie-only.css" />
    <link href="<?php echo base_url(); ?>assets/vendor/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/vendor/css/theme-color.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/vendor/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/vendor/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
	  <script src="<?php echo base_url(); ?>assets/vendor/plugins/jquery.min.js" ></script>
	  
 </head>
 <!-- END HEAD -->
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-indigo white-sidebar-color logo-indigo">
    <div class="page-wrapper">
        <!-- start header -->
        <div class="page-header navbar navbar-fixed-top">
            <div class="page-header-inner ">
                <!-- logo start -->
                <div class="page-logo">
                    <a href="<?php echo base_url('dashboard'); ?>">
                    
                    <span class="logo-default" ><img style="width:180px;height:auto;" class="img-responsive" src="<?php echo base_url(); ?>assets/vendor/img/logo.png" alt="logo"> </span> </a>
                </div>
                <!-- logo end -->
				<ul class="nav navbar-nav navbar-left in">
					<li><a href="#" class="menu-toggler sidebar-toggler"><i class="icon-menu"></i></a></li>
				</ul>
                 <!--<form class="search-form-opened" action="#" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search..." name="query">
                        <span class="input-group-btn">
                          <a href="javascript:;" class="btn submit">
                             <i class="icon-magnifier"></i>
                           </a>
                        </span>
                    </div>
                </form>-->
                <!-- start mobile menu -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                    <span></span>
                </a>
               <!-- end mobile menu -->
                <!-- start header menu -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                    	<!-- start language menu -->
                       
                        <!-- end language menu -->
                        <!-- start notification dropdown -->
						<?php if($userdetails['role_id']==2 || $userdetails['role_id']==3 || $userdetails['role_id']==4 || $userdetails['role_id']==5 || $userdetails['role_id']==6){ ?>
						<?php if(isset($notification) && count($notification)>0){ ?>
                        <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="fa fa-bell-o"></i>
								<span id="count_symbole">
								<?php if($Unread_count !=''){  ?>
                                <span id="" class="badge headerBadgeColor1"> <span id="notification_count1"><?php echo $Unread_count; ?></span></span>
								<?php } ?>
								</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    <h3><span class="bold">Notifications</span></h3>
                                    <span class="notification-label purple-bgcolor">New <span id="notification_count"><?php echo $Unread_count; ?></span></span>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
                                        <?php $cnt=1;foreach($notification as $List){ ?>
										<?php if($cnt<=5){ ?>
										<li>
                                            <?php if($userdetails['role_id']==2){ ?>
											<a onclick="opennotification('<?php echo $List['int_id']; ?>')" data-toggle="modal" data-target="#exampleModalLong" >
                                            <?php }else{ ?>
											<a onclick="resourceopennotification('<?php echo $List['int_id']; ?>')" data-toggle="modal" data-target="#exampleModalLong" >
											<?php } ?>
												<span class="time"><?php echo date('M j h:i A',strtotime(htmlentities($List['create_at'])));?></span>
                                                <span class="details">
                                                <span class="notification-icon circle deepPink-bgcolor"><i class="fa fa-check"></i></span><?php echo ucfirst(substr($List['comment'], 0, 20)); ?> </span>
                                            </a>
                                        </li>
										<?php } ?>
										<?php $cnt++;} ?>
                                     </ul>
                                    <div class="dropdown-menu-footer">
									<?php if($userdetails['role_id']==2){ ?>
                                        <a href="<?php echo base_url('hospital/announcement/'.base64_encode(1)); ?>"> All notifications </a>
									<?php }else{ ?>
									      <a href="<?php echo base_url('announcement/'); ?>"> All notifications </a>
									<?php } ?>
                                    </div>
                                </li>
                            </ul>
                        </li>
						<?php } ?>
						<?php } ?>
                        <!-- end notification dropdown -->
                       
 						<!-- start manage user dropdown -->
 						<li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
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
							
								
                                <span class="username username-hide-on-mobile">  <?php echo isset($userdetails['r_name'])?htmlentities($userdetails['r_name']):''; ?> </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="<?php echo base_url('profile'); ?>">
                                        <i class="icon-user"></i> Profile </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('dashboard/changepassword'); ?>">
                                        <i class="icon-settings"></i> Change Password
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('dashboard/logout'); ?>">
                                        <i class="icon-logout"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
      
    </div>
   <!--notification modal start-->
   <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Notifications at <span class="" id="notification_time"></span ></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="notification_msg"> </p>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
<?php if($this->session->flashdata('success')): ?>
<div class="alert_msg1 animated slideInUp bg-succ">
   <?php echo $this->session->flashdata('success');?> &nbsp; <i class="fa fa-check text-success ico_bac" aria-hidden="true"></i>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('error')): ?>
<div class="alert_msg1 animated slideInUp bg-warn">
   <?php echo $this->session->flashdata('error');?> &nbsp; <i class="fa fa-exclamation-triangle text-success ico_bac" aria-hidden="true"></i>
</div>
<?php endif; ?>
   <!--notification modal end-->
   <script>
   function opennotification(id){
	   if(id !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('admin/get_notification_msg');?>",
   			data: {
				notification_id: id,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
					$('#notification_count1').empty();
   					$('#notification_count').empty();
   					$('#notification_time').empty();
   					$('#notification_msg').empty();
   					var parsedData = JSON.parse(data);
   					$('#notification_msg').append(parsedData.names_list);
   					$('#notification_time').append(parsedData.time);
   					$('#notification_count1').append(parsedData.Unread_count);
   					$('#notification_count').append(parsedData.Unread_count);
						if(parsedData.Unread_count==''){
							$('#count_symbole').hide();
						}else{
							$('#count_symbole').show();
						}
   					}
           });
	   }
	}
	 function resourceopennotification(id){
	   if(id !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('admin/get_resource_notification_msg');?>",
   			data: {
				notification_id: id,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
					$('#notification_count1').empty();
   					$('#notification_count').empty();
   					var parsedData = JSON.parse(data);
   					$('#notification_msg').append(parsedData.names_list);
   					$('#notification_time').append(parsedData.time);
   					$('#notification_count1').append(parsedData.Unread_count);
   					$('#notification_count').append(parsedData.Unread_count);
   					}
           });
	   }
	}
   </script>