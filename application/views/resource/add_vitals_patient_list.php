
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Add Vitals</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Add Vitals</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
				<div class="panel tab-border card-topline-yellow">
						 <div class="card-body table-responsive ">
                              <?php if(isset($patients_list) && count($patients_list)>0){ ?>
                              <table class="table table-striped table-bordered table-hover table-checkable order-column" id="example4">
                                 <thead>
                                    <tr>
                                       <th> Patient Id </th>
                                       <th> Patient card Number</th>
                                       <th> Name </th>
                                       <th> Type </th>
                                       <th> Category </th>
                                       <th> Age </th>
                                       <th> Mobile </th>
                                       <th> Action </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php foreach($patients_list as $list){ ?>
                                    <tr class="odd gradeX">
                                       <td> <?php echo $list['pid']; ?> </td>
                                       <td> <?php echo $list['card_number']; ?> </td>
                                       <td>
                                          <?php echo $list['name']; ?>
                                       </td>
                                       <td>
                                          <?php echo $list['registrationtype']; ?>
                                       </td>
                                       <td><?php echo $list['patient_category']; ?> </td>
                                       <td><?php echo $list['age']; ?> </td>
                                       <td><?php echo $list['mobile']; ?> </td>
                                       <td ><a href="<?php echo base_url('resources/addvital/'.base64_encode($list['pid'])); ?>">Add Vitals</a>
                                          
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
<script>

 $(document).ready(function() {
    $('#example4').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );
    $(document).ready(function() {

        $('#vitals').bootstrapValidator({
            fields: {
                
                bp: {
                    validators: {
                        notEmpty: {
                            message: 'Bp is required'
                        }
                    }
                },
				fbs_rbs: {
                    validators: {
                        notEmpty: {
                            message: 'FBS/RBS is required'
                        }
                    }
                },
				temp: {
                    validators: {
                        notEmpty: {
                            message: 'Temp is required'
                        }
                    }
                },
				weight: {
                    validators: {
                        notEmpty: {
                            message: 'weight is required'
                        }
                    }
                },
                
                pulse: {
                    validators: {
                        notEmpty: {
                            message: 'Pulse is required'
                        }
                    }
                }
            }
        })

    });
</script>