
</div>
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<footer class="footer text-center">
  CeciliaESMN - Escuela de Música del Neuquén.
</footer>
</div>
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/popper.js/dist/umd/popper.min.js"></script>
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
    <script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
    <script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
    <script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
    <script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/libs/quill/dist/quill.min.js"></script>


    <!-- this page js -->
    <script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="<?= base_url();?>Lib/matrix-admin-bt4/assets/extra-libs/DataTables/datatables.min.js"></script>
    <script>
    /****************************************
    *       Basic Table                   *
    ****************************************/
    $('#zero_config').DataTable();

  </script>

  <script>
        //***********************************//
        // For select 2
        //***********************************//
        $(".select2").select2();

        /*colorpicker*/
        $('.demo').each(function() {
        //
        // Dear reader, it's actually very easy to initialize MiniColors. For example:
        //
        //  $(selector).minicolors();
        //
        // The way I've done it below is just for the demo, so don't get confused
        // by it. Also, data- attributes aren't supported at this time...they're
        // only used for this demo.
        //
        $(this).minicolors({
                control: $(this).attr('data-control') || 'hue',
                position: $(this).attr('data-position') || 'bottom left',

                change: function(value, opacity) {
                    if (!value) return;
                    if (opacity) value += ', ' + opacity;
                    if (typeof console === 'object') {
                        console.log(value);
                    }
                },
                theme: 'bootstrap'
            });

        });
        /*datwpicker*/
        jQuery('.mydatepicker').datepicker();
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'

        });
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

    </script>
  
<!--  Scripts cargados desde el controlador -->
<?php if (isset($js)) : ?>
  <?php foreach ($js as $src) : ?>
    <script src="<?= base_url('Lib/'.$src);?>"></script>
  <?php endforeach; ?>
<?php endif; ?>



</body>



</html>
