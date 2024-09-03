<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Driver</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .status-text {
            font-size: 1em; /* Besarkan font-size sesuai dengan data-aprrovel.php */
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
        }

        .status-diterima {
            color: #198754; /* Bootstrap Success color */
        }

        .status-ditolak {
            color: red; /* Bootstrap Danger color */
        }

        .status-placeholder {
            color: #6c757d; /* Gray color for placeholder text */
        }

        .table thead th {
            background-color: red; /* Red background */
            color: white; /* White text */
            text-align: center; /* Center-align header text */
            vertical-align: middle; /* Center-align vertically */
        }

        .table tbody tr {
            background-color: white;
            text-align: center; /* Make all rows white */
            vertical-align: middle;
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

        /* Hover effect for all buttons */
        .btn:hover {
            background-color: #0056b3;
            color: white;
            border: 1px solid black;
        }

        .btn-primary {
            color: white;
            background-color: #007bff; /* Standard Bootstrap blue color */
            padding: 0.5em 1em;
            font-size: 0.875em;
            border-radius: 0.25em;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow for a professional look */
            border: none; /* No border for a cleaner look */
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Slightly darker blue on hover */
            color: white;
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15); /* Enhance shadow on hover */
        }

        .btn-logout {
            color: white;
            background-color: red;
            border: 1px solid red;
            padding: 0.5em 1.5em;
            font-size: 1em;
            border-radius: 0.375em;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        .btn-logout:hover {
            background-color: darkred;
            border-color: darkred;
            color: white;
        }

        .btn-cetak-laporan {
            color: black;
            background-color: white;
            border: 1px solid black;
            padding: 0.5em 1em;
            font-size: 0.875em;
            transition: background-color 0.3s ease, color 0.3s ease;
            border-radius: 0.25em; /* Rounded corners */
        }

        .btn-cetak-laporan:hover {
            background-color: red;
            color: white;
            border: 1px solid red;
        }

        .search-container {
            display: flex;
            align-items: center; /* Align items vertically */
            gap: 0.5em;
            margin-top: 10px; /* Add spacing between elements */
        }

        .search-container .form-control {
            width: 250px; /* Set medium size width */
        }

        @media (max-width: 576px) {
            .search-container {
                flex-direction: column;
                align-items: stretch;
            }

            .search-container .form-control,
            .search-container .btn {
                width: 100%;
                margin-bottom: 10px; /* Add spacing between elements in column view */
            }

            .search-container .btn {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
<div class="container mt-5 px-4">
    <h3>Aplikasi SIM Pertamina</h3>
    <div class="alert alert-secondary">
        Anda Login Sebagai <b>Reviewer</b> di Aplikasi SIM Pertamina.
    </div>
    <a href="logout.php" class="btn btn-logout mb-3">Logout</a>
    <div class="card mt-2">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Halaman Data Driver.</h5>
                <div class="search-container">
                    <a href="cetak-laporan.php" class="btn btn-cetak-laporan">Cetak Laporan</a>
                    <input type="text" id="search" class="form-control" placeholder="Cari data...">
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped table-bordered w-100">
                    <thead>
                        <tr class="fw-bold text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Pt</th>
                            <th>Umur</th>
                            <th>Awak</th>
                            <th>Keperluan</th>
                            <th>Masa KTP</th>
                            <th>Masa Narkoba</th>
                            <th>Masa Kesehatan</th>
                            <th>Persyaratan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="dataTable">
                        <?php
                        // Connect to the database using PDO
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "db_simper";

                        try {
                            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // Fetch data using PDO
                            $sql = "SELECT * FROM data_driver ORDER BY id DESC";
                            $stmt = $pdo->query($sql);
                            $no = 1;

                            foreach ($stmt as $data) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($data['nama']) ?></td>
                                    <td><?= htmlspecialchars($data['pt']) ?></td>
                                    <td><?= htmlspecialchars($data['umur']) ?></td>
                                    <td><?= htmlspecialchars($data['awak']) ?></td>
                                    <td><?= htmlspecialchars($data['keperluan']) ?></td>
                                    <td><?= htmlspecialchars($data['masa_ktp']) ?></td>
                                    <td><?= htmlspecialchars($data['masa_narkoba']) ?></td>
                                    <td><?= htmlspecialchars($data['masa_kesehatan']) ?></td>
                                    <td class="text-center"><a href="data-persyaratan.php?id=<?= $data['id'] ?>" class="btn">View</a></td>
                                    <td class="text-center status-text" id="status-<?= $data['id'] ?>">
                                        <?php if (isset($data['status']) && $data['status'] !== ''): ?>
                                            <span class="status-text status-<?= strtolower($data['status']) ?>">
                                                <?= htmlspecialchars($data['status']) ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="status-placeholder">Status Belum Dipilih</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php }

                        } catch (PDOException $e) {
                            die("Koneksi ke database gagal: " . $e->getMessage());
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Search function
    $('#search').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#dataTable tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
</script>
</body>
</html>
