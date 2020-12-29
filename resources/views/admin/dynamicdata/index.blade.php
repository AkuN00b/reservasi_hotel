@extends('layouts.backend.app')

@section('title', 'Dynamic Data Index -')

@push('css')
    
@endpush

@section('content')
<div class="content-wrapper">
    <div class="container">
        <h2 class="mt-1 mb-2">Dynamic Data</h2>
        <hr class="mb-3 garis"> 
        <button type="button" class="btn btn-primary mb-5">
            <a href="{{ route('admin.dynamic-data.create') }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-plus-circle btn-icon-prepend"></i> Create</a> 
        </button>
        <div class="card">
          <div class="card-header" style="background-color: #3c5f8f">
            Dynamic Data List
          </div>
          <div class="card-body" style="background-color: #aec9ef">
            @if ($dynamicdatas->count() > 0)
            <div class="table-responsive">
              <table class="table table-bordered text-nowrap display" id="table_id">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> Value </th>
                    <th> Section </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($dynamicdatas as $key=>$dynamicdata)
                    <tr class="text-black">
                      <td> {{ $key + 1 }} </td>
                      <td> {{ str_limit($dynamicdata->value, 50) }} </td>
                      <td> {{ $dynamicdata->section }} </td>
                      <td> 
                        <a href="{{ route('admin.dynamic-data.edit',$dynamicdata->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="{{ str_limit($dynamicdata->value, 20) }} Data Edit"><i class="mdi mdi-pencil"></i></a>  
                        <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="deleteDynamicData({{ $dynamicdata->id }})" data-toggle="tooltip" data-placement="bottom" title="{{ str_limit($dynamicdata->value, 20) }} Data Delete">
                          <i class="mdi mdi-delete"></i>
                        </button>
                        <form id="delete-form-{{ $dynamicdata->id }}" action="{{ route('admin.dynamic-data.destroy',$dynamicdata->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            @else
              <center class="text-black">No Any Dynamic Data</center>
            @endif
          </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    function deleteDynamicData(id) {
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger mr-2',
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: '<h5 style="color: black;">Are you sure? <br> You wont be able to revert this!</h5>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
            event.preventDefault();
            document.getElementById('delete-form-'+id).submit();
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            '<h5 style="color: black;">Cancelled</h5>',
            '<h5 style="color: black;">Your data is safe :)</h5>',
            'error',
            )
        }
        })
    }
</script>
@endpush