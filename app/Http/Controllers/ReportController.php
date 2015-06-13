<?php namespace App\Http\Controllers;

use App\Pejabat;
use App\Rapat;
use Request;
use PDF;

class ReportController extends Controller {

	public function __construct()
	{
		//$this->middleware('auth');
	}
	
	private $bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	private $hari = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');

	public function getUndangan()
	{
		$id = Request::input('id');
		$rapat = Rapat::find($id);
		
		if ($rapat){
			$ts = getdate(strtotime($rapat->waktu));
			
			$tanggal = $this->hari[$ts['wday']] . ', ' . $ts['mday'] . ' ' . $this->bulan[$ts['mon']] . ' ' . $ts['year'];
			$waktu = sprintf('%02d', $ts['hours']) . '.' . sprintf('%02d', $ts['minutes']);
			$pdf = PDF::loadView("dokumen/undangan" , array('waktu'=> $waktu, 'tanggal'=> $tanggal, 'bulan'=>$this->bulan[getdate()['mon']], 'jenis' => $rapat->jenis_rapat, 'tempat' => str_replace('\n','\n<br/>',$rapat->tempat), 'pembahasan'=> $rapat->pembahasan, 'pimpinan'=>$rapat->pimpinan, 'pesertas'=>$rapat->peserta));
			return $pdf->download("undangan_$id.pdf");
		}
	}
}
