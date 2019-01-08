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
		<td><strong>Marital status:</strong> <span><?php echo isset($details['martial_status'])?$details['martial_status']:''; ?></span></td>
	  </tr>
	    <tr>
		<td><strong>DOB:</strong> <span><?php echo isset($details['dob'])?$details['dob']:''; ?></span></td>
		<td><strong>Age:</strong> <span><?php echo isset($details['age'])?$details['age']:''; ?></span></td>
		<td colspan="2"><strong>Address:</strong> <span>
		<?php echo isset($details['perment_address'])?$details['perment_address'].',':''; ?>
		<?php echo isset($details['p_c_name'])?$details['p_c_name'].',':''; ?>
		<?php echo isset($details['p_s_name'])?$details['p_s_name'].',':''; ?>
		<?php echo isset($details['p_country_name'])?$details['p_country_name'].',':''; ?>
		<?php echo isset($details['p_zipcode'])?$details['p_zipcode'].',':''; ?>
		</span></td>
	
		
	  </tr>   
	 
	  <tr style="background:#ddd;line-height:40px">
		<th colspan="4">Visit Info</th>
		
	  </tr>
	   <tr>
		<td><strong>Visit Number:</strong> <span><?php echo isset($details['visit_no'])?$details['visit_no']:''; ?></span></td>
		<td><strong>Visit description:</strong> <span><?php echo isset($details['visit_desc'])?$details['visit_desc']:''; ?></span></td>
		<td><strong>Date of visit:</strong> <span><?php echo isset($details['date_of_visit'])?$details['date_of_visit']:''; ?></span></td>
		<td><strong>Department:</strong> <span><?php echo isset($details['department'])?$details['department']:''; ?></span></td>
	  </tr>
	  <tr>
		<td><strong>Doctor:</strong> <span><?php echo isset($details['docotr_name'])?$details['docotr_name']:''; ?></span></td>
		<td><strong>No- of visits:</strong> <span><?php echo isset($details['no_of_visits'])?$details['no_of_visits']:''; ?></span></td>
		<td><strong>Last visit date:</strong> <span><?php echo isset($details['last_visiting_date'])?$details['last_visiting_date']:''; ?></span></td>
		<td></td>
	  </tr>
	  <tr style="background:#ddd;line-height:40px">
		<th colspan="4">Order Info</th>
		
	  </tr>
	  <tr>
		<td><strong>Service type:</strong> <span><?php echo isset($details['service_type'])?$details['service_type']:''; ?></span></td>
		<td><strong>Service:</strong> <span><?php echo isset($details['service'])?$details['service']:''; ?></span></td>
		<td><strong>Visit type:</strong> <span><?php echo isset($details['visit_type'])?$details['visit_type']:''; ?></span></td>
		<td><strong>Doctor:</strong> <span><?php echo isset($details['doctor'])?$details['doctor']:''; ?></span></td>
	  </tr>
	  <tr>
		<td><strong>Payer:</strong> <span><?php echo isset($details['payer'])?$details['payer']:''; ?></span></td>
		<td><strong>Price:</strong> <span><?php echo isset($details['price'])?$details['price']:''; ?></span></td>
		<td><strong>Qty:</strong> <span><?php echo isset($details['qty'])?$details['qty']:''; ?></span></td>
		<td><strong>Amount:</strong> <span><?php echo isset($details['amount'])?$details['amount']:''; ?></span></td>
	  </tr>
	  <tr>
		<td colspan="4"><strong>Bill:</strong> <span><?php echo isset($details['bill'])?$details['bill']:''; ?></span></td>
		</tr>
		<tr style="background:#ddd;line-height:40px">
		<th colspan="5">Bill Info</th>
		
	  </tr>
	  <tr>
		<td><strong>Patient amount / payer amount / deposit:</strong> <span><?php echo isset($details['patient_payer_deposit_amount'])?$details['patient_payer_deposit_amount']:''; ?></span></td>
		<td><strong>Payment mode:</strong> <span><?php echo isset($details['payment_mode'])?$details['payment_mode']:''; ?></span></td>
		<td><strong>Amount:</strong> <span>
		<?php if($details['coupon_code']!=''){ ?>
			<?php echo isset($details['with_out_coupon_code'])?$details['with_out_coupon_code']:''; ?>  <?php echo $amt = (($details['coupon_code_amount']) - ($details['with_out_coupon_code'])); ?> : <?php echo isset($details['coupon_code_amount'])?$details['coupon_code_amount']:''; ?>
		<?php }else{ ?>
			<?php echo isset($details['bill_amount'])?$details['bill_amount']:''; ?>
		<?php } ?>
		</span></td>
		<td><strong>Received from:</strong> <span><?php echo isset($details['received_form'])?$details['received_form']:''; ?></span></td>
	  </tr>
	  <?php if($details['coupon_code']!=''){ ?>
	  <tr>
		<td colspan="2"><strong>Coupon code:</strong> <span><?php echo isset($details['coupon_code'])?$details['coupon_code']:''; ?></span></td>
		<td colspan="2"><strong>Coupon code Status:</strong> <span>Applied</span></td>
		</tr>
	  <?php } ?>
	  <tr style="background:#ddd;line-height:40px">
		<th colspan="4">Payer Auth Info</th>
		
	  </tr>
	   <tr>
		<td colspan="4"><strong>Sign with payer:</strong> <span></span></td>
	  </tr>
	  
	</table>
   
  </body>
</html>