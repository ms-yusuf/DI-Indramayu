
@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')

<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function(){
	var map = new GMaps({
	  el: '#map',
	  lat: -6.325466,
	  lng: 108.327932,

	  click: function(e) {
		alert(e.latLng);
	  },

	});

	////////////////POLYLINES
	var Colors = [
	"#FF0000", 
	"#00FF00", 
	"#0000FF", 
	"#FF00FF",
	'red'
	];
	path = 
	[[[-6.328170, 108.326328],[-6.330973, 108.326051]],
	[[-6.330960, 108.324401],[-6.331280, 108.327518]],
	[[-6.328170, 108.326328],[-6.330973, 108.326051]],
	[[-6.330960, 108.324401],[-6.331280, 108.327518]],
	[[-6.333592, 108.325991],[-6.334903, 108.333066]],
	[[-6.334236, 108.328762],[-6.337036, 108.328365]],
	[[-6.327620, 108.326354],[-6.323550, 108.326877]],
	[[-6.328029, 108.326265],[-6.325672, 108.323766]],
	[[-6.325672, 108.323766],[-6.326472, 108.321384]],
	[[-6.328242, 108.326544],[-6.335095, 108.333447]],
	[[-6.335008, 108.332957],[-6.334339, 108.333568]],
	[[-6.337008, 108.332957],[-6.334639, 108.333568]]]
		
	for (var i=0; i<path.length; i++){
		//console.log(path[i]);
		map.drawPolyline({
		  path: path[i],
		  strokeColor: Colors[i],
		  strokeOpacity: 0.6,
		  strokeWeight: 6
		});	
	}
	//////////////////ICON MARKER
	var iconBase = 'http://127.0.0.1:8000/images/';
	map.addMarker({
	  lat: -6.337008,
	  lng: 108.332957,
	  title: 'Jembatan',
	  size:[20,20],
	  origin:[0,0],
	  anchor:[0,32],
	  icon: iconBase + 'icon-jembatan.png',
	  click: function(e) {
		alert('Jembatan');
	  }
	});

	map.addMarker({
	  lat: -6.334339,
	  lng: 108.333568,
	  title: 'Pintu Air',
		size:[20,20],
	  icon: iconBase + 'icon-pintuair.png',
	  click: function(e) {
		alert('Pintu Air');
	  }
	});
	/////////////////BOUNDARIES / polygon
	var path = [[-6.330960, 108.324401], 
	[-6.328170, 108.326328], 
	[-6.327620, 108.326354],	
	[-6.334903, 108.333066]];

	polygon = map.drawPolygon({
	  paths: path, // pre-defined polygon shape
	  strokeColor: '#BBD8E9',
	  strokeOpacity: 5,
	  strokeWeight: 3,
	  fillColor: '#BBD8E9',
	  fillOpacity: 0.6,
		click: function(e) {
		alert('daerah irigasi');
	  }
	});
});
</script>
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">	
				<div id="map"> </div>

			</div>
		</div>
	</div>
@endsection