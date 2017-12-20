<?php

namespace pupr\Http\Controllers;

use Illuminate\Http\Request;
use pupr\Bangunan;


class BangunanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Bangunan::all()->toArray();
        return view('bangunan.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('bangunan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {	
        $data = new Bangunan([
          'jenis' => $request->get('jenis'),
          'kondisi' => $request->get('kondisi'),
          'lat' => $request->get('lat'),
          'lng' => $request->get('lng'),
          'dimensi' => $request->get('dimensi'),
          'foto' => $request->get('foto'),
          'keterangan' => $request->get('keterangan')
        ]);
        $data->save();
        return redirect('/bangunan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$data = Bangunan::find($id);
        return view('bangunan.edit', compact('data','id'));
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
        $data = Bangunan::find($id);
        $data->jenis = $request->get('jenis');
        $data->kondisi = $request->get('kondisi');
        $data->lat = $request->get('lat');
        $data->lng = $request->get('lng');
        $data->dimensi = $request->get('dimensi');
        $data->foto = $request->get('foto');
        $data->keterangan = $request->get('keterangan');
        $data->save();
        return redirect('/bangunan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data = Bangunan::find($id);
      $data->delete();
      return redirect('/bangunan');
    }
}
