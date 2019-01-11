<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>bill</title>
  </head>
  <style>
	@font-face {
  font-family: SourceSansPro;
  src: url(SourceSansPro-Regular.ttf);
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #0087C3;
  text-decoration: none;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #555555;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 14px; 
  font-family: SourceSansPro;
}

header {
  padding: 10px 0;
  margin-bottom: 20px;
  border-bottom: 1px solid #AAAAAA;
}



#details {
  margin-bottom: 50px;
}

#client {
  padding-left: 6px;
  border-left: 6px solid #0087C3;
  float: left;
}

#client .to {
  color: #777777;
}

h2.name {
  font-size: 1.4em;
  font-weight: normal;
  margin: 0;
}
#notices{
  padding-left: 6px;
  border-left: 6px solid #0087C3;  
}

#notices .notice {
  font-size: 1.2em;
}

footer {
  color: #777777;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #AAAAAA;
  padding: 8px 0;
  text-align: center;
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
	padding:10px;
}


	</style>
  <body>
    <header class="clearfix">
      
      <div  style="float:left;width:200px">
        <img style="width:auto;height:100px;" src="<?php echo base_url('assets/hospital_logos/'.$details['hos_bas_logo']); ?>">
      </div>
      <div style="float:right;width:200px">
        <h2 class="name"><?php echo isset($details['hos_bas_name'])?$details['hos_bas_name']:''; ?></h2>
        <div>
		<?php echo isset($details['hos_bas_add1'])?$details['hos_bas_add1']:''; ?>,
		<?php echo isset($details['hos_bas_add2'])?$details['hos_bas_add2']:''; ?>,
		<?php echo isset($details['hos_bas_city'])?$details['hos_bas_city']:''; ?>,
		<?php echo isset($details['hos_bas_state'])?$details['hos_bas_state']:''; ?>,
		<?php echo isset($details['hos_bas_country'])?$details['hos_bas_country']:''; ?>,
		<?php echo isset($details['hos_bas_zipcode'])?$details['hos_bas_zipcode']:''; ?>
		</div>
        <div><?php echo isset($details['hos_con_number'])?$details['hos_con_number']:''; ?></div>
        <div><a href="mailto:company@example.com"><?php echo isset($details['hos_bas_email'])?$details['hos_bas_email']:''; ?></a></div>
      </div>
      
    </header>
	
 
	<table style="width:100%">
	  <tr style="background:#ddd;line-height:40px">
		<th colspan="4">Patient info</th>
		
	  </tr>
	
	  <tr>
		<td><strong>Name:</strong> <span><?php echo isset($details['name'])?$details['name']:''; ?></span></td>
		<td><strong>Mobile:</strong> <span><?php echo isset($details['mobile'])?$details['mobile']:''; ?></span></td>
		<td><strong>Blood group:</strong> <span><?php echo isset($details['bloodgroup'])?$details['bloodgroup']:''; ?></span></td>
				<td><strong>Age:</strong> <span><?php echo isset($details['age'])?$details['age']:''; ?></span></td>

	  </tr>
	    <tr>
		<td colspan="4"><strong>Address:</strong> <span>
		<?php echo isset($details['perment_address'])?$details['perment_address']:''; ?>
		</span></td>
	
		
	  </tr> 
	
		<tr style="background:#ddd;line-height:40px">
		<th colspan="4">Bill Info</th>
		
	  </tr>
	  <tr>
		<td><strong>Total Amount:</strong> <span><?php echo isset($details['patient_payer_deposit_amount'])?$details['patient_payer_deposit_amount']:''; ?></span></td>
		<td><strong>Payment mode:</strong> <span><?php echo isset($details['payment_mode'])?$details['payment_mode']:''; ?></span></td>
		<td colspan="2"><strong>Received from:</strong> <span><?php echo isset($details['received_form'])?$details['received_form']:''; ?></span></td>
	  </tr>
	
		
	</table>
	
	 <table style="width:100%">
	 <tr style="background:#ddd;line-height:40px">
		<th colspan="4">Doctor Name and Department</th>
		</tr>
		<tr>
		<td colspan="2"><strong>Doctor Name:</strong> <span><?php echo isset($details['resource_name'])?$details['resource_name']:''; ?></span></td>
		<td colspan="2"><strong>Department Name:</strong> <span><?php echo isset($details['t_name'])?$details['t_name']:''; ?></span></td>
	  </tr>
	   </table>
   
  </body>
</html>