@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mt-2"><strong class="text-success">E</strong>vent !</h2>
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
    <div class="row mt-5">
        <div class="col-md-6 col-12">
            <h4 class="text-center"><strong class="text-primary">P</strong>oker Event</h4>
            <img src="{{asset('../images/poker.png')}}" class="mx-auto d-block" style="width: 100%; height:94%;" alt="">
        </div>
        <div class="col-md-6 col-12">
            <div class="div">
            <h4 class="text-center"><strong class="text-primary">R</strong>eading Book Event</h4>
            <img src="{{asset('../images/book.png')}}" class="mx-auto d-block" style="width: 100%;" alt="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-12">
            <h4 class="text-center"><strong class="text-primary">M</strong>arathon Sport Event</h4>
            <img src="{{asset('../images/run.png')}}" class="mx-auto d-block" style="width: 100%;" alt="">
        </div>
        <div class="col-md-6 col-12">
            <h4 class="text-center"><strong class="text-primary">S</strong>ummer Cycling Event</h4>
            <img src="{{asset('../images/bike.png')}}" class="mx-auto d-block" style="width: 100%;" alt="">
        </div>
    </div>
</div>
@endsection
