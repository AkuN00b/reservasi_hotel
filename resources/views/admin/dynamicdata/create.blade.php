@extends('layouts.backend.app')

@section('title', 'Dynamic Data Create -')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <h2 class="mt-1 mb-2">Create Dynamic Data</h2>
        <hr class="mb-3 text-white" color="white">
        <a class="text-white" href="{{ url()->previous() }}" style="text-decoration: none">< Back</a><br><br>

        <form class="forms-sample" method="POST" action="{{ route('admin.dynamic_data.store') }}">
          @csrf
            <div class="form-group">
              <label for="value">Value</label>
              <input type="text" class="form-control" id="value" name="value" placeholder="Input Value">
            </div>
            <div class="form-group">
              <label for="section">Section</label>
              <input type="text" class="form-control" id="section" name="section" placeholder="Section of Value (Address or Reservation)">
            </div>
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button type="reset" class="btn btn-dark">Cancel</button>
        </form>
    </div>
</div>
@endsection
