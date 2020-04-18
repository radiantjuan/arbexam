@extends('layouts.app')

@section('content')
<div class="container-fluid">
   
    <div class="row justify-content-center pb-3">
        <div class="col-8 text-left">
            <h2>{{$objUser->name}}'s Expenses</h2>
        </div>
    </div>
    <div class="row justify-content-center pb-3">
        <div class="col-8 text-left">
            @if($isAdmin)
                <a href="{{route('expenses.index')}}" class="btn btn-sm btn-secondary"><i class="fa fa-caret-left"></i> Back</a>
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>Expense Category</th>
                        <th>Total Expenses</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($arrData as $expensesUser)
                        <tr>
                            <td>{{$expensesUser['name']}}</td>
                            <td>${{number_format($expensesUser['sum_per_category'], 2)}}</td>
                            <td>
                                <a href="{{ route('expenses.category',['user' => $objUser->id,'category'=>$expensesUser['id']]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit {{$expensesUser['name']}} Expenses</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
