<?php
/**
 * Created by PhpStorm.
 * User: adwisatya
 * Date: 6/9/2015
 * Time: 2:01 PM
 */


namespace App\Http\Controllers;
use DB;

class PejabatController extends Controller {
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function getListPejabat(){
        $listPejabats = DB::table('pejabats')->select('nama','jabatan','instansi','alamat','telepon','email')->get();
        $listPejabat = array();
        $listNama = array();
        $listJabatan = array();
        $listInstansi = array();
        $listAlamat = array();
        $listTelepon = array();
        $listEmail = array();
        foreach($listPejabats as $pejabat){
            array_push($listNama,$pejabat->nama);
            array_push($listJabatan,$pejabat->jabatan);
            array_push($listInstansi,$pejabat->instansi);
            array_push($listAlamat,$pejabat->alamat);
            array_push($listTelepon,$pejabat->telepon);
            array_push($listEmail,$pejabat->email);
        }

        //return json_encode($listNama);
        return json_encode(array('nama'=>$listNama,'jabatan'=>$listJabatan,'instansi'=>$listInstansi,'alamat'=>$listAlamat,'telepon'=>$listTelepon,'email'=>$listEmail));
    }
    public function getGrid()
    {
        return view('konten/gridPejabat', array('title'=>'Entry Pejabat Baru'));
    }
}