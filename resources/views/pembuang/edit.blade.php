<!-- create.blade.php -->
@extends('adminlte::layouts.app')
@extends('bangunan')

@section('content')
<div class="container">
  <form method="post" action="{{action('BangunanController@update', $id)}}">
    <div class="form-group row">
      {{csrf_field()}}
      <input name="_method" type="hidden" value="PATCH">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Jenis Bangunan</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="jenis" name="jenis" value="{{$data->jenis}}">
      </div>
    </div>    
	<div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Kondisi Bangunan</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="kondisi" name="kondisi" value="{{$data->kondisi}}">
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
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="foto" name="foto" value="{{$data->dimensi}}">
      </div>
    </div>		
	<div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">keterangan</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="keterangan" name="keterangan" value="{{$data->keterangan}}">
      </div>
    </div>	
    <div class="form-group row">
      <div class="col-md-2"></div>
      <button type="submit" class="btn btn-primary">Update</button>
    </div>
  </form>
</div>
@endsection