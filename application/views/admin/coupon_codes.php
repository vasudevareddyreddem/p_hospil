<?php //echo '<pre>';print_r($hospital_details);exit; ?>
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Coupon Code</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Coupon Code</li>
                </ol>
            </div>
        </div>

        <div class="panel tab-border card-topline-green">
            
            <header class="panel-heading panel-heading-gray custom-tab ">
                 <ul class="nav nav-tabs">
                    <li class="nav-item"><a href="#home" data-toggle="tab" class="<?php if(isset($tab) && $tab ==''){ echo " active"; } ?>">Add Wallet Percentage Amount </a>
                    </li>
                    <li class="nav-item"><a href="#about" data-toggle="tab" class="<?php if(isset($tab) && $tab ==1){ echo " active"; } ?>">Wallet Percentage Amount List</a>
                    </li>
					<li class="nav-item"><a href="#walletamount" data-toggle="tab" class="<?php if(isset($tab) && $tab ==2){ echo " active"; } ?>">Wallet Amount</a></li>
					<li class="nav-item"><a href="#walletamountlist" data-toggle="tab" class="<?php if(isset($tab) && $tab ==3){ echo " active"; } ?>">Wallet Amount List</a></li>
                 </ul>
            </header>
            
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane <?php if(isset($tab) && $tab ==''){ echo " active"; } ?>" id="home">
                        <div class="container">

                            <form action="<?php echo base_url('wallet/addpost'); ?>" method="post" id="coupon_post" name="coupon_post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label> Hospital Name </label>
                                        <select class="form-control" id="hospital_id" name="hospital_id">
                                            <option value="">Select</option>
                                            <?php foreach($hospital_list as $list){ ?>
                                            <option value="<?php echo $list['hos_id']; ?>">
                                                <?php echo $list['hos_bas_name']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
									<div class="form-group col-md-6">
										<label>Wallet Amount</label>
										<input class="form-control" id="wallet_amount" name="wallet_amount"  type="text" placeholder="Enter Wallet Amount" value="<?php echo isset($current_active_amt['wallet_amount'])?$current_active_amt['wallet_amount']:''; ?>">
									</div>
									<div class="form-group col-md-6">
										<label>IP Amount Percentage</label>
										<input class="form-control" id="ip_amount_percentage" name="ip_amount_percentage" value="" type="text" placeholder="Enter Amount Percentage">
									</div>
									<div class="form-group col-md-6">
										<label>OP Amount Percentage</label>
										<input class="form-control" id="op_amount_percentage" name="op_amount_percentage" value="" type="text" placeholder="Enter Amount Percentage">
									</div>
									<div class="form-group col-md-6">
										<label>Lab Amount Percentage</label>
										<input class="form-control" id="lab_amount_percentage" name="lab_amount_percentage" value="" type="text" placeholder="Enter Amount Percentage">
									</div>
                                    

                                </div>
                                <br>
                                <div class="">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-sm btn-success pull-right" type="button">Add</button>
                                </div>

                            </form>


                        </div>
                    </div>
                    <div class="tab-pane <?php if(isset($tab) && $tab ==1){ echo " active"; } ?>" id="about">
                        <div class="container">
                            <div class="row">
                                <div class="card-body col-md-12 table-responsive">
                                    <?php if(count($wallet_amt_percentage_list)>0){ ?>
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="example4">
                                        <thead>
                                            <tr>
                                                <th>Wallet Amount</th>
                                                <th>Hospital Name</th>
                                                <th>OP Amount Percentage</th>
                                                <th>IP Amount Percentage</th>
                                                <th>Lab Amount Percentage</th>
                                                <th>Created Date & Time</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                              <?php foreach($wallet_amt_percentage_list as $list){ ?>
                                            <tr>
                                                <td>
                                                    <?php echo htmlentities($list['wallet_amount']); ?>
                                                </td> 
												<td>
                                                    <?php echo htmlentities($list['hos_bas_name']); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($list['op_amount_percentage']); ?>
                                                </td>
												<td>
                                                    <?php echo htmlentities($list['ip_amount_percentage']); ?>
                                                </td>
                                             
												<td>
                                                    <?php echo htmlentities($list['lab_amount_percentage']); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($list['created_at']); ?>
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
                                                                <a href="javascript;void(0);" onclick="walletadmindeactive('<?php echo base64_encode(htmlentities($list['w_id'])).'/'.base64_encode($list['hospital_id']).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus('<?php echo $list['status'];?>')" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                                                                    <i class="fa fa-edit"></i>
                                                                    <?php if($list['status']==0){ echo "Active";}else{ echo "Deactive"; } ?> </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript;void(0);" onclick="walletadmindelete('<?php echo base64_encode(htmlentities($list['w_id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus2('<?php echo $list['status'];?>')" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                                                                    <i class="fa fa-trash-o"></i>Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>

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
					<div class="tab-pane <?php if(isset($tab) && $tab ==2){ echo " active"; } ?>" id="walletamount">
                        <div class="container">
                            <div class="row">
                                <div class="card-body col-md-12 table-responsive">
                                     <form action="<?php echo base_url('wallet/addamountpost'); ?>" method="post" id="add_wallet_amt" name="add_wallet_amt" enctype="multipart/form-data">
										<div class="row">
											<div class="form-group col-md-6">
												<label>Wallet Amount</label>
												<input class="form-control" id="wallet_amount" name="wallet_amount" value="" type="text" placeholder="Enter Wallet Amount">
											</div>
										</div>
										<br>
										<div class="">
											<label>&nbsp;</label>
											<button type="submit" class="btn btn-sm btn-success pull-right" type="button">Add</button>
										</div>

									</form>

                                </div>
                            </div>

                        </div>
                    </div>
					<div class="tab-pane <?php if(isset($tab) && $tab ==3){ echo " active"; } ?>" id="walletamountlist">
                        <div class="container">
                            <div class="row">
                                <div class="card-body col-md-12 table-responsive">
                                    <?php if(count($wallet_amt_list)>0){ ?>
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="example5">
                                        <thead>
                                            <tr>
                                                <th>Wallet Amount</th>
                                                <th>Created Date & Time</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                              <?php foreach($wallet_amt_list as $list){ ?>
                                            <tr>
                                                <td>
                                                    <?php echo htmlentities($list['wallet_amount']); ?>
                                                </td> 
												
                                                <td>
                                                    <?php echo htmlentities($list['created_at']); ?>
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
                                                                <a href="javascript;void(0);" onclick="wallet_amt_admindeactive('<?php echo base64_encode(htmlentities($list['w_a_id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus('<?php echo $list['status'];?>')" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                                                                    <i class="fa fa-edit"></i>
                                                                    <?php if($list['status']==0){ echo "Active";}else{ echo "Deactive"; } ?> </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript;void(0);" onclick="walletamt_admindelete('<?php echo base64_encode(htmlentities($list['w_a_id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus2('<?php echo $list['status'];?>')" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                                                                    <i class="fa fa-trash-o"></i>Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>

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
            <div class="clearfix">&nbsp;</div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#example4').DataTable({
            "order": [
                [5, "desc"]
            ]
        });
    }); 
	$(document).ready(function() {
        $('#example5').DataTable({
            "order": [
                [1, "desc"]
            ]
        });
    });
	

    function walletadmindeactive(id) {
        $(".popid").attr("href", "<?php echo base_url('wallet/status'); ?>" + "/" + id);
    }
	function walletadmindelete(id) {
        $(".popid").attr("href", "<?php echo base_url('wallet/delete'); ?>" + "/" + id);
    }
	function walletamt_admindelete(id) {
        $(".popid").attr("href", "<?php echo base_url('wallet/amt_delete'); ?>" + "/" + id);
    }	
	function wallet_amt_admindeactive(id){
        $(".popid").attr("href", "<?php echo base_url('wallet/amt_status'); ?>" + "/" + id);
    }
	
	

    function adminstatus(id) {
        if (id == 1) {
            $('#content1').html('Are you sure you want to deactivate?');

        }
        if (id == 0) {
            $('#content1').html('Are you sure you want to activate?');
        }
    }


    function adminstatus2(id) {

        $('#content1').html('Are you sure you want to delete?');

    }

    $(document).ready(function() {
        $('#coupon_post').bootstrapValidator({

            fields: {

                wallet_amount: {
                    validators: {
                        notEmpty: {
                            message: 'Wallet Amount is required'
                        },
                        regexp: {
                            regexp: /^[0-9. ]+$/,
                            message: 'Wallet Amount can only consist of digits'
                        }
                    }
                },
               ip_amount_percentage: {
                    validators: {
                        notEmpty: {
                            message: 'Ip amount percentage is required'
                        },
                         between: {
							min:0,
							max: 99,
							message: 'The Ip amount percentage must be between 0 and 99'
						}
                    }
                },
				op_amount_percentage: {
                    validators: {
                        notEmpty: {
                            message: 'OP amount percentage is required'
                        },
                         between: {
							min:0,
							max: 99,
							message: 'The OP amount percentage must be between 0 and 99'
						}
                    }
                },
				lab_amount_percentage: {
                    validators: {
                        notEmpty: {
                            message: 'Lab amount percentage is required'
                        },
                         between: {
							min:0,
							max: 99,
							message: 'The Lab amount percentage must be between 0 and 99'
						}
                    }
                },
                hospital_id: {
                    validators: {
                        notEmpty: {
                            message: 'Hospital Name is required'
                        }
                    }
                },
                type: {
                    validators: {
                        notEmpty: {
                            message: 'Type is required'
                        }
                    }
                }
            }
        })

    });
	$(document).ready(function() {
        $('#add_wallet_amt').bootstrapValidator({
			fields: {
				wallet_amount: {
                    validators: {
                        notEmpty: {
                            message: 'Wallet Amount is required'
                        },
                        regexp: {
                            regexp: /^[0-9. ]+$/,
                            message: 'Wallet Amount can only consist of digits'
                        }
                    }
                }
            }
        })

    });
</script>

