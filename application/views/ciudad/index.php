<div class="row">
  <div class="col-12">

    <div class="card">
      <div class="card-body">
        <!-- <h5 class="card-title"><?=$page_title?></h5> -->
        <div class="table-responsive">
          <div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
            <div class="row">
              <div class="col-sm-12">
              <table id="zero_config" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="zero_config_info">
              <thead>
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 57px;">Ciudad</th>
                  <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 57px;">Provincia</th>
                  <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 72px;">Accion</th>
                </tr>
              </thead>

              <tbody>
                <?php foreach($ciudades as $c){ ?>
                  <tr role="row" class="odd">
                    <td class="sorting_1"><?php echo $c['ciudad']; ?></td>
                    <td class="sorting_1"><?php echo $c['provincia']; ?></td>
                    <td>
                    <?php if($boton_edit){?>
                      <a href="<?php echo site_url('Ciudad/edit/'.$c['ciudad_id']); ?>" class="btn btn-info btn-sm">Editar</a>
                     <?php }?>
                     
                     <?php if($boton_edit){?>
                      <a href="<?php echo site_url('Ciudad/remove/'.$c['ciudad_id']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                      <?php }?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>

              <tfoot>
                <tr>
                  <th rowspan="1" colspan="1">Ciudad</th>
                  <th rowspan="1" colspan="1">Provincia</th>
                  <th rowspan="1" colspan="1">Acción</th>
                </tr>
              </tfoot>
            </table>

            <div class="float-left position b-3">
              <a href="<?php echo site_url('Ciudad/add'); ?>" class="btn btn-success">Nueva</a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</div>
</div>
