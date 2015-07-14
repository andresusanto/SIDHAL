@extends('base')

@section('addoncss')
<link href="{{ asset('/js/plugins/timepicker/jquery.timepicker.css') }}" rel="stylesheet">
<link href="{{ asset('/js/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
@endsection

@section('addonjs')
<script src="{{ asset('/js/plugins/validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/js/plugins/timepicker/jquery.timepicker.js') }}"></script>
<script>
	$.validator.addMethod('tanggal', function (value) { 
		return /^[0-9]{4}-[0-9]{2}-[0-9]{2}$/.test(value); 
	}, 'Tanggal tidak valid');
	
	$.validator.addMethod('waktu', function (value) { 
		return /^[0-9]{2}:[0-9]{2} WIB$/.test(value); 
	}, 'Waktu tidak valid');
	
	$('#tanggal').datepicker({dateFormat: "yy-mm-dd"});
	$('#waktu').timepicker({ 'timeFormat': 'H:i WIB' });
	
	var pimpinanRapat = [<?php echo $pimpinan; ?>];
	
	$( "#pimpinan" ).autocomplete({source: pimpinanRapat});
</script>
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Rapat</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
             <li>
                <a href="{{ action('DaftarRapatController@getIndex') }}">Daftar Rapat</a>
            </li>
            <li class="active">
                <strong>Edit Rapat</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">   
	 <div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				
				<div class="ibox-content">
					<form id="form" action="{{ action('EditRapatController@postEdit') }}" method="POST" class="form-horizontal">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value="{{ $rapat->id }}">
						<div class="form-group">
							<label class="col-sm-2 control-label">Jenis Rapat</label>
							<div class="col-sm-10">
								<input id="jenis" name="jenis" type="text" class="form-control required" value="{{ $rapat->jenis_rapat }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Perihal Rapat</label>
							<div class="col-sm-10">
								<input id="perihal" name="perihal" type="text" class="form-control required" value="{{ $rapat->pembahasan }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Tempat</label>
							<div class="col-sm-10">
								<textarea id="tempat" name="tempat" class="form-control required" rows="4">{{ $rapat->tempat }}</textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Tanggal</label>
							<div class="col-sm-10">
								<input id="tanggal" name="tanggal" type="text" class="form-control tanggal required" value="{{ date('Y-m-d',strtotime($rapat->waktu)) }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Waktu</label>
							<div class="col-sm-10">
								<input id="waktu" name="waktu" type="text" class="form-control waktu required" value="{{ date('H:i',strtotime($rapat->waktu)) }} WIB">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Pimpinan Rapat</label>
							<div class="col-sm-10">
								<input id="pimpinan" name="pimpinan" type="text" class="form-control required" value="{{ $rapat->pimpinan }}">
							</div>
						</div>

						<div class="hr-line-dashed"></div>
						<div class="form-group">
							<div class="col-sm-4 col-sm-offset-2">
								<a href="{{ action('DaftarRapatController@getIndex') }}" class="btn btn-white">Cancel</a>
								<button class="btn btn-primary" type="submit">Save changes</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection