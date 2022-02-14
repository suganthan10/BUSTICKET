@extends('layouts.app-master')

@section('content')
<section class="vh-100" style="background-color: #9A616D;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
              <div class="card-body text-black" style="padding: 20px 70px;">
                <div class="row">
                 <div class="alert alert-success" role="alert" style="width: 100%;">
                  Your booking completed successfully!.
                </div>
            </div>
          </div>
            <div class="col-md-12 col-lg-12 d-flex align-items-center" id="printdiv">
              <div class="card-body p-4 p-lg-5 text-black">
                <div class="row">
                    <div class="col-md-6">

                  <h4 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Bus ticket #{{ sprintf('%04u', $data['id']) }}</h4>
                    </div>
                    <div class="col-md-6">              

                    </div>
                </div>

                  @include('layouts.partials.messages')

                  <div class="row">
                    <div class="col-md-4">
                    <div class="form-outline mb-4">

                      <label class="form-label" for="email">Date & Time</label>
                      <h6>{{ $data['travel_date'] }} {{ $apidata['start_time'] }}</h6>
                    </div>
                  </div>
                  
                    <div class="col-md-4">
                      <div class="form-outline mb-4">

                        <label class="form-label" for="email">Start Location</label>
                        <h6>{{ $apidata['start_location'] }}</h6> 
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-outline mb-4">

                        <label class="form-label" for="email">End Location</label>
                        <h6>{{ $apidata['end_location'] }}</h6>  
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                    <div class="form-outline mb-4">

                      <label class="form-label" for="email">Vehicle Name</label>
                      <h6>{{ $apidata['bus_name'] }}</h6>
                    </div>
                  </div>
                  
                    <div class="col-md-4">
                      <div class="form-outline mb-4">

                        <label class="form-label" for="email">Vehicle no.</label>
                        <h6>{{ $apidata['bus_no'] }}</h6> 
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-outline mb-4">

                        <label class="form-label" for="email">Seat no.</label>
                        <h6>{{ $data['seat_no'] }}</h6>  
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                    <div class="form-outline mb-4">

                      <label class="form-label" for="email">Name</label>
                      <h6>{{ $data['name'] }}</h6>
                    </div>
                  </div>
                  
                    <div class="col-md-4">
                      <div class="form-outline mb-4">

                        <label class="form-label" for="email">NIC</label>
                        <h6>{{ $data['nic'] }}</h6> 
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-outline mb-4">
                        <label class="form-label" for="email">Reserved On</label>
                        <h6>{{ $data['created_at'] }}</h6> 
                      </div>
                    </div>
                  </div>

                  <a href="javascript:void()" onClick="PrintElem()"> <img src="{{ url('assets/img/print-btn.jpg') }}" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" /></a>  

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

 <script>
  $(document).ready(function () {
    $( "#traveldate" ).datepicker({
         dateFormat:'yy-mm-dd',
         minDate:0
      });
  } );
  </script>
@endsection