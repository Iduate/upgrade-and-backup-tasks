
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <form action="accountant/accountReport" method="get">
                    <div class="form-group col-md-2">
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="dateFrom" value="<?php echo $this->input->get("dateFrom");?>" placeholder="Date From" readonly="">      
                    </div>
                    <div class="form-group col-md-2">
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="dateTo" value="<?php echo $this->input->get("dateTo");?>" placeholder="Date To" readonly="">      
                    </div>
                    <div class="form-group col-md-2  insClass" id="insurancewrap">
                        <select class="form-control m-bot15" name="insurance" value='' id="insurance01" onchange="hideSponsor()">
                                
                        </select>
                    </div>
                    <div class="form-group col-md-2  insClass" id="sponsorwrap" >
                        <select class="form-control m-bot15" name="sponsor" value='' id="sponsor01"  onchange="hideInsurance()">
                                
                        </select>
                    </div>
                    <div class="btn-group">
                        <button id="" class="btn green btn-xs" type="submit">
                            <i class="fa fa-search"></i>  Search
                        </button>
                    </div>
                </form>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">

                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Amount Paid</th>
                                <th>Insurance</th>
                                <th>Sponsor</th>
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




<!-- Add Accountant Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  Add Records Officer</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="accountant/addNewOfficer" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value=''>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input type="file" name="img_url">
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right row"><?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> Edit Record Officer</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editAccountantForm" class="clearfix" action="accountant/addNewOfficer" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="********">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input type="file" name="img_url">
                    </div>

                    <input type="hidden" name="id" value=''>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right row"><?php echo lang('submit'); ?></button>
                    </div>

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
                                            $('#editAccountantForm').trigger("reset");
                                            $.ajax({
                                                url: 'accountant/editRecordOfficerByJason?id=' + iid,
                                                method: 'GET',
                                                data: '',
                                                dataType: 'json',
                                            }).success(function (response) {
                                                // Populate the form fields with the data returned from server
                                                $('#editAccountantForm').find('[name="id"]').val(response.accountant.id).end()
                                                $('#editAccountantForm').find('[name="name"]').val(response.accountant.name).end()
                                                $('#editAccountantForm').find('[name="password"]').val(response.accountant.password).end()
                                                $('#editAccountantForm').find('[name="email"]').val(response.accountant.email).end()
                                                $('#editAccountantForm').find('[name="address"]').val(response.accountant.address).end()
                                                $('#editAccountantForm').find('[name="phone"]').val(response.accountant.phone).end()
                                                $('#myModal2').modal('show');
                                            });
                                        });
                                    });</script>


<script>
<?php 
$link="";
if(!empty($this->input->get("dateFrom"))){
    $link="?dateFrom=".$this->input->get("dateFrom")."&dateTo=".$this->input->get("dateTo");
}
if(!empty($this->input->get("insurance"))){
    $link=$link."&insurance=".$this->input->get("insurance");
}
if(!empty($this->input->get("sponsor"))){
    $link=$link."&sponsor=".$this->input->get("sponsor");
}

?>

    $(document).ready(function () {
        console.warn("<?php echo $link;?>")
        var table = $('#editable-sample').DataTable({
            responsive: true,
            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "accountant/getAccountReport<?php echo $link;?>",
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
    $(document).ready(function(){
        $("#sponsor01").select2({
            placeholder: 'Select Sponsor',
            allowClear: true,
            ajax: {
                url: 'finance/getAllSponsorInfo',
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
    })
</script>

<script>
    function hideSponsor(){
        $("#sponsor01").val("");
        $("#sponsorwrap").css("display","none");
    }
    function hideInsurance(){
        $("#insurance01").val("");
        $("#insurancewrap").css("display","none");
    }
</script>

<script>
    $(document).ready(function(){
        $("#insurance01").select2({
            placeholder: 'Select Insurance',
            allowClear: true,
            ajax: {
                url: 'finance/getAllInsuranceInfo',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function (response) {
                    response.push({id:"private", text:"Private Patient"})
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    })
</script>




<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>
