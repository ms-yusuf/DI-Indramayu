<!-- create.blade.php -->
@extends('adminlte::layouts.app')
@extends('bangunan')

<script type="text/javascript">
window.onload = function(e){ 
  //just incase you want to be able to manipulate this later
     
  map = new GMaps({
    el: '#mapform',
    disableDefaultUI:false,
    mapTypeControl:false,
    mapTypeId: 'satellite',
	lat: {{$data->lat}},
	lng: {{$data->lng}},
    zoom: 15,
  });

  function handleEvent(event) {
    document.getElementById('lat').value = event.latLng.lat();
    document.getElementById('lng').value = event.latLng.lng();
}
  
  var bangunanMarker = map.addMarker({
        draggable: true,
		lat: {{$data->lat}},
		lng: {{$data->lng}},
        title: 'Letak Bangunan',
        size:[15,15],
        origin:[0,0],
        anchor:[0,32],
  });
    bangunanMarker.addListener('drag', handleEvent);
    //bangunanMarker.addListener('dragend', handleEvent);  
}
</script>

@section('content')
<div class="container">
    <h1>Edit Data Bangunan</h1>
		<div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Foto</label>
      <div class="col-sm-8">
		@php
		$url = $app->make('url')->to('/');
		if($dataBangunan[0]->foto != ''){
			$fotostring = $dataBangunan[0]->foto;
			$fotos = explode(";", $fotostring);
			foreach($fotos as $foto){
				echo "<a href='".$url."/images/upload/".$foto."'> <img class='img-bangunan' src='".$url."/images/upload/".$foto."'> </a>";
				echo "<a href='".$url."/bangunan/hapusfoto/".$id."/".$foto."'> <img class='img-del' src='".$url."/images/"."delete.png' height='' width=''> </a>";
			}
		} else {
			echo "Tidak ada foto.";
			echo "<hr>";
		}
		@endphp
		<form action="{{action('BangunanController@update', $id)}}" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
				<input type="hidden" name="aksi" value="uploadfoto">
				<input name="_method" type="hidden" value="PATCH">
          <div class="row">
            <div class="col-md-3">
                <input type="file" name="images[]" accept="image/*" multiple>
            </div>
            <div class="col-md-2">
                 <button type="submit" class="btn btn btn-primary">Upload</button>
            </div>
          </div>
		 <!-- Maksimal ukuran file : {!! ini_get("upload_max_filesize")!!} -->
        </form>
		
      </div>
    </div>
	<form method="post" action="{{action('BangunanController@update', $id)}}" enctype="multipart/form-data">
	  {{csrf_field()}}
      <input name="_method" type="hidden" value="PATCH">
	  <input type="hidden" name="aksi" value="editdata">
    <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Daerah Irigasi</label>
          <div class="col-sm-8">
              <select name="daerah_irigasi" id="daerah_irigasi" class="form-control">
                  @foreach($dataDI as $DI)
                    <option {!! ($DI->id == $dataBangunan[0]->daerah_irigasi) ? 'selected' : '' !!} value="{{$DI->id}}"> {{ $DI->nama }}</option>
                  @endforeach
              </select>
          </div>
	</div>

	  <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Jenis Bangunan</label>
      <!-- kodingan si ade mesti dibenahin -->
	  <div class="col-sm-8">
           <select name="jenis" id="" class="form-control">
              <option  {!! ($dataBangunan[0]->jenis == 1) ? 'selected' : '' !!} value="1">Pintu Air</option>
              <option {!! ($dataBangunan[0]->jenis == 2) ? 'selected' : '' !!} value="2">Intake</option>
              <option {!! ($dataBangunan[0]->jenis == 3) ? 'selected' : '' !!} value="3">Jembatan</option>
            </select>
      </div>
    </div>    
	<div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Kondisi Bangunan</label>
      <div class="col-sm-8">
            <select name="kondisi" id=""  class="form-control">
              <option {!! ($dataBangunan[0]->kondisi == 1) ? 'selected' : '' !!}  value="1">Baik</option>
              <option {!! ($dataBangunan[0]->kondisi == 2) ? 'selected' : '' !!} value="2">Rusak</option>
            </select>
      </div>
    </div>
	<div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Posisi</label>
      <div class="col-sm-8">
          <div class="panel-body wrapper-map">
          <!-- <div id="floating-panel"></div> -->
            <div id="mapform"></div>
          <!-- <div id="over_map">keterangan</div> -->
          </div>
      </div>
    </div>		
	<div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">lat</label>
      <div class="col-sm-8">
        <input type="text" class="form-control form-control-lg" id="lat" placeholder="lat" name="lat" value="{{$data->lat}}">
      </div>
    </div>		
	<div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">lng</label>
      <div class="col-sm-8">
        <input type="text" class="form-control form-control-lg" id="lng" placeholder="lng" name="lng" value="{{$data->lng}}">
      </div>
    </div>
	<div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Dimensi</label>
      <div class="col-sm-8">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="dimensi" name="dimensi" value="{{$data->dimensi}}">
      </div>
    </div>				
	<div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Keterangan</label>
      <div class="col-sm-8">
      <textarea name="keterangan" id="" cols="100" rows="3" form-control>{{$data->keterangan}}</textarea>
        <!-- <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="keterangan" name="keterangan" value="{{$data->keterangan}}"> -->
      </div>
    </div>	
    <div class="form-group row">
      <div class="col-md-2"></div>
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="{{ URL::to('/bangunan') }}" class="btn btn-warning">Batal</a>
    </div>
  </form>
</div>
@endsection