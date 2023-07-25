<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/pages/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template/pages/assets/modules/fontawesome/css/all.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/pages/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template/pages/assets/css/components.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <!--SEARCH-->
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <!--PROFILE NAVBAR-->
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="<?= base_url() ?>/template/pages/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="/logout" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                    </li>
                </ul>
            </nav>
            <!--SIDEBAR-->
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html">PT. Baroqah tbk.</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="<?= base_url('/dashboard') ?>">PBT</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li>
                            <a href="<?= base_url('/dashboard') ?>" class="nav-link"><i class="fas fa-th-large"></i><span>Dashboard</span></a>
                        </li>
                        <li class="menu-header">Karyawan</li>
                        <li><a class="nav-link" href="<?= base_url('formkaryawan') ?>"><i class="fas fa-id-badge"></i> <span>Input Data Karyawan</span></a></li>
                        <li><a class="nav-link" href="<?= base_url('laporangajikaryawan') ?>"><i class="fas fa-money-bill"></i> <span>Laporan Gaji Karyawan</span></a></li>
                    </ul>
                </aside>
            </div>

            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <footer class="main-footer">
        <div class="footer-left">
            Copyright &copy; 2023
        </div>
        <div class="footer-right">

        </div>
    </footer>
</body>

</html>