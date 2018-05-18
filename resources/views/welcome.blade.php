@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            @if (session('status'))
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    

                    You are logged in!
                </div>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection
