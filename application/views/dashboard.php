  <!-- MENU SECTION END-->
    <div class="content-wrapper">
      <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">SELAMAT DATANG.<span class="pull-right"><?php echo date_indo(date('Y-m-d')) ?> <span id="waktu"></span></span></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
               <div class="alert alert-info">
                    <table class="table table-condensed table-borderless">
                      <tr>
                        <td width="88">Username</td>
                        <td width="1">:</td>
                        <td width="252"><?php echo $this->session->userdata('ses_username') ?></td>
                      </tr>
                      <tr>
                        <td width="88">Nama</td>
                        <td width="1">:</td>
                        <td width="252"><?php echo $this->session->userdata('ses_nama') ?></td>
                      </tr>
                      <tr>
                        <td width="88">Hak Akses</td>
                        <td width="1">:</td>
                        <td width="252"><?php echo $this->session->userdata('akses') ?></td>
                      </tr>
                    </table>
               </div>
            </div>
        </div>
      </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
    <section class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                   &copy; Copyright <?php echo date('Y') ?>, <a href="https://github.com/sulthonuladib" target="_blank">B E D O K</a>
                </div>
            </div>
        </div>
    </section>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <script src="<?php echo base_url() ?>/assets/js/jquery-1.10.2.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/custom.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/sweetalert.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/toastr.min.js"></script>
    <script>
      $("ul.nav li.dropdown").hover(function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(100).fadeIn(500)},function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(100).fadeOut(500)});
      var pesan="<?php echo $this->session->flashdata('msg'); ?>";pesan&&(toastr.options={positionClass:"toast-top-right"},toastr.success(pesan));

      function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('waktu').innerHTML = h + ":" + m + ":" + s;
        var t = setTimeout(startTime, 500);
      }

      function checkTime(i) {
          if (i < 10) {i = "0" + i};
          return i;
      }

      $(document).ready(function() {
        startTime();
      });
    </script>

</body>
</html>