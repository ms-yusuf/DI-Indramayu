<!-- create.blade.php -->

@extends('adminlte::layouts.app')
@extends('bangunan')

@section('content')
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Nama Lain</th>
        <th>Koordinat</th>
        <th>Lebar</th>
        <th>Panjang</th>
        <th colspan="1">Action</th>
      </tr>
    </thead>	
	<tbody>
      @foreach($datas as $data)
      <tr>
        <td>{{$data['id']}}</td>
        <td>{{$data['nama']}}</td>
        <td>{{$data['nama_lain']}}</td>
        <td>{{$data['koordinat']}}</td>
        <td>{{$data['lebar']}}</td>
        <td>{{$data['panjang']}}</td>
        <td><a href="{{action('IrigasiController@edit', $data['id'])}}" class="btn btn-warning">Edit</a>
		<a href="{{action('IrigasiController@edit', $data['id'])}}" class="btn"><img src="{{ URL::to('/') }}/images/liat-map.png" width="40px" heigth="25px"></a>
		<a href="{{action('IrigasiController@edit', $data['id'])}}" class="btn btn-danger">Hapus</a>
		</td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection