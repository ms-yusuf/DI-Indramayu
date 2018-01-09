<!-- create.blade.php -->

@extends('adminlte::layouts.app')
@extends('bangunan')

@section('content')
    <table class="table table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Daerah</th>
        <th>Jenis</th>
        <th>Kondisi</th>
        <!-- <th>Koordinat</th> -->
        <th>Dimensi</th>
        <th>Foto</th>
        <th>Keterangan</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>	
    <tbody>
    @foreach($datas as $key=>$data)
      <tr>
        <!--<td>{{$data->id}}</td>-->
        <td>{{$key+1}}</td>
        <td>{{$data->nama}}</td>
        <td>
			@if ($data->jenis == 1)
				Pintu air
			@elseif ($data->jenis == 2)
				Intake			
			@elseif ($data->jenis == 2)
				Jembatan
			@else
				Tidak ada data
			@endif
		</td>
        <td>
			@if ($data->kondisi == 1)
				Baik
			@elseif ($data->kondisi == 2)
				Rusak
			@else
				Tidak ada data
			@endif
		</td>
        <!-- <td>{{$data->lat}}, {{$data->lng}}</td> -->
        <td>{{$data->dimensi}} M </td>
        <td><img width="75px" height="90px" src="{{ URL::to('/') }}/images/{{$data->foto}}"></td>
        <td>{{$data->keterangan}}</td>
        <td><a href="{{action('BangunanController@edit', $data->id)}}" class="btn btn-warning">Edit</a>
		<a href="{{action('IrigasiController@edit', $data->id)}}" class="btn"><img src="{{ URL::to('/') }}/images/liat-map.png" width="40px" heigth="25px"></a>
		</td>
		<td>
          <form action="{{action('BangunanController@destroy', $data->id)}}" method="post">
            {{csrf_field()}}
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
		</td>
      </tr>
	@endforeach
    </tbody>
  </table>
@endsection