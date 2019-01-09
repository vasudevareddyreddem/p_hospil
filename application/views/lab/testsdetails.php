<?php //echo '<pre>';print_r($hospital_details);exit; ?>

<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Add Lab Test</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Add Lab Test</li>
                </ol>
            </div>
        </div>

        <div class="panel tab-border card-topline-green">
            <header class="panel-heading panel-heading-gray custom-tab ">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a href="#home" data-toggle="tab" class="<?php if(isset($tab) && $tab ==''){ echo " active"; } ?>">Add Lab Test </a>
                    </li>
                    <li class="nav-item"><a href="#about" data-toggle="tab" class="<?php if(isset($tab) && $tab ==1){ echo " active"; } ?>">Test List</a>
                    </li>
                </ul>
            </header>
            <?php if($this->session->flashdata('adderror')){ ?>
            <?php foreach($this->session->flashdata('adderror') as $error){?>
            <div class="alert_msg1 animated slideInUp bg-warn">
                <?php echo $error.'<br/>'; ?>&nbsp; <i class="fa fa-exclamation-triangle text-success ico_bac" aria-hidden="true"></i>
            </div>

            <?php } ?>
            <?php } ?>


            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane <?php if(isset($tab) && $tab ==''){ echo " active"; } ?>" id="home">
                        <div class="container">
                            <form id="uploadexcel_sheet" name="uploadexcel_sheet" method="post" action="<?php echo base_url('lab/exelsheet'); ?>" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Upload excel file</label>
                                        <input type="file" class="form-control" name="uploadfile" id="uploadfile">
                                    </div>

                                    <div class="col-md-3">
                                        <label>Click here to upload</label>
                                        <div>
                                            <input class="btn btn-primary btn-sm" type="submit" name="upload" value="Upload">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Download</label>
                                        <div>
                                            <a target="_blank" href="<?php echo base_url('assets/modality_list.xlsx'); ?>">Download sample sheet</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="<?php echo base_url('lab/addtest'); ?>" method="post" id="addtreatment" name="addtreatment" enctype="multipart/form-data">
                                <div class="row">
								<div class="col-md-6">
                                        <label>Type</label>
                                        <select class="form-control" onchange="get_labtype(this.value);" name="type" id="type">
                                            <option value="">Select</option>
                                            <option value="Lab">Lab</option>
                                            <option value="Radiology">Radiology</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label> Test Type</label>
                                        <input class="form-control" id="test_type" name="test_type" value="" type="text" placeholder="Test Type">
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label>Test Name</label>
                                        <input class="form-control" id="test_name" name="test_name" value="" type="text" placeholder="Test Name">
                                    </div>
                                    <div class="col-md-6" id="modality_id" style="display:none">
                                        <label>Modality</label>
                                        <input class="form-control" id="modality" name="modality" value="" type="text" placeholder="Enter Modality">
                                    </div>
                                    <div class="col-md-6">
                                        <label> Duration</label>
                                        <input class="form-control" id="duration" name="duration" value="" type="text" placeholder="Duration">
                                    </div>
                                    <div class="col-md-6">
                                        <label> Amount</label>
                                        <input class="form-control" id="amuont" name="amuont" value="" type="text" placeholder="Amount">
                                    </div>


                                    <div class="">
                                        <label>&nbsp;</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-success pull-right" type="button">Add Test</button>

                            </form>


                        </div>
                    </div>
                    <div class="tab-pane <?php if(isset($tab) && $tab ==1){ echo " active"; } ?>" id="about">
                        <div class="container">
                            <div class="row">
                                <div class="card-body col-md-12 table-responsive">
                                    <?php if(count($labtest_list)>0){ ?>
                                    <table id="example4" class="table table-striped table-bordered table-hover  order-column" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Test Type Name</th>
                                                <th>Type</th>
                                                <th>Test Name</th>
                                                <th>Modality</th>
                                                <th>Duration</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($labtest_list as $list){ ?>
                                            <tr>
                                                <td>
                                                    <?php echo htmlentities($list['test_type']); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($list['type']); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($list['t_name']); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($list['modality']); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($list['duration']); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($list['amuont']); ?>
                                                </td>
                                                <td>
                                                    <?php if($list['status']==1){ echo "Active";}else{ echo "Deactive"; } ?>
                                                </td>

                                                <td class="valigntop">
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li>
                                                                <a href="<?php echo base_url('lab/edit/'.base64_encode($list['t_id'])); ?>">
                                                                    <i class="fa fa-edit"></i>Edit </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript;void(0);" onclick="admindelete('<?php echo base64_encode(htmlentities($list['t_id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus2('<?php echo $list['status'];?>')" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                                                                    <i class="fa fa-trash-o"></i>Delete</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($list['t_id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus('<?php echo $list['status'];?>')" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                                                                    <i class="fa fa-edit"></i>
                                                                    <?php if($list['status']==0){ echo "Active";}else{ echo "Deactive"; } ?> </a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>


                                        </tbody>
                                    </table>
                                    <?php } ?>

                                </div>
                            </div>

                        </div>
                    </div>



                </div>
            </div>
            <div class="clearfix">&nbsp;</div>
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">

                        <div style="padding:10px">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 style="pull-left" class="modal-title">Confirmation</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger alert-dismissible" id="errormsg" style="display:none;"></div>
                            <div class="row">
                                <div id="content1" class="col-xs-12 col-xl-12 form-group">
                                    Are you sure ?
                                </div>
                                <div class="col-xs-6 col-md-6">
                                    <button type="button" aria-label="Close" data-dismiss="modal" class="btn  blueBtn">Cancel</button>
                                </div>
                                <div class="col-xs-6 col-md-6">
                                    <a href="?id=value" class="btn  blueBtn popid" style="text-decoration:none;float:right;"> <span aria-hidden="true">Ok</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function get_labtype(value) {
        if (value == 'Radiology') {
            $('#modality_id').show();
        } else {
            $('#modality_id').hide();
        }

    }
    $(document).ready(function() {
        $('#example4').DataTable({
            "order": [
                [2, "desc"]
            ]
        });
    });

    function admindeactive(id) {
        $(".popid").attr("href", "<?php echo base_url('lab/teststatus/'); ?>" + "/" + id);
    }

    function adminstatus(id) {
        if (id == 1) {
            $('#content1').html('Are you sure you want to Deactivate?');

        }
        if (id == 0) {
            $('#content1').html('Are you sure you want to activate?');
        }
    }

    function admindelete(id) {
        $(".popid").attr("href", "<?php echo base_url('lab/deletelab'); ?>" + "/" + id);
    }

    function adminstatus2(id) {

        $('#content1').html('Are you sure you want to delete?');

    }
    $(document).ready(function() {
        $('#addtreatment').bootstrapValidator({

            fields: {

                test_type: {
                    validators: {
                        notEmpty: {
                            message: 'Test type is required'
                        }
                    }
                },
                type: {
                    validators: {
                        notEmpty: {
                            message: 'Type is required'
                        }
                    }
                },
                test_name: {
                    validators: {
                        notEmpty: {
                            message: 'Name is required'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9. ]+$/,
                            message: 'Name can only consist of alphanumeric, space and dot'
                        }
                    }
                },
                modality: {
                    validators: {
                        notEmpty: {
                            message: 'Modality is required'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9. ]+$/,
                            message: 'Modality can only consist of alphanumeric, space and dot'
                        }
                    }
                },
                duration: {
                    validators: {
                        notEmpty: {
                            message: 'Duration is required'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9. ]+$/,
                            message: 'Duration can only consist of alphanumeric, space and dot'
                        }
                    }
                },
                amuont: {
                    validators: {
                        notEmpty: {
                            message: 'Amuont is required'
                        },
                        regexp: {
                            regexp: /^[0-9. ]*$/,
                            message: 'Amuont can only consist of digits and dot'
                        }
                    }
                }
            }
        })

    });

    $(document).ready(function() {
        $('#uploadexcel_sheet').bootstrapValidator({
            fields: {
                uploadfile: {
                    validators: {
                        notEmpty: {
                            message: 'Upload  Sheet is required'
                        },
                        regexp: {
                            regexp: "(.*?)\.(xlsx|xls)$",
                            message: 'Uploaded file is not a valid. Only xlsx files are allowed'
                        }
                    }
                }
            }
        })

    });
</script>