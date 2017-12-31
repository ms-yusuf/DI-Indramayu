<head>
    <meta charset="UTF-8">
    <!-- <title> GIS PUPR - @yield('htmlheader_title', 'Your title here') </title> -->
    <title> GIS Daerah Irigasi & Saluran Pembuang Pemkab. Indramayu </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('/css/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/gmaps.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/gmaps-labels.css') }}" rel="stylesheet" type="text/css" />
	<!-- <script src="{{asset('js/jquery.googlemap.js')}}"></script> -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_c15UpfDb4Gcme5uLuDsYsvPUQGA-PWU" async defer> </script>	
	<script src="{{asset('js/gmaps.js')}}"></script>
	<script src="{{asset('js/gmaps-labels.js')}}"></script>
	<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
	<!-- <script src="{{asset('js/custom.js')}}"></script> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
    <script>
        //See https://laracasts.com/discuss/channels/vue/use-trans-in-vuejs
        window.trans = @php
            // copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
            $lang_files = File::files(resource_path() . '/lang/' . App::getLocale());
            $trans = [];
            foreach ($lang_files as $f) {
                $filename = pathinfo($f)['filename'];
                $trans[$filename] = trans($filename);
            }
            $trans['adminlte_lang_message'] = trans('adminlte_lang::message');
            echo json_encode($trans);
        @endphp
    </script>
</head>
