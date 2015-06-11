<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Rapat;

class DaftarRapatController extends Controller {

	public function __construct()
	{
		//$this->middleware('auth');
	}
	
	public function getIndex()
	{
		//$json_rapat = Rapat::find(1)->toJson();
		return view('konten/listRapatDataTable', array('title'=>'Entry Rapat Baru'));//->with('rapat', $json_rapat	);
	}
	
	public function getData()
	{
		return Rapat::all()->toJson();
	}

}
