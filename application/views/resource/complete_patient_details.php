<html>
    
    <head></head>
    
    <body style="width: 80%; margin-left: 10%;">
        
        <!-- Logo & Address Start here -->
        <?php if(isset($patient_details) && count($patient_details)>0){ ?>
        <table style="width: 100%;">
            <tr>
                <td style="width: 20%;">
				<?php if(isset($patient_details['hos_bas_logo']) && $patient_details['hos_bas_logo']!=''){ ?>
                    <img src="<?php echo base_url('assets/hospital_logos/'.$patient_details['hos_bas_logo']); ?> " alt="<?php echo isset($patient_details['hos_bas_logo'])?$patient_details['hos_bas_logo']:''; ?>" width="150px" height="auto" style=""/>
				<?php }else{ ?>
				    <img src="<?php echo base_url('assets/vendor/img/logo.png'); ?>" alt="Logo" width="150px" height="auto" style=""/>
				<?php } ?>
                </td>
                <td style="width: 60%;"></td>
                <td style="width: 20%;">
                    <h3 style="margin-top: 5px; margin-bottom: 5px;"><?php echo isset($patient_details['hos_bas_name'])?$patient_details['hos_bas_name']:''; ?></h3>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><?php echo isset($patient_details['hos_bas_add1'])?$patient_details['hos_bas_add1']:''; ?></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><?php echo isset($patient_details['hos_bas_add2'])?$patient_details['hos_bas_add2']:''; ?></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><?php echo isset($patient_details['hos_bas_city'])?$patient_details['hos_bas_city']:''; ?></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><?php echo isset($patient_details['hos_bas_state'])?$patient_details['hos_bas_state']:''; ?></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;"><?php echo isset($patient_details['hos_bas_country'])?$patient_details['hos_bas_country']:''; ?></p>
					 <p style="margin-top: 5px; margin-bottom: 5px;"><?php echo isset($patient_details['hos_bas_zipcode'])?$patient_details['hos_bas_zipcode']:''; ?></p>

                    <p style="margin-top: 5px; margin-bottom: 5px;">Phone Number : <?php echo isset($patient_details['hos_bas_contact'])?$patient_details['hos_bas_contact']:''; ?></p>
                    <p style="margin-top: 5px; margin-bottom: 5px;">Email Address : <?php echo isset($patient_details['hos_bas_email'])?$patient_details['hos_bas_email']:''; ?></p>
                </td>
            </tr>
        </table>
		<?php } ?>
        
        <!-- //Logo & Address End here -->
        
        
        <br><hr><br>
        
        
        <!-- Patient Info -->
        
        <table style="width: 100%">
        
            <tr>
			<?php if(isset($patient_details) && count($patient_details)>0){ ?>
                <td style="width: 40%;">
                    
                    <!-- Patient Info Start here -->
                    
                    <table style="width: 100%; border-collapse: collapse;" border="1" cellpadding="10px">
                        <tr style="background-color: #b0c4de; font-size: 19px;">
                            <th colspan="2">Patient Info</th>
                        </tr>
                        <tr>
                            <td><b>Name</b></td>
                            <td><?php echo isset($patient_details['name'])?$patient_details['name']:''; ?></td>
                        </tr>
                        <tr>
                            <td><b>Mobile</b></td>
                            <td><?php echo isset($patient_details['mobile'])?$patient_details['mobile']:''; ?></td>
                        </tr>
                        <tr>
                            <td><b>Blood Group</b></td>
                            <td><?php echo isset($patient_details['bloodgroup'])?$patient_details['bloodgroup']:''; ?></td>
                        </tr>
                        <tr>
                            <td><b>Age</b></td>
                            <td><?php echo isset($patient_details['age'])?$patient_details['age']:''; ?></td>
                        </tr>
                        <tr>
                            <td><b>Address</b></td>
                            <td><?php echo isset($patient_details['perment_address'])?$patient_details['perment_address']:''; ?></td>
                        </tr>
                    </table>
                    
                    <!-- Patient Info End here -->
                </td>
				<?php } ?>
                
                <td style="width: 20%">&nbsp;</td>
                <?php if(isset($patient_vitals_list) && count($patient_vitals_list)>0){ ?>
                <td style="width: 40%;">
                    
                    <!-- Vitals Start here -->
                    
                    <table style="width: 100%; border-collapse: collapse;" border="1" cellpadding="10px">
                        <tr style="background-color: #b0c4de; font-size: 19px;">
                            <th colspan="2">Vitals</th>
                        </tr>
                        <tr>
                            <td><b>BP</b></td>
                            <td><?php echo isset($patient_vitals_list['bp'])?$patient_vitals_list['bp']:''; ?></td>
                        </tr>
                        <tr>
                            <td><b>Pulse</b></td>
                            <td><?php echo isset($patient_vitals_list['pulse'])?$patient_vitals_list['pulse']:''; ?></td>
                        </tr>
                        <tr>
                            <td><b>FBS / RBS</b></td>
                            <td><?php echo isset($patient_vitals_list['fbs_rbs'])?$patient_vitals_list['fbs_rbs']:''; ?></td>
                        </tr>
                        <tr>
                            <td><b>Temp</b></td>
                            <td><?php echo isset($patient_vitals_list['temp'])?$patient_vitals_list['temp']:''; ?></td>
                        </tr>
                        <tr>
                            <td><b>Weight</b></td>
                            <td><?php echo isset($patient_vitals_list['weight'])?$patient_vitals_list['weight']:''; ?></td>
                        </tr>
                    </table>
                    
                    <!-- Vitals End here -->
                </td>
				<?php } ?>
            </tr>
        </table>
        
        <!-- //Patient Info -->
        
        <br><hr>
        	<?php if(isset($patient_medicine_list[0]['directions']) && $patient_medicine_list[0]['directions']!=''){ ?>
        <h2>Diagonsis</h2>
		<?php foreach($patient_medicine_list as $list){ ?>
               <p><?php echo isset($list['directions'])?$list['directions']:''; ?></p>
				<?php } ?>
        
        
        <br><hr><br>
		<?php } ?>
        
        
        <!-- Patient Info Start here-->
		<?php //echo '<pre>';print_r($patient_medicine_list);exit; ?>
        <?php if(isset($patient_medicine_list) && count($patient_medicine_list)>0){ ?>
        <table style="width: 100%; border-collapse: collapse;" border="1" cellpadding="10px">
            <thead>
                <tr style="background-color: #b0c4de; font-size: 19px;">
                    <th colspan="6">Medication Details</th>
                </tr>
            </thead>
            <tbody>
                <tr style="text-align: center;">
                    <td><b>Medicine Name</b></td>
                    <td><b>Expiry Date</b></td>
                    <td><b>Batch Number</b></td>
                    <td><b>QTY</b></td>
                    <td><b>Amount</b></td>
                    <td><b>Total Amount</b></td>
                </tr> 
				<?php foreach($patient_medicine_list as $list){ ?>
                <tr>
                    <td><?php echo isset($list['medicine_name'])?$list['medicine_name']:''; ?></td>
                    <td><?php echo isset($list['expiry_date'])?$list['expiry_date']:''; ?></td>
                    <td><?php echo isset($list['batchno'])?$list['batchno']:''; ?></td>
                    <td><?php echo isset($list['qty'])?$list['qty']:''; ?></td>
                    <td><?php echo isset($list['amount'])?$list['amount']:''; ?></td>
                    <td><?php echo isset($list['org_amount'])?$list['org_amount']:''; ?></td>
                  
                </tr>
				<?php } ?>
            </tbody>
          
        </table>
        
        <!-- //Patient Info End here  -->
        
        
        <br><br>
		<?php } ?>
        
         <?php if(isset($patient_investigation_list) && count($patient_investigation_list)>0){ ?>
        <!-- Lab Details Start here-->
        
        <table style="width: 100%; border-collapse: collapse;" border="1" cellpadding="10px">
            <thead>
                <tr style="background-color: #b0c4de; font-size: 19px;">
                    <th colspan="6">Investigation</th>
                </tr>
            </thead>
            <tbody>
                <tr style="text-align: center;">
                    <td><b>Type</b></td>
                    <td><b>Test Type</b></td>
                    <td><b>Test Name</b></td>
                </tr>
				<?php foreach($patient_investigation_list as $list){ ?>				
					<tr>
						<td><?php echo isset($list['type'])?$list['type']:''; ?></td>
						<td><?php echo isset($list['test_type'])?$list['test_type']:''; ?></td>
						<td><?php echo isset($list['t_name'])?$list['t_name']:''; ?></td>
					</tr>
				<?php } ?>
            </tbody>
        </table>
		 <?php } ?>
        
        <!-- //Lab Details End here  -->
        
        
        <br><br>
        
    </body>
    
</html>