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
                        Majors
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('course-setting.index') }}" class="nav-link {{ Route::is('course-setting.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>
                        Courses
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
        @php 
            if(auth()->user()->role == 'admin'){
                $user_course = \App\Models\Course::all();
            }elseif(auth()->user()->role == 'lecturer') {
                $user_course = \App\Models\Course::where('user_id', auth()->user()->id)->get();
            }else{
                $user_course_id = \App\Models\UserCourse::where('user_id', auth()->user()->id)->pluck('course_id')->toArray();
                $user_course = \App\Models\Course::whereIn('id', $user_course_id)->get();
            }
        @endphp
        @foreach($user_course as $course)
            <li class="nav-item ">
                <a href="{{ route('course.show', $course->id) }}" class="nav-link {{ Route::is('course.show', $course->id) ? 'active' : Route::is('exam.*', $course->id) ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>
                    {{ $course->name }}
                </p>
                </a>
            </li>
        @endforeach
    </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->