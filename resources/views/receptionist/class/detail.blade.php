@extends('layouts.backend.app')

@section('title', 'Bed Detail -')

@push('css')
    
@endpush

@section('content')
<div class="content-wrapper">
    <div class="container">
        <h1 class="display-3">{{ $class->name }} Class Data
            @if ($class->user_id == NULL)
                @if (Auth::user()->id == $class->user_image_id)
                    <sup><span class="badge badge-pill badge-info" style="font-size: 15px;">Your Image Request<span></sup>
                @endif
            @else
                @if (Auth::user()->id == $class->user_id)
                    <sup><span class="badge badge-pill badge-info" style="font-size: 15px;">Your Request<span></sup>
                @endif
            @endif

            @if ($class->user_image_id == NULL)
                @if($class->status == 1)
                    <sup><span class="badge badge-pill badge-primary" style="font-size: 15px;">Active<span></sup>
                @elseif ($class->status == 0) 
                    @if ($class->class_id == NULL)
                        <sup><span class="badge badge-pill badge-primary" style="font-size: 15px;">Create Request<span></sup>
                    @elseif ($class->slug == !NULL)
                        <sup><span class="badge badge-pill badge-warning" style="font-size: 15px;">Edit Request<span></sup>
                    @else
                        <sup><span class="badge badge-pill badge-danger" style="font-size: 15px;">Delete Request<span></sup>
                    @endif
                @elseif($class->status == 2)
                    <sup><span class="badge badge-pill badge-success" style="font-size: 15px;">Confirmed<span></sup>
                        @if ($class->slug == 'Create Req.')
                            <sup><span class="badge badge-pill badge-primary" style="font-size: 15px;">Create Request<span></sup>
                        @elseif ($class->slug == 'Edit Req.')
                            <sup><span class="badge badge-pill badge-warning" style="font-size: 15px;">Edit Request<span></sup>
                        @elseif ($class->slug == 'Delete Req.')
                            <sup><span class="badge badge-pill badge-danger" style="font-size: 15px;">Delete Request<span></sup>
                        @endif
                @elseif($class->status == 9)
                    <sup><span class="badge badge-pill badge-danger" style="font-size: 15px;">Rejected<span></sup>
                        @if ($class->slug == 'Create Req.')
                            <sup><span class="badge badge-pill badge-primary" style="font-size: 15px;">Create Request<span></sup>
                        @elseif ($class->slug == 'Edit Req.')
                            <sup><span class="badge badge-pill badge-warning" style="font-size: 15px;">Edit Request<span></sup>
                        @elseif ($class->slug == 'Delete Req.')
                            <sup><span class="badge badge-pill badge-danger" style="font-size: 15px;">Delete Request<span></sup>
                        @endif
                @endif
            @endif
        </h1>
        <hr class="mb-3 garis">

        <div class="display-5">
            Name: {{ $class->name }} <br>
            Description: <br> 
            <div style="background-color: rgba(255, 255, 255, 0.532)">{!! $class->desc !!}</div>
            @if ($class->image == NULL)

            @else
                @if ($class->status == 2 || $class->status == 9)
                    Image: <br> <img src="{{ asset('storage/class/request/'.$class->image) }}" alt="Gambar {{ $class->name }}" title="Gambar {{ $class->name }}"> <br><br>    
                @else
                    Image: <br> <img src="{{ asset('storage/class/'.$class->image) }}" alt="Gambar {{ $class->name }}" title="Gambar {{ $class->name }}"> <br><br>    
                @endif
            @endif

            @if($class->user_id == !NULL)
                Last Updated By: {{ $class->user->name }} <br>
            @else
                Last Updated By: {{ $class->user_image->name }} <br>
            @endif
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