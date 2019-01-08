<?php //echo '<pre>';print_r($hospital_details);exit; ?>
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Card Number List</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Card Number List</li>
            </ol>
         </div>
      </div>
   
         <div class="panel tab-border card-topline-green">
            <header class="panel-heading panel-heading-gray custom-tab ">
               <ul class="nav nav-tabs">
                  <li class="nav-item"><a href="#home" data-toggle="tab" class="<?php if(isset($tab) && $tab ==''){ echo "active"; } ?>">Add Card Number</a>
                  </li>
                  <li class="nav-item"><a href="#about" data-toggle="tab" class="<?php if(isset($tab) && $tab ==1){ echo "active"; } ?>">Card Number List</a>
                  </li>
               </ul>
            </header>
            <div class="panel-body">
               <div class="tab-content">
                  <div class="tab-pane <?php if(isset($tab) && $tab ==''){ echo "active"; } ?>" id="home">
				  <div class="container">
                     
					  <form action="<?php echo base_url('admin/cardnumberpost'); ?>" method="post" id="add_typetest" name="add_typetest" enctype="multipart/form-data">
								<div class="row">
								<div class="col-md-6">
									<label>Cards count</label>
								<input class="form-control" id="card_number" name="card_number" value="" type="text" placeholder="30">
                                    <br>
                                    <button type="submit" class="btn btn-sm btn-success pull-right" type="button">Add</button>
								</div>
								</div>
							
							</form>
						
					
                     </div>
                  </div>
                  <div class="tab-pane <?php if(isset($tab) && $tab ==1){ echo "active"; } ?>" id="about">
                     <div class="container">
                        <div class="row">
                            <div class="card-body col-md-12 table-responsive">
								<?php if(count($card_numbers_list)>0){ ?>
                                    <table id="example4" class="table table-striped table-bordered table-hover  order-column" style="width:100%;">
                                        <thead>
                                            <tr>
												<th>Card Numbers Count</th>
                                                <th>Create date</th>
                                                <th>Status</th>
                                               <!-- <th>Action</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php foreach($card_numbers_list as $list){ ?>
                                            <tr>
                                                <td><?php echo htmlentities($list['count']); ?></td>
                                                <td><?php echo htmlentities($list['created_at']); ?></td>
												<td><?php if($list['status']==1){ echo "Active";}else{ echo "Deactive"; } ?></td>
												<!--<td><a target="_blank" href="<?php echo base_url('assets/cardnumbers/'.$list['pdf_name']); ?>">Download</a></td>
                                                -->
                                            </tr>
											
										<?php } ?>
											
                                            
                                        </tbody>
                                    </table>
								<?php }else{ ?>
								<div>No data Available</div>
								<?php } ?>
								
                                </div>
                        </div>
                       
                     </div>
                  </div>
               </div>
            </div>
            <div class="clearfix">&nbsp;</div>
       
      </div>
   </div>
</div>
