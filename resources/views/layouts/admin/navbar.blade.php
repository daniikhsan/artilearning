<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">
  <li class="nav-item">
    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
      <i class="fas fa-expand-arrows-alt"></i>
    </a>
  </li>
  <!-- Profile Dropdown Menu -->
  <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="far fa-user"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item">
        <i class="fas fa-wrench mr-2"></i> Settings
      </a>
      <form action="{{ route('logout') }}" method="post">
          @csrf 
          <button class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </button>
      </form>
    </div>
  </li>
</ul>
</nav>
<!-- /.navbar -->