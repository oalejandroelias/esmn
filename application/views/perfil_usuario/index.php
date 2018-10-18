<div class="row">
  <div class="col-12">

    <div class="card">
      <div class="card-body">
        <!-- <h5 class="card-title">Basic Datatable</h5> -->
        <div class="table-responsive">
          <div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
            <div class="row">
              <div class="col-sm-12">
              <table id="zero_config" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="zero_config_info">
              <thead>
                <tr role="row">
						<tr>
                    		<th>Id Usuario</th>
                    		<th>Id Perfil</th>
                    		<th>Permisos</th>
                    		<th>Actions</th>
    			</tr>
    		</thead>
    		
    		<tbody>
	<?php foreach($perfil_usuario as $p){ ?>
    <tr>
		<th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending";><?php echo $p['id_usuario']; ?></td>
		<td><?php echo $p['id_perfil']; ?></td>
		<td><?php echo $p['permisos']; ?></td>
		<td>
            <a href="<?php echo site_url('Perfil_usuario/edit/'.$p['id_usuario']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('Perfil_usuario/remove/'.$p['id_usuario']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
	
	</tbody>
			<tfoot>
                <tr>
                  <th rowspan="1" colspan="1">Tipo Documento</th>
                  <th rowspan="1" colspan="1">Id Usuario</th>
                  <th rowspan="1" colspan="1">Id Perfil</th>
                  <th rowspan="1" colspan="1">Permisos</th>
                  <th rowspan="1" colspan="1">Actions</th>
                </tr>
              </tfoot>
</table>

<div class="pull-right">
	<a href="<?php echo site_url('Perfil_usuario/add'); ?>" class="btn btn-success">Add</a> 
</div>