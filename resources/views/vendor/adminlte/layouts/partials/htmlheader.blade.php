<head>
    <meta charset="UTF-8">
    <!-- <title> GIS PUPR - @yield('htmlheader_title', 'Your title here') </title> -->
    <title> GIS Daerah Irigasi & Saluran Pembuang Pemkab. Indramayu </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('/images/logo-pupr.jpeg') }}" />
    <link href="{{ asset('/css/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/gmaps.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/gmaps-labels.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/datatable.css') }}" rel="stylesheet" type="text/css" /> 
	<!-- <script src="{{asset('js/jquery.googlemap.js')}}"></script> -->
	<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_c15UpfDb4Gcme5uLuDsYsvPUQGA-PWU" async defer> </script>	
	<script src="{{asset('js/gmaps.js')}}"></script>
	<!-- <script src="{{asset('js/gmaps-labels.js')}}"></script> -->
	
</head>
