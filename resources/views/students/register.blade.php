<link rel="stylesheet" href="{{ voyager_asset('css/app.css') }}">
<div class="container">
    <div class="bg-info" id="main-container"
         style="margin-bottom: 10px;display: flex; justify-content: space-between; align-items: center; padding: 5px; flex-wrap: wrap;">
        <div id="left-side-div" style="flex: 1; display: flex; align-items: center;">
            <h3 class="mb-0">
                <img src="{{asset('img/logo.png')}}" style="width:80px;height:80px;"/> Class XI Admission System 2025
            </h3>

        </div>

        <div id="right-side-div" style="flex: 1; display: flex; justify-content: flex-end;">
            Already registered? &nbsp;
            <a href="{{ route('voyager.login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline"><input
                        type="button" value="Login"/> </a> &nbsp;

        </div>
    </div>
    <hr>
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
    <form class="col-md-4" method="POST" action="{{ route('student.register.verify') }}">
        @csrf
        <div class="form-group">
            <label for="board_name">SSC/Dakhil/Equivalent Board</label>
            <select class="form-control" name="board_name" id="board_name">
                <option value="Dhaka">Dhaka</option>
                <option value="Chittagong">Chittagong</option>
                <option value="Rajshahi">Rajshahi</option>
                <option value="Comilla">Comilla</option>
                <option value="Barisal">Barisal</option>
                <option value="Jessore">Jessore</option>
                <option value="Mymensingh">Mymensingh</option>
                <option value="Sylhet">Sylhet</option>
                <option value="Dinajpur">Dinajpur</option>
                <option value="Madrasah">Madrasah</option>
                <option value="Technical">Technical</option>
            </select>
        </div>
        <div class="form-group">
            <label for="ssc_group">SSC/Dakhil/Equivalent Group</label>
            <select class="form-control" name="ssc_group" id="ssc_group">
                <option value="Science">Science</option>
                <option value="Business Studies">Business Studies</option>
                <option value="Humanities">Humanities</option>
            </select>
        </div>
        <div class="form-group">
            <label for="roll">SSC/Dakhil/Equivalent Exam Roll</label>
            <input type="number" name="roll" id="roll" placeholder="SSC/Dakhil/Equivalent Roll Number" class="form-control"
                   required>
        </div>
        <div class="form-group">
            <label for="ssc_group">HSC Group</label>
            <select class="form-control" name="ssc_group" id="hsc_group">
                <option value="Science">Science</option>
                <option value="Business Studies">Business Studies</option>
                <option value="Humanities">Humanities</option>
            </select>
        </div>
        {{--<div class="form-group">--}}
        {{--<label for="registration_number">Registration Number</label>--}}
        {{--<input type="text" name="registration"  placeholder="Registration Number"  id="registration_number" class="form-control" required>--}}
        {{--</div>--}}
        <div class="form-group">
            <label for="mobile">Mobile Number (11 Digit. Example- 01712345678)</label>
            {{--<br>--}}
            {{--**This mobile number used in HSC admission system--}}
            <input type="number" name="mobile" id="mobile" class="form-control" placeholder="Mobile Number" required>
        </div>
        <div class="form-group">
            <label for="password">Password (Minimum Length 6)</label>
            <div class="input-group">
                <input type="password" name="password" id="password" placeholder="Password" class="form-control"
                       minlength="6" required>
                <button type="button" id="togglePassword" class="btn btn-outline-secondary">
                    Show
                </button>
            </div>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Retype Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Retype Password"
                   class="form-control" required>
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
