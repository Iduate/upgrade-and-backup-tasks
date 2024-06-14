<!--sidebar end-->
<!--main content start-->
<style>
    .webcontainer{width:320px; height:350px; background:white; position: fixed;
    top:10px; right:10px; z-index:9999999999999999999999999999999999999999999999999999999999;}
    .webwrap{width:320px; height:350px;position:relative; }
    #canvas{position:absolute; top:0; left:0; margin:0}
    .websave{width:45%; float:left; background:#0b4203; color:white; padding:10px 0}
    .webretake{width:45%; float:right;  background:#ff0033; color:white; padding:10px 0}
    .clr{clear:both}
</style>
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
                                <th>Insurance</th>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist','Record_Officer'))) { ?>
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



<script src="common/js/codearistos.min.js"></script>




<script>


    $(document).ready(function () {
        var table = $('#editable-sample').DataTable({
            responsive: true,
            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "patient/getToday",
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
                [10, 20, 50, 100, -1],
                [10, 20, 50, 100, "All"]
            ],
            iDisplayLength: 20,
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
                url: 'doctor/getDoctorInfoByDepartment',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term,
                        dept:$("#department2").val() // search term
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
                url: 'doctor/getDoctorInfoByDepartment',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term,
                        dept:$("#department").val() // search term
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






    });
</script>

<script>
    function getInsurance(){
        //
        var select= document.getElementById("patient_type");
        var patient=select.options[select.selectedIndex].value;
        $("#insurance01").select2({
            placeholder: 'Select Insurance',
            allowClear: true,
            ajax: {
                url: 'finance/getInsuranceInfo?cat='+patient,
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
    }

    
    function getInsurance2(){
        //
        var select= document.getElementById("patient_type2");
        var patient=select.options[select.selectedIndex].value;
        $("#insurance02").select2({
            placeholder: 'Select Insurance',
            allowClear: true,
            ajax: {
                url: 'finance/getInsuranceInfo?cat='+patient,
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
    }
</script>

<script>
    function getsponsor(){
        var select= document.getElementById("insurance01");
        var patient=select.options[select.selectedIndex].value;
        $("#sponsor01").select2({
            placeholder: 'Select Sponsor',
            allowClear: true,
            ajax: {
                url: 'finance/getSponsorInfo?cat='+patient,
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
    }

    function getsponsor2(){
        var select= document.getElementById("insurance02");
        var patient=select.options[select.selectedIndex].value;
        $("#sponsor02").select2({
            placeholder: 'Select Sponsor',
            allowClear: true,
            ajax: {
                url: 'finance/getSponsorInfo?cat='+patient,
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
    }
</script>

<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

<script>
    function upd(b,elem,web){
	var formdata=new FormData();
		formdata.append('gfile',b);
			var ajax=new XMLHttpRequest();
			ajax.upload.addEventListener("progress",progressHandler, false);
			ajax.addEventListener("load", completeHandler, false);
			ajax.addEventListener("error", errorHandler, false);
			ajax.addEventListener("abort", abortHandler, false);
			ajax.open('POST','patient/upload');
			ajax.send(formdata);
	function progressHandler(event){
		
	}
	function completeHandler(event){
		var get=event.target.responseText.split('|');
		if(get[0]=="ok"){
			elem.value=get[1];
            web.style.display="none";
		}
		else{
			alert(event.target.responseText)
		}
	}
	function errorHandler(event){
		
        alert("error oh")
	}
	function abortHandler(event){
		
	}
	
	}
</script>


<script>
// (function() {

var width = 320; // We will scale the photo width to this
var height = 0; // This will be computed based on the input stream

var streaming = false;

var video = null;
var canvas = null;
var photo = null;
var startbutton = null;

function startup(inputelem,p) {
    video = document.getElementById('video');
    canvas = document.getElementById('canvas');
    photo = p;
    retake = document.getElementById('retake');
    webretake = document.getElementById('webretake');
    startbutton = document.getElementById('startbutton');
    webcontainer=document.getElementById('webcontainer');
    websave=document.getElementById('websave');
    webcontainer.style.display="block";

    navigator.mediaDevices.getUserMedia({
            video: true,
            audio: false
        })
        .then(function(stream) {
            video.srcObject = stream;
            video.play();
        })
        .catch(function(err) {
            console.log("An error occurred: " + err);
        });

    video.addEventListener('canplay', function(ev) {
        if (!streaming) {
            height = video.videoHeight / (video.videoWidth / width);

            if (isNaN(height)) {
                height = width / (4 / 3);
            }

            video.setAttribute('width', width);
            video.setAttribute('height', height);
            canvas.setAttribute('width', width);
            canvas.setAttribute('height', height);
            streaming = true;
        }
    }, false);

    startbutton.addEventListener('click', function(ev) {
        takepicture();
        ev.preventDefault();
    }, false);

    websave.addEventListener('click', function(ev) {
        savepicture();
        ev.preventDefault();
    }, false);

    

    webretake.addEventListener('click', function(ev) {
        w_retake();
        ev.preventDefault();
    }, false);

    clearphoto();
}


function clearphoto() {
    var context = canvas.getContext('2d');
    context.fillStyle = "#AAA";
    context.fillRect(0, 0, canvas.width, canvas.height);

    var data = canvas.toDataURL('image/png');
    photo.setAttribute('src', data);
}

function takepicture() {
    canvas.style.visibility="visible";
    var context = canvas.getContext('2d');
    if (width && height) {
        canvas.width = width;
        canvas.height = height;
        context.drawImage(video, 0, 0, width, height);

        var data = canvas.toDataURL('image/png');
        photo.setAttribute('src', data);
        
        startbutton.style.display="none"
        retake.style.display="block"
    } else {
        clearphoto();
    }
}

function savepicture(){
    var dataURL = canvas.toDataURL('image/jpeg', 0.5);
    var blob = dataURItoBlob(dataURL);
    upd(blob,inputelem,webcontainer)
}

function w_retake(){
    canvas.style.visibility="hidden";
    startbutton.style.display="block"
    retake.style.display="none"
}

function dataURItoBlob(dataURI) {
    // convert base64/URLEncoded data component to raw binary data held in a string
    var byteString;
    if (dataURI.split(',')[0].indexOf('base64') >= 0)
        byteString = atob(dataURI.split(',')[1]);
    else
        byteString = unescape(dataURI.split(',')[1]);

    // separate out the mime component
    var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

    // write the bytes of the string to a typed array
    var ia = new Uint8Array(byteString.length);
    for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }

    return new Blob([ia], {type:mimeString});
}



// window.addEventListener('load', startup, false);
// })();
</script>

<script>
    function addTakePhoto(){
        inputelem=document.getElementById("addinput")
        imgsrc=document.getElementById("add_photo");
        startup(inputelem,imgsrc)
    }
    function editTakePhoto(){
        inputelem=document.getElementById("editinput")
        imgsrc=document.getElementById("eimg");
        startup(inputelem,imgsrc)
    }
</script>

