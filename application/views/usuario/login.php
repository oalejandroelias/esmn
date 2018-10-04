<!DOCTYPE html>
<html dir="ltr" lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- meta de google-api -->
  <meta name="google-signin-client_id" content="402569257873-i0ndfm0g7mtght08bvk2d7d2a1iopr8v.apps.googleusercontent.com">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="">
  <title><?= $title ?></title>
  <!-- Custom CSS -->
  <link href="<?= base_url('Lib/css/style.min.css');?>" rel="stylesheet">
  <?php if (isset($css)) : ?> <!-- aca se cargan estilos desde el controlador -->
    <?php foreach ($css as $src) : ?>
      <link rel="stylesheet" href="<?= base_url('Lib/'.$src);?>">
    <?php endforeach; ?>
  <?php endif; ?>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <div class="m-auto">

    <div class="text-center container">
      <?php echo form_open('login/login', 'class="form-signin"'); ?>
      <?=form_hidden('token',$token)?>
      <?=form_hidden('request_uri',$request_uri)?>
      <img class="mb-2" src="<?= base_url('files/images/logo_esmn.png'); ?>" alt="Logo ESMN" width="92" height="92">
      <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesión</h1>
      <label for="loginUsername" class="sr-only">Usuario</label>
      <input type="text" id="loginUsername" class="form-control" name="username" placeholder="Usuario" required autofocus>
      <label for="loginPassword" class="sr-only">Contraseña</label>
      <input type="password" id="loginPassword" class="form-control" name="password" placeholder="Contraseña" required>

      <button class="btn btn-lg btn-primary btn-block mb-2" name="registered_user" type="submit">Ingresar</button>
      <a href="<?=$authUrl?>" class="btn btn-lg btn-danger btn-block mb-2">Iniciar Sesión con Google</a>
      <p class="mt-3 mb-2 text-muted">&copy; Escuela de Musica del Neuquen - 2018</p>
      <div class="error">
        <ul>
          <!-- mostrar errores -->
          <?php echo validation_errors('<li>','</li>'); ?>
          <?php if($this->session->flashdata('usuario_incorrecto')) :?>
            <li><?=$this->session->flashdata('usuario_incorrecto')?></li>
          <?php endif; ?>
        </ul>
      </div>
    </form>
  </div>

</div>

<script src="<?= base_url('Lib/jquery/dist/jquery.min.js');?>"></script>
<script src="<?= base_url('Lib/bootstrap/dist/js/bootstrap.min.js');?>"></script>

<?php if (isset($js)) : ?>
  <?php foreach ($js as $src) : ?>
    <script src="<?= base_url('Lib/'.$src);?>"></script>
  <?php endforeach; ?>
<?php endif; ?>

</body>
</html>
