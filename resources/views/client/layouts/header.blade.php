<div class="menu-section">
    <div class="container">
        <div class="row">
            <div class="top-bar">
                <ul>
                    <li>
                        <a class='dropdown-button' href='#' data-activates='dropdown1'> {{ __('label.My_account') }} {{ \Illuminate\Support\Facades\Auth::user() ? \Illuminate\Support\Facades\Auth::user()->full_name : '' }}<i
                                    class="fa fa-angle-down"></i></a>
                    </li>
                    <li><a class='dropdown-button' href='#' data-activates='dropdown2'>{{$current_language->name}} <i
                                    class="fa fa-angle-down"></i></a>
                    </li>
                    <li>
                        <a href="#">{{ __('label.Phone') }}: {{ $inforWeb->phone }}</a>
                    </li>
                </ul>
            </div>
            <div class="all-drop-down">
                <ul id='dropdown1' class='dropdown-content drop-con-man'>
                    @if (\Illuminate\Support\Facades\Auth::check())
                        <li>
                            <a href="db-profile.html"><img
                                        src="{{asset('/bower_components/client_layout/images/icon/2.png')}}"
                                        alt=""> {{ __('label.My_profile') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('profile.mybooking') }}"><img
                                        src="{{asset('/bower_components/client_layout/images/icon/16.png')}}"
                                        alt=""> {{ __('label.My_booking') }}</a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <a href="javascript:;">
                                    <img src="{{asset('/bower_components/client_layout/images/icon/13.png')}}"
                                         alt="">
                                </a>

                                <button class="btn-logout">
                                    {{ __('label.Log_out') }}
                                </button>
                            </form>

                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}"><img
                                        src="{{asset('/bower_components/client_layout/images/icon/6.png')}}"
                                        alt=""> {{ __('label.Log_in') }}</a>
                        </li>
                        <li>
                            <a href="#!" data-toggle="modal" data-target="#modal2"><img
                                        src="{{asset('/bower_components/client_layout/images/icon/5.png')}}"
                                        alt=""> {{ __('label.Register') }}</a>
                        </li>
                    @endif
                </ul>
                <ul id='dropdown2' class='dropdown-content drop-con-man'>
                    @foreach( $header_languages as $header_language )
                        <li>
                            <a href="{{ route('changeLanguage', $header_language->id) }}">
                                {{ $header_language->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <ul id='drop-room' class='dropdown-content drop-con-man'>
                    @foreach ($locations as $location)
                        <li>
                            <a href="{{ route('rooms.index', session('locale') == config('common.languages.default') ? $location->id : $location->lang_parent_id) }}">{{ $location->name }}</a>
                    @endforeach
                </ul>

                <ul id='drop-categories' class='dropdown-content drop-con-man'>
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('post.categoryPost', ['name' => $category->name]) }}">{{ $category->name }}</a>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="logo">
                <a href="{{ route('home') }}"><img
                            src="{{ asset(config('common.uploads.logo')) . '/' . $inforWeb->logo }}" alt=""/>
                </a>
            </div>
            <div class="menu-bar">
                <ul>
                    <li><a href="{{ route('home') }}" class='dropdown-button'
                           data-activates='drop-home'>{{ __('label.Home') }}</a>
                    </li>
                    <li><a href="#" class='dropdown-button' data-activates='drop-room'>{{ __('label.Hotel') }}<i
                                    class="fa fa-angle-down"></i></a>
                    </li>
                    <li><a href="#">About Us</a>
                    <li><a href="{{ route('post.index') }}" class='dropdown-button'
                           data-activates='drop-categories'>{{ __('label.Blog') }}
                            <i class="fa fa-angle-down"></i></a>
                    </li>
                    <li><a href="{{ route('contact.index') }}">{{ __('label.Contact') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
