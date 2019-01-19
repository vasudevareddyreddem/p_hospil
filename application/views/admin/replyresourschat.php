<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Support</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('dashboard'); ?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Support</li>
                </ol>
            </div>
        </div>
        <!-- start widget -->


        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card  card-topline-yellow">
                    <div class="card-head">
                        <header>Resources Chat</header>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <div class=" col-md-2 ">
                                &nbsp;
                            </div>
                            <div class="col-md-8 chat-help">
                                <div class="panel ">
                                    <div class="panel-heading bg-indigo">
                                        <span class="glyphicon glyphicon-comment"></span> Resources Support

                                    </div>
                                    <div class="panel-body">
                                        <ul class="chat">
                                            <?php if(isset($chat_list) && count($chat_list)>0){ ?>
                                            <?php foreach($chat_list as $list){ ?>

                                            <?php if($list['type']=='Replayed'){ ?>
                                            <li class="left clearfix"><span class="chat-img pull-left">
                                                    <span class="bg-indigo" style="padding:10px;border-radius:50%"><b>
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
                                                    <span class="bg-success" style="padding:10px;border-radius:50%"><b>
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
                                                        <div class="pull-right text-right">
                                                            <strong class="primary-font">
                                                                <?php echo isset($list['replayname'])?$list['replayname']:''; ?></strong>
                                                            <p>
                                                                <?php echo isset($list['comment'])?$list['comment']:''; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    
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
                                            <div class="input-group input-chat-des">

                                                <input type="hidden" name="replaying" id="replaying" value="1" />
                                                <input type="hidden" name="a_id" id="a_id" value="<?php echo isset($chat_list[0]['user_id'])?$chat_list[0]['user_id']:'' ; ?>">
                                                <input type="text" name="comment" id="comment" class="form-control input-sm" placeholder="Type your message here..." required>
                                                <input type="file" name="image" id="image" class="form-control input-sm" />
                                                <button class="btn btn-warning btn-sm" id="btn-chat">
                                                    Send</button>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end admited patient list -->
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>