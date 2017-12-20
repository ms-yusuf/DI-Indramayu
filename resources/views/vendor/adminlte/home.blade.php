@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">	
		<div class="row">
			<div class="col-lg-3 col-xs-6">
			  <!-- small box -->
			  <div class="small-box bg-aqua">
				<div class="inner">
				  <h3>150</h3>

				  <p>Jalur Irigasi</p>
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
				  <h3>23<sup style="font-size: 20px"></sup></h3>

				  <p>Sungai</p>
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
				  <h3>4</h3>

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
			  <div class="small-box bg-red">
				<div class="inner">
				  <h3>2</h3>

				  <p>Bendungan </p>
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
