
<?php //echo'<pre>';print_r($prescriptions);exit;?>

<div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
			  <div class="page-title-breadcrumb">
				 <div class=" pull-left">
					<div class="page-title">Prescription View</div>
				 </div>
				 <ol class="breadcrumb page-breadcrumb pull-right">
					<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
					</li>
					<li><a class="parent-item active" >Prescription View</a>&nbsp;</i>
					</li>
				 </ol>
			  </div>
		   </div>
					<div class="row">
                                <div class="col-md-12">
                                    <div class="card ">
                                        <div class="card-head">
                                            <header>Name : &nbsp;<span><?php echo isset($prescriptions['information']['name'])?$prescriptions['information']['name']:''; ?> </span><h4 class="py-2"><?php echo isset($prescriptions['information']['mobile'])?$prescriptions['information']['mobile']:''; ?></h4></header>
									<div class="tools">
                                   <h4><b>ID: <span><?php echo isset($prescriptions['information']['pid'])?$prescriptions['information']['pid']:''; ?></span></b></h4>
                                   <h5><b>DOB: <span><?php echo isset($prescriptions['information']['dob'])?$prescriptions['information']['dob']:''; ?></span></b></h5>
									
                                 </div>
                                          
                                        </div>
                                        <div class="card-body " style="padding: 0px 24px 24px 24px;">
                                        <div class="table-responsive">
											<table class="table custom-table table-hover" style="border-top:none">
                                                <thead >
                                                    <tr>
                                                        <th>Medicine Name</th>
														<th>Batch No</th>
														<th>Expiry Date</th>
														<th>No of Days</th>
                                                        <th>QTY</th>
                                                        <th>Frequency</th>
                                                        <th>Amount</th>
                                                        <th>Total Amount</th>
                                                       
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php foreach($prescriptions['medicine'] as $list){ ?>
                                                    <tr>
                                                        <td><?php echo isset($list['medicine_name'])?$list['medicine_name']." - dosage ".$list['dosage']." - type ".$list['medicine_type']:''; ?></td>
                                                         <td>
															<?php echo isset($list['batchno'])?$list['batchno']:''; ?>
														</td>
														<td>
															<?php echo isset($list['expiry_date'])?$list['expiry_date']:''; ?>
														</td>
														<td>
															<?php echo isset($list['no_of_days'])?$list['no_of_days']:''; ?>
														</td>
                                                        <td>
															<?php echo isset($list['qty'])?$list['qty']:''; ?>
														</td>
														
														<td>
															<?php echo isset($list['frequency'])?$list['frequency']:''; ?>
														</td>
                                                        
                                                        <td><?php echo isset($list['amount'])?$list['amount']:''; ?></td>
                                                        <td><?php echo isset($list['org_amount'])?$list['org_amount']:''; ?></td>
                                                       
                                                    </tr>
													
													<?php } ?>
												 </tbody>
                                            </table>
											<?php if(isset($prescriptions['information']['medicine_payment_mode']) && $prescriptions['information']['medicine_payment_mode']!=''){ ?>
											<p>Payment Mode : <?php echo $prescriptions['information']['medicine_payment_mode']; ?>
											<?php } ?>
											<?php if(isset($previous_alter_medication_list['sheet_prescription_file']) && $previous_alter_medication_list['sheet_prescription_file']!=''){ ?>
											<p>Prescription File</p><a href="<?php echo base_url('assets/sheet_prescriptions/'. $previous_alter_medication_list['sheet_prescription_file']); ?>">Download</a><br>

											<?php } ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
				
                    
                </div>
            </div>
