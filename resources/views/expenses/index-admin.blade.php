@extends('layouts.app')

@section('content')
<div class="container-fluid">
   
    <div class="row justify-content-center pb-3">
        <div class="col-8 text-left">
            <h2>User's Expenses</h2>
        </div>
    </div>
    <div class="row justify-content-center pb-3">
        <div class="col-8 text-left">
            @if($canBrowse)
                <a href="{{route('expenses-category.index')}}" class="btn btn-sm btn-primary">Manage Expenses Categories</a>
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Total Expenses</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($arrData as $expensesUser)
                        <tr>
                            <td>{{$expensesUser['name']}}</td>
                            <td>${{number_format($expensesUser['sum_per_user'], 2)}}</td>
                            <td>
                                <a href="{{ route('expenses.user',['user' => $expensesUser['id']]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit Expenses</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
