<?php namespace App\Http\Controllers;

use App\Pejabat;
use App\Rapat;
use Request;

class EntryController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getIndex()
	{
		$daftar_pejabat = Pejabat::all();
		$pimpinan = "";
		
		foreach ($daftar_pejabat as $pejabat){
			if ($pimpinan != "") $pimpinan .= ", ";
			$pimpinan .= '"' . $pejabat->nama . ' (' . $pejabat->instansi . ')"';
		}
		
		return view('konten/entry', array('title'=>'Entry Rapat Baru', 'nav_entry'=>'', 'pimpinan'=>$pimpinan));
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
		
		return view('konten/entry', array('title'=>'Entry Rapat Baru', 'sukses'=>'', 'nav_entry'=>''));
	}
}
