@extends('client.layouts.master')
@section('content')
    <div>
        <div class="slider fullscreen">
            <div class="inn-body-section inn-booking">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="book-title">
                                <h2>Check Availability</h2>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen book.
                                    It has survived not only five centuries. </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="book-form inn-com-form">
                                <form class="col s12">
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <select name="status" id="selectedTest">
                                                <option value="" disabled selected>No of adults</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="1">4</option>
                                            </select>
                                        </div>
                                        <div class="input-field col s6">
                                            <select name="status" id="selectedTest">
                                                <option value="" disabled selected>No of childrens</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="1">4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <input type="text" id="from" name="from">
                                            <label for="from">Check In</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input type="text" id="to" name="to">
                                            <label for="to">Check Out</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <select>
                                                <option value="" disabled selected>Chọn sơ sở</option>
                                                <option value="1">Hà Nội</option>
                                                <option value="2">TP Hồ Chí Minh</option>
                                                <option value="3">Đà Nẵng</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input type="submit" value="SREACH" class="form-btn"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hom1 hom-com pad-bot-40">
                <div class="container">
                    <div class="row">
                        <div class="hom1-title">
                            <h2>Our Hotel Rooms</h2>
                            <div class="head-title">
                                <div class="hl-1"></div>
                                <div class="hl-2"></div>
                                <div class="hl-3"></div>
                            </div>
                            <p>Atlantic bao gồm hệ thống phòng tiện nghi, hiện đại luôn đem tới cho khách hàng trải
                                nghiệm tốt nhất</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="to-ho-hotel">
                            @foreach ($locations as $location)
                                @foreach ($location->rooms as $room)
                                    @if ($room->roomDetails->toArray())
                                        @php
                                            $stars = round((int)$room->rating);
                                            $whiteStars = 5 - (int)$room->rating;
                                        @endphp
                                        <div class="col-md-4">
                                            <div class="to-ho-hotel-con">
                                                <div class="to-ho-hotel-con-1">
                                                    <img src="{{ asset(config('common.uploads.rooms') . '/' . $room->image) }}"
                                                         style="height: 250px; object-fit: cover"></div>
                                                <div class="to-ho-hotel-con-23">
                                                    <div class="to-ho-hotel-con-2">
                                                        <a href="all-rooms.html">
                                                            <h4>{{ $baseLang == session('locale') ? $room->roomName->name : $roomNameRepository->findRoomName($room->room_name_id)->name }}</h4>
                                                        </a></div>
                                                    <div class="to-ho-hotel-con-3">
                                                        <ul>
                                                            <li>{{ __('label.Destination') }}
                                                                : {{ $baseLang == session('locale') ? $location->name : $location->locations->where('lang_id', session('locale'))->first()->name }}
                                                                <div class="dir-rat-star ho-hot-rat-star"> {{ __('label.Rating') }}
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
                                                                    <span class="ho-hot-pri-dis">{{ number_format($room->roomDetails[0]->price) }} {{ $baseLang == session('locale') ? 'đ' : '$' }}</span>
                                                                    <span style="font-size: 30px"
                                                                          class="ho-hot-pri">{{ number_format($room->roomDetails[0]->sale_price) }} {{ $baseLang == session('locale') ? 'đ' : '$' }}</span>
                                                                </li>
                                                            @else
                                                                <li>
                                                                    <span style="font-size: 30px"
                                                                          class="ho-hot-pri">{{ number_format($room->roomDetails[0]->price) }} {{ $baseLang == session('locale') ? 'đ' : '$' }}</span>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
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
                                            class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                <span class="ol-4">Ưu đãi cực lớn cho Omega Room</span> <span class="ol-3"></span> <span
                                        class="ol-5">$99/-</span>
                                <ul>
                                    <li>
                                        <a href="#!" class="waves-effect waves-light btn-large offer-btn"><img
                                                    src="images/icon/dis1.png" alt="">
                                        </a><span>Free WiFi</span>
                                    </li>
                                    <li>
                                        <a href="#!" class="waves-effect waves-light btn-large offer-btn"><img
                                                    src="images/icon/h2.png" alt=""> </a><span>Breakfast</span>
                                    </li>
                                    <li>
                                        <a href="#!" class="waves-effect waves-light btn-large offer-btn"><img
                                                    src="images/icon/dis3.png" alt=""> </a><span>Pool</span>
                                    </li>
                                    <li>
                                        <a href="#!" class="waves-effect waves-light btn-large offer-btn"><img
                                                    src="images/icon/dis4.png" alt=""> </a><span>Television</span>
                                    </li>
                                    <li>
                                        <a href="#!" class="waves-effect waves-light btn-large offer-btn"><img
                                                    src="images/icon/dis5.png" alt=""> </a><span>GYM</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="offer-r">
                                <div class="or-1"><span class="or-11">go</span> <span class="or-12">Stays</span></div>
                                <div class="or-2"><span class="or-21">Giảm tới</span> <span class="or-22">70%</span>
                                    <span class="or-23">Off</span> <span class="or-24">use code: RG5481WERQ</span> <span
                                            class="or-25"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="blog hom-com pad-bot-0">
                <div class="container">
                    <div class="row">
                        <div class="hom1-title">
                            <h2>Photo Gallery</h2>
                            <div class="head-title">
                                <div class="hl-1"></div>
                                <div class="hl-2"></div>
                                <div class="hl-3"></div>
                            </div>
                            <p>Cùng Atlantic chia sẻ những bức hình tuyệt nhất bạn nhé</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="inn-services head-typo typo-com mar-bot-0">
                                <ul id="filters" class="clearfix">
                                    <li><span class="filter active"
                                              data-filter=".app, .card, .icon, .logo, .web">Tất cả</span>
                                    </li>
                                    <li><span class="filter" data-filter=".app">Khách sạn</span>
                                    </li>
                                    <li><span class="filter" data-filter=".card">Tiện nghi</span>
                                    </li>
                                    <li><span class="filter" data-filter=".icon">Phòng</span>
                                    </li>
                                    <li><span class="filter" data-filter=".logo">Ẩm thực</span>
                                    </li>
                                    <li><span class="filter" data-filter=".web">Sự kiện</span>
                                    </li>
                                </ul>
                                <div id="portfoliolist">
                                    <div class="portfolio logo" data-cat="logo">
                                        <div class="portfolio-wrapper"><img src="img/portfolios/logo/5.jpg" alt=""/>
                                            <div class="label">
                                                <div class="label-text"><a class="text-title">Photo Caption</a> <span
                                                            class="text-category">Logo</span></div>
                                                <div class="label-bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio app" data-cat="app">
                                        <div class="portfolio-wrapper"><img src="img/portfolios/app/1.jpg" alt=""/>
                                            <div class="label">
                                                <div class="label-text"><a class="text-title">Photo Caption</a> <span
                                                            class="text-category">APP</span></div>
                                                <div class="label-bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio web" data-cat="web">
                                        <div class="portfolio-wrapper"><img src="img/portfolios/web/4.jpg" alt=""/>
                                            <div class="label">
                                                <div class="label-text"><a class="text-title">Photo Caption</a> <span
                                                            class="text-category">Web design</span></div>
                                                <div class="label-bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio card" data-cat="card">
                                        <div class="portfolio-wrapper"><img src="img/portfolios/card/1.jpg" alt=""/>
                                            <div class="label">
                                                <div class="label-text"><a class="text-title">Photo Caption</a> <span
                                                            class="text-category">Business card</span></div>
                                                <div class="label-bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio app" data-cat="app">
                                        <div class="portfolio-wrapper"><img src="img/portfolios/app/3.jpg" alt=""/>
                                            <div class="label">
                                                <div class="label-text"><a class="text-title">Photo Caption</a> <span
                                                            class="text-category">APP</span></div>
                                                <div class="label-bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio card" data-cat="card">
                                        <div class="portfolio-wrapper"><img src="img/portfolios/card/4.jpg" alt=""/>
                                            <div class="label">
                                                <div class="label-text"><a class="text-title">Photo Caption</a> <span
                                                            class="text-category">Business card</span></div>
                                                <div class="label-bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio card" data-cat="card">
                                        <div class="portfolio-wrapper"><img src="img/portfolios/card/5.jpg" alt=""/>
                                            <div class="label">
                                                <div class="label-text"><a class="text-title">Photo Caption</a> <span
                                                            class="text-category">Business card</span></div>
                                                <div class="label-bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio logo" data-cat="logo">
                                        <div class="portfolio-wrapper"><img src="img/portfolios/logo/1.jpg" alt=""/>
                                            <div class="label">
                                                <div class="label-text"><a class="text-title">Photo Caption</a> <span
                                                            class="text-category">Logo</span></div>
                                                <div class="label-bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio app" data-cat="app">
                                        <div class="portfolio-wrapper"><img src="img/portfolios/app/2.jpg" alt=""/>
                                            <div class="label">
                                                <div class="label-text"><a class="text-title">Photo Caption</a> <span
                                                            class="text-category">APP</span></div>
                                                <div class="label-bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio card" data-cat="card">
                                        <div class="portfolio-wrapper"><img src="img/portfolios/card/2.jpg" alt=""/>
                                            <div class="label">
                                                <div class="label-text"><a class="text-title">Photo Caption</a> <span
                                                            class="text-category">Business card</span></div>
                                                <div class="label-bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio logo" data-cat="logo">
                                        <div class="portfolio-wrapper"><img src="img/portfolios/logo/6.jpg" alt=""/>
                                            <div class="label">
                                                <div class="label-text"><a class="text-title">Photo Caption</a> <span
                                                            class="text-category">Logo</span></div>
                                                <div class="label-bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio logo" data-cat="logo">
                                        <div class="portfolio-wrapper"><img src="img/portfolios/logo/7.jpg" alt=""/>
                                            <div class="label">
                                                <div class="label-text"><a class="text-title">Photo Caption</a> <span
                                                            class="text-category">Logo</span></div>
                                                <div class="label-bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio icon" data-cat="icon">
                                        <div class="portfolio-wrapper"><img src="img/portfolios/icon/4.jpg" alt=""/>
                                            <div class="label">
                                                <div class="label-text"><a class="text-title">Photo Caption</a> <span
                                                            class="text-category">Icon</span></div>
                                                <div class="label-bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio web" data-cat="web">
                                        <div class="portfolio-wrapper"><img src="img/portfolios/web/3.jpg" alt=""/>
                                            <div class="label">
                                                <div class="label-text"><a class="text-title">Photo Caption</a> <span
                                                            class="text-category">Web design</span></div>
                                                <div class="label-bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio icon" data-cat="icon">
                                        <div class="portfolio-wrapper"><img src="img/portfolios/icon/1.jpg" alt=""/>
                                            <div class="label">
                                                <div class="label-text"><a class="text-title">Photo Caption</a> <span
                                                            class="text-category">Icon</span></div>
                                                <div class="label-bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio web" data-cat="web">
                                        <div class="portfolio-wrapper"><img src="img/portfolios/web/2.jpg" alt=""/>
                                            <div class="label">
                                                <div class="label-text"><a class="text-title">Photo Caption</a> <span
                                                            class="text-category">Web design</span></div>
                                                <div class="label-bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio icon" data-cat="icon">
                                        <div class="portfolio-wrapper"><img src="img/portfolios/icon/2.jpg" alt=""/>
                                            <div class="label">
                                                <div class="label-text"><a class="text-title">Photo Caption</a> <span
                                                            class="text-category">Icon</span></div>
                                                <div class="label-bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio icon" data-cat="icon">
                                        <div class="portfolio-wrapper"><img src="img/portfolios/icon/5.jpg" alt=""/>
                                            <div class="label">
                                                <div class="label-text"><a class="text-title">3D Map</a> <span
                                                            class="text-category">Icon</span></div>
                                                <div class="label-bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio web" data-cat="web">
                                        <div class="portfolio-wrapper"><img src="img/portfolios/web/1.jpg" alt=""/>
                                            <div class="label">
                                                <div class="label-text"><a class="text-title">Note</a> <span
                                                            class="text-category">Web design</span></div>
                                                <div class="label-bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio logo" data-cat="logo">
                                        <div class="portfolio-wrapper"><img src="img/portfolios/logo/3.jpg" alt=""/>
                                            <div class="label">
                                                <div class="label-text"><a class="text-title">Native Designers</a> <span
                                                            class="text-category">Logo</span></div>
                                                <div class="label-bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio logo" data-cat="logo">
                                        <div class="portfolio-wrapper"><img src="img/portfolios/logo/4.jpg" alt=""/>
                                            <div class="label">
                                                <div class="label-text"><a class="text-title">Bookworm</a> <span
                                                            class="text-category">Logo</span></div>
                                                <div class="label-bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio icon" data-cat="icon">
                                        <div class="portfolio-wrapper"><img src="img/portfolios/icon/3.jpg" alt=""/>
                                            <div class="label">
                                                <div class="label-text"><a class="text-title">Sandwich</a> <span
                                                            class="text-category">Icon</span></div>
                                                <div class="label-bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio card" data-cat="card">
                                        <div class="portfolio-wrapper"><img src="img/portfolios/card/3.jpg" alt=""/>
                                            <div class="label">
                                                <div class="label-text"><a class="text-title">Reality</a> <span
                                                            class="text-category">Business card</span></div>
                                                <div class="label-bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio logo" data-cat="logo">
                                        <div class="portfolio-wrapper"><img src="img/portfolios/logo/2.jpg" alt=""/>
                                            <div class="label">
                                                <div class="label-text"><a class="text-title">Speciallisterne</a> <span
                                                            class="text-category">Logo</span></div>
                                                <div class="label-bg"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blog hom-com pad-bot-0">
                <div class="container">
                    <div class="row">
                        <div class="hom1-title">
                            <h2>Tin tức và sự kiện</h2>
                            <div class="head-title">
                                <div class="hl-1"></div>
                                <div class="hl-2"></div>
                                <div class="hl-3"></div>
                            </div>
                            <p>Đọc và đón chờ những tin tức mới nhất về khách sạn du lịch, và cùng săn những sự kiện cực
                                hot cùng Atlantic</p>
                        </div>
                    </div>
                    <div class="row">
                        <div>
                            @foreach ($posts as $post)
                                <div class="col-md-3 n2-event">
                                    <div class="n21-event hovereffect">
                                        <img src="{{ config('common.uploads.posts') }}/{{ $post->image }}" alt="">
                                        <div class="overlay">
                                            <a href="booking.html">
                                                <span class="ev-book">Xem ngay</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="n22-event">
                                        <a href="#!">
                                            <h4>{{ $post->title }}</h4>
                                        </a>
                                        <p>{{ $post->description }}</p>
                                        <div class="event-share">
                                            <ul>
                                                <li><a href="#"><i class="fa fa-facebook"></i></a>
                                                </li>
                                                <li><a href="#"><i class="fa fa-google-plus"></i></a>
                                                </li>
                                                <li><a href="#"><i class="fa fa-twitter"></i></a>
                                                </li>
                                                <li><a href="#"><i class="fa fa-linkedin"></i></a>
                                                </li>
                                            </ul>
                                        </div>
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
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/9nOYbcCuktU"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                <h5>Cùng Sam Newton Media khám phá thế giới!</h5>
                                <p>Sam Newton Media cùng Atlantic Hotel đã hợp tác cho chuyến du lịch của anh chàng 27
                                    tuổi Sam vòng quanh Châu Á kéo dài 29 ngày</p>
                                <p>Hãy khám phá ngay cùng Sam và Atlantic Hotel để xem Châu Á có gì đặc biệt, về văn hóa
                                    sự kiện và con người Châu Á nhé! </p>
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
@endsection
