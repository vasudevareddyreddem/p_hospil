
   <?php //echo '<pre>';print_r($hospital_details);exit; ?>
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
		 <?php if($userdetails['role_id']==2){ ?>
            <div class=" pull-left">
               <div class="page-title">Room Number Edit</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li><li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('Ward_management/roomnumber/'.base64_encode(1)); ?>">Room List</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Edit</li>
            </ol>
			<?php } ?>
         </div>
      </div>
   
         <div class="panel tab-border card-topline-green">
            <header class="panel-heading panel-heading-gray custom-tab ">
               <ul class="nav nav-tabs">
                  <li class="nav-item"><a href="#home" data-toggle="tab" class="<?php if(isset($tab) && $tab ==''){ echo "active"; } ?>">Edit Room Number </a>
                  </li>
                  
               </ul>
            </header>
            <div class="panel-body">
               <div class="tab-content">
                  <div class="tab-pane <?php if(isset($tab) && $tab ==''){ echo "active"; } ?>" id="home">
				  <div class="container">
                     
					  <form action="<?php echo base_url('Ward_management/roomnumbereditpost'); ?>" method="post" id="room_num" name="room_num" enctype="multipart/form-data">
							<?php $csrf = array(
													   'name' => $this->security->get_csrf_token_name(),
													   'hash' => $this->security->get_csrf_hash()
													   ); ?>
													<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />													
													<input type="hidden" name="rnoid" id="rnoid" value="<?php echo $list['w_r_n_id']; ?>" >
													<div class="modal-header">
														<h4 class="modal-title" id="smallModalLabel">Room Number rename</h4>
													</div>
													
													<div class="modal-body">
														<div class="form-group">
														<div class="form-line">
														<label> Floor Number</label>
														
														<select name="floor_number" id="floor_number" class="form-control">
																<option value="">Select Floor number</option>
																<?php foreach($floor_list as $List){ ?>
																	<?php if($List['w_f_id']==$list['f_id']){ ?>
																		<option selected value="<?php echo $List['w_f_id'];?>"><?php echo $List['ward_floor'];?></option>
																	<?php }else{ ?>
																	<option  value="<?php echo $List['w_f_id'];?>"><?php echo $List['ward_floor'];?></option>
																	<?php } ?>
																<?php } ?>
																
																</select>
														
														<label> Room Number</label>
														<input type="text" id="room_num" name="room_num" class="form-control" value="<?php echo htmlentities($list['room_num']);?>" />
														<label> Bed Count</label>
														<input type="text" id="bed_num" name="bed_num" class="form-control" value="<?php echo htmlentities($list['bed_count']);?>" />
													</div>
													</div>
														</div>
													<div class="modal-footer">
														<button type="submit" class="btn btn-link waves-effect">Update </button>
													</div>
												 </form>
                     </div>
                  </div>
                  
               </div>
            </div>
            <div class="clearfix">&nbsp;</div>

      </div>
   </div>
</div>
<script>

$(document).ready(function() {
    $('#room_num').bootstrapValidator({
        
        fields: {
			floor_number: {
                 validators: {
					notEmpty: {
						message: 'Floor number is required'
					}
				}
            },
			
            
            room_num: {
                 validators: {
					notEmpty: {
						message: 'Room number is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9&. ]+$/,
					message: 'Room number can only consist of alphanumeric, space and dot'
					}
				}
            },bed_num: {
                 validators: {
					notEmpty: {
						message: 'Bed number is required'
					},
					regexp: {
					regexp: /^[a-zA-Z0-9&. ]+$/,
					message: 'Bed number can only consist of alphanumeric, space and dot'
					}
				}
            }
            }
        })
     
});

</script>