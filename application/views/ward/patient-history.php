
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
               <li class="active">Patient History</li>
            </ol>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="panel tab-border card-topline-green">
						<div class=" ">
                                <div class="card-head">
                                     <header>Patient History</header>
                                  
                                </div>
                                <div class="card-body table-responsive">
                                    <table id="example4" class=" table table-bordered" style="width:100%;">
                                        <thead>
                                            <tr>
                                               
                                                <th>Patient ID</th>
												<th>Patient Name</th>
                                                <th>Mobile No </th>
                                                <th>Doctor Name</th>
                                                <th>Admision Date</th>
                                                <th>Discharge Date</th>
                                                <th>Payment Status</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php if(isset($patient_history)  && count($patient_history)>0){ ?>
											<?php foreach($patient_history as $list){ ?>
                                            <tr>
                                               <td><?php echo $list['pt_id']; ?></td>
											    <td><?php echo $list['name']; ?></td>
											    <td><?php echo $list['mobile']; ?></td>
                                                <td><?php echo $list['resource_name']; ?></td>
                                                <td><?php echo date('M j h:i A',strtotime(htmlentities($list['date_of_admit'])));?></td>
												<td><?php echo date('M j h:i A',strtotime(htmlentities($list['discharge_date'])));?></td>

                                                <td>
												<?php if($list['amount_status']==1){?>
												<span class="label label-sm label-success"> Paid </span>
												<?php }else{ ?>
												<span class="label label-sm label-warning">Pending </span>
												<?php } ?>
													
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
</div>
