<style>
.half{width:40%; display:inline-block; padding:5px 0}
.half:nth-child(even){float:right}
.half >span{font-weight:bold;}
#a_check{padding:5px 10px;color:white; font-weight:bold; font-size:13px}
.subs{width:30%; display:inline-block; font-family: sans-serif; font-weight: bold; color: #779;}
.cat_tgg { background-color: #eee; color: #444; cursor: pointer; padding: 18px; width: 100%;
    text-align: left; border: none; outline: none; transition: 0.4s;}
/* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
.cat_tgg .active, .cat_tgg:hover { background-color: #ccc;}
/* Style the accordion panel. Note: hidden by default */
.cat_panel { padding: 0 18px; background-color: white; max-height: 0; overflow: hidden;  transition: max-height 0.2s ease-out;}
.cat_tgg:after { content: '\02795'; font-size: 13px; color: #777; float: right; margin-left: 5px;}

.cat_tgg.active:after {content: "\2796"; /* Unicode character for "minus" sign (-) */}
.ximagepanel img{width:95%; margin:0 auto;}
.editcase{display:none; position: fixed; width: 100%; height: 100%; background: rgba(255,255,255,.8);
z-index: 99999999999999999999999; padding: 300px 100px; font-weight: bold; font-size:20px}
</style>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        
        <section class="col-md-5">
            <div class="editcase">Processing... Please wait</div>

            <header class="panel-heading">
                <?php echo lang('add'); ?> <?php echo lang('case'); ?> 
                <span id="a_check"></span>
            </header> 

            <div class=""> 
            <?php 
                if(count($depts) > 1){
            ?>
                <div class="form-group col-md-12">
                    <br/>
                    <label for="exampleInputEmail1">Consult as:</label>
                    <select class="form-control form-control-inline input-medium" id="template" onchange="template()">
                        <?php
                            $dept_id="";
                            if($this->input->get("dept")){
                                $dept_id=$this->input->get("dept");
                                $d_d=$this->department_model->getDepartmentById($dept_id);
                                ?>
                                    <option value="<?php echo $d_d->id;?>"><?php echo $d_d->name;?></option>
                                <?php
                            }
                            foreach($depts as $d){
                                if($dept_id ==$d){
                                    continue;
                                }
                                $d_d=$this->department_model->getDepartmentById($d);
                                ?>
                                    <option value="<?php echo $d_d->id;?>"><?php echo $d_d->name;?></option>
                                <?php
                            }
                        ?>
                    </select><br/><br/>
                </div>
            <?php
                }
            ?>
                <form role="form" id="main_form" action="patient/addMedicalHistory" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="" readonly="" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                        <?php
                            $disabled="";
                            $name="patient_id";
                            if($this->input->get("consult") != null){
                                $name="pp";
                                $disabled="disabled=disabled";
                                echo "<input type='hidden' name='patient_id' value='".$consult['id']."' />";
                            }
                        ?>
                        <input type="hidden" value="<?php echo $consult_dept;?>"  name="department"/>
                        <select class="form-control m-bot15" id="patientchoose" name="<?php echo $name;?>" value='' <?php echo $disabled;?> onchange="vitals()">
                            
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('title'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium" name="title" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-12" id="vitals" >
                        <label for="exampleInputEmail1">Patient Vitals</label><br/>
                        <center id="center" style="display:none" >Processing</center>
                        <div id="hider" style="display:none">
                            <div class="half">Height : <span id="height"></span></div>
                            <div class="half">Weight : <span id="weight"></span></div>
                            <div class="half">BP : <span id="bp"></span></div>
                            <div class="half">Pulse : <span id="pulse"></span></div>
                            <div class="half">Temperature : <span id="temperature"></span></div>
                            <div class="half">Respiration : <span id="respiration"></span></div>
                            <div class="half">Vitals By : <span id="vitals_by"></span></div>
                            <div class="half">Date Taken : <span id="date"></span></div>
                            <!-- custom hospital vitals -->
                            <?php 
                                foreach($vitals as $vital){
                                    ?>
                                    <div class="half">
                                        <?php echo $vital->name;?>: 
                                        <span id="<?php echo $vital->id;?>ID"></span>
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                    <!-- reqeusst tteesst seccttioin -->
                        <input type="hidden" name="tests" id="tests"/>
                        <input type="hidden" name="rad_tests" id="rad_tests"/>
                    <!-- reqquestt tetest secttion end -->
                    <!-- Symptoms Section -->
                    <div class="symp">
                        <input type="hidden" value="0" name="sCount" id="sCount" />
                        <div class="symp-adder" id="sAdd">
                            
                        </div>
                        <div style="text-align:center">
                            <div id="addSymp" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> Add Symptom
                            </div>
                        </div>
                        

                    </div>
                    <div id="customformview">
                    <?php
                        if ($this->ion_auth->in_group('Doctor') && $forms !== null) {
                            $count=0;
                            $formNum=0;
                            foreach ($forms as $form){
                                $formname="form_".$formNum."_";
                                ?>
                                <input type="hidden" name="<?php echo $formname."id"; ?>" value="<?php echo $form->id; ?>">
                                <?php
                                if($form->type == "text"){
                                    ?>
                                    <div class="form-group col-md-12">
                                        <label for="exampleInputEmail1"><?php echo $form->name; ?></label>
                                        <textarea class="form-control form-control-inline input-medium" name="<?php echo $formname.'name'; ?>" id="exampleInputEmail1" value='' placeholder=""></textarea>
                                        </div>
                                    <?php
                                }else if($form->type == "polar"){
                                    ?>
                                    <div class="form-group col-md-12">
                                        <label for="exampleInputEmail1"><?php echo $form->name; ?></label>
                                        <span style="margin-left:10px; font-weight: bold; color: #777;">Yes <input type="radio" name="<?php echo $formname.'name'; ?>" value="Yes" /> </span>
                                        <span style="margin-left:10px; font-weight: bold; color: #777;">No <input type="radio" name="<?php echo $formname.'name'; ?>" value="No" /> </span>
                                        </div>
                                    <?php
                                }else if($form->type == "date"){
                                    ?>
                                    <div class="form-group col-md-12">
                                        <label for="exampleInputEmail1"><?php echo $form->name; ?></label>
                                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="<?php echo $formname.'name'; ?>" id="exampleInputEmail1" value='' placeholder="" readonly="" />
                                    </div>
                                    <?php
                                }else if($form->type == "image"){
                                    ?>
                                    <div class="form-group col-md-12">
                                        <label for="exampleInputEmail1"><?php echo $form->name; ?></label><br />
                                        <div class="form-group last col-md-6">
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
                                                            <input type="file" class="default" name="<?php echo $formname.'name'; ?>"/>
                                                        </span>
                                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="" readonly="" /> -->
                                    </div>
                                    <?php
                                }else if($form->type == "group"){
                                    ?>
                                    <div class="form-group col-md-12" style="border:2px solid #e1e1e1; padding:10px">
                                        <label for="exampleInputEmail1" style="font-size:16px"><?php echo $form->name; ?></label><br/>
                                        <?php 
                                            $in="f".$form->id;
                                            for($i=0; $i<count($groups[$in]); $i++){
                                                $dt=$groups[$in][$i];
                                                $pre=$formname.'group_'.$i."_";
                                                ?>
                                                <input type="hidden" name="<?php echo $pre."id"; ?>" value="<?php echo $dt->id; ?>">
                                                <?php
                                                if($dt->type == "text"){
                                                    ?>
                                                    <div class="form-group col-md-12">
                                                        <label for="exampleInputEmail1"><?php echo $dt->name; ?></label>
                                                        <textarea class="form-control form-control-inline input-medium" name="<?php echo $pre."name"; ?>" id="exampleInputEmail1" value=''></textarea>
                                                    </div>
                                                    <?php
                                                }else if($dt->type == "date"){
                                                    ?>
                                                    <div class="form-group col-md-12">
                                                        <label for="exampleInputEmail1"><?php echo $dt->name; ?></label>
                                                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="<?php echo $pre."name"; ?>" id="exampleInputEmail1" value='' placeholder="" readonly="" />
                                                    </div>
                                                    <?php
                                                }else if($dt->type == "polar"){
                                                    ?>
                                                    <div class="form-group col-md-12">
                                                        <label for="exampleInputEmail1"><?php echo $dt->name; ?></label>
                                                        <span style="margin-left:10px; font-weight: bold; color: #777;">Yes <input type="radio" name="<?php echo $pre.'name'; ?>" value="Yes" /> </span>
                                                        <span style="margin-left:10px; font-weight: bold; color: #777;">No <input type="radio" name="<?php echo $pre.'name'; ?>" value="No" /> </span>
                                                        </div>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </div>
                                    <?php
                                }
                                $formNum++;
                            }
                        }
                    ?>
                    </div>
                    <div class="form-group col-md-12">
                        <label class=""><?php echo lang('case'); ?></label>
                        <textarea class="form-control ckeditor editor" id="editor" name="description" value="" rows="70" cols="70"></textarea>
                    </div>
                    <div class="form-group col-md-12" id="caseRequest" style="margin:10px auto; border:2px solid #eee; padding:10px 5px; display:none">
                        <label class="">Request for: </label><br/>
                        <span class="btn"  onclick="showprocedure()">Procedure</span>
                        <span class="btn" onclick="showlabtest()">Lab Test</span>
                        <span class="btn" onclick="showradiology()">Radiology</span>
                    </div>
                    <section class="col-md-12">
                        <button type="submit" name="submit" class="btn btn-info submit_button pull-right"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>

        </section>


        <section class="col-md-7">
            <header class="panel-heading">
                Case Helper
            </header> 
            <div class="panel-body"> 

                <div class="adv-table editable-table">
                    <!-- start of options tab -->
                    <header class="panel-heading tab-bg-dark-navy-blueee">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a data-toggle="tab" href="#pInfo">Patient Info</a>
                            </li>
                            <li class="">
                                <a data-toggle="tab" href="#pcase">Cases</a>
                            </li>
                            <li class="">
                                <a data-toggle="tab" href="#ltest"> Lab History </a> 
                            </li>
                            <li class="">
                                <a data-toggle="tab" href="#allergy">Allergies</a>
                            </li>
                            <li class="">
                                <a data-toggle="tab" href="#pxhistory">Pharmacy</a>
                            </li>
                            <li class="">
                                <a data-toggle="tab" href="#xhistory">Xray & Scans</a>
                            </li>
                            <li class="">
                                <a data-toggle="tab" href="#dhistory">Documents</a>
                            </li>
                            <li class="">
                                <a data-toggle="tab" href="#labrequest">Lab Request</a> 
                            </li>
                            <li class="">
                                <a data-toggle="tab" href="#radrequest">Scan & Xray Request</a> 
                            </li>
                        </ul>
                    </header>
                    <div class="panel">
                        <div class="tab-content">
                            <div id="pcase" class="tab-pane">
                                <br/>
                                <div class="">
                                    <div class="adv-table editable-table">
                                        <table class="table table-striped table-hover table-bordered" id="pcase-sample">
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
                            </div>

                            <div id="ltest" class="tab-pane">
                                <br/>
                                <div class="">
                                    <div class="adv-table editable-table">
                                        <table class="table table-striped table-hover table-bordered" id="ltest-sample">
                                            <thead>
                                                <tr>
                                                    <th><?php echo lang('report_id'); ?></th>
                                                    <th><?php echo lang('patient'); ?></th>
                                                    <th><?php echo lang('date'); ?></th>
                                                    <th class=""><?php echo lang('options'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div id="allergy" class="tab-pane">
                                <br/>
                                <div class="">
                                    <div class="adv-table editable-table">
                                        <table class="table table-striped table-hover table-bordered" id="allergy-sample">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Allergy</th>
                                                    <th>Type</th>
                                                    <th>Severity</th>
                                                    <th class=""><?php echo lang('options'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div id="pxhistory" class="tab-pane">
                                <br/>
                                <div class="">
                                    <div class="adv-table pxhistory-table">
                                        <table class="table table-striped table-hover table-bordered" id="pxhistory-sample">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Date</th>
                                                    <th>Patient</th>
                                                    <th>Medicine</th>
                                                    <th class=""><?php echo lang('options'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div id="xhistory" class="tab-pane">
                                <br/>
                                <div class="">
                                    <div class="adv-table xhistory-table">
                                        <table class="table table-striped table-hover table-bordered" id="xhistory-sample">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Patient</th>
                                                    <th>Title</th>
                                                    <th>Doctor</th>
                                                    <th class=""><?php echo lang('options'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div id="dhistory" class="tab-pane">
                                <br/>
                                <div class="">
                                    <div class="adv-table dhistory-table">
                                        <table class="table table-striped table-hover table-bordered" id="dhistory-sample">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Patient</th>
                                                    <th>Title</th>
                                                    <th class=""><?php echo lang('options'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div id="pInfo" class="tab-pane active">
                                <br/>
                                <div class="">
                                    <form role="form" id="editPatientForm" action="patient/addNew" class="clearfix" method="post" enctype="multipart/form-data">

                                        <div class="form-group last col-md-12">
                                            <div class="col-md-4">
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
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                                            <div class="nameClass"></div>
                                        </div>


                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                                            <div class="emailClass"></div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label><?php echo lang('age'); ?></label>
                                            <div class="ageClass"></div>     
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                                            <div class="addressClass"></div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1"><?php echo lang('gender'); ?></label>
                                            <div class="genderClass"></div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                                            <div class="phoneClass"></div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                                            <div class="bloodgroupClass"></div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Religion</label>
                                            <div class="religionClass"></div>     
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label><?php echo lang('birth_date'); ?></label>
                                            <div class="birthdateClass"></div>     
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Place of Birth</label>
                                            <div class="placeOfBirth"></div>     
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Marital Status</label>
                                            <div class="marital"></div>     
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Occupation</label>
                                            <div class="occupation"></div>     
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Service / ID No</label>
                                            <div class="IdNo"></div>     
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Patient Type</label>
                                            <div class="patientType"></div>     
                                        </div>

                                        <div class="form-group col-md-6 iInsure">
                                            <label>Insurance</label>
                                            <div class="insurance"></div>     
                                        </div>

                                        <div class="form-group col-md-6 iInsure">
                                            <label>Policy No</label>
                                            <div class="policyNo"></div>     
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Next of Kin</label>
                                            <div class="nextOfKin"></div>     
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Kin Relationship</label>
                                            <div class="kinRelationship"></div>     
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Next of Kin Phone</label>
                                            <div class="kinPhone"></div>     
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Next of Kin Email</label>
                                            <div class="kinEmail"></div>     
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Next of Kin Address</label>
                                            <div class="kinAddress"></div>     
                                        </div>





                                        <div class="form-group col-md-6">    
                                        </div>
                                        <div class="form-group col-md-6">    
                                        </div>
                                        <div class="form-group col-md-4">    
                                            <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                                            <div class="doctorClass"></div>
                                        </div>







                                    </form>
                                </div>
                            </div>

                            <div id="labrequest" class="tab-pane">
                                <br/>
                                <div class="">
                                    <div class="adv-table editable-table">
                                        <table class="table table-striped table-hover table-bordered" id="lreq-sample">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%"><?php echo lang('date'); ?></th>
                                                    <th style="width: 15%"><?php echo lang('patient'); ?></th>
                                                    <th style="width: 15%">Test</th>
                                                    <th style="width: 10%;" class="no-print">Request By</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div id="radrequest" class="tab-pane">
                                <br/>
                                <div class="">
                                    <div class="adv-table editable-table">
                                        <table class="table table-striped table-hover table-bordered" id="rreq-sample">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%"><?php echo lang('date'); ?></th>
                                                    <th style="width: 15%"><?php echo lang('patient'); ?></th>
                                                    <th style="width: 15%">Scan</th>
                                                    <th style="width: 10%;" class="no-print">Request By</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end of options tab -->
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
                            <textarea class="ckeditor form-control editors" id="editors" name="description" value="" rows="10"></textarea>
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

<!-- allergy modal start-->
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
<!-- allergy modal end -->



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


<!-- view prescription modal -->
<div class="modal fade" id="pxModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close no-print" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('case'); ?> <?php echo lang('details'); ?></h4>
            </div>
            <div class="modal-body row">
                <div class="col-md-12 panel bg_container margin_top" id="prescription">
                    <div class="bg_prescription">
                        <div class="panel-body">
                            <div class="">
                                <h5 class="col-md-4 prescription"><?php echo lang('date'); ?> : <span class="pdate"></span></h5>
                                <h5 class="col-md-3 prescription"><?php echo lang('prescription'); ?> <?php echo lang('id'); ?> : <span class="px_id"></span></h5>
                                <h5 class="col-md-3 prescription">Prescribed By : <span class="px_doctor"></span></h5>
                            </div>
                        </div>

                        <hr>
                        <div class="col-md-12 clearfix" style="margin: 50px 0px;">

                            <div class="col-md-5 left_panel">

                                <div class="panel-body">
                                    <div class="pull-left">
                                        <h5><strong><?php echo lang('history'); ?>: </strong> <br> <br> <span class="px_history"></span></h5>
                                    </div>
                                </div>

                                <hr>

                                <div class="panel-body">
                                    <div class="pull-left">
                                        <h5><strong><?php echo lang('note'); ?>:</strong> <br> <br> <span class="px_note"></span></h5>
                                    </div>
                                </div>




                                <hr>

                                <div class="panel-body">
                                    <div class="pull-left">
                                        <h5><strong><?php echo lang('advice'); ?>: </strong> <br> <br> <span class="px_advice"></span></h5>
                                    </div>
                                </div>




                            </div>

                            <div class="col-md-7">

                                <div class="panel-body">
                                    <div style="padding-left: 10px; ">
                                        <strong style="border-bottom: 1px solid #000;"> Rx </strong>
                                    </div>
                                        <table class="table table-striped table-hover">                      
                                            <thead>       
                                            <th><?php echo lang('medicine'); ?></th>
                                            <th><?php echo lang('instruction'); ?></th>
                                            <th class="text-right"><?php echo lang('frequency'); ?></th>    
                                            </thead>
                                            <tbody class="tbody">
                                                    <!-- <tr>
                                                        <?php $single_medicine = explode('***', $value); ?>

                                                        <td class=""><?php echo $this->medicine_model->getMedicineById($single_medicine[0])->name . ' - ' . $single_medicine[1]; ?> </td>
                                                        <td class=""><?php echo $single_medicine[3] . ' - ' . $single_medicine[4]; ?> </td>
                                                        <td class="text-right"><?php echo $single_medicine[2] ?> </td>
                                                    </tr> -->
                                            </tbody>
                                        </table>
                                </div>


                            </div>

                        </div>


                        <!--
                        <div class="panel-body">
                            <h5 style="text-align: center;"><?php echo lang(''); ?> <br> <br> <?php echo $settings->default_text_for_prescription; ?></h5>
                        </div>
                        -->

                    </div>









                    <div class="panel-body prescription_footer">
                        <div class="col-md-4 pull-left" style="font-size: 12px; margin-top: 70px;"> <hr> <?php echo lang('signature'); ?></div>
                        <div class="col-md-8 pull-right text-right">
                            <h3 class='hospital'><?php echo $settings->title; ?></h3>
                            <h5><?php echo $settings->address; ?></h5>
                            <h5><?php echo $settings->phone; ?></h5>
                        </div>
                    </div>  


                </div>
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- view prescription modal end -->


<!-- view documents modal -->
<div class="modal fade" id="docsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body row">
                <div id="imgview" style="display:none">
                    <img id="imgview-img" style="max-width:100%;"/>
                </div>
                <div id="pdfview" style="display:block">
                    <div class="top-bar">
                        <button class="btn" id="prev-page">
                            <i class="fa fa-fa-arrow-circle-left"></i> Prev Page
                        </button>
                        <button class="btn" id="next-page">
                            Next Page <i class="fa fa-fa-arrow-circle-right"></i>
                        </button>
                        <span class="page-info">
                            Page <span id="page-num"></span> of <span id="page-count"></span>
                        </span>
                    </div>
                    <canvas id="pdf-render"></canvas>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- view documents modal end -->

<!-- lab report view -->
<div class="modal fade" id="labtestModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                            <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                            <div class="lab_date"></div>
                        </div>
                        <div class="form-group col-md-6 case_patient_block">
                            <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                            <div class="lab_patient"></div>
                        </div> 
                        <div>
                            <hr>
                        </div>
                    </div>
                    <div class="form-group col-md-12 row">
                        <div class="form-group col-md-6 case_date_block">
                            <label for="exampleInputEmail1"> Request Doctor</label>
                            <div class="lab_doctor"></div>
                        </div>
                        <div class="form-group col-md-6 case_patient_block">
                            <label for="exampleInputEmail1">Laboratorist</label>
                            <div class="laboratorist"></div>
                        </div> 
                        <div>
                            <hr>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Lab Report</label>
                        <div class="lab_report"></div>
                        <hr>
                    </div>

                    <div class="panel col-md-12 no-print">
                        <a class="btn btn-info invoice_button pull-right" onclick="javascript:window.print();"><i class="fa fa-print"></i> <?php echo lang('print'); ?> </a>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- lab view end -->


<!-- view xray modal -->
<div class="modal fade" id="xModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body row">
                <div class="col-md-12 panel bg_container margin_top" id="xrayview">
                    <div class="xmodal-head">
                    </div>
                    <div class="xmodal-body" style="margin-top:20px">

                    </div>
                </div>
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- view xray modal end -->




<!-- view request modal -->
<div class="modal fade" id="reqModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body row">
                <div class="col-md-12 panel bg_container margin_top" id="xrayview">
                    <div class="operation_tab">
                        <br/>
                        <label class="">Search for Procedure</label>
                        <select class="form-control m-bot15 medicinee"  id="my_select1_disabled" name="category" value=''>

                        </select>
                        <div class="operation_error" style="color:red; font-weight:bold; text-align:center; font-size:16px;"></div>
                        <button class="btn" onclick="pro_req()">Request</button><span id="pro_stat"></span>
                    </div>
                    <div class="labreq_tab">
                        <br/>
                        <label class="">Search for Test</label>
                        <select class="form-control m-bot15 medicinee"  id="my_select2_disabled" name="category" value=''>

                        </select>
                        <div class="lab_error" style="color:red; font-weight:bold; text-align:center; font-size:16px;"></div>
                        <button class="btn" onclick="lab_req()">Request</button><span id="pro_stat2"></span>
                    </div>
                    <div class="radioreq_tab">
                        <br/>
                        <label class="">Search for Scan</label>
                        <select class="form-control m-bot15 medicinee"  id="my_select3_disabled" name="category" value=''>

                        </select>
                        <div class="rad_error" style="color:red; font-weight:bold; text-align:center; font-size:16px;"></div>
                        <button class="btn" onclick="rad_req()">Request</button><span id="pro_stat3"></span>
                    </div>
                </div>
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- end of -->




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

<script>
    $(document).ready(function(){
        $(".def-check").click(function(){
            test="";
            $(".def-check").each(function(){
                if($(this).is(":checked")){
                if(test ==""){
                   test= $(this).val();
                }else{
                    test=test+"|"+$(this).val();
                } 
            }
            $("#tests").val(test);
            })
            
        })
    });
</script>

<script>
    
    $(document).ready(function(){
        $(".rad-check").click(function(){
            test="";
            $(".rad-check").each(function(){
                if($(this).is(":checked")){
                if(test ==""){
                   test= $(this).val();
                }else{
                    test=test+"|"+$(this).val();
                } 
            }
            $("#rad_tests").val(test);
            })
            
        })
    });
</script>



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
            console.log(da)
            $('#medical_historyEditForm').find('[name="id"]').val(response.medical_history.id).end()
            $('#medical_historyEditForm').find('[name="date"]').val(da).end()
            //   $('#medical_historyEditForm').find('[name="patient"]').val(response.medical_history.patient_id).end()
            $('#medical_historyEditForm').find('[name="title"]').val(response.medical_history.title).end()
            CKEDITOR.instances['editor'].setData(response.medical_history.description)
            var option = new Option(response.patient.name + '-' + response.patient.id, response.patient.id, true, true);
            // $('#main_form').find('[name="patient_id"]').append(option).trigger('change');
            //   $('.js-example-basic-single.patient').val(response.medical_history.patient_id).trigger('change');
            if(response.forms){
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
                                if(fg != null){
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


<script>
    function readpdf(u){
        const url=encodeURI("../"+u);
        let pdfDoc=null,
            pageNum=1,
            pageIsRendering=false,
            pageNumIsPending=null;
        const scale=1.5,
        canvas=document.querySelector("#pdf-render"),
        ctx=canvas.getContext('2d');

        //render page
        const renderPage= num => {
            pageIsRendering=true;

            //get Page
            pdfDoc.getPage(num).then(page => {
                //set the scale
                const viewport=page.getViewport({scale});
                canvas.height=viewport.height;
                canvas.width=viewport.width;
                const renderCtx={
                    canvasContext: ctx,
                    viewport
                }
                page.render(renderCtx).promise.then(() => {
                    pageIsRendering=false;

                    if(pageNumIsPending !== null){
                        renderPage(pageNumIsPending);
                        pageNumIsPending=null;
                    }
                });

                //output current page
                document.querySelector("#page-num").textContent=num;
            })
        }

        //check for pages rendering
        const queueRenderPage= num => {
            if(pageIsRendering){
                pageNumIsPending=num;
            }else{
                renderPage(num);
            }
        }

        //show prev page
        const showPrevPage = () =>{
            if(pageNum <= 1){
                return;
            }
            pageNum--;
            queueRenderPage(pageNum);
        }

        //show next page
        const showNextPage = () =>{
            if(pageNum >= pdfDoc._pdfInfo.numPages){
                return;
            }
            pageNum++;
            queueRenderPage(pageNum);
        }

        //get document
        pdfjsLib.getDocument(url).promise.then(pdfDoc_=> {
            pdfDoc=pdfDoc_;
            document.querySelector("#page-count").textContent=pdfDoc._pdfInfo.numPages;

            renderPage(pageNum);
            // console.log(pdfDoc)
        })

        //btn events
        document.querySelector("#prev-page").addEventListener('click',showPrevPage);
        document.querySelector("#next-page").addEventListener('click',showNextPage);

        $('#pdfview').css('display','block');
        $('#imgview').css('display','none');
        $('#docsModal').modal('show');
    }
</script>

<script>
    function readimg(u){
        $('#pdfview').css('display','none');
        $('#imgview').css('display','block');
        $("#imgview-img").attr('src',u);
        $('#docsModal').modal('show');
    }
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
            $(this).select2({
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
        $('.symps').html("").end()
        $('.case_doctor').html("").end()
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
            console.log(response.symptoms)
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
                console.log(response.symptoms.length)
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
                console.log(response.symptoms[i].name)
                console.log("here")
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
                                if(fg != null){
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
    //view lab test
    $("#ltest-sample").on("click", ".detailsbutton", function () {
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $('.lab_date').html("").end()
        $('.lab_patient').html("").end()
        $('.lab_doctor').html("").end() 
        $('.laboratorist').html("").end()
        $('.lab_report').html("").end()
        $.ajax({
            url: 'lab/getLabByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            console.log(response)
            $('.lab_date').html(response.lab.date_string).end()
            $('.lab_patient').html(response.lab.patient_name).end()
            $('.lab_doctor').html(response.lab.doctor_name).end()
            $('.laboratorist').html(response.laboratorist).end()
            $('.lab_report').html(response.lab.report).end()
            $('#labtestModal').modal('show');

        });
    });
</script>


<script type="text/javascript">

    $(".table").on("click", ".xrayview", function () {
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $("#customForm").html("").end()
        $.ajax({
            url: 'lab/getRadioByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            console.log(response)
            // Populate the form fields with the data returned from server
            var de = response.lab.date * 1000;
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
            var controller="<div id='addSymp' class='btn green btn-xs xmodalcontroller' data-src='1' >"+
                "<i class='fa fa-image'></i> View Report"+
                "</div>";
            //loop through the images
            var images=response.images;
            for(var i=0; i<images.length; i++){
                e=i+2;
                num=i+1;
                controller = controller+ " <div id='' data-src='"+e+"' class='xmodalcontroller btn green btn-xs'>"+
                "<i class='fa fa-image'></i> Image "+num+
                "</div>";
            }
            $(".xmodal-head").html(controller);

            var xbody="<div class='panel panel-primary xtab' id='xtab-1'>"+
                    "<div class='panel-body' style='font-size: 10px;'>"+
                        "<div class='row invoice-list'>"+
                            "<div class='col-md-12 invoicespace'>"+
                                "<div class='col-md-6 pull-left' style='text-align: left;'>"+
                                    "<div class='col-md-12 row details' style=''>"+
                                        "<p>"+
                                            "<label class='control-label'> Report Id </label>"+
                                            "<span style='text-transform: uppercase;'> : "+
                                                response.lab.id+
                                            "</span>"+
                                        "</p>"+
                                    "</div>"+
                                    "<div class='col-md-12 row details'>"+
                                        "<p>"+
                                            "<label class='control-label'>Date </label>"+
                                            "<span style='text-transform: uppercase;'> : "+
                                                da+
                                            "</span>"+
                                        "</p>"+
                                    "</div>"+
                                "</div>"+
                            "</div>"+
                        "</div> "+
                        "<div class='col-md-12 panel-body'>"+
                            "<p style='font-size:15px; font-weight:bold'>"+
                                response.lab.title+
                            "</p>"+
                            response.lab.description+
                        "</div>"+
                    "</div>"+
                "</div>";

                for(var i=0; i<images.length; i++){
                    e=i+2;
                    xbody = xbody+ "<div style='display:none' class='panel panel-primary ximagepanel xtab' id='xtab-"+e+"'><img src='"+images[i].image+"'/></div>"
                }
                
            $(".xmodal-body").html(xbody);
            $('#xModal').modal('show');
            addmEvents();

        });
    });
</script>

<script>
    function addmEvents(){
        $(document).ready(function(){
            $('.xmodalcontroller').each(function(){
                var item=$(this);
                var iid = item.attr('data-src');
                console.log(iid)
                item.on("click", function () {
                    $(".xtab").each(function(){
                        $(this).css("display","none")
                    })
                    $("#xtab-"+iid).css("display","block")
                })
            })
        })
    }
</script>

<script>
    //view lab test
    $("#pxhistory-sample").on("click", ".pxinfo", function (e) {
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $('.pdate').html("").end()
        $('.px_id').html("").end()
        $('.px_history').html("").end()
        $('.px_doctor').html("").end()
        $('.px_note').html("").end()
        $('.px_advice').html("").end()
        $('.tbody').html("").end()
        $.ajax({
            url: 'prescription/getPrescriptionById?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            console.log(response)
            $('.pdate').html(response.date).end()
            $('.px_id').html(response.prescription.id).end()
            $('.px_doctor').html(response.doctor).end()
            $('.px_history').html(response.prescription.symptom).end()
            $('.px_note').html(response.prescription.note).end()
            $('.px_advice').html(response.prescription.advice).end()
            $('.tbody').html(response.medicine).end()
            $('#pxModal').modal('show');
        });
    });
</script>

<script>
    function template(){
        var select= document.getElementById("template");
        var dept=select.options[select.selectedIndex].value;
        <?php
            if(isset($_GET['consult'])){
                $link=base_url()."patient/caseManager?consult=".$this->input->get("consult")."&dept=";
            }else{
                $link=base_url()."patient/caseManager?dept=";
            }
        ?>
        link="<?php echo $link;?>"+dept;
        window.location=link;
    }
</script>

<script>
    function showprocedure(){
        $('#reqModal').modal('show');
        $(".operation_tab").css('display','block');
        $(".labreq_tab").css('display','none');
        $(".radioreq_tab").css('display','none');
        
    }

    function showlabtest(){
        $('#reqModal').modal('show');
        $(".operation_tab").css('display','none');
        $(".labreq_tab").css('display','block');
        $(".radioreq_tab").css('display','none');
    }

    function showradiology (){
        $('#reqModal').modal('show');
        $(".operation_tab").css('display','none');
        $(".labreq_tab").css('display','none');
        $(".radioreq_tab").css('display','block');
    }
</script>

<script>
    function editCaseFile(patient){
        $(".editcase").css("display","block");
        $.ajax({
            url: 'patient/editMedicalHistoryByJason?id=' + patient,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            if(response.error!=null){
                $(".editcase").html("Patient not checked in by front desk");
                return;
            }else if(response.pay != null){
                $(".editcase").html(response.pay);
                return;
            }
            else if(response.medical_history==null){
                $(".editcase").css("display","none");
            }else{
                //ask the question
                $(".editcase").css("display","none");
                Confirm.onYes(function(){populate(response)});
                Confirm.render("Do you want to edit patient's case file from today's checkin?")
                
            }
            
            return
            // Populate the form fields with the data returned from server

        });
    }
</script>


<script>
    function populate(response){
        $("#customformview").html("")
        var de = response.medical_history.date * 1000;
        var d = new Date(de);
        var da = d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear();
        var idNode="<input type='hidden' value='"+response.medical_history.id+"' name='id'/>"
        $('#main_form').find('[name="id"]').val(response.medical_history.id).end()
        $('#main_form').find('[name="department"]').val(response.medical_history.department).end()
        $('#main_form').find('[name="date"]').val(da).end()
        //   $('#medical_historyEditForm').find('[name="patient"]').val(response.medical_history.patient_id).end()
        $('#main_form').find('[name="title"]').val(response.medical_history.title).end()
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
                    inputD="<textarea class='form-control form-control-inline input-medium' name='"+formname+"name' id='exampleInputEmail1' placeholder=''>"+data+"</textarea>";
                }else if(response.forms[i].type=="polar"){
                    data=data || "";
                    yes="";
                    no="";
                    if(data=="Yes"){
                       yes="checked='true'" 
                    }else if(data=="No"){
                        no="checked='true'" 
                    }
                    d="<span style='margin-left:10px; font-weight: bold; color: #777;'>Yes <input type='radio' name='"+formname+"name' value='Yes'"+yes+" /> </span>"
                    inputD=d+"<span style='margin-left:10px; font-weight: bold; color: #777;'>No <input type='radio' name='"+formname+"name' value='No' "+no+" /> </span>"
                                                        
                    // inputD="<input type='text' class='form-control form-control-inline input-medium' name='"+formname+"name' id='exampleInputEmail1' value='"+data+"' placeholder=''/>";
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
                            if(fg != null){
                                groupId="<input type='hidden' name='"+pre+"id' value='"+fg.form_id+"'/>";
                                if(gA[gId][e].type=="date"){
                                    data=getresponseDate(fg.data)
                                    inputD="<input type='text' class='form-control form-control-inline input-medium default-date-picker' name='"+pre+"name' id='exampleInputEmail1' value='"+data+"' placeholder='' readonly=''/>";
                                }else if(gA[gId][e].type=="text"){
                                    data=fg.data
                                    inputD="<textarea type='text' class='form-control form-control-inline input-medium' name='"+pre+"name' id='exampleInputEmail1' placeholder=''>"+data+"</textarea>";
                                }else if(gA[gId][e].type=="polar"){
                                    data=fg.data
                                    yes="";
                                    no="";
                                    if(data=="Yes"){
                                    yes="checked=true" 
                                    }else if(data=="No"){
                                        no="checked=true" 
                                    }
                                    d="<span style='margin-left:10px; font-weight: bold; color: #777;'>Yes <input type='radio' name='"+pre+"name' value='Yes'"+yes+" /> </span>"
                                    inputD=d+"<span style='margin-left:10px; font-weight: bold; color: #777;'>No <input type='radio' name='"+pre+"name' value='No' "+no+" /> </span>"
                                    // inputD=data;                 
                                }
                            }
                            div+="<div class='form-group col-md-12'>"+groupId+
                                    "<label for='exampleInputEmail1'>"+gA[gId][e].name+" </label>"+
                                    inputD+
                                "</div>"
                        }
                    }
                    div+="</div>";
                }
                
                $("#customformview").append(div);
                $("#customformview").append(idNode);
                
            }  
        }
    }
</script>

<script>
    function vitals(){
        var select= document.getElementById("patientchoose");
        var patient=select.options[select.selectedIndex].value;
        getCaseFile(patient);
        editCaseFile(patient)
        // $(".editcase").css("display","block");
        document.getElementById("hider").style.display="none";
        document.getElementById("center").style.display="block";
        document.getElementById("caseRequest").style.display="block";
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
</script>

<script>
    var table,ltable,atable,pxtable,xtable,dtable;
    var cData={};
    function getCaseFile(patient){
        cData.id=patient;
        //check if patient have allergies
        var a=document.getElementById("a_check");
        a.innerHTML="Please wait..."
        a.style.background="#ffd50a"
        $.ajax({
            type: "POST",
            url: "patient/getAllergies",
            dataType:"json",
            data:{"id":patient},
            success: function(response){
                if(response.data.length >0){
                    a.innerHTML="Allergies Present";
                    a.style.background="red";
                }else{
                    a.innerHTML="No Allergies";
                    a.style.background="green";
                }
            }
        });

        //get patient info
        $("#img1").attr("src", "uploads/cardiology-patient-icon-vector-6244713.jpg");
        $('.patientIdClass').html("").end()
        $('.nameClass').html("").end()
        $('.emailClass').html("").end()
        $('.addressClass').html("").end()
        $('.phoneClass').html("").end()
        $('.genderClass').html("").end()
        $('.birthdateClass').html("").end()
        $('.bloodgroupClass').html("").end()
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
        $('.kinRelationship').html("").end()
        $('.religionClass').html("").end()
        $.ajax({
            url: 'patient/getPatientByJason?id=' + patient,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            $('.patientIdClass').append(response.patient.id).end()
            $('.nameClass').append(response.patient.name).end()
            $('.emailClass').append(response.patient.email).end()
            $('.addressClass').append(response.patient.address).end()
            $('.phoneClass').append(response.patient.phone).end()
            $('.genderClass').append(response.patient.sex).end()
            $('.religionClass').append(response.patient.religion).end()
            $('.birthdateClass').append(response.patient.birthdate).end()
            $('.ageClass').append(response.age).end()
            $('.policyNo').append(response.patient.insurance_id).end()
            $('.bloodgroupClass').append(response.patient.bloodgroup).end()
            $('.placeOfBirth').append(response.patient.birth_place).end()
            $('.marital').append(response.patient.marital_status).end()
            $('.occupation').append(response.patient.occupation).end()
            $('.IdNo').append(response.patient.id_no).end()
            $('.patientType').append(response.patient.patient_type).end()
            $('.nextOfKin').append(response.patient.kin).end()
            $('.kinPhone').append(response.patient.kin_phone).end()
            $('.kinEmail').append(response.patient.kin_email).end()
            $('.kinRelationship').append(response.patient.kin_relationship).end()
            $('.kinAddress').append(response.patient.kin_address).end()
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
        });







        if(table == null){
            $(document).ready(function () {
                table = $('#pcase-sample').DataTable({
                    responsive: true,
                    //   dom: 'lfrBtip',

                    "processing": true,
                    "serverSide": true,
                    "searchable": true,
                    "ajax": {
                        url: "patient/getPatientCaseList",
                        type: 'POST',
                        data:function ( d ) {
                        return  $.extend(d, cData);
                        },
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

                //lab table
                ltable = $('#ltest-sample').DataTable({
                    responsive: true,

                    "processing": true,
                    "serverSide": true,
                    "searchable": true,
                    "ajax": {
                        url: "lab/getPatientLab",
                        type: 'POST',
                        data:function ( d ) {
                            return  $.extend(d, cData);
                            },
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
                ltable.buttons().container().appendTo('.custom_buttons');

                //allergy table
                atable = $('#allergy-sample').DataTable({
                    responsive: true,
                    //   dom: 'lfrBtip',

                    "processing": true,
                    "serverSide": true,
                    "searchable": true,
                    "ajax": {
                        url: "patient/getAllergies",
                        type: 'POST',
                        data:function ( d ) {
                            return  $.extend(d, cData);
                            },
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
                atable.buttons().container().appendTo('.custom_buttons');
                
                //px table
                pxtable = $('#pxhistory-sample').DataTable({
                    responsive: true,
                    //   dom: 'lfrBtip',

                    "processing": true,
                    "serverSide": true,
                    "searchable": true,
                    "ajax": {
                        url: "prescription/getPrescriptionListByPatient",
                        type: 'POST',
                        data:function ( d ) {
                            return  $.extend(d, cData);
                            },
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
                        searchPlaceholder: "Search...",
                        "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json"
                    },
                });
                pxtable.buttons().container().appendTo('.custom_buttons');

                //xray table
                xtable = $('#xhistory-sample').DataTable({
                    responsive: true,
                    //   dom: 'lfrBtip',

                    "processing": true,
                    "serverSide": true,
                    "searchable": true,
                    "ajax": {
                        url: "lab/getPatientRadiology",
                        type: 'POST',
                        data:function ( d ) {
                            return  $.extend(d, cData);
                            },
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
                        searchPlaceholder: "Search...",
                        "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json"
                    },
                });
                xtable.buttons().container().appendTo('.custom_buttons');

                //documents table
                dtable = $('#dhistory-sample').DataTable({
                    responsive: true,
                    //   dom: 'lfrBtip',

                    "processing": true,
                    "serverSide": true,
                    "searchable": true,
                    "ajax": {
                        url: "patient/getPatientDocuments",
                        type: 'POST',
                        data:function ( d ) {
                            return  $.extend(d, cData);
                            },
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
                        searchPlaceholder: "Search...",
                        "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json"
                    },
                });
                dtable.buttons().container().appendTo('.custom_buttons');
                
                //lab request table
                lqtable = $('#lreq-sample').DataTable({
                    responsive: true,
                    //   dom: 'lfrBtip',

                    "processing": true,
                    "serverSide": true,
                    "searchable": true,
                    "ajax": {
                        url: "lab/getPatientLabRequest",
                        type: 'POST',
                        data:function ( d ) {
                            return  $.extend(d, cData);
                            },
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
                        searchPlaceholder: "Search...",
                        "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json"
                    },
                });
                pxtable.buttons().container().appendTo('.custom_buttons');

                //scan and xray request table
                lqtable = $('#rreq-sample').DataTable({
                    responsive: true,
                    //   dom: 'lfrBtip',

                    "processing": true,
                    "serverSide": true,
                    "searchable": true,
                    "ajax": {
                        url: "lab/getPatientRadiologyRequest",
                        type: 'POST',
                        data:function ( d ) {
                            return  $.extend(d, cData);
                            },
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
                        searchPlaceholder: "Search...",
                        "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json"
                    },
                });
                pxtable.buttons().container().appendTo('.custom_buttons');
                
                $('#ltest-sample').css({"width":"100%"})
                $('#pcase-sample').css({"width":"100%"})
                $('#allergy-sample').css({"width":"100%"})
                $('#pxhistory-sample').css({"width":"100%"})
                $('#xhistory-sample').css({"width":"100%"})
                $('#dhistory-sample').css({"width":"100%"})
                $('#lreq-sample').css({"width":"100%"})
                $('#rreq-sample').css({"width":"100%"})

            });
        }else{
            cData.id=patient;
            table.ajax.reload();
            ltable.ajax.reload();
            atable.ajax.reload();
            pxtable.ajax.reload();
            xtable.ajax.reload();
            dtable.ajax.reload();
            lqtable.ajax.reload();
        }
    }
    
</script>

<script type="text/javascript">

    $("#allergy-sample").on("click", ".inffo", function () {
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
<script>
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

<script>
    $(document).ready(function () {
        $("#my_select1_disabled").select2({
            placeholder: 'Procedure',
            multiple: true,
            allowClear: true,
            ajax: {
                url: 'patient/getAllOperation',
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


        $("#my_select2_disabled").select2({
            placeholder: 'Lab Test',
            multiple: true,
            allowClear: true,
            ajax: {
                url: 'lab/getAllLab',
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

        $("#my_select3_disabled").select2({
            placeholder: 'Radio Scan',
            multiple: true,
            allowClear: true,
            ajax: {
                url: 'lab/getAllRadio',
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
    function pro_req(){
        $(document).ready(function(){
            var operation=$("#my_select1_disabled").val();
            var select= document.getElementById("patientchoose");
            var patient=select.options[select.selectedIndex].value;
            $("#pro_stat").html("Please wait...")
            $(".operation_error").html("").end();
            $.ajax({
                url: 'patient/sendOperation',
                type: "post",
                data: {"pid":patient,
                    "operations":operation},
                success: function (data, status, xhr) {// success callback function
                    $("#pro_stat").html(" ")
                    if(data=="ok"){
                        $(".operation_error").html("Request Successful");
                        $(".operation_error").css("color","green")
                        $("#reqmodal").modal('remove')
                    }else{
                        $(".operation_error").html(data)
                    }
                }
            })
        });
        
    }

    function lab_req(){
        $(document).ready(function(){
            var tests=$("#my_select2_disabled").val();
            var select= document.getElementById("patientchoose");
            var patient=select.options[select.selectedIndex].value;
            $("#pro_stat2").html("Please wait...")
            $(".lab_error").html("").end();
            $.ajax({
                url: 'patient/sendLabRequest',
                type: "post",
                data: {"pid":patient,
                    "tests":tests},
                success: function (data, status, xhr) {// success callback function
                    $("#pro_stat2").html(" ")
                    if(data=="ok"){
                        $(".lab_error").html("Request Successful");
                        $(".lab_error").css("color","green")
                        $("#reqmodal").modal('remove')
                    }else{
                        $(".lab_error").html(data)
                    }
                }
            })
        });
        
    }

    function rad_req(){
        $(document).ready(function(){
            var tests=$("#my_select3_disabled").val();
            var select= document.getElementById("patientchoose");
            var patient=select.options[select.selectedIndex].value;
            $("#pro_stat3").html("Please wait...")
            $(".rad_error").html("").end();
            $.ajax({
                url: 'patient/sendRadRequest',
                type: "post",
                data: {"pid":patient,
                    "scans":tests},
                success: function (data, status, xhr) {// success callback function
                    $("#pro_stat3").html(" ")
                    if(data=="ok"){
                        $(".rad_error").html("Request Successful");
                        $(".rad_error").css("color","green")
                        $("#reqmodal").modal('remove')
                    }else{
                        $(".rad_error").html(data)
                    }
                }
            })
        });
        
    }
//     <select class="form-control m-bot15 medicinee"  id="my_select1_disabled" name="category" value=''>

// </select>
// <div class="operation_error" style="color:red; font-weight:bold; text-align:center; font-size:16px;">afdfsdfdfa</div>
// <button class="btn" onclick="pro_req()">Request</button><span id="pro_stat"></span>
</script>
