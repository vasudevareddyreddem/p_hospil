<?php //echo '<pre>';print_r($hospital_details);exit; ?>
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Software Team Chat
                    </div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Software Team Chat</li>
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
                                            <span class="glyphicon glyphicon-comment"></span> Software Team Chat

                                        </div>
                                        <div class="panel-body" style="height:300px;overflow-y: scroll;">
                                            <ul class="chat">
                                                <?php if(isset($chat_list) && count($chat_list)>0){ ?>
                                                <?php foreach($chat_list as $List){ ?>

                                                <?php if($List['type']=='Replay'){ ?>
                                                <li class="left clearfix"><span class="chat-img pull-left">
                                                        <span class="bg-indigo" style="padding:10px;border-radius:50%"><b>
                                                                <?php echo ucfirst(substr($List['replayname'], 0, 2)); ?></b></span>
                                                    </span>
                                                    <div class="chat-body clearfix">
                                                        <div class="header">
                                                            <strong class="primary-font">
                                                                <?php echo isset($List['replayname'])?$List['replayname']:''; ?></strong> <small class="pull-right text-muted">
                                                                <span class="glyphicon glyphicon-time"></span>
                                                                <?php echo date('M j h:i A',strtotime(htmlentities($List['create_at'])));?></small>
                                                        </div>
                                                        <p>
                                                            <?php echo isset($List['comment'])?$List['comment']:''; ?>
                                                        </p>
                                                        <?php if(isset($List['image']) && $List['image']!=''){ ?>
                                                        <p><a target="_blank" href="<?php echo base_url('assets/chating_file/'.$List['image']);?>">download</a>
                                                            <?php } ?>
                                                    </div>
                                                </li>
                                                <?php }else{ ?>
                                                <li class="right clearfix"><span class="chat-img pull-right">
                                                        <span class="bg-indigo" style="padding:10px;border-radius:50%"><b>
                                                                <?php echo ucfirst(substr($List['replayedname'], 0, 2)); ?></b></span>
                                                    </span>
                                                    <div class="chat-body clearfix">
                                                        <div class="header">
                                                            <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>
                                                                <?php echo date('M j h:i A',strtotime(htmlentities($List['create_at'])));?></small>
                                                            <div class="pull-right text-right">
                                                                <strong class="primary-font">
                                                                    <?php echo isset($List['replayedname'])?$List['replayedname']:''; ?></strong>
                                                                <p>
                                                                    <?php echo isset($List['comment'])?$List['comment']:''; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        
                                                        <?php if(isset($List['image']) && $List['image']!=''){ ?>
                                                        <p><a target="_blank" href="<?php echo base_url('assets/chating_file/'.$List['image']);?>">download</a>
                                                            <?php } ?>
                                                    </div>
                                                </li>
                                                <?php } ?>
                                                <?php } ?>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                        <form id="teamchat" name="teamchat" action="<?php echo base_url('chat/softwareteam'); ?>" method="post" enctype="multipart/form-data">
                                            <div class="panel-footer"><br>
                                                <div class="row input-chat-des">
                                                    <div class="col-md-4" style="margin-top:5px;">
                                                        <input type="hidden" name="adminchat" id="adminchat" value="1">
                                                        <input type="text" name="comment" id="comment" class="form-control input-sm" placeholder="Type your message here..." required>
                                                    </div>
                                                    <div class="col-md-4" style="margin-top:5px;">
                                                        <input type="file" name="image" id="image" class="form-control input-sm" />
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

        $('#teamchat').bootstrapValidator({
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
                }
            }

        })

    });
</script>
<!--script for add row comment-->
<