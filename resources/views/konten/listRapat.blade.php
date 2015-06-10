@extends('base')

@section('addoncss')
<link href="{{ asset('/css/plugins/jqGrid/ui.jqgrid.css') }}" rel="stylesheet">
<link href="{{ asset('/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css') }}" rel="stylesheet">
@endsection

@section('addonjs')
<!-- jqGrid -->
<script src="{{ asset('/js/plugins/jqGrid/i18n/grid.locale-en.js') }}"></script>
<script src="{{ asset('/js/plugins/jqGrid/jquery.jqGrid.min.js') }}"></script>
<script src="{{ asset('/js/plugins/jqGrid/jquery.jqGrid.min.js') }}"></script>

<script>
        $(document).ready(function () {

            var mydata;
			
			$.getJSON("{{ action('DaftarRapatController@getData') }}", function(result){
				$.each(result, function(i, field){
					$("#test").append(field + " ");
				});
			});
			
			// [
                // {id: "1", invdate: "2010-05-24", name: "test", note: "note", tax: "10.00", total: "2111.00"} ,
                // {id: "29", invdate: "2007-09-01", name: "test3", note: "note3", amount: "400.00", tax: "30.00", total: "430.00"}
            // ];
			
			function link(cellValue, options, rowdata, action)
			{
				return "<a href='" + rowdata.id + "'>+</a>";
			}
			
			function link2(cellValue, options, rowdata, action)
			{
				return "<a href='" + rowdata.name + "'>-</a>";
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
                colNames: ['Inv No', 'Jenis Rapat', 'Waktu', 'Tempat', 'Pembahasan', 'Pimpinan', 'Aksi 1', 'Aksi 2'],
                colModel: [
                    {name: 'id', index: 'id', width: 60},
                    {name: 'jenis_rapat', index: 'jenis_rapat', width: 90},
                    {name: 'waktu', index: 'waktu', width: 100, sorttype: "date", formatter: "date"},
                    {name: 'tempat', index: 'tempat', width: 80},
                    {name: 'pembahasan', index: 'pembahasan', width: 80},
                    {name: 'pimpinan', index: 'pimpinan', width: 80 },
                    {name: 'aksi1', index: 'aksi1', width: 40,align: 'center',formatter: link},
                    {name: 'aksi1', index: 'aksi1', width: 40,align: 'center',formatter: link2}
                    
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
@endsection