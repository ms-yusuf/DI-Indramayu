<?php

namespace pupr\Http\Controllers;

use Illuminate\Http\Request;
use pupr\Bangunan;
use DB;
use DataTables;

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

	public function bangunandata()
    {
      return Datatables::of(Bangunan::query())->make(true);
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
		$images = array();
		
        $data->daerah_irigasi   = $request->get('daerah_irigasi');
        $data->jenis            = $request->get('jenis');
        $data->kondisi          = $request->get('kondisi');
        $data->lat              = $request->get('lat');
        $data->lng              = $request->get('lng');
        $data->dimensi          = $request->get('dimensi');
        $data->keterangan       = $request->get('keterangan');
		
		 if ($request->hasFile('images')) {
			if($files=$request->file('images')){
				foreach($files as $key => $file){
					$name=$file->getClientOriginalName();
					$ekstensi = substr($name, strpos($name, ".") + 1);    
					$name = $data->jenis.$data->daerah_irigasi.time().$key.'.'.$ekstensi;
					$file->move('images\upload',$name);
					$images[]=$name;
				}
			}
			$images = implode(';',$images);
			$data->foto = $images;
		 }
		//dd($data);
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
        $dataDI = DB::table('daerah_irigasi AS d')
        ->select('d.nama AS nama','d.id_di AS id')
        ->groupBy('id_di')
        ->get();
        $dataDI = $dataDI->toArray();

        $dataBangunan = DB::table('bangunan_irigasi AS b')
        ->leftjoin('daerah_irigasi AS d','d.id_di','=','b.daerah_irigasi')
        ->where('b.id',$id)
        ->get();
        $dataBangunan = $dataBangunan->toArray();

		$data = Bangunan::find($id);
        return view('bangunan.edit', compact('data','id', 'dataDI', 'dataBangunan'));
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
		$aksi = $request->get('aksi');
		$data = Bangunan::find($id);
		/*dd($request);*/
		
		if($aksi == 'uploadfoto'){
			if ($request->hasFile('images')) {
				$fotolama = $data->foto;
				
				if($files=$request->file('images')){
					foreach($files as $key => $file){
						$name=$file->getClientOriginalName();
						$ekstensi = substr($name, strpos($name, ".") + 1);    
						$name = $data->jenis.$data->daerah_irigasi.time().$key.'.'.$ekstensi;
						$file->move('images\upload',$name);
						$images[]=$name;
					}
				}
				$fotobaru = implode(';',$images);
				if($fotolama != '')
					$fotobaru = $fotobaru.';'.$fotolama;	
				$data->foto = $fotobaru;
				$data->save();
			}
			return redirect('/bangunan/'.$id.'/edit');
		//dd($data);
		} else {
        $data->daerah_irigasi        = $request->get('daerah_irigasi');
        $data->jenis        = $request->get('jenis');
        $data->kondisi      = $request->get('kondisi');
        $data->lat          = $request->get('lat');
        $data->lng          = $request->get('lng');
        $data->dimensi      = $request->get('dimensi');
        $data->keterangan   = $request->get('keterangan');
        $data->save();
        return redirect('/bangunan/'.$id.'/edit');
		}
    }
	
	public function hapusfoto($id, $foto){
		$data = Bangunan::find($id);
		$fotolama = $data->foto;
		$fotolama = explode(';',$fotolama);
		// print_r($fotolama); echo "<br>";
		$key = array_search($foto, $fotolama);
		unset($fotolama[$key]);
		$fotobaru = implode(';',$fotolama);
		// echo $fotobaru;
		$data->foto=$fotobaru;
		$data->save();
		//print_r($fotobaru);
		$image_path = "/images/upload/".$foto;
		chown("/images/upload/", 666);
		if(file_exists($image_path)) {
			unlink($image_path);
			File::delete($image_path);
		}
		return redirect('/bangunan/'.$id.'/edit');
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
