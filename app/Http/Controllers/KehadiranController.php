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
	
	public function getJsonData($id)
	{
		$listPejabats = DB::table('kehadirans')
						->join('pejabats', 'pejabat_id', '=', 'pejabats.id')
						->select('pejabats.id', 'pejabats.nama', 'pejabats.jabatan', 'pejabats.instansi', 'kehadirans.hadir', 'kehadirans.keterangan')
						->where('rapat_id', '=', $id)
						->get();
					
		$listId = array();
        $listNama = array();
        $listJabatan = array();
        $listInstansi = array();
        $listHadir = array();
        $listKeterangan = array();
		
		foreach($listPejabats as $pejabat){
            array_push($listId,$pejabat->id);
            array_push($listNama,$pejabat->nama);
            array_push($listJabatan,$pejabat->jabatan);
            array_push($listInstansi,$pejabat->instansi);
            array_push($listHadir,$pejabat->hadir);
            array_push($listKeterangan,$pejabat->keterangan);
        }
					
		return json_encode(array('count'=>count($listNama),'id'=>$listId,'nama'=>$listNama,'jabatan'=>$listJabatan,'instansi'=>$listInstansi,'hadir'=>$listHadir,'keterangan'=>$listKeterangan));
	}

}
