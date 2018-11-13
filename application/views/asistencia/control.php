<!-- <?php print_r(json_decode($asistencia[0]['diascursado'])); ?> -->
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">

        <table class="table-responsive tabla-dias-cursado">
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
              <tr>
                <td><?= $row['nombre'].' '.$row['apellido'].' ('.$row['numero_documento'].')'; ?></td>
                <?php foreach ($diascursado as $dia): ?>
                  <td></td>
                <?php endforeach; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>
