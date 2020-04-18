@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" action="{{route('change.password.submit',['id'=>$userId])}}">
            <div class="card">
                <div class="card-header">
                    Change Password
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
                    <div class="alert alert-info">
                        You will be logged out once you changed your password
                    </div>
                        {{ csrf_field() }}
                        {{ method_field("PUT") }}
                        <div class="form-group">
                            <label for="password">Password: </label>
                            <input type="password" class="form-control" name="password" placeholder="Enter Your Password Here">
                        </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-sm btn-success"> Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
