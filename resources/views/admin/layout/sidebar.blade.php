<div class="br-logo"><a href=""><span>[</span>EBlog<span>]</span></a></div>
    <div class="br-sideleft overflow-y-auto">
      <label class="sidebar-label pd-x-15 mg-t-20">Navigation</label>
      <div class="br-sideleft-menu">
        <a href="{{route('admin.dashboard')}}" class="br-menu-link active">
          <div class="br-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Dashboard</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->

        <a href="#" class="br-menu-link">
          <div class="br-menu-item">
            <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
            <span class="menu-item-label">Categories</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->

        <ul class="br-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('admin.category.index')}}" class="nav-link">All categories</a></li>
          <li class="nav-item"><a href="{{route('admin.category.create')}}" class="nav-link">Add category</a></li>
          <li class="nav-item"><a href="{{route('admin.top-category.index')}}" class="nav-link">Top categories</a></li>
          <li class="nav-item"><a href="{{route('admin.navbar-category.index')}}" class="nav-link">Navbar categories</a></li>
        </ul>

        {{-- POSTS --}}
        <a href="#" class="br-menu-link">
            <div class="br-menu-item">
              <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
              <span class="menu-item-label">Posts</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->

        <ul class="br-menu-sub nav flex-column">
            <li class="nav-item"><a href="accordion.html" class="nav-link">All posts</a></li>
        </ul>



        {{-- USERS --}}
        <a href="#" class="br-menu-link">
            <div class="br-menu-item">
              <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
              <span class="menu-item-label">Users</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->

        <ul class="br-menu-sub nav flex-column">
            <li class="nav-item"><a href="accordion.html" class="nav-link">All users</a></li>
        </ul>
      </div><!-- br-sideleft-menu -->

      <br>
    </div>
