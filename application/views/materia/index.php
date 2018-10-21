<div class="pull-right">

<!-- vista de Index de Materia -->
	<a href="<?php echo site_url('materia/add'); ?>" class="btn btn-success">Agregar</a>
</div>

<table class="table table-striped table-bordered">
    <tr>
		<!-- <th>ID</th> -->
		<th>Id Carrera</th>
		<th>Nombre</th>
		<th>Codigo Anio</th>
		<th>Regimen Cursado</th>
		<th>Regimen Aprobacion</th>
		<th>Carga Horaria</th>
		<th>Tipo Catedra</th>
		<th>Actions</th>
    </tr>
	<?php foreach($materias as $m){ ?>
    <tr>
		<!-- <td><?php echo $m['id']; ?></td> -->
		<td><?php echo $m['id_carrera']; ?></td>
		<td><?php echo $m['nombre']; ?></td>
		<td><?php echo $m['codigo_anio']; ?></td>
		<td><?php echo $m['regimen_cursado']; ?></td>
		<td><?php echo $m['regimen_aprobacion']; ?></td>
		<td><?php echo $m['carga_horaria']; ?></td>
		<td><?php echo $m['tipo_catedra']; ?></td>
		<td>
            <a href="<?php echo site_url('materia/edit/'.$m['id']); ?>" class="btn btn-info btn-xs">Editar</a>
            <a href="<?php echo site_url('materia/remove/'.$m['id']); ?>" class="btn btn-danger btn-xs">Eliminar</a>
        </td>
    </tr>
	<?php } ?>
</table>
<div class="pull-right">
    <?php echo $this->pagination->create_links(); ?>
</div>
