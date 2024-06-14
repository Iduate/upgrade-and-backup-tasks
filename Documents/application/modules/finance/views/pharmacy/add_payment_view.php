<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="">
            <header class="panel-heading">
                <?php
                if (!empty($payment->id))
                    echo lang('pharmacy') . ' ' . lang('edit_payment');
                else
                    echo lang('pharmacy') . ' ' . lang('poss');
                ?>
            </header>
            <div class="">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <style> 
                            .payment{
                                padding-top: 20px;
                                padding-bottom: 20px;
                                border: none;

                            }
                            .pad_bot{
                                padding-bottom: 10px;
                            }  

                            form{
                                border: 1px solid #ccc;
                                background: transparent;
                            }
                            .pos{
                                padding-left:0px;
                            }
                            .form-control{
                                font-size: 14px;
                                font-weight: 600;
                                box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
                            }
                        </style>
                        <div style="padding-left:30px">
                            <br/>
                            <?php
                                if(!is_null($prescription)){
                                    $patient_info = $this->db->get_where('patient', array('id' => $prescription->patient))->row();
                                }
                                $sp = $this->db->get_where('hmo_sponsor', array('id' => $patient_info->insurance_sponsor))->row();
                                $hmo = $this->db->get_where('hmo', array('id' => $patient_info->insurance_id))->row();
                            ?>
                            <span><b>Patient Name: </b><?php echo $patient_info->name;?></span> <span style="display:block; width:10px"></span>
                            <span><b>Patient Insurance: </b> <?php echo $hmo->name;?></span> <span style="display:block; width:10px"></span>
                            <span><b>Insurance Sponsor: </b> <?php echo $sp->name;?></span><span style="display:block; width:10px;"></span>
                            <?php
                                $vitals=$this->patient_model->getVitalsById($patient_info->id);
                                $birthDate = strtotime($patient_info->birthdate);
                                $birthDate = date('m/d/Y', $birthDate);
                                $birthDate = explode("/", $birthDate);
                                $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
                            ?>
                            <span><b>Patient Age: </b> <?php echo $age;?></span><span style="display:block; width:10px; padding-bottom:10px"></span>
                            <span><b>Patient Weight: </b> <?php echo $vitals->weight;?></span><span style="display:block; width:10px; padding-bottom:10px"></span>
                            <br/>
                        </div>

                        <form role="form" class="clearfix pos form1"  id="editPaymentForm" action="finance/pharmacy/addPayment" method="post" enctype="multipart/form-data">
                            <?php
                                if($this->input->get("pid") != null){
                                    echo "<input type='hidden' value='".$this->input->get("pid")."' name='pid'/>";
                                    echo "<input type='hidden' value='".$patient_info->id."' name='patient'/>";
                                }else{
                                    if($this->input->get("patient") == null){
                            ?>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                                    <select class="form-control m-bot15" id="patientchoose" name="patient" onchange="loadPatient()">
                                        
                                    </select>
                                </div>
                            <?php   }else{
                                    echo "<input type='hidden' value='".$this->input->get("patient")."' name='patient'/>";
                                    }
                                }
                            ?>
                            <div class="col-md-4 row">
                                <div class="panel-body">
                                    <?php
                                    if (!empty($prescription->medicine)) {
                                        ?>
                                        <table class="table table-striped table-hover">                      
                                            <thead>       
                                            <th><?php echo lang('medicine'); ?></th>
                                            <th><?php echo lang('instruction'); ?></th>
                                            <th class="text-right"><?php echo lang('frequency'); ?></th>    
                                            </thead>
                                            <tbody>
                                                <?php
                                                $medicine = $prescription->medicine;
                                                $medicine = explode('###', $medicine);
                                                foreach ($medicine as $key => $value) {
                                                    ?>
                                                    <tr>
                                                        <?php $single_medicine = explode('***', $value); ?>

                                                        <td class=""><?php echo $this->medicine_model->getMedicineById($single_medicine[0])->name . ' - ' . $single_medicine[1]; ?> </td>
                                                        <td class=""><?php echo $single_medicine[3] . ' - ' . $single_medicine[4]; ?> </td>
                                                        <td class="text-right"><?php echo $single_medicine[2] ?> </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-3 row">     
                                <?php if (!empty($payment->id)) { ?>
                                    <div class="col-md-12 payment pad_bot">
                                        <div class="col-md-7 payment_label"> 
                                            <label for="exampleInputEmail1">  <?php echo lang('invoice_id'); ?> :</label>
                                        </div>
                                        <div class="col-md-12">                                                   
                                            <?php echo '00' . $payment->id; ?>                                                                                                       
                                        </div>                                              
                                    </div>                                           
                                <?php } ?>
                                <div class="col-md-12 payment">
                                    <div class="form-group last">
                                        <div class="col-md-8 payment_label row"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('select_item'); ?></label>
                                        </div>
                                        <div class="col-md-12 row">
                                            <?php if (empty($payment->id)) { ?>
                                                <select name="category_name[]" class="multi-select1" id="my_multi_select4" >

                                                </select>
                                            <?php } else if (!empty($payment)) { ?>
                                                <select name="category_name[]"  class="multi-select1"  multiple="multiple" id="my_multi_select4" >
                                                    <?php
                                                    

                                                        $category_name = $payment->category_name;
                                                        $category_name1 = explode(',', $category_name);
                                                        foreach ($category_name1 as $category_name2) {
                                                            $category_name3 = explode('*', $category_name2);
                                                            $medicine = $this->medicine_model->getMedicineById($category_name3[0]);
                                                            ?>
                                                            <option value="<?php echo $medicine->id . '*' . (float) $medicine->s_price . '*' . $medicine->name . '*' . $medicine->company. '*' . $medicine->box; ?>" data-qtity="<?php echo $category_name3[2]; ?>" selected="selected">
                                                                <?php echo $medicine->name; ?>
                                                            </option>                

                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            <?php }
                                                if(!empty($prescription->medicine)){?>
                                                    <select name="category_name[]"  class="multi-select1"  multiple="multiple" id="my_multi_select4" >
                                                    <?php
                                                        $medicine = $prescription->medicine;
                                                        $medicine = explode('###', $medicine);
                                                        foreach ($medicine as $key => $value) {
                                                            $single_medicine = explode('***', $value);
                                                            $mId=$single_medicine[0];
                                                            $medicine = $this->medicine_model->getMedicineById($mId);
                                                            ?>
                                                            <option value="<?php echo $medicine->id . '*' . (float) $medicine->s_price . '*' . $medicine->name . '*' . $medicine->company. '*' . $medicine->box; ?>" data-qtity="1" selected="selected">
                                                                <?php echo $medicine->name; ?>
                                                            </option>                

                                                            <?php
                                                        }
                                                    ?>
                                                    </select>
                                                <?php
                                                }
                                            ?>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 qfloww"><p class="title"><?php echo lang('selected_items'); ?></p></div>
                            <div class="col-md-3 right-six">
                                <div class="col-md-12 payment right-six">
                                    <div class="col-md-3 payment_label"> 
                                        <label for="exampleInputEmail1"> <?php echo lang('sub_total'); ?></label>
                                    </div>
                                    <div class="col-md-9"> 
                                        <input type="text" class="form-control pay_in" name="subtotal" id="subtotal" value='<?php
                                        if (!empty($payment->amount)) {

                                            echo $payment->amount;
                                        }
                                        ?>' placeholder=" " disabled>
                                    </div>

                                </div>
                                <div class="col-md-12 payment right-six">
                                    <div class="col-md-3 payment_label"> 
                                        <label for="exampleInputEmail1"> <?php echo lang('discount'); ?><?php
                                            if ($discount_type == 'percentage') {
                                                echo ' (%)';
                                            }
                                            ?> </label>
                                    </div>
                                    <div class="col-md-9"> 
                                        <input type="text" class="form-control pay_in" name="discount" id="dis_id" value='<?php
                                        if (!empty($payment->discount)) {
                                            $discount = explode('*', $payment->discount);
                                            echo $discount[0];
                                        }
                                        ?>' placeholder="Discount">
                                    </div>
                                </div>

                                <div class="col-md-12 payment right-six">
                                    <div class="col-md-3 payment_label"> 
                                        <label for="exampleInputEmail1"> <?php echo lang('gross_total'); ?></label>
                                    </div>
                                    <div class="col-md-9"> 
                                        <input type="text" class="form-control pay_in" name="grsss" id="gross" value='<?php
                                        if (!empty($payment->gross_total)) {

                                            echo $payment->gross_total;
                                        }
                                        ?>' placeholder=" " disabled>
                                    </div>

                                </div>


                                <div class="col-md-12 payment right-six">
                                    <div class="col-md-12">
                                        <div class="col-md-3"> 
                                        </div>  
                                        <div class="col-md-6"> 
                                            <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                                        </div>
                                        <div class="col-md-3"> 
                                        </div> 
                                    </div>
                                </div>
                                <!--
                                <div class="col-md-12 payment">
                                    <div class="col-md-3 payment_label"> 
                                      <label for="exampleInputEmail1">Vat (%)</label>
                                    </div>
                                    <div class="col-md-9"> 
                                      <input type="text" class="form-control pay_in" name="vat" id="exampleInputEmail1" value='<?php
                                if (!empty($payment->vat)) {
                                    echo $payment->vat;
                                }
                                ?>' placeholder="%">
                                    </div>
                                </div>
                                -->

                                <input type="hidden" name="id" value='<?php
                                if (!empty($payment->id)) {
                                    echo $payment->id;
                                }
                                ?>'>
                                <div class="row">
                                </div>
                                <div class="form-group">
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </section>
</section>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>


<style>

    .remove {
        margin: 27px;
        width: 50%;
        background: #f1f1f1 !important;
        float: right;
        margin: -25px 0px;
        border: 1px solid #eee;
    }


    .remove1 {
        margin-top: 10px;
        background: #fff; 
        color: #000;
        padding: 5px;
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
    }


</style>

<script>
    $(document).ready(function () {
        var tot = 0;
        var selected = $('#my_multi_select4').find('option:selected');
        var unselected = $('#my_multi_select4').find('option:not(:selected)');
        selected.attr('data-selected', '1');
        $.each(unselected, function (index, value1) {
            if ($(this).attr('data-selected') == '1') {
                var value = $(this).val();
                var res = value.split("*");
                // var unit_price = res[1];
                var id = res[0];
                $('#id-div' + id).remove();
                $('#idinput-' + id).remove();
                $('#mediidinput-' + id).remove();
                // $('#removediv' + $(this).val() + '').remove();
                //this option was selected before

            }
        });

        $.each($('select.multi-select1 option:selected'), function () {
            var value = $(this).val();
            var res = value.split("*");
            var unit_price = res[1];
            var id = res[0];
            var qtity = $(this).data('qtity');
            if ($('#idinput-' + id).length)
            {

            } else {
                if ($('#id-div' + id).length)
                {

                } else {

                    $("#editPaymentForm .qfloww").append('<div class="remove1" id="id-div' + id + '"><div class="name pos_element"> Name: ' + res[2] + '</div><div class="company pos_element">Company: ' + res[3] + '</div><div class="price pos_element">price: ' + res[1] + '</div><div class="current_stock pos_element">Current Stock: ' + res[4] + '</div><div class="quantity pos_element">quantity:<div></div>')
                }
                var input2 = $('<input>').attr({
                    type: 'text',
                    class: "remove",
                    id: 'idinput-' + id,
                    name: 'quantity[]',
                    value: qtity,
                }).appendTo('#editPaymentForm .qfloww');

                $('<input>').attr({
                    type: 'hidden',
                    class: "remove",
                    id: 'mediidinput-' + id,
                    name: 'medicine_id[]',
                    value: id,
                }).appendTo('#editPaymentForm .qfloww');
            }
            $(document).ready(function () {
                $('#idinput-' + id).keyup(function () {
                    var qty = 0;
                    var total = 0;
                    $.each($('select.multi-select1 option:selected'), function () {
                        var value = $(this).val();
                        var res = value.split("*");
                        // var unit_price = res[1];
                        var id1 = res[0];
                        qty = $('#idinput-' + id1).val();
                        var ekokk = res[1];
                        total = total + qty * ekokk;
                    });
                    tot = total;
                    var discount = $('#dis_id').val();
                    var gross = tot - discount;
                    $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
                    $('#editPaymentForm').find('[name="grsss"]').val(gross)
                });
            });
            var curr_val = res[1] * $('#idinput-' + id).val();
            tot = tot + curr_val;
        });
        var discount = $('#dis_id').val();
        var gross = tot - discount;
        $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
        $('#editPaymentForm').find('[name="grsss"]').val(gross)
        //  });
    });
    $(document).ready(function () {
        $('#dis_id').keyup(function () {
            var val_dis = 0;
            var amount = 0;
            var ggggg = 0;
            amount = $('#subtotal').val();
            val_dis = this.value;
            ggggg = amount - val_dis;
            $('#editPaymentForm').find('[name="grsss"]').val(ggggg)
        });
    });

</script> 



<script>
    $(document).ready(function () {
        $('.multi-select1').change(function () {
            var tot = 0;
            var selected = $('#my_multi_select4').find('option:selected');
            var unselected = $('#my_multi_select4').find('option:not(:selected)');
            selected.attr('data-selected', '1');
            $.each(unselected, function (index, value1) {
                if ($(this).attr('data-selected') == '1') {
                    var value = $(this).val();
                    var res = value.split("*");
                    // var unit_price = res[1];
                    var id = res[0];
                    $('#id-div' + id).remove();
                    $('#idinput-' + id).remove();
                    $('#mediidinput-' + id).remove();
                    // $('#removediv' + $(this).val() + '').remove();
                    //this option was selected before

                }
            });
            $.each($('select.multi-select1 option:selected'), function () {
                var value = $(this).val();
                var res = value.split("*");
                var unit_price = res[1];
                var id = res[0];
                if ($('#idinput-' + id).length)
                {

                } else {
                    if ($('#id-div' + id).length)
                    {

                    } else {

                        $("#editPaymentForm .qfloww").append('<div class="remove1" id="id-div' + id + '"><div class="name pos_element"> Name: ' + res[2] + '</div><div class="company pos_element">Company: ' + res[3] + '</div><div class="price pos_element">price: ' + res[1] + '</div><div class="current_stock pos_element">Current Stock: ' + res[4] + '</div><div class="quantity pos_element">quantity:<div></div>')
                    }
                    var input2 = $('<input>').attr({
                        type: 'text',
                        class: "remove",
                        id: 'idinput-' + id,
                        name: 'quantity[]',
                        value: '1',
                    }).appendTo('#editPaymentForm .qfloww');

                    $('<input>').attr({
                        type: 'hidden',
                        class: "remove",
                        id: 'mediidinput-' + id,
                        name: 'medicine_id[]',
                        value: id,
                    }).appendTo('#editPaymentForm .qfloww');
                }

                $(document).ready(function () {
                    $('#idinput-' + id).keyup(function () {
                        var qty = 0;
                        var total = 0;
                        $.each($('select.multi-select1 option:selected'), function () {
                            var value = $(this).val();
                            var res = value.split("*");
                            // var unit_price = res[1];
                            var id1 = res[0];
                            qty = $('#idinput-' + id1).val();
                            var ekokk = res[1];
                            total = total + qty * ekokk;
                        });

                        tot = total;

                        var discount = $('#dis_id').val();
                        var gross = tot - discount;
                        $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
                        $('#editPaymentForm').find('[name="grsss"]').val(gross)
                    });
                });
                var curr_val = res[1] * $('#idinput-' + id).val();
                tot = tot + curr_val;
            });
            var discount = $('#dis_id').val();
            var gross = tot - discount;
            $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
            $('#editPaymentForm').find('[name="grsss"]').val(gross)
        });
    });
    $(document).ready(function () {
        $('#dis_id').keyup(function () {
            var val_dis = 0;
            var amount = 0;
            var ggggg = 0;
            amount = $('#subtotal').val();
            val_dis = this.value;
<?php if ($discount_type == 'percentage') { ?>
                ggggg = amount - amount * val_dis / 100;
<?php } ?>
<?php if ($discount_type == 'flat') { ?>
                ggggg = amount - val_dis;
<?php } ?>
            $('#editPaymentForm').find('[name="grsss"]').val(ggggg)
        });
    });

</script> 
<script>
    $(document).ready(function () {
        $("#my_multi_select4").select2({
            placeholder: '<?php echo lang('medicine'); ?>',
            multiple: true,
            allowClear: true,
            ajax: {
                url: 'medicine/getMedicineForPharmacyMedicine',
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
    });</script>


<!-- Add Patient Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Patient Registration</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addNew?redirect=payment" method="post" enctype="multipart/form-data">
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


<script src="common/js/codearistos.min.js"></script>


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
    });
</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>
<script>
    function loadPatient(){
        var select= document.getElementById("patientchoose");
        var patient=select.options[select.selectedIndex].value;
        window.location="finance/pharmacy/addPaymentView?patient="+patient;
    }
</script>