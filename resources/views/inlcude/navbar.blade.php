<div class="bg-info" id="main-container" style="margin-bottom: 10px;display: flex; justify-content: space-between; align-items: center; padding: 5px; flex-wrap: wrap;">
        <div id="left-side-div" style="flex: 1; display: flex; align-items: center;">
                <h3 class="mb-0">
                        <img src="{{asset('img/logo.png')}}" style="width:80px;height:80px;"/> Class XI Admission System 2025
                </h3>

        </div>

        <div id="right-side-div" style="flex: 1; display: flex; justify-content: flex-end;">
                @auth
                        <h4 class="mb-0">
                                {{ \Illuminate\Support\Facades\Auth::user()->name }} ({{ \Illuminate\Support\Facades\Auth::user()->email }})
                                <a href="{{ url('/student-logout') }}" class="btn btn-warning text-sm text-gray-700 dark:text-gray-500 underline">Logout</a>
                        </h4>
                @else
                        <a href="{{ route('voyager.login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
                @endauth
        </div>
</div>
