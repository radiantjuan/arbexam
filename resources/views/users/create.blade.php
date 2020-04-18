@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" action="{{route('users.store')}}">
            <div class="card">
                <div class="card-header">
                    Add User
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Name: </label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Name Here" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email: </label>
                            <input type="email" class="form-control" name="email" placeholder="Enter Email Address" value="{{old('email')}}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password: </label>
                            <input type="password" class="form-control" name="password" placeholder="Enter Your Password Here">
                        </div>
                        <div class="form-group">
                            <label for="role">Role: </label>
                            <select name="role" class="form-control" id="">
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}" {{(old('role') == $role->id) ? 'selected' : ''}}>{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
                <div class="card-footer">
                    <a href="{{route('users.index')}}" class="btn btn-sm btn-secondary"><i class="fa fa-caret-left"></i> Back </a>
                    <button class="btn btn-sm btn-success"> Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
