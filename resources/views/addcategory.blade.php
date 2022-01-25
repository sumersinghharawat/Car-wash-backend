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
                    <h3>Add Category<span></span></h3>
                </div>
                <div class="card-body">
                    <form method="post" id="addcategory" enctype="multipart/form-data">
                        @if (!empty($singlecategory))
                            <input type="hidden" value="{{ $singlecategory->id }}" name="id">
                        @endif
                        <div class="d-none alert" id="alert"></div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label input__label">Parent</label>
                            <div class="col-sm-9">
                                <select class="form-control input-style" id="parent_category" name="parent">
                                    <option value="">Select a Parent Category</option>
                                    @foreach ($categories as $cat)
                                        <option @if (!empty($singlecategory) && $cat->id === $singlecategory->parent_id)
                                            selected
                                        @endif value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label input__label">Category Thumbnail</label>
                            <div class="col-sm-9 row">
                                <div class="uploadOuter col-8">
                                    <span class="dragBox" >
                                      Darg and Drop image here
                                    <input type="file" onChange="dragNdrop(event)" name="image" ondragover="drag()" ondrop="drop()" id="uploadFile"  />
                                    </span>
                                </div>
                                <div id="preview" class="col-4">
                                   @if (!empty($singlecategory) && $singlecategory->category_image != null)
                                        <img src="{{ $singlecategory->category_image }}" class="img-fluid"/>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label input__label">Category Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-style" value="@if (!empty($singlecategory)){{ $singlecategory->category_name }} @endif" name="name" id="inputEmail3"
                                    placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label input__label">Category Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control input-style" name="description" placeholder="Enter Description">@if (!empty($singlecategory)) {{ $singlecategory->category_description }} @endif</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">Status Of Category</div>
                            <div class="col-sm-9">
                                <div class="form-check">
                                    <input class="form-check-input" name="status" value="1" @if (!empty($singlecategory) && $singlecategory->category_status == 1)
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
            $("#addcategory").submit(function(e){

                e.preventDefault();

                $("#alert").removeClass("alert-success").removeClass("alert-danger").addClass("alert-warning").removeClass("d-none").html('Loading...');
                $.ajax({
                    url: "{{ url('api/addcategory') }}",
                    type: "POST",
                    data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    contentType: false, // The content type used when sending data to the server.
                    cache: false, // To unable request pages to be cached
                    processData: false, // To send DOMDocument or non processed data file it is set  to false
                    headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')}
                    })
                    .done( function(result){
                        $("#alert").removeClass("alert-danger").addClass("alert-success")
                                        .removeClass("alert-warning").removeClass("d-none").html(result.data);
                        setTimeout(function(){
                            window.location.href = window.location.href;
                        },1000);
                    })
                    .fail( function(result)
                    {

                        const errors = JSON.parse(result.responseText).data;

                            if ('name' in errors){
                                $("#alert").removeClass("alert-success").addClass("alert-danger").removeClass("alert-warning").removeClass("d-none").html(errors.name[0]);
                            }else{
                                if ('description' in errors){
                                    $("#alert").removeClass("alert-success").addClass("alert-danger").removeClass("alert-warning").removeClass("d-none").html(errors.description[0]);
                                } else{
                                    if ('image' in errors){
                                        $("#alert").removeClass("alert-success").addClass("alert-danger").removeClass("alert-warning").removeClass("d-none").html(errors.image[0]);
                                    }
                                }
                            }


                    })
                });
        </script>
    @endpush

</x-app-layout>
