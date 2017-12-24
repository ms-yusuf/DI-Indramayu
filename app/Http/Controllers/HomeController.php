<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace pupr\Http\Controllers;

use pupr\Http\Requests;
use Illuminate\Http\Request;
use DB;

/**
 * Class HomeController
 * @package pupr\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
		$jumlahBangunan = DB::table('bangunan_irigasi')->count();
		$jumlahDaerah = DB::table('daerah_irigasi')
                 ->select('nama', DB::raw('count(*) as total'))
                 ->groupBy('id_di')
                 ->get();
		$result = count($jumlahDaerah);
		$jumlahSaluran = DB::table('sodetan')->count();
		
		$jumlahBangunanIntake = DB::table('bangunan_irigasi')->where('jenis',2)->count();
		$jumlahBangunanPintu = DB::table('bangunan_irigasi')->where('jenis',1)->count();
		
		
        return view('adminlte::home',compact('jumlahBangunan','result','jumlahSaluran','jumlahBangunanPintu'));
    }
}