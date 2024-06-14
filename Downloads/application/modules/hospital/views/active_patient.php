<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-hospital-o"></i> All Patient
            </header>

            <style>
                .editbutton{
                    width: auto !important;
                }

                .delete_button{
                    width: auto !important;
                }

                .status{
                    background: #123412 !important;
                }

            </style>



            <div class="panel-body">
                <div class="adv-table editable-table">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th> Patient</th>
                                <th> Start Date</th>
                                <th> Expiry Date</th>
                                <th> Status</th>
                                <th class="no-print"> <?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                        <style>

                            .img_url{
                                height:20px;
                                width:20px;
                                background-size: contain; 
                                max-height:20px;
                                border-radius: 100px;
                            }

                        </style>

                        <?php
                        foreach ($patients as $patient) {
                            ?>
                            <tr class="">
                                <td> <?php echo $patient->name; ?></td>
                                <td><?php echo date("d-m-y",$patient->start_date); ?></td>
                                <td><?php echo date("d-m-y",$patient->end_date); ?></td>
                                <td>
                                    <?php
                                    if($patient->end_date ==""){$endDate=0;}else{$endDate=$patient->end_date;}
                                    if (time()<$endDate) {
                                        ?>
                                        <button type="button" class="btn btn-info btn-xs btn_width" ><?php echo lang('active'); ?></button> 
                                    <?php } else { ?>
                                        <button type="button" class="btn btn-info btn-xs delete_button">Expired</button> 
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td class="no-print">
                                    <a type="button" class="btn btn-info btn-xs status subscribe" data-toggle="modal" data-id="<?php echo $patient->id; ?>">Subscribe</a>  
                                </td>
                            </tr>
                            <?php
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->






<!-- Add Event Modal-->
<div class="modal fade" id="subscribeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>  Add Patient Subscription</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="hospital/subscribe" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> Patient ID</label>
                        <input type="text" class="form-control" name="pid" readonly id="exampleInputEmail1">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> Subscription Period</label>
                        <select class="form-control" name="period" id="exampleInputEmail1">
                            <?php
                                for($i=1; $i < 13; $i++){
                                    echo "<option value='$i'>$i Month(s) </option>";
                                }
                                ?>
                        </select>
                    </div>
                    <input type="hidden" value="<?php echo $this->input->get('id');?>" name="hos" />

                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Event Modal-->

<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i>  <?php echo lang('edit_hospital'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editHospitalForm" action="hospital/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="********">

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group"> 

                        <label for="exampleInputEmail1"> <?php echo lang('language'); ?></label>

                        <select class="form-control m-bot15" name="language" value=''>
                            <option value="english" <?php
                            if (!empty($settings->language)) {
                                if ($settings->language == 'english') {
                                    echo 'selected';
                                }
                            }
                            ?>><?php echo lang('english'); ?> 
                            </option>
                            <option value="spanish" <?php
                            if (!empty($settings->language)) {
                                if ($settings->language == 'spanish') {
                                    echo 'selected';
                                }
                            }
                            ?>><?php echo lang('spanish'); ?>
                            </option>
                            <option value="french" <?php
                            if (!empty($settings->language)) {
                                if ($settings->language == 'french') {
                                    echo 'selected';
                                }
                            }
                            ?>><?php echo lang('french'); ?>
                            </option>
                            <option value="italian" <?php
                            if (!empty($settings->language)) {
                                if ($settings->language == 'italian') {
                                    echo 'selected';
                                }
                            }
                            ?>><?php echo lang('italian'); ?>
                            </option>
                            <option value="portuguese" <?php
                            if (!empty($settings->language)) {
                                if ($settings->language == 'portuguese') {
                                    echo 'selected';
                                }
                            }
                            ?>><?php echo lang('portuguese'); ?>
                            </option>
                        </select>

                    </div>

                    <input type="hidden" name="id" value=''>

                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".editbutton").click(function (e) {
            e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
            $('#editHospitalForm').trigger("reset");
            $('#myModal2').modal('show');
            $.ajax({
                url: 'hospital/editHospitalByJason?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                // Populate the form fields with the data returned from server
                $('#editHospitalForm').find('[name="id"]').val(response.hospital.id).end()
                //   $('#editEventForm').find('[name="p_id"]').val(response.client.client_id).end()
                $('#editHospitalForm').find('[name="name"]').val(response.hospital.name).end()
                $('#editHospitalForm').find('[name="password"]').val(response.hospital.password).end()
                $('#editHospitalForm').find('[name="email"]').val(response.hospital.email).end()
                $('#editHospitalForm').find('[name="address"]').val(response.hospital.address).end()
                $('#editHospitalForm').find('[name="phone"]').val(response.hospital.phone).end()
                $('#editHospitalForm').find('[name="language"]').val(response.settings.language).end()
            });
        });
    });
</script>

<script>
$(".table-bordered").on("click", ".subscribe", function () {
    var iid = $(this).attr('data-id');
    $('#subscribeModal').find('[name="pid"]').val(iid).end();
    $('#subscribeModal').modal('show');
})
</script>


<script>
    $(document).ready(function () {
        var table = $('#editable-sample').DataTable({
            responsive: true,

            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [1, 2, 3, 4],
                    }
                },
            ],

            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: -1,
            "order": [[0, "desc"]],

            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json"

            },

        });

        table.buttons().container()
                .appendTo('.custom_buttons');
    });
</script>

<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>