<x-app-layout>
    <div class="se-pre-con"></div>
    <section>
        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- header --}}
        @include('layouts.header')

        <!-- main content start -->
        <div class="main-content">

            <!-- content -->
            <div class="container-fluid content-top-gap">

                <!-- breadcrumbs -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb my-breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Forms</li>
                    </ol>
                </nav>
                <!-- //breadcrumbs -->

                <!-- statistics data -->
                <div class="statistics">
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card card_border p-4">
                                <h3 class="card__title position-absolute">All Orders Info</h3>
                                <div class="d-none alert" id="alert"></div>
                                <div class="table-responsive">
                                    <table id="example" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Customer Name</th>
                                                <th>Customer Address</th>
                                                <th>Booking service</th>
                                                <th>Booking Price</th>
                                                <th>Booking Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders ?? '' as $order)
                                                <tr>
                                                    <th>#</th>
                                                    <td>@if ($order->customer_id){{ $order->customer_id->name }}@endif</td>
                                                    <td>@if ($order->customer_id){!! $order->customer_id->address !!}@endif</td>
                                                    <td>{{ $order->service_id->name }}</td>
                                                    <td>{{ $order->price }}</td>
                                                    <td>
                                                        @if ($order->status == 1)
                                                        <span class="text-success">Confirm</span>
                                                        @else
                                                        
                                                        @if ($order->status == 0)
                                                        <button type="button" class="btn btn-success btn-style mt-4"
                                                            onclick="changestatus({{ $order->id }},1)"
                                                            title="Active">Confirm</button>
                                                                {{-- <button type="button"
                                                                    class="btn btn-warning btn-style mt-4"
                                                                    onclick="changestatus({{ $order->id }},1)"
                                                                    title="Under Process">Process</button> --}}
                                                                    <button type="button"
                                                                        class="btn btn-danger btn-style mt-4"
                                                                        onclick="changestatus({{ $order->id }},-1)"
                                                                        title="Deactive">Cancelled</button>
                                                            @else
                                                            <span class="text-danger">Cancelled</span>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <button onclick="deleteorderdata({{ $order->id }})"
                                                                class="btn btn-danger btn-style m-2"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- main content end-->
    </section>

    @include('layouts.footer')

    <!-- move top -->
    <button onclick="topFunction()" id="movetop" class="bg-primary" title="Go to top">
        <span class="fa fa-angle-up"></span>
    </button>

    @push('scripts')

        <!-- data tables js -->
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            });

            // deleteorder


            function deleteorderdata(id) {

                $("#alert").removeClass("alert-success").removeClass("alert-danger").addClass("alert-warning")
                    .removeClass("d-none").html('Loading...');

                $.ajax({
                    url: "api/deleteorder",
                    type: "POST",
                    data: {
                        "id": id
                    },
                    headers: {
                        "Authorization": 'Bearer ' + localStorage.getItem('token')
                    }
                }).done(function(result) {
                    $("#alert").removeClass("alert-danger").addClass("alert-success")
                        .removeClass("alert-warning").removeClass("d-none").html(result.data);

                    setTimeout(function() {
                        window.location.href = window.location.href;
                    });
                    // console.log(result);

                }).fail(function(result) {

                    $("#alert").removeClass("alert-success").addClass("alert-danger")
                        .removeClass("alert-warning").removeClass("d-none").html(JSON.parse(result.responseText)
                        .errors);

                });

            }



            function changestatus(id, status) {

                $("#alert").removeClass("alert-success").removeClass("alert-danger").addClass("alert-warning")
                    .removeClass("d-none").html('Loading...');

                $.ajax({
                    url: "{{ url('api/order-confirm') }}",
                    type: "POST",
                    data: {
                        "order_id": id,
                        "status": status
                    },
                    headers: {
                        "Authorization": 'Bearer ' + localStorage.getItem('token')
                    },
                    success: function(result) {
                        $("#alert").removeClass("alert-danger").addClass("alert-success")
                            .removeClass("alert-warning").removeClass("d-none").html(result.data);
                        setTimeout(function() {
                            window.location.href = window.location.href;
                        });
                    },
                    error: function(result) {

                        const errors = JSON.parse(result.responseText).data;

                        console.log(errors);

                        if ('name' in errors) {
                            $("#alert").removeClass("alert-success").addClass("alert-danger").removeClass(
                                "alert-warning").removeClass("d-none").html(errors.name[0]);
                        } else {
                            if ('description' in errors) {
                                $("#alert").removeClass("alert-success").addClass("alert-danger")
                                    .removeClass("alert-warning").removeClass("d-none").html(errors.description[0]);
                            } else {
                                if ('image' in errors) {
                                    $("#alert").removeClass("alert-success").addClass("alert-danger")
                                        .removeClass("alert-warning").removeClass("d-none").html(errors.image[0]);
                                }
                            }
                        }


                    }
                });

            }
        </script>
    @endpush

</x-app-layout>
