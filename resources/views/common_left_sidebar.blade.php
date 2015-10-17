<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <li class="start @if(Request::is('inicio') || Request::is('/')) active open @endif ">
                <a href="{{ url('inicio') }}">
                    <i class="icon-home"></i>
                    <span class="title">Inicio</span>
                    @if(Request::is('inicio') || Request::is('/')) <span class="selected"></span> @endif
                </a>
            </li>
            <li class=" @if(Request::is('incidencias')) active open @endif ">
                <a href="{{ url('incidencias') }}">
                    <i class="icon-wrench"></i>
                    <span class="title">Incidencias</span>
                    @if(Request::is('incidencias')) <span class="selected"></span> @endif
                </a>
            </li>
            <li class=" @if(Request::is('clientes')) active open @endif ">
                <a href="{{ url('clientes') }}">
                    <i class="icon-users"></i>
                    <span class="title">Clientes</span>
                    @if(Request::is('clientes')) <span class="selected"></span> @endif
                </a>
            </li>
            <li class=" @if(Request::is('intervenciones')) active open @endif ">
                <a href="{{ url('intervenciones') }}">
                    <i class="icon-settings"></i>
                    <span class="title">Intervenciones</span>
                    @if(Request::is('intervenciones')) <span class="selected"></span> @endif
                </a>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>
<!-- END SIDEBAR -->