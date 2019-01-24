<head>
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

<title>Patient List</title>

</head>
<style>
.dataTables_wrapper .dt-buttons {
    float: left;
}
.dt-buttons button{
	background-color: #188ae2 !important;
    border: 1px solid #188ae2 !important;
    color: #fff !important;
	width:100px;
}
.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 0px;
}
</style>

<div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
			  <div class="page-title-breadcrumb">
				 <div class=" pull-left">
					<div class="page-title">Reports</div>
				 </div>
				 <ol class="breadcrumb page-breadcrumb pull-right">
					<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="#">Hospital</a>&nbsp;<i class="fa fa-angle-right"></i>
					</li>
					<li><a class="parent-item active" >Reports</a>&nbsp;</i>
					</li>
				 </ol>
			  </div>
		   </div>
					<div class="row">
                       <div class="col-md-12">
                            <div class="card card-topline-aqua">
							
                                <div class="card-head">
                                <div class="row sm-hide">
                                     <header class="col-md-6 pull-left" >Reports</header>
									
                                    <div class="col-md-6 " style="position:absolute;right:30px;top:10px;">
									<form id="fm_filters" action="<?php echo base_url('hospital/reports'); ?>" method="post">
								   <div class="row">
								   <div class="col-md-5 form-group">
                                        <input class="form-control" name="from_date" id="from_date"  type="date" placeholder="From Date : 1992-07-14" value="<?php echo isset($search_list['from_date'])?$search_list['from_date']:''; ?>">
                                    </div>
								   <div class="col-md-5 form-group">
                                        <input class="form-control" name="to_date" id="to_date"  type="date" placeholder="From Date : 1993-07-14" value="<?php echo isset($search_list['to_date'])?$search_list['to_date']:''; ?>">
                                    </div>
									   
								 
									
									<div class="col-md-2">
                                        <button type="submit" class="btn btn-primary btn-sm">Filter</div>
                                    </div>
									</form>
                                    </div>
									 </div>
                                </div>
                                
                                <div class="card-body table-responsive">
	<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
               <td>Patient ID</td>
                <td>Name</td>
                <td>Age</td>
                <td>Doctor </td>
                <td>Visit Type</td>
                <td>Date of Visit</td>
                <td>Total Fee</td>
            </tr>
        </thead>
        <tbody>
		<?php foreach($patients_list as $list){ ?>
            <tr>
                <td><?php echo isset($list['pid'])?$list['pid']:''; ?></td>
                <td><?php echo isset($list['name'])?$list['name']:''; ?></td>
                <td><?php echo isset($list['age'])?$list['age']:''; ?></td>
                <td><?php echo isset($list['resource_name'])?$list['resource_name']:''; ?></td>
                <td><?php if($list['patient_type']==0){ echo "OP";}else{ echo "IP"; } ?></td>
                <td><?php echo isset($list['create_at'])?$list['create_at']:''; ?></td>
                <td><?php echo isset($list['total_amt'])?$list['total_amt']:''; ?></td>
            </tr>
		<?php } ?>
			 
			
            
        </tbody>
        <tfoot>
            <tr>
				<td>Patient ID</td>
                <td>Name</td>
                <td>Age</td>
                <td>Doctor </td>
                <td>Visit Type</td>
                <td>Date of Visit</td>
                 <td>Total Fee</td>
            </tr>
			
        </tfoot>
    </table>
                                </div>
								<div class="clearfix">&nbsp;</div>
							
                            </div>
                        </div>
                    </div>
				
                    
                </div>
            </div>
<script>
// $(document).ready(function() {
	// $('#example').DataTable( {
		// "order": [[ 5, "desc" ]]
	// } );
// } );
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
                        .prepend(
                            '<img src="<?php echo base_url(); ?>assets/vendor/img/print.png" style="position:absolute;  left: 50%;top: 50%;transform: translate(-50%,-50%);opacity:0.3" />'
                        );
 
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                }
            }
        ]
    } );
} );
$(document).ready(function() {
    $('#fm_filters').bootstrapValidator({
        
        fields: {
            
            to_date: {
                 validators: {
					notEmpty: {
						message: 'To date is required'
					},
					date: {
                        format: 'YYYY-MM-DD',
                        message: 'The value is not a valid date'
                    }
				}
            },
			 from_date: {
                  validators: {
					  notEmpty: {
						message: 'From Date is required'
					},
                   date: {
                        format: 'YYYY-MM-DD',
                        message: 'The value is not a valid date'
                    }
                }
            }
            }
        })
     
});
</script>

				
				

			

