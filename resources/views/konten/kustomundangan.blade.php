@extends('base')

@section('addoncss')
<link href="{{ asset('/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
<link href="{{ asset('/css/plugins/summernote/summernote.css') }}" rel="stylesheet">
<link href="{{ asset('/css/plugins/summernote/summernote-bs3.css') }}" rel="stylesheet">
<link href="{{ asset('/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
@endsection

@section('addonjs')
<script src="{{ asset('/js/plugins/staps/jquery.steps.min.js') }}"></script>
<script src="{{ asset('/js/plugins/validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/js/plugins/timepicker/jquery.timepicker.js') }}"></script>
<script src="{{ asset('/js/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('/js/plugins/summernote/summernote.min.js') }}"></script>
<script>
$(document).ready(function(){
	$('.summernote').summernote();
});
</script>
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Kustomisasi Undangan</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">Home</a>
            </li>
			<li>
                <a href="{{ action('DaftarRapatController@getIndex') }}">Daftar Rapat</a>
            </li>
			<li>
                <a href="{{ action('ReportController@getDetil') }}?id={{$id}}">Dokumen Rapat</a>
            </li>
            <li class="active">
                <strong>Kustomisasi Undangan</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">   
	<div class="row">
		<div class="col-lg-12">
		<form action="{{action('ReportController@postGenerate', $id)}}" method="POST">
			<div class="ibox float-e-margins">
                <div class="ibox-content no-padding">
					
					<input type="hidden" name="_token" value="{{csrf_token()}}" />
					<textarea class="summernote" name="konten">
						
						
						<table style="width: 100%;"><tr>
						<td>
						<table>
							<tr>
								<td>Nomor</td>
								<td>: UN-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/Polhukam/De-VII/HM.00.{{getdate()['mday']}}/{{getdate()['mon']}}/{{getdate()['year']}}</td>
							</tr>
							<tr>
								<td>Sifat </td>
								<td>: Biasa</td>
							</tr>
							<tr>
								<td>Lampiran</td>
								<td>: 1 (satu) lembar</td>
							</tr>
							<tr>
								<td>Hal </td>
								<td>: Undangan {{$jenis}}</td>
							</tr>
						</table>
						</td>
						<td style="width: 1%; white-space:nowrap;" valign="top">
						Jakarta, &nbsp;&nbsp;&nbsp;&nbsp; {{$bulan}} {{getdate()['year']}}
						</td>
						</tr></table>
						<br/><br/>
						Yth. Daftar Undangan Terlampir<br/>
						di -<br/>
						Jakarta<br/>
						<br/><br/>
						Dalam rangka {{$pembahasan}}, diharapkan kehadiran Bapak/Ibu dalam {{$jenis}} yang dilaksanakan:<br/><br/>
						<table>
							<tr>
								<td>pada hari, tanggal </td>
								<td>: {{$tanggal}}</td>
							</tr>
							<tr>
								<td>pukul </td>
								<td>: {{$waktu}} s.d selesai</td>
							</tr>
							<tr>
								<td valign="top">tempat</td>
								<td>: <?php echo str_replace("\n","\n<br/>&nbsp;&nbsp;", $tempat); ?></td>
							</tr>
							<tr>
								<td>Acara </td>
								<td>: {{$pembahasan}}</td>
							</tr>
							<tr>
								<td>Pimpinan </td>
								<td>: {{$pimpinan}}</td>
							</tr>
						</table><br/>
						Demikian dan atas kehadirannya diucapkan terima kasih.<br/><br/>
						<div style="padding-left: 460px;">
						Deputi Budang Koordinasi<br/>
						Komunikasi, Informasi, dan Aparatur<br/><br/><br/><br/><br/>
						Agus R. Barnas
						</div>
						Tembusan:<br/>
						1. Sesmenko Polhukam<br/>
						2. Karo Sidhal
						<hr/>
						<strong>NAMA PEJABAT YANG DIKIRIMI SURAT UNDANGAN</strong>
						<ol>
							@foreach ($pesertas as $peserta)
							<li>{{$peserta->pejabat->nama}}, <em>{{$peserta->pejabat->jabatan}}, {{$peserta->pejabat->instansi->nama}}</em></li>
							@endforeach
						</ol>
						<br/><br/>
						<div style="padding-left: 460px;">
						Deputi Budang Koordinasi<br/>
						Komunikasi, Informasi, dan Aparatur<br/><br/><br/><br/><br/>
						Agus R. Barnas
						</div>
						
						
						
					</textarea>
					
				</div>
			</div>
			<div style="text-align:center;">
			<input type="submit" value="Simpan" class="btn btn-primary" />&nbsp;
			<a href="{{ action('ReportController@getDetil') }}?id={{$id}}" class="btn btn-default">Batal</a>
			<br/>
			</div>
			<br/>
			</form>
		</div>
	</div>
</div>
@endsection