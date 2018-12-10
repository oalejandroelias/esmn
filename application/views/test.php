<table class="table-responsive tabla-dias-cursado" style="border:1px solid" border="1">
	<thead>
		<th class="align-bottom text-center">Alumno</th>
		<?php foreach ($diascursado as $dia): ?>
			<th class="text-center rotate">
				<div>
					<span class="font-weight-bold"><?= $dia->date.' '.$dia->day; ?></span>
				</div>
			</th>
		<?php endforeach; ?>
	</thead>
	<tbody>
		<?php foreach ($asistencia as $row): ?>
			<?php if (!empty($row['asistencia'])){
				$dc = json_decode($row['asistencia']);
			}else {
				$dc = $diascursado;
			}
			?>
			<tr>
				<td data-asistencia='<?= json_encode($dc); ?>' data-idpersona="<?= $row['id_persona']; ?>" onclick="check_all(this);">
					<?= $row['nombre'].' '.$row['apellido'].' ('.$row['numero_documento'].')'; ?>
				</td>
				<?php foreach ($dc as $dia) { ?>
				<td><?= $dia->state_description; ?>"
				</td>
			<?php } ?>
		</tr>
	<?php endforeach; ?>
</tbody>
</table>
