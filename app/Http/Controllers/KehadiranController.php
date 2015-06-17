<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use DB;
use Input;

class KehadiranController extends Controller {

	public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function postKehadiranPejabat()
	{
		$pejabat_id = Input::get('pejabat_id');
		$keterangan = Input::get('keterangan');
		$hadir = Input::get('hadir');
					
		$query = DB::table('kehadirans')->insert(['pejabat_id' => $pejabat_id, 'keterangan' => $keterangan, 'hadir' => $hadir]);
		
		return 1;
	}

}
