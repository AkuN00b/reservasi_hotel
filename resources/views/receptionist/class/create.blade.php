@extends('layouts.backend.app')

@section('title', 'Class Create -')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <h2 class="mt-1 mb-2">Request Create Class</h2>
        <hr class="mb-3 garis">
        <a class="text-white" href="{{ url()->previous() }}" style="text-decoration: none">< Back</a><br><br>

        <form class="forms-sample" method="POST" action="{{ route('receptionist.class.store') }}" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Class Name">
            </div>
            <div class="form-group">
              <label for="desc">Description</label>
              <textarea name="desc" id="desc" class="form-control" placeholder="Description of Class" cols="30" rows="25"></textarea>
            </div>
            <div class="form-group">
              <label for="image">Image File</label>
              <input type="file" name="image" id="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button type="reset" class="btn btn-dark">Cancel</button>
        </form>
    </div>
</div>
@endsection
