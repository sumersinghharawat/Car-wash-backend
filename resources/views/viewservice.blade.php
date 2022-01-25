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
                                <h3 class="card__title position-absolute">All Servies Info</h3>
                                <div class="d-none alert" id="alert"></div>
                                <div class="table-responsive">
                                    <table id="example" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Service Name</th>
                                                <th>Service Short Description</th>
                                                <th>Service Long Description</th>
                                                <th>Service Image</th>
                                                <th>Service Category</th>
                                                <th>Service Employee</th>
                                                <th>Service Discount Price</th>
                                                <th>Service Price</th>
                                                <th>Service Time</th>
                                                <th>Service Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($services as $services)
                                                <tr>
                                                    <th>#</th>
                                                    <td>{{ $services->name }}</td>
                                                    <td>{!!  Str::limit($services->short_description,150) !!}</td>
                                                    <td>{!! $services->long_description !!}</td>
                                                    <td><img src="{{ $services->service_image }}" width="200" /></td>
                                                    <td>{{ $services->category[0]->category_name }}</td>
                                                    <td>
                                                        @if($services->employee != "" && count($services->employee) >=1)
                                                        @foreach ($services->employee as $key=>$item)
                                                            {{ ($key+1).") ".$item->name." (".$item->time_in."/".$item->time_out.")" }}<br/>
                                                        @endforeach
                                                        @endif
                                                    </td>
                                                    <td>₹{{ $services->discountprice }}</td>
                                                    <td>₹{{ $services->price }}</td>
                                                    <td>({{ $services->time }})</td>
                                                    <td>
                                                        @if ($services->status == 1)
                                                            <button type="button" class="btn btn-success btn-style mt-4"
                                                                onclick="changestatus({{ $services->id }},0)"
                                                                title="Active">A</button>
                                                        @else
                                                            <button type="button" class="btn btn-danger btn-style mt-4"
                                                                onclick="changestatus({{ $services->id }},1)"
                                                                title="Deactive">D</button>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="{{ url('editservice') }}/{{ $services->id }}"
                                                                class="btn btn-primary btn-style m-2"><i
                                                                    class="fa fa-pencil"></i></a>
                                                            <button onclick="deleteservicesdata({{ $services->id }})"
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

            function changestatus(id, status) {

                $("#alert").removeClass("alert-success").removeClass("alert-danger").addClass("alert-warning")
                    .removeClass("d-none").html('Loading...');

                $.ajax({
                    url: "{{ url('api/servicestatus') }}",
                    type: "POST",
                    data: {
                        "id": id,
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

            // deletecategory


            function deleteservicesdata(id) {

                $("#alert").removeClass("alert-success").removeClass("alert-danger").addClass("alert-warning")
                    .removeClass("d-none").html('Loading...');

                $.ajax({
                    url: "api/deleteservices",
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

                    const errors = JSON.parse(result.responseText).data;

                    $("#alert").removeClass("alert-success").addClass("alert-danger")
                        .removeClass("alert-warning").removeClass("d-none").html(errors.image[0]);

                });

            }






            $("#addcategory").submit(function(e) {

                e.preventDefault();

                $("#alert").removeClass("alert-success").removeClass("alert-danger").addClass("alert-warning")
                    .removeClass("d-none").html('Loading...');
                $.ajax({
                        url: "{{ url('api/addcategory') }}",
                        type: "POST",
                        data: new FormData(
                        this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false, // To send DOMDocument or non processed data file it is set  to false
                        headers: {
                            "Authorization": 'Bearer ' + localStorage.getItem('token')
                        }
                    })
                    .done(function(result) {
                        console.log(result);
                    }).
                fail(function(result) {
                    console.log(errors);

                    const errors = result.responseText.data;
                    // console.log(errors);

                    if ('name' in errors) {
                        $("#alert").removeClass("alert-success").addClass("alert-danger").removeClass(
                            "alert-warning").removeClass("d-none").html(errors.name[0]);
                    } else {
                        if ('description' in errors) {
                            console.log(errors);
                            $("#alert").removeClass("alert-success").addClass("alert-danger")
                                .removeClass("alert-warning").removeClass("d-none").html(errors.description[0]);
                        } else {
                            if ('image' in errors) {
                                $("#alert").removeClass("alert-success").addClass("alert-danger")
                                    .removeClass("alert-warning").removeClass("d-none").html(errors.image[0]);
                            }
                        }
                    }


                });
            });
        </script>
    @endpush

</x-app-layout>
