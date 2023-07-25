<?= $this->extend('layout/navbar'); ?>
<?= $this->section('content'); ?>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Dashboard</title>
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/pages/assets/modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template/pages/assets/modules/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template/pages/assets/modules/owlcarousel2/dist/<?= base_url() ?>/template/pages/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template/pages/assets/modules/owlcarousel2/dist/<?= base_url() ?>/template/pages/assets/owl.theme.default.min.css">

</head>

<body>
    <section class="dashboard">
        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Dashboard</h1>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Jumlah Karyawan</h4>
                                </div>
                                <div class="card-body">
                                    <?= $karyawanCount ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="far fa-newspaper"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Jabatan</h4>
                                </div>
                                <div class="card-body">
                                    <?= $jabatanCount ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white">Daftar Karyawan</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($karyawan as $data) : ?>
                                            <tr>
                                                <td><?= $data['nik'] ?></td>
                                                <td><?= $data['nama'] ?></td>
                                                <td><?= $data['nama_jabatan'] ?></td>
                                                <td>
                                                    <a href="/karyawan/edit/<?= $data['id_karyawan'] ?>" data-toggle="modal" data-target="#editModal<?= $data['id_karyawan'] ?>">Edit</a>
                                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                    <a href="/karyawan/delete/<?= $data['id_karyawan'] ?>">Delete</a>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal<?= $data['id_karyawan'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $data['id_karyawan'] ?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalSayaLabel">Edit Data Karyawan</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="/karyawan/update/<?= $data['id_karyawan'] ?>" method="POST">
                                                                <div class="form-group">
                                                                    <label>NIK</label>
                                                                    <input type="text" id="nik" name="nik" class="form-control" value="<?= $data['nik'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Nama</label>
                                                                    <input type="text" id="nama" name="nama" class="form-control" value="<?= $data['nama'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>No_Telp</label>
                                                                    <input type="text" id="no_telp" name="no_telp" class="form-control" value="<?= $data['no_telp'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Alamat</label>
                                                                    <input type="text" id="alamat" name="alamat" class="form-control" value="<?= $data['alamat'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Jabatan</label>
                                                                    <select class="form-control" id="jabatanSelect" name="jabatan_id">
                                                                        <?php foreach ($jabatan as $j) : ?>
                                                                            <option value="<?= $j['id_jabatan'] ?>" <?= ($j['id_jabatan'] == $data['jabatan_id']) ? 'selected' : '' ?>>
                                                                                <?= $j['nama_jabatan'] ?>
                                                                            </option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Gaji</label>
                                                                    <input type="number" id="gaji_pokok" class="form-control" value="<?= $data['gaji_pokok'] ?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Bonus</label>
                                                                    <input type="number" id="bonus" class="form-control" value="<?= $data['bonus'] ?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>PPH</label>
                                                                    <input type="number" id="pph" class="form-control" value="<?= $data['pph'] ?>" readonly>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                    <button type="submit" value="Hitung Bonus" class="btn btn-primary">Edit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                        <?php if (session()->getFlashdata('success')) : ?>
                                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <script>
    // Ambil referensi ke elemen select (dropdown) untuk jabatan
    const jabatanSelect = document.getElementById('jabatanSelect');

    // Definisikan data gaji, bonus, dan PPH sesuai dengan tabel jabatan
    const dataJabatan = <?= json_encode($jabatan); ?>;

    // Fungsi untuk memperbarui nilai gaji, bonus, dan PPH berdasarkan jabatan yang dipilih
    function updateGajiBonusPPH() {
        const selectedJabatanId = jabatanSelect.value;
        const selectedJabatan = dataJabatan.find(j => j.id_jabatan == selectedJabatanId);

        // Perbarui nilai gaji, bonus, dan PPH sesuai dengan tabel jabatan
        document.getElementById('gaji_pokok').value = selectedJabatan.gaji_pokok;
        document.getElementById('bonus').value = selectedJabatan.bonus;
        document.getElementById('pph').value = selectedJabatan.pph;
    }

    // Tambahkan event listener untuk mengubah nilai ketika opsi jabatan dipilih
    jabatanSelect.addEventListener('change', updateGajiBonusPPH);

    // Panggil fungsi updateGajiBonusPPH untuk menginisialisasi nilai awal sesuai dengan jabatan yang sudah dipilih
    updateGajiBonusPPH();
</script>

    <!-- JS Libraies -->
    <script src="<?= base_url() ?>/template/pages/assets/modules/jquery.sparkline.min.js"></script>
    <script src="<?= base_url() ?>/template/pages/assets/modules/chart.min.js"></script>
    <script src="<?= base_url() ?>/template/pages/assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>/template/pages/assets/modules/summernote/summernote-bs4.js"></script>
    <script src="<?= base_url() ?>/template/pages/assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="<?= base_url() ?>/template/pages/assets/js/page/index.js"></script>

    <!-- General JS Scripts -->
    <script src="<?= base_url() ?>/template/pages/assets/modules/jquery.min.js"></script>
    <script src="<?= base_url() ?>/template/pages/assets/modules/popper.js"></script>
    <script src="<?= base_url() ?>/template/pages/assets/modules/tooltip.js"></script>
    <script src="<?= base_url() ?>/template/pages/assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/template/pages/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url() ?>/template/pages/assets/modules/moment.min.js"></script>
    <script src="<?= base_url() ?>/template/pages/assets/js/stisla.js"></script>

    <!-- Template JS File -->
    <script src="<?= base_url() ?>/template/pages/assets/js/scripts.js"></script>
    <script src="<?= base_url() ?>/template/pages/assets/js/custom.js"></script>
</body>

<?= $this->endSection(); ?>