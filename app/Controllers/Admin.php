<?php

namespace App\Controllers;

use App\Database\Migrations\TransaksiGaji;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Models\AdminModels;
use App\Models\JabatanModels;
use App\Models\TransaksiGajiModels;

class Admin extends BaseController
{
    protected $adminmodels;
    protected $jabatanmodels;
    protected $transaksigajimodels;

    public function __construct()
    {
        $this->jabatanmodels = new JabatanModels();
        $this->adminmodels = new AdminModels();
        $this->transaksigajimodels = new TransaksiGajiModels();
    }

    public function karyawan()
    {
        // Mengambil data jabatan dari database
        $jabatan = $this->jabatanmodels->findAll();
        $this->adminmodels->save($this->request->getVar());
        return view('data_karyawan', ['jabatan' => $jabatan]);
    }

    //KARYAWAN
    public function edit_karyawan($id_karyawan)
    {
        $this->dashboard();
        $data = [
            'karyawan' => $this->adminmodels->find($id_karyawan),
        ];
        // Kirim data karyawan ke view edit
        return view('dashboard', $data);
    }

    public function update_karyawan($id_karyawan)
    {
        $data = [
            'nik' => $this->request->getPost('nik'),
            'nama' => $this->request->getPost('nama'),
            'no_telp' => $this->request->getPost('no_telp'),
            'alamat' => $this->request->getPost('alamat'),
            'jabatan_id' => $this->request->getPost('jabatan_id')
        ];
        $this->adminmodels->update($id_karyawan, $data);
        session()->setFlashdata('success', 'Data edited successfully.');
        return redirect()->to('/dashboard');
    }

    public function delete_karyawan($id_karyawan)
    {
        $this->adminmodels->delete($id_karyawan);
        session()->setFlashdata('success', 'Data deleted successfully.');
        // Redirect to a desired page
        return redirect()->to('/dashboard');
    }

    //JABATAN
    public function jabatan()
    {
        $this->jabatanmodels->save($this->request->getVar());
        return redirect()->to('/formkaryawan');
    }

    public function delete_jabatan($id_jabatan)
    {
        $this->jabatanmodels->delete($id_jabatan);
        session()->setFlashdata('success', 'Data deleted successfully.');
        // Redirect to a desired page
        return redirect()->to('/formkaryawan');
    }


    //    FE
    public function dashboard()
    {
        $karyawanCount = $this->adminmodels->countAll();
        $jabatanCount = $this->jabatanmodels->countAll();
        $data = [
            'karyawan' => $this->adminmodels->join('jabatan', 'jabatan.id_jabatan = karyawan.jabatan_id')->findAll(),
            'jabatan' => $this->jabatanmodels->findAll(),
            'karyawanCount' => $karyawanCount,
            'jabatanCount' => $jabatanCount
        ];
        return view('/dashboard', $data);
    }

    public function form()
    {
        $data = [
            'jabatan' => $this->jabatanmodels->findAll()
        ];
        return view('/data_karyawan', $data);
    }

    public function laporangaji()
    {
        $query = $this->adminmodels
            ->select('MONTH(karyawan.karyawan_created_at) AS bulan')
            ->groupBy('bulan')
            ->get()
            ->getResult();

        $namaBulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $data = [
            'karyawan' => $this->adminmodels->join('jabatan', 'jabatan.id_jabatan = karyawan.jabatan_id')->findAll(),
            'query' => $query,
            'namaBulan' => $namaBulan
        ];
        return view('/laporan_gaji', $data);
    }

    public function export()
    {
        $selectedMonth = $this->request->getPost('month');

        $laporangaji = $this->adminmodels->join('jabatan', 'jabatan.id_jabatan = karyawan.jabatan_id')->findAll();

        // Filter data karyawan berdasarkan bulan yang dipilih
        $filteredData = [];
        foreach ($laporangaji as $data) {
            $dateParts = explode('-', $data['karyawan_created_at']);
            $rowMonthIndex = (int)$dateParts[1];
            if ($selectedMonth === '' || $selectedMonth == $rowMonthIndex) {
                $filteredData[] = $data;
            }
        }

        // Export data yang telah difilter ke file Excel
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet(0)
            ->setCellValue('A1', 'NIK')
            ->setCellValue('B1', 'Nama')
            ->setCellValue('C1', 'No Telp')
            ->setCellValue('D1', 'Alamat')
            ->setCellValue('E1', 'Jabatan')
            ->setCellValue('F1', 'Gaji Pokok')
            ->setCellValue('G1', 'Bonus')
            ->setCellValue('H1', 'PPH')
            ->setCellValue('I1', 'Total Gaji');

        // Loop through the filtered data to fill in the Excel file
        $row = 2;
        foreach ($filteredData as $data) {
            $gaji_pokok = $data['gaji_pokok'];
            $bonus = $data['bonus'];
            $pph = $data['pph'];
            $total_gaji = $gaji_pokok + $bonus - $pph;

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $row, $data['nik'])
                ->setCellValue('B' . $row, $data['nama'])
                ->setCellValue('C' . $row, $data['no_telp'])
                ->setCellValue('D' . $row, $data['alamat'])
                ->setCellValue('E' . $row, $data['nama_jabatan'])
                ->setCellValue('F' . $row, $gaji_pokok)
                ->setCellValue('G' . $row, $bonus)
                ->setCellValue('H' . $row, $pph)
                ->setCellValue('I' . $row, $total_gaji);

            $row++;
        }

        // Create Excel file
        $writer = new Xlsx($spreadsheet);

        // Set output file path and name
        $filename = 'laporan_gaji';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
