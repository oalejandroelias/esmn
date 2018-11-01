<div class="pull-right">
	<a href="<?php echo site_url('inscripcion_materia/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>ID</th>
		<th>Id Persona</th>
		<th>Id Curso</th>
		<th>Id Materia</th>
		<th>Id Mesa</th>
		<th>Id Estado</th>
		<th>Calificacion</th>
		<th>Fecha</th>
		<th>Actions</th>
    </tr>
	<?php foreach($inscripcion_materia as $i){ ?>
    <tr>
		<td><?php echo $i['id']; ?></td>
		<td><?php echo $i['id_persona']; ?></td>
		<td><?php echo $i['id_curso']; ?></td>
		<td><?php echo $i['id_materia']; ?></td>
		<td><?php echo $i['id_mesa']; ?></td>
		<td><?php echo $i['id_estado']; ?></td>
		<td><?php echo $i['calificacion']; ?></td>
		<td><?php echo $i['fecha']; ?></td>
		<td>
            <a href="<?php echo site_url('inscripcion_materia/edit/'.$i['id']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('inscripcion_materia/remove/'.$i['id']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>
