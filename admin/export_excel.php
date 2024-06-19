<?php
require '../vendor/autoload.php';
require_once '../db_connect.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set Header
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Nama');
$sheet->setCellValue('C1', 'Email');
$sheet->setCellValue('D1', 'Phone');
$sheet->setCellValue('E1', 'Date');
$sheet->setCellValue('F1', 'Message');
$sheet->setCellValue('G1', 'Status');
$sheet->setCellValue('H1', 'Laporan');

$result = mysqli_query($conn, "SELECT * FROM appointments LEFT JOIN user USING(id_user) LEFT JOIN reports ON reports.appointment_id = appointments.id");

$no = 1;
$row = 2; // Row mulai dari 2 karena row 1 digunakan untuk header
while ($data = mysqli_fetch_array($result)) {
    $catatan = !empty($data['catatan']) ? $data['catatan'] : '-';
    $status = ucfirst($data['status']);
    if ($data['status'] == 'approved') {
        $status = 'Approved';
    } elseif ($data['status'] == 'cancelled') {
        $status = 'Cancelled';
    }

    $sheet->setCellValue('A' . $row, $no);
    $sheet->setCellValue('B' . $row, $data['nama']);
    $sheet->setCellValue('C' . $row, $data['email']);
    $sheet->setCellValue('D' . $row, $data['no_hp']);
    $sheet->setCellValue('E' . $row, $data['date']);
    $sheet->setCellValue('F' . $row, $data['message']);
    $sheet->setCellValue('G' . $row, $status);
    $sheet->setCellValue('H' . $row, $catatan);

    $no++;
    $row++;
}

$writer = new Xlsx($spreadsheet);
$filename = 'riwayat_appointment.xlsx';

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit;
?>
