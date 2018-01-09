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
	   
	map = new GMaps({
	  el: '#map',
	  disableDefaultUI:false,
	  mapTypeControl:false,
      mapTypeId: 'satellite',
	  lat: -6.325466,
	  lng: 108.327932,
	  zoom: 11,
	  click: function(e) {
		//alert(e.latLng);
	  },
	});
	
	//bangunan
	// for(var i=0; i<bangunan.length;i++){
		// var jenis = bangunan[i]['jenis'];
		// var lat = bangunan[i]['lat'];
		// var lng = bangunan[i]['lng'];
		// //1 pintu air, 2 intake, 3 jembatan
		// if(jenis == 1){
			// map.addMarker({
			  // lat: lat,
			  // lng: lng,
			  // title: 'Pintu Air',
			  // size:[15,15],
			  // origin:[0,0],
			  // anchor:[0,32],
			  // icon: iconBase + 'icon-pintuair.png',
			  // click: function(e) {
				// alert('Pintu Air');
			  // }
			// });
		// } else if (jenis == 2){
			// map.addMarker({
			  // lat: lat,
			  // lng: lng,
			  // title: 'Intake',
			  // size:[15,15],
			  // origin:[0,0],
			  // anchor:[0,16],
			  // icon: iconBase + 'icon-intake.png',
			  // click: function(e) {
				// alert('Intake');
			  // }
			// });
		// } else {
			// map.addMarker({
			  // lat: lat,
			  // lng: lng,
			  // title: 'Jembatan',
			  // size:[20,20],
			  // icon: iconBase + 'icon-jembatan.png',
			  // click: function(e) {
				// alert('Jembatan');
			  // }
			// });
		// }
	// }
	
	// //SODETAN SEKUNDER
	// var path2 = [[]];
	// for(var i=0; i<sodetan_sekunder.length; i++){
		// var koordinat = sodetan_sekunder[i]['koordinat'];
		// koordinat = JSON.parse("[" + koordinat + "]");
		// path2.push(koordinat);
	// }
	// for (var i=0; i<path2.length; i++){
		// map.drawPolyline({
		  // path: path2[i],
		  // strokeColor: 'blue',
		  // strokeOpacity: 0.3,
		  // strokeWeight: 4
		// });	
	// }
	
	// ///SODETAN TERSIER
	// var path3 = [[]];
	// for(var i=0; i<sodetan_tersier.length; i++){
		// var koordinat = sodetan_tersier[i]['koordinat'];
		// koordinat = JSON.parse("[" + koordinat + "]");
		// path3.push(koordinat);
	// }
	// for (var i=0; i<path3.length; i++){
		// map.drawPolyline({
		  // path: path3[i],
		  // strokeColor: 'red',
		  // strokeOpacity: 0.3,
		  // strokeWeight: 4,
          // click: function(e) {
			// alert('saluran');
		  // }
		// });	
	// }
	
	///// FUNGSI CUSTOM
	google.maps.Polygon.prototype.my_getBounds=function(){
    var bounds = new google.maps.LatLngBounds()
    this.getPath().forEach(function(element,index){bounds.extend(element)})
    return bounds
	}
	function isInArray(value, array) {
		return array.indexOf(value) > -1;
}
	
	///BOUNDARY DAERAH IRIGASI
	var sudah = [];
	for(var i = 0; i < daerah_irigasi.length; i++){
		var warna = ['red','blue','white'];
		daerah[i] = tambahDaerah(daerah_irigasi[i]['id_di'],daerah_irigasi[i]['koordinat'],warna[i],daerah_irigasi[i]['nama']);
		sudah.push(daerah_irigasi[i]['id_di']);
	}
    function tambahDaerah(id,dataKoordinat,warna,nama){
		var array = JSON.parse("[" + dataKoordinat + "]");
        var boundaryDaerah =  map.drawPolygon({
		  paths: array,
		  //strokeColor: '#BBD8E9',
		  strokeColor: 'Black',
		  strokeOpacity: 1,
		  strokeWeight: 2,
		  //fillColor: warna,
		  fillColor: 'white',
		  fillOpacity: 0.1,
			click: function(e) {
			window.location = APP_URL+"/irigasi/" + id;
		  }
        });
		if(!isInArray(id,sudah)){
			var label = map.drawOverlay({
				lat: boundaryDaerah.my_getBounds().getCenter().lat(),
				lng: boundaryDaerah.my_getBounds().getCenter().lng(), 
				content: '<div class="overlay">'+nama+'</div>',
				layer: 'overlayLayer',
			});
		}
	return boundaryDaerah;
    }
}
</script>

@section('content')
            <div class="panel panel-default">
                <div class="panel-heading">Daerah Irigasi</div>
				
                <div class="panel-body wrapper-map">
                    <!-- <div id="floating-panel"></div> -->
					<div id="map"></div>
					<!-- <div id="over_map">keterangan</div> -->
                </div>
            </div>

@endsection