@extends('layouts.master')
@section('content')
@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
<div class="container-fluid">
    <div class="row"><div class="col-md-2"></div></div>
    <div class="row">
        <form action="" class="row g-3" method="GET">
        <div class="col-auto">
        <label class="form-control-plaintext">Tìm kiếm</label>
        </div>
        <div class="col-auto">
        <input type="text" name="name" id="search" class="form-control" value=""  placeholder="">
        </div>
        </form>
    </div>
</div>
<table class="table">
    <thead>
      <tr>
        <th scope="col">STT</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Adress</th>
        <th scope="col">Phone</th>
        {{-- <th scope="col">Is Admin</th> --}}
        <th scope="col">Department</th>
        <th scope="col" colspan="3"></th>
      </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->address }}</td>
            <td>{{ $user->phone }}</td>
            {{-- @if ($user->isAdmin == 1)
                <td>Quan tri vien</td>
            @else
                <td>User</td>
            @endif --}}
            <td>{{ $user->department->name }}</td>
            <td class="text-center">
                <a class="btn btn-primary btn-sm" href="{{ route('user.create') }}">
                    <i class="fas fa-plus-square"></i>
                </a>
            </td>
            <td class="text-center">
                <a class="btn btn-dark btn-sm" href="{{ route('user.edit', $user->id) }}">
                    <i class="fas fa-edit"></i>
                </a>
            </td>
            <td class="text-center">
                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </td>
          </tr>
        @endforeach
    </tbody>
  </table>
  {{ $users->links() }}
@endsection
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $("#search").keyup(function(){
        var value = $(this).val();
        $.get("/ajax/search/user/"+value, function(data){
                $(".table").html(data);
        });
    });
});
</script>