<?php

namespace pupr\Http\Controllers;

use Illuminate\Http\Request;
use pupr\Irigasi;
use DB;

class IrigasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	public function __construct()
    {
        $this->middleware('auth');
    }
	 
    public function index()
    {
		$bangunan = DB::table('bangunan_irigasi')->get();
		$bangunan = $bangunan->toArray();
		
		$sodetan_tersier = DB::table('sodetan')->where('jenis',3)->get();
		$sodetan_tersier = $sodetan_tersier->toArray();
		
		$sodetan_sekunder = DB::table('sodetan')->where('jenis',2)->get();
		$sodetan_sekunder = $sodetan_sekunder->toArray();
		$datas = Irigasi::all()->toArray();
        return view('irigasi.index', compact('datas','sodetan_tersier','sodetan_sekunder','bangunan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {		
        $jml_bangunan = DB::table('bangunan_irigasi')
                ->where('daerah_irigasi', $id)
                ->count();
        $jml_saluran = DB::table('sodetan')
                ->where('daerah_irigasi', $id)
                ->count();
        
        $jml_pintu_air = DB::table('bangunan_irigasi')
                ->where('daerah_irigasi', $id)
                ->where('jenis', 1) 
                ->count();
        $jml_intake = DB::table('bangunan_irigasi')
                ->where('daerah_irigasi', $id)
                ->where('jenis', 2) 
                ->count();

        $jml_sekunder = DB::table('sodetan')
                ->where('daerah_irigasi', $id)
                ->where('jenis', 2) 
                ->count();

        $jml_tersier = DB::table('sodetan')
                ->where('daerah_irigasi', $id)
                ->where('jenis', 3) 
                ->count();		

		$bangunan = DB::table('bangunan_irigasi')
		//->join('foto_bangunan', 'foto_bangunan.id_bangunan', '=', 'bangunan_irigasi.id')
		->where('daerah_irigasi',$id)->get();
		$bangunan = $bangunan->toArray();
		//dd($bangunan);
		
		$sodetan_tersier = DB::table('sodetan')->where([
		['jenis', '=', 3],
		['daerah_irigasi', '=', $id],
		])->get();
		$sodetan_tersier = $sodetan_tersier->toArray();
		
		$sodetan_sekunder = DB::table('sodetan')->where([
		['jenis', '=', 2],
		['daerah_irigasi', '=', $id],
		])->get();
		$sodetan_sekunder = $sodetan_sekunder->toArray();
		
		$datas = DB::table('daerah_irigasi')->where('id_di',$id)->get();
		$datas = $datas->toArray();
				//dd($datas);
        return view('irigasi.show', 
            compact('datas','sodetan_tersier','sodetan_sekunder','bangunan','foto','jml_bangunan', 'jml_pintu_air', 'jml_intake', 'jml_sekunder', 'jml_tersier', 'jml_saluran')
		);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
