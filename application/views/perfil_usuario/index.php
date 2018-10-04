<div class="pull-right">
	<a href="<?php echo site_url('perfil_usuario/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>Id Usuario</th>
		<th>Id Perfil</th>
		<th>Permisos</th>
		<th>Actions</th>
    </tr>
	<?php foreach($perfil_usuario as $p){ ?>
    <tr>
		<td><?php echo $p['id_usuario']; ?></td>
		<td><?php echo $p['id_perfil']; ?></td>
		<td><?php echo $p['permisos']; ?></td>
		<td>
            <a href="<?php echo site_url('perfil_usuario/edit/'.$p['id_usuario']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('perfil_usuario/remove/'.$p['id_usuario']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>
