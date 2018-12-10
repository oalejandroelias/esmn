<?php echo form_open('perfil/edit_permission/'.$perfil['id'],array("class"=>"form-horizontal")); ?>
<div class="row">

  <?php foreach ($permisos as $class => $methods): ?>
    <div class="col-12 col-sm-6 col-md-4">
      <div class="card">
        <div class="card-body">
          <div class="form-group row">
            <label class="col-auto" title="Alternar seleccion"><a href="javascript:void(0);" onclick="check_all(this);" data-a="on" class="badge badge-light"><?=$class; ?></a></label>
            <div class="col-auto">
              <?php $x=1; ?>
              <?php foreach ($permisos[$class] as $method => $value): ?>
                <!-- $value corresponde al valor de checked -->
                <div class="custom-control custom-checkbox mr-sm-2">
                  <input class="custom-control-input" name="permisos[<?=$class; ?>][<?=$method; ?>]"
                    id="customControlAutosizing<?=$class.$x;?>" type="checkbox" value="1" <?= $value; ?>>
                    <?php if($method == 'index'){?>
                  <label class="custom-control-label" for="customControlAutosizing<?=$class.$x;?>"><?="Inicio"; ?></label>
                  <?php }elseif($method == 'add'){?>
                  <label class="custom-control-label" for="customControlAutosizing<?=$class.$x;?>"><?="Crear"; ?></label>
                  <?php }elseif($method == 'edit'){?>
                  <label class="custom-control-label" for="customControlAutosizing<?=$class.$x;?>"><?="Editar"; ?></label>
                  <?php }elseif($method == 'remove'){?>
                  <label class="custom-control-label" for="customControlAutosizing<?=$class.$x;?>"><?="Eliminar"; ?></label>
                  <?php }else{?>
                  <label class="custom-control-label" for="customControlAutosizing<?=$class.$x;?>"><?=$method; ?></label>
                  <?php }?>
                  
                </div>
                <?php $x++; ?>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>

    </div>
  <?php endforeach; ?>
</div>
<div class="form-group">
  <div class="col-sm-offset-4 col-sm-8">
    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="<?=site_url('perfil/index'); ?>" class="btn btn-danger">Cancelar</a>
  </div>
</div>
<?php echo form_close(); ?>
