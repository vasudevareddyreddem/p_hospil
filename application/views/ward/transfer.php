
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Appointments</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Transfer Patient</li>
            </ol>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="panel tab-border card-topline-green">
						<div class=" ">
                                <div class="card-head">
                                     <header>Transfer Patient</header>
                                  
                                </div>
                                <div class="card-body table-responsive">
                                    <table id="example4" class=" table table-bordered" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Patient ID</th>
												<th>Patient Name</th>
                                                <th>Ward Name </th>
                                                <th>Ward Type</th>
                                                <th>Room Type</th>
												<th>Floor No</th>
                                                <th>Room No</th>
                                                <th>Bed No</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php if(isset($ip_admitted_patient_list)  && count($ip_admitted_patient_list)>0){ ?>
											<?php foreach($ip_admitted_patient_list as $list){ ?>
                                            <tr>
													
													<td><?php echo $list['pt_id']; ?></td>
													<td><?php echo $list['name']; ?></td>
													<td><?php echo $list['ward_name']; ?></td>
													<td><?php echo $list['ward_type']; ?></td>
													<td><?php echo $list['room_type']; ?></td>
													<td><?php echo $list['ward_floor']; ?></td>
													<td><?php echo $list['room_num']; ?></td>
													<td><?php echo $list['bed']; ?></td>
													
                                                <td>
													<a class="btn btn-xs btn-success dropdown-toggle no-margin" type="button" > Accept</a>
													<a class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" > Reject</a>
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

