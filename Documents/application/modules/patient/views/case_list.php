<style>
.half{width:40%; display:inline-block; padding:5px 0}
.half:nth-child(even){float:right}
.half >span{font-weight:bold;}
</style>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <section class="col-md-12">
            <header class="panel-heading">
                <?php echo lang('all'); ?> <?php echo lang('case'); ?>
            </header> 
            <div class="panel-body"> 

                <div class="adv-table editable-table">
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th style="width: 10%"><?php echo lang('date'); ?></th>
                                <th style="width: 15%"><?php echo lang('patient'); ?></th>
                                <th style="width: 15%"><?php echo lang('case'); ?> <?php echo lang('title'); ?></th>
                                <th style="width: 10%;" class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

        </section>





    </section>
    <!-- page end-->
</section>
</section>
<!--main content end-->
<!--footer start-->






<!-- Add Department Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('add_medical_history'); ?></h4>
            </div> 
            <div class="modal-body row">
                <form role="form" action="patient/addMedicalHistory" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="" readonly="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single" name="patient_id" value=''>
                            <?php foreach ($patients as $patient) { ?>
                                <option value="<?php echo $patient->id; ?>"> <?php echo $patient->name; ?> </option> 
                            <?php } ?> 
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('title'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium" name="title" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-12">
                        <label class=""><?php echo lang('description'); ?></label>
                        <textarea class="ckeditor form-control" name="description" value="" rows="10"></textarea>
                    </div>
                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="redirect" value='patient/caseList'>
                    <section class="col-md-12">
                        <button type="submit" name="submit" class="btn btn-info submit_button pull-right"> <?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Department Modal-->

<!-- Edit Department Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('edit_medical_history'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="medical_historyEditForm" class="clearfix" action="patient/addMedicalHistory" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                        <select class="form-control m-bot15 patient" id="patientchoose1" name="patient_id" value=''>

                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('title'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium" name="title" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <!-- begining of custom form -->                    

                    <div class="form-group col-md-12" id="customEditForm">
                        
                        </div>
                    <!-- end of custom form -->
                    <div class="form-group col-md-12">
                        <label class=""><?php echo lang('description'); ?></label>
                        <div class="">
                            <textarea class="ckeditor form-control editor" id="editor" name="description" value="" rows="10"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="redirect" value='patient/caseList'>
                    <div class="col-md-12">
                        <button type="submit" name="submit" class="btn btn-info submit_button pull-right">Submit</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>






<div class="modal fade" id="caseModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close no-print" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('case'); ?> <?php echo lang('details'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="medical_historyEditForm" class="clearfix" action="patient/addMedicalHistory" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12 row">
                        <div class="form-group col-md-6 case_date_block">
                            <label for="exampleInputEmail1"><?php echo lang('case'); ?> <?php echo lang('creation'); ?> <?php echo lang('date'); ?></label>
                            <div class="case_date"></div>
                        </div>
                        <div class="form-group col-md-6 case_patient_block">
                            <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                            <div class="case_patient"></div>
                            <div class="case_patient_id"></div>
                        </div> 
                        <div>
                            <hr>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Case Doctor</label>
                        <div class="case_doctor"></div>
                        <hr>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('title'); ?> </label>
                        <div class="case_title"></div>
                        <hr>
                    </div>
                    <!-- symptom section -->
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Symptoms</label>
                        <div class="symps"></div>
                    </div>

                    <!-- begining of custom form -->

                    <div class="form-group col-md-12" id="customForm">
                        
                    </div>
                    

                    <!-- end of custom form -->
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> <?php echo lang('details'); ?></label>
                        <div class="case_details"></div>
                        <hr>
                    </div>


                    <div class="panel col-md-12">
                        <h5 class="pull-right">
                            <?php echo $settings->title . '<br>' . $settings->address; ?>
                        </h5>
                    </div>


                    <div class="panel col-md-12 no-print">
                        <a class="btn btn-info invoice_button pull-right" onclick="javascript:window.print();"><i class="fa fa-print"></i> <?php echo lang('print'); ?> </a>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>



<style>

    @media print {

        .modal-content{
            width: 100%;
        }


        .modal{
            overflow: hidden;
        }

        .case_date_block{
            width: 50%;
            float: left;
        }

        .case_patient_block{
            width: 50%;
            float: left;
        }

    }



</style>



<?php
$current_user = $this->ion_auth->get_user_id();
if ($this->ion_auth->in_group('Doctor')) {
    $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
}
?>




<script src="common/js/codearistos.min.js"></script>

<?php
if($this->input->get("consult") != null){
    
    ?>
    <script>
        $(document).ready(function(){
            iid=<?php echo $this->input->get("consult");?>;
            $name="<?php echo $consult['name']?>";
            $id="<?php echo $consult['id']?>";
                var option = new Option($name + '-' + $id, $id, false, true);
                $('#main_form').find('[name="pp"]').append(option).trigger('change');
        })
    </script>
    <?php
}
?>
<script type="text/javascript">
function getresponseDate(date){
    var de = date * 1000;
        var d = new Date(de);


        var monthNames = [
            "January", "February", "March",
            "April", "May", "June", "July",
            "August", "September", "October",
            "November", "December"
        ];

        var day = d.getDate();
        var monthIndex = d.getMonth();
        var year = d.getFullYear();

        var da = day + ' ' + monthNames[monthIndex] + ', ' + year;
        return da;
}

    $(".table").on("click", ".editbutton", function () {
        $("#customEditForm").html("").end()
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $.ajax({
            url: 'patient/editMedicalHistoryByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            // Populate the form fields with the data returned from server
            var de = response.medical_history.date * 1000;
            var d = new Date(de);
            var da = d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear();
            $('#medical_historyEditForm').find('[name="id"]').val(response.medical_history.id).end()
            $('#medical_historyEditForm').find('[name="date"]').val(da).end()
            //   $('#medical_historyEditForm').find('[name="patient"]').val(response.medical_history.patient_id).end()
            $('#medical_historyEditForm').find('[name="title"]').val(response.medical_history.title).end()
            CKEDITOR.instances['editor'].setData(response.medical_history.description)
            var option = new Option(response.patient.name + '-' + response.patient.id, response.patient.id, true, true);
            $('#medical_historyEditForm').find('[name="patient_id"]').append(option).trigger('change');
            //   $('.js-example-basic-single.patient').val(response.medical_history.patient_id).trigger('change');
            if(response.forms){
                // console.clear();
                // console.log(response) ;
                var i=0;
                if(response.formgroups){
                    gEntries=Object.entries(response.formgroups)
                    gA=new Array();
                    for(var[key,val] of gEntries){
                        gA[key]=val;
                    }
                }

                if(response.formData){
                    fEntries=Object.entries(response.formData)
                    fD=new Array();
                    for(var[key,val] of fEntries){
                        fD[key]=val;
                        
                    }
                }
                for(i; i<response.forms.length; i++){
                    formname="form_"+i+"_";
                    style="";
                    inputId="<input type='hidden' name='"+formname+"id' value='"+response.forms[i].id+"'/>";
                    style2="";
                    if(response.forms[i].type=="group"){
                        style="style='border:1px solid #e1e1e1;'";
                        style2="style='padding:10px 0px;'";
                        br="<br/>";
                    }
                    inputD="";
                    dkey=parseFloat(response.forms[i].id);
                    ddd=fD[dkey]
                    data="";
                    if(ddd){
                        data=ddd.data;
                        // console.log(ddd);
                    }
                    
                    if(response.forms[i].type=="date"){
                        data=getresponseDate(data)
                        inputD="<input type='text' class='form-control form-control-inline input-medium default-date-picker' name='"+formname+"name' id='exampleInputEmail1' value='"+data+"' placeholder='' readonly=''/>";
                    }
                    else if(response.forms[i].type=="text"){
                        data=data || "";
                        inputD="<input type='text' class='form-control form-control-inline input-medium' name='"+formname+"name' id='exampleInputEmail1' value='"+data+"' placeholder=''/>";
                    }
                    div="<div class='form-group col-md-12' "+style+">"+inputId+
                        "<label for='exampleInputEmail1' "+style2+">"+response.forms[i].name+" </label>"+
                        "<div>"+inputD+"</div>";

                    if(response.forms[i].type=="group"){
                        div+="<div class='form-group-group' id='formGroup2' >";
                        gId=response.forms[i].id;
                        if(response.formgroups){
                            for(e=0; e<gA[gId].length; e++){
                                pre=formname+'group_'+e+"_";
                                key="fg"+gA[gId][e].id;
                                fg=fD[key];
                                groupId="<input type='hidden' name='"+pre+"id' value='"+fg.form_id+"'/>";
                                if(gA[gId][e].type=="date"){
                                    data=getresponseDate(fg.data)
                                    inputD="<input type='text' class='form-control form-control-inline input-medium default-date-picker' name='"+pre+"name' id='exampleInputEmail1' value='"+data+"' placeholder='' readonly=''/>";
                                }else{
                                    data=fg.data
                                    inputD="<input type='text' class='form-control form-control-inline input-medium' name='"+pre+"name' id='exampleInputEmail1' value='"+data+"' placeholder=''/>";
                                }
                                div+="<div class='form-group col-md-12'>"+groupId+
                                        "<label for='exampleInputEmail1'>"+gA[gId][e].name+" </label>"+
                                        inputD+
                                    "</div>"
                            }
                        }
                        div+="</div>";
                    }
                    
                    $("#customEditForm").append(div);
                    
                }  
            }
            
            $('#myModal2').modal('show');

        });
    });

    
</script>

<script type="text/javascript">
    $("#addSymp").click(function(){
        num=document.getElementById("sAdd").children.length+1;
        //add a new symp
        var con="<div>"+
                "<div class='form-group col-md-6'>"+
                    "<label for='exampleInputEmail1'>Symptom Name</label>"+
                    "<select class='form-control m-bot15 symptomchoose' id='symptomchoose' name='sym_"+num+"' value=''></select>"+
                "</div>"+
                "<div class='form-group col-md-6'>"+
                "<label for='exampleInputEmail1'>Condition</label>"+
                    "<select class='form-control m-bot15'  name='scon_"+num+"' value=''>"+
                        "<option value='Mild'>Mild</option>"+
                        "<option value='Severe'>Severe</option>"+
                    "</select>"+
                "</div>"+
            "</div>"
        $("#sAdd").append(con)
        document.getElementById("sCount").value=document.getElementById("sAdd").children.length
        addEvents();
    })
</script>

<script type="text/javascript">
    function addEvents(){
        $( ".symptomchoose" ).each(function() {
            $( this ).select2({
            placeholder: 'Search Symptom',
            allowClear: true,
            ajax: {
                url: 'patient/getSymptominfo',
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

    $(".table").on("click", ".case", function () {
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $("#customForm").html("").end()

        $('.case_date').html("").end()
        $('.case_details').html("").end()
        $('.case_title').html("").end() 
        $('.case_patient').html("").end()
        $('.case_patient_id').html("").end()
        $('.case_doctor').html("").end()
        $('.symps').html("").end()
        $('.form_2').html("").parent().css("display","none").end()
        $('.form_3').html("").parent().css("display","none").end()
        $('.form_4').html("").parent().css("display","none").end()
        $('.form_5').html("").parent().css("display","none").end()
        $('.form_6').html("").parent().css("display","none").end()
        $('.form_7').html("").parent().css("display","none").end()
        $('.form_8').html("").parent().css("display","none").end()
        $('.form_9').html("").parent().css("display","none").end()
        $('.form_0').html("").parent().css("display","none").end()
        $.ajax({
            url: 'patient/getCaseDetailsByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            // console.clear();
            // console.log(response.symptoms)
            // Populate the form fields with the data returned from server
            var de = response.case.date * 1000;
            var d = new Date(de);


            var monthNames = [
                "January", "February", "March",
                "April", "May", "June", "July",
                "August", "September", "October",
                "November", "December"
            ];

            var day = d.getDate();
            var monthIndex = d.getMonth();
            var year = d.getFullYear();

            var da = day + ' ' + monthNames[monthIndex] + ', ' + year;


            $('.case_date').append(da).end()
            $('.case_patient').append(response.patient.name).end()
            $('.case_patient_id').append('ID: ' + response.patient.id).end()
            $('.case_title').append(response.case.title).end()
            $('.case_details').append(response.case.description).end()
            $('.case_doctor').append(response.doctor).end()
            for(var i=0; i<response.symptoms.length; i++){
                // console.log(response.symptoms.length)
                    bg="color:#ffa700";
                if(response.symptoms[i].level !="Mild"){
                    bg="color:red";
                }
                var s="<div style='background:#ebebeb; padding:10px 0; margin-top:5px'><div class='form-group col-md-6'  style='margin:0'>"+
                        "<div>"+response.symptoms[i].name+"</div>"+
                    "</div>"+
                    "<div class='form-group col-md-6' style='margin:0'>"+
                        "<div style='font-weight:bold;"+bg+"'>"+response.symptoms[i].level+"</div>"+
                    "</div><div style='clear:both'></div></div>";
                $(".symps").append(s)
                // console.log(response.symptoms[i].name)
                // console.log("here")
            }
            if(response.forms){
                var i=0;
                if(response.formgroups){
                    gEntries=Object.entries(response.formgroups)
                    gA=new Array();
                    for(var[key,val] of gEntries){
                        gA[key]=val;
                    }
                }

                if(response.formData){
                    fEntries=Object.entries(response.formData)
                    fD=new Array();
                    for(var[key,val] of fEntries){
                        fD[key]=val;
                        
                    }
                }
                
                
                for(i; i<response.forms.length; i++){
                    style="";
                    style2="";
                    if(response.forms[i].type=="group"){
                        style="style='border:1px solid #e1e1e1;'";
                        style2="style='padding:10px 0px;'";
                        br="<br/>";
                    }
                    dkey=parseFloat(response.forms[i].id);
                    ddd=fD[dkey]
                    data="";
                    if(ddd){
                        data=ddd.data;
                    }
                    
                    if(response.forms[i].type=="date"){
                        data=getresponseDate(data)
                    } else if(response.forms[i].type=="image"){
                        if (typeof data !== 'undefined' && data != '') {
                            var img = '<img id="dynamic" src="'+data+'" style="width:100%">'
                            data=img
                        }
                    }
                    div="<div class='form-group col-md-12' "+style+">"+
                        "<label for='exampleInputEmail1' "+style2+">"+response.forms[i].name+" </label>"+
                        "<div>"+data+"</div>";

                    if(response.forms[i].type=="group"){
                        div+="<div class='form-group-group' id='formGroup2' >";
                        gId=response.forms[i].id;
                        if(response.formgroups){
                            for(e=0; e<gA[gId].length; e++){
                                key="fg"+gA[gId][e].id;
                                fg=fD[key];
                                if(gA[gId][e].type=="date"){
                                    data=getresponseDate(fg.data)
                                }else{
                                    data=fg.data
                                }
                                div+="<div class='form-group col-md-12'>"+
                                        "<label for='exampleInputEmail1'>"+gA[gId][e].name+" </label>"+
                                        "<div>"+  data+"</div>"+
                                    "</div>"
                            }
                        }
                        div+="</div>";
                    }
                        "</div>";
                    
                        $("#customForm").append(div);
                    
                }  
            }






            $('#caseModal').modal('show');

        });
    });
</script>


<script>
    function vitals(){
        var select= document.getElementById("patientchoose");
        var patient=select.options[select.selectedIndex].value;
        document.getElementById("hider").style.display="none";
        document.getElementById("center").style.display="block";
        $.ajax({
            url: 'patient/getVitalsByJson?id=' + patient,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            $('#height').html(response.vitals.height).end()
            $('#weight').html(response.vitals.weight).end()
            $('#bp').html(response.vitals.bp).end()
            $('#pulse').html(response.vitals.pulse).end()
            $('#temperature').html(response.vitals.temperature).end()
            $('#respiration').html(response.vitals.respiration).end()
            $('#vitals_by').html(response.vitals_by).end()
            $('#date').html(response.date).end()

            len=response.cvitals.length;
            for(i=0; i<len; i++){
                form_id=response.cvitals[i].form_id;
                c=form_id+"ID"
                $('#'+c).html(response.cvitals[i].data).end()
            }

            $('#hider').css("display","block")
            $('#center').css("display","none")

        });
    }

    $(document).ready(function () {
        var table = $('#editable-sample').DataTable({
            responsive: true,
            //   dom: 'lfrBtip',

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "patient/getCaseList",
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
            },
        });

        table.buttons().container()
                .appendTo('.custom_buttons');
    });

</script>
<script>
    $(document).ready(function () {
        $("#patientchoose").select2({
            placeholder: '<?php echo lang('select_patient'); ?>',
            allowClear: true,
            ajax: {
                url: 'patient/getPatientinfo',
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
        $("#patientchoose1").select2({
            placeholder: '<?php echo lang('select_patient'); ?>',
            allowClear: true,
            ajax: {
                url: 'patient/getPatientinfo',
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

        // $("#operationchoose").select2({
        //     placeholder: 'Choose Operation',
        //     allowClear: true,
        //     ajax: {
        //         url: 'patient/getAllOperation',
        //         type: "post",
        //         dataType: 'json',
        //         delay: 250,
        //         data: function (params) {
        //             return {
        //                 searchTerm: params.term // search term
        //             };
        //         },
        //         processResults: function (response) {
        //             return {
        //                 results: response
        //             };
        //         },
        //         cache: true
        //     }

        // });


    });
</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>
