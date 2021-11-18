<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        @if(Auth::user()->isAdmin == 0)
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="fas fa-users"></i>
              <p>
                Manager User
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/listUser" class="nav-link active">
                  <p>List User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('user.create') }}" class="nav-link">
                  <p>Add User</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="fas fa-house-damage"></i>
              <p>
                Manager Room
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/listRoom" class="nav-link active">
                  <p>List Room</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('room.create') }}" class="nav-link">
                  <p>Add Room</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="fas fa-building"></i>
              <p>
                Manager Department
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/listDepartment" class="nav-link active">
                  <p>List Department</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('department.create') }}" class="nav-link">
                  <p>Add Department</p>
                </a>
              </li>
            </ul>
          </li> 
          @endif
          <li class="nav-item menu-open">
            <a href="{{ route('home') }}" class="nav-link btn-secondary">
              <i class="fas fa-home"></i>
              <p>
                Booking room
              </p>
            </a>
          </li> 
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>