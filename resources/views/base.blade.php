<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title }} :: SIDHAL</title>

    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('/css/animate.css') }}" rel="stylesheet">
	@yield('addoncss')
	
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">

</head>

<body>

<div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
							<span>
								<img src="{{ asset('/img/logo.png') }}" />
                            </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->name }}</strong>
                             </span> <span class="text-muted text-xs block">Administrator <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="{{action('Auth\AuthController@getLogout')}}">Logout</a></li>
                            </ul>
                    </div>
                    <div class="logo-element">
                        <img src="{{ asset('/img/logo_sm.png') }}" />
                    </div>
                </li>
                <li class="{{ isset($nav_home) ? 'active' : '' }}">
                    <a href="{{ url('/') }}"><i class="fa fa-home"></i> <span class="nav-label">Beranda</span></a>
                </li>
				</li>
 				<li class="{{ isset($nav_instansi) ? 'active' : '' }}">
                    <a href="{{ action('InstansiController@getIndex') }}"><i class="fa fa-building"></i> <span class="nav-label">Daftar Instansi</span></a>
                </li>
				<li class="{{ isset($nav_pejabat) ? 'active' : '' }}">
                    <a href="{{ action('PejabatController@getPejabat','all') }}"><i class="fa fa-users"></i> <span class="nav-label">Daftar Pejabat</span></a>
                </li>
                <li class="{{ isset($nav_entry) ? 'active' : '' }}">
                    <a href="{{ action('EntryController@getIndex') }}"><i class="fa fa-plus-square"></i> <span class="nav-label">Entry Rapat Baru</span></a>
                </li>
				<li class="{{ isset($nav_rapat) ? 'active' : '' }}">
                    <a href="{{ action('DaftarRapatController@getIndex') }}"><i class="fa fa-list-ol"></i> <span class="nav-label">Daftar Rapat</span></a>
                </li>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" method="post" action="{{ action('DaftarRapatController@postSearch') }}">
						<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="form-group">
                            <input type="text" placeholder="Pencarian Rapat..." class="form-control" name="rapat-search" id="rapat-search">
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-right">
					<li class="{{ isset($nav_user) ? 'active' : '' }}">
						<a href="{{ action('UserController@getIndex') }}"><i class="fa fa-user-plus"></i> Menejemen Pengguna</a>
					</li>
                    <li>
                        <a href="{{action('Auth\AuthController@getLogout')}}">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
		
		@yield('content')
        
        <div class="footer">
            <div>
                <strong>Copyright</strong> Kemenkopolhukam &copy; 2015
            </div>
        </div>

    </div>
</div>

<!-- Mainly scripts -->
<script src="{{ asset('/js/jquery-2.1.1.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('/js/inspinia.js') }}"></script>
<script src="{{ asset('/js/plugins/pace/pace.min.js') }}"></script>

<!-- selectize -->

@yield('addonjs')

</body>

</html>
