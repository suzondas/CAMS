<link rel="stylesheet" href="{{ voyager_asset('css/app.css') }}">
<div class="container">
    <h2>Student Registration</h2>

    <!-- Display Success Message -->
    @if(session('success'))
        <div class="card" style="background: gray;color:dodgerblue;font-weight: bold;">
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
    <form method="POST" action="{{ route('student.register.verify.otp') }}">
        @csrf
        <div class="form-group">
            <label for="otp">Enter OTP</label>
            <input type="text" name="otp" id="otp" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Verify OTP</button>
    </form>
</div>

<script src="{{ voyager_asset('js/app.js') }}"></script>
