<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model {

	//
	
	public function instansi()
    {
        return $this->belongsTo('App\Instansi');
    }

}
