@extends('layouts.backend.app')

@section('title', 'Image Class Edit -')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <h2 class="mt-1 mb-2">Request Edit Image {{ $class->name }} Class</h2>
        <hr class="mb-3 garis">
        <a class="text-white" href="{{ url()->previous() }}" style="text-decoration: none">< Back</a><br><br>

        <form class="forms-sample" method="POST" action="{{ route('receptionist.class.request-image.update',$class->id) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
            Name: {{ $class->name }} <br>
            Description: <br> 
            <div style="background-color: rgba(255, 255, 255, 0.532)">{!! $class->desc !!}</div>

            <div class="form-group">
              <label for="image">Image File</label>
              <input type="file" name="image" id="image" class="form-control">
            </div>
            Preview Image: <br>
            <img src="{{ asset('storage/class/'.$class->image) }}" alt="Gambar {{ $class->name }}"><br><br>

            <input type="number" value="{{ $class->id }}" hidden required name="class_id">
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button type="reset" class="btn btn-dark">Cancel</button>
        </form>
    </div>
</div>
@endsection
