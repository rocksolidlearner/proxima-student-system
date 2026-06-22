<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
    .chat
    {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .chat li
    {
        width: 100%;
        margin-bottom: 5px;
        padding-bottom: 5px;
        border-bottom: 1px dotted #505458;
    }

    .chat li.left .chat-body
    {
        margin-left: 60px;
    }

    .chat li.right .chat-body
    {
        margin-right: 60px;
    }


    .chat li .chat-body p
    {
        margin: 0;
        color: #777777;
    }
    .panel {
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 0px 15px 15px 0px !important;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    .panel-primary{
        border-color: #505458;
    }
    .panel-heading{
        color: #fff;
        background-color: #505458;
        border-color: #505458;
        border-radius: 0px 15px 0px 0px !important;
        padding: 10px 15px;
        border-bottom: 1px solid transparent;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
    }

    .panel .slidedown .glyphicon, .chat .glyphicon
    {
        margin-right: 5px;
    }

    .panel-body
    {
        background-color: #fff;
        overflow-y: scroll;
        height: 330px;
        padding: 15px;
    }

    ::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #F5F5F5;
    }

    ::-webkit-scrollbar
    {
        width: 12px;
        background-color: #F5F5F5;
    }

    ::-webkit-scrollbar-thumb
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #555;
    }
    .panel-footer{
        padding: 10px 15px;
        background-color: #f5f5f5;
        border-top: 1px solid #ddd;
        border-radius: 0px 0px 15px 0px !important;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
    }
    /*chat box for contact*/
    .card{
        height: 458.7px;
        border-radius: 15px 0px 0px 15px !important;
        background-color: #505458 !important;
    }
    .contacts_body{
        padding:  0.75rem 0 !important;
        overflow-y: auto;
        white-space: nowrap;
    }
    .msg_card_body{
        overflow-y: auto;
    }
    .card-header{
        border-radius: 15px 15px 0 0 !important;
        border-bottom: 0 !important;
    }
    .card-footer{
        border-radius: 0 0 15px 15px !important;
        border-top: 0 !important;
    }
    .search{
        border-radius: 15px 0 0 15px !important;
        background-color: rgba(0,0,0,0.3) !important;
        border:0 !important;
        color:white !important;
    }
    .search:focus{
        box-shadow:none !important;
        outline:0px !important;
    }
    .type_msg{
        background-color: rgba(0,0,0,0.3) !important;
        border:0 !important;
        color:white !important;
        height: 60px !important;
        overflow-y: auto;
    }
    .type_msg:focus{
        box-shadow:none !important;
        outline:0px !important;
    }
    .attach_btn{
        border-radius: 15px 0 0 15px !important;
        background-color: rgba(0,0,0,0.3) !important;
        border:0 !important;
        color: white !important;
        cursor: pointer;
    }
    .send_btn{
        border-radius: 0 15px 15px 0 !important;
        background-color: rgba(0,0,0,0.3) !important;
        border:0 !important;
        color: white !important;
        cursor: pointer;
    }
    .search_btn{
        border-radius: 0 15px 15px 0 !important;
        background-color: rgba(0,0,0,0.3) !important;
        border:0 !important;
        color: white !important;
        cursor: pointer;
    }
    .contacts{
        list-style: none;
        padding: 0;
    }
    .contacts li{
        width: 100% !important;
        padding: 5px 10px 0;
        cursor: pointer;
    }
    .chatactive{
        background-color: rgba(0,0,0,0.3);
    }
    .user_img{
        height: 50px;
        width: 50px;
        border:1.5px solid #f5f6fa;

    }
    .img_cont{
        position: relative;
        height: 50px;
        width: 50px;
    }
    .online_icon{
        position: absolute;
        height: 15px;
        width:15px;
        background-color: #4cd137;
        border-radius: 50%;
        bottom: 0.2em;
        right: 0.4em;
        border:1.5px solid white;
    }
    .offline{
        background-color: #c23616 !important;
    }
    .user_info{
        margin-top: auto;
        margin-bottom: auto;
        margin-left: 15px;
    }
    .user_info span{
        font-size: 20px;
        color: white;
    }
    .user_info p{
        font-size: 10px;
        color: rgba(255,255,255,0.6);
        margin-bottom: 10px;
    }
    .video_cam span{
        color: white;
        font-size: 20px;
        cursor: pointer;
        margin-right: 20px;
    }
    .action_menu ul{
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .action_menu ul li{
        width: 100%;
        padding: 10px 15px;
        /*margin-bottom: 5px;*/
    }
    .action_menu ul li i{
        padding-right: 10px;

    }
    .action_menu ul li:hover{
        cursor: pointer;
        background-color: rgba(0,0,0,0.2);
    }
    @media(max-width: 576px){
        .contacts_card{
            margin-bottom: 15px !important;
        }
    }

</style>
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xl-3 chat" style="max-width: 25%;overflow-x: scroll;">
        <div class="card contacts_card">
            <div class="card-header" style="padding-left: 0; padding-right: 0;padding-bottom: 0">
                <div class="input-group">
                    <input type="text" placeholder="Search..." name="search" id="search" class="form-control search">
                    <div class="input-group-prepend">
                        <span class="input-group-text search_btn"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
            <div class="card-body contacts_body" id="contact_list">
                <ui class="contacts">
                    <?php foreach ($users as $u){
                    if ($u['id'] != $this->session->userdata('id')){?>
                    <li class="chatactive" onclick="get_message(<?=$u['id']?>)">
                        <div class="d-flex bd-highlight">
                            <div class="img_cont">
                                <?php if ($u['img']){ ?>
                                <img src="<?=base_url('uploads/'.$u['img'])?>" class="rounded-circle user_img">
                                <?php }else{
                                    echo '<img src="https://i.pinimg.com/originals/ac/b9/90/acb990190ca1ddbb9b20db303375bb58.jpg" class="rounded-circle user_img">';
                                }
                                if ($u['id'] == $_SESSION['id']){
                                    echo '<span class="online_icon"></span>';
                                }
                                ?>
                            </div>
                            <div class="user_info">
                                <span><?=$u['name']?></span>
                                <?php if ($u['id'] == $_SESSION['id']){
                                 echo '<p>'.$u['name'].' is online</p>';
                                }else{
                                    echo '<p>'.$u['name'].' is offline</p>';
                                } ?>
                            </div>
                        </div>
                    </li>
                    <?php } }?>
                </ui>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>

    <div class="col-lg-9 col-md-9 col-sm-9 col-xl-9" id="msg_block" style="display: none;padding-left: 0;max-width: 75%">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <span class="fa fa-comment"></span> Chat
            </div>
            <div class="panel-body" id="chat_view">
                <input id="user_id" hidden/>
                <ul class="chat" id="received"></ul>
            </div>
            <div class="panel-footer">
                <div class="clearfix">
                    <div class="col-md-12" >
                        <div class="input-group">
                            <textarea id="message" type="text" rows="1" class="form-control input-sm" placeholder="Type your message here..." style="resize: none"></textarea>
                            <span class="input-group-btn">
                                <button class="btn btn-success" id="submit" style="height: 100%"><i class="fa fa-send-o"></i> Send</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<audio id="send_message" style="display: none">
    <source src="<?=base_url('assets/')?>sharp.mp3" type="audio/mpeg">
</audio>
<input id="new_msg" hidden>
<audio id="new_message" style="display: none">
    <source src="<?=base_url('assets/')?>notification.mp3" type="audio/mpeg">
</audio>
<script>
    $(function () {
        $('#search').keyup(function() {
            var value = $(this).val();
            console.log(value);
            $.ajax({
                url: "<?=base_url('chat/search')?>",
                type: "POST",
                data: {value:value},
                success: function (data) {
                    $('#contact_list').html(data);
                }
            });
        });
    });

    function get_message(id){
        var user_id = id;
        $("#user_id").val(id);
        console.log(id);
        if(user_id == ''){
            $('#msg_block').hide();
        }else{
            $('#msg_block').show();
        }

        var setCookie = function(key, value) {
            var expires = new Date();
            expires.setTime(expires.getTime() + (5 * 60 * 1000));
            document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
        }

        var getCookie = function(key) {
            var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
            return keyValue ? keyValue[2] : null;
        }

        var guid = function() {
            function s4() {
                return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
            }
            return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
        }


        if(getCookie('user_guid') == null || typeof(getCookie('user_guid')) == 'undefined'){
            var user_guid = guid();
            setCookie('user_guid', user_guid);
        }

        var parseTimestamp = function(timestamp) {
            var d = new Date( timestamp * 1000 ), // milliseconds
                yyyy = d.getFullYear(),
                mm = ('0' + (d.getMonth() + 1)).slice(-2),  // Months are zero based. Add leading 0.
                dd = ('0' + d.getDate()).slice(-2),         // Add leading 0.
                hh = d.getHours(),
                h = hh,
                min = ('0' + d.getMinutes()).slice(-2),     // Add leading 0.
                ampm = 'AM',
                timeString;

            if (hh && 12) {
                h = hh - 12;
                ampm = 'PM';
            } else if (hh === 12) {
                h = 12;
                ampm = 'PM';
            } else if (hh == 0) {
                h = 12;
            }

            timeString = yyyy + '-' + mm + '-' + dd + ', ' + h + ':' + min + ' ' + ampm;

            return timeString;
        }

        // send Message
        var sendChat = function (message, callback) {
            $.getJSON('<?php echo base_url(); ?>api/send_message?message=' + message + '&nickname=' +$("#user_id").val() + '&guid=' + getCookie('user_guid'), function (data){
                callback();
            });
        }

        //Append chat data
        var length = 0;
        var append_chat_data = function (chat_data) {
            var send_by = new Array();
            chat_data.forEach(function (data) {
                var is_me = <?=$this->session->userdata('id')?>;
                if(is_me == data.send_by){
                    send_by.push(
                        '<li class="right clearfix">' +
                        '<span class="chat-img pull-right">' +
                        '<img src="http://placehold.it/50/55C1E7/fff&text=' + data.name.slice(0,1) + '" alt="'+data.name.slice(0,1)+'" class="img-circle"/>' +
                        '</span>' +
                        '<div class="chat-body clearfix">' +
                        '<div class="header">' +
                        '<small class="text-muted"><span class="fa fa-clock-o"></span>' + parseTimestamp(data.timestamp) + ' <a here="#" onclick="remove_message(' + data.id + ')" style="color: red;cursor: pointer;font-size: medium"><i class="fa fa-trash"></i></a></small>' +
                        '<strong class="pull-right primary-font"">' + data.nickname + '</strong>' +
                        '</div>' +
                        '<p class="pull-right">' + data.message + '</p>' +
                        '</div>' +
                        '</li>'
                    );
                }else {
                    length++;
                    send_by.push(
                        '<li class="left clearfix">' +
                        '<span class="chat-img pull-left">' +
                        '<img src="http://placehold.it/50/55C1E7/fff&text=' + data.name.slice(0,1) + '" alt="'+data.name+'" class="img-circle" />' +
                        '</span>' +
                        '<div class="chat-body clearfix">' +
                        '<div class="header">' +
                        '<strong class="primary-font"">' + data.name+'</strong>' +
                        '<small class="pull-right text-muted"><span class="fa fa-clock-o"></span>' + parseTimestamp(data.timestamp) + '</small>' +
                        '</div>' +
                        '<p>' + data.message + '</p>' +
                        '</div>' +
                        '</li>'
                    );
                }

            });

            $('#new_msg').val(length);

            $("#received").html(send_by);
            $('#received').animate({ scrollTop: $('#received').height()}, 1000);
        }

        //Update chat
        var update_chats = function () {
            console.log($("#user_id").val());
            if ($("#user_id").val() != null || $("#user_id").val() != ''){
                $.getJSON('<?php echo base_url(); ?>api/get_messages?user_id=' + $("#user_id").val(), function (data) {
                    append_chat_data(data);
                });
            }
        }
        // view_chat_data(user_id);

        $.getJSON('<?php echo base_url(); ?>api/get_messages?user_id=' + $("#user_id").val(), function (data) {
            append_chat_data(data);
        });


        //Submit for send Message
        $('#submit').click(function (e) {
            e.preventDefault();
            var $field = $('#message');
            var data = $field.val();
            $.getJSON('<?php echo base_url(); ?>api/send_message?message=' + $('#message').val() + '&nickname=' +$("#user_id").val() + '&guid=' + getCookie('user_guid'), function (data){});
            $('#message').val('');
            // sendChat(data,function (){
            //     $field.val('').removeClass('disabled').removeAttr('disabled');
            //     $field.val('');
            // });
        });

        $('#message').keyup(function (e) {
            if (e.which == 13) {
                $('#submit').trigger('click');
                $('#send_message')[0].play();
            }
        });
        //Timer update chats
        setInterval(function (){
            update_chats();
        }, 3000);

    }
    function remove_message(id) {
        console.log("Remove id: "+id);
        $.ajax(
            {
                url: "<?=base_url('chat/remove/')?>"+id,
                success: function(result){
                    console.log(id+" Message remove");
                }
            });
    }
</script>

