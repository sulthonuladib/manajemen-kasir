<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="icon" type="image/png" href="<?php echo base_url('assets/') ?>/img/favicon.png" />
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>/login/style.css">
</head>

<body>
  <form action="<?php echo base_url('login/auth') ?>" method="post">
    <h1>Login</h1>
    <div class="form-group">
      <input required="required" class="form-control" name="username" id="username" />
      <label class="form-label">Username </label>
    </div>
    <div class="form-group">
      <input id="password" name="password" type="password" required="required" class="form-control" />
      <label class="form-label">Password</label>
      <button class="btn" type="submit">Login </button>
    </div>
  </form>
  <div align="center" style="font-family: Open Sans, sans-serif;">&copy; Copyright <?php echo date('Y') ?>, <a style="text-decoration:none;" href="http://github.com/sulthonuladib" target="_blank">B E D O K</a>. All Right Reserved</div>
  <script src="<?php echo base_url() ?>/assets/js/jquery-3.3.1.js"></script>
  </script>
  <script src="<?php echo base_url('assets/') ?>login/script.js"></script>
  <script src="<?php echo base_url('assets/') ?>js/sweetalert.min.js"></script>
  <script>
    $(document).ready(function() {
      document.getElementById("username").focus()
    });
    $('form').attr('autocomplete', 'off');
    var error = "<?php echo $this->session->flashdata('msg'); ?>";
    error && swal(error, {
      buttons: !1,
      timer: 2e3
    });
  </script>
</body>

</html>