<div class="pull-right">
	<a href="<?php echo site_url('ciudad/add'); ?>" class="btn btn-success">Add</a>
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>ID</th>
		<th>Id Provincia</th>
		<th>Nombre</th>
		<th>Actions</th>
    </tr>
	<?php foreach($ciudades as $c){ ?>
    <tr>
		<td><?php echo $c['id']; ?></td>
		<td><?php echo $c['id_provincia']; ?></td>
		<td><?php echo $c['nombre']; ?></td>
		<td>
            <a href="<?php echo site_url('ciudad/edit/'.$c['id']); ?>" class="btn btn-info btn-xs">Edit</a>
            <a href="<?php echo site_url('ciudad/remove/'.$c['id']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>
<div class="pull-right">
    <?php echo $this->pagination->create_links(); ?>
</div>
