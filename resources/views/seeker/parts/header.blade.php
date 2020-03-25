<!-- NAVBAR -->
<header class="site-navbar mt-3">
    <div class="container-fluid">
        <div class="row align-items-center">
        <div class="site-logo col-6"><a href="{{ url('/seeker') }}">WorkBook</a></div>

        @include('seeker.parts.sidebar', ['chat_counts' => $chat_counts, 'profile' => $profile])
        
        <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
            <div class="ml-auto">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>Log Out</a>
            </div>
            <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3"><span class="icon-menu h3 m-0 p-0 mt-2"></span></a>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        </div>
    </div>
</header>