<!-- Side Navbar -->
<nav class="side-navbar">
  <div class="side-navbar-wrapper">
    <!-- Sidebar Header    -->
    <div class="sidenav-header d-flex align-items-center justify-content-center">
      <!-- User Info-->
      <div class="sidenav-header-inner text-center"><a href="pages-profile.html"><img src="{{ asset('public/assets/images/logos/logo.jpg') }}" alt="person" class="img-fluid rounded-circle"></a>
        <h2 class="h5">{{ Auth::user()->name }}</h2><span>...</span>
      </div>
      <!-- Small Brand information, appears on minimized sidebar-->
      <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"><img src="{{ asset('public/assets/images/logos/logo.jpg') }}" alt="person" class="img-fluid rounded-circle"></a></div>
    </div>
    <!-- Sidebar Navigation Menus-->
    <div class="main-menu">
        @if(Auth::user()->isOneStopService())
    	<ul id="side-main-menu" class="side-menu list-unstyled">  
          <li><a href="{{ url('/oss/service-data/new') }}"> <i class="icon-home"></i>บันทึก</a></li>
          <li><a href="{{ url('/oss/service-data/list') }}"> <i class="icon-home"></i>รายการบันทึก</a></li>
        
      </ul>     
      <h5 class="sidenav-heading">รายงาน</h5>
        <ul id="side-main-menu" class="side-menu list-unstyled">  
          <li><a href="{{ url('/oss/service-data/report') }}"> <i class="icon-home"></i>รายงาน</a></li>
        </ul>
          @endif  
      <!-- <h5 class="sidenav-heading">เมนูหน้าร้าน</h5>

      <ul id="side-main-menu" class="side-menu list-unstyled">                  
        <li><a href="{{ url('pos/sales/new') }}"><i class="icon-screen"> </i> ขายของ</a></li>  
        <li><a href="{{ url('pos/exchanges/new') }}"><i class="icon-screen"> </i> เปลี่ยนสินค้า</a></li>
        <li><a href="{{ url('pos/write_offs/new') }}"><i class="icon-screen"> </i> ตัดจ่าย/แปรรูป</a></li>
      </ul>        
    </div> -->
   
    <div class="sales-manager-menu">
      <h5 class="sidenav-heading">ข้อมูล</h5></h5>
      <ul id="side-sales-manager-menu" class="side-menu list-unstyled"> 
        @if(Auth::user()->isAdmin())
        <li> <a href="{{ url('/admin') }}"><i class="icon-screen"> </i>ข้อมูลหลัก</a></li>
        @endif
       
      </ul>
    </div>
    
  </div>
</nav>
<!-- navbar-->
