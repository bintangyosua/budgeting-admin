{{-- {{ dd($users->find(1)); }} --}}
{{-- {{ 
    $user = $users->find(1)
}}

{{ dd($user->roles) }} --}}

{{-- 
   
@foreach ($user->roles as $role)
    {{ dd($role) }}
@endforeach --}}

@extends('layouts.main')

@section('container')
<h1 style="text-align: left">Users and Their Roles</h1>

<div class="table-responsive small col-lg-8">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Roles</th>
                {{-- <th>Action</th> --}}
            </tr>
        </thead>
        
    @foreach ($users as $user)
        @if ($user->name == 'master_admin')
            @continue
        @endif
        <tr>
            <td>{{ $loop->index }}</td>
            <td>{{ $user->name }}</td>
            {{-- <td>
                @foreach ($user->roles as $role)
                    {{ $role->name }}
                @endforeach
            </td> --}}
            <td>
                {{-- <form action="" method="POST">
                    <input type="submit" value="Edit">
                </form> --}}
                @foreach ($roles as $role)
                    @if ($role->name == 'master_admin')
                        @continue
                    @endif
                    <div class="form-check d-inline-block ">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" 
                        {{ $user->roles->contains('name', $role->name) ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ $role->name }}
                        </label>
                    </div>
                @endforeach
            </td>
        </tr>
    @endforeach
    </table>
</div>
@endsection
