<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Persyaratan</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .modal-dialog {
            max-width: 90%; /* Adjusted for better mobile view */
        }
        .back-button {
            margin-bottom: 20px;
        }
        @media (max-width: 768px) {
            .modal-dialog {
                max-width: 100%;
            }
        }
        .btn {
            color: white;
            background-color: #007bff;
            border: 1px solid black;
            padding: 0.5em 1em;
            font-size: 0.875em;
            transition: background-color 0.3s ease, color 0.3s ease;
            border-radius: 0.25em; /* Rounded corners */
        }

        .btn:hover {
            background-color: #0056b3;
            color: white;
            border: 1px solid black;
        }

        .back-button .btn-primary {
            color: black; /* Teks tombol */
            background-color: white; /* Warna latar belakang tombol */
            border: 1px solid black; /* Border tombol */
        }

        .back-button .btn-primary:hover {
            color: white; /* Teks tombol saat hover */
            background-color: red; /* Warna latar belakang tombol saat hover */
            border: 1px solid red; /* Border tombol saat hover */
        }

        .table thead th {
            background-color: red; /* Background color for header */
            color: white; /* Text color for header */
            text-align: center; /* Center align header text */
        }

        .table tbody td {
            text-align: center; /* Center align body text */
        }

        h3 {
            text-align: left; /* Align the title to the left */
        }
    </style>
</head>
<body>
<div class="container-fluid mt-5 px-4">
    <?php
    // Connect to the database using PDO
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_simper";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Get the ID from the URL
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        // Fetch data using PDO
        $sql = "SELECT * FROM data_driver WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Check if data exists
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <h3>Persyaratan untuk <?= htmlspecialchars($data['nama']) ?></h3>
            <div class="card mt-2">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <div class="back-button">
                                <button class="btn btn-primary" onclick="window.history.back();"><- Kembali</button>
                            </div>
                            <thead>
                                <tr class="fw-bold">
                                    <th>KTP</th>
                                    <th>SKCK</th>
                                    <th>Bebas Narkoba</th>
                                    <th>Pas Foto</th>
                                    <th>Surat Kesehatan</th>
                                    <th>MCU</th>
                                    <th>Surat Permohonan PT</th>
                                    <th>SIM</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <!-- Button to Inspect KTP -->
                                        <?php if ($data['ktp']) { ?>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#ktpModal">Inspect</button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <!-- Button to Inspect SKCK -->
                                        <?php if ($data['skck']) { ?>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#skckModal">Inspect</button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <!-- Button to Inspect Bebas Narkoba -->
                                        <?php if ($data['bebas_narkoba']) { ?>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#bebasNarkobaModal">Inspect</button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <!-- Button to Inspect Pas Foto -->
                                        <?php if ($data['foto']) { ?>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#pasFotoModal">Inspect</button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <!-- Button to Inspect Surat Kesehatan -->
                                        <?php if ($data['surat_kesehatan']) { ?>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#suratKesehatanModal">Inspect</button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <!-- Button to Inspect MCU -->
                                        <?php if ($data['mcu']) { ?>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#mcuModal">Inspect</button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <!-- Button to Inspect Surat Permohonan PT -->
                                        <?php if ($data['surat_permohonan_pt']) { ?>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#suratPermohonanModal">Inspect</button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <!-- Button to Inspect SIM -->
                                        <?php if ($data['sim']) { ?>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#simModal">Inspect</button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php
                } else {
                    echo "<div class='alert alert-danger'>Data tidak ditemukan!</div>";
                }

            } catch (PDOException $e) {
                die("Koneksi ke database gagal: " . $e->getMessage());
            }
            ?>
        </div>
    </div>
</div>

<!-- Modals for Inspecting Images and Documents -->

<?php if ($data['ktp']) { ?>
<div class="modal fade" id="ktpModal" tabindex="-1" aria-labelledby="ktpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ktpModalLabel">KTP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if (strpos($data['ktp'], '%PDF-') !== false) { ?>
                    <embed src="data:application/pdf;base64,<?= base64_encode($data['ktp']) ?>" type="application/pdf" width="100%" height="500px" />
                <?php } else { ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($data['ktp']) ?>" alt="KTP" class="img-fluid">
                <?php } ?>
            </div>
            <div class="modal-footer">
                <a href="data:<?= strpos($data['ktp'], '%PDF-') !== false ? 'application/pdf' : 'image/jpeg' ?>;base64,<?= base64_encode($data['ktp']) ?>" download="KTP_<?= $data['nama'] ?>.<?= strpos($data['ktp'], '%PDF-') !== false ? 'pdf' : 'jpg' ?>" class="btn btn-success">Download</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php if ($data['skck']) { ?>
<div class="modal fade" id="skckModal" tabindex="-1" aria-labelledby="skckModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="skckModalLabel">SKCK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if (strpos($data['skck'], '%PDF-') !== false) { ?>
                    <embed src="data:application/pdf;base64,<?= base64_encode($data['skck']) ?>" type="application/pdf" width="100%" height="500px" />
                <?php } else { ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($data['skck']) ?>" alt="SKCK" class="img-fluid">
                <?php } ?>
            </div>
            <div class="modal-footer">
                <a href="data:<?= strpos($data['skck'], '%PDF-') !== false ? 'application/pdf' : 'image/jpeg' ?>;base64,<?= base64_encode($data['skck']) ?>" download="SKCK_<?= $data['nama'] ?>.<?= strpos($data['skck'], '%PDF-') !== false ? 'pdf' : 'jpg' ?>" class="btn btn-success">Download</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php if ($data['bebas_narkoba']) { ?>
<div class="modal fade" id="bebasNarkobaModal" tabindex="-1" aria-labelledby="bebasNarkobaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bebasNarkobaModalLabel">Bebas Narkoba</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if (strpos($data['bebas_narkoba'], '%PDF-') !== false) { ?>
                    <embed src="data:application/pdf;base64,<?= base64_encode($data['bebas_narkoba']) ?>" type="application/pdf" width="100%" height="500px" />
                <?php } else { ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($data['bebas_narkoba']) ?>" alt="Bebas Narkoba" class="img-fluid">
                <?php } ?>
            </div>
            <div class="modal-footer">
                <a href="data:<?= strpos($data['bebas_narkoba'], '%PDF-') !== false ? 'application/pdf' : 'image/jpeg' ?>;base64,<?= base64_encode($data['bebas_narkoba']) ?>" download="Bebas_Narkoba_<?= $data['nama'] ?>.<?= strpos($data['bebas_narkoba'], '%PDF-') !== false ? 'pdf' : 'jpg' ?>" class="btn btn-success">Download</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php if ($data['foto']) { ?>
<div class="modal fade" id="pasFotoModal" tabindex="-1" aria-labelledby="pasFotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pasFotoModalLabel">Pas Foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if (strpos($data['foto'], '%PDF-') !== false) { ?>
                    <embed src="data:application/pdf;base64,<?= base64_encode($data['foto']) ?>" type="application/pdf" width="100%" height="500px" />
                <?php } else { ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($data['foto']) ?>" alt="Pas Foto" class="img-fluid">
                <?php } ?>
            </div>
            <div class="modal-footer">
                <a href="data:<?= strpos($data['foto'], '%PDF-') !== false ? 'application/pdf' : 'image/jpeg' ?>;base64,<?= base64_encode($data['foto']) ?>" download="foto_<?= $data['nama'] ?>.<?= strpos($data['foto'], '%PDF-') !== false ? 'pdf' : 'jpg' ?>" class="btn btn-success">Download</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php if ($data['surat_kesehatan']) { ?>
<div class="modal fade" id="suratKesehatanModal" tabindex="-1" aria-labelledby="suratKesehatanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="suratKesehatanModalLabel">Surat Kesehatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if (strpos($data['surat_kesehatan'], '%PDF-') !== false) { ?>
                    <embed src="data:application/pdf;base64,<?= base64_encode($data['surat_kesehatan']) ?>" type="application/pdf" width="100%" height="500px" />
                <?php } else { ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($data['surat_kesehatan']) ?>" alt="Surat Kesehatan" class="img-fluid">
                <?php } ?>
            </div>
            <div class="modal-footer">
                <a href="data:<?= strpos($data['surat_kesehatan'], '%PDF-') !== false ? 'application/pdf' : 'image/jpeg' ?>;base64,<?= base64_encode($data['surat_kesehatan']) ?>" download="Surat_Kesehatan_<?= $data['nama'] ?>.<?= strpos($data['surat_kesehatan'], '%PDF-') !== false ? 'pdf' : 'jpg' ?>" class="btn btn-success">Download</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php if ($data['mcu']) { ?>
<div class="modal fade" id="mcuModal" tabindex="-1" aria-labelledby="mcuModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mcuModalLabel">MCU</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if (strpos($data['mcu'], '%PDF-') !== false) { ?>
                    <embed src="data:application/pdf;base64,<?= base64_encode($data['mcu']) ?>" type="application/pdf" width="100%" height="500px" />
                <?php } else { ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($data['mcu']) ?>" alt="MCU" class="img-fluid">
                <?php } ?>
            </div>
            <div class="modal-footer">
                <a href="data:<?= strpos($data['mcu'], '%PDF-') !== false ? 'application/pdf' : 'image/jpeg' ?>;base64,<?= base64_encode($data['mcu']) ?>" download="MCU_<?= $data['nama'] ?>.<?= strpos($data['mcu'], '%PDF-') !== false ? 'pdf' : 'jpg' ?>" class="btn btn-success">Download</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php if ($data['surat_permohonan_pt']) { ?>
<div class="modal fade" id="suratPermohonanModal" tabindex="-1" aria-labelledby="suratPermohonanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="suratPermohonanModalLabel">Surat Permohonan PT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if (strpos($data['surat_permohonan_pt'], '%PDF-') !== false) { ?>
                    <embed src="data:application/pdf;base64,<?= base64_encode($data['surat_permohonan_pt']) ?>" type="application/pdf" width="100%" height="500px" />
                <?php } else { ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($data['surat_permohonan_pt']) ?>" alt="Surat Kesehatan" class="img-fluid">
                <?php } ?>
            </div>
            <div class="modal-footer">
                <a href="data:<?= strpos($data['surat_permohonan_pt'], '%PDF-') !== false ? 'application/pdf' : 'image/jpeg' ?>;base64,<?= base64_encode($data['surat_permohonan_pt']) ?>" download="surat_permohonan_pt_<?= $data['nama'] ?>.<?= strpos($data['surat_permohonan_pt'], '%PDF-') !== false ? 'pdf' : 'jpg' ?>" class="btn btn-success">Download</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php if ($data['sim']) { ?>
<div class="modal fade" id="simModal" tabindex="-1" aria-labelledby="simModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="simModalLabel">SIM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if (strpos($data['sim'], '%PDF-') !== false) { ?>
                    <embed src="data:application/pdf;base64,<?= base64_encode($data['sim']) ?>" type="application/pdf" width="100%" height="500px" />
                <?php } else { ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($data['sim']) ?>" alt="SIM" class="img-fluid">
                <?php } ?>
            </div>
            <div class="modal-footer">
                <a href="data:<?= strpos($data['sim'], '%PDF-') !== false ? 'application/pdf' : 'image/jpeg' ?>;base64,<?= base64_encode($data['sim']) ?>" download="SIM_<?= $data['nama'] ?>.<?= strpos($data['sim'], '%PDF-') !== false ? 'pdf' : 'jpg' ?>" class="btn btn-success">Download</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!-- Add similar modals for other file types -->
<!-- Ensure you have modals for bebas_narkoba, foto, surat_kesehatan, mcu, surat_permohonan_pt, and sim -->

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
