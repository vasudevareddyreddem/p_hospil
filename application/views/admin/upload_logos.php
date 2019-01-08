<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Upload Logos</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                        <i class="fa fa-home"></i>&nbsp;
                        <a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Logos</li>
                </ol>
            </div>
        </div>

        <div class="panel tab-border card-topline-green">
            <header class="panel-heading panel-heading-gray custom-tab ">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a href="#add" data-toggle="tab" class="<?php if($tab==''){ echo "active"; } ?>">Add Logos</a>
                    </li>
                    <li class="nav-item"><a href="#list" data-toggle="tab" class="<?php if($tab==1){ echo "active"; } ?>">Logos List</a>
                    </li>
                </ul>
            </header>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane <?php if($tab==''){ echo "active"; } ?>" id="add">
                        <div class="container">

                            <form action="<?php echo base_url('admin/logospost'); ?>" method="post" id="add_logos" name="add_logos" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Select logos</label>
                                        <input type="file" class="form-control" id="image" name="image" value="">
                                        <br>
                                        <button type="submit" class="btn btn-sm btn-success pull-right" type="button">Upload</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="tab-pane <?php if($tab==1){ echo "active"; } ?>" id="list">
                        <div class="container">
                            <div class="row">
                                <div class="card-body col-md-12 table-responsive">
                                    <table id="example4" class="table table-striped table-bordered table-hover" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Created date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php if(isset($logo_lists) & count($logo_lists)>0){ ?>
										<?php foreach($logo_lists as $list){ ?>
                                            <tr>
                                               <td>
                                                    <img style="width:100px;height:100px;" src="<?php echo base_url('assets/logo_images/'.$list['image']); ?>" alt="<?php echo $list['org_name']; ?>"/>
                                                </td>
                                                <td>
                                                    <?php echo isset($list['created_at'])?$list['created_at']:''; ?>
                                                </td>
												<td>
                                                    <?php if($list['status']==1){ echo "Active";}else{ echo "Deactive"; } ?>
                                                </td>
                                                <td class="valigntop">
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                           
                                                            <li>
															 <a href="javascript;void(0);" onclick="admindelete('<?php echo base64_encode(htmlentities($list['l_id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus2('<?php echo $list['status'];?>')" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                                                                    <i class="fa fa-trash-o"></i>Delete</a>
                                                            </li>
                                                            <li>
															<a href="javascript;void(0);" onclick="admindeactive('<?php echo base64_encode(htmlentities($list['l_id'])).'/'.base64_encode(htmlentities($list['status']));?>');adminstatus('<?php echo $list['status'];?>')" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                                                            <i class="fa fa-edit"></i><?php if($list['status']==0){ echo "Active";}else{ echo "Deactive"; } ?> </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
										<?php } ?>
										<?php } ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix">&nbsp;</div>

        </div>
    </div>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
			
			<div style="padding:10px">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 style="pull-left" class="modal-title">Confirmation</h4>
			</div>
			<div class="modal-body">
			<div class="alert alert-danger alert-dismissible" id="errormsg" style="display:none;"></div>
			  <div class="row">
				<div id="content1" class="col-xs-12 col-xl-12 form-group">
				Are you sure ? 
				</div>
				</div>
				<div class="row">
				<div class="col-md-6 col-sm-6  col-sm-6 ">
				  <button type="button" aria-label="Close" data-dismiss="modal" class="btn  blueBtn pull-left">Cancel</button>
				</div>
				<div class="col-md-6 col-sm-6  col-sm-6 ">
                <a href="?id=value" class="btn  blueBtn popid pull-right" style="text-decoration:none;"> <span aria-hidden="true">Ok</span></a>
				</div>
			 </div>
		  </div>
      </div>
      
    </div>
  </div>
<script>
 function admindeactive(id){
	$(".popid").attr("href","<?php echo base_url('admin/logostatus'); ?>"+"/"+id);
}
function adminstatus(id){
	if(id==1){
			$('#content1').html('Are you sure you want to Deactivate?');
		
	}if(id==0){
			$('#content1').html('Are you sure you want to activate?');
	}
}
function admindelete(id){
	$(".popid").attr("href","<?php echo base_url('admin/logodeletes'); ?>"+"/"+id);
}
function adminstatus2(id){
	
			$('#content1').html('Are you sure you want to delete?');

}
$(document).ready(function() {
    $('#add_logos').bootstrapValidator({
        
        fields: {
            
            image: {
                 validators: {
					notEmpty: {
						message: 'Logo image is required'
					},
					regexp: {
					regexp: "(.*?)\.(png|jpeg|gif|Png|Jpeg|jpg)$",
					message: 'Uploaded file is not a valid. Only png,jpeg,gif,jpg files are allowed'
					}
				}
            }
            }
        })
     
});
</script>