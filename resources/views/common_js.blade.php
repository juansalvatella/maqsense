<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="{{ asset('') }}assets/global/plugins/respond.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/excanvas.min.js" type="text/javascript"></script>
<![endif]-->
<script src="{{ asset('') }}assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<script src="{{ asset('') }}assets/admin/pages/scripts/ui-toastr.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

@if(Session::has('success'))
    <input type="hidden" name="Stitle" value="{{ session('success')['title'] }}">
    <input type="hidden" name="Smsg" value="{{ session('success')['msg'] }}">
    <script>
        jQuery(document).ready(function() {
            var sessionTitle = $('input[name=Stitle]').val();
            var sessionMsg = $('input[name=Smsg]').val();
            toastr['success'](sessionMsg,sessionTitle,{
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-bottom-right",
                "onclick": null,
                "showDuration": "1000",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            });
        });
    </script>
@endif
@if(Session::has('info'))
    <input type="hidden" name="Ititle" value="{{ session('info')['title'] }}">
    <input type="hidden" name="Imsg" value="{{ session('info')['msg'] }}">
    <script>
        jQuery(document).ready(function() {
            var sessionTitle = $('input[name=Ititle]').val();
            var sessionMsg = $('input[name=Imsg]').val();
            toastr['info'](sessionMsg,sessionTitle,{
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-bottom-right",
                "onclick": null,
                "showDuration": "1000",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            });
        });
    </script>
@endif
@if (Session::get('warning'))
    <input type="hidden" name="Wtitle" value="{{ session('warning')['title'] }}">
    <input type="hidden" name="Wmsg" value="{{ session('warning')['msg'] }}">
    <script>
        jQuery(document).ready(function() {
            var sessionTitle = $('input[name=Wtitle]').val();
            var sessionMsg = $('input[name=Wmsg]').val();
            toastr['warning'](sessionMsg,sessionTitle,{
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-bottom-right",
                "onclick": null,
                "showDuration": "1000",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            });
        });
    </script>
@endif
@if (Session::get('error'))
    <input type="hidden" name="title" value="{{ session('error')['title'] }}">
    <input type="hidden" name="msg" value="{{ session('error')['msg'] }}">
    <script>
        jQuery(document).ready(function() {
            var sessionTitle = $('input[name=title]').val();
            var sessionMsg = $('input[name=msg]').val();
            toastr['error'](sessionMsg,sessionTitle,{
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-bottom-right",
                "onclick": null,
                "showDuration": "1000",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            });
        });
    </script>
@endif