<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/admin') }}" class="nav-link">Dashboard</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">About</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-comments"></i>
          @if ($chat_counts > 0)
            <span class="badge badge-danger navbar-badge">{{ $chat_counts }}</span>
          @endif
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          
          @foreach ($chats as $chat)    
            <a href="#" onClick="chat(this.id)" id="{{ $chat->id }}" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{ asset('dist/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    {{ $chat->name }}
                    @if ($chat->status == 0)
                      <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                    @endif
                  </h3>
                  <p class="text-sm">{{ $chat->message }}</p>
                  <p class="text-sm text-muted"><i class="fas fa-clock mr-1"></i> {{ $chat->created_date }}</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
          @endforeach

          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>

      </li>
      <!-- Notifications Dropdown Menu -->
      {{-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> --}}
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/admin') }}" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">WorkBook</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          {{-- <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image"> --}}
          <img src="https://picsum.photos/50/50" class="img-circle elevation-2" alt="User Image">
          
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ $profile->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="{{ url('/admin') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Manage Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/admin/website-administrators') }}" class="nav-link">
                  <i class="fas fa-sync-alt nav-icon"></i>
                  <p>Website Administrators</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/job-providers') }}" class="nav-link">
                  <i class="fas fa-briefcase nav-icon"></i>
                  <p>Job Providers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/job-seekers') }}" class="nav-link">
                  <i class="fas fa-user-tie nav-icon"></i>
                  <p>Job Seekers</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Manage Listings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/admin/manage-listings-category') }}" class="nav-link">
                  <i class="fas fa-list-ol nav-icon"></i>
                  <p>Listing Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/manage-listings') }}" class="nav-link">
                  <i class="fas fa-list-ul nav-icon"></i>
                  <p>Listings</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-medical-alt"></i>
              <p>
                Manage Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/admin/user-activity') }}" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>User Activity</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/recent-listings') }}" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Recent Listings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/employment-rate') }}" class="nav-link">
                  <i class="fas fa-chart-line nav-icon"></i>
                  <p>Employment Rate</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ url('/admin/manage-announcements') }}" class="nav-link">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Manage Announcements
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ url('/admin/my-events') }}" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                My Events
              </p>
            </a>
          </li>
          <li class="nav-header">Settings</li>
          <li class="nav-item has-treeview">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>