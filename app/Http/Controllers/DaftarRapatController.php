<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Rapat;

use DB;

class DaftarRapatController extends Controller {

	public function __construct()
	{
		//$this->middleware('auth');
	}
	
	/* list of rapat */
	public function getIndex()
	{
		return view('konten/listRapat', array('title'=>'Daftar Rapat', 'nav_rapat'=>''));
	}
	
	/* convert all data to JSON format */
	public function getData()
	{
		return Rapat::all()->toJson();
	}
	
	/* search data rapat */
	public function postSearch()
	{
		$rapat = Input::get('rapat-search');
		
		$result = $this->getSearchResult($rapat);
		
		return view('konten/resultRapat', array('title'=>'Daftar Rapat', 'nav_rapat'=>''))->with('result', $result)->with('search', $rapat);
	}

	/* convert search data to JSON format */
	public function getSearchResult($rapat)
	{
		$search = DB::table('rapats')
                    ->where('jenis_rapat', 'like', '%'.$rapat.'%')
                    ->orwhere('tempat', 'like', '%'.$rapat.'%')
                    ->orwhere('pembahasan', 'like', '%'.$rapat.'%')
                    ->orwhere('pimpinan', 'like', '%'.$rapat.'%')
					->get();
					
		return json_encode($search);
	}
}
