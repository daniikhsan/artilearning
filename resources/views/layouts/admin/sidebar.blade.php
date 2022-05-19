<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="{{ url(auth()->user()->avatar) }}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
        <a href="#" class="d-block">{{ Auth()->user()->name }}</a>
    </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item is-active">
            <a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }} ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Dashboard
            </p>
            </a>
        </li>
        @if(auth()->user()->role == 'admin')
            <li class="nav-header">MASTER DATA</li>
            <li class="nav-item ">
                <a href="{{ route('user.index') }}" class="nav-link {{ Route::is('user.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    All Users
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('lecturer.index') }}" class="nav-link {{ Route::is('lecturer.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-chalkboard-teacher"></i>
                    <p>
                        Lecturers
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('student.index') }}" class="nav-link {{ Route::is('student.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user-graduate"></i>
                    <p>
                        Students
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('department.index') }}" class="nav-link {{ Route::is('department.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-building"></i>
                    <p>
                        Departments
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('major.index') }}" class="nav-link {{ Route::is('major.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-city"></i>
                    <p>
                        Major
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>
                        Course Settings
                    </p>
                </a>
            </li>
        @endif
        <li class="nav-header">COURSES</li>
        <li class="nav-item ">
            <a href="{{ route('course.index') }}" class="nav-link {{ Route::is('course.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>
                All Courses
            </p>
            </a>
        </li>
        <li class="nav-item ">
            <a href="{{ route('course.show', 1) }}" class="nav-link {{ Route::is('course.show', 1) ? 'active' : '' }}">
            <i class="nav-icon far fa-circle"></i>
            <p>
                Pemrograman Web
            </p>
            </a>
        </li>
    </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->