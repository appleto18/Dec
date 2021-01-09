   <footer>
          <div class="pull-right">
            Appleto 
          </div>
          <div class="clearfix"></div>
        </footer>
      </div>
    </div>

    <script src="<?php echo base_url('assets'); ?>/vendors/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/fastclick/lib/fastclick.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/nprogress/nprogress.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/Chart.js/dist/Chart.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/gauge.js/dist/gauge.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/iCheck/icheck.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/skycons/skycons.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/Flot/jquery.flot.resize.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/flot.curvedlines/curvedLines.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/DateJS/build/date.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/google-code-prettify/src/prettify.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/switchery/dist/switchery.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/parsleyjs/dist/parsley.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/autosize/dist/autosize.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/starrr/dist/starrr.js"></script>


    <script src="<?php echo base_url('assets'); ?>/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="<?php echo base_url('assets'); ?>/build/js/custom.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
  </body>
</html>

<script type="text/javascript">
  
    function delete_product(product_id)
    {
        swal({
          title: "Are you sure?",
          text: "Reject This Session",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            location.href = "<?php echo base_url('Product/delete_product/')  ?>"+product_id;
          } 
        });
    }
    
    
    function delete_users(user_id)
    {
        swal({
          title: "Are you sure?",
          text: "Delete This User",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            location.href = "<?php echo base_url('Users/delete_users/')  ?>"+user_id;
          } 
        });
    }
    
    function delete_machine(machine_id)
    {
        swal({
          title: "Are you sure?",
          text: "Delete This Machine",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            location.href = "<?php echo base_url('Machines/delete_machine/')  ?>"+machine_id;
          } 
        });
    }
</script>