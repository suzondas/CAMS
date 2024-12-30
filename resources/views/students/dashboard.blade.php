<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="{{ voyager_asset('css/app.css') }}">

</head>
<body>
<div class="container">
    @if(session('success'))
        <div class="card" style="background: dodgerblue;color:white;font-weight: bold;">
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
    <div class="bg-primary" style="width:75%;padding:5%">

        @if($isApproved==1)
            <h4>Your Application is Approved. Download your application<br>
                <a class="btn btn-success" href="#">Download</a>
            </h4>
        @elseif($isApproved==0)
            <h4>Your Application Approval is Pending <br>
                <a class="btn btn-success" href="{{route('students.view-application')}}">View your Application</a>
            </h4>
        @else
            <h4 style="color:red;font-weight: bold;">There is problem in your Application. Contact with administration<br>
                <a class="btn btn-success" href="{{route('students.view-application')}}">View your Application</a>
            </h4>
        @endif
    </div>

</div>
</body>
</html>