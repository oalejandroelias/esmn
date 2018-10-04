<div class="row">
                    <div class="col-12">
                        <div class="card">
                        
                        </div>
                     
                      
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Basic Datatable</h5>
                                <div class="table-responsive">
                                    <div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                   <div class="row"><div class="col-sm-12"><table id="zero_config" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="zero_config_info">
                                        <thead>
                                            <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 57px;">Nombre</th>
                                            <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 72px;">Accion</th>


                                         
                                            </tr>


                                        </thead>
                                        <tbody>
                                            
                           
                                      

                                            <?php foreach($provincias as $p){ ?>
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1"><?php echo $p['nombre']; ?></td>
                                                    <td>
                                                        <a href="<?php echo site_url('provincia/edit/'.$p['id']); ?>" class="btn btn-info btn-sm">Editar</a>
                                                        <a href="<?php echo site_url('provincia/remove/'.$p['id']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                            </tbody>
                                        <tfoot>
                                            <tr>
                                            <th rowspan="1" colspan="1">Nombre</th>
                                            <th rowspan="1" colspan="1">Acción</th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                        <div class="float-left position b-3">
                    <a href="<?php echo site_url('provincia/add'); ?>" class="btn btn-success">Nuevo</a>
                </div>
                                    </div>
                                    </div>
                                  </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>