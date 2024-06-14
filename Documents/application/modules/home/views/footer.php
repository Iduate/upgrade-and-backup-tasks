<footer class="site-footer">
    <div class="text-center"> 
        20<?php echo date('y'); ?> &copy; <?php echo $this->db->get('settings')->row()->system_vendor; ?> by Xerdocs Technology.
        <a href="<?php echo current_url() . '#'; ?>" class="go-top">
            <i class="fa fa-angle-up"></i>
        </a>
    </div>
</footer>
<!--footer end-->
</section>



<!-- js placed at the end of the document so the pages load faster -->
<script src="common/js/jquery.js"></script>
<script src="common/js/jquery-1.8.3.min.js"></script>
<script src="common/js/bootstrap.min.js"></script>
<script src="common/js/jquery.scrollTo.min.js"></script>

<script src="common/js/moment.min.js"></script>

<!--
<script src="common/js/jquery.nicescroll.js" type="text/javascript"></script>
-->

<script type="text/javascript" src="common/assets/DataTables/datatables.min.js"></script>
<script src="common/js/respond.min.js" ></script>
<script type="text/javascript" src="common/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="common/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="common/assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="common/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="common/assets/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="common/assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
<script type="text/javascript" src="common/assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="common/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script src="common/js/advanced-form-components.js"></script>
<script src="common/js/jquery.cookie.js"></script>
<!--common script for all pages--> 
<script src="common/js/common-scripts.js"></script>
<script src="common/js/lightbox.js"></script>
<script class="include" type="text/javascript" src="common/js/jquery.dcjqaccordion.2.7.js"></script>
<!--script for this page only-->
<script src="common/js/editable-table.js"></script>
<script src="common/assets/fullcalendar/fullcalendar.js"></script>
<script src="common/pdf/build/pdf.js"></script>

<script type="text/javascript" src="common/assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>


<?php
$language = $this->db->get('settings')->row()->language;

if ($language == 'english') {
    $lang = 'en';
} elseif ($language == 'spanish') {
    $lang = 'es';
} elseif ($language == 'french') {
    $lang = 'fr';
} elseif ($language == 'portuguese') {
    $lang = 'pt';
} elseif ($language == 'arabic') {
    $lang = 'ar';
} elseif ($language == 'italian') {
    $lang = 'it';
}
?>



<script src='common/assets/fullcalendar/locale/<?php echo $lang; ?>.js'></script>



<script src="common/assets/DataTables/DataTables-1.10.16/custom/js/datatable-responsive-cdn-version-2-2-5.js"></script>






<script>
    $('.multi-select').multiSelect({
        selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder=' search...'>",
        selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder=''>",
        afterInit: function (ms) {
            var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function (e) {
                        if (e.which === 40) {
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function (e) {
                        if (e.which == 40) {
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
        },
        afterSelect: function () {
            this.qs1.cache();
            this.qs2.cache();
        },
        afterDeselect: function () {
            this.qs1.cache();
            this.qs2.cache();
        }
    });
</script>

<script>
    $('#my_multi_select3').multiSelect()
</script>

<script>
    $('.default-date-picker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    });


    $('#date').on('changeDate', function () {
        $('#date').datepicker('hide');
    });

    $('#date1').on('changeDate', function () {
        $('#date1').datepicker('hide');
    });


</script>


<script type="text/javascript">

    $(document).ready(function () {
        $('#calendar').fullCalendar({
            lang: 'en',
            events: 'appointment/getAppointmentByJason',
            header:
                    {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay',
                    },
            /*    timeFormat: {// for event elements
             'month': 'h:mm TT A {h:mm TT}', // default
             'week': 'h:mm TT A {h:mm TT}', // default
             'day': 'h:mm TT A {h:mm TT}'  // default
             },
             
             */
            timeFormat: 'h(:mm) A',
            eventRender: function (event, element) {
                element.find('.fc-time').html(element.find('.fc-time').text());
                element.find('.fc-title').html(element.find('.fc-title').text());

            },
            eventClick: function (event) {
                $('#medical_history').html("");
                if (event.id) {
                    $.ajax({
                        url: 'patient/getMedicalHistoryByJason?id=' + event.id + '&from_where=calendar',
                        method: 'GET',
                        data: '',
                        dataType: 'json',
                    }).success(function (response) {
                        // Populate the form fields with the data returned from server
                        $('#medical_history').html("");
                        $('#medical_history').append(response.view);
                    });
                    //alert(event.id);

                }

                $('#cmodal').modal('show');
            },

            /*   eventMouseover: function (calEvent, domEvent) {
             var layer = "<div id='events-layer' class='fc-transparent' style='position:absolute; width:100%; height:100%; top:-1px; text-align:right; z-index:100'>Description</div>";
             $(this).append(layer);
             },
             
             eventMouseout: function (calEvent, domEvent) {
             $(this).append(layer);
             },
             
             */

            slotDuration: '00:5:00',
            businessHours: false,
            slotEventOverlap: false,
            editable: false,
            selectable: false,
            lazyFetching: true,
            minTime: "6:00:00",
            maxTime: "24:00:00",
            defaultView: 'month',
            allDayDefault: false,
            displayEventEnd: true,
            timezone: false,

        });
    });

</script>









<script>
    $(document).ready(function () {
        $('.timepicker-default').timepicker({defaultTime: 'value'});

    });
</script>

<script type="text/javascript" src="common/assets/select2/js/select2.min.js"></script>


<script type="text/javascript">

    $(document).ready(function () {
        $(".js-example-basic-single").select2();

        $(".js-example-basic-multiple").select2();
    });

</script>




<script type="text/javascript">

    $(document).ready(function () {
        var windowH = $(window).height();
        var wrapperH = $('#container').height();
        if (windowH > wrapperH) {
            $('#sidebar').css('height', (windowH) + 'px');
        } else {
            $('#sidebar').css('height', (wrapperH) + 'px');
        }
        var windowSize = window.innerWidth;
        if (windowSize < 769) {
            $('#sidebar').removeAttr('style');
        }
    });
    function onElementHeightChange(elm, callback) {
        var lastHeight = elm.clientHeight, newHeight;
        (function run() {
            newHeight = elm.clientHeight;
            if (lastHeight != newHeight)
                callback();
            lastHeight = newHeight;
            if (elm.onElementHeightChangeTimer)
                clearTimeout(elm.onElementHeightChangeTimer);
            elm.onElementHeightChangeTimer = setTimeout(run, 200);
        })();
    }




    onElementHeightChange(document.body, function () {
        var windowH = $(window).height();
        var wrapperH = $('#container').height();
        if (windowH > wrapperH) {
            $('#sidebar').css('height', (windowH) + 'px');
        } else {
            $('#sidebar').css('height', (wrapperH) + 'px');
        }

        var windowSize = $(window).width();
        if (windowSize < 769) {
            $('#sidebar').removeAttr('style');
        }
    });







    $(window).resize(function () {

        if (width == GetWidth()) {
            return;
        }

        width = GetWidth();

        if (width < 600) {
            $('#sidebar').hide();
        } else {
            $('#sidebar').show();
        }

    });


</script>




<script>
    CKEDITOR.replace("description",
            {
                height: 400
            });
</script>



<script>
    function _(x){
	    return document.getElementById(x);	
    }

    function customConfirm(){
	this.close=function(){
		dialogoverlay.style.opacity='0';
		dialogbox.style.transform="scale(0)";
		setTimeout(function(){
			dialogoverlay.style.visibility='hidden';
			dialogwrap.style.visibility='hidden';
			_('dialogboxbody').innerHTML='';
			_('dialogboxhead').innerHTML='';
			_('dialogboxfoot').innerHTML='';
		},500);
	}

    this.onYes= function(fn){
        if(typeof fn === "function"){
            this.onYesCallback=fn;
        }
    }

    this._onYes=function(){
        if(typeof this.onYesCallback === "function"){
            this.onYesCallback.call();
        }
    },

	this.show=function(text,show){
		if(typeof show==="undefined"){
			show=true;
		}
		var winW=window.innerWidth,
		winH=window.innerHeight;
		if(winW>600){
		  diaW=Math.round(winW/4);
		  left=(winW/2)-(diaW * .5)+"px";
		}else{
			diaW=winW-100;
			left="50px"
		}
		dialogwrap=_('dialogwrap'),
		dialogoverlay=_('dialogoverlay'),
		dialogbox=_('dialogbox');
		dialogwrap.style.visibility='visible';
		dialogoverlay.style.visibility='visible';
		dialogoverlay.style.opacity='.3';
		dialogoverlay.style.height=winH+"px";
		dialogbox.style.width=diaW+"px";
		dialogbox.style.left=left;
		dialogbox.style.top="100px";
		dialogbox.style.display="block";
		dialogwrap.style.visibility='visible';
		setTimeout(() => {
			dialogbox.style.transform="scale(1)";
		}, 100);
		_('dialogboxhead').innerHTML="Please confirm";
		_('dialogboxbody').innerHTML=text;
		if(show){
			_('dialogboxfoot').innerHTML='<span style="color:black; font-weight:bold">Do you want to continue? </span><button onclick="Confirm.yes()">Yes</button><button onclick="Confirm.no()">No</button>'
		}else{
			_('dialogboxfoot').innerHTML='<button onclick="Confirm.yes()">Yes</button><button onclick="Confirm.no()">No</button>'
		}
	}

	this.render=function(text,show){
		$this=this;
		if(dialogwrap.style.visibility == "visible"){
			this.close();
			setTimeout(function(){
				$this.show(text,show);
			},700)
		}else{
			this.show(text,show)
		}
		if(typeof show==="undefined"){
			show=true;
		}
		var winW=window.innerWidth,
		winH=window.innerHeight;
		if(winW>600){
		  diaW=Math.round(winW/4);
		  left=(winW/2)-(diaW * .5)+"px";
		}else{
			diaW=winW-20;
			left="10px"
		}
		dialogwrap=_('dialogwrap'),
		dialogoverlay=_('dialogoverlay'),
		dialogbox=_('dialogbox');
		dialogwrap.style.visibility='visible';
		dialogoverlay.style.visibility='visible';
		dialogoverlay.style.opacity='.3';
		dialogoverlay.style.height=winH+"px";
		dialogbox.style.width=diaW+"px";
		dialogbox.style.left=left;
		dialogbox.style.top="100px";
		dialogbox.style.display="block";
		dialogwrap.style.visibility='visible';
		setTimeout(() => {
			dialogbox.style.transform="scale(1)";
		}, 100);
		_('dialogboxhead').innerHTML="Please confirm";
		_('dialogboxbody').innerHTML=text;
		if(show){
			_('dialogboxfoot').innerHTML='<span style="color:black; font-weight:bold">Do you want to continue? </span><button onclick="Confirm.yes()">Yes</button><button onclick="Confirm.no()">No</button>'
		}else{
			_('dialogboxfoot').innerHTML='<button onclick="Confirm.yes()">Yes</button><button onclick="Confirm.no()">No</button>'
		}
	}
	this.no=function(){
		this.close();
		return false;
	} 
	this.yes=function(){
		this.close();
        this._onYes();
		return true;
	} 
}
var Confirm=new customConfirm();

</script>

<script>
function ajaxObj(meth, url){
	var x=new XMLHttpRequest();
	x.open(meth,url,true);
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	return x;
}
function ajaxReturn(x){
	if(x.readyState ==4 && x.status==200){
		return true;
		}	
}
</script>






</body>
</html>
