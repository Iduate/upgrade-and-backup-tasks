<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('list_of_departments') ?>
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
                                <th>Item</th>
                                <th>Price</th>
                                <th class="no-print"> <?php echo lang('options') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="">
                                <?php
                                    $first=$this->finance_model->getPaymentCategoryById($department->first_visit)->c_price;
                                    $follow_up=$this->finance_model->getPaymentCategoryById($department->follow_up)->c_price;
                                ?>
                                <td>First Visit</td>
                                <td><?php echo $first ?></td>
                                <td class="no-print">
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" title="<?php echo lang('edit'); ?>" data-id="<?php echo $department->id; ?>"  data-item="first_visit" data-price="<?php echo $first;?>"><i class="fa fa-edit"></i> </button>   
                                </td>
                            </tr>
                            <tr class="">
                                <td>Follow up Visit</td>
                                <td><?php echo $follow_up;?></td>
                                <td class="no-print">
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" title="<?php echo lang('edit'); ?>" data-id="<?php echo $department->id; ?>"  data-item="follow_up" data-price="<?php echo $follow_up;?>"><i class="fa fa-edit"></i> </button> 
                                </td>
                            </tr>
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




<!-- Add Department Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('add_department') ?></h4>
            </div> 
            <div class="modal-body">
                <form role="form" action="department/addFee" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('department') ?> <?php echo lang('name') ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label class=""> <?php echo lang('description') ?></label>
                        <div class="">
                            <textarea class="ckeditor form-control" name="description" value="" rows="10">  </textarea>
                        </div>
                    </div>
                    <input type="hidden" name="id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button pull-right"> <?php echo lang('submit') ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Department Modal-->

<!-- Edit Department Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">   <?php echo lang('edit_department') ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="departmentEditForm" class="clearfix" action="department/addFee" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> Item Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label class=""> <?php echo lang('price') ?></label>
                        <div class="">
                            <input type="text" class="form-control" name="price" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                    </div>
                    <input type="hidden" name="dept_id" value=''>
                    <input type="hidden" name="item" value=''>

                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button pull-right"> <?php echo lang('submit') ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>



<!-- edit Department case form Modal-->
<div class="modal fade" id="caseFormEdit" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">   Edit Department Case Form <h4>
            </div>
            <div class="modal-body">
                <form role="form" id="caseEditForm" class="clearfix" action="department/editForm" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> Department ID</label>
                        <input type="text" class="form-control" name="id" id="exampleInputEmail1" value='' placeholder="" disabled="true">
                        <input type="hidden" id="formcount" name="formcount" value="0"/>
                    </div>

                    <!-- space for already existing forms -->
                    <div class="exist_form">
                        
                    </div>

                    <!-- end of exist form -->
                    <hr />

                    <!-- space for creating new form -->

                    


                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="p_id" value=''>

                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button pull-right"> <?php echo lang('submit') ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<!-- edit Department case form Modal-->
<div class="modal fade" id="addCaseForm" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">   Add Department Case Form <h4>
            </div>
            <div class="modal-body">
                <form role="form" id="caseAddForm" class="clearfix" action="department/addForm" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> Department ID</label>
                        <input type="text" class="form-control" name="id" id="exampleInputEmail1" value='' placeholder="" disabled="true">
                    </div>

                    <!-- space for creating new form -->
                    <div class="create_form">
                        <div class="form-group">
                            <div class="form-group col-md-6">
                                <label>Form name</label>
                                <input type="text" required='' class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Form type</label>
                                <select name="type" class="form-control m-bot15" onchange="changeChecker()" id="checker">
                                    <option value="text">Text </option>
                                    <option value="date">Date </option>
                                    <option value="polar">Polar (Yes or No) </option>
                                    <option value="group">Group </option>
                                    <option value="image">Image </option>
                                </select>
                            </div>

                            
                            <div style="clear:both"></div>

                            <div class="form-group-group" id="formGroup" style="display:none; border:1px solid #e1e1e1; width:90%; margin:0 auto"><br />

                                <div class="col-md-12">
                                    <button id="addField" class="btn green btn-xs pull-right">
                                        <i class="fa fa-plus-circle"></i> Add Field
                                    </button>
                                </div><br />
                                <div id="vals">
                                    <div class="col-md-12">
                                        <div class="form-group col-md-6">
                                            <label>Group Form name</label>
                                            <input type="text" class="form-control" name="Group_name_1" id="group_1" value='' placeholder="">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Group Form type</label>
                                            <select name="Group_type_1"  class="form-control m-bot15" >
                                                <option value="text">Text </option>
                                                <option value="date">Date </option>
                                                <option value="polar">Polar(Yes or No) </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div style="clear:both"></div>
                            </div>

                        </div>
                    </div>
                    <!-- end of form create -->

                    <hr />


                    


                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="p_id" value=''>
                    <input type="hidden" name="groupcount" value='0' id="groupcount">

                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button pull-right"> <?php echo lang('submit') ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>




<script src="common/js/codearistos.min.js"></script>

<script>
function changeChecker(){
    document.getElementById("formGroup").style.display="none"
    document.getElementById("groupcount").value="0"
    document.getElementById("group_1").removeAttribute("required")
    var select= document.getElementById("checker");
    var chosen=select.options[select.selectedIndex].value;
    if(chosen =="group"){
        document.getElementById("formGroup").style.display="block"
        document.getElementById("groupcount").value=document.getElementById("vals").children.length;
    document.getElementById("group_1").setAttribute("required","true")
    }  
}
</script>

<script>
$(document).ready(function () {
        $("#addField").click(function (e) {
            e.preventDefault(e);
            num=document.getElementById("vals").children.length+1;
            var val="<div class='col-md-12'>"+
                        "<div class='form-group col-md-6'>"+
                            "<label>Group Form name</label>"+
                            "<input type='text' class='form-control' required='' name='Group_name_"+num+"' id='exampleInputEmail1' value='' placeholder=''>"+
                        "</div>"+

                        "<div class='form-group col-md-6'>"+
                            "<label>Group Form type</label>"+
                            "<select name='Group_type_"+num+"'  class='form-control m-bot15' >"+
                                "<option value='text'>Text </option>"+
                                "<option value='date'>Date </option>"+
                                "<option value='polar'>Polar(Yes or No) </option>"+
                            "</select>"+
                        "</div>"+
                    "</div>";
            $("#vals").append(val);
            document.getElementById("groupcount").value=document.getElementById("vals").children.length;
        });
    });
</script>

<script>
function addEve(e) {
console.log(e)
    $(document).ready(function () {
        $parent=$(this).parent().parent();
        num=$parent.parent().find('#groupcount').val()+1;
        vals=$parent.find("#gVal");
        var val="<div class='col-md-12'>"+
                    "<div class='form-group col-md-6'>"+
                        "<label>Group Form name</label>"+
                        "<input type='text' class='form-control' required='' name='Group_name_"+num+"' id='exampleInputEmail1' value='' placeholder=''>"+
                    "</div>"+

                    "<div class='form-group col-md-6'>"+
                        "<label>Group Form type</label>"+
                        "<select name='Group_type_"+num+"'  class='form-control m-bot15' >"+
                            "<option value='text'>Text </option>"+
                            "<option value='date'>Date </option>"+
                            "<option value='polar'>Polar(Yes or No) </option>"+
                        "</select>"+
                    "</div>"+
                "</div><div style='clear:both'></div>";
        vals.append(val);
        $parent.parent().find('#groupcount').val(num)
    });
        // document.getElementById("groupcount").value=document.getElementById("vals").children.length;
}
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $(".editbutton").click(function (e) {
            e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
            var item = $(this).attr('data-item');
            var price = $(this).attr('data-price');
                // Populate the form fields with the data returned from server
                $('#departmentEditForm').find('[name="dept_id"]').val(iid).end()
                $('#departmentEditForm').find('[name="item"]').val(item).end()
                $('#departmentEditForm').find('[name="price"]').val(price).end()
                $('#departmentEditForm').find('[name="name"]').val(item).end()
                $('#myModal2').modal('show');
        });
    });
</script>

<script>


$(document).ready(function () {
        $(".editformbutton").click(function (e) {
            e.preventDefault(e);
            $(".exist_form").html("").end();
            $("formcount").val("0").end()
            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
            $('#caseEditForm').find('[name="id"]').val(iid).end();
            $.ajax({
                url: 'department/getFormsByJSON?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                if(response.form){
                    // console.clear();
                    // console.log(response)
                    gEntries=Object.entries(response.groups)
                    gA=new Array();
                    for(var[key,val] of gEntries){
                        gA[key]=val;
                        
                    }
                    // Populate the form fields with the data returned from server

                    for(var i=0; i<response.form.length; i++){
                        var formname="form_"+i+"_";
                        var div="<div class='form-group' style='border:1px solid black'>"+
                            "<div class='form-group col-md-6'>"+
                                "<label>Form Name</label>"+
                                "<input type='text' class='form-control' name='"+formname+"name' id='exampleInputEmail1' value='"+response.form[i].name+"' required='true'>"+
                                "<input type='hidden' name='"+formname+"id' value='"+response.form[i].id+"'>"+
                                "<input type='hidden' id='groupcount' name='"+formname+"newcount' value='0'>"+
                            "</div>"+

                            "<div class='form-group col-md-4'>"+
                                "<label>Form type</label>"+
                                "<input type='text' class='form-control' name='name1' id='exampleInputEmail1' value='"+response.form[i].type+"' placeholder='' readonly='true' disabled='true'>"+
                            "</div>"+

                            "<div class='form-group col-md-2'>"+
                                "<label>Options</label>"+
                                "<a class='btn btn-info btn-xs btn_width delete_button' "+
                                    "title='Delete' href='#' onclick='return confirm(\"Are you sure you want to delete this item, all files recorded under this field will become void?\");'>"+
                                    "<i class='fa fa-trash'></i></a>"+
                            "</div><div style='clear:both'></div>";
                        if(response.form[i].type=="group"){
                            gId=response.form[i].id;
                            div+="<div class='form-group-group' id='formGroup2' style='border:1px solid #e1e1e1; width:90%; margin:0 auto'>"+
                                "<div class='col-md-12'>"+
                                        "<div id='addFields' class='btn green btn-xs pull-right addFields'>"+
                                            "<i class='fa fa-plus-circle'></i> Add Field"+
                                        "</div>"+
                                        "<input type='hidden' value='0' name='"+formname+"new' id='newRow' />"+
                                        "<input type='hidden' value='"+formname+"' id='newValue' />"+
                                    "</div><br />"+  
                                    "<div id='gVal'>";
                            
                            for(e=0; e<gA[gId].length; e++){
                                var groupname=formname+"group_"+e+"_"
                                div+="<div class='col-md-12'>"+
                                        "<div class='form-group col-md-6'>"+
                                            "<label>Group Form name</label>"+
                                            "<input type='text' class='form-control' name='"+groupname+"name' id='group_1' value='"+gA[gId][e].name+"'  required='true' placeholder=''>"+
                                            "<input type='hidden' class='form-control' name='"+groupname+"id' id='group_1' value='"+gA[gId][e].id+"' placeholder=''>"+
                                        "</div>"+

                                        "<div class='form-group col-md-6'>"+
                                            "<label>Group Form type</label>"+
                                            "<input type='text' class='form-control' name='Group_name_1' id='group_1' value='"+gA[gId][e].type+"' disabled='true'>"+
                                        "</div>"+
                                    "</div>";
                            }

                            div +="<div style='clear:both'></div></div>"+
                            "</div>";
                        }
                        div+="</div>";
                        $("#formcount").val(i+1);
                        $(".exist_form").append(div)
                    }
                    // $('#caseEditForm').find('[name="name1"]').val(response.form.form_1).end()
                    // $('#caseEditForm').find('[name="name2"]').val(response.form.form_2).end()
                    // $('#caseEditForm').find('[name="name3"]').val(response.form.form_3).end()
                    // $('#caseEditForm').find('[name="name4"]').val(response.form.form_4).end()
                    // $('#caseEditForm').find('[name="name5"]').val(response.form.form_5).end()
                    // $('#caseEditForm').find('[name="name6"]').val(response.form.form_6).end()
                    // $('#caseEditForm').find('[name="name7"]').val(response.form.form_7).end()
                    // $('#caseEditForm').find('[name="name8"]').val(response.form.form_8).end()
                    // $('#caseEditForm').find('[name="name9"]').val(response.form.form_9).end()
                    // $('#caseEditForm').find('[name="name10"]').val(response.form.form_0).end()
                    
                }
                
                $('#caseFormEdit').modal('show');
                addEditEvents();
                
                
            });
        });
    });
</script>

<script>
function addEditEvents(){
    num=1;
    $(".addFields").each(function() {
        console.log(num);
        num++;
        $( this ).click(function (e) {
            console.log("here")
            $parent=$(this).parent().parent();
            vals=$parent.find("#gVal");
            newcount=$(this).parent().find("#newRow").val();
            formname=$(this).parent().find("#newValue").val()
            num=parseFloat(newcount)+1;
            groupname=formname+"newGroup_"+num+"_"
            var val="<div class='col-md-12'>"+
                        "<div class='form-group col-md-6'>"+
                            "<label>Group Form name</label>"+
                            "<input type='text' class='form-control' required='' name='"+groupname+"name' id='exampleInputEmail1' value='' placeholder=''>"+
                        "</div>"+

                        "<div class='form-group col-md-6'>"+
                            "<label>Group Form type</label>"+
                            "<select name='"+groupname+"type'  class='form-control m-bot15' >"+
                                "<option value='text'>Text </option>"+
                                "<option value='date'>Date </option>"+
                                "<option value='polar'>Polar(Yes or No) </option>"+
                            "</select>"+
                        "</div>"+
                    "</div><div style='clear:both'></div>";
            vals.append(val);
            $(this).parent().find("#newRow").val(num)

        })
    })
}
</script>

<script>
$(document).ready(function () {
    $(".formbutton").click(function (e) {
        e.preventDefault(e);
        var iid = $(this).attr('data-id');
        $('#caseAddForm').find('[name="id"]').val(iid).end();
        $('#addCaseForm').modal('show');
        
    });
});
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
                        columns: [0, 1],
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
            }
        });
        table.buttons().container().appendTo('.custom_buttons');
    });
</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>
