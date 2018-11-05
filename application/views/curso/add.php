<!-- esta vista permite agregar codigo de plan, nivel, nombre acta y fecha -->
<?php echo form_open('curso/add',array("class"=>"form-horizontal")); ?>

<div class="row">
	<div class="col-sm-8 col-12">
		<div class="card">
			<div class="card-body">

				<div class="form-row mb-4">

					<div class="col-sm-6 col-12">
						<label for="id_materia" class="control-label"><span class="text-danger">*</span>Materia</label>
						<select name="id_materia" required class="form-control">
							<option value="">Seleccione una materia</option>
							<?php
							foreach($all_materias as $materia)
							{
								$selected = ($materia['materia_id'] == $this->input->post('id_materia')) ? ' selected="selected"' : "";

								echo '<option value="'.$materia['materia_id'].'" '.$selected.'>'.$materia['nombre_materia'].' - '.$materia['id_carrera'].'</option>';
							}
							?>
						</select>
						<span class="text-danger"><?php echo form_error('id_materia');?></span>
					</div>

					<div class="col-sm-6 col-12">
						<label for="id_materia" class="control-label"><span class="text-danger">*</span>Periodo	</label>
						<select name="id_periodo" required class="form-control">
							<option value="">Seleccione una carrera</option>
							<?php
							foreach($all_periodos as $periodo)
							{
							    $selected = ($periodo['id'] == $this->input->post('id_periodo')) ? ' selected="selected"' : "";

							    echo '<option value="'.$periodo['id'].'" '.$selected.'>'.$periodo['descripcion'].' ('.$periodo['desde'].' - '.$periodo['hasta'].')</option>';
							}
							?>
						</select>
						<span class="text-danger"><?php echo form_error('id_periodo');?></span>
					</div>

				</div>

				<div class="form-row mb-4">
						<div class="col-sm-6 col-12">
							<label class="control-label">Dias de cursado</label>
                <div class="custom-control custom-checkbox mr-sm-2">
                  <input class="custom-control-input" name="dayweek[lunes]"
                    id="lunes" type="checkbox" value="1">
                  <label class="custom-control-label" for="lunes">Lunes</label>
                </div>
                <div class="custom-control custom-checkbox mr-sm-2">
                  <input class="custom-control-input" name="dayweek[martes]"
                    id="martes" type="checkbox" value="2">
                  <label class="custom-control-label" for="martes">Martes</label>
                </div>
                <div class="custom-control custom-checkbox mr-sm-2">
                  <input class="custom-control-input" name="dayweek[miercoles]"
                    id="miercoles" type="checkbox" value="3">
                  <label class="custom-control-label" for="miercoles">Miercoles</label>
                </div>
                <div class="custom-control custom-checkbox mr-sm-2">
                  <input class="custom-control-input" name="dayweek[jueves]"
                    id="jueves" type="checkbox" value="4">
                  <label class="custom-control-label" for="jueves">Jueves</label>
                </div>
                <div class="custom-control custom-checkbox mr-sm-2">
                  <input class="custom-control-input" name="dayweek[viernes]"
                    id="viernes" type="checkbox" value="5">
                  <label class="custom-control-label" for="viernes">Viernes</label>
                </div>
            </div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-success">Guardar</button>
						<a href="<?=site_url('curso/index'); ?>" class="btn btn-danger">Cancelar</a>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<?php echo form_close(); ?>
