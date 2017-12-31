
@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('Bangunan') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">	
			@yield('content')
			</div>
		</div>
	</div>
@endsection
