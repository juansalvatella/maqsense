<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-quick-sidebar-over-content page-style-square">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="{{ url('inicio') }}" style="text-decoration:none;">
                <img src="{{ asset('img/logo_suimaq.png') }}" height="46" alt="logo" class="logo-default"/>
                {{--<h1 style="margin:5px 0 0 0;padding:0;">LOGO</h1>--}}
            </a>
            <div class="menu-toggler sidebar-toggler hide">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"></a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                {{--<!-- BEGIN NOTIFICATION DROPDOWN -->--}}
                {{--<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->--}}
                {{--<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">--}}
                        {{--<i class="icon-bell"></i>--}}
					{{--<span class="badge badge-default">--}}
					{{--7 </span>--}}
                    {{--</a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li class="external">--}}
                            {{--<h3><span class="bold">12 pending</span> notifications</h3>--}}
                            {{--<a href="extra_profile.html">view all</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">--}}
                                {{--<li>--}}
                                    {{--<a href="javascript:;">--}}
                                        {{--<span class="time">just now</span>--}}
									{{--<span class="details">--}}
									{{--<span class="label label-sm label-icon label-success">--}}
									{{--<i class="fa fa-plus"></i>--}}
									{{--</span>--}}
									{{--New user registered. </span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="javascript:;">--}}
                                        {{--<span class="time">3 mins</span>--}}
									{{--<span class="details">--}}
									{{--<span class="label label-sm label-icon label-danger">--}}
									{{--<i class="fa fa-bolt"></i>--}}
									{{--</span>--}}
									{{--Server #12 overloaded. </span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="javascript:;">--}}
                                        {{--<span class="time">10 mins</span>--}}
									{{--<span class="details">--}}
									{{--<span class="label label-sm label-icon label-warning">--}}
									{{--<i class="fa fa-bell-o"></i>--}}
									{{--</span>--}}
									{{--Server #2 not responding. </span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="javascript:;">--}}
                                        {{--<span class="time">14 hrs</span>--}}
									{{--<span class="details">--}}
									{{--<span class="label label-sm label-icon label-info">--}}
									{{--<i class="fa fa-bullhorn"></i>--}}
									{{--</span>--}}
									{{--Application error. </span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="javascript:;">--}}
                                        {{--<span class="time">2 days</span>--}}
									{{--<span class="details">--}}
									{{--<span class="label label-sm label-icon label-danger">--}}
									{{--<i class="fa fa-bolt"></i>--}}
									{{--</span>--}}
									{{--Database overloaded 68%. </span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="javascript:;">--}}
                                        {{--<span class="time">3 days</span>--}}
									{{--<span class="details">--}}
									{{--<span class="label label-sm label-icon label-danger">--}}
									{{--<i class="fa fa-bolt"></i>--}}
									{{--</span>--}}
									{{--A user IP blocked. </span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="javascript:;">--}}
                                        {{--<span class="time">4 days</span>--}}
									{{--<span class="details">--}}
									{{--<span class="label label-sm label-icon label-warning">--}}
									{{--<i class="fa fa-bell-o"></i>--}}
									{{--</span>--}}
									{{--Storage Server #4 not responding dfdfdfd. </span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="javascript:;">--}}
                                        {{--<span class="time">5 days</span>--}}
									{{--<span class="details">--}}
									{{--<span class="label label-sm label-icon label-info">--}}
									{{--<i class="fa fa-bullhorn"></i>--}}
									{{--</span>--}}
									{{--System Error. </span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="javascript:;">--}}
                                        {{--<span class="time">9 days</span>--}}
									{{--<span class="details">--}}
									{{--<span class="label label-sm label-icon label-danger">--}}
									{{--<i class="fa fa-bolt"></i>--}}
									{{--</span>--}}
									{{--Storage server failed. </span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<!-- END NOTIFICATION DROPDOWN -->--}}
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        {{--<img alt="" class="img-circle" src="/home/jsalvatella/Git/suimaq/carles.jpg"/>--}}
					<span class="username username-hide-on-mobile">
                    @if(Auth::check())
                        {{ Auth::user()->name }}
                    @else
                        Invitado
                    @endif
                    </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        {{--<li>--}}
                            {{--<a href="extra_profile.html">--}}
                                {{--<i class="icon-user"></i> My Profile </a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="page_calendar.html">--}}
                                {{--<i class="icon-calendar"></i> My Calendar </a>--}}
                        {{--</li>--}}
                        {{--<li class="divider">--}}
                        {{--</li>--}}
                        <li>
                            <a href="{{ url('/auth/logout') }}">
                                <i class="icon-key"></i> Log Out </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
                {{--<!-- BEGIN QUICK SIDEBAR TOGGLER -->--}}
                {{--<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->--}}
                {{--<li class="dropdown dropdown-quick-sidebar-toggler">--}}
                    {{--<a href="javascript:;" class="dropdown-toggle">--}}
                        {{--<i class="icon-logout"></i>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<!-- END QUICK SIDEBAR TOGGLER -->--}}
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>