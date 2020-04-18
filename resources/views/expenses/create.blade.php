@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" action="{{route('expenses.store',['category'=>$categoryId,'user'=>$userId])}}">
            <div class="card">
                <div class="card-header">
                    Add New {{$objCategory->name}} Expense
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" expense="alert">
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
                        <input type="text" class="form-control" name="name" placeholder="Enter Expense Name"  value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                        <label for="name">Value: </label>
                        <input type="number" class="form-control" name="expense_value" placeholder="Enter Expense Value" value="{{old('expense_value')}}" step="0.01">
                    </div>

                </div>
                <div class="card-footer">
                    <a href="{{ route('expenses.category',['user' => $userId,'category'=>$categoryId]) }}" class="btn btn-sm btn-secondary"><i class="fa fa-caret-left"></i> Back </a>
                    <button class="btn btn-sm btn-success"> Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
