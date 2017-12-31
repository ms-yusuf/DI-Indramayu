@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('Dashboard') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">	
		<div class="row">
			<div class="col-lg-3 col-xs-6">
			  <!-- small box -->
			  <div class="small-box bg-aqua">
				<div class="inner">
				  <h3>{{ $jumlahBangunan }}</h3>

				  <p>Bangunan</p>
				</div>
				<div class="icon">
				  <i class="glyphicon glyphicon-stats"></i>
				</div>
			  </div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
			  <!-- small box -->
			  <div class="small-box bg-green">
				<div class="inner">
				  <h3>{{$result}}<sup style="font-size: 20px"></sup></h3>

				  <p>Daerah Irigasi</p>
				</div>
				<div class="icon">
				  <i class="glyphicon glyphicon-stats"></i>
				</div>
			  </div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
			  <!-- small box -->
			  <div class="small-box bg-yellow">
				<div class="inner">
				  <h3>{{$jumlahSaluran}}</h3>

				  <p>Jumlah Saluran</p>
				</div>
				<div class="icon">
				  <i class="glyphicon glyphicon-stats"></i>
				</div>
			  </div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
			  <!-- small box -->
			  <div class="small-box bg-red">
				<div class="inner">
				  <h3>{{$jumlahBangunanPintu}}</h3>

				  <p>Pintu Air </p>
				</div>
				<div class="icon">
				  <i class="glyphicon glyphicon-stats"></i>
				</div>
				<!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
			  </div>
			</div>
			<!-- ./col -->
		  </div>

		<div class="row">
			<div class="col-md-12">
				<!-- Default box -->
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Peta Keseluruhan</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i></button>
						</div>
					</div>
					
					<div class="box-body">
						Peta Keseluruhan Irigasi dan Perairan Kabupaten Indramayu | GMAPS
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

			</div>
		</div>	

	</div>
@endsection
