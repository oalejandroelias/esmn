<div class="pull-right">
	<a href="<?php echo site_url('tipo_documento/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>ID</th>
		<th>Nombre</th>
		<th>Actions</th>
    </tr>
	<?php foreach($tipo_documento as $t){ ?>
    <tr>
		<td><?php echo $t['id']; ?></td>
		<td><?php echo $t['nombre']; ?></td>
		<td>
            <a href="<?php echo site_url('tipo_documento/edit/'.$t['id']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('tipo_documento/remove/'.$t['id']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>
