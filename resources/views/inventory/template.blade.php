


<!DOCTYPE html>
<html>
  <head>
    @include('alerts.dataTable')
	    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Productos | Inventory Control</title>
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
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>INV</b>Control</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Inventory </b>Control</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">


              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="dist/img/admin.png" class="user-image" alt="User Image">
                  <span class="hidden-xs">Usuario demo</span>
                </a>
                <ul class="dropdown-menu">

                  <!-- User image -->
                  <li class="user-header">
                    <img src="dist/img/admin.png" class="img-circle" alt="User Image">
                    <p>
						Usuario demo
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
            <div class="pull-left image">
              <img src="dist/img/admin.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Usuario demo</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENÚ</li>
            <li class="">
              <a href="index.php">
                <i class="fa fa-home"></i> <span>Inicio</span>
              </a>

            </li>
			            <li class=" treeview">
              <a href="#">
                <i class="fa fa-truck"></i>
                <span>Compras</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class=""><a href="new_purchase.php"><i class="glyphicon glyphicon-shopping-cart"></i> Nueva compra</a></li>
				<li class=""><a href="purchase_list.php"><i class="glyphicon glyphicon-th-list"></i> Historial de compras</a></li>
			  </ul>
            </li>
			<li class="active">
                <a href="{{route('inventario.index')}}" >
                <i class="fa fa-box"></i> <span>Productos</span>
              </a>
            </li>

            <li class="">
                <a href="manufacturers.php">
                  <i class="fa fa-box-open"></i> <span>Reducir Stock</span>
                </a>
            </li>
            <li class="">
                <a href="manufacturers.php">
                  <i class="fa fa-history"></i> <span>Historial Productos</span>
                </a>
            </li>
            <li class="">
                <a href="manufacturers.php">
                  <i class="glyphicon glyphicon-tag"></i> <span>Categorias</span>
                </a>
            </li>
            <li class="">
                <a href="manufacturers.php">
                  <i class="fa fa-file-download"></i> <span>Reportes</span>
                </a>
            </li>


									<li class=" treeview">
              <a href="#">
                <i class="fa fa-wrench"></i> <span>Configuración</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class=""><a href="business_profile.php"><i class="glyphicon glyphicon-briefcase"></i> Perfil de la empresa</a></li>
               <li class=""><a href="currencies.php"><i class="fa fa-usd"></i> Monedas</a></li>
			   <li class=""><a href="taxes.php"><i class="fa fa-align-justify"></i> Impuestos</a></li>
			   <li class=""><a href="templates.php"><i class="fa fa-file-pdf-o"></i> Plantillas</a></li>
              </ul>
            </li>
									<li class=" treeview">
              <a href="#">
                <i class="fa fa-lock"></i> <span>Administrar accesos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">

                <li class=""><a href="group_list.php"><i class="glyphicon glyphicon-briefcase"></i> Grupos de usuarios</a></li>

							<li class=""><a href="user_list.php"><i class="fa fa-users"></i> Usuarios</a></li>

              </ul>
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
		<b>DSI115</b>-G-14
	</div>
	<strong>DSI115 SISTEMA DE NOTAS-MODULO INVENTARO </strong>
</footer>    </div><!-- ./wrapper -->

  </body>
</html>




