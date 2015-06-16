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
    var id = [];
    var nama = [];
    var jabatan = [];
    var instansi = [];
    $(document).ready(function () {
            var data = {};
            var generaterow = function (i) {
                var row = {};
                row["id"] = id[i];
                row["nama"] = nama[i];
                row["jabatan"] = jabatan[i];
                row["instansi"] = instansi[i];
                return row;
            }

            for (var i = 0; i < nama.length+5; i++) {
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
                            { name: 'instansi', type: 'string' }
                        ],
                addrow: function (rowid, rowdata, position, commit) {
                    commit(true);
                },
                deleterow: function (rowid, commit) {
                    var datarow = $("#jqxgrid").jqxGrid('getrowdata', rowid);
                    var data = "action=delete&" + $.param({id: datarow.id})+ "&" +$.param({_token: '{{csrf_token()}}'});
                    $.ajax({
                        type: "POST",
                        url: '{{ action('PejabatController@postCrudPejabat')}}',
                        data: data,
                        success: function (data, status, xhr) {
                            // delete command is executed.
                            commit(true);
                        },
                        error: function(jqXHR, textStatus, errorThrown)
                        {
                            commit(false);
                        }
                    });

                }
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            // initialize jqxGrid
            $("#jqxgrid").jqxGrid(
                    {
                        width: 1050,
                        height: 500,
                        source: dataAdapter,
                        autoheight: true,
                        autowidth: true,
                        showtoolbar: true,
                        rendertoolbar: function (toolbar) {
                            var me = this;
                            var container = $("<div style='margin: 5px;'></div>");
                            toolbar.append(container);
                            container.append('<input id="addrowbutton" type="button" value="Tambah Data Pejabat" />');
                            container.append('<input style="margin-left: 5px;" id="deleterowbutton" type="button" value="Hapus Data Pejabat" />');
                            $("#addrowbutton").jqxButton();
                            $("#deleterowbutton").jqxButton();

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

                        },
                        columns: [
                            { text: 'No', datafield: 'no', width: 50 },
                            { text: 'Id', datafield: 'id', width: 50 },
                            { text: 'Nama', datafield: 'nama', width: 200 },
                            { text: 'Jabatan', datafield: 'jabatan', width: 250 },
                            { text: 'Instansi', datafield: 'instansi', width: 150 }
                        ]
                    });
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
                alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
                write(suggestion.value,'kepala','kemlu',0);
            }
        });

    });

        function write(nama,jabatan,instansi,nomor){
            var datarow = $("#jqxgrid").jqxGrid('getrowdata', nomor);
            if(typeof(datarow.nama)=="undefined"){
                $('#jqxgrid').jqxGrid('setcellvalue',nomor,'nama',nama);
                $('#jqxgrid').jqxGrid('setcellvalue',nomor,'jabatan',jabatan);
                $('#jqxgrid').jqxGrid('setcellvalue',nomor,'instansi',instansi);
            }else{
                write(nama,jabatan,instansi,nomor+1);
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