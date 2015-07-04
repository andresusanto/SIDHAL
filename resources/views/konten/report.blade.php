@extends('base')

@section('addoncss')
<link href="{{ asset('/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
<link href="{{ asset('/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
<link href="{{ asset('/css/plugins/steps/jquery.steps.css') }}" rel="stylesheet">
<link href="{{ asset('/js/plugins/timepicker/jquery.timepicker.css') }}" rel="stylesheet">
<link href="{{ asset('/js/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">

@endsection

@section('addonjs')
<script src="{{ asset('/js/plugins/staps/jquery.steps.min.js') }}"></script>
<script src="{{ asset('/js/plugins/validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/js/plugins/timepicker/jquery.timepicker.js') }}"></script>
<script src="{{ asset('/js/plugins/toastr/toastr.min.js') }}"></script>
<script>
var base_unduh = "{{ action('ReportController@getGenerate', $id) }}";
var base_kustom = "{{ action('ReportController@getKustomisasi', $id) }}";

function unduh(){
	window.location = base_unduh + '?format=' + $('#formatlaporan').val();
}

function kustomize(){
	window.location = base_kustom + '?format=' + $('#formatlaporan').val();
}

@if (Session::get('message') == 'GEN1')
$(document).ready(function(){
	toastr.options = {
		closeButton: true,
		progressBar: true,
		showMethod: 'slideDown',
		timeOut: 15000
	};
	toastr.success('Undangan berhasil digenerate');
});
@endif
</script>
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>{{$judul}}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">Home</a>
            </li>
			<li>
                <a href="{{ action('DaftarRapatController@getIndex') }}">Daftar Rapat</a>
            </li>
            <li class="active">
                <strong>Dokumen Rapat</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">   
	<div class="row">
		<div class="col-lg-12">
			<div class="form-group">
			  <label for="formatlaporan" class="col-lg-2 control-label">Buat Undangan</label>
			  <div class="col-lg-5">
				<select class="form-control" id="formatlaporan">
				  <option value="1">Format Tingkat Menteri</option>
				  <option value="2">Format Tingkat ESELON 1</option>
				  <option value="3">Format Tingkat ESELON 2</option>
				  <option value="4">Format Biasa</option>
				</select>
				<br/>	
				<a href="javascript:void(0);" onclick="unduh()" class="btn btn-success">Buat Undangan</a>&nbsp;<a href="javascript:void(0);" class="btn btn-success" onclick="kustomize()">Kustomisasi Undangan</a>
				
				@if ($undangan == 'Z')
					<br/><br/><strong>Unduh:</strong><br/>
					<a href="{{ url("/gen/undangan_$id.pdf") }}"><img src="{{ asset('/img/pdf.png') }}" /> Undangan</a>
				@elseif ($undangan != '')
					<br/><br/><strong>Unduh:</strong><br/>
					<a href="{{ action('ReportController@getUndangan', array($id, $undangan)) }}"><img src="{{ asset('/img/pdf.png') }}" /> Undangan</a>
				@endif
				
			  </div>
			</div>
		</div>
	</div>
	<br/><br/>
	<div class="row">
		<div class="col-lg-12">
			<div class="form-group">
			  <label for="formatlaporan" class="col-lg-2 control-label">Kehadiran</label>
			  <div class="col-lg-6">
				<a href="{{ action('ReportController@getKonfirmasi', $id) }}"><img src="{{ asset('/img/pdf.png') }}" /> Konfirmasi Kehadiran</a><br/><a href="{{ action('ReportController@getDaftarhadir', $id) }}"><img src="{{ asset('/img/pdf.png') }}" /> Daftar Hadir</a>
			  </div>
			</div>
		</div>
	</div>
</div>
@endsection