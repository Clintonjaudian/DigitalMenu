<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('/customes/images/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Lorenzo's</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          {{-- <img src="{{asset('customes/images/logo.png')}}" class="img-circle elevation-2" alt="User Image"> --}}
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('home')}}" class="nav-link {{Request::is('home')? 'active':''}}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('account.index')}}" class="nav-link {{Request::is('account')? 'active':''}}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Accounts
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="" class="nav-link ">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                Menu 1
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('upper_left_menu1.index')}}" class="nav-link {{Request::is('menu1/upper_left_menu1')? 'active':''}}">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Upper Left</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('upper_right_menu1.index')}}" class="nav-link {{Request::is('menu1/upper_right_menu1')? 'active':''}}">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Upper Right</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('lower_left_menu1.index')}}" class="nav-link {{Request::is('menu1/lower_left_menu1')? 'active':''}}">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Lower Left</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('lower_right_menu1.index')}}" class="nav-link {{Request::is('menu1/lower_right_menu1')? 'active':''}}">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Lower Right</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="" class="nav-link ">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                Menu 2
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('right_side.index')}}" class="nav-link {{Request::is('dashboard2/right_side')? 'active':''}}">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Right Side</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('upper.index')}}" class="nav-link {{Request::is('dashboard2/upper')? 'active':''}}">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Upper</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('lower_left.index')}}" class="nav-link {{Request::is('dashboard2/lower_left')? 'active':''}}">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Lower Left</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('lower_right.index')}}" class="nav-link {{Request::is('dashboard2/lower_right')? 'active':''}}">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Lower Right</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Logout
              </p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
