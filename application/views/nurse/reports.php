<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Reports</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Nurse</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Reports</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel tab-border card-topline-green">
                    <header class="panel-heading panel-heading-gray custom-tab ">
                        Patients Report
                    </header>
                    <div class="panel-body">
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
                                        <th>Date of Admit</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>xxxxxx500</td>
                                        <td>patient 1</td>
                                        <td>Male</td>
                                        <td>26</td>
                                        <td>Design Doctor1</td>
                                        <td>xxxxxx</td>
                                        <td>25/06/2018 </td>
                                        <td class="valigntop">
                                            <div class="btn-group">
                                                <a href="<?php echo base_url('nurse/reports_view');?>" class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" > View </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>