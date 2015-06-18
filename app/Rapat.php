<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Rapat extends Model {

	public function peserta()
    {
        return $this->belongsToMany('App\Pejabat');
    }
	
	public function undangan()
    {
        return $this->hasOne('App\Undangan');
    }

	public function kehadiran()
    {
        return $this->hasMany('App\Kehadiran');
    }
}
