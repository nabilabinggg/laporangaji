<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/pages/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/pages/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/pages/assets/modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/pages/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/pages/assets/css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
<div id="app">
    <section class="section">
      <div class="container d-flex justify-content-center my-5">
      <div class="row">
          <div class="col-lg-12">
            <div class="login-brand">
              <h2>PT. Baroqah tbk.</h2>
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4 class="d-flex mx-auto">Register</h4></div>

              <div class="card-body">
                <form method="POST" action="/registration" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control" name="username" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your username
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Register
                    </button>
                  </div>
                </form>
                </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="<?= base_url() ?>/template/pages/assets/modules/jquery.min.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/modules/popper.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/modules/tooltip.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/modules/moment.min.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="<?= base_url() ?>/template/pages/assets/js/scripts.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/js/custom.js"></script>
</body>
</html>