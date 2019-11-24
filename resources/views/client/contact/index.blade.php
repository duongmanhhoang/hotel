@extends('client.layouts.master')
@section('content')
    <div class="inn-banner">
        <div class="container">
            <div class="row">
                <h4>{{ __('label.contact.contact_with') }} Atlantic</h4>
                <p>{{ __('label.contact.contact_title_desc') }}</p>
                <p></p>
            </div>
        </div>
    </div>
    <div class="inn-body-section" style="padding-bottom: 0px;">
        <div class="container">
            <div class="row">
                <div class="inn-body-section" style="padding-bottom: 0px;">
                    <div class="container">
                        <div class="row">
                            <div class="page-head">
                                <h2 id="text-head2">{{ __('label.contact.title') }}</h2>
                                <div class="head-title">
                                    <div class="hl-1"></div>
                                    <div class="hl-2"></div>
                                    <div class="hl-3"></div>
                                </div>
                                <p>{{ __('label.contact.title_intro') }}</p>
                            </div>
                        </div>
                        <div id="page-store">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="about-left">
                                        <h2>{{ __('label.contact.we_are') }} <span>Atlantic</span></h2>
                                        <div class="head-typo typo-com collap-expand book-form inn-com-form">
                                            <h4>{{ __('label.contact.system') }}</h4>
                                            <p>{{ __('label.contact.contact_desc') }}</p>
                                            <form class="col s12">
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <div class="home-map-list">
                                                            <div class="home-map-header">
                                                                <div class="home-map-search">
                                                                    <div class="home-map-list">
                                                                        <div class="home-map-header">
                                                                            <p class="map-title"><i
                                                                                        class="fas fa-map-marker-alt"></i>
                                                                                {{ __('label.contact.hotel_system') }}</p>
                                                                            <div class="home-map-search">
                                                                                <div class="ul-maps">
                                                                                    <ul id="country" class="no-bullets">
                                                                                        @foreach($locations as $location)
                                                                                            <li class="textmap locations"
                                                                                                onclick="selectStore({{ $location->latitude }}, {{ $location->longitude }})"
                                                                                                data-target="ha-noi"
                                                                                                locationId="{{ $location->id }}"
                                                                                            > {{ $location->name }} </li>
                                                                                        @endforeach
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
                                        <div class="home-map-view">
                                            <div id="map">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="hom-footer-section">
                                    <div class="container">
                                        <div class="row">
                                            <div class="foot-com foot-1">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-facebook"
                                                                       aria-hidden="true"></i></a>
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
                                                        class="waves-effect waves-light" href="booking.html">Đặt phòng
                                                    ngay!</a></div>
                                            <div class="foot-com foot-4">
                                                <a href="#"><img src="images/card.png" alt=""/>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="about-left center">
                            <h2>{{ __('label.contact.contact_with') }} <span>Atlantic</span></h2>
                            <div class="head-typo typo-com collap-expand book-form inn-com-form" style="height: unset">
                                <h4>{{ __('label.contact.register_email_text') }} </h4>
                                <form class="col s12" action="{{ route('contact.postContact') }}" method="post">
                                    @csrf

                                    <input type="hidden" id="location_id" name="location_id">

                                    <div class="row">
                                        <div class="input-field col s6 ">
                                            <input id="input_text"
                                                   type="text"
                                                   name="email"
                                                   value="{{ $user != null ? $user->email : '' }}"
                                                    {{ $user != null ? 'readonly' : '' }}
                                            >
                                            <label for="input_text">Email</label>
                                            @if ($errors->has('email'))
                                                <b class="text-danger">{{ $errors->first('email') }}</b>
                                            @endif
                                        </div>

                                        <div class="input-field col s6 ">
                                            <input id="input_text"
                                                   type="text"
                                                   name="name"
                                                   value="{{ $user != null ? $user->full_name : '' }}"
                                                    {{ $user != null ? 'readonly' : '' }}
                                            >
                                            <label for="input_text">{{ __('label.contact.name') }}</label>
                                            @if ($errors->has('name'))
                                                <b class="text-danger">{{ $errors->first('name') }}</b>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="input_text" type="text" name="subject">
                                            <label for="textarea1">{{ __('label.contact.subject') }}</label>
                                            @if ($errors->has('subject'))
                                                <b class="text-danger">{{ $errors->first('subject') }}</b>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s12">

                                            <select name="location_id" id="locations">
                                                <option>{{ __('label.contact.location') }}</option>

                                                @foreach($locations as $location)
                                                    <option value="{{ $location->id }}"> {{ $location->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <textarea id="textarea1" class="materialize-textarea"
                                                      name="text"></textarea>
                                            <label for="textarea1">{{ __('label.contact.text') }}</label>
                                            @if ($errors->has('text'))
                                                <b class="text-danger">{{ $errors->first('text') }}</b>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s12">
                                        <button class="btn waves-effect waves-light inn-re-mo-btn">{{ __('label.contact.submit') }}</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtqlBL2XudSG3aIwHNNkBcj37CSjrFXqc&callback=initMap&libraries=geometry,places">
            </script>
        </div>
    </div>
@endsection

@section('script')
    <script>

        let defaultLocationId = "{{ $locations[0]['id'] }}";

        let locationIdInput = $('#location_id');

        locationIdInput.attr('value', defaultLocationId);

        $('.locations').on('click', function () {

            const mapLocationId = $(this).attr('locationId');

            let selectLocation = $('#locations option');

            const locationSelected = selectLocation.filter((i, e) => {
                $(e).attr('selected', null);
                return $(e).attr('value') === mapLocationId;
            });

            locationSelected.attr('selected', 'selected');

            selectLocation.change();

            // locationIdInput.attr('value', $(this).attr('locationId'));
        })

    </script>
@endsection