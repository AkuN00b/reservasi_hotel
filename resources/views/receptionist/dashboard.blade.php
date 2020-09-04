@extends('layouts.backend.app')

@section('title', 'Receptionist Dashboard -')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
    
                        You are logged in! as <strong>{{ Auth::user()->name }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
