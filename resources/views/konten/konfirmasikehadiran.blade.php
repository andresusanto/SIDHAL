@extends('base')

@section('addoncss')
    <link rel="stylesheet" href="{{ asset('/jqwidget/jqwidgets/styles/jqx.base.css')}}" type="text/css" />

@endsection

@section('addonjs')

    <!-- jqxgrid -->
    <script type="text/javascript" src="{{ asset('/jqwidget/jqwidgets/jqxcore.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/jqwidget/jqwidgets/jqxdata.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/jqwidget/jqwidgets/jqxbuttons.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/jqwidget/jqwidgets/jqxscrollbar.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/jqwidget/jqwidgets/jqxmenu.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/jqwidget/jqwidgets/jqxcheckbox.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/jqwidget/jqwidgets/jqxlistbox.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/jqwidget/jqwidgets/jqxdropdownlist.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/jqwidget/jqwidgets/jqxgrid.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/jqwidget/jqwidgets/jqxgrid.selection.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/jqwidget/jqwidgets/jqxgrid.edit.js')}}"></script>
    <script type="text/javascript">


    //$(document).ready(function () {
    $.getJSON( '{{ action("KehadiranController@getJsonData",$id_rapat) }}', function( data ) {
    }).done(function(data){
			var dataCount = 0;
            //var data = {};
            var id = data.id;
            var nama = data.nama;
            var jabatan = data.jabatan;
            var instansi = data.instansi;
            var hadir = data.hadir;
            var keterangan = data.keterangan;
			var count = data.count;

            var generaterow = function (i) {
                var row = {};
                row["id"] = id[i];
                row["nama"] = nama[i];
                row["jabatan"] = jabatan[i];
                row["instansi"] = instansi[i];
                row["hadir"] = hadir[i];
                row["keterangan"] = keterangan[i];
                return row;
            }

            for (var i = 0; i < count; i++) {
                var row = generaterow(i);
                data[i] = row;
            }

            var source =
            {
                localdata: data,
                datatype: "local",
                datafields:
                        [
                            { name: 'id', type: 'integer' },
                            { name: 'nama', type: 'string' },
                            { name: 'jabatan', type: 'string' },
                            { name: 'instansi', type: 'string' },
                            { name: 'hadir', type: 'integer' },
                            { name: 'keterangan', type: 'string' }
                        ],
                addrow: function (rowid, rowdata, position, commit) {
                    commit(true);
                },
                deleterow: function (rowid, commit) {
                    commit(true);
                }
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            // initialize jqxGrid
            $("#jqxgrid").jqxGrid(
                    {
                        autoheight: true,
                        autowidth:true,
                        source: dataAdapter,
                        autoheight: true,
                        autowidth: true,
                        editable: true,
                        showtoolbar: true,
                        rendertoolbar: function (toolbar) {
                            var me = this;
                            var container = $("<div style='margin: 5px;'></div>");
                            toolbar.append(container);
                            container.append('<input id="addrowbutton" type="button" value="Tambah Data Pejabat" />');
                            container.append('<input style="margin-left: 5px;" id="deleterowbutton" type="button" value="Hapus Data Pejabat" />');
							container.append('<input style="margin-left: 5px;" id="savebutton" type="button" value="Simpan Daftar Pejabat" />');
                            $("#addrowbutton").jqxButton();
                            $("#deleterowbutton").jqxButton();
							$("#savebutton").jqxButton();

                            // create new row.
                            $("#addrowbutton").on('click', function () {
                                var datarow = generaterow();
                                var commit = $("#jqxgrid").jqxGrid('addrow', null, datarow);
                            });

                            // delete row.
                            $("#deleterowbutton").on('click', function () {
                                var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                                var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
                                if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
                                    var id = $("#jqxgrid").jqxGrid('getrowid', selectedrowindex);
                                    var commit = $("#jqxgrid").jqxGrid('deleterow', id);
                                }
                            });
							
							// save kehadiran
                            $("#savebutton").on('click', function () {
								var count =  $('#jqxgrid').jqxGrid('getdatainformation').rowscount;
								var clearData = "rapat_id={{ $id_rapat }}&" +$.param({_token: '{{csrf_token()}}'});
								$.ajax({
									type: "POST",
									url: "{{ action('KehadiranController@postClearKehadiran') }}",
									data: clearData
								});
								
								for(var i=1; i<=count; i++){
									var datarow = $("#jqxgrid").jqxGrid('getrowdata', i-1);
									var dataId = $('#jqxgrid').jqxGrid('getcellvalue',i-1,'id');
									var dataKeterangan = $('#jqxgrid').jqxGrid('getcellvalue',i-1,'keterangan');
									var dataHadir = $('#jqxgrid').jqxGrid('getcellvalue',i-1,'hadir');

									if(typeof(datarow.keterangan)=="undefined"){
										dataKeterangan = " ";
									}
									
									if(dataHadir){
										var valueHadir = 1;
									}
									else{
										var valueHadir = 0;
									}
									
									var dataKehadiran = "rapat_id={{ $id_rapat }}&pejabat_id=" + dataId + "&hadir=" + valueHadir + "&keterangan=" + dataKeterangan + "&" +$.param({_token: '{{csrf_token()}}'});
									
									if(typeof(datarow.id)!="undefined"){
										$.ajax({
											type: "POST",
											url: "{{ action('KehadiranController@postKehadiranPejabat') }}",
											data: dataKehadiran,
											success: dataCount = i
										});
										
									}
								}
								
								alert("Data berhasil disimpan");
								window.location="{{ action('DaftarRapatController@getIndex') }}";
								
                            });

                        },
                        columns: [
                            { text: 'No', datafield: 'no', width: 50, editable:false },
                            { text: 'Nama', datafield: 'nama', width: 200, editable:false },
                            { text: 'Jabatan', datafield: 'jabatan', width: 150, editable:false },
                            { text: 'Instansi', datafield: 'instansi', width: 150, editable:false },
                            { text: 'Hadir (Y/T)', datafield: 'hadir', width: 100,columntype:'checkbox' },
                            { text: 'Keterangan', datafield: 'keterangan',width:250},
                            { text: '', datafield: 'id', editable:false, width:0, hidden:true}
                        ]
                    });
        penomoran($('#jqxgrid').jqxGrid('getrows').length);
        });

    <!-- autocomplete -->

    $(function () {

        'use strict';
        $('#autocomplete-ajax').autocomplete({
            serviceUrl: '{{ action('PejabatController@getSuggestedPejabat') }}',
            dataType: 'json',
            lookupLimit: 3,
            minChars: 3,
            type: 'GET',
            onSelect: function (suggestion) {
                write(suggestion.data.id,suggestion.data.nama,suggestion.data.jabatan,suggestion.data.instansi,0);
				document.getElementById("autocomplete-ajax").value = "";
            }
        });

    });

        function write(id,nama,jabatan,instansi,nomor){
            var datarow = $("#jqxgrid").jqxGrid('getrowdata', nomor);
            if(typeof(datarow.nama)=="undefined"){
                $('#jqxgrid').jqxGrid('setcellvalue',nomor,'no',nomor+1);
                $('#jqxgrid').jqxGrid('setcellvalue',nomor,'id',id);
                $('#jqxgrid').jqxGrid('setcellvalue',nomor,'nama',nama);
                $('#jqxgrid').jqxGrid('setcellvalue',nomor,'jabatan',jabatan);
                $('#jqxgrid').jqxGrid('setcellvalue',nomor,'instansi',instansi);
                $('#jqxgrid').jqxGrid('setcellvalue',nomor,'keterangan','');
                $('#jqxgrid').jqxGrid('setcellvalue',nomor,'hadir','');
            }else{
                write(id,nama,jabatan,instansi,nomor+1);
            }
        }
    </script>
    <script>
        function penomoran(nomor){
            if(nomor>=0){
                $('#jqxgrid').jqxGrid('setcellvalue',nomor,'no',nomor+1);
                penomoran(nomor-1);
            }else{

            }
        }
    </script>
    <script type="text/javascript" src="{{asset('/js/jquery.autocomplete.js')}}"></script>
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Managemen Data Pejabat</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li class="active">
                <strong>Managemen Pejabat</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">   
	<div class="row">
        <div style="position: relative; height: 80px;width:30%;">
            <input class="form-control" placeholder="Ketik nama di sini" type="text" name="country" id="autocomplete-ajax" style="position: absolute; z-index: 2;"/>
        </div>
        <div id="selection-ajax"></div>
	</div>
    <br/>
    <div class="row">
        <div id="jqxgrid" class="col-lg-12">
        </div>
    </div>
</div>
@endsection