@extends('base')

@section('addoncss')
@endsection

@section('addonjs')
    <script src="{{ asset('/js/typehead.bundle.js') }}"
<script>
    var bestPictures = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: '../data/films/post_1960.json',
        remote: {
            url: '../data/films/queries/%QUERY.json',
            wildcard: '%QUERY'
        }
    });

    $('#remote .typeahead').typeahead(null, {
        name: 'best-pictures',
        display: 'value',
        source: bestPictures
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
        <div id="remote">
            <input class="typeahead" type="text" placeholder="Oscar winners for Best Picture">
        </div>
        <div id="jqxgrid" class="col-lg-12">
        </div>
	</div>
</div>
@endsection