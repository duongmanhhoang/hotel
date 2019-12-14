@extends('client.layouts.master')
@section('content')
    <div class="hp-banner">
        <img src="{{ asset(config('common.uploads.rooms') . '/' . $room->image) }}" alt=""
             style="height: 500px; object-fit: cover">
    </div>
    <div class="hom-com">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="hp-section">
                            <div class="hp-sub-tit">
                                <h4><span>{{ $name }}</span></h4>
                                <p>{{ $locationName }}</p>
                                <p>
                                    {{ __('label.Adults') }}: {{ $room->adults }}
                                </p>
                                <p>
                                    {{ __('label.Children') }}: {{ $room->children }}
                                </p>
                                <p>
                                    {{ $roomDetail->short_description }}
                                </p>
                            </div>
                            <div class="hp-amini">
                                {!! $roomDetail->description !!}
                            </div>
                        </div>
                        <div class="hp-section">
                            <div class="hp-sub-tit">
                                <h4><span>{{ __('label.Convenient') }}</span></h4>
                            </div>
                            <div class="hp-amini">
                                <ul>
                                    @foreach($properties as $property)
                                        <li>
                                            <img style="width: 60px; height: 60px; object-fit: cover"
                                                 src="{{ asset(config('common.uploads.properties')) . '/' . $property->image }}">
                                            {{ $property->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="hp-section">
                            <div class="hp-sub-tit">
                                <h4><span>{{ __('label.Services') }}</h4>
                            </div>
                            <div class="hp-over">
                                <ul class="nav nav-tabs hp-over-nav">
                                    @foreach($categoriesService as $key => $item)
                                        <li class="{{ $key == 0 ? 'active' : '' }}">
                                            <a data-toggle="tab" href="#{{ $item->id }}"><span
                                                    class="tab-hide">{{ $item->name }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content">
                                    @foreach($categoriesService as $key => $item)
                                        @if (session('locale') == config('common.languages.default'))
                                            @php
                                                $services = $item->services->where('lang_id', session('locale'));
                                            @endphp
                                        @else
                                            @php
                                                $parentCategory = $item->parentTranslate;
                                                $services = $parentCategory->services->where('lang_id', session('locale'));
                                            @endphp
                                        @endif
                                        <div id="{{ $item->id }}"
                                             class="tab-pane fade in {{ $key == 0 ? 'active' : '' }} tab-space">
                                            @foreach($services as $service)
                                                <div class="res-menu">
                                                    <img
                                                        src="{{ asset(config('common.uploads.services') . '/' . $service->image) }}">
                                                    <h3>{{ $service->name }}<span>{{ number_format($service->price) }}
                                                            {{ session('locale') == config('common.languages.default') ? 'vnđ' : '$' }}</span>
                                                    </h3>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="hp-section">
                            <div class="hp-sub-tit">
                                <h4>{{ __('label.Gallery') }}</h4>
                            </div>
                            <div class="">
                                <div class="h-gal" id="wrap">
                                    <ul id="slider">
                                        @foreach($images as $image)
                                            <li class="slide-item">
                                                <a data-fancybox="gallery"
                                                   href="{{ asset(config('common.uploads.libraries') . '/' . $image->name) }}"><img
                                                        src="{{ asset(config('common.uploads.libraries') . '/' . $image->name) }}"></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="hp-section">
                            <div class="hp-sub-tit">
                                <h4><span>{{ __('label.Comment') }}</h4>
                            </div>
                            <div class="hp-review">
                                <div class="hp-review-left">
                                    <a class="waves-effect waves-light wr-re-btn" href="javascript:;"
                                       data-toggle="modal"
                                       data-target="#commend"><i class="fa fa-edit"></i>{{ __('label.Write_preview') }}
                                    </a>
                                </div>
                                <div class="hp-review-right">
                                    <h5>{{ __('label.Rating') }}</h5>
                                    <p><span id="room-rating">{{ $room->rating }} <i class="fa fa-star"
                                                                                     aria-hidden="true"></i></span>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="hp-section">
                            <div class="hp-sub-tit">
                                <h4>{{ __('label.List_comment') }}</h4>
                            </div>
                            <div class="lp-ur-all-rat">
                                <ul class="list-comments">
                                    @foreach ($comments as $comment)
                                        <li>
                                            <div class="lr-user-wr-img"><img
                                                    src="{{ asset('bower_components/client_layout/images/users/100.png') }}"
                                                    alt=""></div>
                                            <div class="lr-user-wr-con">
                                                <h6>@if ($showEmail)
                                                        {{ $comment->email }}
                                                    @else
                                                        Anonymous
                                                    @endif
                                                    <span>{{ $comment->rating }} <i
                                                            class="fa fa-star"
                                                            aria-hidden="true"></i></span>
                                                </h6> <span
                                                    class="lr-revi-date">{{ formatDate($comment->created_at) }}</span>
                                                <p> {{ $comment->body }} </p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="hp-call hp-right-com">
                        <div class="hp-call-in"><img
                                src="{{ asset('bower_components/client_layout/images/icon/dbc4.png') }}" alt="">
                            <h3>{{ $location->phone }}</h3>
                            <small>{{ __('messages.24/7') }}</small>
                            <a href="javascript:;" data-toggle="modal"
                               data-target="#booking">{{ __('label.Booking') }}</a></div>
                    </div>
                    {{--<div class="hp-book hp-right-com">--}}
                        {{--<div class="hp-book-in">--}}
                            {{--<button class="like-button"><i class="fa fa-heart-o"></i> Share room</button>--}}
                            {{--<span>Atlantic Hotel</span>--}}
                            {{--<div class="sharethis-inline-share-buttons"></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
    <section>
        <div id="commend" class="modal fade" role="dialog">
            <div class="log-in-pop">
                <div class="log-in-pop-left">
                    <h1>{{ __('label.Comment') }}<span></span></h1>
                    <h4>Atlantic Hotel</h4>
                    <img style="width: 101%;
                    border-radius: 5px;
                    opacity: 0.6" src="{{ asset('bower_components/client_layout/images/about.jpg') }}">
                </div>
                <div class="log-in-pop-right">
                    <a href="#" class="pop-close" data-dismiss="modal"><img
                            src="{{ asset('bower_components/client_layout/images/cancel.png') }}" alt=""/>
                    </a>
                    <p>{{ __('content.Comment') }}</p>
                    <form class="s12" id="ratingsForm">
                        <div>
                            <div class="input-field s12">
                                <input type="text" class="validate" id="email-comment">
                                <label>Email</label>
                            </div>
                        </div>
                        <div>
                            <div class="input-field s12">
                                <textarea class="materialize-textarea" id="body-comment"></textarea>
                                <label>Type your commends</label>
                            </div>
                        </div>
                        <div class="stars">
                            <input type="radio" name="star" value="1" class="star-1" id="star-1"/>
                            <label class="star-1" for="star-1">1</label>
                            <input type="radio" name="star" value="2" class="star-2" id="star-2"/>
                            <label class="star-2" for="star-2">2</label>
                            <input type="radio" name="star" value="3" class="star-3" id="star-3"/>
                            <label class="star-3" for="star-3">3</label>
                            <input type="radio" name="star" value="4" class="star-4" id="star-4"/>
                            <label class="star-4" for="star-4">4</label>
                            <input type="radio" name="star" value="5" class="star-5" id="star-5"/>
                            <label class="star-5" for="star-5">5</label> <span></span></div>
                        <div>
                            <div class="input-field s4">
                                <input type="submit" value="{{ __('label.Submit_your_review') }}"
                                       class="waves-effect waves-light log-in-btn" id="submit-comment"></div>
                        </div>
                        <div>
                            <div class="input-field s12">
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
    <section>
        <div id="booking" class="modal fade" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('label.Choose_time') }}</h5>
                        <button style="margin-top: -20px;" type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">X</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="inn-com-form ">
                            <form class="col s12 custom-inn-com-form">
                                @csrf
                                <div class="input-field col s12 m4 l2">
                                    <input type="text" id="from" name="checkIn" class="checkInBooking"
                                        value="{{ session('checkInSearch') ? session('checkInSearch') : '' }}"
                                    >
                                    <label for="from">{{ __('label.Arrival_date') }}</label>
                                </div>
                                <div class="input-field col s12 m4 l2">
                                    <input type="text" id="to" name="checkOut" class="checkOutBooking"
                                           value="{{ session('checkOutSearch') ? session('checkOutSearch') : '' }}"
                                    >
                                    <label for="to">{{ __('label.Departure_date') }}</label>
                                </div>
                                <input type="hidden" name="roomId" value="{{ $room->id }}" class="roomIdBooking">
                                <div class="input-field col s12 m4 l2">
                                    <input type="submit" value="{{ __('label.Submit') }}"
                                           class="form-btn submit-booking">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <input type="hidden" id="comment-url" value="{{ route('rooms.comment', [$location_id, $room->id]) }}">
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.submit-booking').on('click', function (e) {
                e.preventDefault();
                const checkIn = $('.checkInBooking').val();
                const checkOut = $('.checkOutBooking').val();
                const roomId = $('.roomIdBooking').val();
                const formData = new FormData();
                formData.append('checkIn', checkIn);
                formData.append('checkOut', checkOut);
                formData.append('roomId', roomId);
                formData.append('isAjax', true);
                $.ajax({
                    contentType: false,
                    processData: false,
                    url: '{{ route('booking.redirectBooking') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    success: function (response) {
                        if (response.messages == 'validation_fail') {
                            if (response.data.checkIn) {
                                toastr.error(response.data.checkIn[0], '{{ __('messages.Warning') }}');
                            } else if (response.data.checkOut) {
                                toastr.error(response.data.checkOut[0], '{{ __('messages.Warning') }}');
                            }
                        }

                        if (response.messages == 'success') {
                            window.location.replace('{{ route('booking.index') }}');
                        }

                        if (response.messages == 'no_room') {
                            toastr.error('{{ __('messages.No_room_available') }}', '{{ __('messages.Warning') }}');
                        }

                    }, error: function () {
                        toastr.error('{{ __('messages.Something_wrong') }}', '{{ __('messages.Warning') }}');
                    },
                });
            });

            $('body').on('click', '#submit-comment', function (e) {
                e.preventDefault();
                const url = $('#comment-url').val();
                const email = $('#email-comment').val();
                const body = $('#body-comment').val();
                const rating = $("input[name=star]:checked").val();
                let formData = new FormData();
                formData.append('email', email);
                formData.append('body', body);
                formData.append('rating', rating);
                $.ajax({
                    contentType: false,
                    processData: false,
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    success: function (response) {
                        if (response.messages == 'validation_fail') {
                            console.log(response.data);
                            if (response.data.email) {
                                toastr.error(response.data.email[0], '{{ __('messages.Warning') }}');
                            } else if (response.data.body) {
                                toastr.error(response.data.body[0], '{{ __('messages.Warning') }}');
                            } else if (response.data.star[0], '{{ __('messages.Warning') }}') {
                                toastr.error(response.data.star[0], '{{ __('messages.Warning') }}');
                            }
                        }

                        if (response.messages == 'error') {
                            toastr.error('{{ __('messages.Something_wrong') }}', '{{ __('messages.Warning') }}');
                        }

                        if (response.messages == 'success') {
                            const data = response.data.comment;
                            const html = `<li>
                                            <div class="lr-user-wr-img"><img
                                                        src="{{ asset('bower_components/client_layout/images/users/100.png') }}"
                                                        alt=""></div>
                                            <div class="lr-user-wr-con">
                                                <h6>Anonymous <span>${data.rating} <i class="fa fa-star"
                                                                                          aria-hidden="true"></i></span>
                                                </h6> <span class="lr-revi-date">{{ date('dd-mm-Y') }}</span>
                                                <p> ${data.body} </p>
                                            </div>
                                        </li>`;
                            $('.list-comments').prepend(html);
                            $('#room-rating').html(`${response.data.newRating}<i class="fa fa-star" aria-hidden="true"></i>`);
                            toastr.success('{{ __('messages.Comment_success') }}', '{{ __('messages.Success') }}');
                            $("#commend").removeClass("in");
                            $(".modal-backdrop").remove();
                            $('body').removeClass('modal-open');
                            $('body').css('padding-right', '');
                            $("#commend").hide();
                        }
                    }, error: function () {
                        toastr.error('{{ __('messages.Something_wrong') }}', '{{ __('messages.Warning') }}');
                    },
                });
            });
        });
    </script>
@endsection
