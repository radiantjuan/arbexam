@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">This is your expenses!</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <canvas id="myChart" width="400" height="400"></canvas>
                    <input type="hidden" name="current_user_id" value="{{$currentUserId}}">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
