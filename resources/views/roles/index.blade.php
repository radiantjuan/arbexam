@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-8 text-left pb-3">
            <h1>Roles</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date Created</th>
                        <th>Date Update</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{$role->name}}</td>
                            <td>{{$role->created_at}}</td>
                            <td>{{$role->updated_at}}</td>
                            <td>
                                <a href="{{ route('roles.edit',['role' => $role->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit Permissions</a>
                                {{-- <a href="javascript:void(0)" class="btn btn-danger btn-sm btn-delete" data-id="{{$role->id}}"><i class="fa fa-trash"></i></a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <form id="deleteForm" method="post" action="{{route('roles.destroy',['role'=>0])}}">
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
