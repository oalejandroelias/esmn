<div class="row">
	<div class="col-12">
	   <div class="card">
       <div class="card-body">

            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
                  <tr>
                	<!-- <th>ID</th> -->
									<th>Tipo Documento</th>
                	<th>Numero Documento</th>
									<th>Ciudad</th>
                	<th>Nombre</th>
                	<th>Apellido</th>
                	<th>Domicilio</th>
                	<th>Telefono</th>
                	<th>Email</th>
                	<th>Fecha Nacimiento</th>
                	<th>Actions</th>
                  </tr>
                <?php foreach($personas as $p){ ?>
                  <tr>
                	<!-- <td><?php echo $p['id']; ?></td> -->
                	<td><?php echo $p['tipo_documento']; ?></td>
                	<td><?php echo $p['numero_documento']; ?></td>
									<td><?php echo $p['ciudad']; ?></td>
                	<td><?php echo $p['nombre']; ?></td>
                	<td><?php echo $p['apellido']; ?></td>
                	<td><?php echo $p['domicilio']; ?></td>
                	<td><?php echo $p['telefono']; ?></td>
                	<td><?php echo $p['email']; ?></td>
                	<td><?php echo $p['fecha_nacimiento']; ?></td>
                	<td>
                  <a href="<?php echo site_url('persona/edit/'.$p['persona_id']); ?>" class="btn btn-info btn-sm">Editar</a>
                  <a href="<?php echo site_url('persona/remove/'.$p['persona_id']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                  </td>
    </tr>
	<?php } ?>

</table>


	</div>
          <div class="float-right position-relative b-3">
          <a href="<?php echo site_url('persona/add'); ?>" class="btn btn-success">Nuevo</a>
        </div>

				<div class="float-right">
					<?php echo $this->pagination->create_links(); ?>
				</div>
			</div>

		</div>
	</div>

</div>
