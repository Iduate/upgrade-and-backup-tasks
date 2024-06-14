<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class=""> 

            <header class="panel-heading">
                Xerdocs HMS Tutorials
            </header>
            <div class="panel-body">

                <div class="adv-table editable-table ">

                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th>S/N</th>                        
                                <th>Name</th>
                                <th>Description</th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>








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


<!-- view pdf modal -->
<div class="modal fade" id="docsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body row">
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

<!-- view pdf modal end -->


<!-- view video modal -->
<div class="modal fade" id="vidModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <video id="video" width="100%" height="auto" controls></video>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- end of view video modal -->

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


<script>


    $(document).ready(function () {
        var table = $('#editable-sample').DataTable({
            responsive: true,
            //   dom: 'lfrBtip',

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "home/getTutorials?group=<?php echo $this->input->get("group");?>",
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



    });
</script>



<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>


<script>
    function readpdf(u){
        const url=encodeURI("../uploads/"+u);
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
        $('#docsModal').modal('show');
    }
</script>


<script>
    function playvideo(u){
        const url="uploads/"+u;
        var video = document.getElementById('video');
        if(video.childNodes[0] != null){
            var source=video.childNodes[0];
            video.pause();
            source.setAttribute('src', url);
            source.setAttribute('type', 'video/mp4');

            video.load();
            video.play();
        }else{
        var source = document.createElement('source');
        source.setAttribute('src', url);
        source.setAttribute('type', 'video/mp4');

        video.appendChild(source);
        video.play();
        }
         

    
        $('#vidModal').modal('show');
    }
</script>

