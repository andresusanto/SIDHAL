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
    <script type="text/javascript" src="{{ asset('/jqwidget/scripts/demos.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            // prepare the data
            var data = {};
            var firstNames = [];
            $.getJSON( '{{ action("PejabatController@getListPejabat") }}', function( data ) {
            }).done(function(data){
                alert(data.nama);
                var firstNames = data.nama;
            });

            var lastNames =
                    [
                        "Fuller", "Davolio", "Burke", "Murphy", "Nagase", "Saavedra", "Ohno", "Devling", "Wilson", "Peterson", "Winkler", "Bein", "Petersen", "Rossi", "Vileid", "Saylor", "Bjorn", "Nodier"
                    ];
            var productNames =
                    [
                        "Black Tea", "Green Tea", "Caffe Espresso", "Doubleshot Espresso", "Caffe Latte", "White Chocolate Mocha", "Cramel Latte", "Caffe Americano", "Cappuccino", "Espresso Truffle", "Espresso con Panna", "Peppermint Mocha Twist"
                    ];
            var priceValues =
                    [
                        "2.25", "1.5", "3.0", "3.3", "4.5", "3.6", "3.8", "2.5", "5.0", "1.75", "3.25", "4.0"
                    ];
            var generaterow = function (i) {
                var row = {};
                var productindex = Math.floor(Math.random() * productNames.length);
                var price = parseFloat(priceValues[productindex]);
                var quantity = 1 + Math.round(Math.random() * 10);
                row["nama"] = firstNames[Math.floor(Math.random() * firstNames.length)];
                row["jabatan"] = lastNames[Math.floor(Math.random() * lastNames.length)];
                row["instansi"] = productNames[productindex];
                row["alamat"] = price;
                row["telpon"] = quantity;
                row["email"] = price * quantity;
                return row;
            }
            for (var i = 0; i < 10; i++) {
                var row = generaterow(i);
                data[i] = row;
            }
            var source =
            {
                localdata: data,
                datatype: "local",
                datafields:
                        [
                            { name: 'nama', type: 'string' },
                            { name: 'jabatan', type: 'string' },
                            { name: 'instansi', type: 'string' },
                            { name: 'alamat', type: 'string' },
                            { name: 'telpon', type: 'string' },
                            { name: 'email', type: 'string' }
                        ],
                addrow: function (rowid, rowdata, position, commit) {
                    // synchronize with the server - send insert command
                    var data = "insert=true&" + $.param(rowdata);
                    $.ajax({
                        dataType: 'json',
                        url: 'data.php',
                        data: data,
                        cache: false,
                        success: function (data, status, xhr) {
                            // insert command is executed.
                            commit(true);
                        },
                        error: function(jqXHR, textStatus, errorThrown)
                        {
                            commit(false);
                        }
                    });
                },
                deleterow: function (rowid, commit) {
                    // synchronize with the server - send delete command
                    var data = "delete=true&" + $.param({EmployeeID: rowid});
                    $.ajax({
                        dataType: 'json',
                        url: 'data.php',
                        cache: false,
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
                    // synchronize with the server - send update command
                    var data = "update=true&" + $.param(rowdata);
                    $.ajax({
                        dataType: 'json',
                        url: 'data.php',
                        cache: false,
                        data: data,
                        success: function (data, status, xhr) {
                            // update command is executed.
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
                        width: 1000,
                        height: 350,
                        source: dataAdapter,
                        showtoolbar: true,
                        rendertoolbar: function (toolbar) {
                            var me = this;
                            var container = $("<div style='margin: 5px;'></div>");
                            toolbar.append(container);
                            container.append('<input id="addrowbutton" type="button" value="Tambah Data Pejabat" />');
                            container.append('<input style="margin-left: 5px;" id="addmultiplerowsbutton" type="button" value="Tambah Data Pejabat" />');
                            container.append('<input style="margin-left: 5px;" id="deleterowbutton" type="button" value="Hapus Data Pejabat" />');
                            container.append('<input style="margin-left: 5px;" id="updaterowbutton" type="button" value="Update Selected Row" />');
                            $("#addrowbutton").jqxButton();
                            $("#addmultiplerowsbutton").jqxButton();
                            $("#deleterowbutton").jqxButton();
                            $("#updaterowbutton").jqxButton();
                            // update row.
                            $("#updaterowbutton").on('click', function () {
                                var datarow = generaterow();
                                var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                                var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
                                if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
                                    var id = $("#jqxgrid").jqxGrid('getrowid', selectedrowindex);
                                    var commit = $("#jqxgrid").jqxGrid('updaterow', id, datarow);
                                    $("#jqxgrid").jqxGrid('ensurerowvisible', selectedrowindex);
                                }
                            });
                            // create new row.
                            $("#addrowbutton").on('click', function () {
                                var datarow = generaterow();
                                var commit = $("#jqxgrid").jqxGrid('addrow', null, datarow);
                            });
                            // create new rows.
                            $("#addmultiplerowsbutton").on('click', function () {
                                $("#jqxgrid").jqxGrid('beginupdate');
                                for (var i = 0; i < 10; i++) {
                                    var datarow = generaterow();
                                    var commit = $("#jqxgrid").jqxGrid('addrow', null, datarow);
                                }
                                $("#jqxgrid").jqxGrid('endupdate');
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
                            { text: 'Nama', datafield: 'nama', width: 200 },
                            { text: 'Jabatan', datafield: 'jabatan', width: 150 },
                            { text: 'Instansi', datafield: 'instansi', width: 150 },
                            { text: 'Alamat', datafield: 'alamat', width: 200, cellsalign: 'right' },
                            { text: 'Telepon', datafield: 'telepon', width: 100, cellsalign: 'right', cellsformat: 'c2' },
                            { text: 'Email', datafield: 'email',  width:150, cellsalign: 'right' }
                        ]
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