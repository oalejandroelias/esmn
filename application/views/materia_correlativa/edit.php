<?php echo form_open('materia_correlativa/edit/'.$materia_correlativa['id_materia'],array("class"=>"form-horizontal")); ?>


	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Guardar</button>
      <button type="button" class="btn btn-danger" onclick="history.go(-1)">Cancelar</button>
        </div>
	</div>

<?php echo form_close(); ?>
