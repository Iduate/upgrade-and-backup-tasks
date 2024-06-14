<!--sidebar end-->
<!--main content start-->
<section id="main-content"> 
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="">
 
            <header class="panel-heading">
                Allergies for <?php echo $bedside->name;?>
                <div class="col-md-4 no-print pull-right"> 
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> Add Allergy
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
                                <th>Allergy</th>                        
                                <th>Type</th>
                                <th>Severity</th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  Add New ALLERGY</h4>
                </div>
            <div class="modal-body row">
                <form role="form" action="patient/addAllergy" class="clearfix" method="post" enctype="multipart/form-data">

                    <input type="hidden" id="p_id" name="p_id" value="<?php echo $this->input->get("id");?>"/>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Type</label>
                        <select class="form-control form-control-inline" name="type" id="exampleInputEmail1" value='' required="">
                            <option value="Food">Food Allergy</option>
                            <option value="Drug">Drug Allergy</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Onset</label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="onset" id="exampleInputEmail1" value='' placeholder="" readonly="" required="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Allergy</label>
                        <input type="text" class="form-control" name="allergy" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Severity</label>
                        <select class="form-control form-control-inline" name="severity" id="exampleInputEmail1" value='' required="">
                            <option value="Mild">Mild</option>
                            <option value="Average">Average</option>
                            <option value="Severe">Severe</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Status</label>
                        <select class="form-control form-control-inline" name="status" id="exampleInputEmail1" value='' required="">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="">Reactions</label>
                        <div class="">
                            <textarea class="ckeditor form-control editor" id="editor" name="reaction" value="" rows="10"></textarea>
                        </div>
                    </div>
                    <section class="col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div> 
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>






<!-- Edit Patient Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  ADD NEW PATIENT VITALS</h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="editPatientForm" action="patient/addVitals" class="clearfix" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> Height </label>
                        <input type="text" class="form-control" name="Height" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> Weight </label>
                        <input type="text" class="form-control" name="Weight" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> BP </label>
                        <input type="text" class="form-control" name="BP" id="exampleInputEmail1" placeholder="">
                    </div>



                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> Pulse </label>
                        <input type="text" class="form-control" name="Pulse" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> Temperature </label>
                        <input type="text" class="form-control" name="Temperature" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> Respiration </label>
                        <input type="text" class="form-control" name="Respiration" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    
                    <!-- custom hospital vitals -->
                    <?php 
                        foreach($vitals as $vital){
                            ?>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"> <?php echo $vital->name;?></label>
                                <input type="text" class="form-control" name="v<?php echo $vital->id;?>" id="exampleInputEmail1" value=''>
                            </div>
                            <?php
                        }
                    ?>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> Patient ID </label>
                        <input type="text" class="form-control" name="id" id="exampleInputEmail1" value='' disabled="true">
                    </div>


                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="p_id" value='<?php
                    if (!empty($patient->patient_id)) {
                        echo $patient->patient_id;
                    }
                    ?>'>





                    <section class="col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right" style="display:none"><?php echo lang('submit'); ?></button>
                        <a class="btn verify btn-info pull-right"><?php echo lang('submit'); ?></a>
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
                <h4 class="modal-title">  Allergy</h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="editPatientForm" action="" class="clearfix">


                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> Type</label>
                        <div class="allergy_type"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> Onset</label>
                        <div class="onset"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> Allergy</label>
                        <div class="allergy"></div>
                    </div>


                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Severity</label>
                        <div class="severity"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label> Status</label>
                        <div class="allergystatus"></div>     
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> Recorded By</label>
                        <div class="recorded_by"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> Recorded On</label>
                        <div class="recorded_on"></div>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> Reactions</label>
                        <div class="reactions"></div>
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

$("#editPatientForm").on("click", ".verify", function () {
         // Populate the form fields with the data returned from server
         var val1=$('#editPatientForm').find('[name="id"]').val()
         var val2=$('#editPatientForm').find('[name="Height"]').val()
         var val3=$('#editPatientForm').find('[name="Weight"]').val()
         var val4=$('#editPatientForm').find('[name="BP"]').val()
         var val5=$('#editPatientForm').find('[name="Pulse"]').val()
         var val6=$('#editPatientForm').find('[name="Temperature"]').val()
         var val7=$('#editPatientForm').find('[name="Respiration"]').val()
         if(val1=="" || val2=="" | val3=="" || val4=="" || val5=="" || val6=="" || val7==""){
             alert("Please fill up all the form data before submitting (Note: you can use \"NIL\" for vitals not available) ");
         }else{
            $('#editPatientForm').find('[name="submit"]').click()
         }
           
    })
</script>

<script type="text/javascript">
    $("#add_med").click(function(){
        num=document.getElementById("medWrap").children.length+1;
        //add a new symp
        var con="<div>"+
                "<div class='form-group col-md-6'>"+
                    "<label for='exampleInputEmail1'>Medicine Name</label>"+
                    "<select class='form-control m-bot15 medchoose' id='medchoose' name='med_"+num+"' value=''></select>"+
                "</div>"+
                "<div class='form-group col-md-6'>"+
                    "<label for='exampleInputEmail1'>Dosage</label>"+
                    "<input type='text' class='form-control' name='dose_"+num+"' id='exampleInputEmail1' value='' placeholder=''/>"+
                "</div><div style='clear:both'></div>"+
            "</div>"
        $("#medWrap").append(con)
        document.getElementById("sCount").value=document.getElementById("medWrap").children.length
        addEvents();
    })
</script>

<script type="text/javascript">
    function addEvents(){
        $( ".medchoose" ).each(function() {
            $( this ).select2({
                placeholder: '<?php echo lang('medicine'); ?>',
            multiple: true,
            allowClear: true,
            ajax: {
                url: 'medicine/getMedicineListForSelect2',
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
    }
</script>


<script type="text/javascript">

    $(".table").on("click", ".editbutton", function () {
        //    e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $("#img").attr("src", "uploads/cardiology-patient-icon-vector-6244713.jpg");
        $('#editPatientForm').trigger("reset");
        $.ajax({
            url: 'patient/getVitalsByJson?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            console.log(response);
            // Populate the form fields with the data returned from server
            $('#editPatientForm').find('[name="id"]').val(response.patient.id).end()
            
            if (typeof response.patient.img_url !== 'undefined' && response.patient.img_url != '') {
                $("#img").attr("src", response.patient.img_url);
            }

            // $('#editPatientForm').find('[name="doctor"]').append(option1).trigger('change');

            
            if(response.patient.patient_type !== null){

                var option1 = new Option('HMO Patient', 'HMO Patient', true, response.patient.patient_type == "HMO Patient");
                var option2 = new Option('Corporate Patient', 'Corporate Patient', false, response.patient.patient_type == "Corporate Patient")
                var option3 = new Option('Private Patient', 'Private Patient', false, response.patient.patient_type == "Private Patient")
            
            }else{

                var option1 = new Option('HMO Patient', 'HMO Patient', true, false);
                var option2 = new Option('Corporate Patient', 'Corporate Patient', false, false)
                var option3 = new Option('Private Patient', 'HMO Patient', false, false)
            }

            $('#editPatientForm').find('[name="patient_type"]').html("").end();

            $('#editPatientForm').find('[name="patient_type"]').append(option1).trigger('change');
            $('#editPatientForm').find('[name="patient_type"]').append(option2).trigger('change');
            $('#editPatientForm').find('[name="patient_type"]').append(option3).trigger('change');

            // $('#editPatientForm').find('[name="patient_type"]').val(response.patient.patient_type).end()

            // $('.js-example-basic-single.doctor').val(response.patient.doctor).trigger('change');

            $('#myModal2').modal('show');

        });
    });

</script>



<script type="text/javascript">

    $(".table").on("click", ".inffo", function () {
        //    e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');

        $('.allergy_type').html("").end()
        $('.onset').html("").end()
        $('.allergy').html("").end()
        $('.severity').html("").end()
        $('.allergystatus').html("").end()
        $('.recorded_by').html("").end()
        $('.recorded_on').html("").end()
        $('.reactions').html("").end()
        //noteClass
        $.ajax({
            url: 'patient/getAllergyByJson?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            console.log(response)
            $('.allergy_type').append(response.allergy.type).end()
            $('.onset').append(response.allergy.onset).end()
            $('.allergy').append(response.allergy.allergy).end()
            $('.severity').append(response.allergy.severity).end()
            $('.allergystatus').append(response.allergy.status).end()
            $('.recorded_by').append(response.taken_by).end()
            $('.recorded_on').append(response.date).end()
            $('.reactions').append(response.allergy.reactions).end()



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
                url: "patient/getAllergies",
                type: 'POST',
                data: {"id":"<?php echo $this->input->get("id");?>"}
            },
            scroller: {
                loadingIndicator: true
            },
            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
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



