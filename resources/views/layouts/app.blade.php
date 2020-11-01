<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Sistema de notas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of cards with multiple styles, borders, actions and hover effects.">
    <meta name="msapplication-tap-highlight" content="no">



<link rel="shortcut icon" href="{!! asset('images/favicon.ico') !!}">
<link rel="stylesheet" href="{!! asset('main.css') !!}">

<script src="{!! asset('assets/scripts/main.js') !!}" type="text/javascript"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<style media="screen">
.app-header__logo .logo-src {
  height: 23px;
  width: 97px;
  background: url(assets/images/logo-inverse.png);
}
</style>



<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <img height="50" width="60" src="{{asset('images/plataforma3.png') }}" alt="">
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>    <div class="app-header__content">
                <div class="app-header-left">
                    
               </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                  <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <img width="42" class="rounded-circle" src="{{ asset("images/users/".Auth::user()->photo) }}" alt="">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                           @csrf
                                        </form>

                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <button onclick="event.preventDefault();document.getElementById('logout-form').submit();" type="button" tabindex="0" class="dropdown-item">Salir</button>
                                         <a href="{{route('updatePassword',Auth::user()->id)}}" type="button" tabindex="0" class="dropdown-item"> Cambiar Contraseña</a>

                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        {{Auth::user()->name}}
                                    </div>
                                    <div class="widget-subheading">
                                        {{Auth::user()->roles()->first()->name}}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                  </div>
            </div>
        </div>
        <div class="ui-theme-settings">
            <div class="theme-settings__inner">
                <div class="scrollbar-container">
                    <div class="theme-settings__options-wrapper">
                        <h3 class="themeoptions-heading">Layout Options
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">


                                <li class="app-sidebar__heading">Home</li>
                                <li>
                                    <a href="{{ route('home') }}"><i class="metismenu-icon fa fa-home"></i>Home</a>
                                </li>
                          <!--GENERAL-->
                                <li class="app-sidebar__heading">General</li>
                                @if(Auth::user()->roles()->first()->name == "Administrador")
                                <li class="">
                                    <a href="#" aria-expanded="false">
                                        <i class="metismenu-icon fa fa-users"></i>
                                        Usuarios y roles
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul class="mm-collapse" style="height: 7.04px;">

                                        <li>
                                            <a href="{{ route('users.index') }}"><i class="metismenu-icon"></i>Usuarios</a>
                                        </li>
                                    
                                        <li>
                                          <a href="{{ route('roles.index') }}"><i class="metismenu-icon"></i>Roles</a>
                                        </li>
                                    </ul>
                                </li>
                                @endif
                                @if(Auth::user()->roles()->first()->name == "Administrador" || Auth::user()->roles()->first()->name == "Secretaria")
                                <li>
                                      <a href="{{ route('degrees.index') }}"><i  class="metismenu-icon fa fa-graduation-cap"></i>Grado escolar</a>
                                </li>
                                @endif
                                @if(Auth::user()->roles()->first()->name == "Administrador" || Auth::user()->roles()->first()->name == "Secretaria")
                                <li>
                                      <a href="{{ route('years.index') }}"><i  class="metismenu-icon fa fa-calendar"></i>Año escolar</a>
                                </li>
                                @endif
                                @if(Auth::user()->roles()->first()->name == "Administrador" || Auth::user()->roles()->first()->name == "Secretaria")
                                <li>
                                      <a href="{{ route('subjects.index') }}"><i  class="metismenu-icon fa fa-book"></i>Materias</a>
                                </li>
                                @endif
                                @if(Auth::user()->roles()->first()->name == "Administrador" || Auth::user()->roles()->first()->name == "Secretaria")
                                <li>
                                      <a href="{{ route('students.index') }}"><i  class="metismenu-icon fa fa-users"></i>Alumnos</a>
                                </li>
                                @endif
                                @if(Auth::user()->roles()->first()->name == "Docente")
                                <li>
                                    <a href="#" aria-expanded="false">
                                        <i class="metismenu-icon fa fa-users"></i>
                                        Profesor
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul class="mm-collapse" style="height: 7.04px;">                                                                            
                                        <li>
                                            <a href="{{ route('gradesTeacher',Auth::user()->id) }}"><i class="metismenu-icon"></i>Grados</a>
                                        </li>                                                                                                                
                                    </ul>
                                </li>
                                @endif
                                @if(Auth::user()->roles()->first()->name == "Administrador")
                                <li>
                                    <a href="{{route('behaviors.index')}}"><i class="metismenu-icon fa fa-users" aria-hidden="true"></i>Conducta</a>
                                </li>
                                @endif
                               
                              <!--GENERAL-->

                              <!--PUBLICACIONES-->
                             <!--   <li class="app-sidebar__heading">Publicaciones</li>
                                <li>
                                      <a href=""><i class="metismenu-icon fa fa-th-list"></i>Publicaciones</a>
                                </li>-->
                                <!--PUBLICACIONES-->

                              <!--REMUNERACIONES-->
                             <!--   <li class="app-sidebar__heading">Remuneraciones</li>
                                <li class="">
                                    <a href="#" aria-expanded="false">
                                        <i class="metismenu-icon fa fa-calendar"></i>Vacaciones
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul class="mm-collapse" style="height: 7.04px;">
                                      <li>
                                     <a href=""><i class="metismenu-icon"></i>Coordinadores</a>
                                  </li>

                                  <li>
                                    <a href=""><i class="metismenu-icon"></i>Empleados disponibles</a>
                                 </li>

                                 <li>
                                    <a href=""><i class="metismenu-icon"></i>No aplican</a>
                                 </li>

                                 <li>
                                    <a href=""><i class="metismenu-icon"></i>Rechazados</a>
                                 </li>
                                 <li>
                                    <a href=""><i class="metismenu-icon"></i>Reportes</a>
                                 </li>
                                    </ul>
                                </li>-->
                                <!--REMUNERACIONES-->

                                <!--Desarrollo orzanizacional-->
                               <!-- <li class="app-sidebar__heading">Desarrollo organizacional</li>
                                <li class="">
                                    <a href="#" aria-expanded="false">
                                        <i class="metismenu-icon fa fa-desktop"></i>Capacitaciones
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul class="mm-collapse" style="height: 7.04px;">
                                        <li>
                                        <a href=""><i class="metismenu-icon"></i>Capacitaciones</a>
                                        </li>
                                    </ul>
                                </li>-->
                                <!--Desarrollo orzanizacional-->

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="tab-content">

                                   @yield('content')
                        </div>
                    </div>
                    <!--<div class="app-wrapper-footer">
                        <div class="app-footer">
                            <div class="app-footer__inner">
                                <div class="app-footer-left">
                                    <ul class="nav">
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                Footer Link 1
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                Footer Link 2
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="app-footer-right">
                                    <ul class="nav">
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                Footer Link 3
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                <div class="badge badge-success mr-1 ml-0">
                                                    <small>NEW</small>
                                                </div>
                                                Footer Link 4
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>--> 
                   </div>
        </div>
    </div>

</body>
</html>
