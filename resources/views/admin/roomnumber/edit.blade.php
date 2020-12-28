@extends('layouts.backend.app')

@section('title', 'Room Number Edit -')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <h2 class="mt-1 mb-2">Edit Room Number</h2>
        <hr class="mb-3 garis">
        <a class="text-white" href="{{ url()->previous() }}" style="text-decoration: none">< Back</a><br><br>

        <form class="forms-sample" method="POST" action="{{ route('admin.room-number.update',$roomnumber->id) }}">
          @csrf
          @method('PUT')
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $roomnumber->name }}">
            </div>
            <div class="form-group">
              <label for="room_id">Room ID</label>
              <select name="room_id" id="room_id" class="form-control text-white">
                @foreach ($rooms as $rm)
                    <option value="{{ $rm->id }}"
                        @if ($rm->id == $roomnumber->room_id)
                            selected
                        @endif    
                    >{{ $rm->class->name }} ({{ $rm->bed->name }})</option>
                @endforeach
              </select>
            </div>
            <br>
            <input type="text" class="form-control" id="status" name="status" hidden value="{{ $roomnumber->status }}">

            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button type="reset" class="btn btn-dark">Cancel</button>
        </form>
    </div>
</div>
@endsection

@push('js')

@endpush
