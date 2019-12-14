@extends('client.layouts.master')
@section('content')
    <div>
        @include('client.layouts.headerWithFilter', ['headerImage' => asset('bower_components/client_layout/images/detailed-banner.jpg')])
        <div class="hom1 hom-com pad-bot-40">
            <div class="container">
                <div class="row">
                    <div class="hom1-title">
                        <h2>{{ __('label.Our_rooms') }}</h2>
                        <div class="head-title">
                            <div class="hl-1"></div>
                            <div class="hl-2"></div>
                            <div class="hl-3"></div>
                        </div>
                        <p>{{ __('messages.Our_rooms') }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="to-ho-hotel">
                        @foreach ($rooms as $room)
                            @php
                                $stars = round((int)$room->rating);
                                $whiteStars = 5 - (int)$room->rating;
                            @endphp
                            <div class="col-md-4">
                                <div class="to-ho-hotel-con">
                                    <div class="to-ho-hotel-con-1">
                                        <img
                                            src="{{ asset(config('common.uploads.rooms') . '/' . $room->image) }}"
                                            style="height: 250px; object-fit: cover"></div>
                                    <div class="to-ho-hotel-con-23">
                                        <div class="to-ho-hotel-con-2">
                                            <a href="{{ route('rooms.detail', [$room->location_id, $room->id]) }}">
                                                <h4>{{ $room->name }}</h4>
                                            </a></div>
                                        <div class="to-ho-hotel-con-3">
                                            <ul>
                                                <li>{{ __('label.Destination') }}:
                                                   {{ $room->location_name }}
                                                    <div
                                                        class="dir-rat-star ho-hot-rat-star"> {{ __('label.Rating') }}
                                                        :
                                                        @for($i = 0; $i < $stars; $i++)
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                        @endfor
                                                        @for($i = 0; $i < $whiteStars; $i++)
                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                        @endfor
                                                    </div>
                                                </li>
                                                @if ($room->sale_status == config('common.active.is_active'))
                                                    <li>
                                                                <span
                                                                    class="ho-hot-pri-dis">{{ number_format($room->detail->price) }} {{ $baseLang == session('locale') ? 'đ' : '$' }}</span>
                                                        <span style="font-size: 30px"
                                                              class="ho-hot-pri">{{ number_format($room->detail->sale_price) }} {{ $baseLang == session('locale') ? 'đ' : '$' }}</span>
                                                    </li>
                                                @else
                                                    <li>
                                                                    <span style="font-size: 30px"
                                                                          class="ho-hot-pri">{{ number_format($room->detail->price) }} {{ $baseLang == session('locale') ? 'đ' : '$' }}</span>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <div class="offer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="offer-l"><span class="ol-1"></span> <span class="ol-2"><i
                                    class="fa fa-star"></i><i class="fa fa-star"></i><i
                                    class="fa fa-star"></i><i class="fa fa-star"></i><i
                                    class="fa fa-star"></i></span>
                            <span class="ol-4">{{ __('label.Banner_home') }}</span> <span class="ol-3"></span>
                            {{--<span class="ol-5">$99/-</span>--}}
                            <ul>
                                <li>
                                    <a href="#!" class="waves-effect waves-light btn-large offer-btn"><img
                                            src="{{ asset('bower_components/client_layout/images/icon/dis1.png') }}"
                                            alt="">
                                    </a><span>{{ __('label.Free_wifi') }}</span>
                                </li>
                                <li>
                                    <a href="#!" class="waves-effect waves-light btn-large offer-btn"><img
                                            src="{{ asset('bower_components/client_layout/images/icon/dis3.png') }}"
                                            alt=""> </a><span>{{ __('label.Pool') }}</span>
                                </li>
                                <li>
                                    <a href="#!" class="waves-effect waves-light btn-large offer-btn"><img
                                            src="{{ asset('bower_components/client_layout/images/icon/dis4.png') }}"
                                            alt=""> </a><span>{{ __('label.Tv') }}</span>
                                </li>
                                <li>
                                    <a href="#!" class="waves-effect waves-light btn-large offer-btn"><img
                                            src="{{ asset('bower_components/client_layout/images/icon/dis5.png') }}"
                                            alt=""> </a><span>{{ __('label.Gym') }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="offer-r">
                            <div class="or-1"><span class="or-11">go</span> <span class="or-12">Stays</span></div>
                            <div class="or-2"><span class="or-21">{{ __('label.Welcome') }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--<div class="blog hom-com pad-bot-0">--}}
        {{--<div class="container">--}}
        {{--<div class="row">--}}
        {{--<div class="hom1-title">--}}
        {{--<h2>Photo Gallery</h2>--}}
        {{--<div class="head-title">--}}
        {{--<div class="hl-1"></div>--}}
        {{--<div class="hl-2"></div>--}}
        {{--<div class="hl-3"></div>--}}
        {{--</div>--}}
        {{--<p>Cùng Atlantic chia sẻ những bức hình tuyệt nhất bạn nhé</p>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
        {{--<div class="col-md-12">--}}
        {{--<div class="inn-services head-typo typo-com mar-bot-0">--}}
        {{--<ul id="filters" class="clearfix">--}}
        {{--<li><span class="filter active"--}}
        {{--data-filter=".app, .card, .icon, .logo, .web">Tất cả</span>--}}
        {{--</li>--}}
        {{--<li><span class="filter" data-filter=".app">Khách sạn</span>--}}
        {{--</li>--}}
        {{--<li><span class="filter" data-filter=".card">Tiện nghi</span>--}}
        {{--</li>--}}
        {{--<li><span class="filter" data-filter=".icon">Phòng</span>--}}
        {{--</li>--}}
        {{--<li><span class="filter" data-filter=".logo">Ẩm thực</span>--}}
        {{--</li>--}}
        {{--<li><span class="filter" data-filter=".web">Sự kiện</span>--}}
        {{--</li>--}}
        {{--</ul>--}}
        {{--<div id="portfoliolist">--}}
        {{--<div class="portfolio logo" data-cat="logo">--}}
        {{--<div class="portfolio-wrapper"><img src="img/portfolios/logo/5.jpg" alt=""/>--}}
        {{--<div class="label">--}}
        {{--<div class="label-text"><a class="text-title">Photo Caption</a> <span--}}
        {{--class="text-category">Logo</span></div>--}}
        {{--<div class="label-bg"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="portfolio app" data-cat="app">--}}
        {{--<div class="portfolio-wrapper"><img src="img/portfolios/app/1.jpg" alt=""/>--}}
        {{--<div class="label">--}}
        {{--<div class="label-text"><a class="text-title">Photo Caption</a> <span--}}
        {{--class="text-category">APP</span></div>--}}
        {{--<div class="label-bg"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="portfolio web" data-cat="web">--}}
        {{--<div class="portfolio-wrapper"><img src="img/portfolios/web/4.jpg" alt=""/>--}}
        {{--<div class="label">--}}
        {{--<div class="label-text"><a class="text-title">Photo Caption</a> <span--}}
        {{--class="text-category">Web design</span></div>--}}
        {{--<div class="label-bg"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="portfolio card" data-cat="card">--}}
        {{--<div class="portfolio-wrapper"><img src="img/portfolios/card/1.jpg" alt=""/>--}}
        {{--<div class="label">--}}
        {{--<div class="label-text"><a class="text-title">Photo Caption</a> <span--}}
        {{--class="text-category">Business card</span></div>--}}
        {{--<div class="label-bg"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="portfolio app" data-cat="app">--}}
        {{--<div class="portfolio-wrapper"><img src="img/portfolios/app/3.jpg" alt=""/>--}}
        {{--<div class="label">--}}
        {{--<div class="label-text"><a class="text-title">Photo Caption</a> <span--}}
        {{--class="text-category">APP</span></div>--}}
        {{--<div class="label-bg"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="portfolio card" data-cat="card">--}}
        {{--<div class="portfolio-wrapper"><img src="img/portfolios/card/4.jpg" alt=""/>--}}
        {{--<div class="label">--}}
        {{--<div class="label-text"><a class="text-title">Photo Caption</a> <span--}}
        {{--class="text-category">Business card</span></div>--}}
        {{--<div class="label-bg"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="portfolio card" data-cat="card">--}}
        {{--<div class="portfolio-wrapper"><img src="img/portfolios/card/5.jpg" alt=""/>--}}
        {{--<div class="label">--}}
        {{--<div class="label-text"><a class="text-title">Photo Caption</a> <span--}}
        {{--class="text-category">Business card</span></div>--}}
        {{--<div class="label-bg"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="portfolio logo" data-cat="logo">--}}
        {{--<div class="portfolio-wrapper"><img src="img/portfolios/logo/1.jpg" alt=""/>--}}
        {{--<div class="label">--}}
        {{--<div class="label-text"><a class="text-title">Photo Caption</a> <span--}}
        {{--class="text-category">Logo</span></div>--}}
        {{--<div class="label-bg"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="portfolio app" data-cat="app">--}}
        {{--<div class="portfolio-wrapper"><img src="img/portfolios/app/2.jpg" alt=""/>--}}
        {{--<div class="label">--}}
        {{--<div class="label-text"><a class="text-title">Photo Caption</a> <span--}}
        {{--class="text-category">APP</span></div>--}}
        {{--<div class="label-bg"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="portfolio card" data-cat="card">--}}
        {{--<div class="portfolio-wrapper"><img src="img/portfolios/card/2.jpg" alt=""/>--}}
        {{--<div class="label">--}}
        {{--<div class="label-text"><a class="text-title">Photo Caption</a> <span--}}
        {{--class="text-category">Business card</span></div>--}}
        {{--<div class="label-bg"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="portfolio logo" data-cat="logo">--}}
        {{--<div class="portfolio-wrapper"><img src="img/portfolios/logo/6.jpg" alt=""/>--}}
        {{--<div class="label">--}}
        {{--<div class="label-text"><a class="text-title">Photo Caption</a> <span--}}
        {{--class="text-category">Logo</span></div>--}}
        {{--<div class="label-bg"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="portfolio logo" data-cat="logo">--}}
        {{--<div class="portfolio-wrapper"><img src="img/portfolios/logo/7.jpg" alt=""/>--}}
        {{--<div class="label">--}}
        {{--<div class="label-text"><a class="text-title">Photo Caption</a> <span--}}
        {{--class="text-category">Logo</span></div>--}}
        {{--<div class="label-bg"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="portfolio icon" data-cat="icon">--}}
        {{--<div class="portfolio-wrapper"><img src="img/portfolios/icon/4.jpg" alt=""/>--}}
        {{--<div class="label">--}}
        {{--<div class="label-text"><a class="text-title">Photo Caption</a> <span--}}
        {{--class="text-category">Icon</span></div>--}}
        {{--<div class="label-bg"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="portfolio web" data-cat="web">--}}
        {{--<div class="portfolio-wrapper"><img src="img/portfolios/web/3.jpg" alt=""/>--}}
        {{--<div class="label">--}}
        {{--<div class="label-text"><a class="text-title">Photo Caption</a> <span--}}
        {{--class="text-category">Web design</span></div>--}}
        {{--<div class="label-bg"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="portfolio icon" data-cat="icon">--}}
        {{--<div class="portfolio-wrapper"><img src="img/portfolios/icon/1.jpg" alt=""/>--}}
        {{--<div class="label">--}}
        {{--<div class="label-text"><a class="text-title">Photo Caption</a> <span--}}
        {{--class="text-category">Icon</span></div>--}}
        {{--<div class="label-bg"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="portfolio web" data-cat="web">--}}
        {{--<div class="portfolio-wrapper"><img src="img/portfolios/web/2.jpg" alt=""/>--}}
        {{--<div class="label">--}}
        {{--<div class="label-text"><a class="text-title">Photo Caption</a> <span--}}
        {{--class="text-category">Web design</span></div>--}}
        {{--<div class="label-bg"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="portfolio icon" data-cat="icon">--}}
        {{--<div class="portfolio-wrapper"><img src="img/portfolios/icon/2.jpg" alt=""/>--}}
        {{--<div class="label">--}}
        {{--<div class="label-text"><a class="text-title">Photo Caption</a> <span--}}
        {{--class="text-category">Icon</span></div>--}}
        {{--<div class="label-bg"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="portfolio icon" data-cat="icon">--}}
        {{--<div class="portfolio-wrapper"><img src="img/portfolios/icon/5.jpg" alt=""/>--}}
        {{--<div class="label">--}}
        {{--<div class="label-text"><a class="text-title">3D Map</a> <span--}}
        {{--class="text-category">Icon</span></div>--}}
        {{--<div class="label-bg"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="portfolio web" data-cat="web">--}}
        {{--<div class="portfolio-wrapper"><img src="img/portfolios/web/1.jpg" alt=""/>--}}
        {{--<div class="label">--}}
        {{--<div class="label-text"><a class="text-title">Note</a> <span--}}
        {{--class="text-category">Web design</span></div>--}}
        {{--<div class="label-bg"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="portfolio logo" data-cat="logo">--}}
        {{--<div class="portfolio-wrapper"><img src="img/portfolios/logo/3.jpg" alt=""/>--}}
        {{--<div class="label">--}}
        {{--<div class="label-text"><a class="text-title">Native Designers</a> <span--}}
        {{--class="text-category">Logo</span></div>--}}
        {{--<div class="label-bg"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="portfolio logo" data-cat="logo">--}}
        {{--<div class="portfolio-wrapper"><img src="img/portfolios/logo/4.jpg" alt=""/>--}}
        {{--<div class="label">--}}
        {{--<div class="label-text"><a class="text-title">Bookworm</a> <span--}}
        {{--class="text-category">Logo</span></div>--}}
        {{--<div class="label-bg"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="portfolio icon" data-cat="icon">--}}
        {{--<div class="portfolio-wrapper"><img src="img/portfolios/icon/3.jpg" alt=""/>--}}
        {{--<div class="label">--}}
        {{--<div class="label-text"><a class="text-title">Sandwich</a> <span--}}
        {{--class="text-category">Icon</span></div>--}}
        {{--<div class="label-bg"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="portfolio card" data-cat="card">--}}
        {{--<div class="portfolio-wrapper"><img src="img/portfolios/card/3.jpg" alt=""/>--}}
        {{--<div class="label">--}}
        {{--<div class="label-text"><a class="text-title">Reality</a> <span--}}
        {{--class="text-category">Business card</span></div>--}}
        {{--<div class="label-bg"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="portfolio logo" data-cat="logo">--}}
        {{--<div class="portfolio-wrapper"><img src="img/portfolios/logo/2.jpg" alt=""/>--}}
        {{--<div class="label">--}}
        {{--<div class="label-text"><a class="text-title">Speciallisterne</a> <span--}}
        {{--class="text-category">Logo</span></div>--}}
        {{--<div class="label-bg"></div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        <div class="blog hom-com pad-bot-0">
            <div class="container">
                <div class="row">
                    <div class="hom1-title">
                        <h2>{{ __('label.Blog') }}</h2>
                        <div class="head-title">
                            <div class="hl-1"></div>
                            <div class="hl-2"></div>
                            <div class="hl-3"></div>
                        </div>
                        <p>{{ __('messages.Home_posts') }}</p>
                    </div>
                </div>
                <div class="row">
                    <div>
                        @foreach ($posts as $post)
                            <div class="col-md-3 n2-event">
                                <div class="n21-event hovereffect">
                                    <img src="{{ asset(config('common.uploads.posts')) }}/{{ $post->image }}" alt="" style="height: 200px; object-fit: cover ">
                                    <div class="overlay">
                                        <a href="{{ route('post.detail', $post->id) }}">
                                            <span class="ev-book">Xem ngay</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="n22-event">
                                    <a href="{{ route('post.detail', $post->id) }}">
                                        <h4>{{ $post->title }}</h4>
                                    </a>
                                    <p>{{ $post->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="blog hom-com">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="bot-gal h-gal">
                            <h4>Thư viện ảnh</h4>
                            <ul>
                                @foreach($libraries as $library)
                                    <li>
                                        <img class="materialboxed"
                                             src="{{ config('common.uploads.libraries') }}/{{ $library->name }}"
                                             alt="" style="height: 130px; object-fit: cover">
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bot-gal h-vid">
                            <h4>Video</h4>
                            <iframe width="560" src="https://www.youtube.com/embed/yQ9Cj7HWV9I"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            <h5>{{ __('label.video_home') }}</h5>
                        </div>
                    </div>
                    {{--<div class="col-md-6">--}}
                    {{--<div class="bot-gal h-blog">--}}
                    {{--<h4>Tin tức và sự kiện</h4>--}}
                    {{--<ul>--}}
                    {{--@foreach ($posts as $post)--}}
                    {{--<li>--}}
                    {{--<a href="#!"> <img src="images/users/2.png" alt="">--}}
                    {{--<h5>{{ $post->title }}</h5>--}}
                    {{--<span>{{ formatDate($post->created_at) }}</span>--}}
                    {{--<p>{{ $post->description }}</p>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--@endforeach--}}
                    {{--</ul>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>

    </div>
@endsection
