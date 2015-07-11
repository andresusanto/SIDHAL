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
        $this->middleware('auth');
    }

    public function getJsonPejabat($instansi){

        if($instansi != "all") {
            $listPejabats = DB::table('pejabats')->select('id','nama', 'jabatan', 'instansi_id', 'alamat', 'telepon', 'email')->where('instansi_id', $instansi)->get();
        }else{
            $listPejabats = DB::table('pejabats')->select('id','nama','jabatan','instansi_id','alamat','telepon','email')->get();
        }
        $listId = array();
        $listNama = array();
        $listJabatan = array();
        $listInstansi = array();
        $listInstansiNama = array();
        $listAlamat = array();
        $listTelepon = array();
        $listEmail = array();
        foreach($listPejabats as $pejabat){
            array_push($listId,$pejabat->id);
            array_push($listNama,$pejabat->nama);
            array_push($listJabatan,$pejabat->jabatan);
            array_push($listInstansi,$pejabat->instansi_id);
            array_push($listInstansiNama,DB::table('instansis')->select('nama')->where('id',$pejabat->instansi_id)->get());
            array_push($listAlamat,$pejabat->alamat);
            array_push($listTelepon,$pejabat->telepon);
            array_push($listEmail,$pejabat->email);
        }
        return json_encode(array('count'=>count($listNama),'id'=>$listId,'nama'=>$listNama,'jabatan'=>$listJabatan,'instansi_id'=>$listInstansi,'alamat'=>$listAlamat,'telepon'=>$listTelepon,'email'=>$listEmail,'instansi_nama'=>$listInstansiNama));
    }

    public function getPejabat($instansi)
    {
        return view('konten/gridPejabat', array('title'=>'Entry Pejabat Baru','instansi_id' => $instansi,'nav_pejabat'=>'','nav_'.$instansi=>''));
    }

    public function getSuggestedPejabat(){
        $keyword = Input::get('query');
        $suggestionList = DB::table('pejabats')->select('id','nama','instansi_id','jabatan')->where('nama','LIKE','%'.$keyword.'%')->get();
        $tmpSuggestion = array();
        $arraySuggestion['suggestions'] = array();
        foreach($suggestionList as $suggestion){
            $tmpSuggestion['value'] = $suggestion->nama." dari ".$suggestion->instansi;
            $tmpSuggestion['data'] = array('id'=>$suggestion->id,'nama'=>$suggestion->nama,'instansi_id'=>$suggestion->instansi_id,'jabatan'=>$suggestion->jabatan);
            array_push($arraySuggestion['suggestions'],$tmpSuggestion);
        }
        return json_encode($arraySuggestion);

    }
    public function getKonfirmasiKehadiran(){
        $id = Input::get('id');
        return view('konten/konfirmasikehadiran', array('title'=>'Konfirmasi Kehadiran Pejabat','nav_kehadiran'=>'','id_rapat'=>$id));
    }
    public function postCrudPejabat(){
        $action = Input::get('action');
        $id = Input::get('id');
        $nama = Input::get('nama');
        $jabatan = Input::get('jabatan');
        $instansi = Input::get('instansi_id');
        $alamat = Input::get('alamat');
        $telepon = Input::get('telepon');
        $email = Input::get('email');
        switch ($action){
            case 'delete':
                $query = DB::table('pejabats')->where('id',$id)->delete();
                break;
            case 'update':
                $query = DB::table('pejabats')->where('id',$id)->update(['nama'=>$nama,'jabatan'=>$jabatan,'instansi_id'=>$instansi,'alamat' => $alamat, 'telepon' => $telepon,'email' => $email]);
                return $id;
                break;
            case 'insert':
                $query = DB::table('pejabats')->insertGetId(['nama'=>$nama,'jabatan'=>$jabatan,'instansi_id'=>$instansi,'alamat' => $alamat, 'telepon' => $telepon,'email' => $email]);
                return $query;
                break;
        }
    }
}