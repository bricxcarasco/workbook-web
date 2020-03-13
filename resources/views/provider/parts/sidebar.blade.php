<nav class="mx-auto site-navigation">
    <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
        <li><a href="{{ url('/provider') }}" class="nav-link">Dashboard</a></li>
        <li class="has-children">
            <a href="#">My Account</a>
            <ul class="dropdown">
                <li><a href="{{ url('/provider/job-listing') }}">Job Listing</a></li>
                <li><a href="{{ url('/provider/new-job-listing') }}">New Job Listing</a></li>
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
            <a href="{{ url('/provider/quick-job-request') }}" class="nav-link">Quick Job Request</a>
        </li>
        <li>
            <a href="{{ url('/provider/my-schedule') }}" class="nav-link">My Schedule</a>
        </li>


        <li class="d-lg-none"><a href="{{ url('/provider/post-job') }}"><span class="mr-2">+</span> Post a Job</a></li>
        <li class="d-lg-none"><a href="{{ url('/provider') }}">Log Out</a></li>
    </ul>
</nav>