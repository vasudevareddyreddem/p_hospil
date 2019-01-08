<head>
    <link href="<?php echo base_url(); ?>assets/vendor/css/nouislider.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url(); ?>assets/vendor/plugins/nouislider.js"></script>
</head>
<style>
#myInput {
  background-image: url('<?php echo base_url(); ?>assets/vendor/img/search.png');
  background-position: 5px 5px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 4px 20px 4px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 14px;
}

#myTable th, #myTable td {
  text-align: left;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}
#input-select,
#input-number {
	padding: 7px;
	margin: 15px 5px 5px;
	width: 70px;
}
</style>
<?php //echo '<pre>';print_r($location_list);exit; ?>
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Outsource Test List</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Outsource Test List</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel tab-border card-topline-green">
                    <header class="panel-heading panel-heading-gray custom-tab ">
                        <ul class="nav nav-tabs">
                            <li class="nav-item "><a href="#home" data-toggle="tab" class="<?php if(isset($tab) && $tab=='' || $tab==1){ echo " active"; } ?>" aria-expanded="false">Select One</a>
                            </li>
                            <li class="nav-item"><a href="#about" data-toggle="tab" class="" aria-expanded="false">Procurement</a>
                            </li>
                            <li class="nav-item"><a href="#bidding_accept" data-toggle="tab" class="<?php if(isset($tab) && $tab==3){ echo " active"; } ?>" aria-expanded="false">Procurement Accept</a>
                            </li>

                        </ul>
                    </header>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane <?php if(isset($tab) && $tab=='' || $tab==1){ echo " active"; } ?>" id="home" aria-expanded="false">
                                <div class="row" id="result_search">
                                    <div class="col-md-4  py-3">

                                        <h3 class="font-weight-bold ">Filters</h3>
                                        <hr>
                                        <!--<div class="price-help-class">
													<label><h4 class="font-weight-bold">Price Range</h4></label>
													<div class="example">
															<div id="html5"></div>
															<select id="input-select"></select>
															<input class="pull-right" type="number" min="-20" max="40" step="1" id="input-number">
													</div>
												</div>-->
                                        <div class="location-help-class pt-4">
                                            <label>
                                                <h4 class="font-weight-bold">Location</h4>
                                            </label>
                                            <div class="row">
                                                <?php foreach($location_list as $list){ ?>

                                                <div class="col-md-6 pt-2">
                                                    <input onclick="locationsearch('<?php echo isset($patient_id)?$patient_id:''; ?>','<?php echo isset($billing_id)?$billing_id:''; ?>','<?php echo isset($list)?$list:''; ?>','check');" type="checkbox" name="" value=""> &nbsp;
                                                    <?php echo isset($list)?$list:''; ?>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <!--<div class="duration-help-class pt-4">
												<label><h3>Duration</h3></label>
														<div class="row">
															<div class="col-md-4 pt-2">
																<input type="checkbox" name="" value=""> &nbsp; 10 min
															</div>
															<div class="col-md-4 pt-2">
																<input type="checkbox" name="" value=""> &nbsp; 30 min
															</div>
														</div>
												</div>-->


                                    </div>
                                    <div class="col-md-8  py-3">
                                        <div class="clearfix">&nbsp;</div>
                                        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
                                        
                                        <form action="<?php echo base_url('lab/select_out_source_test'); ?>" method="POST">
                                            <input type="hidden" name="patient_id" id="patient_id" value="<?php echo isset($patient_id)?$patient_id:''; ?>">
                                            <input type="hidden" name="billing_id" id="billing_id" value="<?php echo isset($billing_id)?$billing_id:''; ?>">
                                            <table class="table-bordered" id="myTable">
                                                <tr class="header">
                                                    <th style="">Select</th>
                                                    <th style="">Lab Name</th>
                                                    <th style="">Name of the Test</th>
                                                    <th style="">Amount</th>
                                                    <th style="">Duration</th>
                                                    <th style="">Address</th>
                                                </tr>

                                                <?php if(isset($test_list) && count($test_list)>0){ ?>
                                                <?php foreach($test_list as $list){ 
													
													//echo '<pre>';print_r($list);exit;
													?>
                                                <?php foreach($list['lab_adress'] as $li){ ?>
                                                <tr>
                                                    <td>
                                                        <?php if (in_array($li['t_id'], $out_source_list)) {?>
                                                        <input disabled type="checkbox" id="lab_id" name="lab_id[]" value="<?php echo $li['a_id'].'_'.$list['t_id']; ?>">
                                                        <?php }else{ ?>
                                                        <input type="checkbox" id="lab_id" name="lab_id[]" value="<?php echo $li['a_id'].'_'.$list['t_id']; ?>">
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php echo isset($li['a_name'])?$li['a_name']:''; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo isset($li['t_name'])?$li['t_name']:''; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo isset($li['amuont'])?$li['amuont']:''; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo isset($li['duration'])?$li['duration']:''; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo isset($li['resource_add1'])?$li['resource_add1'].',':''; ?>
                                                        <?php echo isset($li['resource_add2'])?$li['resource_add2'].',':''; ?>
                                                        <?php echo isset($li['resource_city'])?$li['resource_city'].',':''; ?>
                                                        <?php echo isset($li['resource_state'])?$li['resource_state'].',':''; ?>
                                                        <?php echo isset($li['resource_zipcode'])?$li['resource_zipcode']:''; ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                <?php } ?>
                                                <?php } ?>


                                            </table>
                                            <div class="clearfix">&nbsp;</div>
                                            <button type="submit" class="btn btn-primary ">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="about" aria-expanded="false">
                                <div class="row justify-content-center">
                                    <div class="col-md-8  card">
                                        <form action="<?php echo base_url('lab/sendbid'); ?>" method="POST" onsubmit="return validations();">
                                            <input type="hidden" name="patient_id" id="patient_id" value="<?php echo isset($patient_id)?$patient_id:''; ?>">
                                            <input type="hidden" name="billing_id" id="billing_id" value="<?php echo isset($billing_id)?$billing_id:''; ?>">

                                            <div class="panel-heading ">
                                                <h3 class="font-weight-bold text-center">Send for Procurement</h3>
                                            </div>
                                            <table id="myTable">
                                                <tr class="header">
                                                    <th style="width:100%;"><input type="checkbox" name="checkall" class="select-checkall" onchange="checkAll(this)" value="" value="">&nbsp;Name of the test</th>

                                                </tr>
                                                <?php if(isset($test_list) && count($test_list)>0){

															//echo '<pre>';print_r($test_list);exit;?>
                                                <?php foreach($test_list as $li){ ?>
                                                <tr>
                                                    <td>

                                                        <input type="checkbox" class="checkcheckbox" id="test_id" name="test_id[]" value="<?php echo $li['t_id'].'_'.$li['id']; ?>">
                                                        <b>Test Name :
                                                            <?php echo isset($li['t_name'])?$li['t_name']:''; ?></b>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                <?php } ?>


                                            </table>

                                            <div class="clearfix">&nbsp;</div>
                                            <button class="btn btn-primary "> Send for Procurement</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane <?php if(isset($tab) && $tab==3){ echo " active"; } ?>" id="bidding_accept" aria-expanded="false">
                                <?php if(isset($bidding_test_list) && count($bidding_test_list)>0){ ?>
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="example4">
                                    <thead>
                                        <tr>
                                            <th> Test Name </th>
                                            <th> Date & Time </th>
                                            <th> Amount</th>
                                            <th> Duration </th>
                                            <th> Status </th>
                                            <th> Action </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($bidding_test_list as $list){ ?>
                                        <tr class="odd gradeX">
                                            <td>
                                                <?php echo $list['t_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $list['create_at']; ?>
                                            </td>
                                            <td> <input type="text" name="amount" id="amount" value="<?php echo $list['amount']; ?>" required> </td>
                                            <td> <input type="text" name="duration" id="duration" value="<?php echo $list['duration']; ?>" required> </td>
                                            <td>
                                                <?php if($list['status']==1){ echo "Initiate"; }else if($list['status']==2){ echo "Accept"; }else if($list['status']==3){ echo "Decline"; }else if($list['status']==4){ echo "Approved"; }else{"";} ?>
                                            </td>

                                            <td>
                                                <?php if($list['status']==2){ ?>
                                                <a href="<?php echo base_url('lab/bidding_approved/'.base64_encode($list['id']).'/'.base64_encode($patient_id).'/'.base64_encode($billing_id)); ?>">Approve
                                                    <?php } ?>
                                                    <?php if($list['status']==4){ ?>
                                                    <a href="<?php echo base_url('lab/bidding_approved/'.base64_encode($list['id']).'/'.base64_encode($patient_id).'/'.base64_encode($billing_id).'/'.base64_encode(22)); ?>">Change
                                                        <?php } ?>
                                            </td>

                                        </tr>

                                        <?php } ?>

                                    </tbody>
                                </table>
                                <?php }else{ ?>
                                <div>No data available</div>
                                <?php } ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        function checkAll(ele) {
            var checkboxes = document.getElementsByClassName('checkcheckbox');
            if (ele.checked) {
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].type == 'checkbox') {
                        checkboxes[i].checked = true;
                    }
                }
            } else {
                for (var i = 0; i < checkboxes.length; i++) {
                    console.log(i)
                    if (checkboxes[i].type == 'checkbox') {
                        checkboxes[i].checked = false;
                    }
                }
            }
        }

        function validations() {
            var check = document.getElementById('test_id').checked;
            if (check == false) {
                alert('Please select atleast one option.');
                return false;
            }
        }

        function locationsearch(p_id, b_id, location, types) {
            if (p_id != '' && b_id != '' && location != '') {
                jQuery.ajax({
                    url: "<?php echo site_url('lab/location_search');?>",
                    data: {
                        patient_id: p_id,
                        billing_id: b_id,
                        location_name: location,
                        post_type: types,
                    },
                    dataType: 'html',
                    type: 'POST',
                    success: function(data) {
                        $("#result_search").empty();
                        $("#result_search").append(data);
                    }
                });
            }

        }

        function myFunction() {
            var input, filter, table, tr, td, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
    <script>
        /*
        var select = document.getElementById('input-select');

        // Append the option elements
        for ( var i = -20; i <= 40; i++ ){

        	var option = document.createElement("option");
        		option.text = i;
        		option.value = i;

        	select.appendChild(option);
        }

        var html5Slider = document.getElementById('html5');

        noUiSlider.create(html5Slider, {
        	start: [ 10, 30 ],
        	connect: true,
        	range: {
        		'min': -20,
        		'max': 40
        	}
        });

        var inputNumber = document.getElementById('input-number');

        html5Slider.noUiSlider.on('update', function( values, handle ) {

        	var value = values[handle];

        	if ( handle ) {
        		inputNumber.value = value;
        	} else {
        		select.value = Math.round(value);
        	}
        });

        select.addEventListener('change', function(){
        	html5Slider.noUiSlider.set([this.value, null]);
        });

        inputNumber.addEventListener('change', function(){
        	html5Slider.noUiSlider.set([null, this.value]);
        });
        */
    </script>