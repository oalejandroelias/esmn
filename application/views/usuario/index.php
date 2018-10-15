<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">

				<div class="table-responsive">
					<table id="zero_config" class="table table-striped table-bordered">
						<tr>
							<!-- <th>ID</th> -->
							<th>Documento</th>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Username</th>
							<th>Rol</th>
							<th>Permisos</th>
							<th>Acciones</th>
						</tr>
						<?php foreach($usuarios as $u){ ?>
							<tr>
								<td><?= $u['tipo_documento']." - ".$u['numero_documento']; ?></td>
								<td><?= $u['nombre']; ?></td>
								<td><?= $u['apellido']; ?></td>
								<td><?= $u['username']; ?></td>
								<td><?= $u['rol']; ?></td>
								<td><?= $u['permisos_perfil'].", ".$u['permisos_usuario']; ?></td>
								<td>
									<a href="<?= site_url('usuario/edit/'.$u['usuario_id']); ?>" class="btn btn-info btn-xs">Editar</a>
									<a href="<?= site_url('usuario/remove/'.$u['usuario_id']); ?>" class="btn btn-danger btn-xs">Eliminar</a>
									<a href="<?php echo site_url('perfil_usuario/edit_permission/'.$u['usuario_id']); ?>" class="btn btn-warning btn-sm">Editar permisos</a>
								</td>
							</tr>
						<?php } ?>

					</table>
				</div>
				<div class="float-right position-relative b-3">
					<a href="<?php echo site_url('usuario/add'); ?>" class="btn btn-success">Nuevo</a>
				</div>

				<div class="float-right">
					<?php echo $this->pagination->create_links(); ?>
				</div>
			</div>

		</div>
	</div>

</div>
