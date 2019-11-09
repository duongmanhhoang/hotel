<div class="menu-section">
    <div class="container">
        <div class="row">
            <div class="top-bar">
                <ul>
                    <li><a class='dropdown-button' href='#' data-activates='dropdown1'> My Account <i
                                    class="fa fa-angle-down"></i></a>
                    </li>
                    <li><a href="all_room.html">Our Hotels</a>
                    </li>
                    <li><a href="about_us.html">About Us</a>
                    </li>
                    <li><a href="s">Contact Us</a>
                    </li>
                    <li><a class='dropdown-button' href='#' data-activates='dropdown2'>{{$current_language->name}} <i
                                    class="fa fa-angle-down"></i></a>
                    </li>
                    <li><a href="#">Toll Free No: {{ $inforWeb->phone }}</a>
                    </li>
                </ul>
            </div>
            <div class="all-drop-down">
                <ul id='dropdown1' class='dropdown-content drop-con-man'>
                    <li>
                        <a href="dashboard.html"><img
                                    src="{{asset('/bower_components/client_layout/images/icon/15.png')}}" alt=""> My
                            Account</a>
                    </li>
                    <li>
                        <a href="db-profile.html"><img
                                    src="{{asset('/bower_components/client_layout/images/icon/2.png')}}" alt=""> My
                            Profile</a>
                    </li>
                    <li>
                        <a href="db-booking.html"><img
                                    src="{{asset('/bower_components/client_layout/images/icon/16.png')}}" alt=""> My
                            Bookings</a>
                    </li>
                    <li>
                        <a href="db-event.html"><img
                                    src="{{asset('/bower_components/client_layout/images/icon/17.png')}}" alt=""> My
                            Events</a>
                    </li>
                    <li>
                        <a href="db-activity.html"><img
                                    src="{{asset('/bower_components/client_layout/images/icon/14.png')}}" alt=""> My
                            Activity</a>
                    </li>
                    <li>
                        <a href="#!" data-toggle="modal" data-target="#modal2"><img
                                    src="{{asset('/bower_components/client_layout/images/icon/5.png')}}" alt="">
                            Register</a>
                    </li>
                    <li>
                        <a href="#!" data-toggle="modal" data-target="#modal1"><img
                                    src="{{asset('/bower_components/client_layout/images/icon/6.png')}}" alt=""> Log In</a>
                    </li>
                    <li>
                        <a href="#!" data-toggle="modal" data-target="#modal3"><img
                                    src="{{asset('/bower_components/client_layout/images/icon/13.png')}}" alt=""> Forgot
                            Password</a>
                        <a href="dashboard.html"><img
                                    src="{{ asset('bower_components/client_layout/images/icon/15.png') }}" alt=""> My
                            Account</a>
                    </li>
                    <li>
                        <a href="db-profile.html"><img
                                    src="{{ asset('bower_components/client_layout/images/icon/2.png') }}" alt=""> My
                            Profile</a>
                    </li>
                    <li>
                        <a href="db-booking.html"><img
                                    src="{{ asset('bower_components/client_layout/images/icon/16.png') }}" alt=""> My
                            Bookings</a>
                    </li>
                    <li>
                        <a href="db-event.html"><img
                                    src="{{ asset('bower_components/client_layout/images/icon/17.png') }}" alt=""> My
                            Events</a>
                    </li>
                    <li>
                        <a href="db-activity.html"><img
                                    src="{{ asset('bower_components/client_layout/images/icon/14.png') }}" alt=""> My
                            Activity</a>
                    </li>
                    <li>
                        <a href="#!" data-toggle="modal" data-target="#modal2"><img
                                    src="{{ asset('bower_components/client_layout/images/icon/5.png') }}" alt="">
                            Register</a>
                    </li>
                    <li>
                        <a href="#!" data-toggle="modal" data-target="#modal1"><img
                                    src="{{ asset('bower_components/client_layout/images/icon/6.png') }}" alt=""> Log In</a>
                    </li>
                    <li>
                        <a href="#!" data-toggle="modal" data-target="#modal3"><img
                                    src="{{ asset('bower_components/client_layout/images/icon/13.png') }}" alt="">
                            Forgot Password</a>
                    </li>
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
                        <li><a href="{{ route('rooms.index', session('locale') == config('common.languages.default') ? $location->id : $location->lang_parent_id) }}">{{ $location->name }}</a>
                    @endforeach
                </ul>

                <ul id='drop-categories' class='dropdown-content drop-con-man'>
                    @foreach ($categories as $category)
                        <li><a href="{{ route('post.categoryPost', ['name' => $category->name]) }}">{{ $category->name }}</a>
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
                    <li><a href="index.html" class='dropdown-button' data-activates='drop-home'>Home</a>
                    </li>
                    <li><a href="all_room.html" class='dropdown-button' data-activates='drop-room'>Rooms</a>
                    </li>
                    <li><a href="#" class='dropdown-button' data-activates='drop-posts'>Hotel <i
                                    class="fa fa-angle-down"></i></a>
                    </li>
                    <li><a href="{{ route('post.index') }}" class='dropdown-button' data-activates='drop-categories'>Blog <i
                                    class="fa fa-angle-down"></i></a>
                    </li>
                    <li><a href="{{ route('contact.index') }}">About Us</a>
                    </li>
                    <li><a href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
		