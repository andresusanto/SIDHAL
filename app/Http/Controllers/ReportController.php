<?php namespace App\Http\Controllers;

use App\Pejabat;
use App\Rapat;
use App\Undangan;
use Request;
use Redirect;
use PDF;

class ReportController extends Controller {

	public function __construct()
	{
		//$this->middleware('auth');
	}
	
	private $bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	private $hari = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');

	public function getKustomisasi($id)
	{
		$format = Request::input('format');
		if (! is_numeric($format)) return "Illegal Action Detected";
		
		$rapat = Rapat::find($id);
		
		if ($rapat){
			$ts = getdate(strtotime($rapat->waktu));
			
			$tanggal = $this->hari[$ts['wday']] . ', ' . $ts['mday'] . ' ' . $this->bulan[$ts['mon']] . ' ' . $ts['year'];
			$waktu = sprintf('%02d', $ts['hours']) . '.' . sprintf('%02d', $ts['minutes']);
			
			return view("konten/kustomundangan", array('title'=>'Dokumen Rapat', 'id'=>$id, 'undangan'=>'',        'waktu'=> $waktu, 'tanggal'=> $tanggal, 'bulan'=>$this->bulan[getdate()['mon']], 'jenis' => $rapat->jenis_rapat, 'tempat' => str_replace('\n','\n<br/>',$rapat->tempat), 'pembahasan'=> $rapat->pembahasan, 'pimpinan'=>$rapat->pimpinan, 'pesertas'=>$rapat->peserta));
		}
	}
	
	public function getDetil()
	{
		$id = Request::input('id');
		$rapat = Rapat::find($id);
		
		if ($rapat){
			if ($rapat->undangan){
				$undangan = $rapat->undangan->tipe;
			}else{
				$undangan = '';
			}
			
			
			return view("konten/report", array('title'=>'Dokumen Rapat', 'id'=>$id, 'undangan'=>$undangan, 'judul'=>$rapat->pembahasan));
		}
	}
	
	public function postGenerate($id)
	{
		$rapat = Rapat::find($id);
		
		if ($rapat){
			$konten = Request::input('konten');
			$konten = str_replace('<hr>', '<div style="page-break-after: always;"></div>', $konten);
			$pdf = PDF::loadView("dokumen/genundangan" , array('konten'=> $konten));
			$pdf->save("gen/undangan_$id.pdf");
			
			if ($rapat->undangan){
				$undangan = $rapat->undangan;
			}else{
				$undangan = new Undangan();
			}
			
			$undangan->tipe = 'Z';
			$rapat->undangan()->save($undangan);
			
			
			return Redirect::to(action('ReportController@getDetil') . '?id=' . $id)->with('message', 'GEN1');
		}
	}
	
	public function getGenerate($id)
	{
		$format = Request::input('format');
		if (! is_numeric($format)) return "Illegal Action Detected";
		
		$rapat = Rapat::find($id);
		
		if ($rapat){
			
			if ($rapat->undangan){
				$undangan = $rapat->undangan;
			}else{
				$undangan = new Undangan();
			}
			
			$undangan->tipe = $format;
			$rapat->undangan()->save($undangan);
			
			return Redirect::to(action('ReportController@getDetil') . '?id=' . $id)->with('message', 'GEN1');
		}
	}
	
	public function getUndangan($id, $format)
	{
		if (! is_numeric($format)) return "Illegal Action Detected";
		$rapat = Rapat::find($id);
		
		if ($rapat){
			$ts = getdate(strtotime($rapat->waktu));
			
			$tanggal = $this->hari[$ts['wday']] . ', ' . $ts['mday'] . ' ' . $this->bulan[$ts['mon']] . ' ' . $ts['year'];
			$waktu = sprintf('%02d', $ts['hours']) . '.' . sprintf('%02d', $ts['minutes']);
			$pdf = PDF::loadView("dokumen/undangan_$format" , array('waktu'=> $waktu, 'tanggal'=> $tanggal, 'bulan'=>$this->bulan[getdate()['mon']], 'jenis' => $rapat->jenis_rapat, 'tempat' => str_replace('\n','\n<br/>',$rapat->tempat), 'pembahasan'=> $rapat->pembahasan, 'pimpinan'=>$rapat->pimpinan, 'pesertas'=>$rapat->peserta));
			return $pdf->download("undangan_$id.pdf");
		}
	}
	
	public function getDaftarhadir($id)
	{
		$rapat = Rapat::find($id);
		
		if ($rapat){
			$ts = getdate(strtotime($rapat->waktu));
			
			$tanggal = $this->hari[$ts['wday']] . ', ' . $ts['mday'] . ' ' . $this->bulan[$ts['mon']] . ' ' . $ts['year'];
			$waktu = sprintf('%02d', $ts['hours']) . '.' . sprintf('%02d', $ts['minutes']);
			
			$hitung = $rapat->peserta->count();
			
			$pdf = PDF::loadView("dokumen/daftarhadir" , array('hitung'=>$hitung,'waktu'=> $waktu, 'tanggal'=> $tanggal, 'bulan'=>$this->bulan[getdate()['mon']], 'jenis' => $rapat->jenis_rapat, 'tempat' => str_replace('\n','\n<br/>',$rapat->tempat), 'pembahasan'=> $rapat->pembahasan, 'pimpinan'=>$rapat->pimpinan, 'pesertas'=>$rapat->peserta))->setOrientation('landscape');
			return $pdf->download("daftarhadir_$id.pdf");
		}
	}
	
	public function getKonfirmasi($id)
	{
		$rapat = Rapat::find($id);
		
		if ($rapat){
			$ts = getdate(strtotime($rapat->waktu));
			
			$tanggal = $this->hari[$ts['wday']] . ', ' . $ts['mday'] . ' ' . $this->bulan[$ts['mon']] . ' ' . $ts['year'];
			$waktu = sprintf('%02d', $ts['hours']) . '.' . sprintf('%02d', $ts['minutes']);
			
			$pdf = PDF::loadView("dokumen/konfirmasi" , array('waktu'=> $waktu, 'tanggal'=> $tanggal, 'bulan'=>$this->bulan[getdate()['mon']], 'jenis' => $rapat->jenis_rapat, 'tempat' => str_replace('\n','\n<br/>',$rapat->tempat), 'pembahasan'=> $rapat->pembahasan, 'pimpinan'=>$rapat->pimpinan, 'pesertas'=>$rapat->kehadiran, 'i'=>1));
			return $pdf->download("konfirmasihadir_$id.pdf");
		}
	}
	
}
