@extends('base')

@section('addoncss')
<link href="{{ asset('/js/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
<link href="{{ asset('/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
@endsection

@section('addonjs')
<script src="{{ asset('/js/plugins/validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/js/plugins/toastr/toastr.min.js') }}"></script>
<script>
	 $(document).ready(function(){
		@if (isset($sukses))

		toastr.options = {
			closeButton: true,
			progressBar: true,
			showMethod: 'slideDown',
			timeOut: 3000
		};
		toastr.success('Pengguna berhasil ditambahkan. Silahkan periksa menu <strong>Daftar Pengguna</strong>.');

		@endif
		 $("#form").validate({
			 rules: {
				 password: {
					 required: true,
					 minlength: 3
				 },
				 confirm: {
					 equalTo: "#password"
				 }
			 }
		 });
	});
</script>
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Entry Pengguna</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
             <li>
                <a href="{{ action('UserController@getIndex') }}">Daftar Pengguna</a>
            </li>
            <li class="active">
                <strong>Entry Pengguna</strong>
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
					<form id="form" action="{{ action('UserController@postEdit') }}" method="POST" class="form-horizontal">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value="{{ $user->id }}">
						<div class="form-group">
							<label class="col-sm-2 control-label">Nama</label>
							<div class="col-sm-10">
								<input id="name" name="name" type="text" placeholder="Name" class="form-control required" value="{{ $user->name }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<input id="email" name="email" type="email" placeholder="email@email.com" class="form-control required" value="{{ $user->email }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Password*</label>
							<div class="col-sm-10">
								<input id="password" name="password" type="password" placeholder="Password" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Confirm Password*</label>
							<div class="col-sm-10">
								<input id="confirm" name="confirm" type="password" placeholder="Password Confirm" class="form-control required">
							</div>
						</div>

						<div class="hr-line-dashed"></div>
						<div class="form-group">
							<div class="col-sm-4 col-sm-offset-2">
								<a href="{{ action('UserController@getIndex') }}" class="btn btn-white">Cancel</a>
								<button class="btn btn-primary" type="submit">Save</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection