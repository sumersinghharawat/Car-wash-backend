<x-guest-layout>

    <!-- Register form -->
    <section class="register-form py-md-5 py-3">
        <div class="card card_border p-md-4">
            <div class="card-body">
                <!-- form -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="register__header text-center mb-lg-5 mb-4">
                        <h3 class="register__title mb-2"> Signup</h3>
                        <p>Create your account here, and continue </p>
                    </div>
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <div class="form-group">
                        <label for="exampleInputName" class="input__label">Your Name</label>
                        <input type="text" name="name" class="form-control login_text_field_bg input-style"
                            id="exampleInputName" aria-describedby="emailHelp" placeholder="" required="" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="input__label">Email address</label>
                        <input type="email" name="email" class="form-control login_text_field_bg input-style"
                            id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="input__label">Password</label>
                        <input type="password" name="password" class="form-control login_text_field_bg input-style"
                            id="exampleInputPassword1" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword2" class="input__label">Re-Password</label>
                        <input type="password" name="password_confirmation"
                            class="form-control login_text_field_bg input-style" id="exampleInputPassword2"
                            placeholder="" required>
                    </div>
                    <div class="form-check check-remember check-me-out">
                        <input type="checkbox" class="form-check-input checkbox" id="exampleCheck1">
                        <label class="form-check-label checkmark" for="exampleCheck1">I agree to the
                            <a href="#terms">Terms of service</a> and <a href="#privacy">Privacy policy</a> </label>
                    </div>
                    <div class="d-flex align-items-center flex-wrap justify-content-between">
                        <button type="submit" class="btn btn-primary btn-style mt-4">Create Account</button>
                        <p class="signup mt-4">Already have an account? <a href="{{ route('login') }}" class="signuplink">Login
                            </a>
                        </p>
                    </div>
                </form>
                <!-- //form -->
            </div>
        </div>
    </section>
</x-guest-layout>
