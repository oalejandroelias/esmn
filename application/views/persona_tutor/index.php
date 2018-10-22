<div class="pull-right">
	<a href="<?php echo site_url('persona_tutor/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>Id Persona</th>
		<th>Id Responsable</th>
		<th>Id Tutor</th>
		<th>Actions</th>
    </tr>
	<?php foreach($persona_tutor as $p){ ?>
    <tr>
		<td><?php echo $p['id_persona']; ?></td>
		<td><?php echo $p['id_responsable']; ?></td>
		<td><?php echo $p['id_tutor']; ?></td>
		<td>
            <a href="<?php echo site_url('persona_tutor/edit/'.$p['id_persona']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('persona_tutor/remove/'.$p['id_persona']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>
