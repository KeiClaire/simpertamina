<?php
require 'vendor/autoload.php'; // Sertakan autoload Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

// Buat objek Spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Setel header kolom
$headers = [
    'No',
    'Nama',
    'Pt',
    'Umur',
    'Awak',
    'Keperluan',
    'Masa KTP',
    'Masa Narkoba',
    'Masa Kesehatan'
];

$sheet->fromArray($headers, NULL, 'A1');

// Atur gaya untuk baris header
$headerRow = $sheet->getStyle('A1:I1');
$headerRow->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00'); // Kuning
$headerRow->getFont()->setBold(true)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK));
$headerRow->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// Setel border untuk header
$headerRow->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

// Atur lebar kolom
$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(20);
$sheet->getColumnDimension('C')->setWidth(15);
$sheet->getColumnDimension('D')->setWidth(10);
$sheet->getColumnDimension('E')->setWidth(10);
$sheet->getColumnDimension('F')->setWidth(20);
$sheet->getColumnDimension('G')->setWidth(15);
$sheet->getColumnDimension('H')->setWidth(15);
$sheet->getColumnDimension('I')->setWidth(20);

// Ambil data dari database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_simper";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM data_driver ORDER BY id DESC";
    $stmt = $pdo->query($sql);
    $rowNumber = 2; // Mulai menulis data dari baris kedua

    foreach ($stmt as $data) {
        $sheet->setCellValue('A' . $rowNumber, $rowNumber - 1);
        $sheet->setCellValue('B' . $rowNumber, htmlspecialchars($data['nama']));
        $sheet->setCellValue('C' . $rowNumber, htmlspecialchars($data['pt']));
        $sheet->setCellValue('D' . $rowNumber, htmlspecialchars($data['umur']));
        $sheet->setCellValue('E' . $rowNumber, htmlspecialchars($data['awak']));
        $sheet->setCellValue('F' . $rowNumber, htmlspecialchars($data['keperluan']));
        $sheet->setCellValue('G' . $rowNumber, htmlspecialchars($data['masa_ktp']));
        $sheet->setCellValue('H' . $rowNumber, htmlspecialchars($data['masa_narkoba']));
        $sheet->setCellValue('I' . $rowNumber, htmlspecialchars($data['masa_kesehatan']));
        $rowNumber++;
    }

    // Atur gaya untuk baris data
    $dataRows = $sheet->getStyle('A2:I' . ($rowNumber - 1));
    $dataRows->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    $dataRows->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

} catch (PDOException $e) {
    die("Koneksi ke database gagal: " . $e->getMessage());
}

// Setel header dan kirim file ke browser
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=data-driver-mobil-tangki.xls");
header("Cache-Control: max-age=0");

$writer = new Xls($spreadsheet);
$writer->save('php://output');
exit();
?>
