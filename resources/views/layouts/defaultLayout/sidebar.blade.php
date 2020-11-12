<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
@if(isset($top_customers))
    <aside class="left-sidebar" data-sidebarbg="skin5">
@else
    <aside class="left-sidebar" class="mini-sidebar" data-sidebarbg="skin5">
@endif
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">

                @if(isset($top_customers))
                <table class="table table-striped">
                    <thead><tr>
                        <th>Customer Name</th>
                        <th>Status</th>
                    </tr></thead><tbody>
                    @foreach($top_customers as $val)                    
                    <tr>
                        <td style="font-size: small;">
                            <a href="{{ url('/sales-dashboard/customer/'.$val->id) }}" >
                            {{ $val->customer_name }}
                            </a>
                        </td>
                        <td style="font-size: small; text-align: center;">
                            @switch($val->customer_importance_id)
                                @case(1)    <!--Follow Up Now-->
                                <span class="badge badge-danger">{{ $val->customer_importance_name }}</span>
                                @break
                                @case(2)    <!--Re-Contact Soon-->
                                <span class="badge badge-warning">{{ $val->customer_importance_name }}</span>
                                @break
                                @case(3)    <!--To/Re Normal -->
                                <span class="badge badge-success">{{ $val->customer_importance_name }}</span>
                                @break
                                @default    <!--N/A-->
                                <span class="badge badge-light">N/A</span>
                            @endswitch
                        </br>
                            @switch($val->sales_journey_status_id)
                                @case(1)    <!--Internal-->
                                <span class="badge badge-danger">{{ $val->sales_journey_status_name }}</span>
                                @break
                                @case(2)    <!--Proposal-->
                                <span class="badge badge-warning">{{ $val->sales_journey_status_name }}</span>
                                @break
                                @case(3)    <!--To/Re Approach-->
                                <span class="badge badge-info">{{ $val->sales_journey_status_name }}</span>
                                @break
                                @case(4)    <!--Regular-->
                                <span class="badge badge-success">{{ $val->sales_journey_status_name }}</span>
                                @break
                                @case(5)    <!--Case Lost-->
                                <span class="badge badge-secondary">{{ $val->sales_journey_status_name }}</span>
                                @break  
                                @default    <!--N/A-->
                                <span class="badge badge-light">N/A</span>
                            @endswitch
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                @endif
                </table>

                
              
               <!--  <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="{{ url('/change-pw') }}" aria-expanded="false"><i class="mdi mdi-key-change"></i><span class="hide-menu"> เปลี่ยนรหัสผ่าน</span></a></li>    -->      
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
