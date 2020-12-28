@extends('layouts.backend.app')

@section('title', 'Room Number Create -')

@push('css')

@endpush

@section('content')
<div class="content-wrapper">
    <div class="container">
        <h2 class="mt-1 mb-2">Create Room Number</h2>
        <hr class="mb-3 garis">
        <a class="text-white" href="{{ url()->previous() }}" style="text-decoration: none">< Back</a><br><br>

        <form class="forms-sample" method="POST" action="{{ route('admin.room-number.store') }}">
          @csrf
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Name">
            </div>

            <div class="form-group">
              <label for="room_id">Room ID</label>
              <select class="form-control text-white" name="room_id" id="room_id">
                <option value="" holder>Select Room</option>
                @foreach ($rooms as $room)
                  <option value="{{ $room->id }}">{{ $room->class->name }} ({{ $room->bed->name }})</option>                   
                @endforeach
              </select>
            </div>
            <br>

            <input type="text" class="form-control" id="status" name="status" value="1" hidden placeholder="Name">

            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button type="reset" class="btn btn-dark">Cancel</button>
        </form>
    </div>
</div>
@endsection

@push('js')

@endpush
