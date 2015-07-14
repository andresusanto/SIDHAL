<?php namespace App\Http\Controllers;

use Request;
use App\Rapat;
use App\Pejabat;
use Carbon\Carbon;

class EditRapatController extends Controller {

	public function __construct()
    {
        $this->middleware('auth');
    }
	
	// Get data from database by id
	public function getEdit($id)
	{
		$rapat = Rapat::find($id);
		
		$daftar_pejabat = Pejabat::all();
		$pimpinan = "";
		
		foreach ($daftar_pejabat as $pejabat){
			if ($pimpinan != "") $pimpinan .= ", ";
			$pimpinan .= '"' . $pejabat->nama . ' (' . $pejabat->instansi . ')"';
		}
		
		return view('konten/editRapat', array('title'=>'Edit Rapat', 'nav_rapat'=>'', 'pimpinan'=>$pimpinan, 'rapat'=>$rapat));
	}

	// Save changes
	public function postEdit()
	{
		$id = Request::input('id');
		$jenis = Request::input('jenis');
		$perihal = Request::input('perihal');
		$tempat = Request::input('tempat');
		$tanggal = Request::input('tanggal');
		$wkt = Request::input('waktu');
		$waktu = explode(' ', $wkt);
		$waktu = $waktu[0];
		$pimpinan = Request::input('pimpinan');
		
		$rapat = Rapat::find($id);
		$rapat->jenis_rapat = $jenis;
		$rapat->waktu = $tanggal . ' ' . $waktu . ':00';
		$rapat->tempat = $tempat;
		$rapat->pembahasan = $perihal;
		$rapat->pimpinan = $pimpinan;
		$rapat->save();
		
		return redirect('rapat/index')->with('update', true);
	}
	
	// Delete data by id
	public function getDelete($id)
	{
		$rapat = Rapat::find($id);
		$rapat->delete();
		
		return redirect('rapat/index')->with('delete', true);
	}

}
