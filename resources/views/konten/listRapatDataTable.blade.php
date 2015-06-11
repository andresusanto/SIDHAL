@extends('base')

@section('addoncss')
<link href="{{ asset('/css/plugins/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('/css/plugins/dataTables/dataTables.responsive.css') }}" rel="stylesheet">
<link href="{{ asset('/css/plugins/dataTables/dataTables.tableTools.min.css') }}" rel="stylesheet">
@endsection

@section('addonjs')
<!-- jqGrid -->
<script src="{{ asset('/js/plugins/dataTables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/js/plugins/dataTables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('/js/plugins/dataTables/dataTables.responsive.js') }}"></script>
<script src="{{ asset('/js/plugins/dataTables/dataTables.tableTools.js') }}"></script>

<script>
	$(document).ready(function () {
		$('.dataTables-example').dataTable({
			responsive: true,
			"dom": 'T<"clear">lfrtip',
			"tableTools": {
				"sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
			}
		});
	});

</script>
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Daftar Rapat</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li class="active">
                <strong>Daftar Rapat</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">   
	<div class="row">
		
		
		<div class="col-lg-12">
			<div class="ibox">
				<div class="ibox-title">
					<h5>Daftar Rapat</h5>
				</div>
				<div class="ibox-content">
					
					<table class="table table-striped table-bordered table-hover dataTables-example" >
					<thead>
                    <tr>
                        <th>Jenis Rapat</th>
                        <th>Waktu</th>
                        <th>Tempat</th>
                        <th>Pembahasan</th>
                        <th>Pimpinan</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
					
					<tfoot>
                    <tr>
                        <th>Jenis Rapat</th>
                        <th>Waktu</th>
                        <th>Tempat</th>
                        <th>Pembahasan</th>
                        <th>Pimpinan</th>
                        <th>Aksi</th>
                    </tr>
                    </tfoot>

				</div>
			</div>
		</div>
		
		
		
	</div>
</div>
@endsection