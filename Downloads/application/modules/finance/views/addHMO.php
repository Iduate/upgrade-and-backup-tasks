
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Manage <?php echo $hmo->name  ?> Insurance
                <div class="col-md-4 no-print pull-right"> 
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> Add Price
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
                                <th>Name</th>
                                <th>General Price</th>
                                <th>Insurance Price</th>
                                <th class="option_th no-print"><?php echo lang('options'); ?></th>
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
                            .option_th{
                                width:18%;
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

<!-- Add HMO Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  Add Insurance</h4>
            </div>
            <div class="modal-body row">
                <form role="form" action="finance/addInsurancePrice" class="clearfix" method="post" enctype="multipart/form-data">
                  <div id="iAdd">
                  </div>
                <div style="text-align:center">
                    <div id="addPrice" class="btn green btn-xs">
                        <i class="fa fa-plus-circle"></i> Add Price
                    </div>
                </div>

                    <section class="col-md-12">
                        <input type="hidden" name="iCount" id="iCount" value="0" />
                        <input type="hidden" name="hmo_id" id="" value="<?php echo $this->input->get("id");?>" />
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </section>
                  
                </form>

            </div> 
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add HMO Modal-->

<!-- Edit HMO Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  Manage HMO / Corporate Insurance</h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="editHMOForm" action="finance/editInsurancePrice" class="clearfix" method="post" enctype="multipart/form-data">

                    <div class='form-group col-md-6'>
                        <label for='exampleInputEmail1'>Name</label>
                        <select class='form-control m-bot15 category_choose00' name='cname_1' id='category_choose' value=''>"+
                        </select>
                    </div>

                    <div class='form-group col-md-3'>
                        <label for='exampleInputEmail1'>General Price</label>
                        <input type='text' readonly='true' class='form-control' id='old_1' value='' placeholder=''>
                    </div>

                    <div class='form-group col-md-3'>
                        <label for='exampleInputEmail1'>Price</label>
                        <input type='text' class='form-control' name='cprice_1' id='exampleInputEmail1' value='' placeholder=''>
                    </div><div style='clear:both'></div>
                    <input type="hidden" name="id" value=''>
                    <section class="col-md-12">
                        <input type="hidden" name="iCount" id="iCount" value="1" />
                        <input type="hidden" name="hmo_id" value="" />
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </section>

                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
<!-- Edit HMO Modal-->




<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
$(".table").on("click", ".editbutton", function () {
        //    e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $('#editHMOForm').trigger("reset");
        $.ajax({
            url: 'finance/edithmoPriceByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            $('#editHMOForm').find('[name="id"]').val(iid).end()
            $('#editHMOForm').find('[name="hmo_id"]').val(<?php echo $this->input->get("id"); ?>).end()
            $('#editHMOForm').find('[id="old_1"]').val(response.cat.c_price).end()
            $('#editHMOForm').find('[name="cprice_1"]').val(response.hmo.price).end()
            
            if (response.hmo.payment_category !== null) {
                var option1 = new Option(response.cat.category + '(' + response.cat.c_price + ')', response.cat.id, true, true);
            } else {
                var option1 = new Option(' ' + '(' + ')', '', true, true);
            }
            $('#editHMOForm').find('[name="cname_1"]').append(option1).trigger('change');


            $('#myModal2').modal('show');

        });
    });
</script>


<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
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
                url: "finance/getHMOPrice",
                type: 'POST',
                data: {
                        "hmo_id": <?=$this->input->get('id');?>
                    }
            },
            scroller: {
                loadingIndicator: true
            },
            dom: "<'row'<'col-md-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
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
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9],
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

<script type="text/javascript">
    $("#addPrice").click(function(){
        num=document.getElementById("iAdd").children.length+1;
        var iadd="<div>"+
                    "<div class='form-group col-md-6'>"+
                        "<label for='exampleInputEmail1'>Name</label>"+
                        "<select class='form-control m-bot15 category_choose' name='cname_"+num+"' id='category_choose' value=''>"+
                         "</select>"+
                    "</div>"+

                    "<div class='form-group col-md-3'>"+
                        "<label for='exampleInputEmail1'>General Price</label>"+
                        "<input type='text' readonly='true' class='form-control' id='old_"+num+"' value='' placeholder=''>"+
                    "</div>"+

                    "<div class='form-group col-md-3'>"+
                        "<label for='exampleInputEmail1'>Price</label>"+
                        "<input type='text' class='form-control' name='cprice_"+num+"' id='exampleInputEmail1' value='' placeholder=''>"+
                    "</div><div style='clear:both'></div></div>";
        $("#iAdd").append(iadd)
        document.getElementById("iCount").value=document.getElementById("iAdd").children.length
        addEvents();
    })
</script>

<script>
$(document).ready(function(){
    $(".category_choose00" ).select2({
            placeholder: 'Search Payment',
            allowClear: true,
            ajax: {
                url: 'finance/getCategoryinfo',
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
<script type="text/javascript">
    function addEvents(){
        $( ".category_choose" ).each(function() {
            $( this ).change(function(){
                var str=$(this).attr('name');
                var sp=str.split("_");
                var id=sp[1];
                var p=$(this).html();
                var d=p.split(":");
                var s=d[1].split(")");
                $("#old_"+id).val(s[0])
            });
            $( this ).select2({
            placeholder: 'Search Payment',
            allowClear: true,
            ajax: {
                url: 'finance/getCategoryinfo',
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

