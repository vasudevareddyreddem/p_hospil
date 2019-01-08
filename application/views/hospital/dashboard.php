<?php
$dec=$jan=$feb=$mar=$apr=$may=$jun=$jul=$aug=$sep=$oct=$nov=0;
if(isset($new_patients_list) && count($new_patients_list)>0){
foreach ($new_patients_list as $cri){
$dat = explode("-", $cri['create_at']);
	if($dat[1] == 12)
	{
	$dec++;
	}
	if($dat[1] == 11)
	{
		$nov++;
	}
	if($dat[1] == 10)
	{
		$oct++;
	}
	if($dat[1] == '09')
	{
		$sep++;
	}if($dat[1] == '08')
	{
		$aug++;
	}if($dat[1] == '07')
	{
		$jul++;
	}if($dat[1] == '06')
	{
		$jun++;
	}if($dat[1] == '05')
	{
		$may++;
	}if($dat[1] == 04)
	{
		$apr++;
	}if($dat[1] == 03)
	{
		$mar++;
	}if($dat[1] == 02)
	{
		$feb++;
	}if($dat[1] == 01)
	{
		$jan++;
	}
}	
} 
$dec1=$jan1=$feb1=$mar1=$apr1=$may1=$jun1=$jul1=$aug1=$sep1=$oct1=$nov1=0;
if(isset($reschudle_patients_list) && count($reschudle_patients_list)>0){
foreach ($reschudle_patients_list as $cri){
$dat = explode("-", $cri['create_at']);
	if($dat[1] == 12)
	{
	$dec1++;
	}
	if($dat[1] == 11)
	{
		$nov1++;
	}
	if($dat[1] == 10)
	{
		$oct1++;
	}
	if($dat[1] == '09')
	{
		$sep1++;
	}if($dat[1] == '08')
	{
		$aug1++;
	}if($dat[1] == '07')
	{
		$jul1++;
	}if($dat[1] == '06')
	{
		$jun1++;
	}if($dat[1] == '05')
	{
		$may1++;
	}if($dat[1] == 04)
	{
		$apr1++;
	}if($dat[1] == 03)
	{
		$mar1++;
	}if($dat[1] == 02)
	{
		$feb1++;
	}if($dat[1] == 01)
	{
		$jan1++;
	}
}	
} 
$dec2=$jan2=$feb2=$mar2=$apr2=$may2=$jun2=$jul2=$aug2=$sep2=$oct2=$nov2=0;
if(isset($patients_list) && count($patients_list)>0){
foreach ($patients_list as $cri){
$dat = explode("-", $cri['create_at']);
	if($dat[1] == 12)
	{
	$dec2++;
	}
	if($dat[1] == 11)
	{
		$nov2++;
	}
	if($dat[1] == 10)
	{
		$oct2++;
	}
	if($dat[1] == '09')
	{
		$sep2++;
	}if($dat[1] == '08')
	{
		$aug2++;
	}if($dat[1] == '07')
	{
		$jul2++;
	}if($dat[1] == '06')
	{
		$jun2++;
	}if($dat[1] == '05')
	{
		$may2++;
	}if($dat[1] == 04)
	{
		$apr2++;
	}if($dat[1] == 03)
	{
		$mar2++;
	}if($dat[1] == 02)
	{
		$feb2++;
	}if($dat[1] == 01)
	{
		$jan2++;
	}
}	
} 
    $new_patients = array(
    	array("y" => isset($jan)?$jan:'', "label" => "January"),
    	array("y" => isset($feb)?$feb:'', "label" => "February"),
    	array("y" => isset($mar)?$mar:'', "label" => "March"),
    	array("y" => isset($apr)?$apr:'', "label" => "April "),
    	array("y" => isset($may)?$may:'', "label" => "May"),
    	array("y" => isset($jun)?$jun:'', "label" => "June"),
    	array("y" => isset($jul)?$jul:'', "label" => "July"),
    	array("y" => isset($aug)?$aug:'', "label" => "August"),
    	array("y" => isset($sep)?$sep:'', "label" => "September"),
    	array("y" => isset($oct)?$oct:'', "label" => "October"),
    	array("y" => isset($nov)?$nov:'', "label" => "November"),
    	array("y" => isset($dec)?$dec:'', "label" => "December"),
    );  
	  $reschudle_patients = array(
    	array("y" => isset($jan1)?$jan1:'', "label" => "January"),
    	array("y" => isset($feb1)?$feb1:'', "label" => "February"),
    	array("y" => isset($mar1)?$mar1:'', "label" => "March"),
    	array("y" => isset($apr1)?$apr1:'', "label" => "April "),
    	array("y" => isset($may1)?$may1:'', "label" => "May"),
    	array("y" => isset($jun1)?$jun1:'', "label" => "June"),
    	array("y" => isset($jul1)?$jul1:'', "label" => "July"),
    	array("y" => isset($aug1)?$aug1:'', "label" => "August"),
    	array("y" => isset($sep1)?$sep1:'', "label" => "September"),
    	array("y" => isset($oct1)?$oct1:'', "label" => "October"),
    	array("y" => isset($nov1)?$nov1:'', "label" => "November"),
    	array("y" => isset($dec1)?$dec1:'', "label" => "December"),
    );
	$tottal_patient = array(
    	array("y" => isset($jan2)?$jan2:'', "label" => "January"),
    	array("y" => isset($feb2)?$feb2:'', "label" => "February"),
    	array("y" => isset($mar2)?$mar2:'', "label" => "March"),
    	array("y" => isset($apr2)?$apr2:'', "label" => "April "),
    	array("y" => isset($may2)?$may2:'', "label" => "May"),
    	array("y" => isset($jun2)?$jun2:'', "label" => "June"),
    	array("y" => isset($jul2)?$jul2:'', "label" => "July"),
    	array("y" => isset($aug2)?$aug2:'', "label" => "August"),
    	array("y" => isset($sep2)?$sep2:'', "label" => "September"),
    	array("y" => isset($oct2)?$oct2:'', "label" => "October"),
    	array("y" => isset($nov2)?$nov2:'', "label" => "November"),
    	array("y" => isset($dec2)?$dec2:'', "label" => "December"),
    ); 
     
    ?>

    <script>
    window.onload = function () {
     
    var chart = new CanvasJS.Chart("chartContainer", {
    	title: {
    		text: "Month wise Patients List"
    	},
    	axisY: {
    		title: "Patients count range"
    	},
		legend:{
		cursor:"pointer",
		showInLegend: true,
		dockInsidePlotArea: true,
		itemclick: toogleDataSeries
		},
    	data: [{
    		type: "spline",
			showInLegend: true,
			name: "New Patients",
			lineDashType: "dash", 
			color: "#00BFFF",
    		dataPoints: <?php echo json_encode($new_patients, JSON_NUMERIC_CHECK); ?>
    	},
		{
    		type: "spline",
			showInLegend: true,
			name: "Reschedule Patients",
			lineDashType: "dash",
			color: "#FF1493",			
    		dataPoints: <?php echo json_encode($reschudle_patients, JSON_NUMERIC_CHECK); ?>
    	},
		{
    		type: "spline",
			showInLegend: true,
			name: "Total Patients",
			lineDashType: "solid",
			color: "#0000FF",			
    		dataPoints: <?php echo json_encode($tottal_patient, JSON_NUMERIC_CHECK); ?>
    	}
		]
    });
    chart.render();
     function toogleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else{
		e.dataSeries.visible = true;
	}
	chart.render();
}
    }
    </script>
<div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Dashboard</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                   <!-- start widget -->
	                  <div class="row">
						<div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
							<div class="row ">            
			                    <div class="col-xl-4 col-md-6 col-12">
						          <div class="info-box bg-blue">
						            <span class="info-box-icon push-bottom"><i class="material-icons">group</i></span>
						            <div class="info-box-content">
						              <span class="info-box-text">New Patient Registration</span>
						              <span class="info-box-number"><?php if($newpatient_last_seven>0){ echo $newpatient_last_seven; }else{ echo "0"; }  ?></span>
						              <div class="progress">
						                <div class="progress-bar" style="width: <?php if($newpatient_last_seven>0){ echo $newpatient_last_seven; }else{ echo "0"; }  ?>%"></div>
						              </div>
						              <span class="progress-description">Last 7 days</span>
						            </div>
						            <!-- /.info-box-content -->
						          </div>
						          <!-- /.info-box -->
						        </div>
			                    <div class="col-xl-4 col-md-6 col-12">
						          <div class="info-box bg-orange">
						            <span class="info-box-icon push-bottom"><i class="material-icons">person</i></span>
						            <div class="info-box-content">
						              <span class="info-box-text">Total New Patient Registration</span>
						              <span class="info-box-number"><?php if($total_newpatient_list>0){ echo $total_newpatient_list; }else{ echo "0"; }  ?></span>
						              <div class="progress">
						                <div class="progress-bar" style="width: <?php if($total_newpatient_list>0){ echo $total_newpatient_list; }else{ echo "0"; }  ?>%"></div>
						              </div>
						              <span class="progress-description"><?php echo date('d-m-Y'); ?></span>
						            </div>
						            <!-- /.info-box-content -->
						          </div>
						          <!-- /.info-box -->
						        </div>
								<div class="col-xl-4 col-md-6 col-12">
						          <div class="info-box bg-purple">
						            <span class="info-box-icon push-bottom"><i class="material-icons">group</i></span>
						            <div class="info-box-content">
						              <span class="info-box-text">New Reschedule Patients</span>
						              <span class="info-box-number"><?php if($reschedule_last_seven>0){ echo $reschedule_last_seven; }else{ echo "0"; }  ?></span>
						              <div class="progress">
						                <div class="progress-bar" style="width: <?php if($reschedule_last_seven>0){ echo $reschedule_last_seven; }else{ echo "0"; }  ?>%"></div>
						              </div>
						              <span class="progress-description">Last 7 days</span>
						            </div>
						            <!-- /.info-box-content -->
						          </div>
						          <!-- /.info-box -->
						        </div>
			                </div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="row  ">            
			                    
			                    <div class="col-xl-4 col-md-6 col-12">
						          <div class="info-box bg-success">
						            <span class="info-box-icon push-bottom"><i class="material-icons">person</i></span>
						            <div class="info-box-content">
						              <span class="info-box-text">Total Reschedule patients</span>
						              <span class="info-box-number"><?php if($total_reschudle_patient_list>0){ echo $total_reschudle_patient_list; }else{ echo "0"; }  ?></span>
						              <div class="progress">
						                <div class="progress-bar" style="width: <?php if($total_reschudle_patient_list>0){ echo $total_reschudle_patient_list; }else{ echo "0"; }  ?>%"></div>
						              </div>
						              <span class="progress-description">&nbsp;</span>
						            </div>
						            <!-- /.info-box-content -->
						          </div>
						          <!-- /.info-box -->
						        </div>
								  <div class="col-xl-4 col-md-6 col-12">
						          <div class="info-box bg-indigo">
						            <span class="info-box-icon push-bottom"><i class="material-icons">group</i></span>
						            <div class="info-box-content">
						              <span class="info-box-text">Total Patients</span>
						              <span class="info-box-number"><?php if(count($patients_list)>0){ echo count($patients_list); }else{ echo "0"; }  ?></span>
						              <div class="progress">
						                <div class="progress-bar" style="width: <?php if(count($patients_list)>0){ echo count($patients_list); }else{ echo "0"; }  ?>%"></div>
						              </div>
						              <span class="progress-description">&nbsp;</span>
						            </div>
						            <!-- /.info-box-content -->
						          </div>
						          <!-- /.info-box -->
						        </div>
								<div class="col-xl-4 col-md-6 col-12">
						          <div class="info-box bg-warning">
						            <span class="info-box-icon push-bottom"><i class="material-icons">group</i></span>
						            <div class="info-box-content">
						              <span class="info-box-text">Total Modified prescriptions</span>
						              <span class="info-box-number"><?php if($prescriptions_list>0){ echo $prescriptions_list; }else{ echo "0"; }  ?></span>
						              <div class="progress">
						                <div class="progress-bar" style="width: <?php if($prescriptions_list>0){ echo $prescriptions_list; }else{ echo "0"; }  ?>%"></div>
						              </div>
						              <span class="progress-description">&nbsp;</span>
						            </div>
						            <!-- /.info-box-content -->
						          </div>
						          <!-- /.info-box -->
						        </div>
			                </div>
						</div>
					
						 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="card card-box">
                              <div class="card-head">
                                  <header>Patients SURVEY</header>
                                 
                              </div>
                              <div class="">
								    <div id="chartContainer" ></div>

							</div>
                          </div>
				            </div>
			        	</div>
					
                    
                </div>
				
			
            </div>
			
		

    	  <script src="<?php echo base_url(); ?>assets/vendor/plugins/canvasjs.min.js" ></script>

    
                              


