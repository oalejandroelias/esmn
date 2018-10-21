<div class="pull-right">
	<a href="<?php echo site_url('carrera/add'); ?>" class="btn btn-success">Agregar</a>
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>Código de Plan</th>
		<th>Nivel</th>
		<th>Nombre</th>
		<th>Acta</th>
		<th>Fecha</th>
		<th>Actions</th>
    </tr>
	<?php foreach($carreras as $c){ ?>
    <tr>
		<td><?php echo $c['carrera_id']; ?></td>
		<td><?php echo $c['nivel']; ?></td>
		<td><?php echo $c['carrera_nombre']; ?></td>
		<td><?php echo $c['acta']; ?></td>
		<td><?php echo $c['fecha']; ?></td>
		<td>
            <a href="<?php echo site_url('carrera/edit/'.$c['carrera_id']); ?>" class="btn btn-info btn-sm">Editar</a>
            <a href="<?php echo site_url('carrera/remove/'.$c['carrera_id']); ?>" class="btn btn-danger btn-sm">Borrar</a>
        </td>
    </tr>
	<?php } ?>
</table>
<div class="pull-right">
    <?php echo $this->pagination->create_links(); ?>
</div>
