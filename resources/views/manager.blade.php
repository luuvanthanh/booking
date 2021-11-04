@extends('layouts.master')
@section('content')
@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
<div class="container">
    <div class="booking-header">
        <div class="row">
            <div class="col-md-3">
                <img src="./images/room1.jpg" alt="" class="booking-header-img">
            </div>
            <div class="col-md-9">
                <span class="booking-header-name">Phong Hop</span>
            </div>
        </div>

        <form>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-1">
                        <label>Date:</label>
                    </div>
                    <div class="col-md-2">
                        <input type="text" id="datepicker" class="form-control">
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
                        <select class="form-control" id="exampleFormControlSelect1">
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
                    <div class="col-md-5">
                        @php
                            $array = array('08:00 - 09:00', '09:00 - 10:00', 
                            '10:00 - 11:00', '11:00 - 12:00', '12:00 - 13:00',
                            '13:00 - 14:00', '14:00 - 15:00', '15:00 - 16:00',
                            '16:00 - 17:00', '17:00 - 18:00', '18:00 - 19:00',
                            '19:00 - 20:00', '20:00 - 21:00', '21:00 - 22:00',
                            '22:00 - 23:00'
                        );
                        @endphp
                        @foreach ($array as $arr)
                            <input class="form-button" type="button" value="{{ $arr }}">
                        @endforeach
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
                        <input aria-label="quantity" class="input-qty form-button1" max="10" min="1" name="" type="number" value="1">
                    </div>
                    <div class="col-md-5"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary">Book room</button>
                </div>
                <div class="col-md-5"></div>
            </div>
        </form>
    </div>
</div>
@endsection