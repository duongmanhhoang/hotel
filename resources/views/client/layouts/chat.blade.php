<div id="body">
    <input type="hidden" value="{{ session('chat_with_admin_email') }}" id="chat_with_admin_email_session">
    <div id="chat-circle" class="btn btn-raised">
        <div id="chat-overlay"></div>
        <i class="fa fa-envelope"></i>
        <div id="chat-unread">0</div>
    </div>
    <div class="chat-box" style="z-index: 9999">
        <div class="chat-box-header">
            {{ __('label.Chat_with_admin') }}
            <span class="chat-box-toggle"><i class="material-icons">&times</i></span>
        </div>
        <div class="chat-box-email">
            <form>
                <input type="hidden" id="url-chat-with-admin-email-submit"
                       value="{{ route('chatWithAdmin.submitEmail') }}">
                <div class="form-group">
                    <label class="my-label">{{ __('messages.Enter_Email') }}</label>
                    <input type="text" id="chat_with_admin_email" class="form-control" value="">
                </div>
                <div class="form-group">
                    <input type="submit" value="{{ __('label.Submit') }}"
                           class="form-control chat_with_admin_email_submit">
                </div>
            </form>
        </div>
        <div class="chat-box-holder">
            <div class="chat-box-body">
                <div class="chat-box-overlay">
                </div>
                <div class="chat-logs" id="logs">
                    @if (session('chat_with_admin_email'))
                        @if (!is_null($client_logs))
                            @foreach ($client_logs as $client_log)
                                @if ($client_log['type'] == 'admin')
                                    <div class="chat-msg user">
                                        <div>Admin</div>
                                        <div class="cm-msg-text">{{ $client_log['body'] }}</div>
                                    </div>
                                @else
                                    <div class="chat-msg self">
                                        <div class="cm-msg-text">{{ $client_log['body'] }}</div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    @endif
                </div>
            </div>
            <div class="chat-input">
                <form>
                    <input type="text" id="chat-input"/>
                    <input type="hidden" id="url-chat-submit" value="{{ route('chatWithAdmin.send') }}">
                    <button type="submit" class="chat-submit" id="chat-submit"><i
                            class="fa fa-mail-forward"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@section('script')

@endsection
