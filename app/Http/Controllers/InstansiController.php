<?php namespace App\Http\Controllers;

use Request;

use App\Instansi;

class InstansiController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}
	
	/* list of Instansi */
	public function getIndex()
	{
		return view('konten/listInstansi', array('title'=>'Daftar Instansi', 'nav_instansi'=>''));
	}
	
	/* convert all data to JSON format */
	public function getData()
	{
		return Instansi::all()->toJson();
	}
	
	/* form entry */
	public function getEntry()
	{
		return view('konten/entryInstansi', array('title'=>'Entry Instansi', 'nav_instansi'=>''));
	}
	
	/* insert into DB */
	public function postEntry()
	{
		$nama = Request::input('nama');
		$alamat = Request::input('alamat');
		
		$instansi = new Instansi;
		$instansi->nama = $nama;
		$instansi->alamat = $alamat;
		$instansi->save();
		
		return view('konten/entryInstansi', array('title'=>'Entry Instansi', 'sukses'=>'', 'nav_instansi'=>''));
	}
	
	// Get data from database by id
	public function getEdit($id)
	{
		$instansi = Instansi::find($id);
		
		return view('konten/editInstansi', array('title'=>'Edit Instansi', 'nav_instansi'=>''))->with('instansi', $instansi);
	}

	// Save changes
	public function postEdit()
	{
		$id = Request::input('id');
		$nama = Request::input('nama');
		$alamat = Request::input('alamat');
		
		$instansi = Instansi::find($id);
		$instansi->nama = $nama;
		$instansi->alamat = $alamat;
		$instansi->save();
		
		return redirect('instansi/index')->with('update', true);
	}
	
	// Delete data by id
	public function getDelete($id)
	{
		$instansi = Instansi::find($id);
		$instansi->delete();
		
		return redirect('instansi/index')->with('delete', true);
	}

}
