
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
               <li class="active">Observation/ Nursing Notes</li>
            </ol>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="panel tab-border card-topline-green">
						<div class=" ">
                                <div class="card-head">
                                     <header>Observation/ Nursing Notes</header>
                                  
                                </div>
                                <div class="card-body table-responsive">
                                    <table id="example4" class=" table table-bordered" style="width:100%;">
                                        <thead>
                                            <tr>
                                               
                                                <th>S.No </th>
                                                <th>Patient ID </th>
                                                <th>Patient Name </th>
                                                <th>Patient Case </th>
                                                <th>No of Follow Up </th>                                            
                                                <th>Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            
												<td> 1</td>
												<td>xxx1</td>
                                                <td>test Name</td>
                                                <td>xxxx</td>
                                                <td>5</td>
                                                <td>
													<a class="btn btn-xs btn-success" data-toggle="modal" data-target="#exampleModal">View Follow Up </span>
													
												</td>
                                            </tr>  
											
											
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

<!-- Modal start-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Follow Up</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
      </div>
      <div class="modal-footer">
       
       
      </div>
    </div>
  </div>
</div>
