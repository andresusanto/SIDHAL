@extends('base')

@section('addoncss')
@endsection

@section('addonjs')
    <script>
    $(function () {
        'use strict';
        $('#autocomplete-ajax').autocomplete({
            serviceUrl: '{{ action('PejabatController@getSuggestedPejabat') }}',
            dataType: 'json',
            type: 'GET',
            onSelect: function (suggestion) {
                alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
            }
        });

    });
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
        <div style="position: relative; height: 80px;">
            <input type="text" name="country" id="autocomplete-ajax" style="position: absolute; z-index: 2; background: transparent;"/>
            <input type="text" name="country" id="autocomplete-ajax-x" disabled="disabled" style="color: #CCC; position: absolute; background: transparent; z-index: 1;"/>
        </div>
        <div id="selction-ajax"></div>
        <div id="jqxgrid" class="col-lg-12">
        </div>
	</div>
</div>
@endsection