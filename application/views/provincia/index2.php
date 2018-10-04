<div class="row">
	<div class="col-xl-6 col-md-9 col-12">
		<div class="card">
			<div class="card-body">
				
				<div class="float-right position-relative b-3">
					<a href="<?php echo site_url('provincia/add'); ?>" class="btn btn-success">Nuevo</a>
				</div>

				<div class="col-9 col-xs-12">
					<table class="table table-striped table-bordered">
						<tr>
							<th>Nombre</th>
							<th class="col-5">Accion</th>
						</tr>
						<?php foreach($provincias as $p){ ?>
							<tr>
								<td><?php echo $p['nombre']; ?></td>
								<td>
									<a href="<?php echo site_url('provincia/edit/'.$p['id']); ?>" class="btn btn-info btn-sm">Editar</a>
									<a href="<?php echo site_url('provincia/remove/'.$p['id']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
								</td>
							</tr>
						<?php } ?>
					</table>
					
				</div>

				<div class="float-right">
					<?php echo $this->pagination->create_links(); ?>
				</div>
			</div>

		</div>
	</div>

</div>
