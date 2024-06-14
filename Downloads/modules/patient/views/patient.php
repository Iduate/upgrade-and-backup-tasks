<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class=""> 

            <header class="panel-heading">
                <?php echo lang('patient'); ?> <?php echo lang('database'); ?>
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
                                <th><?php echo lang('patient_id'); ?></th>                        
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('phone'); ?></th>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) { ?>
                                    <th><?php echo lang('due_balance'); ?></th>
                                <?php } ?>
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






<!-- Add Patient Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('register_new_patient'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" action="patient/addNew" class="clearfix" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="">
                    </div>



                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15" name="sex" value=''>

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

                    <div class="form-group col-md-6">
                        <label><?php echo lang('birth_date'); ?></label>
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" value="" placeholder="" readonly="">      
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Place of Birth</label>
                        <input type="text" class="form-control" name="birth_place" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Marital Status</label>
                        <input type="text" class="form-control" name="marital" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Occupation</label>
                        <input type="text" class="form-control" name="occupation" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Service / ID No</label>
                        <input type="text" class="form-control" name="id_no" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Patient Type</label>
                        <select class="form-control m-bot15" name="patient_type" value=''>
                                <option value="HMO Patient">HMO Patient </option>
                                <option value="Corporate Patient">Corporate Patient </option>
                                <option value="Private Patient">Private Patient </option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 insClass">
                        <label for="exampleInputEmail1">Insurance</label>
                        <select class="form-control m-bot15" name="insurance" value='' id="insurance01">
                                
                        </select>
                    </div>

                    <div class="form-group col-md-6 insClass">
                        <label for="exampleInputEmail1">Policy No</label>
                        <input type="text" class="form-control" name="policy_no" id="exampleInputEmail1" value='' placeholder="">
                    </div>


                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <select class="form-control m-bot15" name="bloodgroup" value=''>
                            <?php foreach ($groups as $group) { ?>
                                <option value="<?php echo $group->group; ?>" <?php
                                if (!empty($patient->bloodgroup)) {
                                    if ($group->group == $patient->bloodgroup) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $group->group; ?> </option>
                                    <?php } ?> 
                        </select>
                    </div>

                    <div class="form-group col-md-6">    
                        <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                        <select class="form-control m-bot15" id="doctorchoose1" name="doctor" value=''>

                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Next of Kin</label>
                        <input type="text" class="form-control" name="kin" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Next of Kin Phone No</label>
                        <input type="text" class="form-control" name="kin_phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Next of Kin Address</label>
                        <input type="text" class="form-control" name="kin_address" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Next of Kin email</label>
                        <input type="text" class="form-control" name="kin_email" id="exampleInputEmail1" value='' placeholder="">
                    </div>



                    <div class="form-group last col-md-6">
                        <label class="control-label">Image Upload</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="//www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="img_url"/>
                                    </span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!--
                                        <div class="form-group last col-md-6">
                                            <div style="text-align:center;" class="col-md-12">
                                                <video id="video" width="200" height="200" autoplay></video>
                                                <div class="snap" id="snap">Capture Photo</div>
                                                <canvas id="canvas" width="200" height="200"></canvas>
                                                Right click on the captured image and save. Then select the saved image from the left side's Select Image button.
                                            </div>
                                        </div>
                    -->


                    <div class="form-group col-md-6">
                        <input type="checkbox" name="sms" value="sms"> <?php echo lang('send_sms') ?><br>
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
                <form role="form" id="editPatientForm" action="patient/addNew" class="clearfix" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('change'); ?><?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="">
                    </div>



                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15" name="sex" value=''>

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

                    <div class="form-group col-md-6">
                        <label><?php echo lang('birth_date'); ?></label>
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" value="" placeholder="" readonly="">      
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Place of Birth</label>
                        <input type="text" class="form-control" name="birth_place" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Marital Status</label>
                        <input type="text" class="form-control" name="marital" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Occupation</label>
                        <input type="text" class="form-control" name="occupation" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Service / ID No</label>
                        <input type="text" class="form-control" name="id_no" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Patient Type</label>
                        <select class="form-control m-bot15" name="patient_type" value='' id="patient_type">
                                
                        </select>
                    </div><div style="clear:both"></div>

                    <div class="form-group col-md-6 insClass">
                        <label for="exampleInputEmail1">Insurance</label>
                        <select class="form-control m-bot15" name="insurance" value='' id="insurance">
                                
                        </select>
                    </div>

                    <div class="form-group col-md-6 insClass">
                        <label for="exampleInputEmail1">Policy No</label>
                        <input type="text" class="form-control" name="policy_no" id="exampleInputEmail1" value='' placeholder="">
                    </div>


                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <select class="form-control m-bot15" name="bloodgroup" value=''>
                            <?php foreach ($groups as $group) { ?>
                                <option value="<?php echo $group->group; ?>" <?php
                                if (!empty($patient->bloodgroup)) {
                                    if ($group->group == $patient->bloodgroup) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $group->group; ?> </option>
                                    <?php } ?> 
                        </select>
                    </div>

                    <div class="form-group col-md-6">    
                        <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                        <select class="form-control m-bot15" id="doctorchoose" name="doctor" value=''>

                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Next of Kin</label>
                        <input type="text" class="form-control" name="kin" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Next of Kin Phone No</label>
                        <input type="text" class="form-control" name="kin_phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Next of Kin Address</label>
                        <input type="text" class="form-control" name="kin_address" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Next of Kin email</label>
                        <input type="text" class="form-control" name="kin_email" id="exampleInputEmail1" value='' placeholder="">
                    </div>



                    <div class="form-group last col-md-6">
                        <label class="control-label">Image Upload</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="//www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" id="img" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="img_url"/>
                                    </span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                            </div>

                        </div>
                    </div>


                    <!--
                    
                    <div class="form-group last col-md-6">
                        <div style="text-align:center;">
                            <video id="video" width="200" height="200" autoplay></video>
                            <div class="snap" id="snap">Capture Photo</div>
                            <canvas id="canvas" width="200" height="200"></canvas>
                            Right click on the captured image and save. Then select the saved image from the left side's Select Image button.
                        </div>
                    </div>
                    
                    -->








                    <div class="form-group col-md-6">
                        <input type="checkbox" name="sms" value="sms"> <?php echo lang('send_sms') ?><br>
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






<!-- Send  Patient Consulation-->
<div class="modal fade" id="myModal8" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  Send Patient For consultation</h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="consultationform" action="patient/consultation" class="clearfix" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Choose Doctor</label>
                        <select class="form-control m-bot15" id="doctorchoose9" name="doctor" value=''>

                        </select>
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
<!--  end Send  Patient Consulation-->


<!-- Send  Patient Consulation-->
<div class="modal fade" id="myModal9" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="vloader" style="text-align:center"><img src="uploads/loader.gif" style="width:300px; padding:10px" /></div>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title pAction"> Select Patient Action</h4>
            </div>
            <div class="modal-body row">
                <div class="actionClass">
                    <select class="form-control m-bot15" id="actionchoose" name="nurse" value='' onchange='selectchange()'>
                        <option value="none">Select Action</option>
                        <option value="vitals">Send for Vitals</option>
                        <option value="consultation">Send for Consultation</option>
                    </select>
                </div>
                <div class="consultationClass" style="display:none">
                    <form role="form" id="consultationform" action="patient/consultation" class="clearfix" method="post" enctype="multipart/form-data">

                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Choose Doctor</label>
                            <select class="form-control m-bot15" id="doctorchoose10" name="doctor" value=''>

                            </select>
                        </div>
                        <input type="hidden" id="consultvId" name="id" value=''>
                        <input type="hidden" name="p_id" value='<?php
                        if (!empty($patient->patient_id)) {
                            echo $patient->patient_id;
                        }
                        ?>'>

                        <section class="col-md-12">
                            <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                        </section>

                    </form>
                </div>

                <!-- send patient for vitals section -->
                <div class="vitalsClass" style="display:none">
                    <form role="form" id="vitalsform" action="patient/scheduleVital" class="clearfix" method="post" enctype="multipart/form-data">

                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Choose Nurse</label>
                            <select class="form-control m-bot15" id="nursechoose1" name="nurse" value=''>

                            </select>
                        </div>
                        <input type="hidden" id="vitalsvId" name="id" value=''>
                        <input type="hidden" name="p_id" value='<?php
                        if (!empty($patient->patient_id)) {
                            echo $patient->patient_id;
                        }
                        ?>'>

                        <section class="col-md-12">
                            <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                        </section>

                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
<!--  end Send  Patient Consulation-->














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

                    <div class="form-group col-md-4 iInsure">
                        <label>Insurance</label>
                        <div class="insurance"></div>     
                    </div>

                    <div class="form-group col-md-4 iInsure">
                        <label>Policy No</label>
                        <div class="policyNo"></div>     
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
        $("#img").attr("src", "uploads/cardiology-patient-icon-vector-6244713.jpg");
        $('#editPatientForm').trigger("reset");
        $.ajax({
            url: 'patient/editPatientByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            $('#editPatientForm').find('[name="id"]').val(response.patient.id).end()
            $('#editPatientForm').find('[name="name"]').val(response.patient.name).end()
            $('#editPatientForm').find('[name="password"]').val(response.patient.password).end()
            $('#editPatientForm').find('[name="email"]').val(response.patient.email).end()
            $('#editPatientForm').find('[name="address"]').val(response.patient.address).end()
            $('#editPatientForm').find('[name="phone"]').val(response.patient.phone).end()
            $('#editPatientForm').find('[name="sex"]').val(response.patient.sex).end()
            $('#editPatientForm').find('[name="birthdate"]').val(response.patient.birthdate).end()
            $('#editPatientForm').find('[name="bloodgroup"]').val(response.patient.bloodgroup).end()
            $('#editPatientForm').find('[name="p_id"]').val(response.patient.patient_id).end()
            $('#editPatientForm').find('[name="birth_place"]').val(response.patient.birth_place).end()
            $('#editPatientForm').find('[name="marital"]').val(response.patient.marital_status).end()
            $('#editPatientForm').find('[name="occupation"]').val(response.patient.occupation).end()
            $('#editPatientForm').find('[name="id_no"]').val(response.patient.id_no).end()
            $('#editPatientForm').find('[name="kin"]').val(response.patient.kin).end()
            $('#editPatientForm').find('[name="kin_phone"]').val(response.patient.kin_phone).end()
            $('#editPatientForm').find('[name="kin_address"]').val(response.patient.kin_address).end()
            $('#editPatientForm').find('[name="kin_email"]').val(response.patient.kin_email).end()

            if (typeof response.patient.img_url !== 'undefined' && response.patient.img_url != '') {
                $("#img").attr("src", response.patient.img_url);
            }

            if (response.doctor !== null) {
                var option1 = new Option(response.doctor.name + '-' + response.doctor.id, response.doctor.id, true, true);
            } else {
                var option1 = new Option(' ' + '-' + '', '', true, true);
            }
            $('#editPatientForm').find('[name="doctor"]').append(option1).trigger('change');

            
            if(response.patient.patient_type !== null){

                var option1 = new Option('HMO Patient', 'HMO Patient', true, response.patient.patient_type == "HMO Patient");
                var option2 = new Option('Corporate Patient', 'Corporate Patient', false, response.patient.patient_type == "Corporate Patient")
                var option3 = new Option('Private Patient', 'Private Patient', false, response.patient.patient_type == "Private Patient")
            
            }else{

                var option1 = new Option('HMO Patient', 'HMO Patient', true, false);
                var option2 = new Option('Corporate Patient', 'Corporate Patient', false, false)
                var option3 = new Option('Private Patient', 'HMO Patient', false, false)
            }
            if( response.patient.patient_type == "Private Patient"){
                $(".insClass").hide();
            }else{
		if(response.hmo){
                	$(".insClass").show();

                	$('#editPatientForm').find('[name="policy_no"]').val(response.patient.policy_no).end()
                	var option111 = new Option(response.hmo.name , response.patient.insurance_id, true, true);
                	$('#editPatientForm').find('[name="insurance"]').append(option111).trigger('change');
		}
            }

            $('#editPatientForm').find('[name="patient_type"]').html("").end();

            $('#editPatientForm').find('[name="patient_type"]').append(option1).trigger('change');
            $('#editPatientForm').find('[name="patient_type"]').append(option2).trigger('change');
            $('#editPatientForm').find('[name="patient_type"]').append(option3).trigger('change');

            // $('#editPatientForm').find('[name="patient_type"]').val(response.patient.patient_type).end()

            $('.js-example-basic-single.doctor').val(response.patient.doctor).trigger('change');


            $('#myModal2').modal('show');

        });
    });
</script>

<script type="text/javascript">
$(".table").on("click", ".consult", function () {
        //    e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $('#consultationform').find('[name="id"]').val(iid).end()
        $('#myModal8').modal('show');
    });
</script>
</script>


<script type="text/javascript">

    $(".table").on("click", ".checkin", function () {
        //    e.preventDefault(e);
        // Get the record's ID via attribute  
        $('#myModal9').find($(".modal-header")).hide();
        $('#myModal9').find($(".modal-body")).hide();
        $('#myModal9').find($(".vloader")).show();
        $('#myModal9').modal('show');
        var iid = $(this).attr('data-id');
        $t=$(this);
        $.ajax({
            url: 'patient/checkinPatient?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            $('#myModal9').find($(".modal-header")).show();
            $('#myModal9').find($(".modal-body")).show();
            $('#myModal9').find($(".vloader")).hide();
            $("#consultvId").val(iid);
            $("#vitalsvId").val(iid);
             $t.attr("class","btn checkout")
            $t.attr("style","background-color:#b10101; color:#fff")
            $t.attr("title","Check Out")
            $t.html("<i class='fa fa-user'></i> Check Out")
        });
        
    });

</script>

<script>
function selectchange(){
    $(document).ready(function(){
        selectDom=document.getElementById("actionchoose");
        val=selectDom.options[selectDom.selectedIndex].value;
        if(val=="none"){
            $(".consultationClass").hide();
            $(".vitalsClass").hide();
            $(".pAction").html("Select Patient Action");
        }else if(val=="vitals"){
            $(".consultationClass").hide();
            $(".vitalsClass").show();
            $(".pAction").html("Send Patient For Vitals")
        }else{
            $(".consultationClass").show();
            $(".vitalsClass").hide();
            $(".pAction").html("Send Patient For Consultation")
        }
    })
    
}
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
            $t.html("<i class='fa fa-user'></i> Check In")
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
        $('.insurance').html("").end()
        $('.policyNo').html("").end()
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

            if(response.patient.patient_type == "Private Patient"){
                $(".iInsure").hide();
            }else{
		if(response.hmo){
                	$(".iInsure").show();
                	$('.insurance').append(response.hmo.name).end()
                	$('.policyNo').append(response.patient.policy_no).end()
		}
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
                url: "patient/getPatient",
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

        $("#doctorchoose9").select2({
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

        $("#doctorchoose10").select2({
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

$("#nursechoose1").select2({
    placeholder: 'Select Nurse',
    allowClear: true,
    ajax: {
        url: 'patient/getNurseInfo',
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

$("#insurance").select2({
    placeholder: 'Select Insurance',
    allowClear: true,
    ajax: {
        url: 'finance/getInsuranceInfo',
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


$("#insurance01").select2({
    placeholder: 'Select Insurance',
    allowClear: true,
    ajax: {
        url: 'finance/getInsuranceInfo',
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



