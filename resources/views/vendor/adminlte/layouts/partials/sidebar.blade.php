<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->
            <li {{{ (Request::is('dashboard') ? 'class=active' : '') }}}>
			<a href="{{ url('home') }}"><i class='glyphicon glyphicon-home'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a>
			</li>
            
			<!--<li {{{ (Request::is('wilayahkecamatan') ? 'class=active' : '') }}}>
			<a href="{{ url('/peta') }}"><i class='glyphicon glyphicon-globe'></i> <span>Peta Kecamatan</span></a>
			</li>-->
			
			<li {{{ (Request::is('wilayahkerja') ? 'class=active' : '') }}}>
			<a href="#"><i class='glyphicon glyphicon-globe'></i> <span>Wilayah Kerja</span></a>
			</li>
			
			<ul data-widget="tree">
			  <li><a href="{{ url('/irigasi') }}">Daerah Irigasi</a></li>
			  <li><a href="{{ url('/bangunan') }}">Data Bangunan Irigasi</a></li>
			  <!--<li class="treeview">
				<a href="#">Multilevel</a>
				<ul class="treeview-menu">
				  <li><a href="#">Level 2</a></li>
				</ul>
			  </li> -->
			</ul>	
            
			<li {{{ (Request::is('organisasipengelola') ? 'class=active' : '') }}}>
			<a href="#"><i class='fa fa-database'></i> <span>Organisasi Pengelola</span></a>
			</li>
			
			<ul data-widget="tree">
			  <li><a href="{{ url('/irigasi') }}">Cabang Dinas</a></li>
			  <li><a href="{{ url('/pembuang') }}">Kepengamatan</a></li>
			  <!--<li class="treeview">
				<a href="#">Multilevel</a>
				<ul class="treeview-menu">
				  <li><a href="#">Level 2</a></li>
				</ul>
			  </li> -->
			</ul>		
		</ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

