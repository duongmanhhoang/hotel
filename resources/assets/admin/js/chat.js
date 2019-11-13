let updateStatusUrl = $('#update-status-url').val();
let getChannel = $('#channel-chat').val();
let md5GetChannel = $('#md5-channel-chat').val().trim();
let urlChannel = $('#url-channel').val();
//Thay giá trị PUSHER_APP_KEY vào chỗ xxx này nhé
let pusher = new Pusher('22b475f304dfb3203361', {
    cluster: "ap1"
});

let channelShowUnread = pusher.subscribe('show-unread');
channelShowUnread.bind('App\\Events\\ShowUnread', function (dataUnread) {
    if (dataUnread.email != getChannel) {
        let old = parseInt($('#notification-unread-' + dataUnread.md5).text());
        if (isNaN(old)) {
            old = 0;
            let new_messages = ++old;
            $('#notification-unread-item-' + dataUnread.md5).html('<span id="notification-unread-' + dataUnread.md5 + '">' + new_messages + '</span> tin nhắn chưa đọc')
        } else {
            let new_messages = ++old;
            $('#notification-unread-' + dataUnread.md5).text(new_messages);
        }
        $('#preview-' + dataUnread.md5).text(dataUnread.message);
    }
});

let channelShow = pusher.subscribe('show-new-chat');

channelShow.bind('App\\Events\\Admin\\ShowNewChat', function (data) {
    $('<a href="' + urlChannel + '/' + data.email + '">\n' +
        '                                                                        <li class="contact ">\n' +
        '                                                                            <div class="wrap">\n' +
        '                                                                                <div class="meta">\n' +
        '                                                                                    <p id="notification-unread-item-' + data.md5 + '" class="notification-unread text-danger">\n' +
        '                                                                                                                                                                                    <span id="notification-unread-' + data.md5 + '">1</span>\n' +
        '                                                                                            tin nhắn chưa đọc\n' +
        '                                                                                                                                                                            </p>\n' +
        '                                                                                    <p class="name">' + data.email + ' </p>\n' +
        '                                                                                    <p id="preview-' + data.md5 + '" class="preview">' + data.message + '</p>\n' +
        '                                                                                </div>\n' +
        '                                                                            </div>\n' +
        '                                                                        </li>\n' +
        '                                                                    </a>').prependTo($('.list-contacts'));
});

let channel = pusher.subscribe(md5GetChannel);

channel.bind('App\\Events\\Chat', function (data) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        contentType: false,
        processData: false,
        url: updateStatusUrl,
        type: 'POST',
        dataType: 'json',
        success: function () {
        }, error: function () {
            toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
        },
    });

    $('<li class="sent">' +
        '<p>' + data.message + '</p><br>' +
        '<span class="message-time">' + data.time + '</span></li>').appendTo($('.messages ul'));
    $(".messages-scroll").stop().animate({scrollTop: $(".messages-scroll")[0].scrollHeight}, 1);
});

$('#admin-chat-submit').click(function (e) {
    e.preventDefault();
    let url = $('#admin-url-chat').val();
    let formChat = new FormData();
    let message = $('#admin-chat-input').val();
    let email = $('#admin-chat-email').val();
    let channel = $('#channel-chat').val();
    formChat.append('email', email);
    formChat.append('message', message);
    formChat.append('channel', channel);
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
        data: formChat,
        success: function (response) {
            if (response.messages == 'Validation_fails') {
                toastr.error(response.data.message[0], 'Cảnh báo!!');
            }
            if (response.messages == 'success') {
                message = $(".message-input input").val();
                $('<li class="replies"><p>' + message + '</p></li>').appendTo($('.messages ul'));
                $('#admin-chat-input').val(null);
                $(".messages-scroll").stop().animate({scrollTop: $(".messages-scroll")[0].scrollHeight}, 1);
            }
        }, error: function () {
            toastr.error('Có lỗi xảy ra, xin vui lòng thử lại', 'Cảnh báo!!');
        },
    });
});


// Auto Scroll To Bottom
$(".messages-scroll").stop().animate({scrollTop: $(".messages-scroll")[0].scrollHeight}, 1);
$("#profile-img").click(function () {
    $("#status-options").toggleClass("active");
});

$(".expand-button").click(function () {
    $("#profile").toggleClass("expanded");
    $("#contacts").toggleClass("expanded");
});
