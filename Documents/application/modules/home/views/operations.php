<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class=""> 

            <header class="panel-heading">
                Operations Database
                <div class="col-md-4 no-print pull-right"> 
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                            </button>
                        </div>
                    </a>
                </div>
            </header>
            <div class="panel-body">

                <div class="adv-table editable-table ">

                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th>S/N</th>                        
                                <th>Operation Name</th>
                                <th>Price</th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>








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






<!-- Add Patient Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  Add a new Hospital Operation</h4>
            </div>
            <div class="modal-body row">
                <form role="form" action="home/addOperation" class="clearfix" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Price</label>
                        <input type="text" class="form-control" name="price" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <section class="col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div> 
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Patient Modal-->







<!-- Edit Patient Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('edit_patient'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="editPatientForm" action="home/editOperation" class="clearfix" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Price</label>
                        <input type="text" class="form-control" name="price" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="p_id" value='<?php
                    if (!empty($patient->patient_id)) {
                        echo $patient->patient_id;
                    }
                    ?>'>





                    <section class="col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </section>

                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
<!-- Edit Patient Modal-->












<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg"> 
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('patient'); ?>  <?php echo lang('info'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="editPatientForm" action="patient/addNew" class="clearfix" method="post" enctype="multipart/form-data">

                    <div class="form-group last col-md-4">
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="//www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" id="img1" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputEmail1"><?php echo lang('patient_id'); ?>: <span class="patientIdClass"></span></label>
                            </div>
                        </div>

                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <div class="nameClass"></div>
                    </div>


                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <div class="emailClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label><?php echo lang('age'); ?></label>
                        <div class="ageClass"></div>     
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <div class="addressClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('gender'); ?></label>
                        <div class="genderClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <div class="phoneClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <div class="bloodgroupClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label><?php echo lang('birth_date'); ?></label>
                        <div class="birthdateClass"></div>     
                    </div>

                    <div class="form-group col-md-4">
                        <label>Place of Birth</label>
                        <div class="placeOfBirth"></div>     
                    </div>

                    <div class="form-group col-md-4">
                        <label>Marital Status</label>
                        <div class="marital"></div>     
                    </div>

                    <div class="form-group col-md-4">
                        <label>Occupation</label>
                        <div class="occupation"></div>     
                    </div>

                    <div class="form-group col-md-4">
                        <label>Service / ID No</label>
                        <div class="IdNo"></div>     
                    </div>

                    <div class="form-group col-md-4">
                        <label>Patient Type</label>
                        <div class="patientType"></div>     
                    </div>

                    <div class="form-group col-md-4">
                        <label>Next of Kin</label>
                        <div class="nextOfKin"></div>     
                    </div>

                    <div class="form-group col-md-4">
                        <label>Next of Kin Phone</label>
                        <div class="kinPhone"></div>     
                    </div>

                    <div class="form-group col-md-4">
                        <label>Next of Kin Email</label>
                        <div class="kinEmail"></div>     
                    </div>

                    <div class="form-group col-md-4">
                        <label>Next of Kin Address</label>
                        <div class="kinAddress"></div>     
                    </div>





                    <div class="form-group col-md-4">    
                    </div>
                    <div class="form-group col-md-4">    
                    </div>
                    <div class="form-group col-md-4">    
                        <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                        <div class="doctorClass"></div>
                    </div>







                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>



<script src="common/js/codearistos.min.js"></script>

<!--
<script>


    var video = document.getElementById('video');
    // Get access to the camera!
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        // Not adding `{ audio: true }` since we only want video now
        navigator.mediaDevices.getUserMedia({video: true}).then(function (stream) {
            video.src = window.URL.createObjectURL(stream);
            video.play();
        });
    }

    // Elements for taking the snapshot
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var video = document.getElementById('video');
    // Trigger photo take
    document.getElementById("snap").addEventListener("click", function () {
        context.drawImage(video, 0, 0, 200, 200);
    });

</script>

-->


<script type="text/javascript">
$(".table").on("click", ".editbutton", function () {
        //    e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $('#editPatientForm').trigger("reset");
        $.ajax({
            url: 'home/getOperationById?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            console.log(response)
           $("#myModal2").find('[name="name"]').val(response.operation.name);
           $("#myModal2").find('[name="price"]').val(response.operation.price);
           $("#myModal2").find('[name="id"]').val(iid);
            $('#myModal2').modal('show');

        });
    });
</script>


<script type="text/javascript">

    $(".table").on("click", ".checkin", function () {
        //    e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $t=$(this);
        $.ajax({
            url: 'patient/checkinPatient?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
             $t.attr("class","btn checkout")
            $t.attr("style","background-color:#b10101; color:#fff")
            $t.attr("title","Check Out")
            $t.html("Check Out")
        });
        
    });

</script>

<script type="text/javascript">
 $(".table").on("click", ".checkout", function () {
        //    e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $t=$(this);
        $.ajax({
            url: 'patient/checkOutPatient?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            $t.attr("class","btn checkin")
            $t.attr("style","background-color:#eedede")
            $t.attr("title","Check In")
            $t.html("Check In")
        });
        
    });
</script>



<script type="text/javascript">

    $(".table").on("click", ".inffo", function () {
        //    e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');

        $("#img1").attr("src", "uploads/cardiology-patient-icon-vector-6244713.jpg");
        $('.patientIdClass').html("").end()
        $('.nameClass').html("").end()
        $('.emailClass').html("").end()
        $('.addressClass').html("").end()
        $('.phoneClass').html("").end()
        $('.genderClass').html("").end()
        $('.birthdateClass').html("").end()
        $('.bloodgroupClass').html("").end()
        $('.patientidClass').html("").end()
        $('.doctorClass').html("").end()
        $('.ageClass').html("").end()
        $('.placeOfBirth').html("").end()
        $('.marital').html("").end()
        $('.occupation').html("").end()
        $('.IdNo').html("").end()
        $('.patientType').html("").end()
        $('.nextOfKin').html("").end()
        $('.kinPhone').html("").end()
        $('.kinEmail').html("").end()
        $('.kinAddress').html("").end()
        $.ajax({
            url: 'patient/getPatientByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            // Populate the form fields with the data returned from server

            $('.patientIdClass').append(response.patient.id).end()
            $('.nameClass').append(response.patient.name).end()
            $('.emailClass').append(response.patient.email).end()
            $('.addressClass').append(response.patient.address).end()
            $('.phoneClass').append(response.patient.phone).end()
            $('.genderClass').append(response.patient.sex).end()
            $('.birthdateClass').append(response.patient.birthdate).end()
            $('.ageClass').append(response.age).end()
            $('.bloodgroupClass').append(response.patient.bloodgroup).end()
            $('.placeOfBirth').append(response.patient.birth_place).end()
            $('.marital').append(response.patient.marital_status).end()
            $('.occupation').append(response.patient.occupation).end()
            $('.IdNo').append(response.patient.id_no).end()
            $('.patientType').append(response.patient.patient_type).end()
            $('.nextOfKin').append(response.patient.kin).end()
            $('.kinPhone').append(response.patient.kin_phone).end()
            $('.kinEmail').append(response.patient.kin_email).end()
            $('.kinAddress').append(response.patient.kin_address).end()

            if (response.doctor !== null) {
                $('.doctorClass').append(response.doctor.name).end()
            }else{
                $('.doctorClass').append('').end()
            }

            if (typeof response.patient.img_url !== 'undefined' && response.patient.img_url != '') {
                $("#img1").attr("src", response.patient.img_url);
            }


            $('#infoModal').modal('show');

        });
    });

</script>



<script>


    $(document).ready(function () {
        var table = $('#editable-sample').DataTable({
            responsive: true,
            //   dom: 'lfrBtip',

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "home/getOperations",
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },
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
                        columns: [0, 1, 2],
                    }
                },
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [[0, "desc"]],

            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json"
            }
        });
        table.buttons().container().appendTo('.custom_buttons');
    });

</script>







<script>
    $(document).ready(function () {
        $("#doctorchoose").select2({
            placeholder: '<?php echo lang('select_doctor'); ?>',
            allowClear: true,
            ajax: {
                url: 'doctor/getDoctorinfo',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }

        });
        $("#doctorchoose1").select2({
            placeholder: '<?php echo lang('select_doctor'); ?>',
            allowClear: true,
            ajax: {
                url: 'doctor/getDoctorInfo',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }

        });



    });
</script>



<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>



