<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('/') }}" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-sm-inline-block">
            <form action="{{ route('admin.logout') }}" class="d-inline-block" method="POST">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-block btn-outline-primary btn-sm" title="Logout">
                    <i class="fas fa-sign-out-alt nav-icon" aria-hidden="true"></i>
                </button>
            </form>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
