@extends('layouts.app')
@section('content')
<br>
<div class="container">
  <div class="col-12">
    <div class="form-group has-search mt-4">
      <span class="fa fa-search form-control-feedback"></span>
      <input id="myInput" type="text" class="form-control" placeholder="Search">
      {{-- errow con confirm password with new password --}}
      @if ($message = Session::get('error'))
      <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
      </div>
      @endif
      {{-- success confirm password with new password--}}
      @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
      </div>
      @endif
      {{-- warning confirm password with new password--}}
      @if ($message = Session::get('warning'))
      <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
      </div>
      @endif
    </div>
    <h1 class="text-center"><b class="text-success">A</b>ll Events</h1><br>
    <div class="card">
      <div class="table-responsive-md">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Organizer</th>
              <th>City</th>
              <th>Title</th>
              <th>Category</th>
              <th>Start date</th>
              <th>Action</th>
            </tr>
          </thead>
          <?php $items = $events; ?>
          @foreach ($items as $start_date => $events)
          @foreach ($events as $event)

          <tbody id="myevents">
            <tr>
              <td>{{$event->user->firstname}}</td>
              <td>
                {{$event->city}}
              </td>
              <td>{{$event->title}}</td>
              <td>
                {{$event->category->name}}
              </td>
              <td>
                <?php $date = new DateTime($start_date);
                echo date_format($date, ' d/m/Y'); ?>
              </td>
              <td>
                <a href="" class="text-danger" data-toggle="modal" data-target="#removeCategory{{$event->id}}"><span class="material-icons text-danger" data-toggle="tooltip" title="Delete Event!">delete</span></a>
              </td>
              {{-- Remove Category --}}
              <div class="modal" id="removeCategory{{$event->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-body">
                      <form action="{{route('destroy',$event->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <h3 class="mb-4"><b>Remove Event</b></h3>
                        <p>Are you sure you want to delete the Event?</p>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">DON'T REMOVE</button>
                        <button type="submit" class="btn btn-warning float-right text-light ml-2">REMOVE</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </tr>
          </tbody>
          @endforeach
          @endforeach
        </table>
      </div>

    </div>
  </div>
</div>
</div>
</div>

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

@endsection