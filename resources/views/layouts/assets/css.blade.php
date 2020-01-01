<!-- Entypo font stylesheet -->
<link href="{{asset('assets/css/entypo.css')}}" rel="stylesheet">
<!-- /entypo font stylesheet -->

<!-- Font awesome stylesheet -->
<link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">
<!-- /font awesome stylesheet -->

<!-- Bootstrap stylesheet min version -->
<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
<!-- /bootstrap stylesheet min version -->

<!-- Mouldifi core stylesheet -->
<link href="{{asset('assets/css/mouldifi-core.css')}}" rel="stylesheet">
<!-- /mouldifi core stylesheet -->

<link href="{{asset('assets/css/mouldifi-forms.css')}}" rel="stylesheet">

<link href="{{asset('assets/css/plugins/datatables/jquery.dataTables.css')}}" rel="stylesheet">
<link href="{{asset('assets/js/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css')}}" rel="stylesheet">

<!-- Bootstrap RTL stylesheet min version -->
{{--<link href="{{asset('assets/css/bootstrap-rtl.min.css')}}" rel="stylesheet">--}}
<!-- /bootstrap rtl stylesheet min version -->

<!-- Mouldifi RTL core stylesheet -->
{{--<link href="{{asset('assets/css/mouldifi-rtl-core.css')}}" rel="stylesheet">--}}
<!-- /mouldifi rtl core stylesheet -->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="{{asset('assets/js/html5shiv.min.js')}}"></script>
<script src="{{asset('assets/js/respond.min.js')}}"></script>
<![endif]-->
<style>
    .page-sidebar {
        width: 365px;
        background-image: linear-gradient(to top, #000000, #412b29, #7c5741, #ab8e57, #c4cf79);
        /*background-image: linear-gradient(to top, #292829, #4c3741, #75464c, #9a594a, #b27440, #b98736, #b79d2d, #acb52c, #9fc229, #8dcf2e, #72dc39, #43e94b);*/
    }
</style>

@yield('css')
