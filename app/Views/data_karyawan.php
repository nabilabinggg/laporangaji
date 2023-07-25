<?= $this->extend('layout/navbar'); ?>
<?= $this->section('content'); ?>

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Data Karyawan</title>

  <!--CSS-->
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/modules/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/modules/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/modules/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">

</head>

<!-- Main Content -->

<body>
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Data Karyawan</h1>
      </div>

      <div class="section-body">
        <div class="container form-group">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalJabatan">
            Tambah Data Jabatan
          </button>

          <!-- Modal Jabatan -->
          <div class="modal fade" id="modalJabatan" tabindex="-1" role="dialog" aria-labelledby="modalJabatanLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalSayaLabel">Tambah Data Jabatan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="/jabatan" method="POST">
                    <div class="form-group">
                      <label>Jabatan</label>
                      <input type="text" id="nama_jabatan" name="nama_jabatan" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Gaji Pokok</label>
                      <input type="number" id="gaji_pokok" name="gaji_pokok" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Bonus</label>
                      <input type="number" id="bonus" name="bonus" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                      <label>PPH</label>
                      <input type="number" id="pph" name="pph" class="form-control" readonly>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modaldataJabatan">
            Data Jabatan
          </button>
          <!-- Modal Data Jabatan -->
          <div class="modal fade" id="modaldataJabatan" tabindex="-1" role="dialog" aria-labelledby="modaldataJabatanLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalSayaLabel"> Data Jabatan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="col-md">
                    <div class="card">
                      <div class="card-body p-0">
                        <div class="table-responsive">
                          <table class="table table-striped mb-0 table-xl">
                            <thead>
                              <tr>
                                <th>Jabatan</th>
                                <th>Gaji Pokok</th>
                                <th>Bonus</th>
                                <th>PPH</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($jabatan as $data) : ?>
                                <tr>
                                  <td><?= $data['nama_jabatan'] ?></td>
                                  <td><?= $data['gaji_pokok'] ?></td>
                                  <td><?= $data['bonus'] ?></td>
                                  <td><?= $data['pph'] ?></td>
                                  <td>
                                    <a href="/jabatan/delete/<?= $data['id_jabatan'] ?>">Delete</a>
                                  </td>
                                </tr>
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
                </div>
              </div>
            </div>
          </div>

        </div>

        <!--MODAL END-->

        <div class="col-lg">
          <div class="card">
            <div class="card-body">
              <form action="karyawan" method="POST">
                <div class="form-group">
                  <label>NIK</label>
                  <input type="text" class="form-control" name="nik" required>
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" name="nama" required>
                </div>
                <div class="form-group">
                  <label>No. Telepon</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-phone"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control phone-number" name="no_telp" required>
                  </div>
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <textarea class="form-control" name="alamat" required></textarea>
                </div>
                <div class="form-group">
                  <label for="jabatan">Jabatan</label>
                  <select name="jabatan_id" id="jabatan" class="form-control" required>
                    <option value="" data-gaji="" data-bonus="" data-pph=""> -- Pilih Jabatan -- </option>
                    <?php foreach ($jabatan as $data) : ?>
                      <option value="<?php echo $data['id_jabatan']; ?>" data-gaji="<?php echo $data['gaji_pokok']; ?>" data-bonus="<?php echo $data['bonus']; ?>" data-pph="<?php echo $data['pph']; ?>">
                        <?php echo $data['nama_jabatan']; ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="gaji">Gaji</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        Rp
                      </div>
                    </div>
                    <input class="form-control currency" type="number" id="gaji" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="bonusid">Bonus</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        Rp
                      </div>
                    </div>
                    <input class="form-control currency" type="number" id="bonusid" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="pphid">PPH (5%)</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        Rp
                      </div>
                    </div>
                    <input id="pphid" type="number" class="form-control currency" readonly>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary" value="Simpan">Tambah</button>
              </form>
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

  <!-- Template JS File -->
  <script src="<?= base_url() ?>/template/pages/assets/js/scripts.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/js/custom.js"></script>

  <!-- JS Libraies -->
  <script src="<?= base_url() ?>/template/pages/assets/modules/cleave-js/dist/cleave.min.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/modules/cleave-js/dist/addons/cleave-phone.us.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/modules/select2/dist/js/select2.full.min.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/modules/jquery-selectric/jquery.selectric.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="<?= base_url() ?>/template/pages/assets/js/page/forms-advanced-forms.js"></script>

  <script>
    // Mengupdate inputan bonus saat inputan gaji berubah
    document.getElementById('gaji_pokok').addEventListener('input', function() {
      var gaji = parseFloat(this.value);
      var nama_jabatan = document.getElementById('nama_jabatan').value.toLowerCase();
      if (nama_jabatan.includes('manager')) {
        bonus = gaji * 0.5;
      } else if (nama_jabatan.includes('supervisor')) {
        bonus = gaji * 0.4;
      } else if (nama_jabatan.includes('staff')) {
        bonus = gaji * 0.3;
      }
      var pph = (gaji + bonus) * 0.05;
      document.getElementById('bonus').value = bonus.toFixed(2);
      document.getElementById('pph').value = pph.toFixed(2);
    });
  </script>

  <script>
    const jabatanSelect = document.getElementById('jabatan');
    const gajiInput = document.getElementById('gaji');
    const bonusInput = document.getElementById('bonusid');
    const pphInput = document.getElementById('pphid');

    jabatanSelect.addEventListener('change', function() {
      const selectedOption = this.options[this.selectedIndex];
      const selectedGaji = selectedOption.getAttribute('data-gaji');
      const selectedBonus = selectedOption.getAttribute('data-bonus');
      const selectedPph = selectedOption.getAttribute('data-pph');

      gajiInput.value = selectedGaji;
      bonusInput.value = selectedBonus;
      pphInput.value = selectedPph;
    });
  </script>
</body>

<?= $this->endSection(); ?>