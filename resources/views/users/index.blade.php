@extends('layouts.app')

@section('content')
<div class="container-fluid">
   
    <div class="row justify-content-center pb-3">
        <div class="col-8 text-left">
            <h2>Users</h2>
        </div>
    </div>
    <div class="row justify-content-center pb-3">
        <div class="col-4 text-left">
            @if(\App\User::userCan(['browse_roles']))
                <a href="{{route('roles.index')}}" class="btn btn-sm btn-primary">Manage Roles</a>
            @endif
        </div>
        <div class="col-4 text-right">
            @if(\App\User::userCan(['add_user']))
                <a href="{{route('users.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Add User</a>
            @endif
            
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Date Created</th>
                        <th>Date Update</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->roles->name}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>{{$user->updated_at}}</td>
                            <td>
                                @if(\App\User::userCan(['edit_user']))
                                    <a href="{{ route('users.edit',['user' => $user->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                @endif

                                @if(\App\User::userCan(['delete_user']))
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm btn-delete" data-id="{{$user->id}}"><i class="fa fa-trash"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <form id="deleteForm" method="post" action="{{route('users.destroy',['user'=>0])}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Are you sure you want to delete?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                {{ csrf_field() }}
                {{method_field('delete')}}
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection
