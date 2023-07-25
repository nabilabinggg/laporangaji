<?= $this->extend('layout/navbar'); ?>
<?= $this->section('content'); ?>

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Laporan Gaji Karyawan</title>


  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/pages/assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/pages/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/pages/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
</head>

<!-- Main Content -->

<body>
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Laporan Gaji Karyawan</h1>
      </div>
      <div class="container row">

        <div class="form-group mr-3 d-flex flex-row">
          <label for="month" class="d-flex m-auto">Bulan</label>
          <select class="form-control ml-2" name="month" id="month">
            <option value="">-- Pilih Bulan --</option>
            <?php foreach ($query as $row) {
              $bulanIndex = $row->bulan;
              $bulanName = $namaBulan[$bulanIndex - 1]; 
            ?>
              <option value="<?= $bulanIndex; ?>"><?= $bulanName; ?></option>
            <?php
            }
            ?>
          </select>
        </div>
          <div>
            <button type="submit" class="btn btn-primary" style="height:60%" onclick="exportToExcel()">Download Laporan</button>
          </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                  <thead>
                    <tr>
                      <th>Bulan</th>
                      <th>NIK</th>
                      <th>Nama</th>
                      <th>Jabatan</th>
                      <th>Gaji Pokok</th>
                      <th>Bonus</th>
                      <th>PPH</th>
                      <th>Total Gaji</th>
                    </tr>
                  </thead>
                  <tbody id="table-body">
                    <?php foreach ($karyawan as $data) {
                      $dateParts = explode('-', $data['karyawan_created_at']);
                      $formattedDate = $dateParts[2] . ' ' . $namaBulan[(int)$dateParts[1] - 1] . ' ' . $dateParts[0];
                      $gaji_pokok = $data['gaji_pokok'];
                      $bonus = $data['bonus'];
                      $pph = $data['pph'];

                      $total_gaji = $gaji_pokok + $bonus - $pph;
                      echo ("<tr>
                      <td>" . $formattedDate . "</td>
                        <td>" . $data['nik'] . "</td>
                        <td>" . $data['nama'] . "</td>
                        <td>" . $data['nama_jabatan'] . "</td>
                        <td>" . number_format($data['gaji_pokok'], 2) . "</td>
                        <td>" . number_format($data['bonus'], 2) . "</td>
                        <td>" . number_format($data['pph'], 2) . "</td>
                        <td>" . number_format($total_gaji, 2) . "</td>
                        </tr>");
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script>
    function filterTableByMonth() {
      const monthFilter = document.getElementById('month');
      const tableBody = document.getElementById('table-body');
      const rows = tableBody.getElementsByTagName('tr');
      const selectedMonth = monthFilter.value;
      
      for (let i = 0; i < rows.length; i++) {
        const row = rows[i];
        const cells = row.getElementsByTagName('td');
        const rowDate = cells[0].innerText.trim();
        
        // Bagian berikut untuk mendapatkan bulan dari output tanggal
        const dateParts = rowDate.split(' ');
        const rowMonth = dateParts[1];
        
        // Mengubah nama bulan menjadi angka sesuai indeks dalam array namaBulan
        const namaBulan = [
          'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
          'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        const rowMonthIndex = namaBulan.indexOf(rowMonth) + 1;
        
        if (!selectedMonth || rowMonthIndex.toString() === selectedMonth) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      }
    }

    function exportToExcel() {
      // Set form action with the selected month value
      const monthFilter = document.getElementById('month');
      const selectedMonth = monthFilter.value;
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = '/laporangajikaryawan/export';

      // Create input element to send the selected month to the server
      const inputMonth = document.createElement('input');
      inputMonth.type = 'hidden';
      inputMonth.name = 'month';
      inputMonth.value = selectedMonth;
      form.appendChild(inputMonth);

      // Append form to the document and submit it
      document.body.appendChild(form);
      form.submit();
    }

    const monthFilter = document.getElementById('month');
    monthFilter.addEventListener('change', filterTableByMonth);
    filterTableByMonth();
  </script>

  <!-- General JS Scripts -->
  <script src="<?= base_url() ?>/template/pages/assets/modules/jquery.min.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/modules/popper.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/modules/tooltip.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/modules/moment.min.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="<?= base_url() ?>/template/pages/assets/modules/datatables/datatables.min.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/modules/jquery-ui/jquery-ui.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="<?= base_url() ?>/template/pages/assets/js/page/modules-datatables.js"></script>

  <!-- Template JS File -->
  <script src="<?= base_url() ?>/template/pages/assets/js/scripts.js"></script>
  <script src="<?= base_url() ?>/template/pages/assets/js/custom.js"></script>
</body>

<?= $this->endSection(); ?>