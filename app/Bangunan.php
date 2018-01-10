<?php

namespace pupr;

use Illuminate\Database\Eloquent\Model;

class Bangunan extends Model
{
	protected $table = 'bangunan_irigasi';
	protected $fillable = ['jenis','kondisi','lat','lng','dimensi','foto','keterangan','daerah_irigasi'];
}
