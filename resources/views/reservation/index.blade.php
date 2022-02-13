@extends('layouts.app-master')

@section('content')

<section class="vh-100" style="background-color: #9A616D;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
           
            <div class="col-md-12 col-lg-12 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                 <form method="post" action="{{ route('reservation.book') }}">

                  
                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Book your ticket</h5>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <input type="hidden" name="reserve_date"  value="{{ date('Y-m-d') }}">
                  <input type="hidden" name="user_id"  value="{{ auth()->user()->id }}">
                  <input type="hidden" name="appbaseurl"  value="{{ url('/') }}">
                  @include('layouts.partials.messages')

                  <div class="row">
                    <div class="col-md-4">
                    <div class="form-outline mb-4">

                      <label class="form-label" for="email">Travel Date</label>
                      <input type="text" class="form-control form-control-lg" name="travel_date" id="traveldate" value="{{ old('travel_date') }}" autocomplete="off" readonly>
                      @if ($errors->has('travel_date'))
                          <span class="text-danger text-left">{{ $errors->first('travel_date') }}</span>
                      @endif 
                    </div>
                  </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-outline mb-4">

                        <label class="form-label" for="email">Start Location</label>
                        <select  class="form-control form-control-lg" name="start_location" id="startlocation">
                          <option value="">- Select Location -</option>
                          @foreach ($cities as $city)
                          <option value="{{$city['id']}}" @if(old('start_location')==$city['id']) selected="selected" @endif>{{$city['city_name']}}</option>
                          @endforeach
                        </select>

                        @if ($errors->has('start_location'))
                            <span class="text-danger text-left">{{ $errors->first('start_location') }}</span>
                        @endif 
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-outline mb-4">

                        <label class="form-label" for="email">End Location</label>
                        <select  class="form-control form-control-lg" name="end_location" id="endlocation">
                          <option value="">- Select Location -</option>
                          @foreach ($cities as $city)
                          <option value="{{$city['id']}}" @if(old('start_location')==$city['id']) selected="selected" @endif>{{$city['city_name']}}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('end_location'))
                            <span class="text-danger text-left">{{ $errors->first('end_location') }}</span>
                        @endif 
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-outline mb-4">

                        <label class="form-label" for="email">Vehicle</label>
                        <select  class="form-control form-control-lg" name="vehicle_no" id="vehicleno">
                          <option value="">- Select Vehicle -</option>
                          @foreach ($buses as $bus)
                          <option value="{{$bus['id']}}" @if(old('start_location')==$city['id']) selected="selected" @endif>{{$bus['bus_name']}} - {{$bus['bus_no']}}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('vehicle_no'))
                            <span class="text-danger text-left">{{ $errors->first('vehicle_no') }}</span>
                        @endif 
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-outline mb-4">

                        <label class="form-label" for="email">Seat no.</label>
                        <input type="text" class="form-control form-control-lg" name="seat_no" id="seatno" readonly value="{{ old('seat_no') }}" onkeypress="return isNumberKey(event)">
                        @if ($errors->has('seat_no'))
                            <span class="text-danger text-left">{{ $errors->first('seat_no') }}</span>
                        @endif 
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-outline mb-4">

                        <label class="form-label" for="email">Name</label>
                        <input type="text" class="form-control form-control-lg" name="name" id="name" value="{{ old('name') }}" onkeypress="return isTextKeySpace(event)">
                        @if ($errors->has('name'))
                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                        @endif 
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-outline mb-4">

                        <label class="form-label" for="email">NIC</label>
                        <input type="text" class="form-control form-control-lg" name="nic" id="nic" value="{{ old('nic') }}" onkeypress="return isNIC(event)">
                        @if ($errors->has('nic'))
                            <span class="text-danger text-left">{{ $errors->first('nic') }}</span>
                        @endif 
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-outline mb-4">

                        <label class="form-label" for="email">Contact no.</label>
                        <input type="text" class="form-control form-control-lg" name="contact_no" id="contactno" value="{{ old('contact_no') }}" onkeypress="return isNumberKey(event)">
                        @if ($errors->has('contact_no'))
                            <span class="text-danger text-left">{{ $errors->first('contact_no') }}</span>
                        @endif 
                      </div>
                    </div>

                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit">Book Now</button>
                  </div>
                  @include('auth.partials.copy')
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div id="seatModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select your prefered seat no.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="radio-toolbar" id="seatinfo">
            
      </div>
    </div>
  </div>
</div>

@endsection