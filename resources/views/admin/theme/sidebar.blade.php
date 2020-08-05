<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
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
      <li class="nav-item">
        <a href="{{ url('/logout')}}" style="margin-right:8px" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class="fa fa-power"></i>Log Out <i class="fa fa-arrow-alt-circle-right"></i>
        </a>
        <form id="logout-form"
            action="{{ url('/logout') }}"
            method="POST"
            style="display: none;">
            {{ csrf_field() }}
        </form>
      </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="../../dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
        <span class="brand-text font-weight-light"><b>RAdmin</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header">Admin Settings</li>

            <li class="nav-item">
                <a href="/home" id="home" class="nav-link">
                    <i class="nav-icon fa fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="/admin/profile" id="profile" class="nav-link">
                    <i class="nav-icon far fa-user-circle"></i>
                    <p>
                        Admin Profile
                    </p>
                </a>
            </li>

        </ul>
      </nav>
    </div>
    <!-- /.sidebar -->
  </aside>
