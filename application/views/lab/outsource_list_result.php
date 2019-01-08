

<?php //echo '<pre>';print_r($location_list);exit; ?>
<div class="page-content-wrapper">
   <div class="container" >
     <div class="row" id="result_search1">
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
												<label><h4 class="font-weight-bold">Location</h4></label>
												<?php if(isset($area_list) && count($area_list)>0){ ?>
														<div class="row">
															<?php foreach($location_list as $list){ ?>
																	<?php if (in_array($list, $area_list)){ ?>
																		<div class="col-md-6 pt-2">
																			<input checked onclick="locationsearch_result('<?php echo isset($patient_id)?$patient_id:''; ?>','<?php echo isset($billing_id)?$billing_id:''; ?>','<?php echo isset($list)?$list:''; ?>','uncheck');" type="checkbox" name="" value=""> &nbsp; <?php echo isset($list)?$list:''; ?>
																		</div>
																	<?php }else{ ?>
																		<div class="col-md-6 pt-2">
																			<input onclick="locationsearch_result('<?php echo isset($patient_id)?$patient_id:''; ?>','<?php echo isset($billing_id)?$billing_id:''; ?>','<?php echo isset($list)?$list:''; ?>','check');" type="checkbox" name="" value=""> &nbsp; <?php echo isset($list)?$list:''; ?>
																		</div>
																	<?php } ?>
															<?php }?>
														</div>
												<?php }else{ ?>
												<div class="row">
															<?php foreach($location_list as $list){ ?>

															<div class="col-md-6 pt-2">
																<input onclick="locationsearch('<?php echo isset($patient_id)?$patient_id:''; ?>','<?php echo isset($billing_id)?$billing_id:''; ?>','<?php echo isset($list)?$list:''; ?>','check');" type="checkbox" name="" value=""> &nbsp; <?php echo isset($list)?$list:''; ?>
															</div>
															<?php } ?>
														</div>
												<?php }?>
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
											 <table id="myTable" class="table-bordered">
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
															<?php if (in_array($list['id'], $out_source_list)) {?>
															<input  disabled type="checkbox" id="lab_id" name="lab_id[]" value="<?php echo $li['a_id'].'_'.$list['id']; ?>">
														<?php }else{ ?>
															<input type="checkbox" id="lab_id" name="lab_id[]" value="<?php echo $li['a_id'].'_'.$list['id']; ?>">
														<?php } ?>
														</td>
														<td>
														<?php echo isset($li['a_name'])?$li['a_name']:''; ?>
														</td>
														<td>
														<?php echo isset($li['t_name'])?$li['t_name'].',':''; ?>
														</td>
														<td>
														<?php echo isset($li['amuont'])?$li['amuont'].',':''; ?>
														</td>
														<td>
														<?php echo isset($li['duration'])?$li['duration'].',':''; ?></b>
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
	</div>
<script>
function locationsearch_result(p_id,b_id,location,types){

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
   					success: function (data) {
						$("#result_search1").empty();
						$("#result_search1").append(data);
					}
   				});
   				
   			
	
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



