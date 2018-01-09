<?php

namespace pupr\Http\Controllers;

use Illuminate\Http\Request;
use pupr\Bangunan;
use DB;

class BangunanController extends Controller
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
		//PINTU AIR
		$datas = DB::table('bangunan_irigasi AS b')
		->join('daerah_irigasi AS d','d.id_di','=','b.daerah_irigasi')
		->select('b.id','b.jenis','b.kondisi','b.lat','b.lng','b.dimensi','b.foto','b.keterangan','d.nama AS nama')
		->groupBy('b.id')
		//->where('b.jenis',1)
		->get();
		$datas = $datas->toArray();
		//dd($datas);
		$i = 1;
		
        //$datas = Bangunan::all()->toArray();
		//dd($datas);
     return view('bangunan.index', compact('datas','i'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $datas1 = DB::table('bangunan_irigasi AS b')
        ->join('daerah_irigasi AS d','d.id_di','=','b.daerah_irigasi')
        ->select('b.id', 'd.nama AS nama')
        ->groupBy('d.id_di')
        ->get();
        $datas1 = $datas1->toArray();
		return view('bangunan.create', compact('datas1'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {	
        /*dd($request);*/
        $data = new Bangunan;

        $data->daerah_irigasi   = $request->get('daerah_irigasi');
        $data->jenis            = $request->get('jenis');
        $data->kondisi          = $request->get('kondisi');
        $data->lat              = $request->get('lat');
        $data->lng              = $request->get('lng');
        $data->dimensi          = $request->get('dimensi');
        $data->foto             = $request->get('foto');
        $data->keterangan       = $request->get('keterangan');
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $data->foto = $file;
        }

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
        $datas1 = DB::table('bangunan_irigasi AS b')
        ->join('daerah_irigasi AS d','d.id_di','=','b.daerah_irigasi')
        ->select('b.id', 'd.nama AS nama')
        ->groupBy('d.id_di')
        ->get();
        $datas1 = $datas1->toArray();

        //dd($datas1);

        $datas2 = DB::table('bangunan_irigasi AS b')
        ->join('daerah_irigasi AS d','d.id_di','=','b.daerah_irigasi')
        ->where('b.id',$id)
        ->get();
        $datas2 = $datas2->toArray();

       // dd($datas2);

		$data = Bangunan::find($id);
        return view('bangunan.edit', compact('data','id', 'datas1', 'datas2'));
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

        /*dd($request);*/
        $data = Bangunan::find($id);

        $data->jenis        = $request->get('jenis');
        $data->kondisi      = $request->get('kondisi');
        $data->lat          = $request->get('lat');
        $data->lng          = $request->get('lng');
        $data->dimensi      = $request->get('dimensi');
        $data->foto         = $request->get('foto');
        $data->keterangan   = $request->get('keterangan');
        if ($request->hasFile('images')) {
            $file = $request->file('photo');
            $data->foto = $file;
        }

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
