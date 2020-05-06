<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Model
{
	use SoftDeletes;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';
 
 	function vendas(){
 		return $this->hasMany('App\Venda', 'id_usuario', 'id');
 	}
}
