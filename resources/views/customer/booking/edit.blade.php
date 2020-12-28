@extends('layouts.backend.app')

@section('title', 'Booking Edit -')

@push('css')
    
@endpush

@section('content')

<div class="content-wrapper">
    <h2 class="mt-1 mb-2">Input Proof Image</h2>
    <hr class="mb-3 garis">
    <a class="text-white" href="{{ url()->previous() }}" style="text-decoration: none">< Back</a><br><br>

    <form class="forms-sample" method="POST" action="{{ route('customer.booking.update',$bookings->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="image">Proof Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

    <button type="submit" class="btn btn-primary mr-2">Submit</button>
    <button type="reset" class="btn btn-dark">Cancel</button>
    </form>
</div>

@endsection

@push('js')

@endpush