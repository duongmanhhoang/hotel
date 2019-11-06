@extends('client.layouts.master')
@section('content')
    <div class="inn-banner">
        <div class="container">
            <div class="row">
                <h4>Liên hệ với Atlantic</h4>
                <p>Atlantic là khách sạn hàng đầu trong ngành nghỉ dưỡng tại khu vực Asia</p>
                <p> </p>
            </div>
        </div>
    </div>
    <div class="inn-body-section" style="padding-bottom: 0px;">
        <div class="container">
            <div class="row">
                <div class="page-head">
                    <h2>Liên hệ</h2>
                    <div class="head-title">
                        <div class="hl-1"></div>
                        <div class="hl-2"></div>
                        <div class="hl-3"></div>
                    </div>
                    <p>Atlantic là khách sạn hàng đầu trong ngành nghỉ dưỡng tại khu vực Asia với hệ thống thông minh hiện đại</p>
                </div>
            </div>
            <div id="page-store">
                <div class="row">
                    <div class="col-md-6">
                        <div class="about-left">
                            <h2>Chúng tôi là <span>Atlantic</span></h2>
                            <div class="head-typo typo-com collap-expand book-form inn-com-form">
                                <h4>Hệ thống chi nhánh</h4>
                                <p>Atlantic là khách sạn chuyên cung cấp các sản phẩm, dịch vụ tốt nhất. Với hệ thống khách sạn được thiết kế hàng đầu, hệ thống showroom có mặt ở nhiều nơi, đội ngũ nhân viên tận tình, Atlantic mang đến cho khách hàng những sản phẩm và dịch vụ chuyên nghiệp nhất</p>
                                <form class="col s12">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <div  class="home-map-list">
                                                <div class="home-map-header">
                                                    <div class="home-map-search">
                                                        <div  class="home-map-list">
                                                            <div class="home-map-header">
                                                                <p class="map-title"><i class="fas fa-map-marker-alt"></i>HỆ THỐNG CƠ SỞ</p>
                                                                <div class="home-map-search">
{{--                                                                    <select name="city" id="city">--}}
{{--                                                                        <option value="ha-noi">Hà Nội</option>--}}
{{--                                                                        <option value="hcm">TP Hồ Chí Minh</option>--}}
{{--                                                                        <option value="da-nang">Đà Nẵng</option>--}}
{{--                                                                    </select>--}}
                                                                    <div class="ul-maps">
                                                                        <ul id="country" class="no-bullets">
                                                                            <li class="textmap" onclick="selectStore(21.0123923, 105.8469904)" data-target="ha-noi">Atlantic Hà Nội</li>
                                                                            <li class="textmap" onclick="selectStore(21.0323445, 105.8104005)" data-target="hcm">Atlantic Hồ Chí Minh</li>
                                                                            <li class="textmap" onclick="selectStore(21.316355, 105.3874249)" data-target="da-nang">Atlantic Đà Nẵng</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="home-map-result">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="about-right">
                            <div  class="home-map-view">
                                <div id="map">
                                </div>

                            </div>
                        </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="about-left center">
                    <h2>Liên hệ với <span>Atlantic</span></h2>
                    <div class="head-typo typo-com collap-expand book-form inn-com-form">
                        <h4>Đăng kí email để nhận tin tức mới nhất từ Atlantic</h4>
                        <form class="col s12">
                            <div class="row">
                                <div class="input-field col s6 ">
                                    <input id="input_text" type="text" >
                                    <label for="input_text">Email</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea id="textarea1" class="materialize-textarea" ></textarea>
                                    <label for="textarea1">Messenger</label>
                                </div>
                            </div>
                        </form>
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
                    <h5>Phone: (+84) 376 594 637</h5> </div>
                <div class="foot-com foot-3">
                    <!--<a class="waves-effect waves-light" href="#">online room booking</a>--><a class="waves-effect waves-light" href="booking.html">Đặt phòng ngay!</a> </div>
                <div class="foot-com foot-4">
                    <a href="#"><img src="images/card.png" alt="" />
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
