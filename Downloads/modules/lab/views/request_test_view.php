<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel col-md-6 no-print">
            <header class="panel-heading no-print">
                Request Lab Report
            </header>
            <div class="no-print">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <style> 
                            .lab{
                                padding-top: 10px;
                                padding-bottom: 20px;
                                border: none;

                            }
                            .pad_bot{
                                padding-bottom: 5px;
                            }  

                            form{
                                background: #ffffff;
                                padding: 20px 0px;
                            }

                            .modal-body form{
                                background: #fff;
                                padding: 21px;
                            }

                            .remove{
                                float: right;
                                margin-top: -45px;
                                margin-right: 42%;
                                margin-bottom: 41px;
                                width: 94px;
                                height: 29px;
                            }

                            .remove1 span{
                                width: 33%;
                                height: 50px !important;
                                padding: 10px

                            }

                            .qfloww {
                                padding: 10px 0px;
                                height: 370px;
                                background: #f1f2f9;
                                overflow: auto;
                            }

                            .remove1 {
                                background: #5A9599;
                                color: #fff;
                                padding: 5px;
                            }


                            .span2{
                                padding: 6px 12px;
                                font-size: 14px;
                                font-weight: 400;
                                line-height: 1;
                                color: #555;
                                text-align: center;
                                background-color: #eee;
                                border: 1px solid #ccc
                            }

                            .subs{width:30%; display:inline-block; font-family: sans-serif; font-weight: bold; color: #779;}
                            .cat_tgg { background-color: #eee; color: #444; cursor: pointer; padding: 18px; width: 100%;
                                text-align: left; border: none; outline: none; transition: 0.4s;}
                            /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
                            .active, .cat_tgg:hover { background-color: #ccc;}
                            /* Style the accordion panel. Note: hidden by default */
                            .cat_panel { padding: 0 18px; background-color: white; max-height: 0; overflow: hidden;  transition: max-height 0.2s ease-out;}
                            .cat_tgg:after { content: '\02795'; font-size: 13px; color: #777; float: right; margin-left: 5px;}
                            
                            .active:after {content: "\2796"; /* Unicode character for "minus" sign (-) */}
                        </style>

                        <form role="form" id="editLabForm" class="clearfix" action="lab/addRequest" method="post" enctype="multipart/form-data">

                            <div class="">
                                <div class="col-md-6 lab pad_bot">
                                    <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                                    <select class="form-control m-bot15 pos_select" id="pos_select" name="patient" value=''> 
                                       <?php if (!empty($lab->patient)) { ?>
                                            <option value="<?php echo $patients->id; ?>" selected="selected"><?php echo $patients->name; ?> - <?php echo $patients->id; ?></option>  
                                        <?php } ?>
                                    </select>
                                </div> 

                                <div class="pos_client">
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('name'); ?></label>
                                        </div>
                                        <div class="col-md-9"> 
                                            <input type="text" class="form-control pay_in" name="p_name" value='<?php
                                            if (!empty($lab->p_name)) {
                                                echo $lab->p_name;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('email'); ?></label>
                                        </div>
                                        <div class="col-md-9"> 
                                            <input type="text" class="form-control pay_in" name="p_email" value='<?php
                                            if (!empty($lab->p_email)) {
                                                echo $lab->p_email;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('phone'); ?></label>
                                        </div>
                                        <div class="col-md-9"> 
                                            <input type="text" class="form-control pay_in" name="p_phone" value='<?php
                                            if (!empty($lab->p_phone)) {
                                                echo $lab->p_phone;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('age'); ?></label>
                                        </div>
                                        <div class="col-md-9"> 
                                            <input type="text" class="form-control pay_in" name="p_age" value='<?php
                                            if (!empty($lab->p_age)) {
                                                echo $lab->p_age;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                    </div> 
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('gender'); ?></label>
                                        </div>
                                        <div class="col-md-9"> 
                                            <select class="form-control m-bot15" name="p_gender" value=''>

                                                <option value="Male" <?php
                                                if (!empty($patient->sex)) {
                                                    if ($patient->sex == 'Male') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > Male </option>   
                                                <option value="Female" <?php
                                                if (!empty($patient->sex)) {
                                                    if ($patient->sex == 'Female') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > Female </option>
                                                <option value="Others" <?php
                                                if (!empty($patient->sex)) {
                                                    if ($patient->sex == 'Others') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > Others </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 lab pad_bot">
                                    <label for="exampleInputEmail1"> Requested By:</label>
                                    <input type="text" class="form-control pay_in" name="doctor_name" value='<?php
                                                echo $doctor->name;
                                            ?>' placeholder="" disabled="disabled">
                                </div>

                                



                                <div class="pos_doctor">
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> <?php echo lang('name'); ?></label>
                                        </div>
                                        <div class="col-md-9"> 
                                            <input type="text" class="form-control pay_in" name="d_name" value='<?php
                                            if (!empty($lab->p_name)) {
                                                echo $lab->p_name;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> <?php echo lang('email'); ?></label>
                                        </div>
                                        <div class="col-md-9"> 
                                            <input type="text" class="form-control pay_in" name="d_email" value='<?php
                                            if (!empty($lab->p_email)) {
                                                echo $lab->p_email;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> <?php echo lang('phone'); ?></label>
                                        </div>
                                        <div class="col-md-9"> 
                                            <input type="text" class="form-control pay_in" name="d_phone" value='<?php
                                            if (!empty($lab->p_phone)) {
                                                echo $lab->p_phone;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8 panel">
                                </div>



                            </div>

                            <!-- This is the section for the list of possible test -->

                            <div class="col-md-12 lab pad_bot">
                                <label for="exampleInputEmail1"> Available Tests</label> <br/>
                                <?php 
                                    foreach ($test_category as $cat){
                                ?>
                                    <div class="cat_tgg"><?=$cat->category;?></div>
                                    <div class="cat_panel">
                                        <?php
                                            foreach ($lab_tests as $test){
                                                if($test -> category != $cat->category)
                                                    continue;
                                                ?>
                                                <span class="subs"><input type="checkbox" name="test[]" value="<?php echo $test->id;?>"> <?php echo $test->name;?></span>
                                                <?php
                                            }
                                        ?>
                                        
                                    </div>
                                <?php 
                                    }
                                ?>
                            </div>


                            <input type="hidden" name="redirect" value="lab">

                            <input type="hidden" name="id" value='<?php
                            if (!empty($lab->id)) {
                                echo $lab->id;
                            }
                            ?>'>


                            <div class="col-md-12 lab"> 
                                <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>



        </section>








        <style>

            th{
                text-align: center;
            }

            td{
                text-align: center;
            }

            tr.total{
                color: green;
            }



            .control-label{
                width: 100px;
            }



            h1{
                margin-top: 5px;
            }


            .print_width{
                width: 50%;
                float: left;
            } 

            ul.amounts li {
                padding: 0px !important;
            }

            .invoice-list {
                margin-bottom: 10px;
            }




            .panel{
                border: 0px solid #5c5c47;
                background: #fff !important;
                height: 100%;
                margin: 20px 5px 5px 5px;
                border-radius: 0px !important;

            }



            .table.main{
                margin-top: -50px;
            }



            .control-label{
                margin-bottom: 0px;
            }

            tr.total td{
                color: green !important;
            }

            .theadd th{
                background: #edfafa !important;
            }

            td{
                font-size: 12px;
                padding: 5px;
                font-weight: bold;
            }

            .details{
                font-weight: bold;
            }

            hr{
                border-bottom: 2px solid green !important;
            }

            .corporate-id {
                margin-bottom: 5px;
            }

            .adv-table table tr td {
                padding: 5px 10px;
            }



            .btn{
                margin: 10px 10px 10px 0px;
            }












            @media print {

                h1{
                    margin-top: 5px;
                }

                #main-content{
                    padding-top: 0px;
                }

                .print_width{
                    width: 50%;
                    float: left;
                } 

                ul.amounts li {
                    padding: 0px !important;
                }

                .invoice-list {
                    margin-bottom: 10px;
                }

                .wrapper{
                    margin-top: 0px;
                }

                .wrapper{
                    padding: 0px 0px !important;
                    background: #fff !important;

                }



                .wrapper{
                    border: 2px solid #777;
                    min-height: 910px;
                }

                .panel{
                    border: 0px solid #5c5c47;
                    background: #fff !important;
                    padding: 0px 0px;
                    height: 100%;
                    margin: 5px 5px 5px 5px;
                    border-radius: 0px !important;

                }



                .table.main{
                    margin-top: -50px;
                }



                .control-label{
                    margin-bottom: 0px;
                }

                tr.total td{
                    color: green !important;
                }

                .theadd th{
                    background: #edfafa !important;
                }

                td{
                    font-size: 12px;
                    padding: 5px;
                    font-weight: bold;
                }
                .details{
                    font-weight: bold;
                }

                hr{
                    border-bottom: 2px solid green !important;
                }

                .corporate-id {
                    margin-bottom: 5px;
                }

                .adv-table table tr td {
                    padding: 5px 10px;
                }
            }
        </style>






        <section class="panel col-md-5">
            <header class="panel-heading no-print">
                Requests
                <div style="font-size:13px; font-weight:bold">
                    <div class="pend" style="margin-right:10px" ></div> signifies a pending request that has not been resolved yet</br>
                    <div class="done" style="margin-right:10px"></div> signifies a completed request that has been resolved </br>             
                </div>
            </header>
            <style>
                .tt{width:100%;}
                .tt tr{width:100%; border-bottom:1px solid #eee;}
                .tt td, .tt th{padding:10px 0}
                .tt td{text-align:left;width:23%; max-width:23%;}
                .tt .color{background-color:#eee}
                .pend{width:10px; height:10px; background-color:yellow; border-radius:100%; display:inline-block}
                .done{width:10px; height:10px; background-color:green; border-radius:100%;  display:inline-block}
                </style>
            <div class="panel panel-primary" style="margin: 2% 3%;">
                <table cellspacing="10px" cellpadding="10px" class="tt">
                    <tr class="color">
                        <th>Date</th>
                        <th>Patient</th>
                        <th>Test</th>
                        <th>Status</th>
                    </tr>
                </table>
                <?php 
                    if(!empty($requestGroup)){
                        foreach($requestGroup as $group){
                            ?>
                            <div class="cat_tgg">
                                <table cellspacing="10px" cellpadding="10px" class="tt">
                                    <tr>
                                        <td><?php echo date('d/m/y',$group->date);?></td>
                                        <td><?php echo $this->patient_model->getPatientById($group ->patient_id)->name;?></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="cat_panel" style="width:100%">
                                    <?php
                                        foreach ($requests as $request){
                                            if($request ->patient_id != $group->patient_id)
                                                continue;
                                            ?>
                                            <table cellspacing="10px" cellpadding="10px" class="tt">
                                                <tr>
                                                    <td><?php echo date('d/m/y',$request->date);
                                                        if($request->status =="0"){
                                                            echo " <div class='pend'></div>";
                                                        }else{
                                                            echo " <div class='done'></div>";
                                                        }
                                                      ?>
                                                    </td>
                                                    <td><?php echo $this->patient_model->getPatientById($request ->patient_id)->name;?></td>
                                                    <td><?php echo $this->lab_model->getTestById($request->test)->name;?></td>
                                                    <td>
                                                      <?php
                                                        if($request->status =="1"){
                                                            $rid=$request->id;
                                                            $test_id=$this->lab_model->getRequestLink($rid)->test_id;
                                                            echo " <a href='lab/invoice?id=$test_id'>View</a>";
                                                        }
                                                      ?>   
                                                    </td>
                                                </tr>
                                            </table>
                                            <?php
                                        }
                                    ?>
                                    
                                </div>
                        <?php
                        }
                    }
                ?>
            </div>

        </section>

















    </section>

</section>
</section>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>



<script>
                        $(document).ready(function () {
                            var tot = 0;
                            $(".ms-selected").click(function () {
                                var id = $(this).data('idd');
                                $('#id-div' + id).remove();
                                $('#idinput-' + id).remove();
                                $('#mediidinput-' + id).remove();

                            });
                            $.each($('select.multi-select option:selected'), function () {
                                var id = $(this).data('idd');
                                if ($('#idinput-' + id).length)
                                {

                                } else {
                                    if ($('#id-div' + id).length)
                                    {

                                    } else {

                                        $("#editLabForm .qfloww").append('<div class="remove1 col-md-12" id="id-div' + id + '"> <span class="col-md-3 span1">  ' + $(this).data("cat_name") + '</span><span class="col-md-4 span2">Value: </span><span class="col-md-4 span3">Reference Value:<br> ' + $(this).data('id') + '</span></div>')
                                    }
                                    var input2 = $('<input>').attr({
                                        type: 'text',
                                        class: "remove col-md-3",
                                        id: 'idinput-' + id,
                                        name: 'valuee[]',
                                        value: '1',
                                    }).appendTo('#editLabForm .qfloww');

                                    $('<input>').attr({
                                        type: 'hidden',
                                        class: "remove",
                                        id: 'mediidinput-' + id,
                                        name: 'lab_test_id[]',
                                        value: id,
                                    }).appendTo('#editLabForm .qfloww');
                                }


                            });
                        });


</script>



<script>
    $(document).ready(function () {
        $('.multi-select').change(function () {
            var tot = 0;
            $(".ms-selected").click(function () {
                var id = $(this).data('idd');
                $('#id-div' + id).remove();
                $('#idinput-' + id).remove();
                $('#mediidinput-' + id).remove();

            });
            $.each($('select.multi-select option:selected'), function () {
                var id = $(this).data('idd');
                if ($('#idinput-' + id).length)
                {

                } else {
                    if ($('#id-div' + id).length)
                    {

                    } else {

                        $("#editLabForm .qfloww").append('<div class="remove1 col-md-12" id="id-div' + id + '"> <span class="col-md-3 span1">  ' + $(this).data("cat_name") + '</span><span class="col-md-4 span2">Value: </span><span class="col-md-4 span3">Reference Value:<br> ' + $(this).data('id') + '</span></div>')
                    }
                    var input2 = $('<input>').attr({
                        type: 'text',
                        class: "remove col-md-3",
                        id: 'idinput-' + id,
                        name: 'valuee[]',
                        value: '1',
                    }).appendTo('#editLabForm .qfloww');

                    $('<input>').attr({
                        type: 'hidden',
                        class: "remove",
                        id: 'mediidinput-' + id,
                        name: 'lab_test_id[]',
                        value: id,
                    }).appendTo('#editLabForm .qfloww');
                }


            });

        });
    });


</script>







<!-- Add Patient Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Patient Registration</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addNew?redirect=lab" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Address</label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Image</label>
                        <input type="file" name="img_url">
                    </div>

                    <input type="hidden" name="redirect" value="lab">

                    <input type="hidden" name="id" value=''>

                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info">Submit</button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Patient Modal-->



<script>
    $(document).ready(function () {
        $('.pos_client').hide();
        $(document.body).on('change', '#pos_select', function () {

            var v = $("select.pos_select option:selected").val()
            if (v == 'add_new') {
                $('.pos_client').show();
            } else {
                $('.pos_client').hide();
            }
        });

    });


</script>

<script>
    $(document).ready(function () {
        $('.pos_doctor').hide();
        $(document.body).on('change', '#add_doctor', function () {

            var v = $("select.add_doctor option:selected").val()
            if (v == 'add_new') {
                $('.pos_doctor').show();
            } else {
                $('.pos_doctor').hide();
            }
        });

    });


</script>


<script type="text/javascript">
    $(document).ready(function () {
        $(document.body).on('change', '#template', function () {
            var iid = $("select.template option:selected").val();
            $.ajax({
                url: 'lab/getTemplateByIdByJason?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                var data = CKEDITOR.instances.editor.getData();
                if (response.template.template != null) {
                    var data1 = data + response.template.template;
                } else {
                    var data1 = data;
                }
                CKEDITOR.instances['editor'].setData(data1)
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $("#pos_select").select2({
            placeholder: '<?php echo lang('select_patient'); ?>',
            allowClear: true,
            ajax: {
                url: 'patient/getPatientinfoWithAddNewOption',
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
       
        $("#add_doctor").select2({
            placeholder: '<?php echo lang('select_doctor'); ?>',
            allowClear: true,
            ajax: {
                url: 'doctor/getDoctorWithAddNewOption',
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

    var acc = document.getElementsByClassName("cat_tgg");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
} 
</script>