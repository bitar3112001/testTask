<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <title>Youbee</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Main Styles -->
    <link rel="stylesheet" href="{{ asset('assets/styles/style2.css') }}">
    <!-- Task Management Styles -->
    <link rel="stylesheet" href="{{ asset('assets/Tasks/tasks.css') }}">
    <!-- Themify Icon -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/themify-icons/themify-icons.css') }}">

    <!-- mCustomScrollbar -->
    <link rel="stylesheet" href="{{ asset('assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css') }}">

    <!-- Waves Effect -->
    <link rel="stylesheet" href="{{ asset('assets/plugin/waves/waves.min.css') }}">

    <!-- Sweet Alert -->
    <link rel="stylesheet" href="{{ asset('assets/plugin/sweet-alert/sweetalert.css') }}">

    <!-- TinyMCE -->
    <link rel="stylesheet" href="{{ asset('assets/plugin/tinymce/skins/lightgray/skin.min.css') }}">
    <!-- Must include this script FIRST -->
    <script src="{{ asset('assets/plugin/tinymce/tinymce.min.js') }}"></script>

    <!-- Dark Themes -->
    <link rel="stylesheet" href="{{ asset('assets/styles/style-black.min.css') }}">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* .navigation .menu .menu-icon:hover {
            color: #fca311
        } */
        /* .navigation .menu li:hover ~ .navigation .menu .menu-icon{
            color: #fca311
        } */
    </style>
</head>

<body>
    <div class="main-menu">
        <header class="header">
            <a href="index.html" class="logo">YouBee.ai</a>
            <button type="button" class="button-close fa fa-times js__menu_close"></button>
        </header>
        <!-- /.header -->
        <div class="content">
            <div class="navigation">
                <h5 class="title">Navigation</h5>
                <!-- /.title -->
                <ul class="menu js__accordion">
                    <li>
                        <a class="waves-effect" href="{{ route('addEmployee') }}"><i class="menu-icon fa fa-user-plus"></i><span>Add Employee</span></a>
                    </li>
                    <li>
                        <a class="waves-effect" href="{{ route('addCustomer') }}"><i class="menu-icon fa fa-user"></i><span>Add Customer</span></a>
                    </li>
                    <li>
                        <a class="waves-effect" href="{{ route('addRole') }}"><i class="menu-icon fa fa-hand-stop-o"></i><span>Add Role</span></a>
                    </li>
                    <li>
                        <a class="waves-effect" href="calendar.html"><i class="menu-icon ti-calendar"></i><span>Calendar</span></a>
                    </li>
                    <li>
                        <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon ti-bar-chart"></i><span>Charts</span><span class="menu-arrow fa fa-angle-down"></span></a>
                        <ul class="sub-menu js__content">
                            <li><a href="chart-3d.html">3D Charts</a></li>
                            <li><a href="chart-chartist.html">Chartist Charts</a></li>
                            <li><a href="chart-chartjs.html">Chartjs Chart</a></li>
                            <li><a href="chart-dynamic.html">Dynamic Chart</a></li>
                            <li><a href="chart-flot.html">Flot Chart</a></li>
                            <li><a href="chart-knob.html">Knob Chart</a></li>
                            <li><a href="chart-morris.html">Morris Chart</a></li>
                            <li><a href="chart-sparkline.html">Sparkline Chart</a></li>
                            <li><a href="chart-other.html">Other Chart</a></li>
                        </ul>
                        <!-- /.sub-menu js__content -->
                    </li>
                    <li>
                        <a class="waves-effect" href="widgets.html"><i class="menu-icon ti-layers-alt"></i><span>Widgets</span><span class="notice notice-yellow">6</span></a>
                    </li>
                </ul>

                <!-- Uncomment this block if needed
                <h5 class="title">
                    <a class="accLink" style="display:flex; flex-direction: row; justify-content: space-between;" data-bs-toggle="collapse" href="#accountingMenu" role="button" aria-expanded="false" aria-controls="accountingMenu" style="color:#212121;">
                        <span>Accounting</span><span class="menu-arrow fa fa-angle-down"></span>
                    </a>
                </h5>
                <div class="collapse" id="accountingMenu">
                    <ul class="menu js__content">
                        <li>
                            <a class="waves-effect" href="{{ route('payments.create') }}"><i class="menu-icon fa fa-credit-card"></i><span>Payments</span></a>
                        </li>
                        <li>
                            <a class="waves-effect" href="{{ route('payments.create') }}"><i class="menu-icon fa fa-chart-line"></i><span>Revenue</span></a>
                        </li>
                        <li>
                            <a class="waves-effect" href="{{ route('payments.create') }}"><i class="menu-icon fa fa-money-bill-wave"></i><span>Expenses</span></a>
                        </li>
                    </ul>
                </div>
                -->

                <!-- /.menu js__accordion -->
                <h5 class="title">Additions</h5>
                <!-- /.title -->
                <ul class="menu js__accordion">
                    <li>
                        <a class="waves-effect" href="profile.html"><i class="menu-icon ti-user"></i><span>Profile</span></a>
                    </li>
                    <li>
                        <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon ti-layers"></i><span>Page</span><span class="menu-arrow fa fa-angle-down"></span></a>
                        <ul class="sub-menu js__content">
                            <li><a href="page-starter.html">Starter Page</a></li>
                            <li><a href="page-login.html">Login</a></li>
                            <li><a href="page-register.html">Register</a></li>
                            <li><a href="page-recoverpw.html">Recover Password</a></li>
                            <li><a href="page-lock-screen.html">Lock Screen</a></li>
                            <li><a href="page-confirm-mail.html">Confirm Mail</a></li>
                            <li><a href="page-404.html">Error 404</a></li>
                            <li><a href="page-500.html">Error 500</a></li>
                        </ul>
                        <!-- /.sub-menu js__content -->
                    </li>
                    <li>
                        <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon ti-blackboard"></i><span>Accounting</span><span class="menu-arrow fa fa-angle-down"></span></a>
                        <ul class="sub-menu js__content">
                            <li>
                                <a class="waves-effect" href="{{ route('payments.create') }}"><i class="menu-icon fa fa-credit-card"></i><span>Payments</span></a>
                            </li>
                            <li>
                                <a class="waves-effect" href="{{ route('payments.create') }}"><i class="menu-icon fa fa-chart-line"></i><span>Revenue</span></a>
                            </li>
                            <li>
                                <a class="waves-effect" href="{{ route('payments.create') }}"><i class="menu-icon fa fa-money-bill-wave"></i><span>Expenses</span></a>
                            </li>
                        </ul>
                        <!-- /.sub-menu js__content -->
                    </li>
                </ul>
                <!-- /.menu js__accordion -->
            </div>
            <!-- /.navigation -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.main-menu -->

    <div class="fixed-navbar">
        <div class="pull-left">
            <button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
            <h1 class="page-title">Compose</h1>
            <!-- /.page-title -->
        </div>
        <!-- /.pull-left -->
        <div class="pull-right">
            <div class="ico-item">
                <a href="#" class="ico-item ti-search js__toggle_open" data-target="#searchform-header"></a>
                <form action="#" id="searchform-header" class="searchform js__toggle"><input type="search"
                        placeholder="Search..." class="input-search"><button class="ti-search button-search"
                        type="submit"></button></form>
                <!-- /.searchform -->
            </div>
            <!-- /.ico-item -->

            <div class="ico-item">
                <i class="ti-user"></i>
                <ul class="sub-ico-item">
                    <li><a href="#">Settings</a></li>
                    <li><a class="js__logout" href="#">Log Out</a></li>
                </ul>
                <!-- /.sub-ico-item -->
            </div>
        </div>
        <!-- /.pull-right -->
    </div>
    <!-- /.fixed-navbar -->

    <div id="wrapper">
        <div class="main-content">
            <div class='row'>
                {{ $slot }}
            </div>
            <!-- /.row -->
            <footer class="footer">
                <ul class="list-inline">
                    <li>2024 © YouBee.ai</li>
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">Terms</a></li>
                    <li><a href="#">Help</a></li>
                </ul>
            </footer>
        </div>
        <!-- /.main-content -->
    </div>
    <!-- /#wrapper -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="assets/script/html5shiv.min.js"></script>
        <script src="assets/script/respond.min.js"></script>
    <![endif]-->

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('assets/scripts/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/scripts/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/plugin/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('assets/plugin/nprogress/nprogress.js') }}"></script>
    <script src="{{ asset('assets/plugin/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/plugin/waves/waves.min.js') }}"></script>
    <!-- Sparkline Chart -->
    <script src="{{ asset('assets/plugin/chart/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/scripts/chart.sparkline.init.min.js') }}"></script>

    <!-- TinyMCE -->
    <!-- Plugin Files DON'T INCLUDES THESE FILES IF YOU USE IN THE HOST -->
    <link rel="stylesheet" href="{{ asset('assets/plugin/tinymce/skins/lightgray/skin.min.css') }}">
    <script src="{{ asset('assets/plugin/tinymce/plugins/advlist/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/anchor/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/autolink/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/autoresize/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/autosave/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/bbcode/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/charmap/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/code/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/codesample/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/colorpicker/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/contextmenu/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/directionality/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/emoticons/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/example/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/example_dependency/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/fullpage/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/fullscreen/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/hr/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/image/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/imagetools/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/importcss/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/insertdatetime/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/layer/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/legacyoutput/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/link/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/lists/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/media/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/nonbreaking/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/noneditable/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/pagebreak/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/paste/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/preview/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/print/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/save/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/searchreplace/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/spellchecker/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/tabfocus/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/table/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/template/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/textcolor/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/textpattern/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/visualblocks/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/visualchars/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/plugins/wordcount/plugin.min.js') }} "></script>
    <script src="{{ asset('assets/plugin/tinymce/themes/modern/theme.min.js') }}"></script>
    <!-- Plugin Files DON'T INCLUDES THESE FILES IF YOU USE IN THE HOST -->
    <script src="{{ asset('assets/scripts/tinymce.init.min.js') }}"></script>

    <script src="{{ asset('assets/scripts/main.min.js') }}"></script>
    <script src="{{ asset('assets/Tasks/tasks.js') }}"></script>
</body>

</html>
