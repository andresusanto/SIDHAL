<?php namespace App\Http\Controllers;

use Request;
use Hash;

use App\User;

class UserController extends Controller {

	public function __construct()
    {
        $this->middleware('auth');
    }
	
	/* list of users */
	public function getIndex()
	{
		return view('konten/listUser', array('title'=>'Daftar Pengguna'));
	}
	
	/* convert all data to JSON format */
	public function getData()
	{
		return User::all()->toJson();
	}
	
	public function getEntry()
	{
		return view('konten/entryUser', array('title'=>'Entry Pengguna'));
	}
	
	public function postEntry()
	{
		$name = Request::input('name');
		$email = Request::input('email');
		$password = Hash::make(Request::input('password'));
		
		$user = new User;
		$user->name = $name;
		$user->email = $email;
		$user->password = $password;
		$user->save();
		
		return view('konten/entryUser', array('title'=>'Entry Pengguna', 'sukses'=>''));
	}
	
	
	// Get data from database by id
	public function getEdit($id)
	{
		$user = User::find($id);
		
		return view('konten/editUser', array('title'=>'Edit Pengguna'))->with('user', $user);
	}
	
	public function postEdit()
	{
		$id = Request::input('id');
		$name = Request::input('name');
		$email = Request::input('email');
		$password = Hash::make(Request::input('password'));
		
		$user = User::find($id);
		$user->name = $name;
		$user->email = $email;
		$user->password = $password;
		$user->save();
		
		return redirect('user/index')->with('update', true);
	}
	
	// Delete data by id
	public function getDelete($id)
	{
		$user = User::find($id);
		$user->delete();
		
		return redirect('user/index')->with('delete', true);
	}
	

}
