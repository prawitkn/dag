<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>E-DAG</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <!-- Bootstrap tether Core JavaScript -->
        <link href="{{ asset('/public/assets/libs/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet"> 
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <!-- <a href="{{ url('/home') }}">Home</a> -->
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ Auth::user()->name }}&nbsp;:&nbsp;{{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                <!--         @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif -->
                    @endauth
                </div>
            @endif

            <div class="content">

                <div class="row col-md-12">
                    <div class="col-md-12">
                        <img style="height: 5rem;" src="{{ asset('public/assets/images/logos/dag2021.png') }}" />

                    </div>
                </div>

                <pr>

                <div class="row center">
                    @if(Auth::user()->isOneStopService())
                	<div class="row col-md-12  style="padding-top:3px; min-width: 18rem;">
                		<a href="{{ url('/oss') }}" class="btn btn-outline-primary">
                          <img style="height: 10rem;" src="{{ asset('public/assets/images/oss.jpg') }}" class="card-img-top" alt="...">
                            &nbsp;<br/><label style="font-size: x-large;">ศูนยบริการแบบเบ็ดเสร็จ</label>  
                          </a> 
                	</div>
                    @endif


                    @if(Auth::user()->isDagSchool())
                	<div class="row col-md-12  style="padding-top:3px; min-width: 18rem;">
                		<a href="{{ url('/dag_school') }}" class="btn btn-outline-primary">
                          <img style="height: 10rem; width: 15rem;" src="{{ asset('public/assets/images/dag_school.jpg') }}" class="card-img-top" alt="...">
                            &nbsp;<br/><label style="font-size: x-large;">ระบบการจัดการหลักสูตรสายวิทยาการสารบรรณ</label>  
                          </a> 
                	</div>
                    @endif


                    @if(Auth::user()->isAdmin())
                    <div class="row col-md-12  style="padding-top:3px; min-heigth: 15rem;  min-width: 18rem;">
                        <a href="{{ url('/admin') }}" class="btn btn-outline-primary center">
                          <img style="height: 10rem; width: 15rem;" src="{{ asset('public/assets/images/data.png') }}" class="card-img-top" alt="...">
                            &nbsp;<br/><label style="font-size: x-large;">ข้อมูลหลัก</label>  
                          </a> 
                    </div>
                    @endif
                </div>

            </div>
            <!--/. content -->
        </div>
    </body>
</html>
