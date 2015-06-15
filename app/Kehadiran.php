<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model {

	public function pejabat()
    {
        return $this->belongsTo('App\Pejabat');
    }

}
