<!-- NAVBAR -->
<header class="site-navbar mt-3">
    <div class="container-fluid">
        <div class="row align-items-center">
        <div class="site-logo col-6"><a href="{{ url('/provider') }}"><img align="middle" style="width: 50px; height: 50px; float: left;" src="{{ asset('images/workbook.png') }}" alt="Workbook"> WorkBook</a></div>

        @include('provider.parts.sidebar', ['chat_counts' => $chat_counts, 'profile' => $profile])
        
        <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
            <div class="ml-auto">
            <a href="{{ url('/provider/quick-job-request') }}" class="btn btn-outline-white border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-add"></span>Quick Job Request</a>
            <a href="{{ url('/provider/post-job') }}" class="btn btn-outline-white border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-add"></span>Post Job</a>
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