 <!-- Bootstrap core JavaScript-->
 <script src="assets/js/jquery.min.js"></script>
 <script src="assets/js/bootstrap.bundle.min.js"></script>

 <!-- Core plugin JavaScript-->
 <script src="assets/js/jquery.easing.min.js"></script>

 <!-- Custom scripts for all pages-->
 <script src="assets/js/sb-admin-2.min.js"></script>

 <!-- Page level plugins -->
 <script src="vendor/chart.js/Chart.min.js"></script>

 <!-- Page level custom scripts -->
 <script src="js/demo/chart-area-demo.js"></script>
 <script src="js/demo/chart-pie-demo.js"></script>


 <script src="https://kit.fontawesome.com/eafaa4f333.js" crossorigin="anonymous"></script>

 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
 <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Feather Icons -->
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

 
 

 <script>
    //  var base_url = '<?php echo base_url(); ?>'
    //  function cekTransaksi() {
    //     $.post(base_url + "dashboard/cekTransaksi", function(res){
    //         $(".history").html(res.salam);
    //     },'json')
    // }

    // setInterval(function(){
    //     cekTransaksi()
    // },5000)

 </script>
 <?php if (isset($js)) { ?>
     <script src="<?php echo base_url('app/' . $js . '.js'); ?>"></script>
 <?php } ?>
 </body>

 </html>