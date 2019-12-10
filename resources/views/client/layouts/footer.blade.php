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
                                    <h4>{{ __('label.Destination') }}</h4>
                                    <ul class="one-columns">
                                        @foreach ( $locations as $location )
                                            <li>
                                                {{ $location->address }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <h4>{{ __('label.Contact_info') }}</h4>
                                    <ul class="one-columns">
                                        @foreach ( $locations as $location )
                                            <li>
                                                {{ $location->phone }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-sm-12 col-md-3 foot-social">
                                    <h4>{{ __('label.Follow_us') }}</h4>
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
