<?php
/**
 * Created by PhpStorm.
 * User: adwisatya
 * Date: 6/9/2015
 * Time: 2:01 PM
 */


namespace App\Http\Controllers;
use DB;
use Input;
class PejabatController extends Controller {
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function getJsonPejabat($instansi){
        switch ($instansi) {
            case 'polhukam':
                $instansi = 'polhukam';
                break;
            case 'kemdagri':
                $instansi = 'kemdagri';
                break;
            case 'kemlu':
                $instansi = 'kemlu';
                break;
            case 'kemhan':
                $instansi = 'kemhan';
                break;
            case 'kemenkumham':
                $instansi = 'kemenkumham';
                break;
            case 'kejagung' :
                $instansi = 'kejagung';
                break;
            case 'mabestni':
                $instansi = 'mabestni';
                break;
            case 'mabespolri':
                $instansi = 'mabespolri';
                break;
        }
        if($instansi != "all") {
            $listPejabats = DB::table('pejabats')->select('id','nama', 'jabatan', 'instansi', 'alamat', 'telepon', 'email')->where('instansi', $instansi)->get();
        }else{
            $listPejabats = DB::table('pejabats')->select('id','nama','jabatan','instansi','alamat','telepon','email')->get();
        }
        $listId = array();
        $listNama = array();
        $listJabatan = array();
        $listInstansi = array();
        $listAlamat = array();
        $listTelepon = array();
        $listEmail = array();
        foreach($listPejabats as $pejabat){
            array_push($listId,$pejabat->id);
            array_push($listNama,$pejabat->nama);
            array_push($listJabatan,$pejabat->jabatan);
            array_push($listInstansi,$pejabat->instansi);
            array_push($listAlamat,$pejabat->alamat);
            array_push($listTelepon,$pejabat->telepon);
            array_push($listEmail,$pejabat->email);
        }

        //return json_encode($listNama);
        return json_encode(array('count'=>count($listNama),'id'=>$listId,'nama'=>$listNama,'jabatan'=>$listJabatan,'instansi'=>$listInstansi,'alamat'=>$listAlamat,'telepon'=>$listTelepon,'email'=>$listEmail));
    }
    public function getPejabat($instansi)
    {
        return view('konten/gridPejabat', array('title'=>'Entry Pejabat Baru','instansi' => $instansi,'nav_pejabat'=>'','nav_'.$instansi=>''));
    }
    public function getSuggestedPejabat(){
        $suggestionList = DB::table('pejabats')->select('nama','instansi')->get();
        $tmpSuggestion = array();
        $arraySuggestion['suggestions'] = array();
        foreach($suggestionList as $suggestion){
            $tmpSuggestion['value'] = $suggestion->nama;
            $tmpSuggestion['data'] = $suggestion->instansi;
            array_push($arraySuggestion['suggestions'],$tmpSuggestion);
        }
        return json_encode($arraySuggestion);
        //return '{"suggestions": [{ "value": "United Arab Emirates", "data": "AE" },{ "value": "United Kingdom", "data": "UK" },
        //{ "value": "United States", "data": "US" },{ "value": "United Arab Emirates 123", "data": "AEA" }]}';
    }
    public function getKonfirmasiKehadiran(){
        return view('konten/konfirmasikehadiran', array('title'=>'Konfirmasi Kehadiran Pejabat'));
    }
    public function postCrudPejabat(){
        $action = Input::get('action');
        $id = Input::get('id');
        $nama = Input::get('nama');
        $jabatan = Input::get('jabatan');
        $instansi = Input::get('instansi');
        $alamat = Input::get('alamat');
        $telepon = Input::get('telepon');
        $email = Input::get('email');
        switch ($action){
            case 'delete':
                $query = DB::table('pejabats')->where('id',$id)->delete();
                break;
            case 'update':
                //$query = DB::table('pejabats')->where('id',$id)->update(['nama'=>$nama]);
                $query = DB::table('pejabats')->where('id',$id)->update(['nama'=>$nama,'jabatan'=>$jabatan,'instansi'=>$instansi,'alamat' => $alamat, 'telepon' => $telepon,'email' => $email]);
                return $id;
                break;
            case 'insert':
                $query = DB::table('pejabats')->insertGetId(['nama'=>$nama,'jabatan'=>$jabatan,'instansi'=>$instansi,'alamat' => $alamat, 'telepon' => $telepon,'email' => $email]);
                return $query;
                break;
        }
    }
}