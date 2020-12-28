@extends('layouts.backend.app')

@section('title', 'Room Detail -')

@push('css')
    
@endpush

@section('content')
<div class="content-wrapper">
    <div class="container">
        <h1 class="display-3">{{ $room->class->name }}({{ $room->bed->name }}) Room Data
            @if (Auth::user()->id == $room->user_id)
                <sup><span class="badge badge-pill badge-info" style="font-size: 15px;">Your Request<span></sup>
            @endif
            @if($room->status == 1)
                <sup><span class="badge badge-pill badge-primary" style="font-size: 15px;">Active<span></sup>
            @elseif ($room->status == 0)
                @if ($room->room_id == NULL)
                    <sup><span class="badge badge-pill badge-primary" style="font-size: 15px;">Create Request<span></sup>
                @elseif ($room->slug == !NULL)
                    <sup><span class="badge badge-pill badge-warning" style="font-size: 15px;">Edit Request<span></sup>
                @else
                    <sup><span class="badge badge-pill badge-danger" style="font-size: 15px;">Delete Request<span></sup>
                @endif
            @elseif($room->status == 2)
                <sup><span class="badge badge-pill badge-success" style="font-size: 15px;">Confirmed<span></sup>
                    @if ($room->slug == 'Create Req.')
                        <sup><span class="badge badge-pill badge-primary" style="font-size: 15px;">Create Request<span></sup>
                    @elseif ($room->slug == 'Edit Req.')
                        <sup><span class="badge badge-pill badge-warning" style="font-size: 15px;">Edit Request<span></sup>
                    @elseif ($room->slug == 'Delete Req.')
                        <sup><span class="badge badge-pill badge-danger" style="font-size: 15px;">Delete Request<span></sup>
                    @endif
            @elseif($room->status == 9)
                <sup><span class="badge badge-pill badge-danger" style="font-size: 15px;">Rejected<span></sup>
                    @if ($room->slug == 'Create Req.')
                        <sup><span class="badge badge-pill badge-primary" style="font-size: 15px;">Create Request<span></sup>
                    @elseif ($room->slug == 'Edit Req.')
                        <sup><span class="badge badge-pill badge-warning" style="font-size: 15px;">Edit Request<span></sup>
                    @elseif ($room->slug == 'Delete Req.')
                        <sup><span class="badge badge-pill badge-danger" style="font-size: 15px;">Delete Request<span></sup>
                    @endif
            @endif
        </h1>
        <hr class="mb-3 garis">

        <div class="display-5">
        Name: {{ $room->class->name }}({{ $room->bed->name }}) <br>
        Price: @uang($room->price) <br>
        Last Updated By: {{ $room->user->name }} <br>
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