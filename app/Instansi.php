<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model {

	//
	
	public function pejabats()
    {
        return $this->hasMany('App\Pejabat');
    }

}
