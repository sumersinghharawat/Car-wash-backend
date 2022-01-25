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
                            <h3>Add Serrvice<span></span></h3>
                        </div>
                        <div class="card-body">
                            <form method="post" id="addservice" enctype="multipart/form-data">
                                @if (!empty($singleservice))
                                    <input type="hidden" value="{{ $singleservice->id }}" name="id">
                                @endif
                                <div class="d-none alert" id="alert"></div>
                                <div class="form-group row" id="parent_category_1">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label input__label">Parent
                                        Category</label>
                                    <div class="col-sm-9">
                                        <select class="form-control input-style" id="parent_category" name="category">
                                            <option value="">Select a Parent Category</option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                            @endforeach
                                            @push('scripts')
                                                <script>
                                                    window.addEventListener("load", function() {
                                                        var n = "{{ $singleservice->category[0]->parent_id }}";
                                                        if (parseInt(n) == 0) {
                                                            var n = "{{ $singleservice->category[0]->id }}";
                                                            $('#parent_category').val(n);
                                                        } else {
                                                            $('#parent_category').val(n);
                                                            $('#parent_category').change();
                                                        }
                                                    });
                                                </script>
                                            @endpush
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row" id="parent_category_1">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label input__label">Sub
                                        Category</label>
                                    <div class="col-sm-9">
                                        <select class="form-control input-style" id="sub_category" name="subcategory">
                                            <option value="">Select a Sub Category</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label input__label">Service
                                        Thumbnail</label>
                                    <div class="col-sm-9 row">
                                        <div class="uploadOuter col-8">
                                            <span class="dragBox">
                                                Darg and Drop image here
                                                <input type="file" onChange="dragNdrop(event)" name="image"
                                                    ondragover="drag()" ondrop="drop()" id="uploadFile" />
                                            </span>
                                        </div>
                                        <div id="preview" class="col-4">
                                            @if (!empty($singleservice) && $singleservice->category_image != null)
                                                <img src="{{ $singleservice->category_image }}"
                                                    class="img-fluid" />
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label input__label">Service
                                        Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control input-style"
                                            value="@if (!empty($singleservice)){{ $singleservice->name }} @endif" name="name" id="inputEmail3"
                                            placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label input__label">Service
                                        Price</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control input-style"
                                            value="@if (!empty($singleservice)){{ $singleservice->price }} @endif" name="price" id="inputEmail3"
                                            placeholder="Enter Price">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label input__label">Service
                                        Discount Price</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control input-style"
                                            value="@if (!empty($singleservice)){{ $singleservice->discountprice }} @endif" name="discountprice" id="inputEmail3"
                                            placeholder="Enter Discount Price">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label input__label">Service
                                        Time</label>
                                    <div class="col-sm-9">
                                        <input type="time" class="form-control input-style"
                                            value="@if (!empty($singleemployee)){{ $singleemployee->time }}@else{{ '01:00:00' }}@endif" name="time" id="inputEmail3">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label for="inputPassword3" class="col-form-label input__label">Employee</label>
                                    </div>
                                    <div class="col-sm-9">
                                        @foreach ($employees as $employee)
                                            <div class="form-check">
                                                <input class="form-check-input" name="employee[]"
                                                    value="{{ $employee->id }}" @if (!empty($singleservice) && $singleservice->employee != null)
                                                @foreach ($singleservice->employee as $item)
                                                    @if ($item->id == $employee->id)
                                                    checked
                                                    @endif
                                                @endforeach
                                        @endif
                                        type="checkbox" id="gridCheck{{ $employee->id }}">
                                        <label class="form-check-label" for="gridCheck{{ $employee->id }}">
                                            {{ $employee->name }}
                                            ({{ $employee->time_in . '/' . $employee->time_out }})
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label input__label">Service Short
                                Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control input-style" name="short_description"
                                    placeholder="Enter Short Description">@if (!empty($singleservice)) {{ $singleservice->short_description }} @endif</textarea>
                            </div>
                        </div>
                        <input type="hidden" name="long_description" value="data">
                        {{-- <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label input__label">Service Long
                                        Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control input-style" rows="5" name="long_description"
                                            placeholder="Enter Long Description">@if (!empty($singleservice)) {{ $singleservice->category_description }} @endif</textarea>
                                    </div>
                                    @push('scripts')
                                        <script>
                                            CKEDITOR.replace('long_description');
                                        </script>
                                    @endpush
                                </div> --}}
                        <div class="form-group row">
                            <div class="col-sm-3">Status Of Service</div>
                            <div class="col-sm-9">
                                <div class="form-check">
                                    <input class="form-check-input" name="status" value="1" @if (!empty($singleservice) && $singleservice->status == 1)
                                    checked
                                    @endif type="checkbox" id="gridCheck1">
                                    <label class="form-check-label" for="gridCheck1">
                                        Do you want to active this Service?
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
            $("#parent_category").on("change", function() {
                $.ajax({
                    // var n = this.value;
                    url: "{{ route('api.subcategory', '') }}" + "/" + this.value,
                    headers: {
                        "Authorization": 'Bearer ' + localStorage.getItem('token')
                    }
                }).done(function(subcategaries) {
                    if (subcategaries != null) {
                        // console.log(Object.keys(subcategaries.subcategories).length)
                        var subcategaries_list = '<option value="">Select a Sub Category</option>';
                        for (var i = 0; i < Object.keys(subcategaries.subcategories).length; i++) {
                            subcategaries_list += '<option value="' + subcategaries.subcategories[i].id + '">' +
                                subcategaries.subcategories[i].category_name + '</option>';
                        }
                        $("#sub_category").html(subcategaries_list);

                    } else {
                        var subcategaries_list = '<option value="">Select a Sub Category</option>';
                        $("#sub_category").html(subcategaries_list);
                    }

                    var n = "{{ $singleservice->category[0]->id }}";
                    $('#sub_category').val(n);
                })
            });



            $("#addservice").submit(function(e) {

                e.preventDefault();

                $("#alert").removeClass("alert-success").removeClass("alert-danger").addClass("alert-warning")
                    .removeClass("d-none").html('Loading...');
                $.ajax({
                        url: "{{ route('api.updateservice') }}",
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
                        $("#alert").removeClass("alert-danger").addClass("alert-success")
                            .removeClass("alert-warning").removeClass("d-none").html(result.data);
                        setTimeout(function() {
                            window.location.href = window.location.href;
                        }, 1000);
                    })
                    .fail(function(result) {

                        const errors = JSON.parse(result.responseText).data;

                        if ('name' in errors) {
                            $("#alert").removeClass("alert-success").addClass("alert-danger").removeClass(
                                "alert-warning").removeClass("d-none").html(errors.name[0]);
                        }

                        if ('category' in errors) {
                            $("#alert").removeClass("alert-success").addClass("alert-danger").removeClass(
                                "alert-warning").removeClass("d-none").html(errors.category[0]);
                        }

                        if ('price' in errors) {
                            $("#alert").removeClass("alert-success").addClass("alert-danger").removeClass(
                                "alert-warning").removeClass("d-none").html(errors.price[0]);
                        }

                        if ('discountprice' in errors) {
                            $("#alert").removeClass("alert-success").addClass("alert-danger").removeClass(
                                "alert-warning").removeClass("d-none").html(errors.discountprice[0]);
                        }

                        if ('time' in errors) {
                            $("#alert").removeClass("alert-success").addClass("alert-danger").removeClass(
                                "alert-warning").removeClass("d-none").html(errors.time[0]);
                        }

                        if ('employee' in errors) {
                            $("#alert").removeClass("alert-success").addClass("alert-danger").removeClass(
                                "alert-warning").removeClass("d-none").html(errors.employee[0]);
                        }

                        if ('short_description' in errors) {
                            $("#alert").removeClass("alert-success").addClass("alert-danger").removeClass(
                                "alert-warning").removeClass("d-none").html(errors.short_description[0]);
                        }

                    })
            });
        </script>
    @endpush

</x-app-layout>
