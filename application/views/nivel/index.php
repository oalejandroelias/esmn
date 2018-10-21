<div class="pull-right">
	<a href="<?php echo site_url('nivel/add'); ?>" class="btn btn-success">Nuevo</a>
</div>

<table class="table table-striped table-bordered">
    <tr>
		<!-- <th>Codigo de Nivel</th> -->
		<th>Nombre</th>
		<th>Actions</th>
    </tr>
	<?php foreach($niveles as $n){ ?>
    <tr>
		<!-- <td><?php echo $n['id']; ?></td> -->
		<td><?php echo $n['nombre']; ?></td>
		<td>
            <a href="<?php echo site_url('nivel/edit/'.$n['id']); ?>" class="btn btn-info btn-xs">Editar</a>
            <a href="<?php echo site_url('nivel/remove/'.$n['id']); ?>" class="btn btn-danger btn-xs">Eliminar</a>
        </td>
    </tr>
	<?php } ?>
</table>
<div class="pull-right">
    <?php echo $this->pagination->create_links(); ?>
</div>
