<?php
if(isset($total_admit_patients) && count($total_admit_patients)>0){
			foreach($total_admit_patients as $lis){
			$total_admit_patients_list[]=array("y" => isset($lis['count'])?$lis['count']:'', "label" => isset($lis['years'])?$lis['years']:'');
			
			}
		}else{
			$total_admit_patients_list[]=array();
		}
		if(isset($total_discharge_patients) && count($total_discharge_patients)>0){
			foreach($total_discharge_patients as $lis){
			$total_discharge_patients_list[]=array("y" => isset($lis['count'])?$lis['count']:'', "label" => isset($lis['years'])?$lis['years']:'');
			
			}
		}else{
			$total_discharge_patients_list[]=array();
		}
		
	
	 
     
    ?>
<script>
    window.onload = function () {
     
    var chart = new CanvasJS.Chart("chartContainer", {
    	title: {
    		text: "ADMIT / DISCHARGE STATISTICS"
    	},
    	axisY: {
    		title: " Count range"
    	},
		legend:{
		cursor:"pointer",
		dockInsidePlotArea: true,
		itemclick: toogleDataSeries
		},
    	data: [{
    		type: "spline",
			showInLegend: true,
			name: "Total Admit Patient List",
			lineDashType: "solid",
			color: "#8BC34A",			
    		dataPoints: <?php echo json_encode($total_admit_patients_list, JSON_NUMERIC_CHECK); ?>
    	},
		{
    		type: "spline",
			showInLegend: true,
			name: "Total Discharge Patient List",
			lineDashType: "solid",
			color: "#FF9800",			
    		dataPoints: <?php echo json_encode($total_discharge_patients_list, JSON_NUMERIC_CHECK); ?>
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
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Dashboard</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
            </ol>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="panel tab-border card-topline-green">
						<div class=" ">
                                <div class="card-head">
                                     <header>Dashboard</header>
                                  
                                </div>
                                  <div class="card-body no-padding height-9">
									<div class="row">
									       <div id="chartContainer" style="height: 300px; width: 100%;"></div>
									</div>
								</div>
								<div class="clearfix">&nbsp;</div>
											
                     </div>
         </div>
      </div>
   </div>
</div>
<div id="sucessmsg" style="display:none;"></div>
    	  <script src="<?php echo base_url(); ?>assets/vendor/plugins/canvasjs.min.js" ></script>

