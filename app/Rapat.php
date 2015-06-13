<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Rapat extends Model {

	public function peserta()
    {
        return $this->belongsToMany('App\Pejabat');
    }

	public function kehadiran()
    {
        return $this->hasMany('App\Kehadiran');
    }
}
