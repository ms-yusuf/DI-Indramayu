<!-- create.blade.php -->
@extends('irigasi')

<script type="text/javascript">
window.onload = function(e){ 
	var APP_URL = {!! json_encode(url('/')) !!}
	var iconBase = APP_URL+'/images/';
	var daerah_irigasi = {!! json_encode($datas) !!}; //this should dump a javascript array object which does not need any extra interperting.
	var sodetan_sekunder = {!! json_encode($sodetan_sekunder) !!};
	var sodetan_tersier = {!! json_encode($sodetan_tersier) !!};
	var bangunan = {!! json_encode($bangunan) !!};
	var daerah = []; //just incase you want to be able to manipulate this later
	
	var centerpoint = daerah_irigasi[0]['koordinat'];
	centerpoint = centerpoint.split("],")[0];
	centerpoint = centerpoint.replace("[","");
	var latcenter =  centerpoint.split(",")[0];
	var lngcenter =  centerpoint.split(",")[1];
	
	map = new GMaps({
	  el: '#map',
	  disableDefaultUI:false,
	  mapTypeControl:false,
      mapTypeId: 'satellite',
	  lat: latcenter,
	  lng: lngcenter,
	  streetViewControl: false,
	  zoom: 16,
	  click: function(e) {
		//alert(e.latLng);
	  },
	});
	
		
	///BOUNDARY DAERAH IRIGASI
	for(var i = 0; i < daerah_irigasi.length; i++){
		var warna = ['red','blue','white'];
		daerah[i] = tambahDaerah(daerah_irigasi[i]['id'],daerah_irigasi[i]['koordinat'],warna[i],daerah_irigasi[i]['nama']);
	}
    function tambahDaerah(id,dataKoordinat,warna,nama){
		var array = JSON.parse("[" + dataKoordinat + "]");
        boundaryDaerah =  map.drawPolygon({
		  paths: array,
		  //strokeColor: '#BBD8E9',
		  strokeColor: 'Black',
		  strokeOpacity: 1,
		  strokeWeight: 1,
		  //fillColor: warna,
		  fillColor: 'white',
		  fillOpacity: 0.1,
			click: function(e) {
			//window.location = APP_URL+"/irigasi/show/" + id;
		  }
        });
			
	return boundaryDaerah;
    }
	
	//bangunan
	var marker = [];
	for(var i=0; i<bangunan.length;i++){
		var jenis = bangunan[i]['jenis'];
		var lat = bangunan[i]['lat'];
		var lng = bangunan[i]['lng'];		
		
		
	  var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">Panel Info</h1>'+
      '<div id="bodyContent">'+
      '<p><b>Keterangan Bangunan</b><br>' +
      'Kondisi : <br> '+
      'Dimensi :  <br>'+
      'Foto</p> <br>'+
      '<p>Detail :  <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">'+
      'Page</a> '+
      '</div>'+
      '</div>';

		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		
		//1 pintu air, 2 intake, 3 jembatan
		if(jenis == 1){
			marker[i] = map.addMarker({
			  lat: lat,
			  lng: lng,
			  title: 'Pintu Air',
			  size:[15,15],
			  origin:[0,0],
			  anchor:[0,32],
			  icon: iconBase + 'icon-pintuair.png',
			  click: function(e) {
				infowindow.open(map, this); 
			  }
			});
		} else if (jenis == 2){
			map.addMarker({
			  lat: lat,
			  lng: lng,
			  title: 'Intake',
			  size:[15,15],
			  origin:[0,0],
			  anchor:[0,16],
			  icon: iconBase + 'icon-intake.png',
			  click: function(e) {
				infowindow.open(map, this);
			  }
			});
		} else {
			map.addMarker({
			  lat: lat,
			  lng: lng,
			  title: 'Jembatan',
			  size:[20,20],
			  icon: iconBase + 'icon-jembatan.png',
			  click: function(e) {
				infowindow.open(map, this); 
			  }
			});
		}
	}
	
	//SODETAN SEKUNDER
	var path2 = [[]];
	for(var i=0; i<sodetan_sekunder.length; i++){
		var koordinat = sodetan_sekunder[i]['koordinat'];
		koordinat = JSON.parse("[" + koordinat + "]");
		path2.push(koordinat);
	}
	for (var i=0; i<path2.length; i++){
		map.drawPolyline({
		  path: path2[i],
		  strokeColor: 'blue',
		  strokeOpacity: 0.3,
		  strokeWeight: 4,
		 click: function(clickEvent) {
			var position = clickEvent.latLng;
			infowindow.setPosition(position);
			infowindow.open(map.map);
		  }
		});	
	}
	
	///SODETAN TERSIER
	var path3 = [[]];
	for(var i=0; i<sodetan_tersier.length; i++){
		var koordinat = sodetan_tersier[i]['koordinat'];
		koordinat = JSON.parse("[" + koordinat + "]");
		path3.push(koordinat);
	}
	for (var i=0; i<path3.length; i++){
		map.drawPolyline({
		  path: path3[i],
		  strokeColor: 'red',
		  strokeOpacity: 0.4,
		  strokeWeight: 8,
		 click: function(clickEvent) {
			var position = clickEvent.latLng;
			infowindow.setPosition(position);
			infowindow.open(map.map);
		  }
		});	
	}
	var legend = document.getElementById('legend');
	//map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);	
}
</script>

@section('content')
<div class="row">
	<div class="col-md-12">
		<!-- Default box -->
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Informasi Daerah Irigasi</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
				</div>
			</div>
			
			<div class="box-body">
						<div class="row">
							<div class="col-md-2">
								<p>Kewenangan</p>
							</div>
							<div class="col-md-4">
								<input type="text" class="form-control" value="{{ $datas[0]->kewenangan }}">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<p>Luas Areal</p>
							</div>
							<div class="col-md-4">
								<input type="text" class="form-control" value="{{ $datas[0]->luas_area }}">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<p>Jumlah Bangunan</p>
							</div>
							<div class="col-md-4">
								<input type="text" class="form-control" value="{{ $jml_bangunan }}" disabled>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<p style="margin-left: 20px;">Pintu Air</p>
							</div>
							<div class="col-md-4">
								<input type="text" class="form-control" value="{{ $jml_pintu_air }}" disabled>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<p style="margin-left: 20px;">Intake</p>
							</div>
							<div class="col-md-4">
								<input type="text" class="form-control" value="{{ $jml_intake }}" disabled>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<p>Jumlah Saluran</p>
							</div>
							<div class="col-md-4">
								<input type="text" class="form-control" value="{{ $jml_saluran }}" disabled>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<p style="margin-left: 20px;">Sekunder</p>
							</div>
							<div class="col-md-4">
								<input type="text" class="form-control" value="{{ $jml_sekunder }}" disabled>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<p style="margin-left: 20px;">Tersier</p>
							</div>
							<div class="col-md-4">
								<input type="text" class="form-control" value="{{ $jml_tersier }}" disabled>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<p>Panjang Saluran</p>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<p style="margin-left: 20px;">Sekunder</p>
							</div>
							<div class="col-md-4">
								<input type="text" class="form-control" value="{{ $datas[0]->ps_sekunder }}" >
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<p style="margin-left: 20px;">Tersier</p>
							</div>
							<div class="col-md-4">
								<input type="text" class="form-control" value="{{ $datas[0]->ps_tersier }}" >
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<p>Luas Saluran</p>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<p style="margin-left: 20px;">Sekunder</p>
							</div>
							<div class="col-md-4">
								<input type="text" class="form-control" value="{{ $datas[0]->ls_sekunder }}">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<p style="margin-left: 20px;">Tersier</p>
							</div>
							<div class="col-md-4">
								<input type="text" class="form-control" value="{{ $datas[0]->ls_tersier }}">
							</div>
						</div>
			
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->

	</div>
</div>	

<div class="panel panel-default">
	<div class="panel-heading">Daerah Irigasi</div>
	<div class="panel-body wrapper-map">
		<!-- <div id="floating-panel"></div> -->
		<div id="map"></div>
				<div class="legenda" id="legend">
			<h4>Legenda</h4>
			<div class="legenda-item">
				<img src="{{ asset('/images/icon-intake.png') }}">
				<p> Intake </p> 
				<hr>
				<img src="{{ asset('/images/icon-pintuair.png') }}">
				<p> Pintu Air </p> <br>
			</div>
		</div>				<!-- <div id="over_map">keterangan</div> -->
	</div>
</div>
@endsection