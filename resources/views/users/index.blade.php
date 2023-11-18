@extends('layouts.main')
@section('container')

<h1 style="text-align: left">{{ $title }}</h1>

<div class="table-responsive small col-lg-8" style="width: 100%">
<table class="table table-striped table-sm">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Roles</th>
            <th>Action</th>
        </tr>
    </thead>
@foreach ($users as $user)
    <tr>
        @if ($user->name == 'master_admin')
            @continue
        @endif
        <td>{{ $loop->index }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            @foreach ($user->roles as $role)
                {{ $role->name }}
            @endforeach
        </td>
        <td>
            <a href="/users/{{ $user->id }}/edit" class="btn btn-primary">Edit</a>
        </td>
    </tr>
@endforeach
</table>
</div>

@endsection
