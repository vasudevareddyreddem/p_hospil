<div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
			  <div class="page-title-breadcrumb">
				 <div class=" pull-left">
					<div class="page-title">Chat List</div>
				 </div>
				 <ol class="breadcrumb page-breadcrumb pull-right">
					<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
					</li>
					<li><a class="parent-item active" >Chat List</a>&nbsp;</i>
					</li>
				 </ol>
			  </div>
		   </div>
					<div class="row">
                       <div class="col-md-12">
                            <div class="card card-topline-aqua">
							
                                <div class="card-head">
                                     <header>Chat List</header>
                                   
                                </div>
                                <div class="card-body ">
								<?php if(count($chat_list)>0){ ?>
                                    <table id="saveStage" class="display" style="width:100%;">
                                        <thead>
                                            <tr>
												<th>Name</th>
                                                <th>Message</th>
                                                <th>Create at</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php foreach($chat_list as $list){ ?>
                                            <tr>
                                                <td><?php echo htmlentities($list['replayname']); ?></td>
                                                <td><?php echo htmlentities($list['comment']); ?></td>
                                                <td><?php echo htmlentities($list['create_at']); ?></td>
                                                <td><a href="<?php echo base_url('admin/chatinglist/'.base64_encode($list['user_id'])); ?>"><?php echo htmlentities($list['type']); ?></a></td>
                                              
                                            </tr>
										<?php } ?>
											
                                            
                                        </tbody>
                                    </table>
								<?php } ?>
                                </div>
								<div class="clearfix">&nbsp;</div>
							
                            </div>
                        </div>
                    </div>
				
                    
                </div>
            </div>
