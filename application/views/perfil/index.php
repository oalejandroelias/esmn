<div class="pull-right">
	<a href="<?php echo site_url('perfil/add'); ?>" class="btn btn-success">Nuevo</a>
</div>

<table class="table table-striped table-bordered">
    <tr>
		<!-- <th>ID</th> -->
		<th>Nombre</th>
		<th>Actions</th>
    </tr>
	<?php foreach($perfiles as $p){ ?>
    <tr>
		<!-- <td><?php echo $p['id']; ?></td> -->
		<td><?php echo $p['nombre']; ?></td>
		<td>
            <a href="<?php echo site_url('perfil/edit/'.$p['id']); ?>" class="btn btn-info btn-sm">Editar</a>
            <a href="<?php echo site_url('perfil/remove/'.$p['id']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
            <a href="<?php echo site_url('perfil/edit_permission/'.$p['id']); ?>" class="btn btn-warning btn-sm">Editar permisos</a>
        </td>
    </tr>
	<?php } ?>
</table>
