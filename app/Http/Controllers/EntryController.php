<?php namespace App\Http\Controllers;

use App\Pejabat;
use App\Rapat;
use Request;

class EntryController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}
	
	private function genDaftarPejabat()
	{
		$daftar_pejabat = Pejabat::all();
		$pimpinan = "";
		
		foreach ($daftar_pejabat as $pejabat){
			if ($pimpinan != "") $pimpinan .= ", ";
			$pimpinan .= '"' . $pejabat->nama . ' (' . $pejabat->jabatan . ' di ' . $pejabat->instansi->nama . ')"';
		}
		
		return $pimpinan;
	}

	public function getIndex()
	{
		$daftar_pejabat = Pejabat::all();
		
		return view('konten/entry', array('title'=>'Entry Rapat Baru', 'nav_entry'=>'', 'pimpinan'=> $this->genDaftarPejabat()));
	}
	
	public function postIndex()
	{
		$jenis = Request::input('jenis');
		$perihal = Request::input('perihal');
		$tempat = Request::input('tempat');
		$tanggal = Request::input('tanggal');
		$wkt = Request::input('waktu');
		$waktu = explode(' ', $wkt);
		$waktu = $waktu[0];
		$pimpinan = Request::input('pimpinan');
		
		$rapat = new Rapat;
		$rapat->jenis_rapat = $jenis;
		$rapat->waktu = $tanggal . ' ' . $waktu . ':00';
		$rapat->tempat = $tempat;
		$rapat->pembahasan = $perihal;
		$rapat->pimpinan = $pimpinan;
		$rapat->save();
		
		return view('konten/entry', array('title'=>'Entry Rapat Baru', 'sukses'=>'', 'nav_entry'=>'', 'pimpinan'=> $this->genDaftarPejabat()));
	}
}
