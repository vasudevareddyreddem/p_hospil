<style>
    .dat-help div.dataTables_wrapper div.dataTables_filter input {
    margin-left: 0.5em;
    display: inline-block;
    width: 100%;
}
    
   .dat-help .col-md-6{
   -webkit-box-flex: 0;
   -webkit-flex: 0 0 50%;
   -ms-flex: 0 0 50%;
   flex: 0 0 50%;
   max-width: 80%;
   }
   .dataTables_info{
   display:none
   }
</style>
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Support</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
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
                        <header>Chat</header>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="form-group col-md-3 card">

                                <h3>Selected Hospitals</h3>
                                <textarea readonly="true" id="example-console" type="textarea" class="form-control" placeholder="Selected Hospitals"></textarea>
                                <br>
                                <form class="dat-help" id="frm-example" action="" method="POST">
                                    <table id="example" class="display select" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th><input name="select_all" value="1" type="checkbox"></th>
                                                <th>Hospital Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($hospital_list) && count($hospital_list)>0){ ?>
                                            <?php foreach($hospital_list as $list){ ?>
                                            <tr>
                                                <td>
                                                    <?php echo $list['hos_id']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $list['hos_bas_name']; ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php }else{ ?>
                                            <tr>
                                                <td colspan="2">No data</td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <button class="btn btn-success">Submit</button>
                                </form>
                            </div>
                            <div class="col-md-9 chat-help">
                                <div class="panel ">
                                    <div class="panel-heading bg-indigo">
                                        <span class="glyphicon glyphicon-comment"></span> Hospital Name
                                    </div>
                                    <div class="panel-body">


                                        <ul class="chat">
                                            <?php if(isset($chating_list) && count($chating_list)>0){ ?>
                                            <?php //echo '<pre>';print_r($chating_list);exit; ?>

                                            <?php foreach($chating_list as $List){ ?>

                                            <?php if($List['type']=='Replay'){ ?>

                                            <li class="left clearfix"><span class="chat-img pull-left">
                                                    <span class="bg-indigo" style="padding:15px;border-radius:50%"><b>
                                                            <?php echo ucfirst(substr($List['sender_name'], 0, 2)); ?></b></span>
                                                </span>
                                                <div class="chat-body clearfix">
                                                    <div class="header">
                                                        <strong class="primary-font">
                                                            <?php echo isset($List['sender_name'])?$List['sender_name']:''; ?></strong> <small class="pull-right text-muted">
                                                            <span class="glyphicon glyphicon-time"></span>
                                                            <?php echo date('M j h:i A',strtotime(htmlentities($List['create_at'])));?></small>
                                                    </div>
                                                    <p>
                                                        <?php echo isset($List['comments'])?$List['comments']:''; ?>
                                                    </p>

                                                    <span class="pull-right">
                                                        <strong class="primary-font">
                                                            <?php echo isset($List['reciver_name'])?$List['reciver_name']:''; ?></strong>
                                                        <span class="bg-indigo" style="padding:15px;border-radius:50%"><b>
                                                                <?php echo ucfirst(substr($List['reciver_name'], 0, 2)); ?></b></span>
                                                    </span>

                                                </div>&nbsp;
                                            </li>
                                            <?php }else{ ?>
                                            <li class="right clearfix"><span class="chat-img pull-right">
                                                    <span class="bg-indigo" style="padding:15px;border-radius:50%"><b>
                                                            <?php echo ucfirst(substr($List['reciver_name'], 0, 2)); ?></b></span>
                                                </span>
                                                <div class="chat-body clearfix">
                                                    <div class="header">
                                                        <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>
                                                            <?php echo date('M j h:i A',strtotime(htmlentities($List['create_at'])));?></small>
                                                        <strong class="pull-right primary-font">
                                                            <?php echo isset($List['reciver_name'])?$List['reciver_name']:''; ?></strong>
                                                    </div>
                                                    <p>
                                                        <?php echo isset($List['comments'])?$List['comments']:''; ?>
                                                    </p>
                                                </div>
                                            </li>
                                            <?php } ?>
                                            <?php } ?>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <div class="panel-footer"><br>
                                        <form id="admin_grou_chat" action="<?php echo base_url('chat/adminchatingpost'); ?>" method="post" enctype="multipart/form-data">
                                            <div class="panel-footer"><br>
                                                <div class="input-group input-chat-des">
                                                    <input type="hidden" name="hospitals_ids" id="hospitals_ids" value="">
                                                    <input type="text" name="comment" id="admin_comment" class="form-control input-sm" placeholder="Type your message here..." required>
                                                    <input type="file" name="image" id="image" class="form-control input-sm" />

                                                    <button type="button" onclick="returnvalidation();" class="btn btn-warning btn-md" id="btn-chat">
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

    function returnvalidation() {
        var ids = $('#hospitals_ids').val();
        var msg = $('#admin_comment').val();
        if (ids != '' && msg != '') {
            document.getElementById("admin_grou_chat").submit();
            return true;
        } else if (ids == '') {
            alert('Please select & submit atleast one hospital');
            return false;
        } else if (msg == '') {
            alert('Comment is required');
            return false;
        }


    }
    //
    // Updates "Select all" control in a data table
    //
    function updateDataTableSelectAllCtrl(table) {
        var $table = table.table().node();
        var $chkbox_all = $('tbody input[type="checkbox"]', $table);
        var $chkbox_checked = $('tbody input[type="checkbox"]:checked', $table);
        var chkbox_select_all = $('thead input[name="select_all"]', $table).get(0);

        // If none of the checkboxes are checked
        if ($chkbox_checked.length === 0) {
            chkbox_select_all.checked = false;
            if ('indeterminate' in chkbox_select_all) {
                chkbox_select_all.indeterminate = false;
            }

            // If all of the checkboxes are checked
        } else if ($chkbox_checked.length === $chkbox_all.length) {
            chkbox_select_all.checked = true;
            if ('indeterminate' in chkbox_select_all) {
                chkbox_select_all.indeterminate = false;
            }

            // If some of the checkboxes are checked
        } else {
            chkbox_select_all.checked = true;
            if ('indeterminate' in chkbox_select_all) {
                chkbox_select_all.indeterminate = true;
            }
        }
    }

    $(document).ready(function() {
        // Array holding selected row IDs
        var rows_selected = [];
        var table = $('#example').DataTable({
            'columnDefs': [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'width': '1%',
                'className': 'dt-body-center',
                'render': function(data, type, full, meta) {
                    return '<input type="checkbox">';
                }
            }],
            'order': [1, 'asc'],
            'rowCallback': function(row, data, dataIndex) {
                // Get row ID
                var rowId = data[0];
                // If row ID is in the list of selected row IDs
                if ($.inArray(rowId, rows_selected) !== -1) {
                    $(row).find('input[type="checkbox"]').prop('checked', true);
                    $(row).addClass('selected');
                }
            }
        });

        // Handle click on checkbox
        $('#example tbody').on('click', 'input[type="checkbox"]', function(e) {
            var $row = $(this).closest('tr');

            // Get row data
            var data = table.row($row).data();

            // Get row ID
            var rowId = data[0];

            // Determine whether row ID is in the list of selected row IDs 
            var index = $.inArray(rowId, rows_selected);

            // If checkbox is checked and row ID is not in list of selected row IDs
            if (this.checked && index === -1) {
                rows_selected.push(rowId);

                // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
            } else if (!this.checked && index !== -1) {
                rows_selected.splice(index, 1);
            }

            if (this.checked) {
                $row.addClass('selected');
            } else {
                $row.removeClass('selected');
            }

            // Update state of "Select all" control
            updateDataTableSelectAllCtrl(table);

            // Prevent click event from propagating to parent
            e.stopPropagation();
        });

        // Handle click on table cells with checkboxes
        $('#example').on('click', 'tbody td, thead th:first-child', function(e) {
            $(this).parent().find('input[type="checkbox"]').trigger('click');
        });

        // Handle click on "Select all" control
        $('thead input[name="select_all"]', table.table().container()).on('click', function(e) {
            if (this.checked) {
                $('tbody input[type="checkbox"]:not(:checked)', table.table().container()).trigger('click');
            } else {
                $('tbody input[type="checkbox"]:checked', table.table().container()).trigger('click');
            }

            // Prevent click event from propagating to parent
            e.stopPropagation();
        });

        // Handle table draw event
        table.on('draw', function() {
            // Update state of "Select all" control
            updateDataTableSelectAllCtrl(table);
        });

        // Handle form submission event 
        $('#frm-example').on('submit', function(e) {
            var form = this;

            // Iterate over all selected checkboxes
            $.each(rows_selected, function(index, rowId) {
                // Create a hidden element 
                $(form).append(
                    $('<input>')
                    .attr('type', 'hidden')
                    .attr('name', 'id[]')
                    .val(rowId)
                );
            });

            // FOR DEMONSTRATION ONLY     

            // Output form data to a console     
            //$('#example-console').text($(form).serialize());
            // console.log("Form submission", $(form).serialize());
            var $data = $(form).serialize();
            //$('#hospitals_ids').val($data);
            jQuery.ajax({
                url: "<?php echo base_url('admin/gethospitalsname');?>",
                data: $data,
                type: "POST",
                format: "Json",
                success: function(data) {
                    var parsedData = JSON.parse(data);
                    $('#example-console').text(parsedData.names_list);
                    $('#hospitals_ids').val(parsedData.ids);
                }
            });
            // Remove added elements
            $('input[name="id\[\]"]', form).remove();

            // Prevent actual form submission
            e.preventDefault();
        });
    });
</script>