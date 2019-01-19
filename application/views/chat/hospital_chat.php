<?php //echo '<pre>';print_r($hospital_details);exit; ?>
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Admin Chating
                    </div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Admin chating</li>
                </ol>
            </div>
        </div>
        <div class="panel tab-border card-topline-green">

            <div class="panel-body">
                <div class="tab-content">
                    <div id="resources">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="container">
                                    <div class="panel ">
                                        <div class="panel-heading bg-indigo">
                                            <span class="glyphicon glyphicon-comment"></span> Admin Chat List

                                        </div>
                                        <div class="panel-body" style="height:300px;overflow-y: scroll;">
                                            <ul class="chat">
                                                <?php if(isset($chating_list) && count($chating_list)>0){ ?>
                                                <?php foreach($chating_list as $List){ ?>

                                                <?php if($List['type']=='Replay'){ ?>
                                                <li class="left clearfix"><span class="chat-img pull-left">
                                                        <span class="bg-indigo" style="padding:10px;border-radius:50%"><b>
                                                                <?php echo ucfirst(substr($List['sender_name'], 0, 2)); ?></b></span>
                                                    </span>
                                                    <div class="chat-body clearfix">
                                                        <div class="header">
                                                            <strong class="primary-font">
                                                                <?php echo isset($List['sender_name'])?$List['sender_name']:''; ?></strong> <small class="pull-right text-muted">
                                                                <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
                                                        </div>
                                                        <p>
                                                            <?php echo isset($List['comments'])?$List['comments']:''; ?>
                                                        </p>
                                                    </div>
                                                </li>
                                                <?php }else{ ?>
                                                <li class="right clearfix"><span class="chat-img pull-right">
                                                        <span class="bg-indigo" style="padding:10px;border-radius:50%"><b>
                                                                <?php echo ucfirst(substr($List['reciver_name'], 0, 2)); ?></b></span>
                                                    </span>
                                                    <div class="chat-body clearfix">
                                                        <div class="header">
                                                            <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                                                            <div class="pull-right text-right">
                                                                <strong class="primary-font">
                                                                    <?php echo isset($List['reciver_name'])?$List['reciver_name']:''; ?></strong>
                                                                <p>
                                                                    <?php echo isset($List['comments'])?$List['comments']:''; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </li>
                                                <?php } ?>
                                                <?php } ?>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                        <form id="resourcechat" name="resourcechat" action="<?php echo base_url('chat/adminchating'); ?>" method="post" enctype="multipart/form-data">
                                            <div class="panel-footer"><br>
                                                <div class="row input-chat-des">
                                                    <div class="col-md-4" style="margin-top:5px;">
                                                        <input type="text" name="comment" id="comment" class="form-control input-sm" placeholder="Type your message here..." required>
                                                    </div>
                                                    <div class="col-md-4" style="margin-top:5px;">
                                                        <input type="file" name="image" id="image" class="form-control" />
                                                    </div>
                                                    <div class="col-md-3" style="margin-top:5px;">
                                                        <button type="submit" class="btn btn-warning btn-md btn-block" id="btn-chat">
                                                            Send</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </form>
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
    $(document).ready(function() {

        $('#resourcechat').bootstrapValidator({
            fields: {

                comment: {
                    validators: {
                        notEmpty: {
                            message: 'Comment is required'
                        }
                    }
                },
                image: {
                    validators: {
                        regexp: {
                            regexp: "(.*?)\.(docx|doc|pdf|xlsx|xls|png|jpg|jpeg|gif|Png)$",
                            message: 'Uploaded file is not a valid. Only docx,doc,xlsx,png,jpg,gif,Png,pdf files are allowed'
                        }
                    }
                },
                resource_name: {
                    validators: {
                        notEmpty: {
                            message: 'Resource is required'
                        }
                    }
                }
            }

        })

    });

    $(function() {
        $(".expand").on("click", function() {
            // $(this).next().slideToggle(200);
            $expand = $(this).find(">:first-child");

            if ($expand.text() == "+") {
                $expand.text("-");
            } else {
                $expand.text("+");
            }
        });
    });
</script>
<!--script for add row comment-->
<script>
    $(function() {
        $(document).on('click', '.btn-add', function(e) {
            e.preventDefault();

            var controlForm = $('.controls form:first'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(controlForm);

            newEntry.find('input').val('');
            controlForm.find('.entry:not(:last) .btn-add')
                .removeClass('btn-add').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<span class="glyphicon glyphicon-minus">-</span>');
        }).on('click', '.btn-remove', function(e) {
            $(this).parents('.entry:first').remove();

            e.preventDefault();
            return false;
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#select2insidemodal").select2({
            dropdownParent: $("#myModal")
        });
    });
</script>