@extends('layouts.master')
@section('content')
    <form action="{{ route('room.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Room Number</label>
            <input type="text" class="form-control" name="roomNumber" placeholder="Enter Room number">
            @if ($errors->has('roomNumber'))
                <div class="error">{{ $errors->first('roomNumber') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label>People</label>
            <input aria-label="quantity" name="people" value="1" class="input-qty form-button1" max="10" min="1" type="number">
        </div>
        <div class="form-group">
            <label>Avartar</label>
            <input type="file" class="form-control" name="file" id="upload" placeholder="Enter Room number">
            @if ($errors->has('file'))
                <div class="error">{{ $errors->first('file') }}</div>
            @endif
            <div id="image_show">

            </div>
            <input type="hidden" name="thumb" id="file">
        </div>
        <button type="submit" class="btn btn-primary">Add room</button>
    </form>
@endsection
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $("#upload").change(function(){
            const form = new FormData();
            var a = form.append('file', $(this)[0].files[0]);
            $.ajax ({
                processData: false,
                contentType: false,
                type: 'POST',
                dataType: 'JSON',
                data: form,
                url: '/upload/image',
                success: function(result){
                    if (result.error == false) {
                        $("#image_show").html('<img src="'+ result.url + '" width="50px">');
                        $("#file").val(result.url);
                    } else{
                        alert("Upload file lỗi");
                    }
                }
            });
        });
    });
</script>