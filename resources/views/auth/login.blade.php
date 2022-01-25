<x-guest-layout>
        <section>

            <!-- content -->
            <div class="">
                <!-- login form -->
                <section class="login-form py-md-5 py-3">

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <div class="card card_border p-md-4">
                        <div class="card-body">
                            <!-- form -->
                            <form method="POST" action="{{ route('login') }}" id="loginpage">
                                @csrf
                                <div class="login__header text-center mb-lg-5 mb-4">
                                    <h3 class="login__title mb-2"> Login</h3>
                                    <p>Welcome back, login to continue</p>
                                </div>
                                <div class="d-none alert" id="alert"></div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="input__label">Email</label>
                                    <input type="text" name="email" class="form-control login_text_field_bg input-style" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Email" autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1" class="input__label">Password</label>
                                    <input type="password" class="form-control login_text_field_bg input-style" id="exampleInputPassword1" placeholder="Enter Your Password" name="password" autocomplete="current-password">
                                </div>
                                <div class="form-check check-remember check-me-out">
                                    <input type="checkbox" class="form-check-input checkbox" id="remember_me" name="remember">
                                    <label class="form-check-label checkmark" for="remember_me">Remember
                                        me</label>
                                </div>
                                <div class="d-flex align-items-center flex-wrap justify-content-between">
                                    <button type="submit" class="btn btn-primary btn-style mt-4">Login now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>

            </div>
            <!-- //content -->
        </section>

        @push('scripts')
        <script>
            $("#loginpage").submit(function(e){
                $("#alert").removeClass("alert-success").removeClass("alert-danger").addClass("alert-warning").removeClass("d-none").html('Loading...');
                e.preventDefault();


                $.ajax({
                    url: "{{ route('login') }}",
                    type: "POST",
                    data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    contentType: false, // The content type used when sending data to the server.
                    cache: false, // To unable request pages to be cached
                    processData: false, // To send DOMDocument or non processed data file it is set  to false
                    success: function(result)
                    {
                        localStorage.setItem("token",result.data.token);
                        window.location.href = "/dashboard"
                    },
                    error: function(result)
                    {
                        const errors = JSON.parse(result.responseText).errors;
                        if( 'email' in errors){
                            $("#alert").removeClass("alert-success").addClass("alert-danger").removeClass("alert-warning").removeClass("d-none").html(JSON.parse(result.responseText).errors.email[0]);
                        }else{
                            $("#alert").removeClass("alert-success").addClass("alert-danger").removeClass("alert-warning").removeClass("d-none").html(JSON.parse(result.responseText).errors.password[0]);
                        }
                    }
                });

                setTimeout(
                    function(){
                        $("#alert").removeClass("alert-success").removeClass("alert-danger").removeClass("alert-warning").addClass("d-none").html('');
                    },5000);
            });
        </script>
        @endpush
</x-guest-layout>
