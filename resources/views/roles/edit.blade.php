@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" action="{{route('roles.update',['role'=>$role->id])}}">
            <div class="card">
                <div class="card-header">
                     Edit Role {{$role->name}}
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
                    {{ method_field("PUT") }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Name: </label>
                        <input type="text" class="form-control" name="name" value="{{$role->name}}">
                    </div>
                    <div class="form-group">
                    <label for="name">Permission: </label>
                        <select class="permissions form-control" name="permission[]" multiple="multiple">
                            @php
                                $rolePermission = json_decode($role->permissions);
                                
                            @endphp
                            @foreach ($permissions as $permission)
                                <option value="{{$permission->id}}" {{(in_array($permission->id,$rolePermission) ? 'selected' : '')}}>{{str_replace('_',' ',$permission->name)}}</option>    
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="card-footer">
                    <a href="{{route('roles.index')}}" class="btn btn-sm btn-secondary"><i class="fa fa-caret-left"></i> Back </a>
                    <button class="btn btn-sm btn-success"> Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
