<footer class="site-footer clearfix">
    <div class="sidebar-container">
        <div class="sidebar-inner">
            <div class="widget-area clearfix">
                <div class="widget widget_azh_widget">
                    <div>
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12 col-md-3 foot-logo"><img
                                            src="{{ asset(config('common.uploads.logo')) . '/' . $inforWeb->logo_footer }}"
                                            alt="logo">
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <h4>Các cơ sở</h4>
                                    <ul class="one-columns">
                                        @foreach ( $locations as $location )
                                            <li>
                                                {{ $location->address }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <h4>Thông tin liên lạc</h4>
                                    <ul class="one-columns">
                                        @foreach ( $locations as $location )
                                            <li>
                                                {{ $location->phone }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <h4>Địa chỉ</h4>
                                    <p>Số 7 Đại Cồ Việt, Hà Nội, Việt Nam</p>
                                    <p><span class="foot-phone">Phone: </span> <span
                                                class="foot-phone">+84 376 594 637</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="foot-sec2">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12 col-md-3">
                                    <h4>Phương thức thanh toán</h4>
                                    <p class="hasimg"><img
                                                src="{{ asset('/bower_components/client_layout/images/payment.png') }}"
                                                alt="payment"></p>
                                </div>
                                <div class="col-sm-12 col-md-4 foot-social">
                                    <h4>Theo dõi chúng tôi</h4>
                                    <p>Theo dỗi Atlantic để đón chờ những thông tin cũng những ưu đãi tốt nhất</p>
                                    <ul>
                                        <li><a href="{{ $inforWeb->facebook }}"><i class="fa fa-facebook"
                                                                                   aria-hidden="true"></i></a></li>
                                        <li><a href="{{ $inforWeb->google_plus }}"><i class="fa fa-google-plus"
                                                                                      aria-hidden="true"></i></a></li>
                                        <li><a href="{{ $inforWeb->twitter }}"><i class="fa fa-twitter"
                                                                                  aria-hidden="true"></i></a></li>
                                        <li><a href="{{ $inforWeb->linkedin }}"><i class="fa fa-linkedin"
                                                                                   aria-hidden="true"></i></a></li>
                                        <li><a href="{{ $inforWeb->youtube }}"><i class="fa fa-youtube"
                                                                                  aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-12 col-md-5 ">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<section class="copy">
    <div class="container">
        <p>copyrights © 2019 Atlantic. &nbsp;&nbsp;All rights reserved. </p>
    </div>
</section>
	