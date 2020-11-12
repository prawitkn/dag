<!-- Side Navbar -->
<nav class="side-navbar">
  <div class="side-navbar-wrapper">
    <!-- Sidebar Header    -->
    <div class="sidenav-header d-flex align-items-center justify-content-center">
      <!-- User Info-->
      <div class="sidenav-header-inner text-center"><a href="pages-profile.html"><img src="{{ asset('public/assets/dags/images/logos/logo.jpg') }}" alt="person" class="img-fluid rounded-circle"></a>
        <h2 class="h5">{{ Auth::user()->name }}</h2><span>...</span>
      </div>
      <!-- Small Brand information, appears on minimized sidebar-->
      <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>สบ.</strong><strong class="text-primary">ทหาร</strong></a></div>
    </div>
    <!-- Sidebar Navigation Menus-->
    <div class="main-menu">
    	<ul id="side-main-menu" class="side-menu list-unstyled">  
        @if(Auth::user()->isAdmin())
          <li><a href="{{ url('/dags') }}"> <i class="icon-home"></i>หน้าแรก</a></li>
        @endif       
        @if(Auth::user()->isOnlineStoreSalesAdmin())
          <li><a href="{{ url('/dags/dashboard') }}"> <i class="icon-home"></i>หน้าแรก</a></li>
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
        <!-- <li> <a href="{{ url('/admin') }}"><i class="icon-screen"> </i>ผู้ดูแลระบบ</a></li> -->
        @endif
        @if(Auth::user()->isAdmin() || Auth::user()->isOnlineStoreSalesAdmin())    
        <li> <a href="{{ url('dag_school/programs/view-list') }}"><i class="icon-screen"> </i>ข้อมูลหลักสูตร</a></li>
        <li> <a href="{{ url('dag_school/program-courses/view-list') }}"><i class="icon-screen"> </i>ข้อมูลวิชา โดยหลักสูตร</a></li>
        <li> <a href="{{ url('dag_school/program-classes/view-list') }}"><i class="icon-screen"> </i>ข้อมูลรุ่นหลักสูตร โดยหลักสูตร</a></li>
        <li> <a href="{{ url('dag_school/students/view-list') }}"><i class="icon-screen"> </i>ข้อมูลนักเรียน</a></li>  
        <li> <a href="{{ url('dag_school/class-students/view-list') }}"><i class="icon-screen"> </i>ข้อมูลนักเรียน โดยรุ่นหลักสูตร</a></li>  
        <li> <a href="{{ url('dag_school/program-course-tests/view-list') }}"><i class="icon-screen"> </i>ข้อมูลแบบทดสอบ โดยวิชาของหลักสูตร</a></li>  

       <!--  <li> <a href="{{ url('dag_school/courses/view-list') }}"><i class="icon-screen"> </i>ข้อมูลกลุ่มวิชา</a></li>
        <li> <a href="{{ url('dag_school') }}"><i class="icon-screen"> </i>ข้อมูลวิชา</a></li>
        <li> <a href="{{ url('dag_school') }}"><i class="icon-screen"> </i>ข้อมูลแบบทดสอบ</a></li>
        <li> <a href="{{ url('dag_school/students/view-list') }}"><i class="icon-screen"> </i>ข้อมูลนักเรียน</a></li>   -->
        @endif
      </ul>
    </div>

    <div class="sales-manager-menu">
      <h5 class="sidenav-heading">การจัดการ</h5></h5>
      <ul id="side-sales-manager-menu" class="side-menu list-unstyled"> 
        <li> <a href="{{ url('dag_school/program-class-test-students/view-list') }}"><i class="icon-screen"> </i>บันทีกผลคะนนแบบทดสอบ</a></li>  

        @if(Auth::user()->isAdmin() || Auth::user()->isOnlineStoreSalesAdmin())   
        <li> <a href="{{ url('dag_school') }}"><i class="icon-screen"> </i>เปิดหลักสูตร</a></li>
        <li> <a href="{{ url('dag_school') }}"><i class="icon-screen"> </i>บักทึกผลแบบทดสอบ</a></li>
        <li> <a href="{{ url('dag_school') }}"><i class="icon-screen"> </i>รายงาน</a></li>
        <li> <a href="{{ url('dag_school') }}"><i class="icon-screen"> </i>ออกใบประกาศฯ</a></li>
        @endif
      </ul>
    </div>
    @endif    
  </div>
</nav>
<!-- navbar-->
