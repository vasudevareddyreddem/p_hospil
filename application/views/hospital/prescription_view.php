<?php //echo '<pre>';print_r($prescriptions);exit; ?>
<div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
			  <div class="page-title-breadcrumb">
				 <div class=" pull-left">
					<div class="page-title">Prescription List</div>
				 </div>
				 <ol class="breadcrumb page-breadcrumb pull-right">
					<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
					</li>
					<li><a class="parent-item active" >Prescription List</a>&nbsp;</i>
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
											<?php if($prescriptions['information']['sheet_prescription']==1){ ?>
											<form action="<?php echo base_url('users/sheet_prescription'); ?>" method="post" enctype="multipart/form-data">
											<input type="hidden" name="p_id" value="<?php echo isset($prescriptions['information']['pid'])?$prescriptions['information']['pid']:''; ?>">
											<input type="hidden" name="b_id" value="<?php echo isset($prescriptions['information']['b_id'])?$prescriptions['information']['b_id']:''; ?>">
											<input type="hidden" name="sheet_prescription_name" value="<?php echo isset($prescriptions['information']['sheet_prescription_file'])?$prescriptions['information']['sheet_prescription_file']:''; ?>">
											Upload Prescription File : <input type="file" name="sheet_prescription">
											<button type="submit" value="submit">submit</button>
											</form>
											<?php } ?>
											</div>
                                          
                                        </div>
                                        <div class="card-body " style="padding: 0px 24px 24px 24px;">
                                        <div class="table-responsive">
										<form id="prescription" name="prescription" method="post"  action="<?php echo base_url('Users/billprescription'); ?>">
                                            <input type="hidden" name="pid" id="pid" value="<?php echo isset($prescriptions['information']['pid'])?$prescriptions['information']['pid']:''; ?>">
                                            <input type="hidden" name="bid" id="bid" value="<?php echo isset($prescriptions['information']['b_id'])?$prescriptions['information']['b_id']:''; ?>">
											<table class="table custom-table table-hover" style="border-top:none">
                                                <thead>
                                                    <tr>
                                                        <th>Medicine Name</th>
                                                        <th>QTY</th>
														<th>Amount</th>
                                                        <th>Dosage</th>
                                                        <th>Substitute Allowed?</th>
                                                        <th>Modify Prescription Reason:</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php foreach($prescriptions['medicine'] as $list){ ?>
                                                    <tr>
                                                        <td><?php echo isset($list['medicine_name'])?$list['medicine_name']:''; ?></td>
                                                        <td style="width:100px">
															<div class="form-group">
															<input autocomplete="off" onkeyup="changeqty(this.value,'<?php echo isset($list['m_id'])?$list['m_id']:''; ?>','');change_qtys('<?php echo isset($list['m_id'])?$list['m_id']:''; ?>',this.value);" name="qty" id="qty<?php echo isset($list['m_id'])?$list['m_id']:''; ?>" type="text" class="form-control" value="<?php echo isset($list['qty'])?$list['qty']:''; ?>" placeholder="Enter Qty">
															</div>
														</td>
														 <td style="width:100px">
															<div class="form-group">
															<input autocomplete="off" onkeyup="changeamount(this.value,'<?php echo isset($list['m_id'])?$list['m_id']:''; ?>');change_qtys('<?php echo isset($list['m_id'])?$list['m_id']:''; ?>',this.value);" name="amount" id="amount<?php echo isset($list['m_id'])?$list['m_id']:''; ?>" type="text" class="form-control" value="<?php echo isset($list['amount'])?$list['amount']:''; ?>" placeholder="Enter amount">
															</div>
														</td>
                                                        <td>
															<?php echo isset($list['dosage'])?$list['dosage']:''; ?>
														</td>
                                                        
                                                        <td><?php echo isset($list['substitute_name'])?$list['substitute_name']:''; ?></td>
                                                      
													   <td style="">
															<div class="form-group">
															<input name="reason" id="reason" onkeyup="changeqty('','<?php echo isset($list['m_id'])?$list['m_id']:''; ?>',this.value)" type="text" class="form-control" value="<?php echo isset($list['edit_reason'])?$list['edit_reason']:''; ?>" placeholder="Enter Reason">
															</div>
														</td>
														
                                                    </tr>
													
													<?php } ?>
													
                                                    
                                                   
                                                    
                                                </tbody>
                                            </table>
											

											</form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
				
                    
                </div>
            </div>
			<div id="sucessmsg" style="display:none;"></div>
