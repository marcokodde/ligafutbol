<div class="vertical-menu">

    <div data-simplebar="init" class="h-100">
        <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer">
                </div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: -15px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                        <div class="simplebar-content" style="padding: 0px;">
                            <!--- Sidemenu -->
                            <div id="sidebar-menu" class="mm-active">
                                <!-- Left Menu Start -->
                                <ul class="metismenu list-unstyled mm-show" id="side-menu">
                                    {{-- <li class="menu-title">Main</li> --}}
                                    <li class="mm-active">
                                        <a href="/" class="waves-effect mm-active">
                                            <i class="mdi mdi-view-dashboard"></i>
                                            <span> {{__('Dashboard')}} </span>
                                        </a>
                                    </li>
                                    <li>@include('layouts.menus.configuration')</li>

                                    <li>@include('layouts.menus.operation')</li>


                                </ul>
                            </div>
                            <!-- Sidebar -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: auto; height: 1120px;">
            </div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;">
            </div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
            <div class="simplebar-scrollbar" style="height: 204px; transform: translate3d(0px, 0px, 0px); display: block;">
            </div>
        </div>
    </div>
</div>
<!-- Left Sidebar End -->
