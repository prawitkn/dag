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
      <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>A</strong><strong class="text-primary">Best</strong></a></div>
    </div>
    <!-- Sidebar Navigation Menus-->
    <div class="main-menu">
	<ul id="side-main-menu" class="side-menu list-unstyled">                  
        <li><a href="{{ url('/pos') }}"> <i class="icon-home"></i>หน้าแรก                             </a></li>
      </ul>     
      <!-- <h5 class="sidenav-heading">เมนูหน้าร้าน</h5>

      <ul id="side-main-menu" class="side-menu list-unstyled">                  
        <li><a href="{{ url('pos/sales/new') }}"><i class="icon-screen"> </i> ขายของ</a></li>  
        <li><a href="{{ url('pos/exchanges/new') }}"><i class="icon-screen"> </i> เปลี่ยนสินค้า</a></li>
        <li><a href="{{ url('pos/write_offs/new') }}"><i class="icon-screen"> </i> ตัดจ่าย/แปรรูป</a></li>
      </ul>        
    </div> -->
    <div class="back-end-menu">
      <h5 class="sidenav-heading">เมนูหลังร้าน</h5>
        <ul id="side-back-end-menu" class="side-menu list-unstyled">
        <li><a href="#tablesDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-list"></i>สั่งของ </a>
            <ul id="tablesDropdown" class="collapse list-unstyled ">
              <li><a href="{{ url('pos/orders/new') }}">สั่งของใหม่</a></li>
              <li><a href="{{ url('pos/orders/view-list') }}">รายการสั่งของ</a></li>
            </ul>
          </li>
        <!-- <li> <a href="{{ url('pos/order/view-list') }}"> <i class="icon-screen"> </i>รับของ</a></li>
        <li> <a href="{{ url('pos/order/view-list') }}"> <i class="icon-screen"> </i>โอนของ</a></li>
        <li> <a href="{{ url('pos/order/view-list') }}"> <i class="icon-screen"> </i>ขอปรับราคา</a></li>
        <li> <a href="{{ url('pos/order/view-list') }}"> <i class="icon-screen"> </i>เพิ่มสินค้า</a></li>
        <li> <a href="{{ url('pos/order/view-list') }}"> <i class="icon-screen"> </i>นับสต๊อก</a></li> -->
      </ul>
    </div>
    <div class="sales-manager-menu">
      <h5 class="sidenav-heading">ผู้จัดการขาย</h5></h5>
      <ul id="side-sales-manager-menu" class="side-menu list-unstyled"> 
        <li> <a href="{{ url('pos/orders/view-edit-list') }}"><i class="icon-screen"> </i>รายการสั่ง</a></li>
        <li> <a href="{{ url('pos/products/view-list') }}"><i class="icon-screen"> </i>รายการสินค้า</a></li>
      </ul>
    </div>
    <div class="sourcing-menu">
      <h5 class="sidenav-heading">สรรหา</h5></h5>
      <ul id="side-sourcing-menu" class="side-menu list-unstyled"> 
        <li> <a href="{{ url('pos/orders/sourcings/dashboard') }}"><i class="icon-screen"> </i>รายการสั่ง</a></li>
      </ul>
    </div>
    <!-- <div class="admin-menu">
      <h5 class="sidenav-heading">ผู้ดูแลระบบ</h5>
      <ul id="side-admin-menu" class="side-menu list-unstyled"> 
        <li> <a href="#"> <i class="icon-screen"> </i>ผู้ใช้งาน</a></li>
      </ul>
    </div> -->
  </div>
</nav>
<!-- navbar-->
