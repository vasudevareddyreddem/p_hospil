
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Beds count</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Bed Chart</li>
            </ol>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="panel tab-border card-topline-green">
						<div class=" ">
                                <div class="card-head">
                                     <header>Bed Chart</header>
                                  
                                </div>
                                <div class="card-body table-responsive">
                                    <table id="example4" class=" table table-bordered" style="width:100%;">
                                        <thead>
                                            <tr>
                                               
                                                <th>Ward Name </th>
                                                <th>Ward Type </th>
                                               
                                                <th>Room Type</th>
												 <th>Floor No </th>
                                                <th>Room No</th>
                                                <th>Beds Count</th>
                                                <th>Available Bed Numbers</th>
                                                <th>Blocked Bed Numbers</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php if(isset($red_chart_list) && count($red_chart_list)>0){ ?>
										<?php foreach($red_chart_list as $list){ ?>
                                            <tr>
                                            
												<td><?php echo isset($list['ward_name'])?$list['ward_name']:''; ?></td>
												<td><?php echo isset($list['ward_type'])?$list['ward_type']:''; ?></td>
												<td><?php echo isset($list['room_type'])?$list['room_type']:''; ?></td>
												<td><?php echo isset($list['ward_floor'])?$list['ward_floor']:''; ?></td>
												<td><?php echo isset($list['room_num'])?$list['room_num']:''; ?></td>
												<td><?php echo isset($list['bed_count'])?$list['bed_count']:''; ?></td>
												
                                                <td>
													<?php if(isset($list['bed_num']) && count($list['bed_num'])>0){ ?>
													<?php foreach($list['bed_num'] as $lis){
														if($lis['completed']==1 || $lis['pt_id']==''){														
														echo isset($lis['r_b_id'])?$lis['r_b_id'].',':''; 
														}
													 } 
													 } ?>
													
												</td>
												<td>
													<?php if(isset($list['bed_num']) && count($list['bed_num'])>0){ ?>
													<?php foreach($list['bed_num'] as $lis){
														if($lis['completed']==0 && $lis['pt_id']!=''){														
														echo isset($lis['r_b_id'])?$lis['r_b_id'].',':''; 
														}
													 } 
													 } ?>
													
												</td>
                                            </tr>
										<?php } ?>											
										<?php } ?>											
										
											
                                        </tbody>
                                    </table>
                                </div>
								<div class="clearfix">&nbsp;</div>
											
                     </div>
         </div>
      </div>
   </div>
</div>
<div id="sucessmsg" style="display:none;"></div>

