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
        <section class="col-md-12">
            <header class="panel-heading">
                Patient Merge
                <div class="col-md-4 no-print pull-right"> 
                    <div class="btn-group pull-right" onclick="mergePatient()">
                        <button id="" class="btn green btn-xs">
                            Merge Folder
                        </button>
                    </div>
                </div>
            </header>
        </section>
        
        <section class="col-md-6">
            <div class=""> 
                <form role="form" id="main_form" action="patient/addMedicalHistory" class="clearfix" method="post" enctype="multipart/form-data">
                    
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
                </form>
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
            </div>

        </section>
        <section class="col-md-6">
            <div class=""> 
                <form role="form" id="main_form" action="patient/addMedicalHistory" class="clearfix" method="post" enctype="multipart/form-data">
                    
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
                        <select class="form-control m-bot15" id="patientchoose2" name="<?php echo $name;?>" value='' <?php echo $disabled;?> onchange="vitals2()">
                            
                        </select>
                    </div>
                </form>
                <div id="pInfo2" class="tab-pane active">
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
            </div>

        </section>





    </section>
    <!-- page end-->
</section>
</section>
<!--main content end-->
<!--footer start-->


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
</script>


<script>
    function vitals(){
        var select= document.getElementById("patientchoose");
        var patient=select.options[select.selectedIndex].value;
        getCaseFile("pInfo",patient);
        
    }
    function vitals2(){
        var select= document.getElementById("patientchoose2");
        var patient=select.options[select.selectedIndex].value;
        getCaseFile("pInfo2",patient);
        
    }
</script>

<script>
    function mergePatient(){
        var select= document.getElementById("patientchoose");
        var select2= document.getElementById("patientchoose2");
        if(select.options[0] == undefined || select2.options[0] == undefined){
            alert("Please select patient 1 and patient 2 so begin the merge");
            return false;
        }
        var patient1=select.options[select.selectedIndex].value;
        var patient2=select2.options[select2.selectedIndex].value;
        $.ajax({
            url: 'patient/mergePatient',
            method: 'GET',
            data: {
                p1:patient1,
                p2:patient2
            },
            dataType: 'json',
        }).success(function (res) {
            if(!res.status){
                alert(res.msg)
            }else{
                alert("Merge successful");
                location.reload();
            }
        })
    }
</script>

<script>
    var table,ltable,atable,pxtable,xtable,dtable;
    var cData={};
    function getCaseFile(w,patient){
        cData.id=patient;

        //get patient info
        $("#"+w+" #img1").attr("src", "uploads/cardiology-patient-icon-vector-6244713.jpg");
        $('#'+w+' .patientIdClass').html("").end()
        $('#'+w+' .nameClass').html("").end()
        $('#'+w+' .emailClass').html("").end()
        $('#'+w+' .addressClass').html("").end()
        $('#'+w+' .phoneClass').html("").end()
        $('#'+w+' .genderClass').html("").end()
        $('#'+w+' .birthdateClass').html("").end()
        $('#'+w+' .bloodgroupClass').html("").end()
        $('#'+w+' .doctorClass').html("").end()
        $('#'+w+' .ageClass').html("").end()
        $('#'+w+' .placeOfBirth').html("").end()
        $('#'+w+' .marital').html("").end()
        $('#'+w+' .occupation').html("").end()
        $('#'+w+' .insurance').html("").end()
        $('#'+w+' .policyNo').html("").end()
        $('#'+w+' .IdNo').html("").end()
        $('#'+w+' .patientType').html("").end()
        $('#'+w+' .nextOfKin').html("").end()
        $('#'+w+' .kinPhone').html("").end()
        $('#'+w+' .kinEmail').html("").end()
        $('#'+w+' .kinAddress').html("").end()
        $('#'+w+' .kinRelationship').html("").end()
        $('#'+w+' .religionClass').html("").end()
        $.ajax({
            url: 'patient/getPatientByJason?id=' + patient,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            console.clear();
            $('#'+w+' .patientIdClass').append(response.patient.id).end()
            $('#'+w+' .nameClass').append(response.patient.name).end()
            $('#'+w+' .emailClass').append(response.patient.email).end()
            $('#'+w+' .addressClass').append(response.patient.address).end()
            $('#'+w+' .phoneClass').append(response.patient.phone).end()
            $('#'+w+' .genderClass').append(response.patient.sex).end()
            $('#'+w+' .religionClass').append(response.patient.religion).end()
            $('#'+w+' .birthdateClass').append(response.patient.birthdate).end()
            $('#'+w+' .ageClass').append(response.age).end()
            $('#'+w+' .policyNo').append(response.patient.insurance_id).end()
            $('#'+w+' .bloodgroupClass').append(response.patient.bloodgroup).end()
            $('#'+w+' .placeOfBirth').append(response.patient.birth_place).end()
            $('#'+w+' .marital').append(response.patient.marital_status).end()
            $('#'+w+' .occupation').append(response.patient.occupation).end()
            $('#'+w+' .IdNo').append(response.patient.id_no).end()
            $('#'+w+' .patientType').append(response.patient.patient_type).end()
            $('#'+w+' .nextOfKin').append(response.patient.kin).end()
            $('#'+w+' .kinPhone').append(response.patient.kin_phone).end()
            $('#'+w+' .kinEmail').append(response.patient.kin_email).end()
            $('#'+w+' .kinRelationship').append(response.patient.kin_relationship).end()
            $('#'+w+' .kinAddress').append(response.patient.kin_address).end()
            $('#'+w+' .kinAddress').append(response.patient.kin_address).end()

            if (response.doctor !== null) {
                $('#'+w+' .doctorClass').append(response.doctor.name).end()
            }else{
                $('#'+w+' .doctorClass').append('').end()
            }

            if(response.patient.patient_type == "Private Patient"){
                $("#"+w+" .iInsure").hide();
            }else{
            if(response.hmo){
                        $("#"+w+" .iInsure").show();
                        $('#'+w+' .insurance').append(response.hmo.name).end()
                        $('#'+w+' .policyNo').append(response.patient.policy_no).end()
            }
            }

            if (typeof response.patient.img_url !== 'undefined' && response.patient.img_url != '') {
                $("#"+w+" #img1").attr("src", response.patient.img_url);
            }
        });
    }
    
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

    });
</script>


<script>
    $(document).ready(function () {
        $("#patientchoose2").select2({
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

