<!DOCTYPE html>
<html dir="ltr" lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('files/images/logo_esmn.png')?>">
    <title><?= $title ?></title>
   <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/select2/dist/css/select2.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/jquery-minicolors/jquery.minicolors.css"> -->
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>Lib/jquery-timepicker/jquery.timepicker.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/quill/dist/quill.snow.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/toastr/build/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>Lib/jquery-confirm/dist/jquery-confirm.min.css">
    <link href="<?= base_url();?>Lib/matrix-admin-bt4/dist/css/style.min.css" rel="stylesheet">
    <link href="<?= base_url();?>Lib/css/globals.css" rel="stylesheet">

    <!-- ??? -->
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>Lib/matrix-admin-bt4/assets/extra-libs/multicheck/multicheck.css">
    <link href="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- <link href="<?= base_url();?>Lib/matrix-admin-bt4/assets/extra-libs/DataTables/buttons.dataTables.min.css" rel="stylesheet"> -->

    <?php if (isset($css)) : ?> <!-- aca se cargan estilos desde el controlador -->
      <?php foreach ($css as $src) : ?>
        <link rel="stylesheet" href="<?= base_url('Lib/css/'.$src);?>">
      <?php endforeach; ?>
    <?php endif; ?>
    <!-- ??? -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                      <i class="mdi mdi-menu mdi-close"></i>
                    </a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="<?=base_url();?>">
                        <!-- Logo icon -->
                        <b class="logo-icon p-l-10">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="<?= base_url('files/images/logo_esmn.png')?>" width="30" alt="ESMN" class="light-logo" />
                        </b>
                         <!-- Logo text -->
                        <span class="logo-text">
                             <!-- dark Logo text -->
                             <img src="<?=base_url('files/images/CeciliaESMN') ?>" alt="CeciliaESMN" class="light-logo" width="152"/>
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="mdi mdi-dots-horizontal"></i></a>
                </div>

                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->
                         <?php  if($this->session->userdata['nombre_perfil'] == 'Administrador' || $this->session->userdata['nombre_perfil'] == 'Bedel'){ ?>
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <span class="d-none d-md-block">Administración <i class="fa fa-angle-down"></i></span>
                             <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="menu-administracion">
                            	<?php if(validar_opcion('Perfil')){ ?>
                                <a class="dropdown-item" href="<?php echo base_url('Perfil')?>">Perfiles</a>
                                 <?php }?>
                                <?php if(validar_opcion('Persona')){ ?>
                                <a class="dropdown-item" href="<?php echo base_url('Persona')?>">Personas</a>
                                <?php }?>
                                <?php if(validar_opcion('Usuario')){ ?>
                                <a class="dropdown-item" href="<?php echo base_url('Usuario')?>">Usuarios</a>
                                <?php }?>
                                <?php if(validar_opcion('Provincia')){ ?>
                                <a class="dropdown-item" href="<?php echo base_url('Provincia')?>">Provincias</a>
                                 <?php }?>
                                <?php if(validar_opcion('Ciudad')){ ?>
                                <a class="dropdown-item" href="<?php echo base_url('Ciudad')?>">Ciudades</a>
                                 <?php }?>
                                <?php if(validar_opcion('Nivel')){ ?>
                                <a class="dropdown-item" href="<?php echo base_url('Nivel')?>">Niveles</a>
                                 <?php }?>
                                <?php if(validar_opcion('Carrera')){ ?>
                                <a class="dropdown-item" href="<?php echo base_url('Carrera')?>">Carreras</a>
                                 <?php }?>
                                <?php if(validar_opcion('Materia')){ ?>
                                <a class="dropdown-item" href="<?php echo base_url('Materia')?>">Materias</a>
                                 <?php }?>
                                <?php if(validar_opcion('Curso')){ ?>
                                <a class="dropdown-item" href="<?php echo base_url('Curso')?>">Cursos</a>
                                 <?php }?>
                                <div class="dropdown-divider"></div>
                                 
                                <?php if(validar_opcion('Estado_inscripcion_inicial')){ ?>
                                <a class="dropdown-item" href="<?php echo base_url('Estado_inscripcion_inicial')?>">Estados inscripción inicial</a>
                                 <?php }?>
                                <?php if(validar_opcion('Estado_inscripcion_final')){ ?>
                                <a class="dropdown-item" href="<?php echo base_url('Estado_inscripcion_final')?>">Estados inscripción final</a>
                                 <?php }?>
                                <?php if(validar_opcion('Tutor')){ ?>
                                <a class="dropdown-item" href="<?php echo base_url('Tutor')?>">Tutores</a>
                                 <?php }?>
                                <?php if(validar_opcion('Tipo_documento')){ ?>
                                <a class="dropdown-item" href="<?php echo base_url('Tipo_documento')?>">Tipo Documento</a>
                                 <?php }?>
                                
                                <!-- <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a> -->
                            </div>
                        </li>
                        <?php }?>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <!-- <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li> -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="" title="Mensajes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="font-24 mdi mdi-comment-processing"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="">
                                             <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-success btn-circle"><i class="mdi mdi-calendar"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Evento o mensaje</h5>
                                                        <span class="mail-desc">Descripcion corta</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" title="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <!-- <img src="../../assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"> -->
                              <i class="mdi mdi-account-circle"></i> <?=$this->session->userdata('nombre')." ".$this->session->userdata('apellido')?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                <a class="dropdown-item" href="<?= base_url('perfil_usuario/index/').$this->session->userdata('usuario_id'); ?>"><i class="mdi mdi-account-card-details mx-1"></i> Mi Perfil</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="mdi mdi-account-settings mx-1"></i> Configuración de la cuenta</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('login/logout');?>"><i class="mdi mdi-logout mx-1"></i> Cerrar Sesión</a>
                                <div class="p-l-30 p-10"><a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">Cambiar Rol</a></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('inicio')?>" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Inicio</span>
                          </a>
                        </li>
                        <li class="sidebar-item">
                          <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-book-open"></i><span class="hide-menu">Inscripciones </span>
                          </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                            
                        		<?php if(validar_opcion('Inscripcion_carrera')){ ?>
                                <li class="sidebar-item"><a href="<?=base_url('inscripcion_carrera')?>" class="sidebar-link">
                                  <i class="mdi mdi-menu-right"></i><span class="hide-menu"> Carreras </span></a></li>
                                <?php }?>
                        		<?php if(validar_opcion('Inscripcion_materia')){ ?>
                                <li class="sidebar-item"><a href="<?=base_url('inscripcion_materia')?>" class="sidebar-link">
                                  <i class="mdi mdi-menu-right"></i><span class="hide-menu"> Mesas </span></a></li>
                                <?php }?>
                        		<?php if(validar_opcion_inscripcion_materia('index_inscripcion_cursado')){ ?>
                                <li class="sidebar-item"><a href="<?=base_url('inscripcion_materia/index_inscripcion_cursado')?>" class="sidebar-link">
                                  <i class="mdi mdi-menu-right"></i><span class="hide-menu"> Cursos </span></a></li>
                                <?php }?>
                            </ul>
                        </li>
                         
                        <?php if(validar_opcion('Mesa')){ ?>
                        <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url('mesa')?>" aria-expanded="false">
                            <i class="mdi mdi-calendar"></i><span class="hide-menu">Mesas</span>
                          </a>
                        </li>
                        <?php }?>
                        <?php if(validar_opcion('Tipo_periodo')){ ?>
                        <li class="sidebar-item">
                          <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-book-open"></i><span class="hide-menu">Periodos </span>
                          </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="<?=base_url('tipo_periodo')?>" class="sidebar-link">
                                  <i class="mdi mdi-menu-right"></i><span class="hide-menu"> Tipo Periodo </span></a></li>
                                <li class="sidebar-item"><a href="<?=base_url('periodo')?>" class="sidebar-link">
                                  <i class="mdi mdi-menu-right"></i><span class="hide-menu"> Periodo </span></a></li>
                            </ul>
                        </li>
                         <?php }?>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title"><?=$page_title?></h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                  <?php $segs = $this->uri->rsegment_array();?>
                                    <?php for ($i=1; $i <= count($segs); $i++) : ?>
                                      <?php if ($i!=count($segs)): ?>
                                        <li class="breadcrumb-item"><a href="#"><?= $segs[$i] ?></a></li>
                                        <?php else: ?>
                                          <li class="breadcrumb-item active" aria-current="page"><?= $segs[$i] ?></li>
                                        <?php endif; ?>
                                    <?php endfor; ?>

                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
              <!-- CONTENIDO DE LA PAGINA -->

<!-- modales -->
<div data-modal="remove"></div>
