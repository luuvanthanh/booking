@extends('layouts.master')
@section('content')
@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
<table class="table">
    <thead>
      <tr>
        <th scope="col">STT</th>
        <th scope="col">RoomNumber</th>
        <th scope="col">People</th>
        <th scope="col">Avatar</th>
        <th scope="col" colspan="3"></th>
      </tr>
    </thead>
    <tbody>
        @foreach($rooms as $room)
            <tr>
                <th scope="row">{{ $room->id }}</th>
                <td>{{ $room->roomNumber }}</td>
                <td>{{ $room->people }}</td>
                <td style="width: 100px;"><img src="{{ $room->avatar }}" style="width: 100%;" alt=""></td>
                <td class="text-center">
                    <a class="btn btn-primary btn-sm" href="{{ route('room.create') }}">
                        <i class="fas fa-plus-square"></i>
                    </a>
                </td>
                <td class="text-center">
                    <a class="btn btn-dark btn-sm" href="{{ route('room.edit', $room->id) }}">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
                <td class="text-center">
                    <form action="{{ route('room.destroy', $room->id) }}" method="POST">
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
  {{ $rooms->links() }}
@endsection