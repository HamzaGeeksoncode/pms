<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="dropdown header-profile">
                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                    <img src="" width="20" alt=""/>
                    <div class="header-info ms-3">

                        <span class="font-w600 ">Hi,<b>{{ auth()->user()->name }}</b></span>
                        <small class="text-end font-w400">{{ auth()->user()->email }}</small>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="app-profile.html" class="dropdown-item ai-icon">
                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <span class="ms-2">Profile </span>
                    </a>
                    <a href="email-inbox.html" class="dropdown-item ai-icon">
                        <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        <span class="ms-2">Inbox </span>
                    </a>
                    <a href="page-error-404.html" class="dropdown-item ai-icon">
                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        <span class="ms-2">Logout </span>
                    </a>
                </div>
            </li>
            <li><a class="ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">Dashboard</span>
                </a>

            </li>
            @can('petrol_station_management')
            <li>
                <a class="ai-icon" href="{{route('petrol-stations.index')}}" aria-expanded="false">
                    <i class="flaticon-050-info"></i>
                    <span class="nav-text">{{ trans('cruds.common.petrol') }} {{ trans('cruds.common.stations') }}</span>
                </a>
            </li>
            @endcan
                        @can('order_access') 
            <li><a href="{{route('order.index')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-013-checkmark"></i>
                    <span class="nav-text">Orders</span>
                </a>
            </li>
            @endcan


            @can('shift_access')
            <li><a href="{{route('shifts.index')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-013-checkmark"></i>
                    <span class="nav-text">Shifts</span>
                </a>
            </li>            
            @endcan 

            @can('shift_access')
            <li><a href="{{route('shiftTrails.index')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-013-checkmark"></i>
                    <span class="nav-text">Shift Trails</span>
                </a>
            </li>            
            @endcan            

            @can('tank_access')
            <li><a href="{{route('tanks.index')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-013-checkmark"></i>
                    <span class="nav-text">Tanks</span>
                </a>
            </li>            
            @endcan

            @can('pump_access')
            <li><a href="{{route('pumps.index')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-013-checkmark"></i>
                    <span class="nav-text">Pumps</span>
                </a>
            </li>            
            @endcan

            @can('hose_access')
            <li><a href="{{route('hoses.index')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-013-checkmark"></i>
                    <span class="nav-text">Hoses</span>
                </a>
            </li>            
            @endcan                        
            
            @can('fuel_management_access')
            <li>
                <a class="ai-icon" href="{{route('fuel.index')}}" aria-expanded="false">
                    <i class="flaticon-050-info"></i>
                    <span class="nav-text">{{ trans('cruds.common.fuel') }} {{ trans('cruds.fuel.price') }}</span>
                </a>
            </li>
            @endcan   
            @can('user_management_access')   
            @if(session()->get('userRole') == "Super Admin")
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-041-graph"></i>
                    <span class="nav-text">Users</span>
                </a>
                <ul aria-expanded="false">
                    
                    <li><a href="{{ route("roles.index") }}" class="nav-link {{ request()->is('roles') || request()->is('roles/*') ? 'active' : '' }}">Roles & Permissions</a></li>
                    <li><a href="{{ route("users.index") }}" class="nav-link {{ request()->is('users') || request()->is('users/*') ? 'active' : '' }}">Users</a></li>
                </ul>
            </li>
            @endif
            @endcan
            @if(session()->get('userRole') == "Admin")
            <li>
                <a class="ai-icon" href="{{route('users.index')}}" aria-expanded="false">
                    <i class="flaticon-050-info"></i>
                    <span class="nav-text">Users</span>
                </a>
            </li>            
            @endif
            @can('expense_management_access')         
         <!--    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-041-graph"></i>
                    <span class="nav-text">Expense</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route("expense.index") }}" class="nav-link {{ request()->is('expense') || request()->is('expense/*') ? 'active' : '' }}">Expense</a></li>
                    <li><a href="{{ route("roles.index") }}" class="nav-link {{ request()->is('roles') || request()->is('roles/*') ? 'active' : '' }}">Expense Type</a></li>
                </ul>
            </li> -->
            @endcan  
            
            @can('vendor_create')   
            <li>
                <a class="ai-icon" href="{{route('vendors.index')}}" aria-expanded="false">
                    <i class="flaticon-050-info"></i>
                    <span class="nav-text">Vendor</span>
                </a>
            </li>        

              
            @endif

           <!--  @can('reading_management_access') -->         
            <li><a href="{{route('readings.index')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-013-checkmark"></i>
                    <span class="nav-text">Meter Reading</span>
                </a>
            </li>




            <!-- @endcan         -->
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-086-star"></i>
                    <span class="nav-text">Reports</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="ui-accordion.html">Accordion</a></li>
                    <li><a href="ui-alert.html">Alert</a></li>
                    <li><a href="ui-badge.html">Badge</a></li>
                    <li><a href="ui-button.html">Button</a></li>
                    <li><a href="ui-modal.html">Modal</a></li>
                    <li><a href="ui-button-group.html">Button Group</a></li>
                    <li><a href="ui-list-group.html">List Group</a></li>
                    <li><a href="ui-card.html">Cards</a></li>
                    <li><a href="ui-carousel.html">Carousel</a></li>
                    <li><a href="ui-dropdown.html">Dropdown</a></li>
                    <li><a href="ui-popover.html">Popover</a></li>
                    <li><a href="ui-progressbar.html">Progressbar</a></li>
                    <li><a href="ui-tab.html">Tab</a></li>
                    <li><a href="ui-typography.html">Typography</a></li>
                    <li><a href="ui-pagination.html">Pagination</a></li>
                    <li><a href="ui-grid.html">Grid</a></li>

                </ul>
            </li>
            @can('client_access')
            <li><a class="ai-icon" href="{{ route("clients.index") }}" aria-expanded="false">
                    <i class="flaticon-050-info"></i>
                    <span class="nav-text">Clients</span>
                </a>

            </li>
       <!--      <li><a class="ai-icon" href="{{ route("clients-payments.index") }}" aria-expanded="false">
                    <i class="flaticon-050-info"></i>
                    <span class="nav-text">Clients Payment</span>
                </a>

            </li>  -->           
            @endcan
            @can('vendorFuel_access')
            <li><a class="ai-icon" href="{{ route("vendorFuel.index") }}" aria-expanded="false">
                    <i class="flaticon-050-info"></i>
                    <span class="nav-text">Vendor Supply</span>
                </a>

            </li>            
            @endcan
        
{{--            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">--}}
{{--                    <i class="flaticon-072-printer"></i>--}}
{{--                    <span class="nav-text">Forms</span>--}}
{{--                </a>--}}
{{--                <ul aria-expanded="false">--}}
{{--                    <li><a href="form-element.html">Form Elements</a></li>--}}
{{--                    <li><a href="form-wizard.html">Wizard</a></li>--}}
{{--                    <li><a href="form-ckeditor.html">CkEditor</a></li>--}}
{{--                    <li><a href="form-pickers.html">Pickers</a></li>--}}
{{--                    <li><a href="form-validation.html">Form Validate</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">--}}
{{--                    <i class="flaticon-043-menu"></i>--}}
{{--                    <span class="nav-text">Table</span>--}}
{{--                </a>--}}
{{--                <ul aria-expanded="false">--}}
{{--                    <li><a href="table-bootstrap-basic.html">Bootstrap</a></li>--}}
{{--                    <li><a href="table-datatable-basic.html">Datatable</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">--}}
{{--                    <i class="flaticon-022-copy"></i>--}}
{{--                    <span class="nav-text">Pages</span>--}}
{{--                </a>--}}
{{--                <ul aria-expanded="false">--}}
{{--                    <li><a href="page-login.html">Login</a></li>--}}
{{--                    <li><a href="page-register.html">Register</a></li>--}}
{{--                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Error</a>--}}
{{--                        <ul aria-expanded="false">--}}
{{--                            <li><a href="page-error-400.html">Error 400</a></li>--}}
{{--                            <li><a href="page-error-403.html">Error 403</a></li>--}}
{{--                            <li><a href="page-error-404.html">Error 404</a></li>--}}
{{--                            <li><a href="page-error-500.html">Error 500</a></li>--}}
{{--                            <li><a href="page-error-503.html">Error 503</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li><a href="page-lock-screen.html">Lock Screen</a></li>--}}
{{--                    <li><a href="empty-page.html">Empty Page</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
        </ul>
    </div>
</div>