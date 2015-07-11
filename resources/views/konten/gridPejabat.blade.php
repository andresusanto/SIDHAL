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
    <script type="text/javascript" src="{{ asset('/jqwidget/jqwidgets/jqxgrid.filter.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/jqwidget/jqwidgets/jqwidgets/jqxgrid.sort.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/jqwidget/jqwidgets/jqwidgets/jqxpanel.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/jqwidget/jqwidgets/jqwidgets/globalize.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/jqwidget/jqwidgets/jqxgrid.selection.js')}}"></script>
    <script type="text/javascript" src="{{ asset('jqwidgets/jqxgrid.sort.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/jqwidget/jqwidgets/jqxgrid.edit.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/jqwidget/jqwidgets/jqxgrid.pager.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $.getJSON( '{{ action("PejabatController@getJsonPejabat",$instansi) }}', function( data ) {
            }).done(function(data){
                var urlInstansi = '{{ action("InstansiController@getData") }}';
                var dropDownListSource =
                {
                    datatype: "json",
                    datafields: [
                        { name: 'nama' },
                        { name: 'alamat' }
                    ],
                    id: 'id',
                    url: urlInstansi
                };
                var dropdownListAdapter = new $.jqx.dataAdapter(dropDownListSource, { autoBind: true, async: false });
                var datax = new Array();
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
                    datax[i] = row;
                }
                var source =
                {
                    localdata: datax,
                    datatype: "array",
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
                var pagerrenderer = function () {
                    var element = $("<div style='margin-top: 5px; width: 100%; height: 100%;'></div>");
                    var paginginfo = $("#jqxgrid").jqxGrid('getpaginginformation');
                    for (i = 0; i < paginginfo.pagescount; i++) {
                        // add anchor tag with the page number for each page.
                        var anchor = $("<a style='padding: 5px;' href='#" + i + "'>" + i + "</a>");
                        anchor.appendTo(element);
                        anchor.click(function (event) {
                            // go to a page.
                            var pagenum = parseInt($(event.target).text());
                            $("#jqxgrid").jqxGrid('gotopage', pagenum);
                        });
                    }
                    return element;
                }
                var dataAdapter = new $.jqx.dataAdapter(source);
                var addfilter = function () {
                    var filtergroup = new $.jqx.filter();
                    var filter_or_operator = 1;
                    var filtervalue = 'Andrew';
                    var filtercondition = 'equal';
                    var filter1 = filtergroup.createfilter('stringfilter', filtervalue, filtercondition);

                    filtergroup.addfilter(filter_or_operator, filter1);
                    // add the filters.
                    $("#jqxgrid").jqxGrid('addfilter', 'instansi', filtergroup);
                    // apply the filters.
                    $("#jqxgrid").jqxGrid('applyfilters');
                }
                var adapter = new $.jqx.dataAdapter(source);
                $("#jqxgrid").jqxGrid(
                        {
                            source: dataAdapter,
                            autoheight: true,
                            autowidth:true,
                            filterable: true,
                            autoshowfiltericon: true,
                            pageable: true,
                            //pagerrenderer: pagerrenderer,
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
                                $("#addrowbutton").click(function () {
                                    $("#jqxgrid").jqxGrid("addrow", null, {}, "first");
                                });
                                $("#deleterowbutton").jqxButton();

                                // create new row.
                                $("#addrowbutton").on('click', function () {
                                    var row = {};
                                    row["id"] = $('#jqxgrid').jqxGrid('getrows').length+1;
                                    var datarow = row;
                                    var commit = true;
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
                                { text: 'Instansi', datafield: 'instansi', width: 150, columntype:'dropdownlist',
                                    initeditor: function (row, cellvalue, editor) {
                                        editor.jqxDropDownList({ displayMember: 'nama', source: dropdownListAdapter }).bind('select', function (event) {
                                            var args = event.args;
                                            $('#jqxgrid').jqxGrid('setcellvalue',row,'alamat',dropdownListAdapter.records[args.index]['alamat']);
                                        });
                                    }
                                },
                                { text: 'Alamat', datafield: 'alamat', width: 200, cellsalign: 'right' },
                                { text: 'Telepon', datafield: 'telepon', width: 100, cellsalign: 'right', cellsformat: 'c2' },
                                { text: 'Email', datafield: 'email',  width:150, cellsalign: 'right',validation: function (cell, value) {
                                    if (!isValidEmailAddress(value)) {
                                        return { result: false, message: "Isikan email dengan benar" };
                                    }
                                    return true;
                                    },
                                    initeditor: function (row, cellvalue, editor) {
                                        editor.jqxNumberInput({ digits: 3 });
                                    }
                                },
                                { text: '', datafield: 'id', width: 50,editable:false, hidden:true}
                            ]
                        });
                penomoran($('#jqxgrid').jqxGrid('getrows').length);



            });
        });


    </script>
    <script>
        function isValidEmailAddress(emailAddress) {
            var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
            // alert( pattern.test(emailAddress) );
            return pattern.test(emailAddress);
        };
        function penomoran(nomor){
            if(nomor>=0){
                $('#jqxgrid').jqxGrid('setcellvalue',nomor,'no',nomor+1);
                penomoran(nomor-1);
            }else{

            }
        }
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
	<div class="row" id="jqxWidget">
        <div id="jqxgrid" class="col-lg-12">
        </div>
	</div>
</div>
@endsection