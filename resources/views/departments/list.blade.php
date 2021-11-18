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
        <th scope="col" colspan="3"></th>
      </tr>
    </thead>
    <tbody>
        @foreach($departments as $department)
            <tr>
                <th scope="row">{{ $department->id }}</th>
                <td>{{ $department->name }}</td>
                <td class="text-center">
                    <a class="btn btn-primary btn-sm" href="{{ route('department.create') }}">
                        <i class="fas fa-plus-square"></i>
                    </a>
                </td>
                <td class="text-center">
                    <a class="btn btn-dark btn-sm" href="{{ route('department.edit', $department->id) }}">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
                <td class="text-center">
                    <form action="{{ route('department.destroy', $department->id) }}" method="POST">
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
  {{ $departments->links() }}
@endsection