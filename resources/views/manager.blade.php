@extends('layouts.master')
@section('content')

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif
<div class="container">
    <div class="booking-header">
        <form action="{{ route('postRoom') }}" method="POST">
            <div class="row">
                <div class="col-md-3">
                    <img src="./images/room1.jpg" alt="" class="booking-header-img">
                </div>
                <div class="col-md-9">
                    <span class="booking-header-name">Phong Hop</span>
                @csrf
                    <div class="row">
                        <div class="col-md-2">
                        <label>Room</label>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" name="room_id" id="room">
                            <option>Chọn phòng</option>
                                @foreach ($rooms as $roomID => $roomName)
                                    <option value="{{ $roomID }}">{{ $roomName }}</option>
                                @endforeach
                            </select>   
                                
                        </div>
                        <div class="col-md-7"></div>
                    </div>
                </div>
            </div>

            
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-1">
                            <label>Date:</label>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="date" value="{{ old('date') }}" id="datepicker" class="form-control">
                            @if ($errors->has('date'))
                                <div class="error">{{ $errors->first('date') }}</div>
                            @endif
                        </div>
                        <div class="col-md-5"></div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-1">
                            <label for="exampleFormControlSelect1">Duration:</label>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" name="duration" value="{{ old('duration') }}" id="exampleFormControlSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-1">
                            <label class="form-to">From-to:</label>
                        </div>
                        <div class="col-md-5 box-time">
                            @if($fromTos)
                                @foreach ($fromTos as $fromTo)
                                    <label class="btn btn-outline-secondary" >
                                        <input type="radio" class="from" value="{{ $fromTo->from_to }}" name="from_to">{{$fromTo->from_to}}
                                    </label>
                                @endforeach 
                            @endif
                            @if ($errors->has('from_to'))
                                <div class="error">{{ $errors->first('from_to') }}</div>
                            @endif
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-1">
                            <label for="exampleFormControlSelect1">Attendess:</label>
                        </div>
                        <div class="col-md-2">
                            <input aria-label="quantity" name="attendess" value="1" class="input-qty form-button1" max="10" min="1" type="number">
                        </div>
                        <div class="col-md-5"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-1">
                        <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                        <button type="submit" class="btn btn-primary">Book room</button>
                    </div>
                    <div class="col-md-5"></div>
            </div>
        </form>
        
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $("#room").change(function(){
        var idRoom = $(this).val();
        $("#datepicker").change(function(){
            var date = $(this).val();
            $.get("ajax/room/"+idRoom+"/"+date, function(data){
                $(".box-time").html(data);
            });
            
        });
    });
});
</script>
