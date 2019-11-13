let statusMessage = true;
let getChannel = $('#chat_with_admin_email_session').val();
if (getChannel !== '') {
    $('.chat-box-email').hide();
    $('.chat-box-holder').show();
}

let pusher = new Pusher('22b475f304dfb3203361', {
    cluster: "ap1"
});

$("#chat-circle").click(function () {
    $('#chat-unread').text(0);
    statusMessage = false;
    $("#chat-circle").toggle('scale');
    $(".chat-box").toggle('scale');
    $(".chat-logs").stop().animate({scrollTop: $(".chat-logs")[0].scrollHeight}, 1000);
});

//close box chat
$(".chat-box-toggle").click(function () {
    statusMessage = true;
    $("#chat-circle").toggle('scale');
    $(".chat-box").toggle('scale');
});

if (getChannel !== '') {
    // Subscribe to the channel we specified in our Laravel Event
    let channel = pusher.subscribe('admin-' + getChannel);

    // Bind a function to a Event (the full Laravel class)
    channel.bind('App\\Events\\Admin\\Chat', function (data) {
        if (statusMessage == true) {
            let getUnread = parseInt($('#chat-unread').text());
            $('#chat-unread').text(++getUnread);
        }
        let str = "";
        str += "<div class='chat-msg user'><div>Admin</div>";
        str += "<div class=\"cm-msg-text\">";
        str += data.message;
        str += "          <\/div>";
        str += "        <\/div>";
        $(".chat-logs").append(str);
        $(".chat-logs").stop().animate({scrollTop: $(".chat-logs")[0].scrollHeight}, 1);
    });
}

//send chat message
$('#chat-submit').click(function (e) {
    e.preventDefault();
    let url = $('#url-chat-submit').val();
    let formComment = new FormData();
    let message = $('#chat-input').val();
    let email = $('#chat_with_admin_email_session').val();
    formComment.append('message', message);
    formComment.append('email', email);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        contentType: false,
        processData: false,
        url: url,
        type: 'POST',
        dataType: 'json',
        data: formComment,
        success: function (response) {
            if (response.messages == 'Validation_fails') {
                toastr.error(response.data.message[0], 'Cảnh báo!!');
            }
            if (response.messages == 'success') {
                $(function () {
                    let INDEX = 0;
                    let msg = $("#chat-input").val();
                    if (msg.trim() == '') {
                        return false;
                    }
                    generate_message(msg, 'self');


                    function generate_message(msg, type) {
                        INDEX++;
                        let str = "";
                        str += "<div id='cm-msg-" + INDEX + "' class=\"chat-msg " + type + "\">";
                        str += "          <div class=\"cm-msg-text\">";
                        str += msg;
                        str += "          <\/div>";
                        str += "        <\/div>";
                        $(".chat-logs").append(str);
                        $("#cm-msg-" + INDEX).hide().fadeIn(300);
                        if (type == 'self') {
                            $("#chat-input").val('');
                        }
                        $(".chat-logs").stop().animate({scrollTop: $(".chat-logs")[0].scrollHeight}, 1000);
                    }

                    function generate_button_message(msg, buttons) {
                        /* Buttons should be object array
                          [
                            {
                              name: 'Existing User',
                              value: 'existing'
                            },
                            {
                              name: 'New User',
                              value: 'new'
                            }
                          ]
                        */
                        // INDEX++;
                        let btn_obj = buttons.map(function (button) {
                            return "              <li class=\"button\"><a href=\"javascript:;\" class=\"btn btn-primary chat-btn\" chat-value=\"" + button.value + "\">" + button.name + "<\/a><\/li>";
                        }).join('');
                        let str = "";
                        str += "<div id='cm-msg-" + INDEX + "' class=\"chat-msg user\">";
                        str += "          <div class=\"cm-msg-text\">";
                        str += msg;
                        str += "          <\/div>";
                        str += "          <div class=\"cm-msg-button\">";
                        str += "            <ul>";
                        str += btn_obj;
                        str += "            <\/ul>";
                        str += "          <\/div>";
                        str += "        <\/div>";
                        $(".chat-logs").append(str);
                        $("#cm-msg-" + INDEX).hide().fadeIn(300);
                        $(".chat-logs").stop().animate({scrollTop: $(".chat-logs")[0].scrollHeight}, 1000);
                        $("#chat-input").attr("disabled", true);
                    }

                    $(document).delegate(".chat-btn", "click", function () {
                        let value = $(this).attr("chat-value");
                        let name = $(this).html();
                        $("#chat-input").attr("disabled", false);
                        generate_message(name, 'self');
                    })


                })
            }
        }, error: function () {
            toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
        },
    });
});

$('.chat_with_admin_email_submit').click(function (e) {
    e.preventDefault();
    let url = $('#url-chat-with-admin-email-submit').val();
    let formComment = new FormData();
    let email = $('#chat_with_admin_email').val();
    formComment.append('email', email);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        contentType: false,
        processData: false,
        url: url,
        type: 'POST',
        dataType: 'json',
        data: formComment,
        success: function (response) {
            if (response.messages === 'Validation_fails') {
                toastr.error(response.data.email[0], 'Cảnh báo!!');
            }
            if (response.messages === 'success') {
                $('#chat_with_admin_email_session').val(email);
                // Subscribe to the channel we specified in our Laravel Event
                let channel = pusher.subscribe('admin-' + email);

                // Bind a function to a Event (the full Laravel class)
                channel.bind('App\\Events\\Admin\\Chat', function (data) {
                    if (statusMessage == true) {
                        let getUnread = parseInt($('#chat-unread').text());
                        $('#chat-unread').text(++getUnread);
                    }
                    let str = "";
                    str += "<div class='chat-msg user'><div>Admin</div>";
                    str += "<div class=\"cm-msg-text\">";
                    str += data.message;
                    str += "          <\/div>";
                    str += "        <\/div>";
                    $(".chat-logs").append(str);
                });
                $('.chat-box-email').hide();
                $('.chat-box-holder').show();
            }
        }, error: function () {
            toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
        },
    });
});
