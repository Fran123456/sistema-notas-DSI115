


<!DOCTYPE html>
<html>
  <head>

	    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>   Control Inventario</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('assets/inventario/bootstrap.min.css')}}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/inventario/fontawesome/css/all.css')}}" defer>
    <!-- Select2 -->
	<link rel="stylesheet" href="{{asset('assets/inventario/select2.min.css')}}">
    <!-- Theme style -->

    <link rel="stylesheet" href="{{asset('assets/inventario/AdminLTE.min.css')}}">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->

    <link rel="stylesheet" href="{{asset('assets/inventario/_all-skins.min.css')}}">
  	<link rel="icon" href="img/icon.png">
	<!-- Responsive drop menu in tables -->
	<link rel="stylesheet" href="dist/css/responsive_drop.css">
 	  </head>
  <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="{{route('inventario.index')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->

          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Control </b>Inventario</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">


              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                  <span class="hidden-xs">DSI-115</span>
                </a>
                <ul class="dropdown-menu">

                  <!-- User image -->
                  <li class="user-header">

                    <p>
						DSI-215
                      <small>Administrador</small>
                    </p>
                  </li>

                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">

                    </div>
                    <div class="pull-right">
                      <a href="login.php?logout" class="btn btn-danger btn-flat"><i class='fa fa-power-off'></i> Salir</a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </div>
        </nav>
	 		      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
		        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">


          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENÚ</li>


			<li >
                <a href="{{route('inventario.index')}}" >
                <i class="fa fa-box"></i> <span>Productos</span>
              </a>
            </li>

            <li class="">
                <a href="{{route('stock')}}">
                  <i class="fa fa-box-open"></i> <span>Reducir Stock</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('product_history')}}">
                  <i class="fa fa-history"></i> <span>Historial Productos</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('category')}}">
                  <i class="fa fa-list"></i> <span>Categorias</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('inventory_report')}}">
                  <i class="fa fa-file-download"></i> <span>Reportes</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('home')}}">
                  <i class="fa fa-undo-alt"></i> <span>Regresar A Sistema Prinicpal</span>
                </a>
            </li>


									<li class=" treeview">


            </li>
									<li class=" treeview">


            </li>


          </ul>
        </section>
        <!-- /.sidebar -->
		      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <!-- Main content -->

            <section class="content">

                @yield('content')

        </section><!-- /.content -->
		      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
	<div class="pull-right hidden-xs">
		<b>DSI215</b>-G-14
	</div>
	<strong>DSI215 SISTEMA DE NOTAS-MODULO INVENTARO </strong>
</footer>    </div><!-- ./wrapper -->

  </body>
</html>




