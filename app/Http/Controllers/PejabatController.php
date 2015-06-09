<?php
/**
 * Created by PhpStorm.
 * User: adwisatya
 * Date: 6/9/2015
 * Time: 2:01 PM
 */

namespace App\Http\Controllers;


class PejabatController extends Controller {
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function getGrid()
    {
        return view('konten/gridPejabat', array('title'=>'Entry Pejabat Baru'));
    }
}