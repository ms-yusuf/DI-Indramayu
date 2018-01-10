<!-- create.blade.php -->
@extends('adminlte::layouts.app')
@extends('bangunan')

<script type="text/javascript">
window.onload = function(e){ 
  map = new GMaps({
    el: '#mapform',
    disableDefaultUI:false,
    mapTypeControl:false,
    mapTypeId: 'satellite',
    lat: -6.325466,
    lng: 108.327932,
    zoom: 15,
    click: function(e) {
    },
  });

  function handleEvent(event) {
    document.getElementById('lat').value = event.latLng.lat();
    document.getElementById('lng').value = event.latLng.lng();
}
  
  var bangunanMarker = map.addMarker({
        draggable: true,
        lat: -6.325466,
        lng: 108.327932,
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
  <h1>Tambah Data Bangunan</h1>
  <form method="post" action="{{route('bangunan.store')}}" enctype="multipart/form-data">
   {!! csrf_field() !!}
   <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Daerah Irigasi</label>
          <div class="col-sm-8">
              <select name="daerah_irigasi" id="" class="form-control">
                  @foreach($datas1 as $nama)
                    <option value="{{ $nama->id }}">{{ $nama->nama }}</option>
                  @endforeach
              </select>
          </div>
        </div>
    <div class="form-group row">
     <!--  <input name="_method" type="hidden" value="PATCH"> -->
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Jenis Bangunan</label>
      <div class="col-sm-8">
           <select name="jenis" id="" class="form-control">
              <option value="1">Pintu Air</option>
              <option value="2">Intake</option>
              <option value="3">Jembatan</option>
            </select>
      </div>
    </div>    
  <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Kondisi Bangunan</label>
      <div class="col-sm-8">
            <select name="kondisi" id=""  class="form-control">
              <option value="1">Baik</option>
              <option value="2">Rusak</option>
            </select>
      </div>
    </div>
  <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Posisi</label>
      <div class="col-sm-8">
          <div class="panel-body wrapper-map">
            <div id="mapform"></div>
          </div>
      </div>
  </div>     
  <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">lat</label>
      <div class="col-sm-8">
        <input disabled type="text" class="form-control form-control-lg" id="lat" placeholder="lat" name="lat" value="">
  </div>
  </div>    
  <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">lng</label>
      <div class="col-sm-8">
        <input disabled type="text" class="form-control form-control-lg" id="lng" placeholder="lng" name="lng" value="">
      </div>
    </div>
  <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">dimensi</label>
      <div class="col-sm-8">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="dimensi" name="dimensi" value="">
      </div>
    </div>    
  <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">foto</label>
      <div class="col-sm-8">
          <input type="file" name="images[]" accept="image/*" multiple>
      </div>
    </div>    
  <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">keterangan</label>
      <div class="col-sm-8">
        <textarea name="keterangan" id="" cols="100" rows="3" form-control></textarea>
      </div>
    </div>  
    <div class="form-group row">
      <div class="col-md-2"></div>
      <button type="submit" class="btn btn-primary">Create</button>
      <!-- <a href="{{ URL::to('/bangunan') }}" class="btn btn-warning">Cancel</a> -->
    </div>
  </form>
</div>
@endsection