<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi untuk memastikan file berhasil diunggah
    if (is_uploaded_file($_FILES['surat_permohonan_pt']['tmp_name']) &&
        is_uploaded_file($_FILES['ktp']['tmp_name']) &&
        is_uploaded_file($_FILES['sim']['tmp_name']) &&
        is_uploaded_file($_FILES['skck']['tmp_name']) &&
        is_uploaded_file($_FILES['bebas_narkoba']['tmp_name']) &&
        is_uploaded_file($_FILES['foto']['tmp_name']) &&
        is_uploaded_file($_FILES['surat_kesehatan']['tmp_name']) &&
        is_uploaded_file($_FILES['mcu']['tmp_name'])) {

        // Ambil data biodata dari session
        $biodata = $_SESSION['biodata'];
        
        // Ambil data file
        $surat_permohonan_pt = file_get_contents($_FILES['surat_permohonan_pt']['tmp_name']);
        $ktp = file_get_contents($_FILES['ktp']['tmp_name']);
        $sim = file_get_contents($_FILES['sim']['tmp_name']);
        $skck = file_get_contents($_FILES['skck']['tmp_name']);
        $bebas_narkoba = file_get_contents($_FILES['bebas_narkoba']['tmp_name']);
        $foto = file_get_contents($_FILES['foto']['tmp_name']);
        $surat_kesehatan = file_get_contents($_FILES['surat_kesehatan']['tmp_name']);
        $mcu = file_get_contents($_FILES['mcu']['tmp_name']);

        try {
            $sql = "INSERT INTO data_driver (
                nama, pt, umur, awak, keperluan, masa_ktp, masa_narkoba, masa_kesehatan,
                surat_permohonan_pt, ktp, sim, skck, bebas_narkoba, foto, surat_kesehatan, mcu
            ) VALUES (
                :nama, :pt, :umur, :awak, :keperluan, :masa_ktp, :masa_narkoba, :masa_kesehatan,
                :surat_permohonan_pt, :ktp, :sim, :skck, :bebas_narkoba, :foto, :surat_kesehatan, :mcu
            )";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nama', $biodata['nama']);
            $stmt->bindParam(':pt', $biodata['pt']);
            $stmt->bindParam(':umur', $biodata['umur']);
            $stmt->bindParam(':awak', $biodata['awak']);
            $stmt->bindParam(':keperluan', $biodata['keperluan']);
            $stmt->bindParam(':masa_ktp', $biodata['masa_ktp']);
            $stmt->bindParam(':masa_narkoba', $biodata['masa_narkoba']);
            $stmt->bindParam(':masa_kesehatan', $biodata['masa_kesehatan']);
            $stmt->bindParam(':surat_permohonan_pt', $surat_permohonan_pt, PDO::PARAM_LOB);
            $stmt->bindParam(':ktp', $ktp, PDO::PARAM_LOB);
            $stmt->bindParam(':sim', $sim, PDO::PARAM_LOB);
            $stmt->bindParam(':skck', $skck, PDO::PARAM_LOB);
            $stmt->bindParam(':bebas_narkoba', $bebas_narkoba, PDO::PARAM_LOB);
            $stmt->bindParam(':foto', $foto, PDO::PARAM_LOB);
            $stmt->bindParam(':surat_kesehatan', $surat_kesehatan, PDO::PARAM_LOB);
            $stmt->bindParam(':mcu', $mcu, PDO::PARAM_LOB);

            if ($stmt->execute()) {
                // Data berhasil disimpan, arahkan ke halaman thank-you.php
                header("Location: thank-you.php");
                exit();
            } else {
                echo "Error: " . $stmt->errorInfo()[2];
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        
        $conn = null;
        // Hapus data dari session setelah menyimpan
        unset($_SESSION['biodata']);
    } else {
        echo "Gagal mengunggah satu atau lebih file.";
    }
}
