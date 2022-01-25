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
                <!-- forms -->
                <section class="forms">
                    <!-- horizontal forms-->
                    <!-- forms 3 -->
                    <div class="card card_border py-2 mb-4">
                        <div class="cards__heading">
                            <h3>Add Employee<span></span></h3>
                        </div>
                        <div class="card-body">
                            <form method="post" id="addemployee" enctype="multipart/form-data">
                                @if (!empty($singleemployee))
                                <input type="hidden" value="{{ $singleemployee->id }}" name="id">
                                @endif
                                <div class="d-none alert" id="alert"></div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label input__label">Employee Photo</label>
                                    <div class="col-sm-9 row">
                                        <div class="uploadOuter col-8">
                                            <span class="dragBox">
                                                Darg and Drop image here
                                                <input type="file" onChange="dragNdrop(event)" name="image" ondragover="drag()" ondrop="drop()" id="uploadFile" />
                                            </span>
                                        </div>
                                        <div id="preview" class="col-4">
                                            @if (!empty($singleemployee) && $singleemployee->profile_image != null)
                                            <img src="{{ $singleemployee->profile_image }}" class="img-fluid" />
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label input__label">Employee Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control input-style" value="@if (!empty($singleemployee)){{ $singleemployee->name }}@endif" name="name" id="inputEmail3" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label input__label">Employee Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control input-style" value="@if (!empty($singleemployee)){{ $singleemployee->email }}@endif" name="email" id="inputEmail3" placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label input__label">Employee Contact</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control input-style" value="@if (!empty($singleemployee)){{ $singleemployee->contact_number }}@endif" name="contact" id="inputEmail3" placeholder="Enter Contact">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label input__label">Employee Time In</label>
                                    <div class="col-sm-9">
                                        <input type="time" class="form-control input-style" value="@if (!empty($singleemployee)){{ $singleemployee->time_in }}@else{{ "09:00:00" }}@endif" value="" name="timein" id="inputEmail3">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label input__label">Employee Time Out</label>
                                    <div class="col-sm-9">
                                        <input type="time" class="form-control input-style" value="@if (!empty($singleemployee)){{ $singleemployee->time_out }}@else{{ "19:00:00" }}@endif" value="" name="timeout" id="inputEmail3">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label input__label">Address</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control input-style" name="address" placeholder="Enter Address">@if (!empty($singleemployee)) {{ $singleemployee->address }} @endif</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3">Status Of Employee</div>
                                    <div class="col-sm-9">
                                        <div class="form-check">
                                            <input class="form-check-input" name="status" value="1" @if (!empty($singleemployee) && $singleemployee->status == 1)
                                            checked
                                            @endif type="checkbox" id="gridCheck1">
                                            <label class="form-check-label" for="gridCheck1">
                                                Do you want to active this category?
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary btn-style">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- //forms 3 -->
                    <!-- //horizontal forms-->

                    <!-- supported elements -->

                </section>

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
    <script>
        $("#addemployee").submit(function(e) {

            e.preventDefault();

            $("#alert").removeClass("alert-success").removeClass("alert-danger").addClass("alert-warning").removeClass("d-none").html('Loading...');
            $.ajax({
                    url: "@if (empty($singleemployee)) {{ url('api/addemployee') }} @else {{ url('api/updateemployee') }} @endif",
                    type: "POST",
                    data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    contentType: false, // The content type used when sending data to the server.
                    cache: false, // To unable request pages to be cached
                    processData: false, // To send DOMDocument or non processed data file it is set  to false
                    headers: {
                        "Authorization": 'Bearer ' + localStorage.getItem('token')
                    }
                })
                .done(function(result) {
                    $("#alert").removeClass("alert-danger").addClass("alert-success")
                        .removeClass("alert-warning").removeClass("d-none").html(result.data);
                    setTimeout(function() {
                        window.location.href = window.location.href;
                    }, 1000);
                })
                .fail(function(result) {
                    const errors = JSON.parse(result.responseText).data;

                    if ('name' in errors) {
                        $("#alert").removeClass("alert-success").addClass("alert-danger").removeClass("alert-warning").removeClass("d-none").html(errors.name[0]);
                        stopPropagation();
                    }
                    if ('email' in errors) {
                        $("#alert").removeClass("alert-success").addClass("alert-danger").removeClass("alert-warning").removeClass("d-none").html(errors.email[0]);
                        stopPropagation();
                    }
                    if ('address' in errors) {
                        $("#alert").removeClass("alert-success").addClass("alert-danger").removeClass("alert-warning").removeClass("d-none").html(errors.address[0]);
                        stopPropagation();
                    }
                    if ('contact' in errors) {
                        $("#alert").removeClass("alert-success").addClass("alert-danger").removeClass("alert-warning").removeClass("d-none").html(errors.contact[0]);
                        stopPropagation();
                    }
                    if ('timein' in errors) {
                        $("#alert").removeClass("alert-success").addClass("alert-danger").removeClass("alert-warning").removeClass("d-none").html(errors.timein[0]);
                        stopPropagation();
                    }
                    if ('timeout' in errors) {
                        $("#alert").removeClass("alert-success").addClass("alert-danger").removeClass("alert-warning").removeClass("d-none").html(errors.timeout[0]);
                        stopPropagation();
                    }
                })
        });
    </script>
    @endpush

</x-app-layout>