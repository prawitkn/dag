<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <!-- <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="mdi-menu mdi-close"></i></a> -->
            
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="{{ url('sales-dashboard') }}">
            <!-- <a class="navbar-brand" href="#"> -->
                <!-- Logo icon -->
                <b class="logo-icon p-l-10">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <!-- <img src="{{ asset('public/assets/images/logo-icon.png') }}" alt="homepage" class="light-logo" /> -->
                   
                </b>
            <!--End Logo icon -->
                 <!-- Logo text -->
                <span class="logo-text">
                     <!-- dark Logo text -->
                     <!-- <img src="{{ asset('matrix-admin-bt4/assets/images/logo-text.png') }}" alt="homepage" class="light-logo" /> -->
                    <span style="color: #FFF; font-weight: bold; font-size: 20px;"> Sales Dashboard</span>
                </span>
                <!-- Logo icon -->
                <!-- <b class="logo-icon"> -->
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <!-- <img src="../../assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->
                    
                <!-- </b> -->
                <!--End Logo icon -->
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <!-- ============================================================== -->
			<!-- toggle and nav items -->
			<!-- ============================================================== -->
			<ul class="navbar-nav float-left mr-auto">
                <li class="nav-item"> 
                    <a class="nav-link" href="{{ url('/') }}"><i class="fas fa-home m-r-5 m-l-5 text-white"></i></a>
                </li>

                @if(isset($header_salesmen))
                <li class="nav-item"> 
                    <a name="btn_new_customer" class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="fas fa-plus"></i> New Customer</a>
                </li>
                <li class="nav-item">
                    <input type="text" name="cust_name" class="form-control" placeholder="Search &amp; enter" style="margin-top: 15px;" /> 
                </li>
                @endif

				
                <!-- <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>  -->

				<!-- ============================================================== -->
				<!-- create new -->
				<!-- ============================================================== -->
				<!-- <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					 <span class="d-none d-md-block">Menu <i class="mdi mdi-angle-down"></i></span>
					 <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>   
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ url('/sales-dashboard/list-customers') }}"> Customer</a>
						<a class="dropdown-item" href="{{ url('/sales-dashboard/list-sales_journeys') }}">Sales Journey</a>
                        <a class="dropdown-item" href="{{ url('/sales-dashboard/list-product_requirements') }}">Market</a>						
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('public/html/ltr/index.html') }}" target="_blank">Matrix Template</a>
					</div>
				</li> -->
				<!-- ============================================================== -->
				<!-- Search -->
				<!-- ============================================================== -->
				<!-- <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-magnify"></i></a>
					<form class="app-search position-absolute">
						<input type="text" name="cust_name" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="mdi mdi-close"></i></a>
					</form>
				</li> -->
			</ul>
			
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->

                @if(isset($header_markets))
                <select name="market_id" class="navbar-nav float-right form-control col-md-1" />
                    <option value=""> All market</option>
                    @foreach($header_markets as $val_ddl)
                    <option value="{{ $val_ddl->id }}" 
                        >{{ $val_ddl->market_name }}</option>
                    @endforeach
                </select>
                @endif

                @if(isset($header_salesmen))
                <select name="sid" class="navbar-nav float-right form-control col-md-1" />
                    <option value=""> All sales</option>
                    @foreach($header_salesmen as $val_ddl)
                    <option value="{{ $val_ddl->id }}" 
                        >{{ $val_ddl->salesman_name }}</option>
                    @endforeach
                </select>
                @endif
            <ul class="navbar-nav float-right">
                
                @if(isset($header_salesmen))
                <li class="nav-item">&nbsp;<a name="btn_key" class="btn btn-warning" href="#"  style="margin-top: 15px;"><i class="fas fa-info-circle"></i> Key</a>
                </li>
                @endif
                
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('public/assets/images/users/1.jpg') }}" alt="user" class="rounded-circle" width="31"> {{ Auth::user()->name }}</a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated">

                        <!-- <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>
                        <!-- <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i> Inbox</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a> 
                        <div class="dropdown-divider"></div>                        
                        <a class="dropdown-item" href="{{ url('/admin/settings') }}"><i class="fa fa-power-off m-r-5 m-l-5"></i> Settings</a>-->
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <!-- <div class="dropdown-divider"></div>
                        <div class="p-l-30 p-10"><a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">View Profile</a></div> -->
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->
