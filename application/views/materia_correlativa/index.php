<div class="pull-right">
	<a href="<?php echo site_url('materia_correlativa/add'); ?>" class="btn btn-success">Agregar</a>
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>Id Materia</th>
		<th>Id Correlativa</th>
		<th>Actions</th>
    </tr>
	<?php foreach($materias_correlativas as $m){ ?>
    <tr>
		<td><?php echo $m['id_materia']; ?></td>
		<td><?php echo $m['id_correlativa']; ?></td>
		<td>
            <a href="<?php echo site_url('materia_correlativa/edit/'.$m['id_materia']); ?>" class="btn btn-info btn-xs">Editar</a>
            <a href="<?php echo site_url('materia_correlativa/remove/'.$m['id_materia']); ?>" class="btn btn-danger btn-xs">Eliminar</a>
        </td>
    </tr>
	<?php } ?>
</table>
<div class="pull-right">
    <?php echo $this->pagination->create_links(); ?>
</div>
