<!-- create.blade.php -->
@extends('bangunan')
@section('content')
	<h1> Data Bangunan Irigasi </h1>
    <a href="{{ URL::to('/bangunan/create') }}" class="btn btn-primary">Tambah Data</a>
    <br>
    <br>
    <table id="bangunantabel" class="table table-striped">
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
        <th>Aksi</th>
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
        <td>{!! ($data->dimensi != '') ? $data->dimensi.'M' : 'Tidak ada data' !!}  </td>
        <td>
			@php
					$url = $app->make('url')->to('/');
					if($data->foto != ''){
						$fotostring = $data->foto;
						$fotos = explode(";", $fotostring);
						foreach($fotos as $foto){
							echo "<a href='".$url."/images/upload/".$foto."'> <img class='img-bangunan-form' src='".$url."/images/upload/".$foto."'> </a>";
						}
					} else {
						echo "Tidak ada foto.";
						echo "<hr>";
					}
		@endphp
		</td>
        <td>{{$data->keterangan}}</td>
		<td>
			<a href="{{action('BangunanController@edit', $data->id)}}"><img src="{{asset('images/modify.png')}}" height="30px" width="30px"></a>
			<a href="{{action('BangunanController@destroy', $data->id)}}"><img src="{{asset('images/delete.png')}}" height="30px" width="30px"></a>

		</td>
		
		
      </tr>
	@endforeach
    </tbody>
  </table>
@endsection
