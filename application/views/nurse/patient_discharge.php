<?php //echo '<pre>';print_r($hospital_details);exit; ?>
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Patient Discharge</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Nurse</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Patient Discharge</li>
            </ol>
         </div>
      </div>
   
         <div class="panel tab-border card-topline-green">
            <header class="panel-heading panel-heading-gray custom-tab ">
               <ul class="nav nav-tabs">
                  <li class="nav-item"><a href="#home" data-toggle="tab" class="active">Add Doctor</a>
                  </li>
                  <li class="nav-item"><a href="#about" data-toggle="tab" class="">Doctors List</a>
                  </li>
               </ul>
            </header>
            <div class="panel-body">
               <div class="tab-content">
                  <div class="tab-pane active" id="home">
				  <div class="container">
                     <div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
                            <table id="" class="table table-bordered" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Patient ID</th>
                                        <th>Patient Name</th>
                                        <th>Gender </th>
                                        <th>Age</th>
                                        <th>Doctor</th>
                                        <th>Diagnosis</th>
                                        <th>Billed</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>xxxxxx500</td>
                                        <td>patient 1</td>
                                        <td>Male</td>
                                        <td>26</td>
                                        <td>xxxxx</td>
                                        <td>xxxx</td>
                                        <td>Paid</td>
                                        <td class="valigntop">
                                            <div class="btn-group">
                                                <a href="" class="btn btn-xs deepPink-bgcolor" type="button" >Discharge
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>xxxxxx500</td>
                                        <td>patient 1</td>
                                        <td>Male</td>
                                        <td>26</td>
                                        <td>xxx </td>
                                        <td>xxxx</td>
                                        <td>Unpaid </td>
                                        <td class="valigntop">
                                            <div class="btn-group">
                                                <a href="" class="btn btn-xs deepPink-bgcolor" type="button" >Discharge
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                           </div>
						   <div class="clearfix">&nbsp;</div>
                        </div>
                        </div>
						
                     </div>
                 
                  <div class="tab-pane " id="about">
                     <div class="container">
                        <div class="row">
                           <div class="col-md-12">
                <div class="">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="" class="table table-bordered" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Patient ID</th>
                                        <th>Patient Name</th>
                                        <th>Doctor</th>
                                        <th>Diagnosis</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>xxxxxx500</td>
                                        <td>patient 1</td>
                                        <td>xxxx</td>
                                        <td>xxxxx</td>
                                        <td>Complete / inComplete</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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