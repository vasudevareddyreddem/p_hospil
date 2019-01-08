<?php //echo '<pre>';print_r($hospital_details);exit; ?>
<div class="page-content-wrapper">
   <div class="page-content" >
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Notification List
				</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Notification List</li>
            </ol>
         </div>
      </div>
      <div class="panel tab-border card-topline-green">
         
         <div class="panel-body">
            <div class="tab-content">
               <div  id="resources">
                  <div class="row">
                     <div class="col-md-12 ">
                        <div class="container">
							 <div class="panel-group" id="accordion">
							 
							 <?php foreach($notification as $List){ ?>
    <div class="panel panel-default">
       <a href="#" onclick="opennotification('<?php echo $List['int_id']; ?>')"><div data-toggle="collapse" data-parent="#accordion" class="panel-heading" href="#collapse1<?php echo $List['int_id']; ?>">
        <h4  href="#collapse1<?php echo $List['int_id']; ?>" class="panel-title expand">
           <div class="right-arrow pull-right">+</div>
          <span><span class="notification-icon circle deepPink-bgcolor"><?php echo ucfirst(substr($List['comment'], 0, 1)); ?></span>   <?php echo substr($List['comment'], 0, 80); ?> </span>
		  <span class="pull-right view-all-time"><?php echo date('M j h:i A',strtotime(htmlentities($List['create_at'])));?> &nbsp;&nbsp;</span> 
        </h4>
      </div></a>
      <div id="collapse1<?php echo $List['int_id']; ?>" class="panel-collapse collapse">
        <div class="panel-body"><?php echo $List['comment']; ?></div>
      </div>
    </div>
							 <?php } ?>
   
    
  </div> 
                        </div>
                        <div class="clearfix">&nbsp;</div>
                     </div>
                  </div>
               </div>
               
            </div>
         </div>
      </div>
   </div>
</div>
<script>
$(function() {
  $(".expand").on( "click", function() {
    // $(this).next().slideToggle(200);
    $expand = $(this).find(">:first-child");
    
    if($expand.text() == "+") {
      $expand.text("-");
    } else {
      $expand.text("+");
    }
  });
});
</script>
<script>
   function opennotification(id){
	   if(id !=''){
		    jQuery.ajax({
   			url: "<?php echo base_url('admin/get_resource_notification_msg');?>",
   			data: {
				notification_id: id,
			},
   			type: "POST",
   			format:"Json",
   					success:function(data){
					$('#notification_count1').empty();
   					$('#notification_count').empty();
   					var parsedData = JSON.parse(data);
   					$('#notification_msg').append(parsedData.names_list);
   					$('#notification_time').append(parsedData.time);
   					$('#notification_count1').append(parsedData.Unread_count);
   					$('#notification_count').append(parsedData.Unread_count);
   					}
           });
	   }
	}
   </script>
<!--script for add row comment-->


