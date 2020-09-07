@extends('layouts.backend.app')

@section('title', 'Room Create -')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <h2 class="mt-1 mb-2">Create Room</h2>
        <hr class="mb-3 text-white" color="white">
        <a class="text-white" href="{{ url()->previous() }}" style="text-decoration: none">< Back</a><br><br>

        <form class="forms-sample" method="POST" action="{{ route('admin.room.store') }}">
          @csrf
            <div class="form-group">
              <label for="class_id">Bed Class</label>
              <select class="form-control text-white" name="class_id" id="class_id">
                @foreach ($class as $cl)
                  <option value="{{ $cl->id }}">{{ $cl->name }}</option>                    
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="bed_id">Amount of Person</label>
              <select class="form-control text-white" name="bed_id" id="bed_id">
                @foreach ($beds as $bed)
                  <option value="{{ $bed->id }}">{{ $bed->name }} ({{ $bed->person }})</option>                    
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="price">Price</label>
              <input type="number" class="form-control" id="price" name="price" placeholder="Class Price">
            </div>
            <br>
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button type="reset" class="btn btn-dark">Cancel</button>
        </form>
    </div>
</div>
@endsection

@push('js')
{{-- <script type='text/javascript'>
  $(window).load(function(){
  $("#instansi").change(function() {
              console.log($("#instansi option:selected").val());
              if ($("#instansi option:selected").val() == 'Lainnya') {
                  $('#identitas').prop('hidden', false);
                  $('#jawaban').prop('value', '');
                  $('#awas').prop('hidden', true);
              } else {
                  $('#identitas').prop('hidden', true);
                  $('#awas').prop('hidden', false);
                  $('#jawaban').prop('value', 'Nomor Induk PNS');
              }
          });
  });
</script>   --}}
@endpush
