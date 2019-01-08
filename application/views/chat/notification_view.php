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
                                                gh
                                            </ul>
                                        </div>
                                        <form id="resourcechat" name="resourcechat" action="<?php echo base_url('chat/resourcechat'); ?>" method="post" enctype="multipart/form-data">
                                            <div class="panel-footer"><br>
                                                <div class="row input-chat-des">
                                                    <div class="col-md-3" style="margin-top:5px;">
                                                        <input type="text" name="comment" id="comment" class="form-control input-sm" placeholder="Type your message here..." required>
                                                        <input type="file" name="image" id="image" class="form-control col-md-3" />
                                                    </div>
                                                    <div class="col-md-3" style="margin-top:5px;">
                                                        <select class="form-control col-md-3" name="resource_name" id="resource_name">
                                                            <option value="">Select</option>
                                                            <?php foreach($resources_list as $list){ ?>
                                                            <option value="<?php echo $list['a_id']; ?>">
                                                                <?php echo $list['resource_name']; ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3" style="margin-top:5px;">
                                                        <button type="submit" class="btn btn-warning btn-sm" id="btn-chat">
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