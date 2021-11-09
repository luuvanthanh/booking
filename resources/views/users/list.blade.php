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