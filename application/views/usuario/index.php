<div class="row">
	<div class="col-12">
	   <div class="card">      
       <div class="card-body">
           
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">



			
				    <tr>
						<th>ID</th>
						<th>Id Persona</th>
						<th>Password</th>
						<th>Username</th>
						<th>Actions</th>
				    </tr>
					<?php foreach($usuarios as $u){ ?>
				    <tr>
						<td><?php echo $u['id']; ?></td>
						<td><?php echo $u['id_persona']; ?></td>
						<td><?php echo $u['password']; ?></td> -->
						<td><?php echo $u['username']; ?></td>
						<td>
				            <a href="<?php echo site_url('usuario/edit/'.$u['id']); ?>" class="btn btn-info btn-xs">Edit</a> 
				            <a href="<?php echo site_url('usuario/remove/'.$u['id']); ?>" class="btn btn-danger btn-xs">Delete</a>
				        </td>
				    </tr>
					<?php } ?>
				
			</table>
		</div>

		<div class="pull-right">
	<a href="<?php echo site_url('usuario/add'); ?>" class="btn btn-success">Add</a> 
</div>
	</div>
</div>
<div class="pull-right">
    <?php echo $this->pagination->create_links(); ?>    
</div>
