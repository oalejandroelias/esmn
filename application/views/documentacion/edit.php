<?php echo form_open('documentacion/edit/'.$documentacion['id'],array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="id_persona" class="col-md-4 control-label"><span class="text-danger">*</span>Persona</label>
		<div class="col-md-8">
			<select name="id_persona" class="form-control">
				<option value="">select persona</option>
				<?php 
				foreach($all_personas as $persona)
				{
					$selected = ($persona['id'] == $documentacion['id_persona']) ? ' selected="selected"' : "";

					echo '<option value="'.$persona['id'].'" '.$selected.'>'.$persona['numero_documento'].'</option>';
				} 
				?>
			</select>
			<span class="text-danger"><?php echo form_error('id_persona');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="genero" class="col-md-4 control-label">Genero</label>
		<div class="col-md-8">
			<input type="text" name="genero" value="<?php echo ($this->input->post('genero') ? $this->input->post('genero') : $documentacion['genero']); ?>" class="form-control" id="genero" />
			<span class="text-danger"><?php echo form_error('genero');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="fecha_inscripcion" class="col-md-4 control-label">Fecha Inscripcion</label>
		<div class="col-md-8">
			<input type="text" name="fecha_inscripcion" value="<?php echo ($this->input->post('fecha_inscripcion') ? $this->input->post('fecha_inscripcion') : $documentacion['fecha_inscripcion']); ?>" class="form-control" id="fecha_inscripcion" />
		</div>
	</div>
	<div class="form-group">
		<label for="fotocopia_dni" class="col-md-4 control-label">Fotocopia Dni</label>
		<div class="col-md-8">
			<textarea name="fotocopia_dni" class="form-control" id="fotocopia_dni"><?php echo ($this->input->post('fotocopia_dni') ? $this->input->post('fotocopia_dni') : $documentacion['fotocopia_dni']); ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="titulo_primario" class="col-md-4 control-label">Titulo Primario</label>
		<div class="col-md-8">
			<textarea name="titulo_primario" class="form-control" id="titulo_primario"><?php echo ($this->input->post('titulo_primario') ? $this->input->post('titulo_primario') : $documentacion['titulo_primario']); ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="titulo_secundario" class="col-md-4 control-label">Titulo Secundario</label>
		<div class="col-md-8">
			<textarea name="titulo_secundario" class="form-control" id="titulo_secundario"><?php echo ($this->input->post('titulo_secundario') ? $this->input->post('titulo_secundario') : $documentacion['titulo_secundario']); ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="otros_titulos" class="col-md-4 control-label">Otros Titulos</label>
		<div class="col-md-8">
			<textarea name="otros_titulos" class="form-control" id="otros_titulos"><?php echo ($this->input->post('otros_titulos') ? $this->input->post('otros_titulos') : $documentacion['otros_titulos']); ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="foto_carnet" class="col-md-4 control-label">Foto Carnet</label>
		<div class="col-md-8">
			<textarea name="foto_carnet" class="form-control" id="foto_carnet"><?php echo ($this->input->post('foto_carnet') ? $this->input->post('foto_carnet') : $documentacion['foto_carnet']); ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="certificado_nacimiento" class="col-md-4 control-label">Certificado Nacimiento</label>
		<div class="col-md-8">
			<textarea name="certificado_nacimiento" class="form-control" id="certificado_nacimiento"><?php echo ($this->input->post('certificado_nacimiento') ? $this->input->post('certificado_nacimiento') : $documentacion['certificado_nacimiento']); ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="beca" class="col-md-4 control-label">Beca</label>
		<div class="col-md-8">
			<textarea name="beca" class="form-control" id="beca"><?php echo ($this->input->post('beca') ? $this->input->post('beca') : $documentacion['beca']); ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="certificado_jucaid" class="col-md-4 control-label">Certificado Jucaid</label>
		<div class="col-md-8">
			<textarea name="certificado_jucaid" class="form-control" id="certificado_jucaid"><?php echo ($this->input->post('certificado_jucaid') ? $this->input->post('certificado_jucaid') : $documentacion['certificado_jucaid']); ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="medicacion" class="col-md-4 control-label">Medicacion</label>
		<div class="col-md-8">
			<textarea name="medicacion" class="form-control" id="medicacion"><?php echo ($this->input->post('medicacion') ? $this->input->post('medicacion') : $documentacion['medicacion']); ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="enfermedad" class="col-md-4 control-label">Enfermedad</label>
		<div class="col-md-8">
			<textarea name="enfermedad" class="form-control" id="enfermedad"><?php echo ($this->input->post('enfermedad') ? $this->input->post('enfermedad') : $documentacion['enfermedad']); ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="trabajo" class="col-md-4 control-label">Trabajo</label>
		<div class="col-md-8">
			<textarea name="trabajo" class="form-control" id="trabajo"><?php echo ($this->input->post('trabajo') ? $this->input->post('trabajo') : $documentacion['trabajo']); ?></textarea>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>
	
<?php echo form_close(); ?>