<!-- Side Navbar -->
<nav class="side-navbar">
  <div class="side-navbar-wrapper">
    <!-- Sidebar Header    -->
    <div class="sidenav-header d-flex align-items-center justify-content-center">
      <!-- User Info-->
      <div class="sidenav-header-inner text-center"><a href="pages-profile.html"><img src="{{ asset('public/assets/images/users/dev.jpg') }}" alt="person" class="img-fluid rounded-circle"></a>
        <h2 class="h5">Prawit  Khamnet</h2><span>Web Developer</span>
      </div>
      <!-- Small Brand information, appears on minimized sidebar-->
      <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>A</strong><strong class="text-primary">M</strong></a></div>
    </div>
    <!-- Sidebar Navigation Menus-->
    <div class="main-menu">
	<ul id="side-main-menu" class="side-menu list-unstyled">                  
        <li><a href="{{ url('/admin') }}"> <i class="icon-home"></i>Home</a></li>
      </ul>     
      <h5 class="sidenav-heading">Menu</h5>

      <ul id="side-main-menu" class="side-menu list-unstyled">                  
        <li><a href="{{ url('/admin/users/view-list') }}"><i class="icon-user"></i>User</a></li>
      </ul>             
      
    </div>
  </div>
</nav>
<!-- navbar-->
