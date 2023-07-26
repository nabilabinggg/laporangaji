<?php

// app/Controllers/LaporanGajiController.php

namespace App\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;

class LaporanGajiController extends BaseController
{
    public function exportToPdf()
    {
        // Load the view file for the PDF content (use your actual view file).
        $data['title'] = 'Laporan Gaji Karyawan';
        // ... Add other data you want to pass to the view ...
        $view = view('pdf_template', $data);

        // Initialize dompdf using options.
        $options = new Options();
        $options->set('isRemoteEnabled', true); // Allow loading remote CSS or images.
        $dompdf = new Dompdf($options);

        // Render the HTML to PDF.
        $dompdf->loadHtml($view);

        // (Optional) Set paper size and orientation. (Default is A4 portrait)
        $dompdf->setPaper('A4', 'portrait');

        // (Optional) Render the HTML to PDF.
        $dompdf->render();

        // Get the generated PDF content as a string.
        $pdfContent = $dompdf->output();

        // Send the PDF content to the client for download.
        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="Laporan_Gaji.pdf"')
            ->setBody($pdfContent);
    }
}
