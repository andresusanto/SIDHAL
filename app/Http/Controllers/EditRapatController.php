<?php namespace App\Http\Controllers;

use Request;
use App\Rapat;
use Carbon\Carbon;

class EditRapatController extends Controller {

	// Get data from database by id
	public function getEdit($id)
	{
		$rapat = Rapat::find($id);
		
		return view('konten/editRapat', array('title'=>'Edit Rapat', 'nav_rapat'=>''))->with('rapat', $rapat);
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
