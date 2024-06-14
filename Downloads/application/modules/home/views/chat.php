<style>
.message_board{background-color:white; padding:15px 10px; margin-top:20px; min-height:100px;
transition:all 0.5s linear 0.5s}
.full{width:100%;}
.chat_head{width:100%; border-bottom:1px solid #333; background:#1a7bb9}
.chat_head p{padding:10px; margin:0; color:white; font-family:sans-serif; font-weight:700}
.chat_body{margin-bottom:5px;width:100%; min-height:150px; max-height:500px; overflow-y:auto}
.chat_body .me{max-width:80%; min-width:15%; background-color:#eee; padding:10px; margin:10px 0; color:black; font-family:sans-serif; font-weight:200; float:right; border-radius:20px 0px 20px 20px;}
.chat_body .you{max-width:80%; min-width:15%; background-color:#1a7bb9; padding:10px; margin:10px 0; color:white; font-family:sans-serif; font-weight:200; float:left; border-radius:0px 20px 20px 20px;}
.chat_foot{border:1px solid #1a7bb9; background:#1a7bb9; border-radius:20px; overflow:hidden}
.chat_foot input, .chat_foot button{padding:10px; margin:0; border:0; outline:none;}
.chat_foot input{width:86%; float:left; color:#1a7bb9; font-weight:bold; font-family:sans-serif}
.chat_foot button{width:14%; float:left; font-size:13px; font-family:sans-serif; color:white; background:#1a7bb9}
.clr{clear:both}
.recent{margin-top:10px}
.msg_row{border-bottom:2px solid #eee; margin-bottom:5px; cursor:pointer}
.msg_row .name{padding:0; margin:0; font-weight:bold; font-size:15px; color:#39b27c}
.msg_row .chat{color:#1e1e1e;}
</style>

<section id="main-content">
    <section class="wrapper site-min-height">
        <section class="message_board col-md-6">
        <?php
            $d="";
            if(!$aConvo){
                $d= "display:none";
            }
        ?>
            <div class="form-group col-md-12" id= "chatBoard" style="<?php echo $d;?>" >
                <div class="chat_head">
                   <p class="name" id="chat_name"><?php echo $aConvo['name'];?></p>
                </div>
                <div class="chat_body" id="chat_body">
                    <?php
                        //    print_r($aConvo['message']);
                           for($i=0; $i<count($aConvo['message']); $i++){
                               $c=$aConvo['message'][$i];
                               $me=$this->ion_auth->get_user_id();
                               if($c->sender==$me){
                                $you=$c->reciever;
                                   ?>
                                        <div class='full'>
                                            <p class="me"><?php echo $c->message;?></p>
                                        </div>
                                   <?php
                               }else{
                                $you=$c->sender;
                                    ?>
                                    <div class='full'>
                                        <p class="you"><?php echo $c->message;?></p>
                                    </div>
                                    <?php
                               }
                           }
                    ?>
                    

                    <div class="clr"></div>
                </div>
                <div class="chat_foot">
                    <input type="text" id="new_msg" placeholder="Type message here" />
                    <button onclick="send()" id="sender">Send</button>
                    <input type="hidden" value="<?php echo $aConvo['cid'];?>"; id="cid" />
                    <div class="clr"></div>
                </div>
            </div>
        </section>


        <section class="message_board col-md-5" style="float:right">
            <div class="form-group col-md-12">
                <div class="btn-group pull-right">
                    <button id="" class="btn green btn-xs new_chat">
                        <i class="fa fa-comment"></i> New Chat
                    </button>
                </div><br/>
                <div class="recent col-md-12">
                    <?php
                        for($i = 0; $i < count($convos); $i++){
                            $convo=$convos[$i];
                            ?>
                                <div class="col_md-12 msg_row" onclick="ntw('<?php echo $convo['usr'];?>')">
                                    <p class="name"><?php echo $convo['name'];?></p>
                                    <p class="chat"><?php echo $convo['chat']->message;?></p>
                                </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </section>
    </section>
</section>

<!-- Start chat Modal-->
<div class="modal fade" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  Start a new Conversation</h4>
            </div>
            <div class="modal-body row">
            
                <div class="form-group col-md-12">    
                    <label for="exampleInputEmail1">Search for the person</label>
                    <select class="form-control m-bot15" id="second_person" name="doctor" value=''>

                    </select>
                </div>

                <section class="col-md-12">
                    <button type="submit" onclick="startChat()" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                </section>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Patient Modal-->

<script src="common/js/codearistos.min.js"></script>
<script src="common/js/howler.core.js"></script>

<script type="text/javascript">
timer=0;
    $(document).ready(function () {
        $(".new_chat").click(function () {
            $('#chatModal').modal('show');
            // alert("her")
        
        });

        $("#second_person").select2({
            placeholder: 'Select reciever',
            allowClear: true,
            ajax: {
                url: 'home/getEveryone',
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


function startChat(){
    var select= document.getElementById("second_person");
    var rcv=select.options[select.selectedIndex].value;
    ntw(rcv);
    
}

function ntw(rcv){
    if(timer!=0){
        clearInterval(timer)
    }
    $.ajax({
        url: 'home/startChat?id=' + rcv,
        method: 'GET',
        data: '',
        dataType: 'json',
    }).success(function (response) {
        $("#chatBoard").fadeOut()
        console.clear()
        console.log(response)
        setTimeout(() => {
            $("#cid").val(response.convo_id)
            $("#chat_name").html(response.name)
            $("#chat_body").html(" ")
            if(response.message){
                g=rcv.split("|");
                for(i=0; i <response.message.length; i++){
                    msg=response.message[i]
                    console.log(g[0]," ",msg.sender)
                    if(msg.sender==g[0]){
                        div="<div class='full'>"+
                            "<p class='you'>"+msg.message+
                            "</p><div class='clr'></div>"+
                        "</div>";
                    }else{
                        div="<div class='full'>"+
                            "<p class='me'>"+msg.message+
                            "</p><div class='clr'></div>"+
                        "</div>";
                    }
                    $("#chat_body").append(div)
                }
                newMsg(rcv)
            }
            $("#chatBoard").fadeIn();
            $('#chatModal').modal('hide');
        }, 500);
        

    });
}

function send(){
    msg=$("#new_msg").val();
    cid=$("#cid").val();
    $("sender").css("display","none")
    $.post( "home/sendMessage", 
    { convo_id: cid, msg: msg },
    function (response,status){
        console.log(response)
        div="<div class='full'>"+
            "<p class='me'>"+msg+
              "</p><div class='clr'></div>"+
        "</div>";
        $("#chat_body").append(div);
        $("#new_msg").val("");
    } );
   
}

function newMsg(id){
    timer=setInterval(() => {
        console.log("----------------------------------------------------------------------")
        var ajax=ajaxObj('POST','home/getNewMsg');
		ajax.onreadystatechange=function(){
		  if(ajaxReturn(ajax) == true){
              res=JSON.parse(ajax.responseText);
              console.log(res);
              if(res.msg){
                for (var key in res.msg) {
                    if (res.msg.hasOwnProperty(key)) {
                        if(key != "message"){
                            continue;
                        }
                        div="<div class='full'>"+
                            "<p class='you'>"+res.msg["message"]+
                            "</p><div class='clr'></div>"+
                        "</div>";
                        $("#chat_body").append(div);
                        sound = new Howl({
                            src: ["common/sound/sound_1.mp3"]
                        });
                        sound.play()
                    }
                }
                console.log(res.msg)
                  
              }
		  }
		}
		ajax.send("id="+id);


        // $.post( "home/getNewMsg", 
        // { convo_id: cid},
        // function (response,status){
        //     console.log(response)
        //     div="<div class='full'>"+
        //         "<p class='you'>"+
        //         "</p>"+
        //     "</div>";
        //     $("#chat_body").append(div);
        //     $("#new_msg").val("");
        // } );
    }, 3000);
}
</script>

<?php
if($aConvo['name'] != null){
    ?>
    <script>newMsg(<?php echo $you;?>)</script>
    <?php
}
?>