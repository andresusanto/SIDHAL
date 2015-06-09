<?php namespace App\Http\Controllers;

class EntryController extends Controller {

	public function __construct()
	{
		//$this->middleware('auth');
	}

	public function getIndex()
	{
		return view('konten/entry', array('title'=>'Entry Rapat Baru'));
	}

}
