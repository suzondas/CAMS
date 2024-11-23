<link rel="stylesheet" href="{{ voyager_asset('css/app.css') }}">
    <div class="container">

        <!-- Display Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    <!-- Display Error Messages -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h2>Student Registration</h2>

        <form class="col-md-4" method="POST" action="{{ route('student.register.verify') }}">
            @csrf
            <div class="form-group">
                <label for="ssc_roll">SSC/Dakhil Exam Roll</label>
                <input type="text" name="ssc_roll" id="ssc_roll" placeholder="SSC/Dakhil Roll Number"  class="form-control" required>
            </div>
            <div class="form-group">
                <label for="registration_number">Registration Number</label>
                <input type="text" name="registration_number"  placeholder="Registration Number"  id="registration_number" class="form-control" required>
            </div>
            {{--<div class="form-group">--}}
                {{--<label for="mobile">Mobile Number (11 Digit. Example- 017xxxxxxxx)</label><br>--}}
                {{--**This mobile number used in HSC admission system--}}
                {{--<input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile Number" required>--}}
            {{--</div>--}}
            <div class="form-group">
                <label for="password">Password (Minimum Length 6)</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" placeholder="Password"  class="form-control" minlength="6" required>
                    <button type="button" id="togglePassword" class="btn btn-outline-secondary">
                        Show
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Retype Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"  placeholder="Retype Password"  class="form-control" required>
            </div>

            <div id="passwordError" class="text-danger" style="display: none;">
                Passwords do not match!
            </div>

            <button type="submit" class="btn btn-primary">Send OTP</button>
        </form>
    </div>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", () => {
        const passwordInput = document.getElementById("password");
        const repasswordInput = document.getElementById("repassword");
        const togglePassword = document.getElementById("togglePassword");
        const passwordError = document.getElementById("passwordError");

        // Toggle password visibility
        togglePassword.addEventListener("click", () => {
            const type = passwordInput.type === "password" ? "text" : "password";
            passwordInput.type = type;
            togglePassword.textContent = type === "password" ? "Show" : "Hide";
        });

        // Validate passwords match
        repasswordInput.addEventListener("input", () => {
            if (repasswordInput.value !== passwordInput.value) {
                passwordError.style.display = "block";
            } else {
                passwordError.style.display = "none";
            }
        });

        passwordInput.addEventListener("input", () => {
            if (repasswordInput.value !== "" && repasswordInput.value !== passwordInput.value) {
                passwordError.style.display = "block";
            } else {
                passwordError.style.display = "none";
            }
        });
    });

</script>
<script src="{{ voyager_asset('js/app.js') }}"></script>
