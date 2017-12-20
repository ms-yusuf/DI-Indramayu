<?php

namespace pupr;

use Illuminate\Database\Eloquent\Model;

class Irigasi extends Model
{
	protected $table = 'daerah_irigasi';
	protected $fillable = ['nama','koordinat'];
}
