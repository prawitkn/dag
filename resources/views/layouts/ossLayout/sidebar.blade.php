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
      <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong></strong><strong class="text-primary">สบ.</strong></a></div>
    </div>
    <!-- Sidebar Navigation Menus-->
    <div class="main-menu">
    	<ul id="side-main-menu" class="side-menu list-unstyled">  
        @if(Auth::user()->isAdmin())
          <li><a href="{{ url('/oss/service-data/new') }}"> <i class="icon-home"></i>หน้าแรก</a></li>
          <li><a href="{{ url('/oss/service-data/report') }}"> <i class="icon-home"></i>รายงาน</a></li>
        @endif       
        @if(Auth::user()->isOnlineStoreSalesAdmin())
          <li><a href="{{ url('/online_store/dashboard') }}"> <i class="icon-home"></i>หน้าแรก</a></li>
        @endif       
        @if(Auth::user()->isOnlineStoreCustomer())
          <li><a href="{{ url('/online_store/orders/view-list') }}"> <i class="icon-home"></i>หน้าแรก</a></li>
        @endif         
      </ul>     
      <!-- <h5 class="sidenav-heading">เมนูหน้าร้าน</h5>

      <ul id="side-main-menu" class="side-menu list-unstyled">                  
        <li><a href="{{ url('pos/sales/new') }}"><i class="icon-screen"> </i> ขายของ</a></li>  
        <li><a href="{{ url('pos/exchanges/new') }}"><i class="icon-screen"> </i> เปลี่ยนสินค้า</a></li>
        <li><a href="{{ url('pos/write_offs/new') }}"><i class="icon-screen"> </i> ตัดจ่าย/แปรรูป</a></li>
      </ul>        
    </div> -->

    @if(!Auth::user()->isOnlineStoreCustomer())     
    <div class="sales-manager-menu">
      <h5 class="sidenav-heading">ข้อมูล</h5></h5>
      <ul id="side-sales-manager-menu" class="side-menu list-unstyled"> 
        @if(Auth::user()->isAdmin())
        <li> <a href="{{ url('/admin') }}"><i class="icon-screen"> </i>ข้อมูลหลัก</a></li>
        @endif
        @if(Auth::user()->isOnlineStoreSalesAdmin())    
        <li> <a href="{{ url('online_store/products/view-list') }}"><i class="icon-screen"> </i>ข้อมูลสินค้า</a></li>
        <li> <a href="{{ url('online_store/customers/view-list') }}"><i class="icon-screen"> </i>ข้อมูลลูกค้า</a></li>
        @endif
      </ul>
    </div>
    @endif
    
  </div>
</nav>
<!-- navbar-->
