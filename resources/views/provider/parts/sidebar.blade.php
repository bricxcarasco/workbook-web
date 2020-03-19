<nav class="mx-auto site-navigation">
    <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
        <li><a href="{{ url('/provider') }}" class="nav-link">Dashboard</a></li>
        <li class="has-children">
            <a href="#">Jobs</a>
            <ul class="dropdown">
                <li><a href="{{ url('/provider/job-listing') }}">Job List</a></li>
                <li><a href="{{ url('/provider/quick-job-list') }}">Quick Job Request List</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ url('/provider/view-applications') }}" class="nav-link">View Applications</a>
        </li>
        <li class="has-children">
            <a href="#">Utilities</a>
            <ul class="dropdown">
                <li><a href="{{ url('/provider/my-profile') }}">My Profile</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ url('/provider/my-schedule') }}" class="nav-link">My Schedule</a>
        </li>

        <li class="d-lg-none"><a href="{{ url('/provider/post-job') }}"><span class="mr-2">+</span> Post a Job</a></li>
        <li class="d-lg-none"><a onclick="event.preventDefault(); document.getElementById('logout-form2').submit();" href="{{ route('logout') }}">Log Out</a></li>
    </ul>

    <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</nav>