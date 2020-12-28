@extends('layouts.backend.app')

@section('title', 'Class Image Index -')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <h2 class="mt-1 mb-2">Class Image Request</h2>
        <hr class="mb-3 garis">

        <button type="button" class="btn btn-primary mb-4">
          <a href="{{ route('receptionist.class.index') }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-eye btn-icon-prepend"></i> Look Class Index</a> 
        </button>

        <div class="card mb-4">
          <div class="card-header bg-primary">
            Your Active Request
          </div>
          <div class="card-body" style="background-color: #8cbae3">
            @if ($classes->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_id">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Image </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($classes as $key=>$class)
                      <tr class="text-black">
                        <td> {{ $key + 1 }} </td>
                        <td> {{ $class->name }} </td>
                        <td>
                          @if ($class->image == NULL)
                            No Image
                          @else
                            <a href="{{ route('receptionist.class.show',$class->id) }}"><img src="{{ asset('storage/class/'.$class->image) }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $class->name }}" title="Lihat Gambar {{ $class->name }}"></a>
                          @endif
                        </td>
                        <td> 
                          <a href="{{ route('receptionist.class.show',$class->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $class->name }}"><i class="mdi mdi-eye"></i></a>   
                          <a href="{{ route('receptionist.class.edit',$class->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Request Edit {{ $class->name }}"><i class="mdi mdi-pencil"></i></a>  
                          <a href="{{ route('receptionist.class.image-request.edit',$class->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Request Edit Image {{ $class->name }}"><i class="mdi mdi-image-broken"></i></a>
                          <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="deleteBed({{ $class->id }})" data-toggle="tooltip" data-placement="bottom" title="Request Delete {{ $class->name }}">
                            <i class="mdi mdi-close"></i>
                          </button>
                          <form id="delete-form-{{ $class->id }}" action="{{ route('receptionist.class.requestdelete',$class->id) }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <center class="text-black">No Any Request, <a href="{{ route('receptionist.class.index') }}" class="text-black">Request Here</a></center>
            @endif
          </div>
        </div>    
        
        <div class="card mb-4">
          <div class="card-header bg-info">
            Your Recent Request, Wait For Confirmed
          </div>
          <div class="card-body" style="background-color: #c39aef">
            @if ($class_request->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_idd">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Image </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($class_request as $key=>$class)
                      <tr class="text-black">
                        <td> {{ $key + 1 }} </td>
                        <td> {{ $class->name }} || 
                            <strong class="text-success">Wait for Confirmed. Thanks for Request :))</strong>
                        </td>
                        <td>
                          @if ($class->image == NULL)
                            No Image
                          @else
                            <a href="{{ route('receptionist.class.show',$class->id) }}"><img src="{{ asset('storage/class/'.$class->image) }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $class->name }}" title="Lihat Gambar {{ $class->name }}"></a>
                          @endif
                        </td>
                        <td> <a href="{{ route('receptionist.class.show',$class->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $class->name }}"><i class="mdi mdi-eye"></i></a> </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <center class="text-black">No Any Request, <a href="{{ route('receptionist.class.index') }}" class="text-black">Request Here</a></center>
            @endif
          </div>
        </div>

        <div class="card mb-4">
          <div class="card-header bg-success">
            Your Recent Accepted Request
          </div>
          <div class="card-body" style="background-color: #99f2a0">
            @if ($class_accepted->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_iddd">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Image </th>
                      <th> Info </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($class_accepted as $key=>$class)
                      <tr class="text-black">
                        <td> {{ $key + 1 }} </td>
                        <td> {{ $class->name }} || 
                            <strong class="text-success">Thanks for Request :))</strong>
                        </td>
                        <td>
                          @if ($class->image == NULL)
                            No Image
                          @else
                            <a href="{{ route('receptionist.class.show',$class->id) }}"><img src="{{ asset('storage/class/request/'.$class->image) }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $class->name }}" title="Lihat Gambar {{ $class->name }}"></a>
                          @endif
                        </td>
                        <td> <a href="{{ route('receptionist.class.show',$class->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $class->name }}"><i class="mdi mdi-eye"></i></a> </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <center class="text-black">No Any Request, <a href="{{ route('receptionist.class.index') }}" class="text-black">Request Here</a></center>
            @endif
          </div>
        </div>

        <div class="card mb-4">
          <div class="card-header bg-danger">
            Your Recent Canceled Request
          </div>
          <div class="card-body" style="background-color: #e69999">
            @if ($class_canceled->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_idddd">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Image </th>
                      <th> Info </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($class_canceled as $key=>$class)
                      <tr class="text-black">
                        <td> {{ $key + 1 }} </td>
                        <td> {{ $class->name }} || 
                            <strong class="text-success">Thanks for Request :))</strong>
                        </td>
                        <td>
                          @if ($class->image == NULL)
                            No Image
                          @else
                            <a href="{{ route('receptionist.class.show',$class->id) }}"><img src="{{ asset('storage/class/request/'.$class->image) }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $class->name }}" title="Lihat Gambar {{ $class->name }}"></a>
                          @endif
                        </td>
                        <td> <a href="{{ route('receptionist.class.show',$class->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $class->name }}"><i class="mdi mdi-eye"></i></a> </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <center class="text-black">No Any Request, <a href="{{ route('receptionist.class.index') }}" class="text-black">Request Here</a></center>
            @endif
          </div>
        </div>
    </div>
</div>
@endsection