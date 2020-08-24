@extends('layouts.app')
@section('content')

<h3 style="margin-top: 15px; margin-left:15px; color:black;" class="text-center"><strong class="text-success">F</strong>ind Your Event!</h3>
<div class="container mt-3">
  <div class="container">
    <div class="row">
      <div class="col-lg-5 col-md-12">
        <div class="form-group">
          <input type="text" id="searchEvent" class="form-control" name="search" placeholder="Search">
        </div>
      </div>
      <div class="col-lg-2 col-md-6" style="margin-top: 9px; ">Not too far from</div>
      <div class="col-lg-5 col-md-6">
        <div class="form-group">
          <select name="city" class="form-control" id="searchCity">
            <option value="">-----Select City-----</option>
            @foreach($cities as $data)
            @foreach($data as $city)
            <option value="{{$city}}" {{ ($city == $userCity) ? "selected" : "" }}>{{$city}}</option>
            @endforeach
            @endforeach
          </select>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
  {{--====== checkbox  ==========--}}
  <div class="form-check" style="margin-left:20px">
    @if (Auth::user()->check == 1)
        <input type="checkbox" id="checkbox" name="checkbox[]" checked value="{{Auth::user()->check}}" class="form-check-input">  
    @endif
    <label class="form-check-label" for="checkbox">Event you join only</label>
  </div>
  <form id="ifCheck" action="{{route('ischeck',0)}}" method="post">
    @csrf
    @method('put')
  </form>
</div>
<div class="container">
  <div class="row" style="margin-left: 83%">
    <ul class="nav nav-tabs ml">
    <li class="nav-item">
      <a class="nav-link" href="{{ url('exploreEvent') }}">Card</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('calendarview')}}">Calendar</a>
    </li>
    </ul>
  </div>
</div>
@foreach ($exploreEvent as $event)
<?php 
  $current_date = new DateTime();
  $date_exspire = new DateTime($event->end_date);
?>
@if ($current_date <= $date_exspire)
@if (Auth::id() != $event->user_id)
@foreach ($joinEvent as $joins)
  @if ($joins->user_id == Auth::id() && $joins->event_id == $event->id)
<div class="container" style="cursor:pointer" id="exploreEvent">
  <div class="col-12">
      <a href="" class="text-primary">
        <?php $date = new DateTime($event->start_date);
        echo date_format($date, ' l jS F Y'); ?>
      </a>
    <p hidden>{{$event->city}}</p>
    <div class="card mb-3" style="border-radius: 20px;">
      <div class="card-body">
        <div class="row">
          <div class="col-xl-3 col-lg-6 col-md-6 col-12 text-center" data-toggle="modal" data-target="#eventDetail{{$event->id}}"><br>
            <h5 class="text-secondary">
              <?php
                $date = new DateTime($event->start_time);
                echo date_format($date, 'g:iA');
              ?>
            </h5>
          </div>
          <div class="col-xl-4 col-lg-6 col-md-6 col-12 text-center" data-toggle="modal" data-target="#eventDetail{{$event->id}}">
            <p><b class="text-primary">{{$event->category->name}}</b></p>
            <h4 class="text-warning ">{{$event->title}}</h4>
            @if ($event->joins->count("user_id") <= 1)
                
            <p> <strong class="text-warning ">{{$event->joins->count("user_id")}}</strong> member going</p>
            @endif
           @if ($event->joins->count("user_id") > 1)
               
           <p> <strong class="text-warning ">{{$event->joins->count("user_id")}}</strong> members going</p>
           @endif
                
          </div>
          <div class="col-xl-3 col-lg-6 col-md-12 col-12" data-toggle="modal" data-target="#eventDetail{{$event->id}}">
            <img class="mx-auto d-block" src="{{asset('images/'.$event->profile)}}" width="105" style="border-radius: 105px;" height="105" alt="Avatar">
          </div>
          <div class="col-xl-2 col-lg-6 col-md-12 col-12 text-center" data-toggle="modal" style="display:flex;justify-content:center;align-items:center">
            <br>

            @foreach ($event->joins as $join)
            @if ($event->id == $join->event_id && $join->user_id == Auth::id())
              <form action="{{route('quit', $join->id)}}" method="post">
               @csrf
                @method("delete")
                <button type="submit" class="btn btn-sm btn btn-danger mt-4 quit-nutton">
                <i class="fa fa-times-circle"></i>
                <b>Quit</b> 
                 </button>
                 </form>
                @endif
              @endforeach
                                         
              <form action="{{route('join', $event->id)}}" method="post">
              @csrf
              <div class="join_button">
              <input type="hidden" class="event_id" value="{{$event->id}}">
              </div>
              <div class="join_button_display" >
               </div>
            </form>

          </div>
        </div>
      </div>
    </div>
    <!-- =================================Opend event detail==================================================== -->
    <!-- The Modal -->
    <div class="modal fade" id="eventDetail{{$event->id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title text-warning">Event Detail</h4>
          </div>
          <div class="container-fluid">
            <div class="row">
              <div class="col-4">
                <img class="mt-5" width="130" style="border-radius: 105px;" height="130" src="{{asset('images/'.$event->profile)}}">
              </div>
              <div class="col-8">
                <p class="category text-primary"><strong>{{$event->category->name}}</strong></p>
                <h4 class="title"><strong>{{$event->title}}</strong></h4>
                <div class="row">
                  <i class="material-icons">location_on</i>
                  <p>{{$event->city}} </p>
                </div>
                <div class="row">
                  <i class="material-icons">account_circle</i>
                  @if ($event->joins->count("user_id") <= 1)
                
                  <p> <strong class="text-warning ">{{$event->joins->count("user_id")}}</strong> member going</p>
                  @endif
                 @if ($event->joins->count("user_id") > 1)
                     
                 <p> <strong class="text-warning ">{{$event->joins->count("user_id")}}</strong> members going</p>
                 @endif
                </div>
                <div class="row">
                  <i class="material-icons">account_circle</i>
                  <p>{{$event->user->firstname}}</p>
                </div>
                <div class="row">
                  <i class="material-icons">alarm</i>
                  <?php
                  $start_time = new DateTime($event->start_time);
                  $end_time = new DateTime($event->end_time);
                  echo date_format($start_time, 'g:iA').' to ';
                  echo date_format($end_time, 'g:iA');
                  ?>
                </div>
                @foreach ($event->joins as $join)
                @if ($event->id == $join->event_id && $join->user_id == Auth::id())
                  <form action="{{route('quit', $join->id)}}" method="post">
                   @csrf
                    @method("delete")
                    <button type="submit" class="btn btn-sm btn btn-danger mt-4 quit-nutton" style="display:flex;justify-content:rith;align-items:center">
                    <i class="fa fa-times-circle"></i>
                    <b> Quit</b> 
                     </button>
                     </form>
                    @endif
                  @endforeach
                                             
                  <form action="{{route('join', $event->id)}}" method="post">
                  @csrf
                  <div class="join_button">
                  <input type="hidden" class="event_id" value="{{$event->id}}">
                  </div>
                  <div class="join_button_display" >
                   </div>
                </form>
              </div>
            </div>
            <hr>
          </div>
          <div class="container">
            <textarea cols="55" rows="5"> {{$event->description}} </textarea>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
@endif
@endforeach
@endif
@endif
</div>
</div>
@endforeach
<!-- =================================Search event==================================================== -->
<script>
  $(document).ready(function() {
    var value = {!! json_encode(Auth::user()->city, JSON_HEX_TAG) !!}.toLowerCase()
    $("#exploreEvent ").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
    $("#searchCity").on("change", function() {
      var value = $(this).val().toLowerCase();
      $("#exploreEvent ").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
  joinButton()
    function joinButton(){
      var eventJoin = {!! json_encode($joinEvent, JSON_HEX_TAG) !!}
      var user_id = {!! json_encode(Auth::id(), JSON_HEX_TAG) !!}
      var event_id = document.getElementsByClassName('join_button');
      var join_button_display = document.getElementsByClassName('join_button_display');
      var data;
      var arrayEvent = [];
        for (let i = 0; i < event_id.length; i++) {
          eventJoin.forEach(items => {
            data = event_id[i].getElementsByClassName('event_id')[0];
            if(data.value == items.event_id){
              arrayEvent.push(items.event_id)
            }
          });
          if (arrayEvent[i] === undefined){
            arrayEvent.push('had join');
              join_button_display[i].innerHTML = `
                <button class="btn btn-sm btn btn-primary mt-4 float-right join-button">
                  <i class="fa fa-check-circle text-light"></i>
                  <b class ="text-light">Join</b>
                </button>
                `;
          }
      }            
    }
        // check only user event
        $("#checkbox").on('click', function () {
          var data = event_check();
          if (data == 1) {
            $('#ifCheck').submit();
          }
        });
         // return value of checkbox
        function event_check(){
          var checkBox = document.getElementById('checkbox');
          if (checkBox.checked === true)
          {
            var value = document.getElementById('checkbox').value;
            return value;
          }
          else
          {
            var value = document.getElementById('checkbox').value;
            return value;
          }      
        }
</script>
@endsection
<!-- =================================end event detail==================================================== -->