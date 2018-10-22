<div class="pull-right">
	<a href="<?php echo site_url('documentacion/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>ID</th>
		<th>Id Persona</th>
		<th>Genero</th>
		<th>Fecha Inscripcion</th>
		<th>Fotocopia Dni</th>
		<th>Titulo Primario</th>
		<th>Titulo Secundario</th>
		<th>Otros Titulos</th>
		<th>Foto Carnet</th>
		<th>Certificado Nacimiento</th>
		<th>Beca</th>
		<th>Certificado Jucaid</th>
		<th>Medicacion</th>
		<th>Enfermedad</th>
		<th>Trabajo</th>
		<th>Actions</th>
    </tr>
	<?php foreach($documentacion as $d){ ?>
    <tr>
		<td><?php echo $d['id']; ?></td>
		<td><?php echo $d['id_persona']; ?></td>
		<td><?php echo $d['genero']; ?></td>
		<td><?php echo $d['fecha_inscripcion']; ?></td>
		<td><?php echo $d['fotocopia_dni']; ?></td>
		<td><?php echo $d['titulo_primario']; ?></td>
		<td><?php echo $d['titulo_secundario']; ?></td>
		<td><?php echo $d['otros_titulos']; ?></td>
		<td><?php echo $d['foto_carnet']; ?></td>
		<td><?php echo $d['certificado_nacimiento']; ?></td>
		<td><?php echo $d['beca']; ?></td>
		<td><?php echo $d['certificado_jucaid']; ?></td>
		<td><?php echo $d['medicacion']; ?></td>
		<td><?php echo $d['enfermedad']; ?></td>
		<td><?php echo $d['trabajo']; ?></td>
		<td>
            <a href="<?php echo site_url('documentacion/edit/'.$d['id']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('documentacion/remove/'.$d['id']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>
<div class="pull-right">
    <?php echo $this->pagination->create_links(); ?>    
</div>
