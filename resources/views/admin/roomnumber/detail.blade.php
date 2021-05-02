@extends('layouts.backend.app')

@section('title', 'Bed Detail -')

@push('css')
    
@endpush

@section('content')
<div class="content-wrapper">
    <div class="container">
        <h1 class="display-3">Room {{ $roomnumber->name }} Data
            @if($roomnumber->req_status == 1)
                <sup><span class="badge badge-pill badge-primary" style="font-size: 15px;">Active<span></sup>
            @elseif ($roomnumber->req_status == 0)
                @if ($roomnumber->room_number_id == NULL)
                    <sup><span class="badge badge-pill badge-primary" style="font-size: 15px;">Create Request<span></sup>
                @elseif ($roomnumber->status == !NULL)
                    <sup><span class="badge badge-pill badge-warning" style="font-size: 15px;">Edit Request<span></sup>
                @else
                    <sup><span class="badge badge-pill badge-danger" style="font-size: 15px;">Delete Request<span></sup>
                @endif
            @elseif($roomnumber->req_status == 2)
                <sup><span class="badge badge-pill badge-success" style="font-size: 15px;">Confirmed<span></sup>
                    @if ($roomnumber->status == 'Create Req.')
                        <sup><span class="badge badge-pill badge-primary" style="font-size: 15px;">Create Request<span></sup>
                    @elseif ($roomnumber->status == 'Edit Req.')
                        <sup><span class="badge badge-pill badge-warning" style="font-size: 15px;">Edit Request<span></sup>
                    @elseif ($roomnumber->status == 'Delete Req.')
                        <sup><span class="badge badge-pill badge-danger" style="font-size: 15px;">Delete Request<span></sup>
                    @endif
            @elseif($roomnumber->req_status == 9)
                <sup><span class="badge badge-pill badge-danger" style="font-size: 15px;">Rejected<span></sup>
                    @if ($roomnumber->status == 'Create Req.')
                        <sup><span class="badge badge-pill badge-primary" style="font-size: 15px;">Create Request<span></sup>
                    @elseif ($roomnumber->status == 'Edit Req.')
                        <sup><span class="badge badge-pill badge-warning" style="font-size: 15px;">Edit Request<span></sup>
                    @elseif ($roomnumber->status == 'Delete Req.')
                        <sup><span class="badge badge-pill badge-danger" style="font-size: 15px;">Delete Request<span></sup>
                    @endif
            @endif
        </h1>
        <hr class="mb-3 garis">

        <div class="display-5">
        Room Number: {{ $roomnumber->name }} <br>
        Room: {{ $roomnumber->room->class->name }} ({{ $roomnumber->room->bed->name }}) <br>
        @if ($roomnumber->req_status == 1)
        Room Status: 
            @if ($roomnumber->status == 1)
                <span class="badge badge-pill badge-success" style="font-size: 15px;">Active</span>
            @elseif ($roomnumber->status == 0)
                <span class="badge badge-pill badge-danger" style="font-size: 15px;">Booked</span>
            @elseif ($roomnumber->status == 9)
                <span class="badge badge-pill badge-info" style="font-size: 15px;">Non-Active</span>
            @endif <br>
        @endif
        Last Updated By: {{ $roomnumber->user->name }} <br>
        Created Time: {{ $roomnumber->created_at->format('d-m-Y - H:i:s') }} <br>
        @if ($roomnumber->req_status == 1)
            Updated Time: {{ $roomnumber->updated_at->format('d-m-Y - H:i:s') }}
        @elseif ($roomnumber->req_status == 2)
            @if ($roomnumber->status == 'Create Req.')
                Accepted for Create Req: {{ $roomnumber->updated_at->format('d-m-Y - H:i:s') }}
            @elseif ($roomnumber->status == 'Edit Req.')
                Accepted for Edit Req: {{ $roomnumber->updated_at->format('d-m-Y - H:i:s') }}
            @elseif ($roomnumber->status == 'Delete Req.')
                Accepted for Delete Req: {{ $roomnumber->updated_at->format('d-m-Y - H:i:s') }}
            @endif  
        @elseif ($roomnumber->req_status == 9)
            @if ($roomnumber->status == 'Create Req.')
                Rejected for Create Req: {{ $roomnumber->updated_at->format('d-m-Y - H:i:s') }}
            @elseif ($roomnumber->status == 'Edit Req.')
                Rejected for Edit Req: {{ $roomnumber->updated_at->format('d-m-Y - H:i:s') }}
            @elseif ($roomnumber->status == 'Delete Req.')
                Rejected for Delete Req: {{ $roomnumber->updated_at->format('d-m-Y - H:i:s') }}
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