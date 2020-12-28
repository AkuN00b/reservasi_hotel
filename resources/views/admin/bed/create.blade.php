@extends('layouts.backend.app')

@section('title', 'Bed Create -')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <h2 class="mt-1 mb-2">Create Bed</h2>
        <hr class="mb-3 garis">
        <a class="text-white" href="{{ url()->previous() }}" style="text-decoration: none">< Back</a><br><br>

        <form class="forms-sample" method="POST" action="{{ route('admin.bed.store') }}">
          @csrf
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Bed Name">
            </div>
            <div class="form-group">
              <label for="number">Amount of Person (Number)</label>
              <input type="number" class="form-control" id="person" name="person" placeholder="Amount of Person">
            </div>
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button type="reset" class="btn btn-dark">Cancel</button>
        </form>
    </div>
</div>
@endsection
