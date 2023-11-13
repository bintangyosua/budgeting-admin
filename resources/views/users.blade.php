@extends('layouts.main')
@section('container')

<h1 style="text-align: left">{{ $title }}</h1>

<div class="table-responsive small col-lg-8">
<table class="table table-striped table-sm">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
@foreach ($users as $user)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            <form action="" method="POST">
                <input type="submit" value="Edit">
            </form>
        </td>
    </tr>
@endforeach
</table>
</div>

@endsection
