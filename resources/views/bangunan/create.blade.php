<!-- create.blade.php -->
@extends('adminlte::layouts.app')
@extends('bangunan')

<script type="text/javascript">
window.onload = function(e){ 
  //just incase you want to be able to manipulate this later
     
  map = new GMaps({
    el: '#map',
    disableDefaultUI:false,
    mapTypeControl:false,
    mapTypeId: 'satellite',
    lat: -6.325466,
    lng: 108.327932,
    zoom: 11,
    click: function(e) {
    alert(e.latLng);
    },
  });

  var bangunanMarker = map.addMarker({
        draggable: true,
        lat: -6.325466,
        lng: 108.327932,
        title: 'Pintu Air',
        size:[15,15],
        origin:[0,0],
        anchor:[0,32],
        //icon: iconBase + 'icon-pintuair.png',
        click: function(e) {
        //infowindowBangunan.open(map, this); 
        }
  })

  google.maps.event.addListener(bangunanMarker, 'onChange', function() {
      alert('test');
    });
     
}
</script>

@section('content')
       

          <div class="panel-body wrapper-map">
          <!-- <div id="floating-panel"></div> -->
            <div id="map"></div>
          <!-- <div id="over_map">keterangan</div> -->
          </div>
        </div>
            <br>
            <br>
<div class="container">
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
      <div class="col-sm-10">
       
           <select name="jenis" id="" class="form-control">
              <option value="1">Pintu Air</option>
              <option value="2">Intake</option>
              <option value="3">Jembatan</option>
            </select>
      </div>
    </div>    
  <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Kondisi Bangunan</label>
      <div class="col-sm-10">
            <select name="kondisi" id=""  class="form-control">
              <option value="1">Baik</option>
              <option value="2">Rusak</option>
            </select>
      </div>
    </div>
  <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">lat</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="lat" name="lat" value="">
      </div>
    </div>    
  <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">lng</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="lng" name="lng" value="">
      </div>
    </div>
  <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">dimensi</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="dimensi" name="dimensi" value="">
      </div>
    </div>    
  <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">foto</label>
      <div class="col-sm-10">
          <input type="file" name="images">
      </div>
    </div>    
  <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">keterangan</label>
      <div class="col-sm-10">
        <textarea name="keterangan" id="" cols="150" rows="3" form-control></textarea>
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