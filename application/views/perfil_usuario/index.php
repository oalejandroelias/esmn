<div class="row">

  <div class="col-sm-3 col-12 mb-4">
    <div class="card" style="max-width:250px;max-height:250px">
      <div class="card text-center">
        <div class="card-header bg-cyan text-white">
          <?= $persona['nombre'].' '.$persona['apellido']; ?>
        </div>
        <img class="card-img-top" src="<?= ($persona['foto'] == '') ? base_url('files/images/user.png') : $persona['foto']?>" alt="Foto perfil">
        <!-- <div class="card-body" id=card_foto_perfil>
      </div> -->
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header border-bottom bg-cyan text-white">
          <h5 class="card-title">Datos de contacto</h5>
        </div>
        <div class="card-body">
          <ul class="list-unstyled">
            <li><strong>Correo electrónico</strong></li>
            <li><span class="text-info"><?= $persona['email']; ?></span></li>
            <li><strong>Teléfono</strong></li>
            <li><span class="text-info"><?= $persona['telefono']; ?></span></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <?php if ($this->session->userdata('usuario_id')==$usuario['usuario_id']): ?>
            <a href="<?= base_url('persona/edit/').$persona['id']; ?>" class="btn btn-lg btn-block btn-info">Editar mis datos</a>
            <a href="<?= base_url('usuario/password_change/').$usuario['usuario_id']; ?>" class="btn btn-lg btn-block btn-primary">Cambiar mi contraseña</a>
          <?php endif; ?>
        </div>
      </div>
    </div>

  </div>
</div>
