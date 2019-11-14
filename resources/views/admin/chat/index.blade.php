@extends('admin.layouts.master')
@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Chat
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-section">
                            <div class="m-section__content">
                                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                                    <div class="row align-items-center">
                                        <div class="col-2"></div>
                                        <div class="col-8">
                                            <div class="form-group m-form__group row align-items-center">
                                                <div class="container">

                                                </div>
                                                <div id="frame" class="row">
                                                    <div id="sidepanel" class="col-3">
                                                        <div id="contacts">
                                                            <ul class="list-contacts" id="list-contacts" style="list-style-type: none">
                                                                @foreach ($contacts as $contact)
                                                                    <a href="{{ route('admin.chat.index', $contact['email']) }}">
                                                                        <li class="contact @if (isset($user_email) && $user_email == $contact['email']) {{ 'active' }} @endif">
                                                                            <div class="wrap">
                                                                                <div class="meta">
                                                                                    <p id="notification-unread-item-{{ md5($contact['email']) }}"
                                                                                       class="notification-unread text-danger">
                                                                                        @if ($contact['unread'] > 0)
                                                                                            <span id="notification-unread-{{ md5($contact['email']) }}">{{ $contact['unread'] }} </span>  tin nhắn chưa đọc
                                                                                        @endif
                                                                                    </p>
                                                                                    <p class="name">{{ $contact['email'] }} </p>
                                                                                    <p id="preview-{{ md5($contact['email']) }}"
                                                                                       class="preview">{{ $contact['new_message'] }}</p>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </a>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="content col-9">
                                                        <div class="row">
                                                            <div class="contact-profile">
                                                                <p class="m--margin-left-20">
                                                                    @if (isset($user_email))
                                                                        {{ $user_email }}
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="row messages-scroll">
                                                            <div class="messages">
                                                                <ul>
                                                                    @if (isset($logs))
                                                                        @foreach ($logs as $log)
                                                                            @if ($log['type'] == 'client')
                                                                                <li class="sent">
                                                                                    <p>{{ $log['body'] }}</p>
                                                                                    <br>
                                                                                    <span class="message-time">{{ $log['time'] }} </span>
                                                                                </li>
                                                                            @else
                                                                                <li class="replies">
                                                                                    <p>{{ $log['body'] }}</p>
                                                                                </li>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                        <div class="message-input">
                                                            <div class="wrap">
                                                                <input style="padding-left: 30px" type="text" id="admin-chat-input" placeholder="Gửi tin nhắn"/>
                                                                <input type="hidden" id="admin-url-chat"
                                                                       value="{{ route('admin.chat.send') }}">
                                                                <input type="hidden" id="admin-chat-email"
                                                                       value="{{ \Illuminate\Support\Facades\Auth::user()->email }}">
                                                                <button style="display: none" class="submit" id="admin-chat-submit">
                                                                    <i class="fa fa-mail-forward"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="channel-chat" value="{{ isset($user_email) ? $user_email : '' }}">
    <input type="hidden" id="md5-channel-chat" value="{{ isset($user_email) ? md5($user_email) : '' }}">
    <input type="hidden" id="url-channel" value="{{ route('admin.chat.index', '') }}">
    @if (isset($user_email))
        <input type="hidden" id="update-status-url" value="{{ route('admin.chat.updateStatus', $user_email) }}">
    @endif
@endsection
@section('script')
    <script src="{{ asset('/js/chat.js') }}"></script>
    <script>
        let input = document.getElementById("admin-chat-input");
        input.addEventListener("keyup", function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                document.getElementById("admin-chat-submit").click();
            }
        });
    </script>
@endsection
