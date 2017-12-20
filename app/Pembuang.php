<?php

namespace pupr;

use Illuminate\Database\Eloquent\Model;

class Pembuang extends Model
{
	protected $table = 'saluran_pembuang';
	protected $fillable = ['jenis','kondisi','lat','lng','dimensi','foto','keterangan'];
}
