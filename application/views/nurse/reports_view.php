

<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Report View</div>
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
                        Patient Report
                    </header>
                    <div class="panel-body">
                        <div id="smartwizard" class="col-md-12">
                            <ul>
                                <li><a href="#step-1">Medicine</a></li>
                                <li><a href="#step-2">Lab</a></li>
                            </ul>
                            <div>
                                <div id="step-1" class="">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="" class="table table-bordered" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Name of the Medicine</th>
                                        <th>Quantity</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>xxxxxx500</td>
                                        <td>xxxxx</td>
                                        <td>xxxx</td>
                                    </tr>
                                    <tr>
                                        <td>xxxxxx500</td>
                                        <td>xxx </td>
                                        <td>xxxx</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                                </div>
                                <div id="step-2" class="">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="" class="table table-bordered" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Patient Card Number</th>
                                        <th>Patient Id</th>
                                        <th>Name</th>
                                        <th>Mobile Number</th>
                                        <th>Lab Tests</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>xxxxxx500</td>
                                        <td>xxxxxx</td>
                                        <td>xxxx</td>
                                        <td>xxxxx</td>
                                        <td>xxxxx</td>
                                        <td>xxxxxx</td>
                                        <td><button class="btn btn-sm btn-info" type="button" data-toggle="modal" data-target="#labreport" >View</button></td>
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
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Lab Report Modal -->
<div class="modal fade" id="labreport" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <h5 class="modal-title" id="lineModalLabel">Lab Report</h5>
                <button type="button" id="popupclose" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body" style="height:400px;overflow:hidden; overflow-y: scroll;">
                <div class="table-responsive">
                    <table id="" class="table table-bordered" style="width:100%;">
                        <thead>
                            <tr>
                                <th>Patient ID</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Report File</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>xxxxxx500</td>
                                <td>xxxxxxxx</td>
                                <td>25/06/2018 </td>
                                <td class="valigntop">
                                    <div class="btn-group">
                                        <a href="" class="btn btn-xs">Download</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>xxxxxx500</td>
                                <td>xxxxxxxx</td>
                                <td>25/06/2018 </td>
                                <td class="valigntop">
                                    <div class="btn-group">
                                        <a href="" class="btn btn-xs">Download</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>xxxxxx500</td>
                                <td>xxxxxxxx</td>
                                <td>25/06/2018 </td>
                                <td class="valigntop">
                                    <div class="btn-group">
                                        <a href="" class="btn btn-xs">Download</a>
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
<!-- //Lab Report Modal -->