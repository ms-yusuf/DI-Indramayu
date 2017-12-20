<?php

namespace pupr;

use Illuminate\Database\Eloquent\Model;

class Crud extends Model
{
	protected $fillable = ['jenis','kondisi','lat','lng','dimensi','foto','keterangan'];
}
