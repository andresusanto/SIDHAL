<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use DB;
use Input;

use App\Instansi;

class KehadiranController extends Controller {

	public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function postKehadiranPejabat()
	{
		$rapat_id = Input::get('rapat_id');
		$pejabat_id = Input::get('pejabat_id');
		$keterangan = Input::get('keterangan');
		$hadir = Input::get('hadir');
		
		// save all data pejabat based on rapat_id
		$query = DB::table('kehadirans')->insert(['rapat_id' => $rapat_id, 'pejabat_id' => $pejabat_id, 'keterangan' => $keterangan, 'hadir' => $hadir]);
		
		return 1;
	}
	
	public function postClearKehadiran()
	{
		$rapat_id = Input::get('rapat_id');
		
		// clear all pejabat based on rapat_id
		$queryDel = DB::table('kehadirans')->where('rapat_id',$rapat_id)->delete();
	}
	
	public function getJsonData($id)
	{
		$listPejabats = DB::table('kehadirans')
						->join('pejabats', 'pejabat_id', '=', 'pejabats.id')
						->select('pejabats.id', 'pejabats.nama', 'pejabats.jabatan', 'pejabats.instansi_id', 'kehadirans.hadir', 'kehadirans.keterangan')
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
            array_push($listInstansi,Instansi::find($pejabat->instansi_id)->nama);
            array_push($listHadir,$pejabat->hadir);
            array_push($listKeterangan,$pejabat->keterangan);
        }
					
		return json_encode(array('count'=>count($listNama),'id'=>$listId,'nama'=>$listNama,'jabatan'=>$listJabatan,'instansi'=>$listInstansi,'hadir'=>$listHadir,'keterangan'=>$listKeterangan));
	}

}
