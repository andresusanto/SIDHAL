@extends('base')

@section('addoncss')
<link href="{{ asset('/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
<link href="{{ asset('/css/plugins/steps/jquery.steps.css') }}" rel="stylesheet">
<link href="{{ asset('/js/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
<link href="{{ asset('/js/plugins/timepicker/jquery.timepicker.css') }}" rel="stylesheet">

@endsection

@section('addonjs')
<script src="{{ asset('/js/plugins/staps/jquery.steps.min.js') }}"></script>
<script src="{{ asset('/js/plugins/validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/js/plugins/timepicker/jquery.timepicker.js') }}"></script>
<script>
$(document).ready(function(){
	
	$("#form").steps({
		bodyTag: "fieldset",
		onStepChanging: function (event, currentIndex, newIndex)
		{
			// Always allow going backward even if the current step contains invalid fields!
			if (currentIndex > newIndex)
			{
				return true;
			}

			// Forbid suppressing "Warning" step if the user is to young
			if (newIndex === 3 && Number($("#age").val()) < 18)
			{
				return false;
			}

			var form = $(this);

			// Clean up if user went backward before
			if (currentIndex < newIndex)
			{
				// To remove error styles
				$(".body:eq(" + newIndex + ") label.error", form).remove();
				$(".body:eq(" + newIndex + ") .error", form).removeClass("error");
			}

			// Disable validation on fields that are disabled or hidden.
			form.validate().settings.ignore = ":disabled,:hidden";

			// Start validation; Prevent going forward if false
			return form.valid();
		},
		onStepChanged: function (event, currentIndex, priorIndex)
		{
			// Suppress (skip) "Warning" step if the user is old enough.
			if (currentIndex === 2 && Number($("#age").val()) >= 18)
			{
				$(this).steps("next");
			}

			// Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
			if (currentIndex === 2 && priorIndex === 3)
			{
				$(this).steps("previous");
			}
		},
		onFinishing: function (event, currentIndex)
		{
			var form = $(this);

			// Disable validation on fields that are disabled.
			// At this point it's recommended to do an overall check (mean ignoring only disabled fields)
			form.validate().settings.ignore = ":disabled";

			// Start validation; Prevent form submission if false
			return form.valid();
		},
		onFinished: function (event, currentIndex)
		{
			var form = $(this);

			// Submit form input
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
    $( "#userName" ).autocomplete({
      source: availableTags
    });
	$('#tanggal').datepicker({dateFormat: "dd-mm-yy"});
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
					<form id="form" action="#" class="wizard-big">
						<h1>Perihal Rapat</h1>
						<fieldset>
							<h2>Informasi Perihal Rapat</h2>
							<div class="row">
								<div class="col-lg-8">
									<div class="form-group">
										<label>Jenis Rapat</label>
										<input id="userName" name="userName" type="text" class="form-control required">
									</div>
									<div class="form-group">
										<label>Perihal Rapat</label>
										<input id="password" name="password" type="text" class="form-control required">
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
										<textarea class="form-control required" rows="4"></textarea>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label>Tanggal</label>
										<input id="tanggal" name="tanggal" type="text" class="form-control required">
									</div>
									<div class="form-group">
										<label>Waktu</label>
										<input id="waktu" name="waktu" type="text" class="form-control required">
									</div>
								</div>
							</div>
						</fieldset>

						<h1>Peserta</h1>
						<fieldset>
							<h2>Daftar Peserta Rapat</h2>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										Anggota
									</div>
								</div>
								<div class="col-lg-6">
									Anggota
								</div>
							</div>
						</fieldset>

						<h1>Finish</h1>
						<fieldset>
							<h2>Terms and Conditions</h2>
							<input id="acceptTerms" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms">I agree with the Terms and Conditions.</label>
						</fieldset>
					</form>
			</div>
		</div>
		
		
		
	</div>
</div>
@endsection