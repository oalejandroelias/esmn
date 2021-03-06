
</div>
</div>
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<footer class="footer text-center">
  CeciliaESMN - Escuela de Música del Neuquén.
</footer>
</div>
</div>
<div id="chat">

</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url();?>Lib/matrix-admin-bt4/dist/js/jquery-ui.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<!-- <script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/popper.js/dist/umd/tooltip.min.js"></script> -->
<script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="<?= base_url();?>Lib/matrix-admin-bt4/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="<?= base_url();?>Lib/matrix-admin-bt4/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?= base_url();?>Lib/matrix-admin-bt4/dist/js/custom.min.js"></script>
<!-- This Page JS -->
<script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="<?= base_url();?>Lib/matrix-admin-bt4/dist/js/pages/mask/mask.init.js"></script>
<script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/select2/dist/js/select2.full.min.js"></script>
<script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/select2/dist/js/select2.min.js"></script>
<!-- <script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
<script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
<script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
<script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script> -->
<script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js"></script>
<script src="<?= base_url();?>Lib/jquery-timepicker/jquery.timepicker.min.js"></script>
<script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/quill/dist/quill.min.js"></script>
<script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/toastr/build/toastr.min.js"></script>
<script src="<?= base_url();?>Lib/jquery-confirm/dist/jquery-confirm.min.js"></script>

<!-- this page js -->
<script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
<script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/extra-libs/multicheck/jquery.multicheck.js"></script>
<script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/extra-libs/DataTables/datatables.min.js"></script>
<!-- <script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/extra-libs/DataTables/dataTables.buttons.min.js"></script> -->

<!-- custom -->
<script type="text/javascript">
const idPersonaActual = <?= $this->session->userdata('persona_id'); ?>;
const idUsuarioActual = <?= $this->session->userdata('usuario_id'); ?>;
</script>

<?php if ( $this->session->has_userdata('sessionStorage') ): ?>
  <script type="text/javascript">
  function setSessionToken(token){
    if (typeof(Storage) !== "undefined") {
      sessionStorage.setItem('token', token);
      return
    }else {
      return $.alert({
        title: 'Alerta!',
        content: 'El navegador no soporta Storage. Chat inhabilitado. Mas info en <a href="https://www.w3schools.com/html/html5_webstorage.asp">w3schools.com</a>',
        type: 'orange',
        buttons: {
          Ok: function(){}
        }
      });
    }
  }
  setSessionToken("<?= $this->session->userdata('sessionStorage'); ?>");
  sessionStorage.setItem('chatClass','chat-close');
  </script>
<?php endif; ?>

 <!-- RUTA DEL SITIO: -->
<script>RUTA="<?= base_url();?>";</script>
<script>URL="<?= URL;?>";</script>

<!-- global -->
<script src="<?= base_url();?>Lib/js/globals.js?v=1"></script>
<!-- chat -->
<script src="<?= base_url();?>node_modules/socket.io-client/dist/socket.io.js"></script>
<script src="<?= base_url();?>Lib/js/chat.js?v=1"></script>

<!--  Scripts cargados desde el controlador -->
<?php if (isset($js)) : ?>
  <?php foreach ($js as $src) : ?>
    <script src="<?= base_url('Lib/js/'.$src);?>"></script>
  <?php endforeach; ?>
<?php endif; ?>

<?php if($this->session->flashdata('crear') !== null){ ?>
	<script>
		var mensaje=<?php echo json_encode($this->session->flashdata('crear'))?>;
		toastr.success(mensaje,'Creando...');
	</script>
<?php
}?>

<?php if($this->session->flashdata('eliminar') !== null){ ?>
	<script>
		var mensaje=<?php echo json_encode($this->session->flashdata('eliminar'))?>;
		toastr.warning(mensaje,'Eliminando...');
	</script>
<?php
}
?>
<?php if($this->session->flashdata('deshabilitar') !== null){ ?>
	<script>
		var mensaje=<?php echo json_encode($this->session->flashdata('deshabilitar'))?>;
		toastr.error(mensaje,'Deshabilitando...');
	</script>
<?php
}
?>
<?php if($this->session->flashdata('habilitar') !== null){ ?>
	<script>
		var mensaje=<?php echo json_encode($this->session->flashdata('habilitar'))?>;
		toastr.success(mensaje,'Habilitando...');
	</script>
<?php
}
?>
<?php if($this->session->flashdata('editar') !== null){ ?>
	<script>
		var mensaje=<?php echo json_encode($this->session->flashdata('editar'))?>;
		toastr.info(mensaje,'Modificando...');
	</script>
<?php
}
?>
<?php if($this->session->flashdata('error') !== null){ ?>
	<script>
		var mensaje=<?php echo json_encode($this->session->flashdata('error'))?>;
		toastr.error(mensaje,'');
	</script>
<?php
}
?>


</body>



</html>
