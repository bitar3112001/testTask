<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Log in</title>
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
    .row {
        display: flex;
        flex-direction: column;
        /* overflow-x: scroll */
    }
</style>

</head>

<body>

<div id="single-wrapper">
	<form action="/login" method="post" class="frm-single">
        @csrf
		<div class="inside">


			<div class="frm-title">Login</div>

			<div class="frm-input"><input type="text" name="email" placeholder="email" class="frm-inp"><i class="fa fa-user frm-ico"></i></div>

			<div class="frm-input"><input type="password" name="password" placeholder="password" class="frm-inp"><i class="fa fa-lock frm-ico"></i></div>


			<!-- /.clearfix -->
			<button type="submit" class="frm-submit">Login<i class="fa fa-arrow-circle-right"></i></button>

			<a href="/register" class="a-link"><i class="fa fa-key"></i>Register.</a>
			<div class="frm-footer">Youbee © 2024.</div>

			<!-- /.footer -->
		</div>
		<!-- .inside -->
	</form>
	<!-- /.frm-single -->
</div><!--/#single-wrapper -->

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
