@extends('base')

@section('addoncss')
    <link rel="stylesheet" href="{{ asset('/jqwidget/jqwidgets/styles/jqx.base.css')}}" type="text/css" />
@endsection

@section('addonjs')
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
        $(document).ready(function () {
            $.getJSON( '{{ action("PejabatController@getJsonPejabat",'kemlu') }}', function( data ) {
            }).done(function(data){
                var count = data.count;
                var id = data.id;
                var nama = data.nama;
                var jabatan = data.jabatan;
                var instansi =  data.instansi;
                var alamat = data.alamat;
                var telepon =  data.telepon;
                var email = data.email;

                var generaterow = function (i) {
                    var row = {};
                    row["id"] = id[i];
                    row["nama"] = nama[i];
                    row["jabatan"] = jabatan[i];
                    row["instansi"] = instansi[i];
                    row["alamat"] = alamat[i];
                    row["telepon"] = telepon[i];
                    row["email"] = email[i];
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
                                { name: 'alamat', type: 'string' },
                                { name: 'telepon', type: 'string' },
                                { name: 'email', type: 'string' }
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

                    },
                    updaterow: function (rowid, rowdata, commit) {
                        if(rowdata.id > 0){
                            var _action = "update";
                        }else{
                            var _action = "insert";
                        }
                        if((rowdata.nama) && (rowdata.jabatan) && (rowdata.instansi) && (rowdata.alamat) && (rowdata.telepon) && (rowdata.email)) {
                            var datatoupdate = "action=" + _action + "&nama=" + rowdata.nama
                                    + "&jabatan=" + rowdata.jabatan
                                    + "&instansi=" + rowdata.instansi + "&" + "&alamat=" + rowdata.alamat
                                    + "&telepon=" + rowdata.telepon + "&email=" + rowdata.email
                                    + "&" + $.param({_token: '{{csrf_token()}}'})
                                    + "&" + $.param({id: rowdata.id});
                            $.ajax({
                                type: "POST",
                                url: '{{ action('PejabatController@postCrudPejabat')}}',
                                data: datatoupdate,
                                success: function (data, status, xhr) {
                                    commit(true);
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    commit(false);
                                }
                            }).done(function( data ) {
                                $("#jqxgrid").jqxGrid('setcellvalue', rowid, 'id', data);
                            });
                        }
                        commit(true);
                    }
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                // initialize jqxGrid
                $("#jqxgrid").jqxGrid(
                        {
                            width: 1050,
                            height: 500,
                            source: dataAdapter,
                            //autoheight: true,
                            editable: true,
                            showtoolbar: true,
                            rendertoolbar: function (toolbar) {
                                var me = this;
                                var container = $("<div style='margin: 5px;'></div>");
                                toolbar.append(container);
                                container.append('<input id="addrowbutton" type="button" value="Tambah Data Pejabat" />');
                                container.append('<input style="margin-left: 5px;display:none;" id="addmultiplerowsbutton" type="button" value="Tambah Data Pejabat" />');
                                container.append('<input style="margin-left: 5px;" id="deleterowbutton" type="button" value="Hapus Data Pejabat" />');
                                container.append('<input style="margin-left: 5px;display:none;" id="updaterowbutton" type="button" value="Update Selected Row" />');
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
                                { text: 'Jabatan', datafield: 'jabatan', width: 150 },
                                { text: 'Instansi', datafield: 'instansi', width: 150 },
                                { text: 'Alamat', datafield: 'alamat', width: 200, cellsalign: 'right' },
                                { text: 'Telepon', datafield: 'telepon', width: 100, cellsalign: 'right', cellsformat: 'c2' },
                                { text: 'Email', datafield: 'email',  width:150, cellsalign: 'right' }
                            ]
                        });
            });
            });


    </script>
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
        <div id="jqxgrid" class="col-lg-12">
        </div>
	</div>
</div>
@endsection