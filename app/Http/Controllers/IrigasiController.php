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
		$bangunan = DB::table('bangunan_irigasi')->where('daerah_irigasi',$id)->get();
		$bangunan = $bangunan->toArray();
		
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
		//$datas = Irigasi::where('id',$id)->toArray(); cara wherenya salah
        return view('irigasi.show', compact('datas','sodetan_tersier','sodetan_sekunder','bangunan'));
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
