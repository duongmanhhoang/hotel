@extends('client.layouts.master')
@section('content')
    <div class="inn-body-section inn-detail">
        <div class="container">
            <div class="row">
                <div class="inn-bod">
                    <div class="inn-detail-p1 inn-com">
                        <h2>{{ $roomDetail->name }}</h2>
                        <div class="r2-ratt">
                            @for ($i = 0; $i < $stars; $i++)
                                <i class="fa fa-star"></i>
                            @endfor
                            @for ($i = 0; $i < $whiteStars; $i++)
                                <i class="fa fa-star-o"></i>
                            @endfor
                            <span>{{ $stars }} / 5</span></div>
                        {!! $roomDetail->description !!}
                    </div>
                    <div class="inn-detail-p1 inn-com inn-com-list-point">
                        <div class="detail-title">
                            <h2>{{ __('label.Convenient') }}</h2>
                        </div>
                        <ul>
                            @foreach ($properties as $property)
                                <li><i class="fa fa-check" aria-hidden="true"></i> {{ $property->name    }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="inn-detail-p1 inn-com inn-com-form">
                        <div class="detail-title">
                            <h2>Đặt phòng ngay!</h2>
                            <p>Master Room được thiết kế với không gian sang trọng, dẫn đầu về mức độ tiện nghi hiện
                                đại, dễ dàng sử dụng, đem lại cảm giác thư giãn nhất cho khách hàng.</p>
                        </div>
                        <form class="col s12">
                            <div class="row">
                                <div class="input-field col s6">
                                    <input type="text" class="validate">
                                    <label>First Name</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" class="validate">
                                    <label>Last Name</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input type="text" class="validate">
                                    <label>Phone</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" class="validate">
                                    <label>Email</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input type="text" class="validate">
                                    <label>Check In</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" class="validate">
                                    <label>Check Out</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input type="text" class="validate">
                                    <label>Adults</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" class="validate">
                                    <label>Childrens</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea id="textarea1" class="materialize-textarea"></textarea>
                                    <label for="textarea1">Textarea</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input type="submit" value="submit" class="waves-effect waves-light full-btn"></div>
                            </div>
                        </form>
                    </div>
                    <div class="inn-detail-p1 inn-com inn-com-price">
                        <div class="detail-title">
                            <h2>Giá cho hôm nay!</h2>
                            <p>Đặt phòng ngay hôm nay để nhận được mức ưu đãi tốt nhất, đồng thời kèm theo những dịch vụ
                                hàng đầu mà Atlantic mang lại cho bạn.</p>
                        </div>
                        <h4>Giá cho 1 đêm</h4>
                        <p>Giá trên đã bao gôm VAT cùng các dịch vụ kèm theo.</p> <span>Không hoàn trả</span> <span
                                class="inn-room-price">$600</span></div>
                    <div class="inn-detail-p1 inn-com">
                        <div class="detail-title">
                            <h2>Thư viện ảnh</h2>
                            <p>Cùng ngắm nhìn căn phòng Master Room qua ống kính chân thực cùng Atlantic bạn nhé!</p>
                        </div>
                        <div class="room-photo-all">
                            <div class="col-md-3 room-photo">
                                <div class="gall-grid room-photo-gal"><img class="materialboxed" data-caption="Caption"
                                                                           src="images/room/1.jpg" alt=""/></div>
                            </div>
                            <div class="col-md-3 room-photo">
                                <div class="gall-grid room-photo-gal"><img class="materialboxed" data-caption="Caption"
                                                                           src="images/room/2.jpg" alt=""/></div>
                            </div>
                            <div class="col-md-3 room-photo">
                                <div class="gall-grid room-photo-gal"><img class="materialboxed" data-caption="Caption"
                                                                           src="images/room/3.jpg" alt=""/></div>
                            </div>
                            <div class="col-md-3 room-photo">
                                <div class="gall-grid room-photo-gal"><img class="materialboxed" data-caption="Caption"
                                                                           src="images/room/4.jpg" alt=""/></div>
                            </div>
                            <div class="col-md-3 room-photo">
                                <div class="gall-grid room-photo-gal"><img class="materialboxed" data-caption="Caption"
                                                                           src="images/room/5.jpg" alt=""/></div>
                            </div>
                            <div class="col-md-3 room-photo">
                                <div class="gall-grid room-photo-gal"><img class="materialboxed" data-caption="Caption"
                                                                           src="images/room/6.jpg" alt=""/></div>
                            </div>
                        </div>
                    </div>
                    <div class="inn-detail-p1 inn-com">
                        <div class="detail-title">
                            <h2>Phòng tương tự</h2>
                            <p>Đặt phòng ngay hôm nay để nhận được mức ưu đãi tốt nhất, đồng thời kèm theo những dịch vụ
                                hàng đầu mà Atlantic mang lại cho bạn.</p>
                        </div>
                        <div class="re-room">
                            <ul>
                                <li>
                                    <div class="re-room-list">
                                        <div class="col-md-3 re-room-list-1"><img src="images/room/1.jpg" alt=""></div>
                                        <div class="col-md-6 re-room-list-2">
                                            <h4>Normal Rooms</h4>
                                            <p><b>Dịch vụ: </b>TTelevision, Wi-Fi, Hair dryer, Towels, Dining, Music,
                                                GYM and more. </p> <span><b>Includes</b> : Free Parking, Breakfast, VAT</span>
                                            <span><b>Maxinum </b> : 4 Persons</span></div>
                                        <div class="col-md-3 re-room-list-3"><span
                                                    class="hot-list-p3-1">Giá cho 1 đêm</span> <span
                                                    class="hot-list-p3-2">$940</span> <a href="booking.html"
                                                                                         class="hot-page2-alp-quot-btn spec-btn-text">Book
                                                Now</a></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="re-room-list">
                                        <div class="col-md-3 re-room-list-1"><img src="images/room/2.jpg" alt=""></div>
                                        <div class="col-md-6 re-room-list-2">
                                            <h4>Normal Rooms</h4>
                                            <p><b>Dịch vụ: </b>Television, Wi-Fi, Hair dryer, Towels, Dining, Music, GYM
                                                and more.. </p>
                                            <span><b>Includes</b> : Free Parking, Breakfast, VAT</span>
                                            <span><b>Maxinum </b> : 4 Persons</span></div>
                                        <div class="col-md-3 re-room-list-3"><span
                                                    class="hot-list-p3-1">Giá cho 1 đêm</span> <span
                                                    class="hot-list-p3-2">$940</span> <a href="booking.html"
                                                                                         class="hot-page2-alp-quot-btn spec-btn-text">Book
                                                Now</a></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="re-room-list">
                                        <div class="col-md-3 re-room-list-1"><img src="images/room/3.jpg" alt=""></div>
                                        <div class="col-md-6 re-room-list-2">
                                            <h4>Normal Rooms</h4>
                                            <p><b>Dịch vụ: </b>Television, Wi-Fi, Hair dryer, Towels, Dining, Music, GYM
                                                and more.. </p>
                                            <span><b>Includes</b> : Free Parking, Breakfast, VAT</span>
                                            <span><b>Maxinum </b> : 4 Persons</span></div>
                                        <div class="col-md-3 re-room-list-3"><span
                                                    class="hot-list-p3-1">Giá cho 1 đêm</span> <span
                                                    class="hot-list-p3-2">$940</span> <a href="booking.html"
                                                                                         class="hot-page2-alp-quot-btn spec-btn-text">Book
                                                Now</a></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="re-room-list">
                                        <div class="col-md-3 re-room-list-1"><img src="images/room/4.jpg" alt=""></div>
                                        <div class="col-md-6 re-room-list-2">
                                            <h4>Normal Rooms</h4>
                                            <p><b>Dịch vụ: </b>Television, Wi-Fi, Hair dryer, Towels, Dining, Music, GYM
                                                and more.. </p>
                                            <span><b>Includes</b> : Free Parking, Breakfast, VAT</span>
                                            <span><b>Maxinum </b> : 4 Persons</span></div>
                                        <div class="col-md-3 re-room-list-3"><span
                                                    class="hot-list-p3-1">Giá cho 1 đêm</span> <span
                                                    class="hot-list-p3-2">$940</span> <a href="booking.html"
                                                                                         class="hot-page2-alp-quot-btn spec-btn-text">Book
                                                Now</a></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="inn-detail-p1 inn-com">
                        <div class="detail-title">
                            <h2>Đánh giá của khách hàng...</h2>
                            <p>Hãy xem khách hàng nói gì về phòng của Atlantic...!</p>
                        </div>
                        <div class="room-rat-inn room-rat-bor">
                            <div class="row">
                                <div class="col-md-12 room-rat-body">
                                    <div class="room-rat-img"><img src="images/users/100.png" alt="">
                                        <p>Trần Dần<span>19th January, 2019</span></p>
                                    </div>
                                    <div class="dir-rat-star"><i class="fa fa-star" aria-hidden="true"></i><i
                                                class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star"
                                                                                             aria-hidden="true"></i><i
                                                class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o"
                                                                                             aria-hidden="true"></i>
                                    </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen
                                        book.</p>
                                    <ul>
                                        <li><a href="#"><span>Like</span><i class="fa fa-thumbs-o-up"></i></a></li>
                                        <li><a href="#"><span>Dis-Like</span><i class="fa fa-thumbs-o-down"></i></a>
                                        </li>
                                        <li><a href="#"><span>Report</span> <i class="fa fa-flag-o"></i></a></li>
                                        <li><a href="#"><span>Comments</span> <i class="fa fa-commenting-o"></i></a>
                                        </li>
                                        <li><a href="#"><span>Share Now</span> <i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="room-rat-inn room-rat-bor">
                            <div class="row">
                                <div class="col-md-12 room-rat-body">
                                    <div class="room-rat-img"><img src="images/users/100.png" alt="">
                                        <p>Trần Dần<span>19th January, 2019</span></p>
                                    </div>
                                    <div class="dir-rat-star"><i class="fa fa-star" aria-hidden="true"></i><i
                                                class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star"
                                                                                             aria-hidden="true"></i><i
                                                class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o"
                                                                                             aria-hidden="true"></i>
                                    </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen
                                        book.</p>
                                    <ul>
                                        <li><a href="#"><span>Like</span><i class="fa fa-thumbs-o-up"></i></a></li>
                                        <li><a href="#"><span>Dis-Like</span><i class="fa fa-thumbs-o-down"></i></a>
                                        </li>
                                        <li><a href="#"><span>Report</span> <i class="fa fa-flag-o"></i></a></li>
                                        <li><a href="#"><span>Comments</span> <i class="fa fa-commenting-o"></i></a>
                                        </li>
                                        <li><a href="#"><span>Share Now</span> <i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="room-rat-inn room-rat-bor">
                            <div class="row">
                                <div class="col-md-12 room-rat-body">
                                    <div class="room-rat-img"><img src="images/users/100.png" alt="">
                                        <p>Trần Dần<span>19th January, 2019</span></p>
                                    </div>
                                    <div class="dir-rat-star"><i class="fa fa-star" aria-hidden="true"></i><i
                                                class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star"
                                                                                             aria-hidden="true"></i><i
                                                class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o"
                                                                                             aria-hidden="true"></i>
                                    </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen
                                        book.</p>
                                    <ul>
                                        <li><a href="#"><span>Like</span><i class="fa fa-thumbs-o-up"></i></a></li>
                                        <li><a href="#"><span>Dis-Like</span><i class="fa fa-thumbs-o-down"></i></a>
                                        </li>
                                        <li><a href="#"><span>Report</span> <i class="fa fa-flag-o"></i></a></li>
                                        <li><a href="#"><span>Comments</span> <i class="fa fa-commenting-o"></i></a>
                                        </li>
                                        <li><a href="#"><span>Share Now</span> <i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <a class="waves-effect waves-light wr-re-btn" href="%21.html#" data-toggle="modal"
                           data-target="#commend"><i class="fa fa-edit"></i> Write Review</a>
                    </div>
                    <div class="inn-detail-p1 inn-com room-soc-share">
                        <div class="detail-title">
                            <h2>Chia sẻ phòng</h2>
                            <p>Chia sẻ phòng Atlantic tới mọi người xung quanh bạn để mọi người đều có cơ hội có một kì
                                nghỉ tuyệt vời nào!</p>
                        </div>
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a></li>
                            <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i> Google+</a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i> LinkedIn</a>
                            </li>
                            <li><a href="#"><i class="fa fa-whatsapp" aria-hidden="true"></i> Whats App</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hom-footer-section">
        <div class="container">
            <div class="row">
                <div class="foot-com foot-1">
                    <ul>
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="foot-com foot-2">
                    <h5>Phone: (+84) 376 594 637</h5></div>
                <div class="foot-com foot-3">
                    <!--<a class="waves-effect waves-light" href="#">online room booking</a>--><a
                            class="waves-effect waves-light" href="booking.html">Đặt phòng ngay!</a></div>
                <div class="foot-com foot-4">
                    <a href="#"><img src="images/card.png" alt=""/>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <section>
        <div id="commend" class="modal fade" role="dialog">
            <div class="log-in-pop">
                <div class="log-in-pop-left">
                    <h1>Hello... <span></span></h1>
                    <p>Bình luận</p>
                    <h4>Atlantic Hotel</h4>
                    <img style="width: 101%;
                    border-radius: 5px;
                    opacity: 0.6" src="images/about.jpg">
                </div>
                <div class="log-in-pop-right">
                    <a href="#" class="pop-close" data-dismiss="modal"><img src="images/cancel.png" alt=""/>
                    </a>
                    <h4>Atlantic - đánh giá bình luận</h4>
                    <p>Hãy cho chúng tôi biết đánh giá của bạn!</p>
                    <form class="s12" id="ratingsForm">
                        <div>
                            <div class="input-field s12">
                                <input type="text" data-ng-model="name1" class="validate">
                                <label>User name</label>
                            </div>
                        </div>
                        <div>
                            <div class="input-field s12">
                                <input type="email" class="validate">
                                <label>Email id</label>
                            </div>
                        </div>
                        <div>
                            <div class="input-field s12">
                                <textarea class="materialize-textarea"></textarea>
                                <label>Type your commends</label>
                            </div>
                        </div>
                        <div class="stars">
                            <input type="radio" name="star" class="star-1" id="star-1"/>
                            <label class="star-1" for="star-1">1</label>
                            <input type="radio" name="star" class="star-2" id="star-2"/>
                            <label class="star-2" for="star-2">2</label>
                            <input type="radio" name="star" class="star-3" id="star-3"/>
                            <label class="star-3" for="star-3">3</label>
                            <input type="radio" name="star" class="star-4" id="star-4"/>
                            <label class="star-4" for="star-4">4</label>
                            <input type="radio" name="star" class="star-5" id="star-5"/>
                            <label class="star-5" for="star-5">5</label> <span></span></div>
                        <div>
                            <div class="input-field s4">
                                <input type="submit" value="Submit Your Review"
                                       class="waves-effect waves-light log-in-btn"></div>
                        </div>
                        <div>
                            <div class="input-field s12"><a href="#" data-dismiss="modal" data-toggle="modal"
                                                            data-target="#modal1">Bạn đã có tài khoản ? Đăng nhập</a>
                            </div>
                        </div>
                    </form>
                    <div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection