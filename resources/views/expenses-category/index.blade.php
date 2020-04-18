@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-8 text-left pb-3">
            <h1>Expenses Category</h1>
        </div>
    </div>
    <div class="row justify-content-center pb-3">
        <div class="col-4 text-left">
            <a href="{{route('expenses.index')}}" class="btn btn-sm btn-secondary"><i class="fa fa-caret-left"></i> Back</a>
        </div>
        <div class="col-4 text-right">
            @if($canAdd)
            <a href="{{route('expenses-category.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Add Category</a>
            @endif
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
                    @foreach($expenseCategories as $expenseCategory)
                        <tr>
                            <td>{{$expenseCategory->name}}</td>
                            <td>{{$expenseCategory->created_at}}</td>
                            <td>{{$expenseCategory->updated_at}}</td>
                            <td>
                                @if($canEdit)
                                    <a href="{{ route('expenses-category.edit',['expenses_category' => $expenseCategory->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                @endif

                                @if($canDelete)
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm btn-delete" data-id="{{$expenseCategory->id}}"><i class="fa fa-trash"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" expenseCategory="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <form id="deleteForm" method="post" action="{{route('expenses-category.destroy',['expenses_category'=>0])}}">
    <div class="modal-dialog" expenseCategory="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Are you sure you want to delete?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    These expeneses connected to this category will be deleted as well, Do you want to proceed?
                </div>
                <div>
                    <ul class="category-list">

                    </ul>
                </div>
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
