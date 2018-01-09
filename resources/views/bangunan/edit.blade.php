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
        <h3>Bangunan Irigasi di Daerah {{ $datas2[0]->nama }}</h3>
        <br>
<form method="post" action="{{action('BangunanController@update', $id)}}" enctype="multipart/form-data">
        <div class="form-group row">
          <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Daerah Irigasi</label>
          <div class="col-sm-8">
              <select name="" id="" class="form-control">
                  @foreach($datas1 as $nama)
                    <option value="{{ $nama->id }}">{{ $nama->nama }}</option>
                  @endforeach
              </select>
          </div>
        </div>

          <div class="panel-body wrapper-map">
          <!-- <div id="floating-panel"></div> -->
            <div id="map"></div>
          <!-- <div id="over_map">keterangan</div> -->
          </div>
        </div>
            <br>
            <br>
<div class="container">
    <div class="form-group row">
      {{csrf_field()}}
      <input name="_method" type="hidden" value="PATCH">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Jenis Bangunan</label>
      <div class="col-sm-10">
        @if ($datas2[0]->jenis == 1)
           <select name="jenis" id="" class="form-control">
              <option value="1">Pintu Air</option>
              <option value="2">Intake</option>
              <option value="3">Jembatan</option>
            </select>
        @elseif ($datas2[0]->jenis == 2)
           <select name="jenis" id=""  class="form-control">
              <option value="2">Intake</option>
              <option value="1">Pintu Air</option>
              <option value="3">Jembatan</option>
            </select>
        @elseif ($datas2[0]->jenis == 3)
            <select name="jenis" id=""  class="form-control">
              <option value="3">Jembatan</option>
              <option value="1">Pintu Air</option>
              <option value="2">Intake</option>
            </select>
        @endif
      </div>
    </div>    
	<div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Kondisi Bangunan</label>
      <div class="col-sm-10">
       @if ($datas2[0]->kondisi== 1)
            <select name="kondisi" id=""  class="form-control">
              <option value="1">Baik</option>
              <option value="2">Rusak</option>
            </select>
        @elseif ($datas2[0]->kondisi == 2)
           <select name="kondisi" id=""  class="form-control">
              <option value="2">Rusak</option>
              <option value="1">Baik</option>
            </select>
        @endif
      </div>
    </div>
	<div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">lat</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="lat" name="lat" value="{{$data->lat}}">
      </div>
    </div>		
	<div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">lng</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="lng" name="lng" value="{{$data->lng}}">
      </div>
    </div>
	<div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">dimensi</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="dimensi" name="dimensi" value="{{$data->dimensi}}">
      </div>
    </div>		
	<div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">foto</label>
      <div class="col-sm-10">

        <form action="{{action('BangunanController@update', $id)}}" method="post">
          <div class="row">
            <div class="col-md-3">
                <input type="file" name="images">
            </div>
            <div class="col-md-2">
                 <button type="submit" class="btn btn btn-primary">upload</button>
            </div>
          </div> 
        </form>
        
        <br>
        @if(!($datas2[0]->foto))
          <p>Tidak Ada Foto</p>
        @else
          <img src="{{ URL::to('/') }}/images/{{$datas2[0]->foto}}" alt="" style="width: 70px; height: 70px;">
        @endif
      </div>
    </div>		
	<div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">keterangan</label>
      <div class="col-sm-10">
      <textarea name="keterangan" id="" cols="150" rows="3" form-control>{{$data->keterangan}}</textarea>
        <!-- <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="keterangan" name="keterangan" value="{{$data->keterangan}}"> -->
      </div>
    </div>	
    <div class="form-group row">
      <div class="col-md-2"></div>
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="{{ URL::to('/bangunan') }}" class="btn btn-warning">Cancel</a>
    </div>
  </form>
</div>
@endsection