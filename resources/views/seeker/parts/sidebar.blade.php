<nav class="mx-auto site-navigation">
    <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
        <li><a href="{{ url('/seeker') }}" class="nav-link">Dashboard</a></li>
        <li>
            <a href="{{ url('/seeker/find-jobs') }}" class="nav-link">Find Jobs</a>
        </li>
        <li><a href="{{ url('/seeker/ongoing-applications') }}" class="nav-link">My Applications</a></li>
        <li class="has-children">
            <a href="#">Utilities</a>
            <ul class="dropdown">
                <li><a href="{{ url('/seeker/my-profile') }}">My Profile</a></li>
                <li><a href="{{ url('/seeker/my-calendar') }}">My Calendar</a></li>
            </ul>
        </li>
        <li class="d-lg-none"><a onclick="event.preventDefault(); document.getElementById('logout-form2').submit();" href="{{ route('logout') }}">Log Out</a></li>
    </ul>

    <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</nav>