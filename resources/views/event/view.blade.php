@extends('layouts.app')

@section('content')

<div class="container mt-5">
  <h2 class="text-center"><strong class="text-success ">W</strong>elcome To Your Event !</h2>
  <div class="row">
    <div class="col-12">
      <div class="container">
        <div class="col-12">
          <div class="md-form active-pink active-pink-2 mb-3 mt-0">
            <input class="form-control" type="text" placeholder="Search" aria-label="Search event..." name="search" id="myInput">
          </div>
          @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
          @endif
        </div>
      </div>
     <div class="container">
     <div class="col-12">
      <div class="text-right">
        <a href="" class="btn btn-warning btn-sm text-white font-weight-bolder" data-toggle="modal" data-target="#createEvent">
          <i class="material-icons float-left" data-toggle="tooltip" title="Add Event!" data-placement="left">add</i>&nbsp;CREATE EVENT
        </a>
      </div>
     </div>
      </div>
      {{-- loop to show event --}}
      @foreach ($events as $event)
      <?php 
          $current_date = new DateTime();
          $date_exspire = new DateTime($event->end_date);
      ?>
      @if ($current_date <= $date_exspire)
      @if (Auth::id() == $event->user_id)
      <div class="container" id="myevents">
        <div class="col-12">
          <a href="" class="text-primary">
            <?php $date = new DateTime($event->start_date);
            echo date_format($date, ' l jS F Y'); ?>
          </a>
          <div class="card mb-3" style="border-radius: 20px;">
            <div class="card-body">
              <div class="row">
                <div class=" col-xl-3 col-lg-6 col-md-6 col-12 text-center"><br>
                  <h5 class="text-secondary">
                    <?php
                    $date = new DateTime($event->start_time);
                    echo date_format($date, 'g:iA');
                    ?>
                  </h5>
                </div>
                <div class=" col-xl-4 col-lg-6 col-md-6 col-12 text-center">
                  <p><b class="text-primary">{{$event->category->name}}</b></p>
                  <h4 class="text-warning ">{{$event->title}}</h4>
                  @if ($event->joins->count("user_id") <= 1)
                
                  <p> <strong class="text-warning ">{{$event->joins->count("user_id")}}</strong> member going</p>
                  @endif
                 @if ($event->joins->count("user_id") > 1)
                     
                 <p> <strong class="text-warning ">{{$event->joins->count("user_id")}}</strong> members going</p>
                 @endif
                </div>
                <div class=" col-xl-3 col-lg-6 col-md-12 col-12">
                  <img class="mx-auto d-block" src="{{asset('images/'.$event->profile)}}" width="105" style="border-radius: 105px;" height="105" alt="Avatar">
                </div>
                <div class=" col-xl-2 col-lg-6 col-md-12 col-12 text-center">
                  <br>
                  <a href="" data-toggle="modal" data-target="#updateEvent{{$event->id}}"><i class="material-icons text-info" data-toggle="tooltip" title="Edit Event!" data-placement="left">edit</i></a>
                  <a href="" data-toggle="modal" data-target="#deteleEvent{{$event->id}}"><i class="material-icons text-danger" data-toggle="tooltip" title="Delete Event!" data-placement="left">delete</i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif
      <!-- ========================================START Model DELETE================================================ -->
      <!-- The Modal -->
      <div class="modal fade" id="deteleEvent{{$event->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-warning" id="exampleModalLabel">Delete Event</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{route('destroy',$event->id)}}" method="post">
                @csrf
                @method('DELETE')
                <p>Are you sure to remove this event?</p>
                <button type="button" class="btn btn-danger" data-dismiss="modal">DISCARD</button>
                <button type="submit" class="btn btn-warning float-right text-light ml-2">DELETE</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- =================================END MODEL DELETE==================================================== -->

      <!-- ========================================START Model UPDATE================================================ -->
      <!-- The Modal -->
      <div class="modal fade" id="updateEvent{{$event->id}}">
        
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title text-warning">Edit Event</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
              <form method="post" action="{{route('updateEvent',$event->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">
                  <div class=" col-lg-4 col-md-6 mb-3">
                    <label for="validationDefault01">Categories</label>
                    <select class="form-control" id="validationDefault01" name="category">
                      @foreach ($categories as $category)
                      <option value="{{$category->id}}" {{ ($event->category['name'] == $category->name) ? "selected" : "" }}>{{$category->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-lg-4 col-md-6 mb-3">
                    <label for="validationDefault02">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Title..." value="{{$event->title}}" required>
                  </div>
                  <div class="col-lg-4 col-md-12 mb-3">
                    <label for="validationDefault03">City</label>
                    <select class="form-control" id="validationDefault01" name="city">
                      @foreach($cities as $data)
                      @foreach($data as $city)
                      <option value="{{$city}}" {{ ($city == $event->city) ? "selected" : "" }}>{{$city}}</option>
                      @endforeach
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-row">
                  <div class="col-md-7 mb-3">
                    <div class="form-row">
                      <div class="col-md-8 mb-3">
                        <label for="validationDefault03">Start Date</label>
                        <input type="date" class="form-control" name="start_date" id="validationDefault03" value="{{$event->start_date}}" required>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="validationDefault04">At</label>
                        <input type="time" class="form-control" name="start_time" id="validationDefault04" value="{{$event->start_time}}" placeholder="At..." required>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-md-8 mb-3">
                        <label for="validationDefault03">End Date</label>
                        <input type="date" class="form-control" id="validationDefault03" name="end_date" value="{{$event->end_date}}" required>
                      </div>

                      <div class="col-md-4 mb-3">
                        <label for="validationDefault04">At</label>
                        <input type="time" class="form-control" id="validationDefault04" name="end_time" value="{{$event->end_time}}" required>
                      </div>

                    </div>
                  </div>
                  <div class="col-md-5 mb-3">
                    <img class="mx-auto d-block" src="../images/{{$event->profile}}"width="120px" id="image3" height="120px" onchange="readURL(this)">
                    <div class="crud text-center">
                      <label for="validationDefault04">Picture</label>
                      <div class="image-upload text-center">
                      <label for="file-input1">
                        <i class="material-icons m-2 text-primary">create</i>
                      </label>

                      <input id="file-input1" type="file" name="profile" hidden onchange="readURL(this)">
                        <a href="{{route('delPic', $event->id)}}"><i class="material-icons m-2 text-danger">delete</i></a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-12 mb-3 md-form mb-4 pink-textarea active-pink-textarea" >
                    <label for="form18">Description</label>
                    <textarea id="form18" class="md-textarea form-control" name="description" rows="3" >{{$event->description}}</textarea>
                  </div>
                </div>
                <a data-dismiss="modal" class="closeModal">DISCARD</a>
                &nbsp;
                <input type="submit" value="UPDATE" class="createBtn text-warning">
              </form>
            </div>
          </div>
        </div>
      </div>
      @endif
      <!-- =================================END MODEL UPDATE==================================================== -->
      @endforeach
      {{-- end foreach of event --}}
      <div class="col-2"></div>
    </div>
  </div>

  <!-- ========================================START Model CREATE================================================ -->
  <!-- The Modal -->
  @foreach($events as $data)
  @foreach($data as $event)
  <div class="modal fade" id="createEvent">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title text-warning">Create Event</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form method="post" action="{{url('createEvent')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
              <div class="col-md-4 mb-3">
                <label for="validationDefault01">Categories</label>
                <select class="form-control" name="category" required>
                  <option selected>Choose...</option>
                  @foreach($categories as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationDefault02">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Title..." value="" required>
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationDefault03">City</label>
                <select class="form-control" name="city" required>
                  <option selected>Choose...</option>
                  @foreach($cities as $data)
                  @foreach($data as $city)
                  <option value="{{$city}}">{{$city}}</option>
                  @endforeach
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-7 mb-3">
                <div class="form-row">
                  <div class="col-md-8 mb-3">
                    <label for="validationDefault03">Start Date</label>
                    <input type="date" id="datetimepickerDemo" name="start_date" class="form-control datePicker" autocomplete="off" placeholder="Start Date..." required>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="validationDefault04">At</label>
                    <input type="time" name="start_time" class="form-control" id="validationDefault04" placeholder="At..." required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-8 mb-3">
                    <label for="validationDefault03">End Date</label>
                    <input type="date" name="end_date" class="form-control datePicker" id="validationDefault03" placeholder="Start Date..." required>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label for="validationDefault04">At</label>
                    <input type="time" name="end_time" class="form-control" id="validationDefault04" placeholder="At..." required>
                  </div>

                </div>
              </div>
              <div class="col-md-5 mb-3">
                <img class="mx-auto d-block" src="images/event.png" id="image2" alt="..." width="105" style="border-radius: 105px;" height="105" alt="Avatar" onchange="readURL(this)">
                <div class="text-center">
                <label class="text-center">Picture</label>
                </div>
                <div class="image-upload text-center">
                  <label for="file-input2">
                    <i class="material-icons m-2 text-primary" style="cursor:pointer;">add</i>
                  </label>
                  <input id="file-input2" type="file" name="picture" hidden onchange="readURL(this)">
                </div>
              </div>

            </div>
            <div class="form-row">
              <div class="col-md-12 mb-3 md-form mb-4 pink-textarea active-pink-textarea">
                <label for="form18">Description</label>
                <textarea id="form18" name="description" minlength="50" class="md-textarea form-control" rows="3" placeholder="......" required></textarea>
              </div>
            </div>
            <a data-dismiss="modal" class="closeModal">DISCARD</a>
            &nbsp;
            <input type="submit" value="CREATE" class="createBtn text-warning">
          </form>
        </div>
      </div>
    </div>
  </div>
  @endforeach
  @endforeach
  <!-- =================================END MODEL CREATE==================================================== -->

  <script>
    $(document).ready(function() {
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myevents ").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>
  <script>
    function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(element) {
        $('#image2, #image3')
          .attr('src', element.target.result)
          .width(120)
          .height(120);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
  </script>
  @endsection