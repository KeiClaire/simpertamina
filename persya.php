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
    <!-- Tombol Kembali -->
    <div class="back-button">
        <button class="btn btn-primary" onclick="window.history.back();">< Kembali</button>
    </div>

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
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="fw-bold">
                                    <th>KTP</th>
                                    <th>SKCK</th>
                                    <th>Bebas Narkoba</th>
                                    <th>Pas Foto</th>
                                    <th>Surat Kesehatan</th>
                                    <th>MCU</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <!-- Button to Inspect KTP -->
                                        <?php if ($data['ktp']) { ?>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#ktpModal">Inspect KTP</button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <!-- Button to Inspect SKCK -->
                                        <?php if ($data['skck']) { ?>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#skckModal">Inspect SKCK</button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <!-- Button to Inspect Bebas Narkoba -->
                                        <?php if ($data['bebas_narkoba']) { ?>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#bebasNarkobaModal">Inspect Bebas Narkoba</button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <!-- Button to Inspect Pas Foto -->
                                        <?php if ($data['foto']) { ?>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#fotoModal">Inspect Pas Foto</button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <!-- Button to Inspect Surat Kesehatan -->
                                        <?php if ($data['surat_kesehatan']) { ?>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#suratKesehatanModal">Inspect Surat Kesehatan</button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <!-- Button to Inspect MCU -->
                                        <?php if ($data['mcu']) { ?>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#mcuModal">Inspect MCU</button>
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

<!-- Modals for Inspecting Images -->
<?php if ($data['ktp']) { ?>
<div class="modal fade" id="ktpModal" tabindex="-1" aria-labelledby="ktpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ktpModalLabel">KTP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="data:image/jpeg;base64,<?= base64_encode($data['ktp']) ?>" alt="KTP" class="img-fluid">
            </div>
            <div class="modal-footer">
                <a href="data:image/jpeg;base64,<?= base64_encode($data['ktp']) ?>" download="KTP_<?= $data['nama'] ?>.jpg" class="btn btn-success">Download</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php if ($data['skck']) { ?>
<div class="modal fade" id="skckModal" tabindex="-1" aria-labelledby="skckModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="skckModalLabel">SKCK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="data:image/jpeg;base64,<?= base64_encode($data['skck']) ?>" alt="SKCK" class="img-fluid">
            </div>
            <div class="modal-footer">
                <a href="data:image/jpeg;base64,<?= base64_encode($data['skck']) ?>" download="SKCK_<?= $data['nama'] ?>.jpg" class="btn btn-success">Download</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!-- Repeat similar modals for other documents -->

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
