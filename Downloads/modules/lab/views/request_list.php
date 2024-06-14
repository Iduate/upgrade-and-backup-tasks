
<!--sidebar end-->
<!--main content start-->
<style> 
.subs{width:30%; display:inline-block; font-family: sans-serif; font-weight: bold; color: #779;}
.cat_tgg { background-color: #eee; color: #444; cursor: pointer; padding: 18px; width: 100%;
    text-align: left; border: none; outline: none; transition: 0.4s;}
/* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
.active, .cat_tgg:hover { background-color: #ccc;}
/* Style the accordion panel. Note: hidden by default */
.cat_panel { padding: 0 18px; background-color: white; max-height: 0; overflow: hidden;  transition: max-height 0.2s ease-out;}
.cat_tgg:after { content: '\02795'; font-size: 13px; color: #777; float: right; margin-left: 5px;}

.active:after {content: "\2796"; /* Unicode character for "minus" sign (-) */}

.tt{width:100%;}
.tt tr{width:100%; border-bottom:1px solid #eee;}
.tt td, .tt th{padding:10px 0; width:23%; max-width:23%;}
.tt td{text-align:left;;}
.tt .color{background-color:#eee}
.pend{width:10px; height:10px; background-color:yellow; border-radius:100%; display:inline-block}
.done{width:10px; height:10px; background-color:green; border-radius:100%;  display:inline-block}
</style>
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->



        <section class="col-md-12 no-print">
            <header class="panel-heading no-print">
                Requests List
                <div style="font-size:13px; font-weight:bold">
                    <div class="pend" style="margin-right:10px" ></div> signifies a pending request that has not been resolved yet</br>
                    <div class="done" style="margin-right:10px"></div> signifies a completed request that has been resolved </br>
                                       
                </div>
            </header>
            <div>
                <div style="padding:18px">
                    <table cellspacing="10px" cellpadding="10px" class="tt">
                        <tr class="color">
                            <th>Date</th>
                            <th>Patient</th>
                            <th>Test</th>
                            <th>Doctor</th>
                            <th>Action</th>
                        </tr>
                    </table>
                </div>
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
                                        <td><?php echo $this->doctor_model->getDoctorById($group->doctor)->name;?></td>
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
                                                    <td><?php echo date('d/m/y',$request->date);?>
                                                    <?php
                                                        if($request->status =="0"){
                                                            echo "<div class='pend'></div>";
                                                        }else{
                                                            echo "<div class='done'></div>";
                                                        }
                                                      ?>
                                                      </td>
                                                    <td><?php echo $this->patient_model->getPatientById($request ->patient_id)->name;?></td>
                                                    <td><?php echo $this->lab_model->getTestById($request->test)->name;?></td>
                                                    <td></td>
                                                    <td>
                                                    <?php
                                                        if($request->status =="0"){
                                                            echo "<a href='lab?rid=$request->id'>Add</a>";
                                                        }else{
                                                            echo "<div class='done'></div>";
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

        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->



<script src="common/js/codearistos.min.js"></script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>


<script>
    $(document).ready(function () {
        var table = $('#editable-sample').DataTable({
            responsive: true,

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "lab/getLab",
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
                searchPlaceholder: "Search..."
            }
        });
        table.buttons().container().appendTo('.custom_buttons');
    });
</script>





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
