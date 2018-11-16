<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title font-weight-bold">Controlar asistencia</h5>
        <p class="text-info"><span><i class="mdi mdi-menu-right"></i></span>Haga click en las celdas para marcar asistencia o dejela en blanco en caso de inasistencia.</p>
        <p class="text-info"><span><i class="mdi mdi-menu-right"></i></span>Puede hacer click en el nombre del alumno para marcar todas las celdas de la fila correspondiente.</p>

        <div class="col-12" id="">
          <h5>Referencias:</h5>
          <div class="row">
            <div class="col-auto"><span class="mdi mdi-calendar-remove mdi-24 text-danger"></span>Feriado</div>
            <div class="col-auto"><span class="mdi mdi-check mdi-24 text-info"></span>Asistencia Ok</div>
            <div class="col-auto"><span class="mdi mdi-flag mdi-24 text-info"></span>Falta Justificada</div>
            <div class="col-auto"><span class="mdi mdi-close mdi-24 text-secondary"></span>Inasistencia</div>
          </div>
        </div>

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
                <td data-asistencia='<?= json_encode($diascursado); ?>' data-idpersona="<?= $row['id_persona']; ?>" onclick="check_all(this);">
                  <?= $row['nombre'].' '.$row['apellido'].' ('.$row['numero_documento'].')'; ?>
                </td>
                <?php foreach ($diascursado as $dia): ?>
                  <?php if ($dia->state == 1){
                    $classtd = "bg-danger";
                    $classmdi = "mdi mdi-calendar-remove mdi-24";
                    $dataonclick = 0;
                  }else {
                    $classtd = "";
                    $classmdi = "mdi mdi-close mdi-24 text-secondary";
                    $dataonclick = 1;
                  }
                   ?>
                  <td class="<?= $classtd; ?>" title="<?= $dia->state_description; ?>"
                    data-state="<?= $dia->state; ?>"
                    data-fecha="<?= $dia->date; ?>"
                    data-onclick="<?= $dataonclick; ?>"
                    data-idpersona="<?= $row['id_persona']; ?>">
                    <span class="<?= $classmdi; ?>"></span>
                  </td>
                <?php endforeach; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-8">
            <input type="hidden" name="id_curso" value="<?= $curso['id']; ?>">
            <button type="button" class="btn btn-success" onclick="guardar();">Guardar</button>
            <a href="<?=site_url('curso/index'); ?>" class="btn btn-danger">Cancelar</a>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
