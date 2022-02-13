@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <h1>Dashboard</h1>
        <section>
            <div class="row">
                <div class="col-md-3">
                    <img src="{{ url('assets/img/avatar-profile-image.jpg') }}" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                </div>
                <div class="col-md-9">
                    <h4>Reservations</h4>
                    <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Ticket no.</th>
                          <th scope="col">Travel Date</th>
                          <th scope="col">Start Location</th>
                          <th scope="col">End Location</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($reservations as $reservation)
                        <tr>
                          <th scope="row">{{$reservation['no']}}</th>
                          <td>{{ sprintf('%04u', $reservation['id']) }}</td>
                          <td>{{$reservation['travel_date']}}</td>
                          <td>{{$reservation['start_location']}}</td>
                          <td>{{$reservation['end_location']}}</td>
                          <td><a href="{{ url('dashboard/'.$reservation['res_id'])}}">View</a> </td>
                        </tr>
                        @endforeach
                       
                      </tbody>
                    </table>

                </div>
            </div>
        </section>
        @endauth
    </div>
@endsection