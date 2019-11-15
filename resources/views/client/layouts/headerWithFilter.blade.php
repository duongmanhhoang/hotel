<div class="hp-banner">
    <img src="{{ $headerImage }}" alt="" style="height: 500px; object-fit: cover">
</div>
<div class="check-available">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="inn-com-form">
                    <form class="col s12" method="get" action="{{ route('rooms.search') }}">
                        <div class="row">
                            <div class="col s12 avail-title">
                                <h4>{{ __('label.Check_availability') }}</h4></div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m4 l2">
                                <select name="location_id">
                                    <option value="" disabled selected>{{ __('label.Select_location') }}</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('location_id'))
                                    <p class="text-danger">{{ $errors->first('location_id') }}</p>
                                @endif
                            </div>
                            <div class="input-field col s12 m4 l2">
                                <select name="adults">
                                    <option value="" disabled selected>{{ __('label.No_adults') }}</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                @if ($errors->has('adults'))
                                    <p class="text-danger">{{ $errors->first('adults') }}</p>
                                @endif
                            </div>
                            <div class="input-field col s12 m4 l2">
                                <select name="children">
                                    <option value="" disabled selected>{{ __('label.No_children') }}</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                @if ($errors->has('children'))
                                    <p class="text-danger">{{ $errors->first('children') }}</p>
                                @endif
                            </div>
                            <div class="input-field col s12 m4 l2">
                                <input type="text" id="from" name="checkIn" autocomplete="off">
                                <label for="checkin">{{ __('label.Check_in') }}</label>
                                @if ($errors->has('checkIn'))
                                    <p class="text-danger">{{ $errors->first('checkIn') }}</p>
                                @endif
                            </div>
                            <div class="input-field col s12 m4 l2">
                                <input type="text" id="to" name="checkOut" autocomplete="off">
                                <label for="checkout">{{ __('label.Check_out') }}</label>
                                @if ($errors->has('checkOut'))
                                    <p class="text-danger">{{ $errors->first('checkOut') }}</p>
                                @endif
                            </div>
                            <div class="input-field col s12 m4 l2">
                                <input type="submit" value="{{ __('label.Search') }}" class="form-btn"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
