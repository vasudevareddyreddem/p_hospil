<?php //echo '<pre>';print_r($hospital_details);exit; ?>
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Online Chat
                    </div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Online Chat</li>
                </ol>
            </div>
        </div>
        <div class="panel tab-border card-topline-green">
            <header class="panel-heading panel-heading-gray custom-tab ">
                <ul class="nav nav-tabs">
                    <?php if($out_source['out_source']!=1){ ?>
                    <li class="nav-item"><a href="#resources" data-toggle="tab" class="<?php if(isset($tab) && $tab ==''){ echo " active"; } ?>">Hospital Resources </a>
                    </li>
                    <?php } ?>
                    <li class="nav-item"><a href="#admin" class="<?php if(isset($tab) && $tab ==1){ echo " active"; } ?>" data-toggle="tab">Hospital Admin</a>
                    </li>
                    <li class="nav-item"><a href="#team" class="<?php if(isset($tab) && $tab ==2){ echo " active"; } ?>" data-toggle="tab">Software Team</a>
                    </li>
                </ul>
            </header>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane <?php if(isset($tab) && $tab ==''){ echo " active"; } ?>" id="resources">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="container">
                                    <div class="panel ">
                                        <div class="panel-heading bg-indigo">
                                            <span class="glyphicon glyphicon-comment"></span> Resources Chat List

                                        </div>
                                        <div class="panel-body" style="height:300px;overflow-y: scroll;">
                                            <ul class="chat">
                                                <?php if(isset($resources_chating) && count($resources_chating)>0){ ?>
                                                <?php foreach($resources_chating as $list){ ?>

                                                <?php
															$admindetails=$this->session->userdata('userdetails');
														if($list['user_id']==$admindetails['a_id']){ ?>
                                                <li class="left clearfix"><span class="chat-img pull-left">
                                                        <span class="bg-indigo" style="padding:15px;border-radius:50%"><b>
                                                                <?php echo ucfirst(substr($list['sendername'], 0, 2)); ?></b></span>

                                                    </span>
                                                    <div class="chat-body clearfix">
                                                        <div class="header">
                                                            <strong class="primary-font">
                                                                <?php echo isset($list['sendername'])?$list['sendername']:''; ?></strong> <small class="pull-right text-muted">
                                                                <span class="glyphicon glyphicon-time"></span>
                                                                <?php 
																		$date = $list['create_at']; 
																		echo date('Y-m-d h:i:s a ', strtotime($date));
																		?>
                                                            </small>
                                                        </div>
                                                        <p>
                                                            <?php echo isset($list['comment'])?$list['comment']:''; ?>
                                                        </p>
                                                        <?php if(isset($list['image']) && $list['image']!=''){ ?>
                                                        <p><a target="_blank" href="<?php echo base_url('assets/chating_file/'.$list['image']);?>">download</a>
                                                            <?php } ?>

                                                            <div class="header">
                                                                <span class="pull-right">
                                                                    <strong class="primary-font">
                                                                        <?php echo isset($list['resourcename'])?$list['resourcename']:''; ?></strong>
                                                                    <span class="bg-indigo" style="padding:15px;border-radius:50%"><b>
                                                                            <?php echo ucfirst(substr($list['resourcename'], 0, 2)); ?></b></span>
                                                                </span>
                                                            </div>

                                                    </div>&nbsp;
                                                </li>
                                                <?php } else{ ?>
                                                <li class="right clearfix"><span class="chat-img pull-right">
                                                        <span class="bg-success" style="padding:15px;border-radius:50%"><b>
                                                                <?php echo ucfirst(substr($list['sendername'], 0, 2)); ?></b></span>

                                                    </span>
                                                    <div class="chat-body clearfix">
                                                        <div class="header">
                                                            <?php 
																
																$checkTime = strtotime($list['create_at']);
	
																?>
                                                            <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>
                                                                <?php 
																		$date = $list['create_at']; 
																		echo date('Y-m-d h:i:s a ', strtotime($date));
																	?>
                                                            </small>
                                                            <strong class="pull-right primary-font">
                                                                <?php echo isset($list['sendername'])?$list['sendername']:''; ?></strong>
                                                        </div>
                                                        <p>
                                                            <?php echo isset($list['comment'])?$list['comment']:''; ?>
                                                        </p>
                                                        <?php if(isset($list['image']) && $list['image']!=''){ ?>
                                                        <p><a target="_blank" href="<?php echo base_url('assets/chating_file/'.$list['image']);?>">download</a>
                                                            <?php } ?>
                                                    </div>
                                                </li>
                                                <?php } ?>


                                                <?php } ?>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                        <form id="resourcechat" name="resourcechat" action="<?php echo base_url('chat/resourcechat'); ?>" method="post" enctype="multipart/form-data">
                                            <div class="panel-footer"><br>
                                                <div class="row input-chat-des ">

                                                    <div class="col-md-3" style="margin-top:5px;">
                                                        <input type="text" name="comment" id="comment" class="form-control input-sm" placeholder="Type your message here..." required>
                                                    </div>
                                                    <div class="col-md-3" style="margin-top:5px;">
                                                        <input type="file" name="image" id="image" class="form-control " />
                                                    </div>
                                                    <div class="col-md-3" style="margin-top:5px;">
                                                        <select class="form-control  " name="resource_name" id="resource_name" style="height:44px;">
                                                            <option value="">Select</option>
                                                            <?php foreach($resources_list as $list){ ?>
                                                            <option value="<?php echo $list['a_id']; ?>">
                                                                <?php echo $list['resource_name']; ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3" style="margin-top:5px;">
                                                        <button type="submit" class="btn btn-warning btn-block btn-sm" id="btn-chat" style="margin:0px;">
                                                            Send</button>
                                                    </div>

                                                </div>
                                            </div>
                                            <br>
                                        </form>
                                    </div>
                                </div>
                                <div class="clearfix">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane <?php if(isset($tab) && $tab ==1){ echo " active"; } ?>" id="admin">
                        <div class="container">
                            <div class="panel ">
                                <div class="panel-heading bg-indigo">
                                    <span class="glyphicon glyphicon-comment"></span> Hospital Admin Support

                                </div>
                                <div class="panel-body" style="height:300px;overflow-y: scroll;">
                                    <ul class="chat">
                                        <?php if(isset($hospitaladmin_chat_list) && count($hospitaladmin_chat_list)>0){ ?>
                                        <?php foreach($hospitaladmin_chat_list as $list){ ?>

                                        <?php if($list['type']=='Replayed'){ ?>
                                        <li class="left clearfix"><span class="chat-img pull-left">
                                                <span class="bg-indigo" style="padding:15px;border-radius:50%"><b>
                                                        <?php echo ucfirst(substr($list['replayedname'], 0, 2)); ?></b></span>

                                            </span>
                                            <div class="chat-body clearfix">
                                                <div class="header">
                                                    <strong class="primary-font">
                                                        <?php echo isset($list['replayedname'])?$list['replayedname']:''; ?></strong> <small class="pull-right text-muted">
                                                        <span class="glyphicon glyphicon-time"></span>
                                                        <?php 
																		$date = $list['create_at']; 
																		echo date('Y-m-d h:i:s a ', strtotime($date));
																		?>
                                                    </small>
                                                </div>
                                                <p>
                                                    <?php echo isset($list['comment'])?$list['comment']:''; ?>
                                                </p>
                                                <?php if(isset($list['image']) && $list['image']!=''){ ?>
                                                <p><a target="_blank" href="<?php echo base_url('assets/chating_file/'.$list['image']);?>">download</a>
                                                    <?php } ?>
                                            </div>
                                        </li>
                                        <?php }else{ ?>
                                        <li class="right clearfix"><span class="chat-img pull-right">
                                                <span class="bg-success" style="padding:15px;border-radius:50%"><b>
                                                        <?php echo ucfirst(substr($list['replayname'], 0, 2)); ?></b></span>

                                            </span>
                                            <div class="chat-body clearfix">
                                                <div class="header">
                                                    <?php 
																
																$checkTime = strtotime($list['create_at']);
	
																?>
                                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>
                                                        <?php 
																		$date = $list['create_at']; 
																		echo date('Y-m-d h:i:s a ', strtotime($date));
																	?>
                                                    </small>
                                                    <strong class="pull-right primary-font">
                                                        <?php echo isset($list['replayname'])?$list['replayname']:''; ?></strong>
                                                </div>
                                                <p>
                                                    <?php echo isset($list['comment'])?$list['comment']:''; ?>
                                                </p>
                                                <?php if(isset($list['image']) && $list['image']!=''){ ?>
                                                <p><a target="_blank" href="<?php echo base_url('assets/chating_file/'.$list['image']);?>">download</a>
                                                    <?php } ?>
                                            </div>
                                        </li>
                                        <?php } ?>


                                        <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <form action="<?php echo base_url('chat/hospitaladmin'); ?>" method="post" enctype="multipart/form-data">
                                    <div class="panel-footer"><br>
                                        <div class="row input-chat-des">
                                            <div class="col-md-4" style="margin-top:5px;">
                                                <input type="text" name="comment" id="comment" class="form-control input-sm" placeholder="Type your message here..." required>
                                            </div>
                                            <div class="col-md-4" style="margin-top:5px;">
                                                <input type="file" name="image" id="image" class="form-control input-sm" />
                                            </div>
                                            <div class="col-md-3" style="margin-top:5px;">

                                                <button class="btn btn-warning btn-sm btn-block" id="btn-chat">
                                                    Send</button>
                                            </div>

                                        </div>
                                    </div>
                                    <br>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane <?php if(isset($tab) && $tab ==2){ echo " active"; } ?>" id="team">
                        <div class="container">
                            <div class="panel ">
                                <div class="panel-heading bg-indigo">
                                    <span class="glyphicon glyphicon-comment"></span> Software Support

                                </div>
                                <div class="panel-body" style="height:300px;overflow-y: scroll;">
                                    <ul class="chat">
                                        <?php if(isset($chat_list) && count($chat_list)>0){ ?>
                                        <?php foreach($chat_list as $list){ ?>

                                        <?php if($list['type']=='Replayed'){ ?>
                                        <li class="left clearfix"><span class="chat-img pull-left">
                                                <span class="bg-indigo" style="padding:15px;border-radius:50%"><b>
                                                        <?php echo ucfirst(substr($list['replayedname'], 0, 2)); ?></b></span>

                                            </span>
                                            <div class="chat-body clearfix">
                                                <div class="header">
                                                    <strong class="primary-font">
                                                        <?php echo isset($list['replayedname'])?$list['replayedname']:''; ?></strong> <small class="pull-right text-muted">
                                                        <span class="glyphicon glyphicon-time"></span>
                                                        <?php 
																		$date = $list['create_at']; 
																		echo date('Y-m-d h:i:s a ', strtotime($date));
																		?>
                                                    </small>
                                                </div>
                                                <p>
                                                    <?php echo isset($list['comment'])?$list['comment']:''; ?>
                                                </p>
                                                <?php if(isset($list['image']) && $list['image']!=''){ ?>
                                                <p><a target="_blank" href="<?php echo base_url('assets/chating_file/'.$list['image']);?>">download</a>
                                                    <?php } ?>
                                            </div>
                                        </li>
                                        <?php }else{ ?>
                                        <li class="right clearfix"><span class="chat-img pull-right">

                                                <span class="bg-success" style="padding:15px;border-radius:50%"><b>
                                                        <?php echo ucfirst(substr($list['replayname'], 0, 2)); ?></b></span>

                                            </span>
                                            <div class="chat-body clearfix">
                                                <div class="header">
                                                    <?php 
																
																$checkTime = strtotime($list['create_at']);
	
																?>
                                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>
                                                        <?php 
																		$date = $list['create_at']; 
																		echo date('Y-m-d h:i:s a ', strtotime($date));
																	?>
                                                    </small>
                                                    <strong class="pull-right primary-font">
                                                        <?php echo isset($list['replayname'])?$list['replayname']:''; ?></strong>
                                                </div>
                                                <p>
                                                    <?php echo isset($list['comment'])?$list['comment']:''; ?>
                                                </p>
                                                <?php if(isset($list['image']) && $list['image']!=''){ ?>
                                                <p><a target="_blank" href="<?php echo base_url('assets/chating_file/'.$list['image']);?>">download</a>
                                                    <?php } ?>
                                            </div>
                                        </li>
                                        <?php } ?>


                                        <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <form action="<?php echo base_url('chat/softwareteam'); ?>" method="post" enctype="multipart/form-data">
                                    <div class="panel-footer"><br>
                                        <div class="row input-chat-des">
                                            <div class="col-md-4" style="margin-top:5px;">
                                                <input type="text" name="comment" id="comment" class="form-control input-sm" placeholder="Type your message here..." required>
                                            </div>
                                            <div class="col-md-4" style="margin-top:5px;">
                                                <input type="file" name="image" id="image" class="form-control input-sm" />
                                            </div>
                                            <div class="col-md-3" style="margin-top:5px;">
                                                <button class="btn btn-warning btn-sm btn-block" id="btn-chat">
                                                    Send</button>
                                            </div>

                                        </div>
                                    </div>
                                    <br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix">&nbsp;</div>
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