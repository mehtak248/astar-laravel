<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0);" class="brand-link">
      	<img src="{{ asset('assets/images/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-fluid elevation-3" style="width: 200px;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      	<!-- Sidebar user panel (optional) -->
      	<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="{{ asset('images/user.jpg') }}" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="javascript:void(0);" class="d-block">{{ Auth::user()->name }}</a>
			</div>
		</div>

      	<!-- Sidebar Menu -->
      	<nav class="mt-2">
        	<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        		<li class="nav-item">
	            	<a href="{{ route('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
	              		<i class="nav-icon fas fa-tachometer-alt"></i>
	              		<p>Dashboard</p>
	            	</a>
	          	</li>

                <li class="nav-item has-treeview {{ request()->is('admin/questions*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/questions*') ? 'active' : '' }}">
                        <i class="fas fa-folder-open nav-icon"></i>
                        <p>Manage Questions</p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.questions.create') }}" class="nav-link {{ request()->is('admin/questions/create') ? 'active' : '' }}" title="Add Question">
                                <i class="fas fa-folder-plus nav-icon"></i>
                                <p>Add</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.questions.index') }}" class="nav-link {{ request()->is('admin/questions') ? 'active' : '' }}" title="Questions">
                                <i class="fas fa-folder-open nav-icon"></i>
                                <p>Questions</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ request()->is('admin/socialwall*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/socialwall*') ? 'active' : '' }}">
                        <i class="fas fa-folder-open nav-icon"></i>
                        <p>Manage Social-Wall</p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.socialwall.index') }}"
                                class="nav-link {{ request()->is('admin/socialwall') ? 'active' : '' }}" title="Social-Wall">
                                <i class="fas fa-folder-open nav-icon"></i>
                                <p>Social-Wall</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.leaderboard') }}" class="nav-link {{ request()->is('admin/leaderboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-trophy"></i>
                        <p>Leaderboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.users.list') }}" class="nav-link {{ request()->is('admin/usersList*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Users</p>
                    </a>
                </li>
			</ul>
		</nav>
      	<!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
