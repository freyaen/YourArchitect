<?php
require_once '../db_connect.php';
require_once '../vendor/autoload.php'; // Autoload TCPDF

// Buat instance TCPDF
$pdf = new \TCPDF();

// Pengaturan dokumen
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Architect');
$pdf->SetTitle('Riwayat Appointment');
$pdf->SetSubject('Riwayat Appointment');
$pdf->SetKeywords('TCPDF, PDF, appointment, architect');

// Pengaturan margin
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Pengaturan halaman
$pdf->AddPage();

// Ambil data dari database
$result = mysqli_query($conn, "SELECT * FROM appointments LEFT JOIN user USING(id_user) LEFT JOIN reports ON reports.appointment_id = appointments.id");

// Buat konten HTML untuk PDF
$html = '<h1>Riwayat Appointment</h1>';
$html .= '<table border="1" cellspacing="0" cellpadding="5">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Laporan</th>
                </tr>
            </thead>
            <tbody>';

$no = 1;
while ($data = mysqli_fetch_array($result)) {
    $catatan = !empty($data['catatan']) ? $data['catatan'] : '-';
    $lampiran = !empty($data['lampiran']) ? "Lihat Lampiran" : '';

    $status = '';
    if ($data['status'] == 'approved') {
        $status = 'Approved';
    } elseif ($data['status'] == 'cancelled') {
        $status = 'Cancelled';
    } else {
        $status = ucfirst($data['status']);
    }

    $html .= "<tr>
                <td>{$no}</td>
                <td>{$data['nama']}</td>
                <td>{$data['email']}</td>
                <td>{$data['no_hp']}</td>
                <td>{$data['date']}</td>
                <td>{$data['message']}</td>
                <td>{$status}</td>
                <td>{$catatan} {$lampiran}</td>
              </tr>";
    $no++;
}

$html .= '</tbody></table>';

// Tambahkan konten HTML ke PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Output PDF
$pdf->Output('riwayat_appointment.pdf', 'I');
?>
