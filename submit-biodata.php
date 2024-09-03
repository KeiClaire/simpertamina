<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['biodata'] = [
        'nama' => $_POST['nama'],
        'pt' => $_POST['pt'],
        'umur' => $_POST['umur'],
        'awak' => $_POST['awak'],
        'keperluan' => $_POST['keperluan'],
        'masa_ktp' => $_POST['masa_ktp'],
        'masa_narkoba' => $_POST['masa_narkoba'],
        'masa_kesehatan' => $_POST['masa_kesehatan']
    ];
    header("Location: persyaratan.php");
    exit();
}
?>
