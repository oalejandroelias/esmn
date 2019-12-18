<table style="border:1px solid" border="1">
	<thead>
		<th>Alumno</th>
		<?php foreach ($diascursado as $dia): ?>
			<th>
				<div>
					<span><?= $dia->date.' '.$dia->day; ?></span>
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
				<td>
					<?= $row['nombre'].' '.$row['apellido'].' ('.$row['numero_documento'].')'; ?>
				</td>
				<?php foreach ($dc as $dia) { ?>
				<td><?= $dia->state_description; ?>
				</td>
			<?php } ?>
		</tr>
	<?php endforeach; ?>
</tbody>
</table>
