
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
						<form class=" pad30 form-horizontal" action="<?php echo base_url('resources/addvitalspost'); ?> " method="post"  id="vitals">
                                             <input type="hidden" id="pid" name="pid" value="<?php echo isset($patient_id)?$patient_id:''; ?>">
                                             <input type="hidden" id="b_id" name="b_id" value="<?php echo isset($bill_id)?$bill_id:''; ?>">
                                             <div class="table-responsive" >
											 <table class="table table-bordered ">
													<tr>
														<th class="text-center">Vitals</th>
														<th class="text-center">Actuals</th>
														<th class="text-center">Range</th>
													</tr>
													<tr>
														<th class="text-center">BP</th>
														<th class="text-center form-group"><input style="border-radius:0px;" type="text" name="bp" id="bp" class="form-control" value="<?php echo isset($vitals_detailes['bp'])?$vitals_detailes['bp']:''; ?>"></th>
														<th class="text-center">120/80</th>
													</tr>
													<tr>
														<th class="text-center">Pulse</th>
														<th class="text-center form-group"><input style="border-radius:0px;" type="text" name="pulse" id="pulse" class="form-control" value="<?php echo isset($vitals_detailes['pulse'])?$vitals_detailes['pulse']:''; ?>"></th>
														<th class="text-center">70-80</th>
													</tr>
													<tr>
														<th class="text-center">FBS/RBS</th>
														<th class="text-center form-group"><input style="border-radius:0px;" type="text" name="fbs_rbs" id="fbs_rbs" class="form-control" value="<?php echo isset($vitals_detailes['fbs_rbs'])?$vitals_detailes['fbs_rbs']:''; ?>"></th>
														<th class="text-center">70-110	</th>
													</tr>
													<tr>
														<th class="text-center">Temp</th>
														<th class="text-center form-group"><input style="border-radius:0px;" type="text" name="temp" id="temp" class="form-control" value="<?php echo isset($vitals_detailes['temp'])?$vitals_detailes['temp']:''; ?>"></th>
														<th class="text-center">98.6 F</th>
													</tr>
													<tr >
														<th class="text-center">Weight</th>
														<th class="text-center form-group"><input style="border-radius:0px;" type="text" name="weight" id="weight" class="form-control " value="<?php echo isset($vitals_detailes['weight'])?$vitals_detailes['weight']:''; ?>"></th>
														<th class="text-center"></th>
													</tr>
													
												</table>
                                               
                                             </div>
												 <div class="text-center">
													<button class="btn btn-priamry text-center" type="submit">Submit</button>
												 </div>
											
                                          </form>
				</div>
                
            </div>
        </div>
    </div>
</div>
<script>
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