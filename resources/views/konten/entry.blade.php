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
$(document).ready(function(){
	@if (isset($sukses))
	
	toastr.options = {
		closeButton: true,
		progressBar: true,
		showMethod: 'slideDown',
		timeOut: 15000
	};
	toastr.success('Rapat berhasil ditambahkan. Silahkan periksa menu <strong>Daftar Rapat</strong>.');

	@endif
	
	$.validator.addMethod('tanggal', function (value) { 
		return /^[0-9]{4}-[0-9]{2}-[0-9]{2}$/.test(value); 
	}, 'Tanggal tidak valid');
	
	$.validator.addMethod('waktu', function (value) { 
		return /^[0-9]{2}:[0-9]{2} WIB$/.test(value); 
	}, 'Waktu tidak valid');

	$("#form").steps({
		bodyTag: "fieldset",
		onStepChanging: function (event, currentIndex, newIndex)
		{
			if (currentIndex > newIndex)
			{
				return true;
			}

			var form = $(this);

			if (currentIndex < newIndex)
			{
				$(".body:eq(" + newIndex + ") label.error", form).remove();
				$(".body:eq(" + newIndex + ") .error", form).removeClass("error");
			}
			
			if (newIndex == 3){
				$("#val_jenisrapat").html($("#jenis").val());
				$("#val_perihalrapat").html($("#perihal").val());
				$("#val_tempatrapat").html($("#tempat").val().replace("\n","<br/>"));
				$("#val_tanggalrapat").html($('#tanggal').val());
				$("#val_wakturapat").html($("#waktu").val());
				$("#val_pimpinanrapat").html($("#pimpinan").val());
				
			}

			form.validate().settings.ignore = ":disabled,:hidden";
			return form.valid();
		},
		onFinishing: function (event, currentIndex)
		{
			var form = $(this);
			form.validate().settings.ignore = ":disabled";
			return form.valid();
		},
		onFinished: function (event, currentIndex)
		{
			var form = $(this);
			form.submit();
		}
	});
			
	
	var availableTags = [
		"ActionScript",
		"AppleScript",
		"Asp",
		"BASIC",
		"C",
		"C++",
		"Clojure",
		"COBOL",
		"ColdFusion",
		"Erlang",
		"Fortran",
		"Groovy",
		"Haskell",
		"Java",
		"JavaScript",
		"Lisp",
		"Perl",
		"PHP",
		"Python",
		"Ruby",
		"Scala",
		"Scheme"
    ];
	
	var pimpinanRapat = [<?php echo $pimpinan; ?>];
	
    $( "#jenis" ).autocomplete({source: availableTags});
	$( "#pimpinan" ).autocomplete({source: pimpinanRapat});
	
	$('#tanggal').datepicker({dateFormat: "yy-mm-dd"});
	$('#waktu').timepicker({ 'timeFormat': 'H:i WIB' });
});
</script>
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Entry Rapat Baru</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li class="active">
                <strong>Entry Rapat</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">   
	<div class="row">
		
		
		<div class="col-lg-12">
			<div class="ibox-content p-md">
					<form id="form" action="" method="POST" class="wizard-big">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<h1>Perihal Rapat</h1>
						<fieldset>
							<h2>Informasi Perihal Rapat</h2>
							<div class="row">
								<div class="col-lg-8">
									<div class="form-group">
										<label>Jenis Rapat</label>
										<input id="jenis" name="jenis" type="text" class="form-control required">
									</div>
									<div class="form-group">
										<label>Perihal Rapat</label>
										<input id="perihal" name="perihal" type="text" class="form-control required">
									</div>
								</div>
								<div class="col-lg-4">
									<div class="text-center">
										<div style="margin-top: 20px">
											<i class="fa fa-sign-in" style="font-size: 180px;color: #e5e5e5 "></i>
										</div>
									</div>
								</div>
							</div>

						</fieldset>
						<h1>Waktu dan Tempat</h1>
						<fieldset>
							<h2>Informasi Waktu dan Tempat Rapat</h2>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label>Tempat</label>
										<textarea id="tempat" name="tempat" class="form-control required" rows="4"></textarea>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label>Tanggal</label>
										<input id="tanggal" name="tanggal" type="text" class="form-control tanggal required">
									</div>
									<div class="form-group">
										<label>Waktu</label>
										<input id="waktu" name="waktu" type="text" class="form-control waktu required">
									</div>
								</div>
							</div>
						</fieldset>

						<h1>Peserta</h1>
						<fieldset>
							<h2>Peserta Rapat</h2>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label>Pimpinan Rapat</label>
										<input id="pimpinan" name="pimpinan" type="text" class="form-control required">
									</div>
									Anggota rapat dapat diisi setelah rapat ditambahkan pada menu <strong>Daftar Rapat</strong>.
								</div>
								<div class="col-lg-6">
									
								</div>
							</div>
						</fieldset>

						<h1>Finalisasi</h1>
						<fieldset>
							<h2>Review Rapat</h2>
							<table>
								<tr>
									<td width="150px">Jenis Rapat</td>
									<td width="50px">:</td>
									<td id="val_jenisrapat"></td>
								</tr>
								<tr>
									<td>Perihal Rapat</td>
									<td>:</td>
									<td id="val_perihalrapat"></td>
								</tr>
								<hr/>
								<tr>
									<td>Tanggal</td>
									<td>:</td>
									<td id="val_tanggalrapat"></td>
								</tr>
								<tr>
									<td>Waktu</td>
									<td>:</td>
									<td id="val_wakturapat"></td>
								</tr>
								<tr>
									<td valign="top">Tempat</td>
									<td valign="top">:</td>
									<td id="val_tempatrapat"></td>
								</tr>
								<hr/>
								<tr>
									<td>Pimpinan Rapat</td>
									<td>:</td>
									<td id="val_pimpinanrapat"></td>
								</tr>
							</table>
						</fieldset>
					</form>
			</div>
		</div>
		
		
		
	</div>
</div>
@endsection