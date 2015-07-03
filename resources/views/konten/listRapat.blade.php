@extends('base')

@section('addoncss')
<link href="{{ asset('/css/plugins/jqGrid/ui.jqgrid.css') }}" rel="stylesheet">
<link href="{{ asset('/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css') }}" rel="stylesheet">
<link href="{{ asset('/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
<style>
	th.ui-th-column div {
		white-space: normal !important;
		height: auto !important;
		padding: 2px;
	}
</style>
@endsection

@section('addonjs')
<!-- jqGrid -->
<script src="{{ asset('/js/plugins/jqGrid/i18n/grid.locale-en.js') }}"></script>
<script src="{{ asset('/js/plugins/jqGrid/jquery.jqGrid.min.js') }}"></script>
<script src="{{ asset('/js/plugins/toastr/toastr.min.js') }}"></script>

<script>
        $(document).ready(function () {
			@if(Session::has('update'))
		
				toastr.options = {
					closeButton: true,
					progressBar: true,
					showMethod: 'slideDown',
					timeOut: 3000
				};
				toastr.success('Rapat berhasil diubah.');

			@endif
			@if(Session::has('delete'))
		
				toastr.options = {
					closeButton: true,
					progressBar: true,
					showMethod: 'slideDown',
					timeOut: 3000
				};
				toastr.success('Rapat berhasil dihapus.');

			@endif
			
			// delete confirmation
			$('#modal-konfirmasi').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
			 
				// Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
				var id = div.data('id')
				 
				var modal = $(this)
				 
				// Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal .
				modal.find('#hapus-true').attr("href","{{ action('EditRapatController@getDelete') }}/"+id);
			 
			})
			
			$.getJSON( '{{ action("DaftarRapatController@getData") }}', function( mydata ) {
            }).done(function(mydata){
			
				
				function linkEdit(cellValue, options, rowdata, action)
				{
					return "<a href='{{ action('EditRapatController@getEdit') }}/" + rowdata.id + "'><span class='ui-icon ui-icon-pencil'>&nbsp;&nbsp;&nbsp;</span></a>";
				}
				
				function linkDelete(cellValue, options, rowdata, action)
				{
					return "<a href='javascript:;' data-id='"+ rowdata.id +"' data-toggle='modal' data-target='#modal-konfirmasi'><span class='ui-icon ui-icon-trash'>&nbsp;&nbsp;&nbsp;&nbsp;</span></a>";
				}
				
				
				function konfirmasi_kehadiran(cellValue, options, rowdata, action)
				{
					return "<a href='{{action('PejabatController@getKonfirmasiKehadiran')}}?id="+rowdata.id+"'><span class='ui-icon ui-icon-note'>&nbsp;&nbsp;&nbsp;&nbsp;</span></a>";
				}
				
				function laporan(cellValue, options, rowdata, action)
				{
					return "<a href='{{action('ReportController@getDetil')}}?id="+rowdata.id+"'><span class='ui-icon ui-icon-document'>&nbsp;&nbsp;&nbsp;&nbsp;</span></a>";
				}

				// Configuration for jqGrid Example 1
				$("#table_list_1").jqGrid({
					data: mydata,
					datatype: "local",
					height: 250,
					autowidth: true,
					shrinkToFit: true,
					rowNum: 14,
					rowList: [10, 20, 30],
					colNames: ['Jenis Rapat', 'Waktu', 'Tempat', 'Pembahasan', 'Pimpinan', 'Konfirmasi Kehadiran', 'Laporan', 'Edit', 'Delete'],
					colModel: [
						{name: 'jenis_rapat', index: 'jenis_rapat', width: 90},
						{name: 'waktu', index: 'waktu', width: 80, formatter: "date", formatoptions: { srcformat: "ISO8601Long", newformat: "F d, Y :: H:i" }},
						{name: 'tempat', index: 'tempat', width: 80},
						{name: 'pembahasan', index: 'pembahasan', width: 80},
						{name: 'pimpinan', index: 'pimpinan', width: 80 },
						{name: 'konfirmasi_kehadiran', index: 'konfirmasi_kehadiran', width: 50,align: 'center',formatter: konfirmasi_kehadiran},
						{name: 'laporan', index: 'laporan',width: 60,align: 'center',formatter: laporan},
						{name: 'edit', index: 'edit', width: 20,align: 'center',formatter: linkEdit},
						{name: 'delete', index: 'delete', width: 30,align: 'center',formatter: linkDelete}
						
					],
					pager: "#pager_list_1",
					viewrecords: true,
					//caption: "Example jqGrid 1",
					hidegrid: false
				});

				// Add responsive to jqGrid
				$(window).bind('resize', function () {
					var width = $('.jqGrid_wrapper').width();
					$('#table_list_1').setGridWidth(width);
				});
				
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
					
					<div class="jqGrid_wrapper">
						<table id="table_list_1"></table>
						<div id="pager_list_1"></div>
					</div>
					<div id="test">
					</div>

				</div>
			</div>
		</div>
		
		
		
	</div>
</div>

<!-- modal konfirmasi-->
<div id="modal-konfirmasi" class="modal inmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated fadeIn">
		 
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Konfirmasi</h4>
				<small>Menghapus data rapat</small>
			</div>
			 
			<div class="modal-body">
				<p>Apakah Anda yakin ingin menghapus data ini?</p>
			</div>
			 
			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-white" id="hapus-true">Ya</a>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
			</div>
		 
		</div>
	</div>
</div>
@endsection