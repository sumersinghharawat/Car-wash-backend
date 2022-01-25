
      <!-- sidebar menu start -->
      <div class="sidebar-menu sticky-sidebar-menu">

        <!-- logo start -->
        <div class="logo">
          <h1><a href="{{ route('admin.dashboard') }}"></a></h1>
        </div>

      <!-- if logo is image enable this -->
        <!-- image logo -->
        <div class="logo">
          <a href="{{ route('admin.dashboard') }}">
            {{-- <img src="image-path" alt="Your logo" title="Your logo" class="img-fluid" style="height:35px;" /> --}}
          </a>
        </div>
        <!-- //image logo -->

        <div class="logo-icon text-center">
          {{-- <a href="{{ route('admin.dashboard') }}" title="logo"><img src="{{ asset('assets/images/logo.png') }}" alt="logo-icon"> </a> --}}
        </div>
        <!-- //logo end -->

        <div class="sidebar-menu-inner">

          <!-- sidebar nav start -->
          <ul class="nav nav-pills nav-stacked custom-nav">
            <li class="active">
                <a href="{{ route('admin.dashboard') }}"><i class="fa fa-tachometer"></i><span> Dashboard</span></a>
            </li>
            <li class="menu-list">
              <a href="#"><i class="fa fa-tag"></i>
                <span>Category <i class="lnr lnr-chevron-right"></i></span></a>
              <ul class="sub-menu-list">
                <li><a href="{{ route('admin.addcategory') }}">Add Category</a> </li>
                <li><a href="{{ route('admin.viewcategory') }}">View Category</a> </li>
              </ul>
            </li>
            <li class="menu-list">
              <a href="#"><i class="fa fa-car" aria-hidden="true"></i>
                <span>Car Services<i class="fa fa-car" aria-hidden="true"></i></span></a>
              <ul class="sub-menu-list">
                <li><a href="{{ url('addservices') }}">Add Service</a></li>
                <li><a href="{{ route('admin.viewservice') }}">View Service</a> </li>
              </ul>
            </li>
            <li><a href="{{ route('admin.vieworders') }}"><i class="fa fa-table"></i> <span>Orders</span></a></li>
            {{-- <li><a href="pricing.html"><i class="fa fa-table"></i> <span>Pricing tables</span></a></li>
            <li><a href="blocks.html"><i class="fa fa-th"></i> <span>Content blocks</span></a></li>
            <li><a href="forms.html"><i class="fa fa-file-text"></i> <span>Forms</span></a></li> --}}
          </ul>
          <!-- //sidebar nav end -->
          <!-- toggle button start -->
          <a class="toggle-btn">
            <i class="fa fa-angle-double-left menu-collapsed__left"><span>Collapse Sidebar</span></i>
            <i class="fa fa-angle-double-right menu-collapsed__right"></i>
          </a>
          <!-- //toggle button end -->
        </div>
      </div>
      <!-- //sidebar menu end -->
