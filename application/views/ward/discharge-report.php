<style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
	.div-cust{
		padding:2px 0px;
	}
    </style>
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Appointments</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Discharge Report<li>
            </ol>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="panel tab-border card-topline-green">
				 <div class="py-4">
				 <div class="row" style="padding:25px 0px 0px 25px;">
				 <div class="form-group col-md-6">
				
				  <input type="text" class="form-control"  name="first_name" id="first_name" placeholder="Enter Paitent ID" >
				</div> 
				<div class="form-group col-md-2">
				
				 <a href="" class="btn btn-primary btn-sm">View</a>
				</div>
				</div>
				</div>
						<div class=" ">
                                <div class="card-head">
                                     <header>Discharge Report</header>
                                  
                                </div>
                                <div class="card-body">
									<div class="invoice-box">
										<table cellpadding="0" cellspacing="0">
											<tr class="top" style="border-bottom:1px solid #ddd">
												<td colspan="2">
													<table>
														<tr>
															<td colspan="2" style="text-align:center;font-weight:600">
																<h2><strong>Discharge Report</strong></h2>
															</td>
															
															
														</tr>
													</table>
												</td>
												
											</tr>    
											
								   
										  
											<tr class="information" >
											
												<td colspan="2">
													<table >
														<tr>&nbsp;</tr>
														<tr>
															<td style="width:50%">
															   <div class="div-cust"> <strong>Name: </strong> Bayapureddy</div>
															   <div class="div-cust"> <strong>UHID: </strong> Ap123456</div>
															   <div class="div-cust"> <strong>Date of Admit: </strong> 18-Nov-2018</div>
															   <div class="div-cust"> <strong>Room / Ward: </strong> 201 / 1st Ward</div> 
															   <div class="div-cust"> <strong>Consultants: </strong> <br>
															   <ol style="margin-left:-20px;">
															   <li>DR.A.K.BAnerji ( NEUROSURGERY )</li>
															   <li>DR.Varindera Singh ( NEUROSURGERY )</li>
															   </ol>
															   </div>
															</td>
															 <td style="width:50%">
															   <div class="div-cust"> <strong>AGE / Sex: </strong> Bayapureddy</div>
															   <div class="div-cust"> <strong>IPNO: </strong> 321542</div>
															   <div class="div-cust"> <strong>Date of Discharge : </strong> 21-Nov-2018</div>
															   <div class="div-cust"> <strong>Unit : </strong> NEUROSURGERY</div>
															</td>
														</tr> 
														
													</table>
												</td>
											</tr>
											
											<tr class="">
												<td>
												<div style="margin-bottom:10px;">
												 <strong style="font-size:18px;border-bottom:2px solid #000;">DIAGNOSIS</strong>
												 </div>
												
												 <div class="div-cust">Posteriro Third Ventricle Ependymoa</div>
												 <div class="div-cust">Lorem Ipsum is simply dummy text </div>
												 <div class="div-cust">recently publishing </div>
												
												 
												</td>
											   
											</tr>
											<tr class="">
												<td>
												<div style="margin-bottom:10px;">
												 <strong style="font-size:18px;border-bottom:2px solid #000;">HISTORY</strong>
												 </div>
												
												 <div class="div-cust">Right side facial weakness - 1 month </div>
												 <div class="div-cust">Headache & Vomiting -20 days </div>
												 <div class="div-cust">Difficulty in walking & frequent falls - 15 days </div>
												</td>
											</tr>	
											<tr class="">
												<td>
												<div style="margin-bottom:10px;">
												 <strong style="font-size:18px;border-bottom:2px solid #000;">ON EXAMINATION</strong>
												 </div>
												
												 <div class="div-cust">Child - sick </div>
												 <div class="div-cust">BP- 100/60 mm </div>
												 <div class="div-cust">BP- 100/60 mm </div>
												 <div class="div-cust">BP- 100/60 mm </div>
												 <div class="div-cust">BP- 100/60 mm </div>
												 <div class="div-cust">BP- 100/60 mm </div>
									
												</td>
											</tr>
											
										   
										</table>
									</div>	
                                </div>
								<div class="clearfix">&nbsp;</div>
											
                     </div>
         </div>
      </div>
   </div>
</div>
<div id="sucessmsg" style="display:none;"></div>

