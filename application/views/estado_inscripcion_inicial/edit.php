<?php echo form_open('estado_inscripcion_inicial/edit/'.$estado_inscripcion_inicial['id'],array("class"=>"form-horizontal")); ?>

<div class="row">
	<div class="col-sm-6 col-12">
		<div class="card">
			<div class="card-body">

				<div class="form-group">
					<label for="nombre" class="col-md-4 control-label"><span class="text-danger">*</span>Nombre</label>
					<div class="col-md-8">
						<input type="text" name="nombre" required value="<?php echo ($this->input->post('nombre') ? $this->input->post('nombre') : $estado_inscripcion_inicial['nombre']); ?>" class="form-control" id="nombre" />
						<span class="text-danger"><?php echo form_error('nombre');?></span>
					</div>
				</div>
				<div class="form-group">
					<label for="nomenclatura" class="col-md-4 control-label">Nomenclatura</label>
					<div class="col-md-8">
						<input type="text" name="nomenclatura" value="<?php echo ($this->input->post('nomenclatura') ? $this->input->post('nomenclatura') : $estado_inscripcion_inicial['nomenclatura']); ?>" class="form-control" id="nomenclatura" />
						<span class="text-danger"><?php echo form_error('nomenclatura');?></span>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-success">Guardar</button>
						<a href="<?=site_url('estado_inscripcion_inicial/index'); ?>" class="btn btn-danger">Cancelar</a>
					</div>
				</div>
				
				<div class="form-group row">
                    <label class="col-md-3">Estado inicial para:</label>
                    <div class="col-md-9">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" value="mesa" id="customControlValidation1" name="radio-stacked" required="" <?php if($estado_inscripcion_inicial['es_mesa'] == 1) echo "checked"; ?> >
                            <label class="custom-control-label" for="customControlValidation1">Mesa</label>
                        </div>
                         <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" value="curso" id="customControlValidation2" name="radio-stacked" required="" <?php if($estado_inscripcion_inicial['es_cursado'] == 1) echo "checked"; ?>>
                            <label class="custom-control-label" for="customControlValidation2">Cursado</label>
                        </div>
                        
                    </div>
                </div>

			</div>
		</div>
	</div>
</div>

<?php echo form_close(); ?>
