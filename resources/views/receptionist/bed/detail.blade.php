@extends('layouts.backend.app')

@section('title', 'Bed Detail -')

@push('css')
    
@endpush

@section('content')
<div class="content-wrapper">
    <div class="container">
        <h1 class="display-3">{{ $bed->name }} Bed Data
            @if (Auth::user()->id == $bed->user_id)
                <sup><span class="badge badge-pill badge-info" style="font-size: 15px;">Your Request<span></sup>
            @endif
            @if($bed->status == 1)
                <sup><span class="badge badge-pill badge-primary" style="font-size: 15px;">Active<span></sup>
            @elseif ($bed->status == 0)
                @if ($bed->bed_id == NULL)
                    <sup><span class="badge badge-pill badge-primary" style="font-size: 15px;">Create Request<span></sup>
                @elseif ($bed->slug == !NULL)
                    <sup><span class="badge badge-pill badge-warning" style="font-size: 15px;">Edit Request<span></sup>
                @else
                    <sup><span class="badge badge-pill badge-danger" style="font-size: 15px;">Delete Request<span></sup>
                @endif
            @elseif($bed->status == 2)
                <sup><span class="badge badge-pill badge-success" style="font-size: 15px;">Confirmed<span></sup>
                    @if ($bed->slug == 'Create Req.')
                        <sup><span class="badge badge-pill badge-primary" style="font-size: 15px;">Create Request<span></sup>
                    @elseif ($bed->slug == 'Edit Req.')
                        <sup><span class="badge badge-pill badge-warning" style="font-size: 15px;">Edit Request<span></sup>
                    @elseif ($bed->slug == 'Delete Req.')
                        <sup><span class="badge badge-pill badge-danger" style="font-size: 15px;">Delete Request<span></sup>
                    @endif
            @elseif($bed->status == 9)
                <sup><span class="badge badge-pill badge-danger" style="font-size: 15px;">Rejected<span></sup>
                    @if ($bed->slug == 'Create Req.')
                        <sup><span class="badge badge-pill badge-primary" style="font-size: 15px;">Create Request<span></sup>
                    @elseif ($bed->slug == 'Edit Req.')
                        <sup><span class="badge badge-pill badge-warning" style="font-size: 15px;">Edit Request<span></sup>
                    @elseif ($bed->slug == 'Delete Req.')
                        <sup><span class="badge badge-pill badge-danger" style="font-size: 15px;">Delete Request<span></sup>
                    @endif
            @endif
        </h1>
        <hr class="mb-3 garis">

        <div class="display-5">
        Name: {{ $bed->name }} <br>
        Amount of Person: {{ $bed->person }} <br>
        Last Updated By: {{ $bed->user->name }} <br>
        Created Time: {{ $bed->created_at->format('d-m-Y - H:i:s') }} <br>
        @if ($bed->status == 1)
            Updated Time: {{ $bed->updated_at->format('d-m-Y - H:i:s') }}
        @elseif ($bed->status == 2)
            @if ($bed->slug == 'Create Req.')
                Accepted for Create Req: {{ $bed->updated_at->format('d-m-Y - H:i:s') }}
            @elseif ($bed->slug == 'Edit Req.')
                Accepted for Edit Req: {{ $bed->updated_at->format('d-m-Y - H:i:s') }}
            @elseif ($bed->slug == 'Delete Req.')
                Accepted for Delete Req: {{ $bed->updated_at->format('d-m-Y - H:i:s') }}
            @endif  
        @elseif ($bed->status == 9)
            @if ($bed->slug == 'Create Req.')
                Rejected for Create Req: {{ $bed->updated_at->format('d-m-Y - H:i:s') }}
            @elseif ($bed->slug == 'Edit Req.')
                Rejected for Edit Req: {{ $bed->updated_at->format('d-m-Y - H:i:s') }}
            @elseif ($bed->slug == 'Delete Req.')
                Rejected for Delete Req: {{ $bed->updated_at->format('d-m-Y - H:i:s') }}
            @endif
        @endif <br>
    </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    function deleteClass(id) {
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